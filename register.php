<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php
        require_once 'dbconnect.php';
        ?>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<?php
if ($_POST) {
    // Zabezpiecz dane z formularza przed kodem HTML i ewentualnymi atakami SQL Injection
    // Nie ma konieczności filtrowania haseł, bo one i tak zostaną zahashowane przed wstawieniem
    // do bazy danych
    $login = $conn->real_escape_string(htmlspecialchars(trim($_POST['login'])));
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $password = $_POST['password'];
    $passwordVerify = $_POST['password_v'];
    $email = $conn->real_escape_string(htmlspecialchars(trim($_POST['email'])));
    $emailVerify = $conn->real_escape_string(htmlspecialchars(trim($_POST['email_v'])));

    // Sprawdź czy podane przez użytkownika email lub login nie są zajęte
    $checkLogin = $conn->query("SELECT COUNT(*) FROM users WHERE login = '$login'")->fetch_row();
    $checkEmail = $conn->query("SELECT COUNT(*) FROM users WHERE email = '$email'")->fetch_row();

    // Podstawowa walidacja formularza
    $errors = array();

    if (empty($login) || empty($name) || empty($surname) || empty($email) || empty($emailVerify) || empty($password) || empty($passwordVerify)) {
        $errors[] = 'Proszę wypełnić wszystkie pola';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Podany adres e-mail jest niepoprawny';
    }

    if ($checkLogin[0] > 0) {
        $errors[] = 'Ten login jest już zajęty';
    }
    if ($checkEmail[0] > 0) {
        $errors[] = 'Ten e-mail jest już używany';
    }

    if ($password != $passwordVerify) {
        $errors[] = 'Podane hasła się nie zgadzają';
    }
    if ($email != $emailVerify) {
        $errors[] = 'Podane adresy e-mail się nie zgadzają';
    }

    // Jeśli wystąpiły jakieś błędy, to je pokaż
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<p class="error">' . $error . '</p>';
        }
    } else {
        $password = md5($password);
        $hash = md5(rand(0, 1000));
        $result = $conn->query("INSERT INTO users (login, name, surname, password, email, hash) VALUES('$login', '$name', '$surname','$password', '$email', '$hash')");
         if (!$result) {
            echo '<p class="error">Wystąpił błąd przy rejestrowaniu użytkownika.<br>'.$conn->error.'</p>';
            Header("Refresh: 1; URL = index.php");
        } else {
        
        echo "Login: " . $_POST['login'];
        echo "<br>";
        echo "Name: " . $_POST['name'];
        echo "<br>";
        echo "Surame: " . $_POST['surname'];
        echo "<br>";
        echo "Pasword: " . $_POST['password'];
        echo "<br>";
        echo "Password_v: " . $_POST['password_v'];
        echo "<br>";
        echo "Email: " . $_POST['email'];
        echo "<br>";
        echo "Email_v: " . $_POST['email_v'];
        echo "<br>";
        echo "md5: " . $password;
        echo "<br>";
        echo "hash: " . $hash;
        $do     = $email;
$temat = 'Potwierdzenie rejestracji';
$tresc = '
 
Dziekujemy za rejestracje!
Bedziesz mogl sie zalogowac na swoje konto po aktywacji.
W celu aktywacji konta przepisz ponizszy kod aktywacyjny. 
 
------------------------
Login: '.$login.'
Haslo: '.$password.'
------------------------
 
'.$hash.'
 
';
                     
$nadawca = 'From:admin' . "\r\n";
//mail($do, $temat, $tresc, $nadawca);
echo '<p>Pomyslnie utworzono konto.Nastapi przejscie do strony glownej.</p>'; 
Header("Refresh: 1; URL = index.php");
        }}
}
?>
    </body>
</html>