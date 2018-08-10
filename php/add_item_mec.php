<?php

	include "conection.php";
	include "querys.php";
	
	//echo '<pre>';
	//print_r($_POST);
	//echo '</pre>';
	
	$info = $_POST;
    
    $info['id_produto'] = explode(" - ",$info['id_produto'])[0];
	
	//traz o valor unitario do item selecionado
	$produto = produto_view_1_cod($pdo,$info['id_produto']);
    
    //acerta a quantidade
    if(isset($info['qtd_item'])){
        if($info['qtd_item']==0 || $info['qtd_item']== null){
            $qtd = 1;
        }else{
            $qtd = $info['qtd_item'];
        }
    }
    if(!isset($info['qtd_item'])){
        $qtd = 1;
    }  
	
    if($produto != array()){
        $info['id_produto'] = $produto[0]['id_produto'];
        
        //determina se é novo ou se soma + 1
        $sql = "SELECT * "
                . "FROM tab_item_nfe "
                . "WHERE id_produto = ". $produto[0]['id_produto'] ." AND id_nfe = ". $info['id_nfe'] ." ";
        $item_venda_t = $pdo->query($sql);
        $item_venda = $item_venda_t->fetchAll();

        //echo $sql;
        //print_r($produto);

        //calcula o total do item
        $info['val_unit'] = $produto[0]['valor_produto'];
        $info['val_total'] = $info['val_unit']*$qtd;
        
        //acerta valor
        $val = $info['val_unit']*$qtd;

        if($item_venda == array()){
            /*ativar para cadastrar itens*/
            add_item_nfce($pdo,$info);
        }else{
            $pdo->query("UPDATE tab_item_nfe SET qtd_item = qtd_item+$qtd, val_total = val_total+".$val."  WHERE id_item = ". $item_venda[0]['id_item'] ." ");
        }

        //atualiza o total do item
        @$tot = $info['val_total']-$info['val_desc'];	
        $update = $pdo->query("UPDATE tab_nfe SET val_total_nfe = val_total_nfe + ".$tot." WHERE id_nfe = '".$info['id_nfe']."' ");
   
    }else{
        echo "<script>alert('Produto não existente na base.');</script>";
    }
    
	//redireiona
    header('Location: ../cadastra_venda_pos_form.php?id='.$info['id_nfe'].'');
	
?>