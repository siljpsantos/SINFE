<?php

	include "conection.php";
	include "querys.php";
	
	//echo '<pre>';
	//print_r($_POST);
	//echo '</pre>';
	
	$info = $_POST;
	
	echo '<pre>';
	print_r($info);

	/*ativar para cadastrar produtos*/
	add_produto($pdo,$info);
	header('Location: ../produto_lista.php');
?>