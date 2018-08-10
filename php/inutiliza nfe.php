<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require "../_app/Config.inc.php";
require "../nfephp/vendor/autoload.php";

use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\Common\Soap\SoapCurl;
use NFePHP\NFe\Make;
use NFePHP\NFe\Common\Standardize;
use NFePHP\NFe\Factories\Protocol;
use NFePHP\NFe\Complements;

//jsons de config
$configJson = file_get_contents('../nfephp/config/config.json');
$certJson = json_decode(file_get_contents('../nfephp/config/cert.json'), true);

//certificado A1
$cert = file_get_contents('../nfephp/certs/' . $certJson['certPfxName']);
$tools = new NFePHP\NFe\Tools($configJson, Certificate::readPfx($cert, $certJson['certPassword']));

//dados do emitente
$emitente = emitente($pdo);

//inutiliza a nota
$tools->model($_POST['modelo']);
$tools->setEnvironment(TP_AMB);

$nSerie = (int) (($emitente[0]['n_nota_emitente'] + 1) / 10000) + 1;
$nIni = $_POST['ini'];
$nFin = $_POST['fin'];
$xJust = $_POST['motivo'];

$retorno = $tools->sefazInutiliza($nSerie, $nIni, $nFin, $xJust);
//---------------------------------

//converte em vetor
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

$cstat = $vals[7]['value'];
$xmotivo = $vals[8]['value'];
//---------------------------------

//caso a inutilização seja bem suscedida
if ($cstat === '102') {

    echo "<script>alert('Faixa inutilizada! - " . $cstat . ": " . $xmotivo . " ');/*window.history.go(-1);*/</script>";

    if ($_POST['fin'] >= $emitente[0]['n_nota_emitente']) {

        
        if ($_POST['modelo'] == '55') {
            $update = $pdo->query("UPDATE tab_emitente SET n_nota_emitente = " . $_POST['fin'] . " ");
        } else {
            $update = $pdo->query("UPDATE tab_emitente SET n_nfce_emitente = " . $_POST['fin'] . " ");
        }
    }

//caso não
} else {

    echo "<script>alert('Erro " . $cstat . ": " . $xmotivo . " ');/*window.history.go(-1);*/</script>";
}

