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
        <div id='user_data'>
             <h3>User Data</h3>
        <?php
        $data = $conn->query("SELECT login, name, surname, email FROM users WHERE id = " . $_SESSION['id']);
 if (!$data) {
            echo '<p class="error">Wystąpił błąd przy pobieraniu danych uzytkownika.<br>'.$conn->error.'</p>';
            Header("Refresh: 5; URL = index.php");
 }
 else {
if (mysqli_num_rows($data) == 1) {
            while ($data_row = $data->fetch_assoc()) {
                echo "<h1>Login: " . $data_row['login'] . "</h1>";
                echo "<h3>Imie: " . $data_row['name'] . "</h3>";
                echo "<h3>Nazwisko: " . $data_row['surname'] . "</h3>";
                echo "<h3>Email: " . $data_row['email'] . "</h3>";
            }
        }
        else {
        echo "<p>Brak danych uzytkownika.</p>";   
        }
 }
        ?>    
        </div>
        <div id='user_topics'>
            <h3>User Topics</h3>
         <?php
        $topic = $conn->query("SELECT id, title, date FROM topics WHERE id_user = " . $_SESSION['id']);
 if (!$topic) {
            echo '<p class="error">Wystąpił błąd przy pobieraniu danych uzytkownika.<br>'.$conn->error.'</p>';
            Header("Refresh: 5; URL = index.php");
 }
 else {
if (mysqli_num_rows($topic) > 0) {
            while ($topic_row = $topic->fetch_assoc()) {
                echo "<a style='display:block' href='post.php?id=".$topic_row['id']."'>";
                echo "<p>".$topic_row['title']."   ".$topic_row['date']."</p></a>";
            }
        }
        else {
        echo "<p>Brak tematow uzytkownika.</p>";      
        }
 }
        ?>  
        </div>
        <div id="user_posts">
             <h3>User Posts</h3>
          <?php
        $post = $conn->query("SELECT t.title, p.id_topic, p.post, p.date FROM posts p, topics t WHERE p.id_topic=t.id and p.id_user = " . $_SESSION['id']);
 if (!$post) {
            echo '<p class="error">Wystąpił błąd przy pobieraniu danych uzytkownika.<br>'.$conn->error.'</p>';
            Header("Refresh: 5; URL = index.php");
 }
 else {
if (mysqli_num_rows($post) > 0) {
            while ($post_row = $post->fetch_assoc()) {
                echo "<a style='display:block' href='post.php?id=".$post_row['id_topic']."'>";
                echo "<p>".$post_row['title']."<br>";
                echo $post_row['post']."   ".$post_row['date']."</p></a>";
            }
        }
        else {
        echo "<p>Brak postow uzytkownika.</p>";     
        }
 }
        ?>  
        </div>
    </body>
</html>