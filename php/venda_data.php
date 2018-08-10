<?php
	
	include "conection.php";
	include "querys.php";
	
	//$info = $_POST['dmes'];
	
	$regex = '/^[0-9]{2}\\/[0-9]{4}$/';
		
	if(!preg_match($regex,$_POST['mes'])){
		header('location:../relatorio_lista.php');
		exit;
	}
	
	$venda = venda_mensal($pdo,$_POST['mes']);
	
	print_r($venda);
	
	//header('location:../relatorio_mensal_lista.php?id='.$_POST['mes']);
	
	
?>