<?php

require_once '../nfephp/bootstrap.php';

include "conection.php";	
include "querys.php";

use NFePHP\NFe\MakeNFe;
use NFePHP\NFe\ToolsNFe;

$nfe = new ToolsNFe('../nfephp/config/config.json');
$nfe->setModelo('55');

$emitente = emitente($pdo);
$ok = 1;
$primeiro = 1;

for ($i=$_POST['ini'];$i<=$_POST['fin'];$i++) { 
	
	$src = "<nNF>".$i."</nNF>";
	$select = $pdo->query("SELECT * FROM tab_xml WHERE conteudo_xml LIKE '%".$src."%' ");
	$select = $select->fetchAll();
	
	if($primeiro==1){
		
		$primeiro = 0;
		
		for ($j=$_POST['ini'];$j<=$_POST['fin'];$j++) {
			
			if($select[0]['inutilizado_xml']!=0){
				
				$ok = 0;	
			}
		}
	}
	
	if($ok==1){
		$update = $pdo->query("UPDATE tab_xml SET inutilizado_xml = 1 WHERE id_xml = '".$select[0]['id_xml']."' ");
	}
}

if($ok==1){
	
	$aResposta = array();
	$nSerie = (int)(($emitente[0]['n_nota_emitente']+1)/10000)+1;
	$nIni = $_POST['ini'];
	$nFin = $_POST['fin'];
	$xJust = $_POST['motivo'];
	$tpAmb = '2';
	$xml = $nfe->sefazInutiliza($nSerie, $nIni, $nFin, $xJust, $tpAmb, $aResposta);
	
	echo "<script>alert('Faixa inutilizada!');window.location.href='../venda_lista.php';</script>";
}else{
	
	echo "<script>alert('Nota(s) da faixa já inutilizadas!');window.location.href='../venda_lista.php';</script>";	
}

