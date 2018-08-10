<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require "../_app/Config.inc.php";
require "../nfephp/vendor/autoload.php";

use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\NFe\Common\Standardize;
use NFePHP\NFe\Complements;

//jsons de config
$configJson = file_get_contents('../nfephp/config/config.json');
$certJson = json_decode(file_get_contents('../nfephp/config/cert.json'), true);

//certificado A1
$cert = file_get_contents('../nfephp/certs/' . $certJson['certPfxName']);
$tools = new NFePHP\NFe\Tools($configJson, Certificate::readPfx($cert, $certJson['certPassword']));
$tools->model('55');

//xml da venda
$xml = xml_venda($pdo,$_GET['id_nfe']);
//venda
$venda = venda_view_1($pdo,$_GET['id_nfe']);

//comparação de datas para o cancelamento
$data_nfe = new DateTime($venda[0]['data_emis_nfe']);
$data_expira = $data_nfe->add(new DateInterval('P1D'));
$data_atual = new DateTime(); 

if($data_expira > $data_atual){
	
    //realiza o cancelamento
	$chave = $xml[0]['chave_xml'];
    $xJust = $_GET['motivo'];
	$nProt = $xml[0]['protocolo_xml'];	
	$retorno = $tools->sefazCancela($chave, $xJust, $nProt);
    
    //organiza a resposta	
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
	
	$resp = $vals[8]['value'];
	$cStat = $vals[15]['value'];
	$xMotivo = $vals[16]['value'];
	$chave = $vals[17]['value'];
	
	
	
    //evento ok
	if($resp == 128){
                
		if($cStat == '135' || $cStat == '155'){
            
            $xml = Complements::toAuthorize($tools->lastRequest, $retorno);
            
            //grave o XML protocolado - FALTA!!!!
			file_put_contents("../xml_o/canc/{$chave}-nfe.xml",$xml);
            
			$update = $pdo->query("UPDATE tab_xml SET cancelado_xml = 1 WHERE chave_xml = '".$chave."' ");
			echo "<script>alert('Nota Cancelada com Sucesso!');</script>";
        
        //falha no evento
		}else{
            
			echo "<center><h3>RESPOSTA VINDA DA SEFAZ</h3></center>\n<br />"; 
			echo "<center><font color=red>RESPOSTA: ".$cStat." - ".$xMotivo."</font></center>\n";
			echo '</pre>';
			echo "<script>alert('Erro no Cancelamento!!');</script>";
            
		}
    
    //evento nao processado
	}else{
        
		echo "<center><h3>RESPOSTA VINDA DA SEFAZ</h3></center>\n<br />"; 
		echo "<center><font color=red>RESPOSTA: ".$cStat." - ".$xMotivo."</font></center>\n";
		echo '</pre>';
		echo "<script>alert('Erro no Cancelamento!!');</script>";
        
	}
	
	
}else{
	echo "<script>alert('Data de cancelamento expirada!');</script>";
}

