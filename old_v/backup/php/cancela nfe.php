<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../nfephp/bootstrap.php';

use NFePHP\NFe\ToolsNFe;

include "conection.php";	
include "querys.php";

$nfe = new ToolsNFe('../nfephp/config/config.json');
$nfe->setModelo('55');

echo '<pre>';
//print_r($_POST);
echo '</pre>';

$xml = xml_venda($pdo,$_GET['id_nfe']);
$venda = venda_view_1($pdo,$_GET['id_nfe']);

$data_nfe = new DateTime($venda[0]['data_emis_nfe']);
$data_expira = $data_nfe->add(new DateInterval('P1D'));
$data_atual = new DateTime(); 

if($data_expira > $data_atual){
	
	$aResposta = array();
	$chave = $xml[0]['chave_xml'];
	$nProt = $xml[0]['protocolo_xml'];
	$tpAmb = '2';
	$xJust = $_GET['motivo'];
	$retorno = $nfe->sefazCancela($chave, $tpAmb, $xJust, $nProt, $aResposta);
	
	$update = $pdo->query("UPDATE tab_xml SET cancelado_xml = 1 WHERE chave_xml = '".$chave."' ");
	
	echo "<script>alert('Nota Cancelada com Sucesso!');</script>";
	
}else{
	echo "<script>alert('Data de cancelamento expirada!');</script>";
}

