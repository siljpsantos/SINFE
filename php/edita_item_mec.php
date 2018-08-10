<?php

	include "conection.php";
	include "querys.php";
	
	echo '<pre>';
	//print_r($_POST);
	//echo '</pre>';
	
	$info = $_POST;
	
	//traz o valor unitario do item selecionado
	$item = item_view_1($pdo,$info['id']);
	
	$info['val_unit'] = $item[0]['val_unit'];
	$info['val_total'] = $info['val_unit']*$info['nova_qtd'];
		
	print_r($info);

	/*ativar para cadastrar clientes*/
	edita_qtd_item($pdo,$info);
	
	header('Location: ../cadastra_venda_pos_form.php?id='.$info['id_nfe']);
	
?>