<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../nfephp/bootstrap.php';

use NFePHP\NFe\ToolsNFe;

$nfe = new ToolsNFe('../nfephp/config/config.json');

$indSinc = '0'; //0=asíncrono, 1=síncrono
$recibo = $aResposta['nRec'];
$protocolo = $aResposta['aProt'][0]['nProt'];

$ind_prot = $aResposta['aProt'][0]['cStat'];

//$venda = venda_view_1($pdo,$_POST['id_nfe']);

if($ind_prot == 100){
	
	$aResposta = array();
	
	$pathNFefile = $xml;
	if (! $indSinc) {
	    $pathProtfile = "../nfephp/xmls/NF-e/producao/temporarias/".date('Ym')."/{$recibo}-retConsReciNFe.xml";
	} else {
	    $pathProtfile = "../nfephp/xmls/NF-e/producao/temporarias/".date('Ym')."/{$recibo}-retEnviNFe.xml";
	}
	$saveFile = true;
	$retorno = $nfe->addProtocolo($pathNFefile, $pathProtfile, $saveFile);
	
	$venda = venda_view_1($pdo,$_GET['id']);
	
	$xml = xml_venda($pdo,$_GET['id']);
	$chave = $xml[0]['chave_xml'];
	
	$filename = "../nfephp/xmls/NF-e/producao/enviadas/aprovadas/".date('Ym')."/{$chave}-protNFe.xml"; // Ambiente Windows
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
	
	
	echo "<script>alert('Nota Transmitida com sucesso!');</script>";

}else{
	$xml = xml_venda($pdo,$_GET['id']);
	$chave = $xml[0]['chave_xml'];
	//echo $chave;
	
	$update = $pdo->query("UPDATE tab_xml SET rejeitado_xml = 1 WHERE chave_xml = '".$chave."' ");
	
	echo "<script>alert('Sua Nfe contém erros!');</script>";
}





