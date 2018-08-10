<?php

	include "conection.php";
	include "querys.php";
	
	//print_r($info);
	
	delete_nref($pdo,$_POST['id']);
	
	header('Location: ../cadastra_venda_pos_nfe_form.php?id='.$_POST['id_nfe']);
	
?>
