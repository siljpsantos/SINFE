<?php

$dir = explode('\\',getcwd());

if(end($dir)=='php'){
    include "./conection.php";
    include "./querys.php";
}else{
    include "./php/conection.php";
    include "./php/querys.php";
}

$config_emit = emitente($pdo);

//echo "<br><br><br><br>";
//print_r($config_emit);

//-------------------CONSTANTES--------------------------

//USUÁRIO ATUAL
define('CUR_USER', getenv("HOMEDRIVE") . getenv("HOMEPATH") . '\Documents\SINFE');

//AMBIENTE
define('TP_AMB', $config_emit[0]['ambiente_nfe_emitente']);

if(TP_AMB==='1'){
    $prod = 'producao';
}else{
    $prod = 'homologacao';
}

define('TP_AMB_N', $prod);

//MESES DE EMISSÃO
$mes_app = '';
for($i=0;$i<$i+1;$i++){
    $data = date('m/Y',strtotime( "-$i month" ) );
    $mes_app .= "<option>$data</option>";   
    
    if($data=="11/2016" || $data=="10/2016"){
        break;
    }
}

define('MES_OPT_REL', $mes_app);

//INFORMAÇÃO ADICIONAL
define('INFO_COMPL', 'INFORMAÇÃO COMPLEMENTAR AQUI');
define('INFO_FISCO', 'INFORMAÇÃO DO FISCO AQUI');

$info_cce = array(
    'razao' => $config_emit[0]['nome_razao_social_emitente'],
    'logradouro' => $config_emit[0]['logradouro_emitente'],
    'numero' => $config_emit[0]['numero_emitente'],
    'complemento' => $config_emit[0]['complemento_emitente'],
    'bairro' => $config_emit[0]['bairro_emitente'],
    'CEP' => $config_emit[0]['cep_emitente'],
    'municipio' => $config_emit[0]['municipio_emitente'],
    'UF' => $config_emit[0]['uf_emitente'],
    'telefone' => $config_emit[0]['telefone_emitente'],
    'email' => '' 
);

//---------------FIM CONSTANTES--------------------------


//--------- IDENTIFICA E CRIA DIRETÓRIOS ----------------

// SINFE
if (!file_exists(CUR_USER)) {
    mkdir(CUR_USER, 0777, true);
}

// SINFE/NFE
if (!file_exists(CUR_USER . "\NFE")) {
    mkdir(CUR_USER . "\NFE", 0777, true);
}

// SINFE/NFCE
if (!file_exists(CUR_USER . "\NFCE")) {
    mkdir(CUR_USER . "\NFCE", 0777, true);
}

// SINFE/NFE/NFE_MES
if (!file_exists(CUR_USER . "\NFE\NFE_MES")) {
    mkdir(CUR_USER . "\NFE\NFE_MES", 0777, true);
}

// SINFE/NFCE/NFCE_MES
if (!file_exists(CUR_USER . "\NFCE\NFCE_MES")) {
    mkdir(CUR_USER . "\NFCE\NFCE_MES", 0777, true);
}

// APROVADAS MESES
if (!file_exists("../nfephp/xmls/NF-e/" . TP_AMB_N . "/enviadas/aprovadas/".date('Ym'))) {
    @mkdir("./nfephp/xmls/NF-e/" . TP_AMB_N . "/enviadas/aprovadas/" . date('Ym'), 0777, true);
}

//------------ FIM DIRETÓRIOS ---------------------------


