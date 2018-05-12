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
        <?php
        if(isset($_SESSION)&&(isset($_COOKIE['islogged']))){
        echo "<a href='user.php'>Uzytkownik</a>";
        echo "<a href='logout.php'>Wyloguj</a>";
        if($_SESSION['admin']==1){
        echo "<a href='admin.php'>Admin</a>";
         }}
         else
         {
        echo "<a href='logform.php'>Zaloguj</a>";
        echo "<a href='regform.php'>Zarejestruj</a>";
         }
                ?>
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
        $cat = mysqli_query($conn, "SELECT name FROM categories where id=" . $_GET['id'])
                or die('cat error');
        if (mysqli_num_rows($cat) > 0) {
            while ($cat_row = $cat->fetch_assoc()) {
                echo "<h1>".$cat_row['name']."</h1><br>";
            }
        }
        $topics = mysqli_query($conn, "SELECT *  FROM topics where id_category=" . $_GET['id'])
                or die('topics error');
        if (mysqli_num_rows($topics) > 0) {
            while ($top_row = $topics->fetch_assoc()) {
                echo "<a href='post.php?id=" . $top_row['id'] . "'>" . $top_row['title'] . "</a><br>";
            }
        }
        $conn->close();
        ?>
    </body>
</html>