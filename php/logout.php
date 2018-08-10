<?php
	
	session_start();
	session_destroy();
	$_SESSION = array();
	
	echo "<script type=\"text/javascript\">alert('Obrigado por usar o nosso Sistema!');";
	echo "javascript:window.location='../index_login.php';</script>";
	
	
	
?>