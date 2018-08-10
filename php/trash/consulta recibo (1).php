<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../nfephp/bootstrap.php';

use NFePHP\NFe\ToolsNFe;

$nfe = new ToolsNFe('../nfephp/config/config.json');
$nfe->setModelo($venda[0]['modelo_nfe']);

$recibo = $aResposta['nRec'];
$aResposta = array();
$tpAmb = TP_AMB;
$retorno = $nfe->sefazConsultaRecibo($recibo, $tpAmb, $aResposta);

//echo '<pre>';
//print_r($aResposta);
if($aResposta['aProt'][0]['cStat']=='100'){
	echo "<center><h3>RESPOSTA VINDA DA SEFAZ</h3></center>\n<br />"; 
	echo "<center><font color=green>RESPOSTA: ".$aResposta['aProt'][0]['cStat']." - ".$aResposta['aProt'][0]['xMotivo']."</font></center>\n";
	echo '</pre>';	
}else{
	echo "<center><h3>RESPOSTA VINDA DA SEFAZ</h3></center>\n<br />"; 
	echo "<center><font color=red>RESPOSTA: ".$aResposta['aProt'][0]['cStat']." - ".$aResposta['aProt'][0]['xMotivo']."</font></center>\n";
	echo '</pre>';	
}

require "add protocolo.php";