<?php

	include "conection.php";	
	include "querys.php";
	
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	
	//vota($pdo, $_POST['atacante']);
	//vota($pdo, $_POST['goleiro']);
	//vota($pdo, $_POST['zagueiro']);
	//vota($pdo, $_POST['lateral_direito']);
	//vota($pdo, $_POST['lateral_esquerdo']);
	
	
	$escola = $_POST['escola'];
	header('Location: ../fechamento.php?escola='.$escola); 
	

?>