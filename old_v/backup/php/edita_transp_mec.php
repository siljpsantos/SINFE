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
	
	$uf = explode("|",$_POST['uf']);
	$info['uf'] = $uf[1];
	
	print_r($info);
	
	edita_transp($pdo,$info);
	
	header('Location: ../transp_lista.php');
	
?>