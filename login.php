<?php
ob_start();
session_start();
require_once 'dbconnect.php';
require_once 'check.php';
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <link href="css/style.css" rel="stylesheet">
        <meta charset="UTF-8">
        <title>Forum</title>
        </head>
        <body>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
                $login = $_POST['login'];
                $password = $_POST['password'];

                if (empty($login) || empty($password)) {
                    return '<p>Wypelnij wszystkie dane.</p>';
                } else {
                    if (file_exists('dbconnect.php')) {
                        include_once('dbconnect.php');
                    } else {
                        return 'Brak pliku laczacego.';
                    }
                    if ($conn->connect_error) {
                        return '<p>Problem z polaczeniem sie z baza danych:' . $conn->connect_error . '[' . $conn->connect_errno . ']</p>';
                    } else {
                        $login = trim(strip_tags($conn->real_escape_string($login)));
                        $password = trim(strip_tags($conn->real_escape_string($password)));
                        $password = md5($password);
                        $result = $conn->query("SELECT login, active, id ,admin FROM users WHERE login = '$login' and password = '$password'");
                        
                        if (mysqli_num_rows($result) == 1) {
                            $row = $result->fetch_assoc();
                            if ($row['active'] == 1) {
                                $_SESSION['id'] = $row['id'];
                                $_SESSION['login'] = $row['login'];
                                setcookie('islogged', 'islogged', time() + 600);
                                if ($row['admin'] == 1) {
                                    $_SESSION['admin'] = 1;
                                    header('Location: index.php');
                                } else {
                                    header('Location: index.php');
                                }
                            }
                        } else {
                            echo '<p>Brak podanego uzytkownika w bazie lub nie jest on aktywowany.</p>';
                        }
                    }
                }
            }
            ?>
        </body>
    </html>
    <?php ob_end_flush(); ?>
