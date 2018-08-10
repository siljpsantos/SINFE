<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

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


$xml = xml_venda($pdo,$_GET['id']);
@$chave = $xml[0]['chave_xml'];

//----------------nota já transmitida
if(@$xml[0]['transmitido_xml'] != 1){
	
	//----------------nota não existente
	if($xml != array()){
		
        //Recupera o XML salvo na pasta destino
        $filename = "../nfephp/xmls/NF-e/" . TP_AMB_N ."/entradas/{$chave}-nfe.xml"; // Ambiente Windows
        //$filename = "./xml/{$chave}-nfe.xml"; // provisório
        $xml = file_get_contents($filename);
        
        //tenta assinar
        try {
            $response = $tools->signNFe($xml);

            $filename = "../nfephp/xmls/NF-e/" . TP_AMB_N ."/assinadas/{$chave}-nfe.xml"; // Ambiente Windows
            //$filename = "./xml/{$chave}-nfe.xml"; // provisório
            file_put_contents($filename, $response);
            chmod($filename, 0777);

            $info['chave'] = $chave;
            $info['xml'] = $response;
            $info['assinado'] = 1;

            assina_xml($pdo, $info);

            echo "<script>alert('Nota Assinada com sucesso!');</script>";
            
        }catch (\Exception $e) {
            //escreve no log
            error_log_s($e->getMessage());
            
            echo "<center><img src=./imgs/erro_b.png style=\"width: 30px\" /><h4 style=\"display: inline-block\"><font color=red>"
            . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ocorreu um erro - Por favor contacte o Administraor do sistema!"
            . "</font></h4></center>";
        } 
		
	}else{
		echo "<script>alert('Nota Não Existente!');</script>";
	}

}else{
	echo "<script>alert('Nota já Transmitida! Faça outra Nota');</script>";
}