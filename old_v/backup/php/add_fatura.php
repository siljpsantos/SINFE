<?php

	include "conection.php";
	include "querys.php";
	
	$info = $_POST;
	
	$fat = fat_nfe($pdo,$info['id_nfe']);
	
	//gera numeração da fatura
	$cont = count($fat);
	$info['num_fat_fin'] = $info['num_fat']."-".($cont+1);
	
	//formata a data
	$data = explode("/",$info['vencimento']);
	$info['vencimento'] = $data[2]."-".$data[1]."-".$data[0];
	
	//formata o valor
	$info['valor'] = str_replace(",", ".", $info['valor']);
	
	//print_r($info);
	
	add_fat($pdo,$info);
	
	header('Location: ../cadastra_venda_pos_nfe_form.php?id='.$info['id_nfe']);
	
?>
