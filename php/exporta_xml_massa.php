<?php
	
	include "../_app/Config.inc.php";

	$venda_all = venda_mensal_nfce($pdo,$_POST['mes']); //seleciona todas as vendas do mes
	
	$dir = date('d.m.Y_h.i.s');
	mkdir(CUR_USER . "\NFCE\NFCE_MES\backup-nfce-$dir", 0777);
	$dir = CUR_USER . "\NFCE\NFCE_MES\backup-nfce-".$dir;
	
	foreach($venda_all as $key){
		
		$select = $pdo->query("SELECT * FROM tab_xml WHERE id_venda = '".$key['id_nfe']."' ");
		$select = $select->fetchAll();
        
        if($select !== array()){
            
            $dom = new DOMDocument;
            $dom->preserveWhiteSpace = FALSE;
            $dom->loadXML($select[0]['conteudo_xml']);

            $dom->save($dir."\\".$select[0]['chave_xml'].'-backupNfe.xml');
            
        }
		
	}
	
	header('Location: ../venda_lista_nfce.php');
	
?>