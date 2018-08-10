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
	
	//preenche checkbox ICMS nula
	if (!isset($info['isencao_icms'])){
		$info['icms'] = "nao";
	}
	
	//print_r($info);
	
	add_transp($pdo,$info);
	
	header('Location: ../transp_lista.php');
	
?>
