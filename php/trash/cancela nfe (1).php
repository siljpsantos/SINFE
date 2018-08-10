<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../nfephp/bootstrap.php';

include "../_app/Config.Inc.php";

use NFePHP\NFe\ToolsNFe;

$nfe = new ToolsNFe('../nfephp/config/config.json');
$nfe->setModelo('65');

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
	$tpAmb = TP_AMB;
	$xJust = $_GET['motivo'];
	$retorno = $nfe->sefazCancela($chave, $tpAmb, $xJust, $nProt, $aResposta);
	
	if($aResposta['cStat']==128){
		if($aResposta['evento'][0]['cStat']==135){
			$update = $pdo->query("UPDATE tab_xml SET cancelado_xml = 1 WHERE chave_xml = '".$chave."' ");
			echo "<script>alert('Nota Cancelada com Sucesso!');</script>";			
		}else{
			echo "<center><h3>RESPOSTA VINDA DA SEFAZ</h3></center>\n<br />"; 
			echo "<center><font color=red>RESPOSTA: ".$aResposta['evento'][0]['cStat']." - ".$aResposta['evento'][0]['xMotivo']."</font></center>\n";
			echo '</pre>';
			echo "<script>alert('Erro no Cancelamento!!');</script>";
		}
	}else{
		echo "<center><h3>RESPOSTA VINDA DA SEFAZ</h3></center>\n<br />"; 
		echo "<center><font color=red>RESPOSTA: ".$aResposta['evento'][0]['cStat']." - ".$aResposta['evento'][0]['xMotivo']."</font></center>\n";
		echo '</pre>';
		echo "<script>alert('Erro no Cancelamento!!');</script>";
	}
	
	//$update = $pdo->query("UPDATE tab_xml SET cancelado_xml = 1 WHERE chave_xml = '".$chave."' ");	
	//echo "<script>alert('Nota Cancelada com Sucesso!');</script>";
	
}else{
	echo "<script>alert('Data de cancelamento expirada!');</script>";
}

