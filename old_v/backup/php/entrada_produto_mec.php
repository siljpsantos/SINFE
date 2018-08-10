<?php

	include "conection.php";
	include "querys.php";
	include "registros.php";
	
	date_default_timezone_set('America/Sao_Paulo'); 
	
	$info = $_POST;
	
	$info['tipo_movimento'] = "entrada";
	
	echo '<pre>';
	print_r($info);

	registra_entrada($pdo,$info);
	header('Location: ../produto_lista.php');
?>

















