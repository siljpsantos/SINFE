<?php

	include "conection.php";
	include "querys.php";

	$info = $_POST;
	
	//print_r($info);
	
	add_nref($pdo,$info);
	
	header('Location: ../cadastra_venda_pos_nfe_form.php?id='.$info['id_nfe']);
	
?>
