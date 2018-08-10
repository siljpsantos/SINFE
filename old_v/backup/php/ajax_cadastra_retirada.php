<?php

	include "conection.php";
	include "querys.php";
	
	$mun = explode("|",$_GET['mun']);	
	$info = $_GET;
	$info['mun'] = $mun[1];
	$info['cod_mun'] = $mun[0];
	
	echo '<pre>';
	//print_r($info);
	echo '</pre>';
	
	add_retirada($pdo,$info);
	
	$retirada = get_last_retirada($pdo);
	
	venda_retirada($pdo,$retirada[0]['id_retirada'],$info['venda']);
	
	echo "<script>alert('Local registrado com Sucesso!');</script>";
	
?>