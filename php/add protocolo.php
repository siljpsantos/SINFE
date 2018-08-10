<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

error_reporting(0);
ini_set('display_errors', 0);

require "../nfephp/vendor/autoload.php";

use NFePHP\NFe\Complements;
use NFePHP\Common\Certificate;

//jsons de config
$configJson = file_get_contents('../nfephp/config/config.json');
$certJson = json_decode(file_get_contents('../nfephp/config/cert.json'), true);

//certificado A1
$cert = file_get_contents('../nfephp/certs/' . $certJson['certPfxName']);
$tools = new NFePHP\NFe\Tools($configJson, Certificate::readPfx($cert, $certJson['certPassword']));

$indSinc = '0'; //0=asíncrono, 1=síncrono

if($cstat_ok=='100' || $cstat_ok=='104'){
	
	$protocol = new NFePHP\NFe\Factories\Protocol();
	$xml_f = $protocol->add($aXml,$retorno_a);
    
    sleep(1);
	
	$venda = venda_view_1($pdo,$_GET['id']);
	
	$xml = xml_venda($pdo,$_GET['id']);
	$chave = $xml[0]['chave_xml'];
	
	file_put_contents("../nfephp/xmls/NF-e/" . TP_AMB_N ."/enviadas/aprovadas/".date('Ym')."/{$chave}-protNFe.xml",$xml_f);
	
	$filename = "../nfephp/xmls/NF-e/" . TP_AMB_N ."/enviadas/aprovadas/".date('Ym')."/{$chave}-protNFe.xml"; // Ambiente Windows
	$xml = file_get_contents($filename);
	
	$info['transmitido'] = 1;
	
	//tipo de documento
	if($venda[0]['tipo_documento_nfe'] == 0){
		$info['tipo'] = "Entrada";
	}else if ($venda[0]['tipo_documento_nfe'] == 1){
		$info['tipo'] = "Saída";
	}
	
	//finalidade da emissão
	if($venda[0]['finalidade_emissao_nfe'] == 1){
		$info['finalidade'] = "Normal";
	}else if($venda[0]['finalidade_emissao_nfe'] == 2){
		$info['finalidade'] = "Complementar";
	}else if($venda[0]['finalidade_emissao_nfe'] == 3){
		$info['finalidade'] = "Ajuste";
	}else if($venda[0]['finalidade_emissao_nfe'] == 4){
		$info['finalidade'] = "Devolução/Retorno";
	}
	
	$info['xml'] = $xml;
	$info['chave'] = $chave;
	
	$info['protocolo'] = $protocolo;
	
	edit_xml($pdo, $info);
	$update = $pdo->query("UPDATE tab_xml SET rejeitado_xml = 0 WHERE chave_xml = '".$chave."' ");
	$update_2 = $pdo->query("UPDATE tab_nfe SET data_emis_nfe = NOW() WHERE id_nfe = '".$_GET['id']."' ");
	
	$emitente = emitente($pdo);
	
	if($venda[0]['modelo_nfe']!='65'){
		$update = $pdo->query("UPDATE tab_emitente SET n_nota_emitente = ".$emitente[0]['n_nota_emitente']."+1 ");
	}else{
		$update = $pdo->query("UPDATE tab_emitente SET n_nfce_emitente = ".$emitente[0]['n_nfce_emitente']."+1 ");
	}
	
	echo "<script>alert('Nota Transmitida com sucesso!');location.reload();</script>";

}else{
	$xml = xml_venda($pdo,$_GET['id']);
	$chave = $xml[0]['chave_xml'];
	//echo $chave;
	
	$update = $pdo->query("UPDATE tab_xml SET rejeitado_xml = 1 WHERE chave_xml = '".$chave."' ");
	
	echo "<script>alert('Sua Nfe contém erros!');</script>";
}





