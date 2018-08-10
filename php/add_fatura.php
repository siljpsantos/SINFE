<?php

	include "conection.php";
	include "querys.php";
	
	$info = $_POST;
	
	$fat = fat_nfe($pdo,$info['id_nfe']);
	
	//gera numeração da fatura
	$cont = count($fat);
	$info['num_fat_fin'] = str_pad(($cont+1), 3, '0', STR_PAD_LEFT);
	
	//formata a data
	//$data = explode("/",$info['vencimento']);
	//$info['vencimento'] = $data[2]."-".$data[1]."-".$data[0];
	
	//formata o valor
	$info['valor'] = str_replace(",", ".", $info['valor']);
	
	print_r($info);
	
	add_fat($pdo,$info);
	
	header('Location: ../cadastra_venda_pos_nfe_form.php?id='.$info['id_nfe']);
	
?>
