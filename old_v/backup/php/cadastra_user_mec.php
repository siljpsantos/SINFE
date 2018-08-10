<?php
	
	include "conection.php";
	include "querys.php";
	
	$info = $_POST;
	
	if($_POST['master'] == "master"){
		add_user($pdo,$info);
		echo "<script type=\"text/javascript\">alert('Usuário adicionado com sucesso.');";
		echo "javascript:window.location='../index_login.php';</script>";
	}else{
		echo "<script type=\"text/javascript\">alert('Senha master incorreta.');";
		echo "javascript:window.location='../cadastra_user_form.php';</script>";
	}
	
	
	
	

?>