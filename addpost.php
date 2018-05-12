<?php
ob_start();
session_start();
require_once 'dbconnect.php';
require_once 'check.php';
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Błąd polączenia");
}
$add = mysqli_query($conn, "INSERT INTO posts (id_topic,id_user,post) VALUES (" . $_GET["id"] . ",".$_SESSION['id'].",'" . $_POST['post'] . "')") 
        or die('adding error');

header("Location: post.php?id=" . $_GET["id"]);
?>