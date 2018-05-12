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
        $post = mysqli_query($conn, "SELECT t.title, t.content, t.date, u.login, u.id as uid, c.name FROM users u, topics t, categories c WHERE t.id_category = c.id and t.id_user = u.id and t.id = " . $_GET['id'])
                or die('topic error');
        if (mysqli_num_rows($post) > 0) {
            while ($post_row = $post->fetch_assoc()) {
                echo "<h1>Tytul: " . $post_row['title'] . "</h1>";
                echo "<h3>Tworca:<a href='member.php?id=" . $post_row['uid'] . "'>" . $post_row['login'] . "</a></h3>";
                echo "<h3>Kategoria: " . $post_row['name'] . "</h3>";
                echo "<h3>Data utworzenia: " . $post_row['date'] . "</h3>";
                echo "<h4>Tresc: " . $post_row['content'] . "</h4>";
            }
        }
        $post = mysqli_query($conn, "SELECT p.id, p.post, p.date, u.login, u.id as uid FROM users u, posts p WHERE p.id_user = u.id and p.id_topic = " . $_GET['id'])
                or die('post error');
        if (mysqli_num_rows($post) > 0) {
            while ($post_row = $post->fetch_assoc()) {
                echo "<div><p><a href='member.php?id=" . $post_row['uid'] . "'>" . $post_row['login'] . "</a> ";
                echo $post_row['date'] . " <a href='delpost?id=" . $post_row['id'] . "'><img src='pics/delete.png'></a></p>";
                echo "<p>" . $post_row['post'] . "</p></div>";
            }
        }
        $conn->close();
        echo "<form action='addpost.php?id=" . $_GET['id'] . "' method='post'><br>";
        echo "<textarea name='post' placeholder='tresc posta' required></textarea>";
        echo "<br>";
        echo "<input type='submit' value=Odpowiedz>";
        ?>
    </body>
</html>