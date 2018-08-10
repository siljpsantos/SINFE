<?php

require_once '../nfephp/bootstrap.php';

include "conection.php";	
include "querys.php";

use NFePHP\NFe\ToolsNFe;

$nfe = new ToolsNFe('../nfephp/config/config.json');
$nfeTools = new ToolsNFe('../nfephp/config/config.json');

$emitente = emitente($pdo);
$tpAmb = $emitente[0]['ambiente_nfe_emitente'];

$xml_q = xml_venda($pdo,$_GET['id']);
@$chave = $xml_q[0]['chave_xml'];

//----------------nota já transmitida
if($xml_q[0]['transmitido_xml'] != 1){
	
	//----------------nota não existente
	if($xml_q != array()){
		//----------------nota não assinada
		if($xml_q[0]['assinado_xml'] == 1){
			
			$filename = "../nfephp/xmls/NF-e/producao/assinadas/{$chave}-nfe.xml"; // Ambiente Windows
			$xml = file_get_contents($filename);
			
			$aResposta = array();
			
			if (! $nfe->validarXml($xml) || sizeof($nfeTools->errors)) {
			    echo "<h3><center>Sua Nota contém erros: </center></h3><br />";    
			    foreach ($nfe->errors as $erro) {
			        if (is_array($erro)) { 
			            foreach ($erro as $err) {
			                echo "<font color=red>$err</font><br>";
			            }
			        } else {
			            echo "$erro <br>";
			        }
			    }
			    exit;
			}else{
				echo "<script>alert('Nota Validada com sucesso!');</script>";
				$info['chave'] = $chave;
				$info['valido'] = 1;
				valida_xml($pdo,$info);
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
