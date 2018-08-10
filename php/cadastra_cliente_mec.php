<?php

	include "conection.php";
	include "querys.php";
	
	//echo '<pre>';
	//print_r($_POST);
	//echo '</pre>';
	
	$info = $_POST;
	
	$municipio = explode("|",$_POST['municipio']);
	$info['municipio'] = $municipio[1];
	$info['cod_municipio'] = $municipio[0];
	
	//print_r($info);

	/*ativar para cadastrar clientes*/
	add_cliente($pdo,$info);
	header('Location: ../cliente_lista.php');
?>