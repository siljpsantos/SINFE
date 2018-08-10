<?php

	include "conection.php";
	include "querys.php";
	
	echo '<pre>';
	//print_r($_POST);
	echo '</pre>';
	
	$info = $_POST;
	
	edita_venda($pdo,$info);
	
	header('Location: ../cadastra_venda_pos_nfe_form.php?id='.$info['id_nfe']);
	
?>