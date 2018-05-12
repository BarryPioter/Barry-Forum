<?php
ob_start();
session_start();
require_once 'dbconnect.php';
require_once 'check.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <a href="index.php">Index</a>
        <a href="logform.php">Zaloguj</a>
        <a href="regform.php">Zarejestruj</a>
        <br><br>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "forum";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Błąd polączenia");
        }
        $post = mysqli_query($conn, "SELECT login, name, surname, email FROM users WHERE id = " . $_GET['id'])
                or die('post error');
        if (mysqli_num_rows($post) > 0) {
            while ($post_row = $post->fetch_assoc()) {
                echo "<h1>Login: " . $post_row['login'] . "</h1>";
                echo "<h3>Imie: " . $post_row['name'] . "</h3>";
                echo "<h3>Nazwisko: " . $post_row['surname'] . "</h3>";
                echo "<h3>Email: " . $post_row['email'] . "</h3>";
            }
        }
        ?>
    </body>
</html>