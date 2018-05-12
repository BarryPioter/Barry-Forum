<?php
ob_start();
session_start();
require_once 'dbconnect.php';
require_once 'check.php';

$add = $conn->query("INSERT INTO topics (id_category,id_user,title,content) VALUES (" . $_POST["category"].",".$_SESSION['id'].",'". $_POST['title'] . "','".$_POST['content']."')");
 if (!$add) {
            echo '<p class="error">Wystąpił błąd przy tworazeniu topicu.<br>'.$conn->error.'</p>';
            Header("Refresh: 5; URL = index.php");
 }
 else {
echo '<p>Nowy temat utworzony poprawnie</p>';
Header("Refresh: 1; URL = category.php?id=".$_POST["category"]);
 }

?>