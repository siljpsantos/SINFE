<?php
	
	include "conection.php";
	include "querys.php";
	
	$select = $pdo->query("SELECT * FROM tab_xml WHERE id_venda = '".$_POST['id_nfe']."' ");
	$select = $select->fetchAll();
	
	echo '<pre>';
	//print_r($select);
	echo '</pre>';
	
	$dom = new DOMDocument;
	$dom->preserveWhiteSpace = FALSE;
	$dom->loadXML($select[0]['conteudo_xml']);
	
	$dom->save('C:\Users\recepcaoiw\Desktop\/'.$select[0]['chave_xml'].'-backupNfe.xml');
	
	header('Location: ../cadastra_venda_pos_form.php?id='.$_POST['id_nfe']);
	
?>