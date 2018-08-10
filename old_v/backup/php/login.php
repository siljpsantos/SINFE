<?php
	
	include "conection.php";
	include "querys.php";
	
	$resp = login($pdo,$_POST['login'],$_POST['senha']);
	
	if($resp == 1){
		echo "<script type=\"text/javascript\">alert('Bem vindo(a) ".$_POST['login']."');";
		
		session_start();
		$_SESSION['user'] = $_POST['login'];
		$_SESSION['tempo'] = time() + (60 *5);
		
		echo "javascript:window.location='../index_index.php';</script>";
	}else{
		header("location:../index_login.php?resp=".$resp);
	}
	
?>