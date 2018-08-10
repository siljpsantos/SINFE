<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

error_reporting(0);
ini_set('display_errors', 0);

require "../nfephp/vendor/autoload.php";

use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;

//jsons de config
$configJson = file_get_contents('../nfephp/config/config.json');
$certJson = json_decode(file_get_contents('../nfephp/config/cert.json'), true);

//certificado A1
$cert = file_get_contents('../nfephp/certs/' . $certJson['certPfxName']);
$tools = new NFePHP\NFe\Tools($configJson, Certificate::readPfx($cert, $certJson['certPassword']));

$venda = venda_view_1($pdo,$_GET['id']);
$tools->model($modelo = $venda[0]['modelo_nfe']);

$recibo = $nrec;
$aResposta = array();
$tpAmb = TP_AMB;
$retorno_a = $tools->sefazConsultaRecibo($recibo, $tpAmb);

$simple = $retorno_a;
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

if($modelo ==55){
	@$cstat_ok = $vals[19]['value'];
	@$xmotivo_ok = $vals[20]['value'];

	@$cstat_n = $vals[18]['value'];
	@$xmotivo_n = $vals[19]['value'];

	@$protocolo = $vals[17]['value'];
}else{
	@$cstat_ok = $vals[19]['value'];
	@$xmotivo_ok = $vals[20]['value'];

	@$cstat_n = $vals[18]['value'];
	@$xmotivo_n = $vals[19]['value'];

	@$protocolo = $vals[17]['value'];
}

sleep(1);
if($cstat_ok=='100' || $cstat_ok=='104'){
	echo "<center><h3>RESPOSTA VINDA DA SEFAZ</h3></center>\n<br />"; 
	echo "<center><font color=green>RESPOSTA: ".$cstat_ok." - ".$xmotivo_ok."</font></center>\n";
	echo '</pre>';	
}else{
	echo "<center><h3>RESPOSTA VINDA DA SEFAZ</h3></center>\n<br />"; 
	echo "<center><font color=red>RESPOSTA: ".$cstat_n." - ".$xmotivo_n."</font></center>\n";
	echo '</pre>';	
}

require "add protocolo.php";
