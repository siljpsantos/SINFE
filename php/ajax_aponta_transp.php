<?php

include "conection.php";
include "querys.php";

$info = $_GET;

$venda = venda_view_1($pdo, $info['id']);

if ($info['mod'] != 9 || $info['mod'] != 0) {

    aponta_transp($pdo, $info);

    echo "<script>alert('Transportadora atrelada com Sucesso!');</script>";
    
}else{
    
    $insert = $pdo->query(""
            . "UPDATE tab_nfe SET "
            . "id_transp_nfe = 0, "
            . "mod_frete = " . $info['mod'] .", "
            . "tipo_doc_transp_nfe = 0, "
            . "cod_antt_nfe = '', "
            . "placa_veic_nfe = '', "
            . "uf_veic_nfe = '', "
            . "qtd_vol_nfe = 0, "
            . "especie_vol_nfe = '', "
            . "marca_vol_nfe = '', "
            . "num_vol_nfe = 0, "
            . "peso_bruto_nfe = 0, "
            . "peso_liq_nfe = 0, "
            . "val_transp_nfe = NULL "
            . "WHERE id_nfe = ".$info['id']
            );
    
}
