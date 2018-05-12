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
        $categories = mysqli_query($conn, "SELECT *  FROM categories")
                or die('Categories error');
        if (mysqli_num_rows($categories) > 0) {
            while ($cat_row = $categories->fetch_assoc()) {
                echo "<a href='category.php?id=" . $cat_row['id'] . "'>" . $cat_row['name'] . "</a><br>";
            }
        }
        $conn->close();
        echo md5("speedpower21");
        ?>
        <BR><BR>
        <a href="newtopicform.php">New topic</a>
       <!-- <form method="post" action="some_page" class="inline">
  <input type="hidden" name="extra_submit_param" value="extra_submit_value">
  <button type="submit" name="submit_param" value="submit_value" class="link-button">
    This is a link that sends a POST request
  </button>
</form>-->
    </body>
</html>
<?php ob_end_flush(); ?>