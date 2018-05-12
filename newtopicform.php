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
        <form action='newtopic.php' method='post'><br>
        <?php
        if(isset($_SESSION)&&(isset($_COOKIE['islogged']))){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Błąd polączenia");
}
echo "<input type='text' name='title' placeholder='title' required><br>";
$categories = mysqli_query($conn, "SELECT *  FROM categories")
        or die('Categories error');
if (mysqli_num_rows($categories) > 0) {
    echo "<select name='category'>";
    while ($cat_row = $categories->fetch_assoc()) {
        echo "<option value='".$cat_row["id"]."' selected>".$cat_row["name"]."</option>";
    }
    echo "</select>";
}
echo "<br><textarea name='content' required>content</textarea>";
        echo "<br>";
        echo "<input type='submit' value=add topic>";
        $conn->close();}
        else {
        echo "Aby utworzyc post zaloguj sie badz zarejestruj.";    
            
        }
?>
</body>
</html>