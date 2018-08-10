<?php
	
	include "../_app/Config.inc.php";
	
	$select = $pdo->query("SELECT * FROM tab_xml WHERE id_venda = '".$_POST['id_nfe']."' ");
	$select = $select->fetchAll();
	
	$dom = new DOMDocument;
	$dom->preserveWhiteSpace = FALSE;
	$dom->loadXML($select[0]['conteudo_xml']);
	
	$dom->save(CUR_USER . '\NFE\\' . $select[0]['chave_xml'] . '-backupNfe.xml');
	
	header('Location: ../cadastra_venda_pos_nfe_form.php?id='.$_POST['id_nfe']);
	
?>