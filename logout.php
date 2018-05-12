<?php
	session_start();
	
	session_unset();
	setcookie('islogged', 'islogged', time()-3600);
	header('Location: index.php');
?>