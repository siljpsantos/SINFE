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
	
	add_entrega($pdo,$info);
	
	$entrega = get_last_entrega($pdo);
	
	venda_entrega($pdo,$entrega[0]['id_entrega'],$info['venda']);
	
	echo "<script>alert('Local registrado com Sucesso!');</script>";
	
?>