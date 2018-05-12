<?php
ob_start();
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if (empty($_COOKIE['islogged'])) {
    if (isset($_SESSION['login'])) {
        session_unset();
        Header("Refresh: 2; URL = login.php");
    }
}
?>