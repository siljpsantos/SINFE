<?php

require_once '../nfephp/bootstrap.php';

include "conection.php";	
include "querys.php";

use NFePHP\NFe\ToolsNFe;

$nfe = new ToolsNFe('../nfephp/config/config.json');

$cert = $_GET['assinatura'];

$xml = xml_venda($pdo,$_GET['id']);
@$chave = $xml[0]['chave_xml'];

//----------------nota já transmitida
if($xml[0]['transmitido_xml'] != 1){
	
	//----------------nota não existente
	if($xml != array()){
		
		//---------------certificado A1
		//if($cert == 'A1'){
			$filename = "../nfephp/xmls/NF-e/producao/entradas/{$chave}-nfe.xml"; // Ambiente Windows
			$xml = file_get_contents($filename);
			$xml = $nfe->assina($xml);
			$filename = "../nfephp/xmls/NF-e/producao/assinadas/{$chave}-nfe.xml"; // Ambiente Windows
			file_put_contents($filename, $xml);
			chmod($filename, 0777);
			
			$info['chave'] = $chave;
			$info['xml'] = $xml;
			$info['assinado'] = 1;
			
			assina_xml($pdo, $info);
			
			echo "<script>alert('Nota Assinada com sucesso!');</script>";
		//}
	}else{
		echo "<script>alert('Nota Não Existente!');</script>";
	}

}else{
	echo "<script>alert('Nota já Transmitida! Faça outra Nota');</script>";
}