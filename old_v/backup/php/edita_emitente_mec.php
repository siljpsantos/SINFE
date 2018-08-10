<?php

	include "conection.php";
	include "querys.php";
	
	$info = $_POST;
	
	$municipio = explode("|",$_POST['municipio']);
	$info['municipio'] = $municipio[1];
	$info['cod_municipio'] = $municipio[0];
	
	$uf = explode("|",$_POST['uf']);
	$info['uf'] = $uf[1];
	
	edita_emitente($pdo,$info);
	
	if($_POST['master'] == "master"){
		
		edita_emitente($pdo,$info);
		
		echo "<script type=\"text/javascript\">alert('Edições Concluídas.');";
		echo "javascript:window.location='../index_index.php';</script>";
		
	}else{
		
		echo "<script type=\"text/javascript\">alert('Senha master incorreta.');";
		echo "javascript:window.location='../config.php';</script>";
		
	}
	
?>