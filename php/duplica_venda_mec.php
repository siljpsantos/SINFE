<?php

	include "conection.php";
	include "querys.php";
	
	$info = $_POST;
	
	$item = itens_venda($pdo,$info['id_nfe']);
	
	//echo '<pre>';
	//print_r($_POST);
	//echo '</pre>';
	
	$select = $pdo->query("SELECT id_nfe FROM tab_nfe ORDER BY id_nfe DESC LIMIT 1");
	$select = $select->fetchAll();
	
	$num = $select[0]['id_nfe']+1;
	
	//echo "<pre>";
	//print_r($select);

	$duplica = $pdo->query("
	
		CREATE TEMPORARY TABLE tmp SELECT * FROM tab_nfe WHERE id_nfe = ".$info['id_nfe'].";

		UPDATE tmp SET id_nfe=".$num.", data_emis_nfe=NOW(), data_hora_saida_entrada_nfe=NOW() WHERE id_nfe = ".$info['id_nfe'].";
		
		INSERT INTO tab_nfe SELECT * FROM tmp;
		
		DROP TABLE tbm;
	");
	
	unset($duplica);
	
	foreach($item as $key){
		
		$select_2 = $pdo->query("SELECT id_item FROM tab_item_nfe ORDER BY id_item DESC LIMIT 1");
		$select_2 = $select_2->fetchAll();
		
		$num_i = $select_2[0]['id_item']+1;
		
		$duplica_i = $pdo->query("
	
			CREATE TEMPORARY TABLE tmp2 SELECT * FROM tab_item_nfe WHERE id_item = ".$key['id_item'].";
	
			UPDATE tmp2 SET id_item=".$num_i.", id_nfe=".$num." WHERE id_item = ".$key['id_item'].";
			
			INSERT INTO tab_item_nfe SELECT * FROM tmp2;
			
			DROP TABLE tbm2;
		");
		
		unset($duplica_i);
		
	}
	
    //echo "<script>alert('Venda Duplicada!');window.location.href='../venda_lista.php';</script>";
    echo "<script>alert('Venda Duplicada!');window.history.go(-1);</script>";
	
?>
