<?php

include "conection.php";
include "querys.php";

date_default_timezone_set('America/Sao_Paulo');

$dados = array(
    'nop' => 'Venda de Mercadoria',
    'modelo' => 65,
    'data_emis' => date('d/m/Y'),
    'data_saida_entrada' => date('d/m/Y'),
    'hora_saida_entrada' => date('H:i:s'),
    'data_hora_saida_entrada' => date('Y-m-d H:i:s')
);

$info = $dados;

//formata as horas e datas
$data_emis = explode("/", $info['data_emis']);
$info['data_emis'] = $data_emis[2] . "-" . $data_emis[1] . "-" . $data_emis[0];

$data_s = explode("/", $info['data_saida_entrada']);
$info['data_hora_saida_entrada'] = $data_s[2] . "-" . $data_s[1] . "-" . $data_s[0] . " " . $info['hora_saida_entrada'];

echo "<pre>";
print_r($info);

/* ativar para cadastrar venda */
add_venda($pdo, $info);
$id = get_last_venda($pdo);

header('Location: ../cadastra_venda_pos_form.php?id=' . $id[0]['id_nfe']);
