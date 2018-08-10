<?php

error_reporting(0);
ini_set('display_errors', 0);

require "../_app/Config.inc.php";
require "../nfephp/vendor/autoload.php";

use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;

//jsons de config
$configJson = file_get_contents('../nfephp/config/config.json');
$certJson = json_decode(file_get_contents('../nfephp/config/cert.json'), true);

//certificado A1
$cert = file_get_contents('../nfephp/certs/' . $certJson['certPfxName']);
$tools = new NFePHP\NFe\Tools($configJson, Certificate::readPfx($cert, $certJson['certPassword']));

$xml_q = xml_venda($pdo,$_GET['id']);
@$chave = $xml_q[0]['chave_xml'];

$venda = venda_view_1($pdo,$_GET['id']);
$tools->model($modelo = $venda[0]['modelo_nfe']);

//----------------nota já transmitida
if(@$xml_q[0]['transmitido_xml'] != 1){
	//----------------nota não existente
	if($xml_q != array()){
		//----------------nota não assinada
		if($xml_q[0]['assinado_xml'] == 1){
			//----------------nota não válida
			if($xml_q[0]['valido_xml'] == 1){
	
				$filename = "../nfephp/xmls/NF-e/" . TP_AMB_N ."/assinadas/{$chave}-nfe.xml"; // Ambiente Windows
				//$filename = "./xml/{$chave}-nfe.xml"; // provisório
				$xml = file_get_contents($filename);
				
				$aResposta = array();
				$tpAmb = TP_AMB;
				$aXml = $xml; 
				$idLote = str_pad(100, 15, '0', STR_PAD_LEFT);
				$indSinc = '0';
				$flagZip = false;
				
				$retorno = $tools->sefazEnviaLote([$aXml], $idLote);
				
				$simple = $retorno;
				$p = xml_parser_create();
				xml_parse_into_struct($p, $simple, $vals, $index);
				xml_parser_free($p);
				
				/*
				echo "<pre>";
				echo "Index array\n";
				print_r($index);
				echo "\nVals array\n";
				print_r($vals);
				*/
				
				$nrec = $vals[11]['value'];
				
				//echo '<pre>';
				//echo $vals[6]['value'];
				
                sleep(1);
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
	