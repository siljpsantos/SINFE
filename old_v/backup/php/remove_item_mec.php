<?php

	include "conection.php";
	include "querys.php";
	
	echo '<pre>';
	//print_r($_POST);
	//echo '</pre>';
	
	$info = $_POST;
	
	print_r($info);
	
	$produto = $pdo->query("SELECT * FROM tab_item_nfe WHERE id_item = '".$info['id']."' ");
	$produto = $produto->fetchAll();

	/*ativar para cadastrar clientes*/
	remove_item($pdo,$info['id']);

	$update = $pdo->query("UPDATE tab_nfe SET val_total_nfe = val_total_nfe - ".$produto[0]['val_total']." WHERE id_nfe = '".$info['id_nfe']."' ");
	
	header('Location: ../cadastra_venda_pos_form.php?id='.$info['id_nfe']);
	
?>