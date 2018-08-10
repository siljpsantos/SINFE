<?php

	include "conection.php";
	include "querys.php";
	
	echo '<pre>';
	//print_r($_POST);
	//echo '</pre>';
	
	$info = $_POST;
	
	//traz o valor unitario do item selecionado
	$produto = produto_view_1($pdo,$info['id_produto']);
	
	$info['val_unit'] = $produto[0]['valor_produto'];
	$info['val_total'] = $info['val_unit']*$info['qtd_item'];
	
	print_r($info);

	/*ativar para cadastrar itens*/
	add_item($pdo,$info);
	
	$tot = $info['val_total']-$info['val_desc'];
	
	$update = $pdo->query("UPDATE tab_nfe SET val_total_nfe = val_total_nfe + ".$tot." WHERE id_nfe = '".$info['id_nfe']."' ");
	
	
	header('Location: ../cadastra_venda_pos_nfe_form.php?id='.$info['id_nfe'].'#itens');
	
?>