<?php

require_once '../nfephp/bootstrap.php';

include "../_app/Config.Inc.php";

use NFePHP\NFe\ToolsNFe;

$venda = venda_view_1($pdo,$_GET['id']);

$nfe = new ToolsNFe('../nfephp/config/config.json');
$nfe->setModelo($venda[0]['modelo_nfe']);

$xml_q = xml_venda($pdo,$_GET['id']);
@$chave = $xml_q[0]['chave_xml'];

//----------------nota já transmitida
if($xml_q[0]['transmitido_xml'] != 1){
	//----------------nota não existente
	if($xml_q != array()){
		//----------------nota não assinada
		if($xml_q[0]['assinado_xml'] == 1){
			//----------------nota não válida
			if($xml_q[0]['valido_xml'] == 1){
	
				$filename = "../nfephp/xmls/NF-e/" . TP_AMB_N ."/assinadas/{$chave}-nfe.xml"; // Ambiente Windows
				$xml = file_get_contents($filename);
				
				$aResposta = array();
				$tpAmb = TP_AMB;
				$aXml = $xml; 
				$idLote = '';
				$indSinc = '0';
				$flagZip = false;
				
				$retorno = $nfe->sefazEnviaLote($aXml, $tpAmb, $idLote, $aResposta, $indSinc, $flagZip);
				
				//echo '<pre>';
				//print_r($aResposta);
				
				require "consulta recibo.php";
				
			}else{
				echo "<script>alert('Nota Não Não é Válida!');</script>";
			}
		
		}else{
			echo "<script>alert('Nota Não Assinada!');</script>";
		}
	}else{
		echo "<script>alert('Nota Não Existente!');</script>";
	}

}else{
	echo "<script>alert('Nota já Transmitida! Faça outra Nota');</script>";
}
	