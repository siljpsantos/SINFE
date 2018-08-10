<?php
	
	include "conection.php";
	include "querys.php";
	include "registros.php";
	
	$info = $_POST;
	
	echo "<pre>";
	print_r($info);

	$venda = venda_view_1($pdo,$info['id']);
	
	print_r($venda);
	
	$item = itens_venda($pdo,$info['id']);
	
	print_r($item);
	
	foreach($item as $key){
		
		registra_orcamento($pdo,$key,$venda,$info['total']);
		
	}
	
	header('Location: ../venda_lista.php');

?>