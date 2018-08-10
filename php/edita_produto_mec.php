<?php

	include "conection.php";
	include "querys.php";
	
	//echo '<pre>';
	//print_r($_POST);
	//echo '</pre>';
	
	$info = $_POST;
	
	print_r($info);
	
	edita_produto($pdo,$info);
	$id = get_last_ordem($pdo);
	
	header('Location: ../produto_lista.php');
	
?>