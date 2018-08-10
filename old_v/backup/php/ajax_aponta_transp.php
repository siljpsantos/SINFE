<?php

	include "conection.php";
	include "querys.php";	

	
	$venda = venda_view_1($pdo,$_GET['id']);
	$transp = transp_view_1($pdo,$_GET['id_transp']);
	
	$info = $_GET;
	
	/*
	$info['nome'] = $transp[0]['nome_razao_social_transportadora'];
	$info['cnpj'] = $transp[0]['cnpj_transportadora'];
	$info['logr'] = $transp[0]['logradouro_transportadora'];
	$info['mun'] = $transp[0]['municipio_transportadora'];
	$info['uf_transp'] = $transp[0]['uf_transportadora'];
	$info['ie'] = $transp[0]['inscricao_estadual_transportadora'];
	*/
	
	echo '<pre>';
	//print_r($info);
	echo '</pre>';
	
	aponta_transp($pdo,$info);
	
	echo "<script>alert('Transportadora atrelada com Sucesso!');</script>";
	
?>