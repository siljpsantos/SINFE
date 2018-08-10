<?php
	
	include "_app/Config.inc.php";

	include "php/checa.php";

	$xml = xml_venda($pdo,$_GET['id']);
	
	$ind_xml = 0;
	if($xml != array()){
		$ind_xml = 1;
	}
	
	$nref = nref_venda($pdo,$_GET['id']);
	$fat = fat_nfe($pdo,$_GET['id']);
	
	$produto = produto($pdo);
	$venda = venda_view_1($pdo,$_GET['id']); //seleciona a venda a ser concluída
	
	$cliente = cliente($pdo);
	
	$transp = transp($pdo);
	
	$transp_venda = transp_id($pdo,$venda[0]['id_transp_nfe']);
	
	$ind_transp = 0;
	if($transp_venda != array()){
		$ind_transp = 1;
	}
	
	$cliente_n = 0;
	if($venda[0]['id_cliente']!=0){
		$cliente_nfe = cliente_view_1_id($pdo,$venda[0]['id_cliente']);
		$cliente_n = 1;
	}
	
	$retirada = NULL;
	$lista_retirada[0] = 0;
	if($venda[0]['id_retirada'] != 0){
		$retirada = 1;
		$lista_retirada = retirada_view_1($pdo,$venda[0]['id_retirada']);
	}
	$entrega = NULL;
	$lista_entrega[0] = 0;
	if($venda[0]['id_entrega'] != 0){
		$entrega = 1;
		$lista_entrega = entrega_view_1($pdo,$venda[0]['id_entrega']);
	}
	
	$emitente = emitente($pdo);
	$estados = estados($pdo_estados);
	
	//nome do municipio
	if($venda[0]['cod_municipio_ocorrencia_nfe']==NULL){
		$mun = '3305109';
	}else{
		$mun = $venda[0]['cod_municipio_ocorrencia_nfe'];
	}
	$select = $pdo_estados->query("SELECT * FROM tab_municipios WHERE id = ".$mun." ");
	$nome_municipio = $select->fetchAll();
	unset($select);
	
	$item = itens_venda($pdo,$_GET['id']);
	
	//organiza as datas
	$data_emis_tmp = explode(" ",$venda[0]['data_emis_nfe']); 
	$data_emis_tmp2 = explode("-",$data_emis_tmp[0]); 
	$data_emis = $data_emis_tmp2[2]."/".$data_emis_tmp2[1]."/".$data_emis_tmp2[0];
	
	$data_hora_s = explode(" ",$venda[0]['data_hora_saida_entrada_nfe']);
	$data_s = explode("-",$data_hora_s[0]);
	$hora_s = $data_hora_s[1];
	$data_s = $data_s[2]."/".$data_s[1]."/".$data_s[0];
	
	$cfop = cfop($pdo);
	
?>
<!DOCTYPE html>
<html>
  <head>
    <title>SINFE - Sistema Emissor NFe/NFce</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />
    
    <link rel="stylesheet" type="text/css" href="css/ativos.css" />
    
    <!-- media print -->
    <style type="text/css" media="print">
    
		@page {
		    size: auto;   /* auto is the initial value */
		    margin: 0;  /* this affects the margin in the printer settings */
		}
		*{
			font-size: 17pt;
		}
		header,button,input[type=submit],#esconder,#titulo,#itens,#venda,#venda_1,#erro,#dest{
			display: none;
		}
		input[type=text],select{
			font-size: 10pt;
		}
		#lista_item{
			border: 0;
		}
		
	</style>
    
    <!-- estilo -->
    <style type="text/css" media="all">

        #cadastro {
          padding: 80px 00px 50px;
          border-top: 1px solid #ccc;
          /*font-size: 20px;*/
          line-height: 24px;
        }

        #corpo{
            width: 1200px;
            min-width: 600px;
            margin: 0 auto;
            text-align: left;
            /*border: 1px solid #000;
            padding: 0px 10px 20px;*/
        }

        #titulo{
            margin: 0px 10px 0px;
        }

        #cadastro form input{
            border: 1px solid #aaa;
        }

        .grupo{

            border: 1px solid #666;
            padding: 10px 10px 10px;
            margin: 0px 10px 0px;
            background: #ece9d8;

        }

        #exTab1{
            margin-bottom: 10px;
        }

        #exTab1 .tab-content {
            /*color : white;
            background-color: #428bca;*/
            background-color: white;
            padding : 5px 15px;
            /*border: 1px solid #9a9a9a;*/
            box-shadow: 0px 0px 10px grey;
        }

        /* remove border radius for the tab */

         .nav-pills > li > a {
            border-radius: 0;
        }

        .fix{
            height: 600px;
        }

        .small-tab-1{
            width: 100% !important;
        }

        .small-tab-2{
            width: 100% !important;
            left: 20px important;
        }

        /* estilo padrão */

        #exTab1 .nav>li>a {
            padding: 5px 15px !important;
        }

        .nav-pills>li.active>a, 
        .nav-pills>li.active>a:focus, 
        .nav-pills>li.active>a:hover{
            color: black !important;
            /*background-color: rgb(225, 231, 245) !important;*/
            background-color: white !important;
            /*border: 1px solid #9a9a9a;*/
            border-bottom: 0;
            border-radius: 10px 10px 0 0 !important;
            
            box-shadow: 0px -1px 1px grey;
            clip: rect(0, 0, 10px, 0);
        }

        .nav>li>a:focus, .nav>li>a:hover {
            border-radius: 10px 10px 0 0 !important;
        }

        /* fim */

        #corpo .item,
        #div_icms .item,
        #div_icmsst .item{
            margin-bottom: 6px;
        }
			
	</style>
    
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    
    <!-- scripts principais -->
	<script>
	    function buscar_cidades_1(){
	      var estado = $('#estado_1 option:selected').val();
	      if(estado){
	        var url = 'php/ajax_buscar_cidades_nfe_1.php?estado='+estado;
	        $.get(url, function(dataReturn) {
	          $('#load_cidades_1').html(dataReturn);
	        });
	      }
	    }
	    
	    function buscar_cidades_2(){
	      var estado = $('#estado_2 option:selected').val();
	      if(estado){
	        var url = 'php/ajax_buscar_cidades_nfe.php?estado='+estado;
	        $.get(url, function(dataReturn) {
	          $('#load_cidades_2').html(dataReturn);
	        });
	      }
	    }
	    
	    function buscar_cidades_3(){
	      var estado = $('#estado_3 option:selected').val();
	      if(estado){
	        var url = 'php/ajax_buscar_cidades_nfe.php?estado='+estado;
	        $.get(url, function(dataReturn) {
	          $('#load_cidades_3').html(dataReturn);
	        });
	      }
	    }
	    
	    function buscar_cidades_dest(){
	      var estado = $('#estado_dest option:selected').val();
	      if(estado){
	        var url = 'php/ajax_buscar_cidades_nfe.php?estado='+estado;
	        $.get(url, function(dataReturn) {
	          $('#load_cidades_dest').html(dataReturn);
	        });
	      }
	    }
	    
	    function buscar_cidades_transp(){
	      var estado = $('#estado_transp option:selected').val();
	      if(estado){
	        var url = 'php/ajax_buscar_cidades.php?estado='+estado;
	        $.get(url, function(dataReturn) {
	          $('#load_cidades_transp').html(dataReturn);
	        });
	      }
	    }
	    
	    function busca_cliente(){
	      var id = $('#nome_cliente option:selected').val();
	      if(id){
	        var url = 'php/ajax_seleciona_cliente.php?id='+id;
	        $.get(url, function(dataReturn) {
	          $('#div_dest').html(dataReturn);
	        });
	      }
	    }
	    
	    function busca_transp(){
	      var id = $('#id_transp_f option:selected').val();
	      var venda = $('#info_1 [name=id_nfe]').val();
	      if(id){
	        var url = 'php/ajax_seleciona_transp.php?id='+id+'&venda='+venda;
	        $.get(url, function(dataReturn) {
	          $('#div_transp').html(dataReturn);
	        });
	      }
	    }
	    
	    function cadastra_retirada(){
	      var cnpj = $('#info_1 [name=cnpj_retirada]').val();
	      var cpf = $('#info_1 [name=cpf_retirada]').val();
	      var logr = $('#info_1 [name=logradouro_retirada]').val();
	      var num = $('#info_1 [name=numero_retirada]').val();
	      var compl = $('#info_1 [name=complemento_retirada]').val();
	      var bairro = $('#info_1 [name=bairro_retirada]').val();
	      var uf = $('#info_1 select[name=uf] option:selected').val();
	      var mun = $('#info_1 select[name=municipio] option:selected').val();
	      var venda = $('#info_1 [name=id_nfe]').val();
	      var retirada = $('#info_1 [name=post]').val();
	      if(cnpj || cpf){
	        var url = 'php/ajax_cadastra_retirada.php?retirada='+retirada+'&venda='+venda+'&cnpj='+cnpj+'&cpf='+cpf+'&logr='+logr+'&num='+num+'&compl='+compl+'&bairro='+bairro+'&uf='+uf+'&mun='+mun;
	        $.get(url, function(dataReturn) {
	          $('#teste').html(dataReturn);
	        });
          }else{
              alert('Preencha todas as informações!')
          }
	    }
	    
	    function cadastra_entrega(){
	      var cnpj = $('#info_2 [name=cnpj_entrega]').val();
	      var cpf = $('#info_2 [name=cpf_entrega]').val();
	      var logr = $('#info_2 [name=logradouro_entrega]').val();
	      var num = $('#info_2 [name=numero_entrega]').val();
	      var compl = $('#info_2 [name=complemento_entrega]').val();
	      var bairro = $('#info_2 [name=bairro_entrega]').val();
	      var uf = $('#info_2 select[name=uf] option:selected').val();
	      var mun = $('#info_2 select[name=municipio] option:selected').val();
	      var venda = $('#info_2 [name=id_nfe]').val();
	      var entrega = $('#info_2 [name=post]').val();
	      if(cnpj || cpf){
	        var url = 'php/ajax_cadastra_entrega.php?entrega='+entrega+'&venda='+venda+'&cnpj='+cnpj+'&cpf='+cpf+'&logr='+logr+'&num='+num+'&compl='+compl+'&bairro='+bairro+'&uf='+uf+'&mun='+mun;
	        $.get(url, function(dataReturn) {
	          $('#teste').html(dataReturn);
	        });
	      }else{
              alert('Preencha todas as informações!')
          }
	    }
        
	    function gera_nfe(){
	      var id = $('#info [name=id_nfe]').val();
	      var id_cliente = $('#nome_cliente option:selected').val();
	      var tipo = $('#tipo_doc option:selected').val();
	      if(id){
	        var url = 'php/gera_nfe.php?id='+id+'&cliente='+id_cliente+'&tipo='+tipo;
	        $.get(url, function(dataReturn) {
	          $('#teste').html(dataReturn);
	        });
	      }
	    }
	    
	     function aponta_cliente(){
	      var id = $('#info [name=id_nfe]').val();
	      var id_cliente = $('#nome_cliente option:selected').val();
	      
	      var avulso = $('#info [name=avulso]').prop('checked') ? 'sim' : 'nao';
	      
	      var nome = $('#info [name=nome_avulso]').val();
	      var cpf_cnpj = $('#cpf_cnpj_cl').val();
	      var ie = $('#info [name=inscricao_estadual]').val();
	      var im = $('#info [name=inscricao_municipal]').val();
	      var icms = $('#info [name=isencao_icms]').prop('checked') ? 'sim' : 'nao';
	      var suframa = $('#info [name=suframa]').val();
	      var email = $('#info [name=email]').val();
	      var logr = $('#info [name=logradouro]').val();
	      var num = $('#info [name=numero]').val();
	      var compl = $('#info [name=complemento]').val();
	      var bairro = $('#info [name=bairro]').val();
	      var cep = $('#info [name=cep]').val();
	      var uf = $('#info [name=uf] option:selected').val();
	      var mun = $('#info [name=municipio] option:selected').val();
	      var tel = $('#info [name=telefone]').val();
	      
	      if(id && cpf_cnpj){
	        var url = 'php/ajax_aponta_cliente.php?id='+id+'&cliente='+id_cliente+'&avulso='+avulso+'&nome='+nome+'&cpf_cnpj='+cpf_cnpj+'&ie='+ie+'&im='+im+'&icms='+icms+'&suframa='+suframa+'&email='+email+'&logr='+logr+'&num='+num+'&compl='+compl+'&bairro='+bairro+'&cep='+cep+'&uf='+uf+'&mun='+mun+'&tel='+tel;
	        $.get(url, function(dataReturn) {
	          $('#teste').html(dataReturn);
	        });
	      }else{
	      	alert("Dados estão faltando.");
	      }
	    }
	    
	    function aponta_transp(){
	      var id = $('#info [name=id_nfe]').val();
	      var id_transp = $('#id_transp_f option:selected').val();
	      var mod_frete = $('#info_transp [name=mod_frete] option:selected').val();
	      var antt = $('#info_transp [name=cod_antt]').val();
	      var placa = $('#info_transp [name=placa]').val();
	      var uf = $('#info_transp [name=uf_vei] option:selected').val();
	      var tipo_doc = $('#info_transp [name=tipo_doc] option:selected').val();
	      var qtd = $('#info_transp [name=qtd_vol]').val();
	      var esp = $('#info_transp [name=esp_vol]').val();
	      var marca = $('#info_transp [name=marca_vol]').val();
	      var num = $('#info_transp [name=num_vol]').val();
	      var pesob = $('#info_transp [name=peso_b_vol]').val();
	      var pesol = $('#info_transp [name=peso_l_vol]').val();
		  var val_transp = $('#info_transp [name=val_transp]').val();
          //alert(mod_frete);
          if(mod_frete == 9){
              alert('Frete Registrado com Sucesso!!');
          }
	      if(true){
	        var url = 'php/ajax_aponta_transp.php?id='+id+'&id_transp='+id_transp+'&mod='+mod_frete+'&antt='+antt+'&placa='+placa+'&uf='+uf+'&tipo_doc='+tipo_doc+'&qtd='+qtd+'&esp='+esp+'&marca='+marca+'&num='+num+'&pesob='+pesob+'&pesol='+pesol+'&val='+val_transp; 
	        $.get(url, function(dataReturn) {
	          $('#teste').html(dataReturn);
	        });
	      }
	    }
	    
	    function cancela_nfe(){
	      var id = $('#cancelamento [name=id_nfe]').val();
	      var motivo = $('#cancelamento [name=motivo]').val();
	      if(id && motivo){
	        var url = 'php/cancela nfe_nfe.php?id_nfe='+id+'&motivo='+motivo;
	        $.get(url, function(dataReturn) {
	          $('#teste').html(dataReturn);
	        });
	      }
	    }
	    
	    function add_pagamento(){
	      var id = $('#info_pg [name=id_nfe]').val();
	      var tipo = $('#info_pg [name=tipo_pg] option:selected').val();
	      var val = $('#info_pg [name=val_pg]').val();
	      if(id && tipo){
	        var url = 'php/ajax_cadastra_pg.php?id_nfe='+id+'&tipo='+tipo+'&val='+val;
	        $.get(url, function(dataReturn) {
	          $('#teste').html(dataReturn);
	        });
	      }
	    }
	    
	    function assina_nfe(){
	      var id = $('#info [name=id_nfe]').val();
	      var assinatura = $('#info [name=assinatura] option:selected').val();
	      if(id){
	        var url = 'php/assina nfe.php?id='+id+'&assinatura='+assinatura;
	        $.get(url, function(dataReturn) {
	          $('#teste').html(dataReturn);
	        });
	      }
	    }
	    
	    function valida_nfe(){
	      var id = $('#info [name=id_nfe]').val();
	      if(id){
	        var url = 'php/valida nfe.php?id='+id;
	        $.get(url, function(dataReturn) {
	          $('#err').html(dataReturn);
	        });
	      }
	    }
	    
	    function transmite_nfe(){
	      var id = $('#info [name=id_nfe]').val();
	      if(id){
	        var url = 'php/envia nfe.php?id='+id;
	        $.get(url, function(dataReturn) {
	          $('#err').html(dataReturn);
	        });
	      }
	    }
	    
	    function danfe_nfe(){
	      var id = $('#info [name=id_nfe]').val();
	      if(id){
	        var url = 'php/danfe nfe.php?id='+id;
	        $.get(url, function(dataReturn) {
	          $('#teste').html(dataReturn);
	        });
	      }
	    }
	    
	    function submitForm(action)
	    {
	        document.getElementById('info').action = action;
	        document.getElementById('info').submit();
	    }
	       
	    function esconde(){
	    	var op = $('#sit_trib_select option:selected').val();
	    	
	    	if(op==='101'){
	    		$("#div_icms").hide();
	    		$("#div_icmsst").hide();
	    		$("#div_icmsret").hide();
	    		$("#div_bc").show();
	    	}
	    	if(op==='102' || op==='103' || op==='300' || op==='400'){
	    		$("#div_icms").hide();
	    		$("#div_icmsst").hide();
	    		$("#div_icmsret").hide();
	    		$("#div_bc").hide();
	    	}
	    	if(op==='201'){
	    		$("#div_icms").hide();
	    		$("#div_icmsst").show();
	    		$("#div_icmsret").hide();
	    		$("#div_bc").show();
	    	}
	    	if(op==='202' || op==='203'){
	    		$("#div_icms").hide();
	    		$("#div_icmsst").show();
	    		$("#div_icmsret").hide();
	    		$("#div_bc").hide();
	    	}
	    	if(op==='500'){
	    		$("#div_icms").hide();
	    		$("#div_icmsst").hide();
	    		$("#div_icmsret").show();
	    		$("#div_bc").hide();
	    	}
	    	if(op==='900'){
	    		$("#div_icms").show();
	    		$("#div_icmsst").show();
	    		$("#div_icmsret").hide();
	    		$("#div_bc").show();
	    	}
	    	
	    }
	    
	    $(document).ready(function (e) {
		    $("#info_1").submit(function(e){
		        return false;
		    });
		    $("#info_2").submit(function(e){
		        return false;
		    });
		    $("#info").submit(function(e){
		        e.preventDefault();;
		    });
		    $(".info_i").submit(function(e){
		        e.preventDefault();;
		    });
		    $("#info_transp").submit(function(e){
		        e.preventDefault();;
		    });
		    $("#cancelamento").submit(function(e){
		        e.preventDefault();;
		    });
		    $("#info_pg").submit(function(e){
		        e.preventDefault();;
		    });
		    
            /*
		    $("#transp").hide();
		    $('#referencia').hide();
            */
           
		    $('#cancelamento').hide();
            //$('#cce').hide();
            
            /*
		    $('#fatura').hide();
		    $('#venda_1').hide();
		    $('#venda_ent').hide();
		    $('#adicional').hide();
		    
            
		    $("#div_tot_icms").hide();
		    $("#div_ipi").hide();
		    $("#new_prod").hide();
		    $("#pg").hide();
		    */
		    $("#div_icms").hide();
    		$("#div_icmsst").hide();
    		$("#div_icmsret").hide();
    		$("#div_bc").show();
		    
		    $("#novo_item [name=aliq_calc_cred]").change(function(e){
		    	var bc = $("#novo_item [name=base_calc]").val();
		    	var aliq = $("#novo_item [name=aliq_calc_cred]").val();
		    	var result = (bc/100)*aliq;
		    	$("#novo_item [name=cred]").val(result);
		    });
		    
		    $("#novo_item [name=qtd_item]").change(function(e){
		    	var sp1 = $("#novo_item [name=id_produto] option:selected").val();
		    	var sp2 = sp1.split("|");
		    	var bc = sp2[1];
		    	var qtd = $("#novo_item [name=qtd_item]").val();
		    	var result = bc*qtd;
		    	$("#novo_item [name=base_calc]").val(result);
		    });
		    
		    $("#novo_item [name=aliq]").change(function(e){
		    	var bc = $("#novo_item [name=vbc]").val();
		    	var aliq = $("#novo_item [name=aliq]").val();
		    	var result = (bc/100)*aliq;
		    	$("#novo_item [name=val_op]").val(result);
		    });
		    
		});
	    
	</script>
    
  </head>
  
  <!-- chamada do body e todo menu superior-->
  
  <?php include "menu_links.php";?>

    <section id="cadastro">
        
    	<div id="corpo">
            
            <div id="exTab1" class="container">	
                <!-- menu -->
                <ul  class="nav nav-pills">
                    <li class="active">
                        <a  href="#1a" data-toggle="tab">Dados NF-e</a>
                    </li>
                    <li>
                        <a href="#2a" data-toggle="tab">Destinatário</a>
                    </li>
                    <li>
                        <a href="#3a" data-toggle="tab">Produtos/Serviços</a>
                    </li>
                    <li>
                        <a href="#4a" data-toggle="tab">Transporte</a>
                    </li>
                    <li>
                        <a href="#5a" data-toggle="tab">Cobrança</a>
                    </li>
                    <li>
                        <a href="#6a" data-toggle="tab">Info. Adicionais</a>
                    </li>
                    <li>
                        <a href="#7a" data-toggle="tab">NF-e Referência</a>
                    </li>
                    <li>
                        <a href="#8a" data-toggle="tab">Cartas de Correção</a>
                    </li>
                </ul>

                <div class="tab-content clearfix">
                    <!-- nota -->
                    <div class="tab-pane active fix" id="1a">
                        <form class="for form-inline" id="info" method="post">

                            <?php date_default_timezone_set('America/Sao_Paulo');  ?>

                            <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />

                            <div class="item">
                                <span class="item_titulo">*Natureza da Op.: </span>
                                <br />
                                <input class="form-control" type="text" name="nop" value="<?php echo $venda[0]['nop_nfe'] ?>" style="width: 100px">
                            </div>
                            <div class="item">
                                <input type="hidden" name="numero_nfe" value="<?php echo $venda[0]['num_nfe'] ?>" />
                                <span class="item_titulo">Número ERP: </span>
                                <br />
                                <span><?php echo $venda[0]['num_nfe'] ?></span>
                            </div>
                            <div class="item">
                                <input type="hidden" name="cod_numero" value="<?php echo $venda[0]['cod_numero_nfe'] ?>" />
                                <span class="item_titulo">C.Número: </span>
                                <br />
                                <span><?php echo $venda[0]['cod_numero_nfe'] ?></span>
                            </div>
                            <div class="item">
                                <span class="item_titulo">Modelo:</span>
                                <br />
                                <select class="form-control" name="modelo" style="width: 120px">
                                    <option <?php if($venda[0]['modelo_nfe']=="55"){ echo "selected"; } ?> value="55">55 - NFe</option>
                                    <!--<option <?php if($venda[0]['modelo_nfe']=="65"){ echo "selected"; } ?> value="65">65 - NFCe</option> -->
                                </select>
                            </div>
                            <div class="item">
                                <span class="item_titulo">Série:</span>
                                <br />
                                <input type="hidden" value="<?php echo $venda[0]['serie_nfe'] ?>" name="serie" style="width: 50px" />
                                <span><?php echo $venda[0]['serie_nfe'] ?></span>
                            </div>
                            <div class="item">
                                <span class="item_titulo">Data Emiss.:</span>
                                <br />
                                <input class="form-control i-data" type="text" value="<?php echo $data_emis ?>" name="data_emis" value="<?php echo date("d/m/Y") ?>" style="width: 100px" />
                            </div>
                            <div class="item">
                                <span class="item_titulo">Data Entrada/Saída: </span>
                                <br />
                                <input class="form-control i-data" type="text" name="data_saida_entrada" value="<?php echo $data_s ?>" style="width: 100px" />
                            </div>
                            <div class="item">
                                <span class="item_titulo">Hora Entrada/Saída: </span>
                                <br />
                                <!-- <span><?php echo $hora_s ?></span> -->
                                <input class="form-control i-hora" style="width: 100px;" type="text" name="hora_saida_entrada" value="<?php echo $hora_s ?>" />
                            </div>
                            <!--estado e cidade-->
                            <div class="item">
                                <span class="item_titulo" for="uf">UF: </span>
                                <br />
                                <select  class="form-control" id="estado_1" name="uf_1" id="uf" onchange="buscar_cidades_1()">
                                    <option></option>
                                     <?php foreach ($estados as $value => $name) { ?>
                                            <option <?php if($venda[0]['uf_nfe']==$name['codigo_ibge']){ echo 'selected';} ?> value="<?php echo $name['codigo_ibge']."|".$name['uf'] ?>"><?php echo $name['uf'] ?></option>
                                     <?php } ?>
                                 </select>
                            </div>
                            <div class="item" id="load_cidades_1">
                                 <span class="item_titulo" for="municipio">Município: </span>
                                 <br />
                                 <select class="form-control" class="cidade" name="municipio_1" style="width: 280px">
                                    <option value="<?php echo $venda[0]['cod_municipio_ocorrencia_nfe'] ?>"><?php echo utf8_encode($nome_municipio[0]['nome']) ?></option>	
                                 </select>
                            </div>
                            <!--fim estado cidade-->
                            <div class="item">
                                 <span class="item_titulo">Tipo de Nfe: </span>
                                 <br />
                                 <select class="form-control" name="tipo_documento" style="width: 100px">
                                    <option <?php if($venda[0]['tipo_documento_nfe']=="0"){echo 'selected="selected"';} ?> value="0">Entrada</option>
                                    <option <?php if($venda[0]['tipo_documento_nfe']=="1"){echo 'selected="selected"';} ?> value="1">Saída</option>		
                                 </select>
                            </div>
                            <div class="item">
                                 <span class="item_titulo">Destino da Op.: </span>
                                 <br />
                                 <select class="form-control" name="destino_operacao" style="width: 200px">
                                    <option <?php if($venda[0]['destino_operacao_nfe']=="1"){echo 'selected="selected"';} ?> value="1">Operação Interna</option>
                                    <option <?php if($venda[0]['destino_operacao_nfe']=="2"){echo 'selected="selected"';} ?> value="2">Operação Interestadual</option>	
                                    <option <?php if($venda[0]['destino_operacao_nfe']=="3"){echo 'selected="selected"';} ?> value="3">Operação com Exterior</option>		
                                 </select>
                            </div>
                            <div class="item">
                                 <span class="item_titulo">Tipo de DANFE: </span>
                                 <br />
                                 <select class="form-control" name="tipo_impressao" style="width: 310px">
                                    <option value="0">Sem Geração de DANFE</option>
                                    <option selected value="1">DANFE normal, retrato</option>	
                                    <option value="2">DANFE normal, paisagem</option>
                                    <option value="3">DANFE simplificado</option>
                                    <option value="4">DANFE NFC-e</option>
                                    <option value="5">DANFE NFC-e em mensagem eletrônica</option>		
                                 </select>
                            </div>
                            <div class="item">
                                 <span class="item_titulo">Tipo de Emissão: </span>
                                 <br />
                                 <select  class="form-control" name="tipo_emissao" style="width: 250px">
                                    <option <?php if($venda[0]['forma_emissao_nfe']=="1"){echo 'selected="selected"';} ?> value="1">Emissão normal</option>
                                    <option <?php if($venda[0]['forma_emissao_nfe']=="2"){echo 'selected="selected"';} ?> value="2">Contingência FS-IA</option>	
                                    <option <?php if($venda[0]['forma_emissao_nfe']=="3"){echo 'selected="selected"';} ?> value="3">Contingência SCAN</option>
                                    <option <?php if($venda[0]['forma_emissao_nfe']=="4"){echo 'selected="selected"';} ?> value="4">Contingência DPEC</option>
                                    <option <?php if($venda[0]['forma_emissao_nfe']=="5"){echo 'selected="selected"';} ?> value="5">Contingência FS-DA</option>
                                    <option <?php if($venda[0]['forma_emissao_nfe']=="6"){echo 'selected="selected"';} ?> value="6">Contingência SVC-AN</option>
                                    <option <?php if($venda[0]['forma_emissao_nfe']=="7"){echo 'selected="selected"';} ?> value="7">Contingência SVC-RS</option>	
                                    <option <?php if($venda[0]['forma_emissao_nfe']=="9"){echo 'selected="selected"';} ?> value="9">Contingência off-line da NFC-e</option>		
                                 </select>
                            </div>
                            <div class="item">
                                 <span class="item_titulo">Finalidade de Emissão: </span>
                                 <br />
                                 <select class="form-control" name="finalidade_emissao" style="width: 250px">
                                    <option <?php if($venda[0]['finalidade_emissao_nfe']=="1"){echo 'selected="selected"';} ?> value="1">NF-e Normal</option>
                                    <option <?php if($venda[0]['finalidade_emissao_nfe']=="2"){echo 'selected="selected"';} ?> value="2">NF-e complementar</option>	
                                    <option <?php if($venda[0]['finalidade_emissao_nfe']=="3"){echo 'selected="selected"';} ?> value="3">NF-e de ajuste</option>
                                    <option <?php if($venda[0]['finalidade_emissao_nfe']=="4"){echo 'selected="selected"';} ?> value="4">Devolução/Retorno</option>	
                                 </select>
                            </div>
                            <div class="item">
                                 <span class="item_titulo">Cunsumidor Final: </span>
                                 <br />
                                 <select class="form-control" name="consumidor_final" style="width: 80px">
                                    <option <?php if($venda[0]['comprador_final_nfe']=="1"){echo 'selected="selected"';} ?> value="1">Sim</option>
                                    <option <?php if($venda[0]['comprador_final_nfe']=="0"){echo 'selected="selected"';} ?> value="0">Não</option>
                                 </select>
                            </div>
                            <div class="item">
                                 <span class="item_titulo">Presença do Comprador: </span>
                                 <br />
                                 <select class="form-control" name="presenca_comprador" style="width: 360px">
                                    <option <?php if($venda[0]['presenca_comprador_nfe']=="0"){echo 'selected="selected"';} ?> value="0">Não se aplica</option>
                                    <option <?php if($venda[0]['presenca_comprador_nfe']=="1"){echo 'selected="selected"';} ?> value="1">Operação Presencial</option>	
                                    <option <?php if($venda[0]['presenca_comprador_nfe']=="2"){echo 'selected="selected"';} ?> value="2">Operação não Presencial, Internet</option>
                                    <option <?php if($venda[0]['presenca_comprador_nfe']=="3"){echo 'selected="selected"';} ?> value="3">Operação não Presencial, Teleatendimento</option>
                                    <option <?php if($venda[0]['presenca_comprador_nfe']=="4"){echo 'selected="selected"';} ?> value="4">NFC-e em operação com entrega a domicílio</option>
                                    <option <?php if($venda[0]['presenca_comprador_nfe']=="9"){echo 'selected="selected"';} ?> value="9">Operação não presencial, outros</option>	
                                 </select>
                            </div>
                            <div class="item">
                                 <span class="item_titulo">Processo de Emiss.: </span>
                                 <br />
                                 <select class="form-control" name="procemi" style="width: 380px">
                                    <option <?php if($venda[0]['procemi_nfe']=="0"){echo 'selected="selected"';} ?> value="0">Emissão de NF-e com aplicativo do contribuinte</option>
                                    <option <?php if($venda[0]['procemi_nfe']=="1"){echo 'selected="selected"';} ?> value="1">Emissão de NF-e avulsa pelo Fisco</option>	
                                    <option <?php if($venda[0]['procemi_nfe']=="2"){echo 'selected="selected"';} ?> value="2">Emissão de NF-e com Certificado, pelo Fisco</option>
                                    <option <?php if($venda[0]['procemi_nfe']=="3"){echo 'selected="selected"';} ?> value="3">Emissão de NF-e com aplicativo fornecido pelo Fisco</option>	
                                 </select>
                            </div>
                            <div class="item">
                                 <span class="item_titulo">Forma de Pag.: </span>
                                 <br />
                                 <select  class="form-control" name="forma_pg" style="width: 100px">
                                    <option <?php if($venda[0]['forma_pagamento']=="0"){echo 'selected="selected"';} ?> value="0">Á Vista</option>
                                    <option <?php if($venda[0]['forma_pagamento']=="1"){echo 'selected="selected"';} ?> value="1">Á Prazo</option>	
                                    <option <?php if($venda[0]['forma_pagamento']=="2"){echo 'selected="selected"';} ?> value="2">Outros</option>
                                 </select>
                            </div>
                            <div class="item">
                                <input type="hidden" name="versao" value="1.0" />
                                 <span class="item_titulo">Versão do Aplicativo: </span>
                                 <br />
                                 <span>4.1.0</span>
                                 </select>
                            </div>
                            
                            <input type="hidden" name="assinatura" value="A1" />
                            
                            <!--
                            <div class="item">
                                 <span class="item_titulo">Assinatura: </span>
                                 <br />
                                 <select class="form-control" name="assinatura" style="width: 100px">
                                    <option>A1</option>
                                    <option>A3</option>
                                 </select>
                            </div>
                            -->
                            
                            <!--<input type="hidden" name="assinatura" value="A1" />-->
                            <input type="hidden" name="id_as" value="<?php echo $venda[0]['id_nfe'] ?>" />
                            <input type="hidden" name="id_va" value="<?php echo $venda[0]['id_nfe'] ?>" />
                            <input type="hidden" name="id_en" value="<?php echo $venda[0]['id_nfe'] ?>" />
                    </div>
                    
                    <!-- destinatario -->
                    <div class="tab-pane fix" id="2a">
                        
                        <div id="exTab1" class="container small-tab-1">
                            <!-- menu -->
                            <ul  class="nav nav-pills">
                                <li class="active">
                                    <a href="#1b" data-toggle="tab">Destinatário</a>
                                </li>
                                <li>
                                    <a href="#2b" data-toggle="tab">Entrega</a>
                                </li>
                                <li>
                                    <a href="#3b" data-toggle="tab">Retirada</a>
                                </li>
                            </ul>

                            <div class="tab-content clearfix">
                                <!-- destinatario -->
                                <div class="tab-pane active" id="1b">
                                    <div class="item">
                                        <span class="item_titulo" for="nome_razao social">*Pesquisa por Nome/Razão Social: </span>
                                        <br/>
                                        <select class="form-control" id="nome_cliente" name="nome/razao_social" onchange="busca_cliente();" style="width: 1040px; min-width: 400px;">
                                            <option></option>
                                            <?php foreach($cliente as $index=>$key){
                                                if($venda[0]['id_cliente'] == $key['id_cliente']){ 
                                                    echo '<option selected value="'.$key['id_cliente'].'">'.$key['nome_razao_social_cliente'].'</option>';
                                                }else{
                                                    echo '<option value="'.$key['id_cliente'].'">'.$key['nome_razao_social_cliente'].'</option>';
                                                }
                                             } ?>
                                        </select>
                                    </div>
                                    <br />
                                    <span>Cliente Avulso: </span><input type="checkbox" name="avulso" value="1"/>
                                    <font size="3"><u>Em caso de cliente avulso, marque a caixa ao lado e preencha os campos abaixo:</u></font>
                                    <br /><br />
                                    <div class="item">
                                        <span class="item_titulo" for="nome_razao social">*Nome/Razão Social: </span>
                                        <br />
                                        <input class="form-control" type="text" name="nome_avulso" style="width: 1040px; min-width: 400px;">
                                    </div>
                                    <div id="div_dest">
                                        <div class="item">
                                            <span class="item_titulo" for="CPF/CNPJ">CPF/CNPJ: </span>
                                            <br />
                                            <input class="form-control" value="<?php if($cliente_n){echo $cliente_nfe[0]['cpf_cnpj_cliente'];} ?>" id="cpf_cnpj_cl" type="text" name="cpf_cnpj" style="width: 150px; min-width: 100px;" />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo" for="inscricao estadual">Inscrição Estadual: </span>
                                            <br />
                                            <input class="form-control" value="<?php if($cliente_n){echo $cliente_nfe[0]['inscricao_estadual_cliente'];} ?>" type="text" name="inscricao_estadual" style="width: 150px; min-width: 126px;" />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo" for="inscricao estadual">Inscrição Municipal: </span>
                                            <br />
                                            <input class="form-control" type="text" name="inscricao_municipal" style="width: 150px; min-width: 126px;" />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo">Isento do ICMS</span>
                                            <br />
                                            <input <?php if($cliente_n){if($cliente_nfe[0]['isento_icms_cliente']=="sim"){echo 'checked';}} ?> class="item_titulo" type="checkbox" name="isencao_icms" value="1">
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo" for="SUFRAMA">Inscrição SUFRAMA: </span>
                                            <br />
                                            <input class="form-control" class="form-control" value="<?php if($cliente_n){echo $cliente_nfe[0]['inscricao_suframa_cliente'];} ?>" type="text" name="suframa" style="width: 150px; min-width: 84px;" />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo" for="email">Email: </span>
                                            <br />
                                            <input class="form-control" value="<?php if($cliente_n){echo $cliente_nfe[0]['email_cliente'];} ?>" type="text" name="email" style="width: 220px; min-width: 220px;" />
                                        </div>
                                        <!--                  ENDEREÇO                 -->
                                        <div class="item">
                                            <span class="item_titulo" for="Logradouro">Logradouro: </span>
                                            <br />
                                            <input class="form-control" value="<?php if($cliente_n){echo $cliente_nfe[0]['logradouro_cliente'];} ?>" type="text" name="logradouro" style="width: 500px; min-width: 362px;" />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo" for="numero">Número: </span>
                                            <br />
                                            <input class="form-control" value="<?php if($cliente_n){echo $cliente_nfe[0]['numero_cliente'];} ?>" type="text" name="numero" style="width: 80px; min-width: 33px;" />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo" for="complmento">Complemento: </span>
                                            <br />
                                            <input class="form-control" value="<?php if($cliente_n){echo $cliente_nfe[0]['complemento_cliente'];} ?>" type="text" name="complemento" style="width: 340px; min-width: 126px;" />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo" for="bairro">Bairro: </span>
                                            <br />
                                            <input class="form-control" value="<?php if($cliente_n){echo $cliente_nfe[0]['bairro_cliente'];} ?>" type="text" name="bairro" style="width: 270px; min-width: 126px;" />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo" for="CEP">CEP: </span>
                                            <br />
                                            <input class="form-control" value="<?php if($cliente_n){echo $cliente_nfe[0]['cep_cliente'];} ?>" type="text" name="cep" style="width: 100px; min-width: 113px;" />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo" for="uf">UF: </span>
                                            <br />
                                            <select class="form-control" id="estado_dest" name="uf" id="uf" onchange="buscar_cidades_dest()">
                                                <option></option>
                                                 <?php foreach ($estados as $value => $name) {
                                                    if($cliente_n){
                                                        if($cliente_nfe[0]['uf_cliente'] == $name['codigo_ibge']){
                                                            echo "<option selected value=".$name['codigo_ibge'].">".$name['uf']."</option>";
                                                        }else{
                                                            echo "<option value=".$name['codigo_ibge'].">".$name['uf']."</option>";
                                                        }
                                                    }else{
                                                        echo "<option value=".$name['codigo_ibge'].">".$name['uf']."</option>";
                                                    }
                                                 }?>
                                             </select>
                                        </div>
                                        <div class="item" id="load_cidades_dest">
                                             <span class="item_titulo" for="municipio">Município: </span>
                                             <br />
                                             <select class="form-control" id="cidade" name="municipio" style="width: 310px; min-width: 113px;">
                                                <option value="<?php if($cliente_n){echo $cliente[0]['cod_municipio_cliente']."|".$cliente[0]['municipio_cliente']; } ?>"><?php if($cliente_n){echo $cliente_nfe[0]['municipio_cliente'];} ?></option>	
                                             </select>
                                        </div>
                                        <div class="item">
                                             <span class="item_titulo" for="telefone">Telefone: </span>
                                             <br />
                                             <input class="form-control" value="<?php if($cliente_n){echo $cliente_nfe[0]['telefone_cliente'];} ?>" type="text" name="telefone" style="width: 150px; min-width: 92px;" />
                                        </div>
                                    </div>
                                    <button class="btn btn-sinfe-1 btn-block" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="aponta_cliente();" name="id">
                                        Salvar Cliente
                                    </button>
                                </form>
                                </div>
                                <!-- entrega -->
                                <div class="tab-pane" id="2b">
                                    <form id="info_2" method="post" class="form form-inline">
                                        <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                        <div class="item">
                                            <span class="item_titulo">CNPJ:</span>
                                            <br />
                                            <input class="form-control" type="text" value="<?php if($entrega){ echo $lista_entrega[0]['cnpj_entrega']; } ?>" name="cnpj_entrega" style="width: 100px"  />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo">CPF:</span>
                                            <br />
                                            <input class="form-control" type="text" value="<?php if($entrega){ echo $lista_entrega[0]['cpf_entrega']; } ?>" name="cpf_entrega" style="width: 100px"  />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo">Logradouro:</span>
                                            <br />
                                            <input class="form-control" type="text" value="<?php if($entrega){ echo $lista_entrega[0]['logradouro_entrega']; } ?>" name="logradouro_entrega" style="width: 300px"  />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo">Número:</span>
                                            <br />
                                            <input class="form-control" type="text" value="<?php if($entrega){ echo $lista_entrega[0]['numero_entrega']; } ?>" name="numero_entrega" style="width: 100px"  />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo">Complemento:</span>
                                            <br />
                                            <input class="form-control" type="text" value="<?php if($entrega){ echo $lista_entrega[0]['complemento_entrega']; } ?>" name="complemento_entrega" style="width: 300px"  />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo">Bairro:</span>
                                            <br />
                                            <input class="form-control" type="text" value="<?php if($entrega){ echo $lista_entrega[0]['bairro_entrega']; } ?>" name="bairro_entrega" style="width: 300px"  />
                                        </div>
                                        <!--estado e cidade-->
                                            <div class="item">
                                                <span class="item_titulo" for="uf">UF: </span>
                                                <br />
                                                <select class="form-control" id="estado_3" name="uf" onchange="buscar_cidades_3()">
                                                    <option></option>
                                                     <?php foreach ($estados as $value => $name) { ?>
                                                        <option <?php if($entrega){ if($lista_entrega[0]['uf_entrega']==$name['codigo_ibge']){ echo 'selected';}} ?> value="<?php echo $name['codigo_ibge'] ?>"><?php echo $name['uf'] ?></option>
                                                     <?php } ?>
                                                 </select>
                                            </div>
                                            <div class="item" id="load_cidades_3">
                                                 <span class="item_titulo" for="municipio">Município: </span>
                                                 <br />
                                                 <select class="form-control" class="cidade" name="municipio" style="width: 280px">
                                                    <option value="<?php if($entrega){ echo $lista_entrega[0]['cod_mun_entrega']."|".$lista_entrega[0]['mun_entrega'];} ?>"><?php echo utf8_encode($lista_entrega[0]['mun_entrega']) ?></option>
                                                 </select>
                                            </div>
                                        <!--fim estado cidade-->
                                        <button class="btn btn-sinfe-1 btn-block" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" value="<?php if($retirada){ echo $lista_entrega[0]['id_entrega']; } ?>" onclick="cadastra_entrega();" name="post" >
                                            Atualizar
                                        </button>
                                    </form>
                                </div>
                                <!-- retirada -->
                                <div class="tab-pane" id="3b">
                                    <form id="info_1" method="post" class="from form-inline">
                                        <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                        <div class="item">
                                            <span class="item_titulo">CNPJ:</span>
                                            <br />
                                            <input class="form-control" type="text" value="<?php if($retirada){ echo $lista_retirada[0]['cnpj_retirada']; } ?>" name="cnpj_retirada" style="width: 100px"  />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo">CPF:</span>
                                            <br />
                                            <input class="form-control" type="text" value="<?php if($retirada){ echo $lista_retirada[0]['cpf_retirada']; } ?>" name="cpf_retirada" style="width: 100px"  />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo">Logradouro:</span>
                                            <br />
                                            <input class="form-control" type="text" value="<?php if($retirada){ echo $lista_retirada[0]['logradouro_retirada']; } ?>" name="logradouro_retirada" style="width: 300px"  />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo">Número:</span>
                                            <br />
                                            <input class="form-control" type="text" value="<?php if($retirada){ echo $lista_retirada[0]['numero_retirada']; } ?>" name="numero_retirada" style="width: 100px"  />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo">Complemento:</span>
                                            <br />
                                            <input class="form-control" type="text" value="<?php if($retirada){ echo $lista_retirada[0]['complemento_retirada']; } ?>" name="complemento_retirada" style="width: 300px"  />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo">Bairro:</span>
                                            <br />
                                            <input class="form-control" type="text" value="<?php if($retirada){ echo $lista_retirada[0]['bairro_retirada']; } ?>" name="bairro_retirada" style="width: 300px"  />
                                        </div>
                                        <!--estado e cidade-->
                                            <div class="item">
                                                <span class="item_titulo" for="uf">UF: </span>
                                                <br />
                                                <select class="form-control" id="estado_2" name="uf" onchange="buscar_cidades_2()">
                                                    <option></option>
                                                     <?php foreach ($estados as $value => $name) { ?>
                                                        <option <?php if($retirada){ if($lista_retirada[0]['uf_retirada']==$name['codigo_ibge']){ echo 'selected';}} ?> value="<?php echo $name['codigo_ibge'] ?>"><?php echo $name['uf'] ?></option>
                                                     <?php } ?>
                                                 </select>
                                            </div>
                                            <div class="item" id="load_cidades_2">
                                                 <span class="item_titulo" for="municipio">Município: </span>
                                                 <br />
                                                 <select class="form-control" class="cidade" name="municipio" style="width: 280px">
                                                    <option value="<?php if($retirada){ echo $lista_retirada[0]['cod_mun_retirada']."|".$lista_retirada[0]['mun_retirada'];} ?>"><?php echo utf8_encode($lista_retirada[0]['mun_retirada']) ?></option>
                                                 </select>
                                            </div>
                                        <!--fim estado cidade-->
                                        <button class="btn btn-sinfe-1 btn-block" style="position: relative; float: right" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" value="<?php if($retirada){ echo $lista_retirada[0]['id_retirada']; } ?>" onclick="cadastra_retirada();" name="post" >
                                            Atualizar
                                        </button>
                                        <br />
                                    </form>
                                </div>
                           </div>
                            
                        </div>
                        
                    </div>
                    
                    <!-- produtos -->
                    <div class="tab-pane fix" id="3a">
                         <div id="exTab1" class="container small-tab-1">
                            <!-- menu -->
                            <ul  class="nav nav-pills">
                                <li class="active">
                                    <a href="#1c" data-toggle="tab">Totais</a>
                                </li>
                                <li>
                                    <a href="#2c" data-toggle="tab">Novo Produto</a>
                                </li>
                            </ul>

                            <div class="tab-content clearfix">
                                
                                <!-- Totais -->
                                <div class="tab-pane active" id="1c">
                                    <center>
                                        <table id="lista">
                                            <tr id="lista_titulo" style="text-align: center">
                                                <td>
                                                    Nome
                                                </td>
                                                <td>
                                                    Quantidade
                                                </td>
                                                <td>
                                                    Valor Unit.
                                                </td>
                                                <td>
                                                    Desconto Unitário
                                                </td>
                                                
                                                <td>
                                                    Desconto da nota em %
                                                </td>
                                                <td>
                                                    Valor Total do Item
                                                </td>
                                                <td colspan="2">
                                                    Operações
                                                </td>
                                            </tr>
                                            <?php $total_tudo = 0; foreach ($item as $key) { ?>
                                                <!--traz o nome do produto-->
                                                <?php 
                                                    $produto_1 = produto_view_1($pdo,$key['id_produto']); 
                                                    //calcula o valor com desconto
                                                    $val_tot = number_format($key['val_total']-($key['val_total']/100*$key['val_desc_item'])-($key['val_desc_unit_item']),2,',',''); 
                                                ?>
                                                <tr id="lista_content">
                                                    <td>
                                                        <?php echo $produto_1[0]['descricao_produto'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $key['qtd_item'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo "R$".number_format($key['val_unit'],2,",",""); ?>
                                                    </td>
                                                    <td>
                                                        R$<?php echo number_format($key['val_desc_unit_item'],2,",",""); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($key['val_desc_item'],2,",","")."%" ?>
                                                    </td>
                                                    <td>
                                                        <?php echo "R$".$val_tot; $total_tudo += $val_tot ?>
                                                    </td>
                                                    
                                                    <td>
                                                        <form action="<?php if(@$xml[0]['transmitido_xml']!=1){echo "php/cadastra_desc_unit.php";} ?>" method="post">
                                                            <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                                            <input type="hidden" name="id_item" value="<?php echo $key['id_item'] ?>" />
                                                            <input autocomplete=off type="text" name="val_desc" placeholder="Desconto em valor" />
                                                        </form>
                                                    </td>

                                                    <td>
                                                        <form action="php/remove_item_mec_nfe.php" method="post" onsubmit="return confirm('Realmente deseja remover o item?');">
                                                            <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                                            <input type="hidden" name="id" value="<?php echo $key['id_item'] ?>" />
                                                            <button <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit">Remover</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr id="lista_content">
                                                <td colspan="4">
                                                    TOTAL DA VENDA:
                                                </td>
                                                <td colspan="4">
                                                    R$<?php echo number_format($total_tudo, 2, ',', '.'); ?>
                                                </td>
                                            </tr>
                                        </table>
                                        <!--  <form class="form form-inline" action="<?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "#";}}else{echo "php/cadastra_desc.php";} ?>" method="POST" >-->
                                        <form class="form form-inline" action="<?php if(@$xml[0]['transmitido_xml']!=1){echo "php/cadastra_desc.php";} ?>" method="POST" >
                                                <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                                <span>Desconto:</span>
                                                <br />
                                            <input class="form-control" type="text" name="val_desc" /> %
                                        </form>
                                    </center>
                                </div>
                                
                                <!-- Novo Produto -->
                                <div class="tab-pane" id="2c">
                                    
                                    <form class="form form-inline" action="php/add_item_mec_nfe.php" onsubmit="return confirm('As informações do Item foram devidamente inseridas?(O Item não poderá ser editado, somente removido.)');" method="post" id="novo_item">
                                    <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                      
                                        <div class="tab-pane" id="3a">
                                            <div id="exTab1" class="container small-tab-2">
                                               <!-- menu -->
                                               <ul  class="nav nav-pills">
                                                   <li class="active">
                                                       <a href="#1d" data-toggle="tab">Geral</a>
                                                   </li>
                                                   <li>
                                                       <a href="#2d" data-toggle="tab">ICMS</a>
                                                   </li>
                                                   <!--
                                                   <li>
                                                       <a href="#3d" data-toggle="tab">IPI</a>
                                                   </li>
                                                   -->
                                               </ul>

                                               <div class="tab-content clearfix">

                                                    <!-- Geral -->
                                                    <div class="tab-pane active" id="1d">
                                                        <div style="height: 430px !important">
                                                            <div class="item" style="padding-top: 12px;">
                                                                <span class="item_titulo">Produto:</span>
                                                                <select class="form-control" style="width: 578px" name="id_produto">
                                                                    <option value=""></option>
                                                                    <?php foreach($produto as $key){ ?>
                                                                        <option value="<?php echo $key['id_produto']."|".number_format($key['valor_produto'], 2, '.', ''); ?>"><?php echo $key['descricao_produto'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                            <div class="item">
                                                                <span class="item_titulo">Quantidade:</span>
                                                                <br />
                                                                <input class="form-control" type="text" name="qtd_item" />
                                                            </div>

                                                            <div class="item">	
                                                                <span class="item_titulo" for="cfop">CFOP: </span>
                                                                <br />
                                                                <select class="form-control" required name="cfop" style="width: 800px">
                                                                    <option></option>
                                                                    <?php foreach($cfop as $index=>$key){ ?>
                                                                        <option <?php if($key['id']=="5102"){echo "selected";} ?> value="<?php echo utf8_encode($key['id']) ?>"><?php echo utf8_encode($key['id']."-".substr($key['descricao'], 0, 80)."...") ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                            <div class="item">	
                                                                <span class="item_titulo" for="cfop">Indicador de Total: </span>
                                                                <br />
                                                                <select class="form-control" required name="ind_total" style="width: 180px">
                                                                    <option value="1">1 - sim</option>
                                                                    <option value="0">0 - não</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- ICMS -->
                                                    <div class="tab-pane" id="2d">
                                                        <div id="div_tot_icms" style="height: 430px;">
                                                            <div class="item">
                                                                <span class="item_titulo">Situação Tributária:</span>
                                                                <select class="form-control" id="sit_trib_select" required name="sit_trib" onchange="esconde();">
                                                                    <option></option>
                                                                    <option value="101">101 - Tributada com permissão de crédito</option>
                                                                    <option value="102">102 - Tributada sem permissão de crédito</option>
                                                                    <option value="103">103 - Isenção do ICMS para faixa de recita bruta</option>
                                                                    <option value="201">201 - Tributada com permissão de crédito e com cobrança do ICMS por ST</option>
                                                                    <option value="202">202 - Tributada sem permissão de crédito e com cobrança do ICMS por ST</option>
                                                                    <option value="203">203 - Isenção do ICMS para faixa de recita bruta e com cobrança do ICMS por ST</option>
                                                                    <option value="300">300 - Imune</option>
                                                                    <option value="400">400 - Não tributada</option>
                                                                    <option value="500">500 - ICMS cobrado anteriormente por ST ou por antecipação</option>
                                                                    <option value="900">900 - Outros</option>
                                                                </select>
                                                            </div>
                                                            <br />
                                                            <div class="item">
                                                                <span class="item_titulo">Origem:</span>
                                                                <select class="form-control" name="origem">
                                                                    <option value="0">0 - Nacional, exceto as indicadas nos códigos 3,4,5 E 8</option>
                                                                    <option value="1">1 - Estrangeira - Importação Direta, exceto a indicada no código 6</option>
                                                                    <option value="2">2 - Estrangeira - Adiquirida no Mercado Interno, exceto a indicada no código 7</option>
                                                                    <option value="3">3 - Nacional, mercadoria ou bem com conteúdo de Importação superior a 40% e inferior ou igual a 70%</option>
                                                                    <option value="4">4 - Nacional, cuja produção tenha sido feia em conformidade com os processos produtivos básicos de que tratam as legislações citadas nos Ajustes</option>
                                                                    <option value="5">5 - Nacional, mercadoria ou bem com conteúdo de Importação inferior ou igual a 40%</option>
                                                                    <option value="6">6 - Estrangeira - Importação diretta, sem similar nacional, constante em lista da CAMEX e gás natural</option>
                                                                    <option value="7">7 - Estrangeira - Adquirida no mercado interno, sem similar nacional, constante em lista da CAMEX e gás natural</option>
                                                                </select>
                                                            </div>
                                                            <br />
                                                            <div id="div_bc">
                                                                <div class="item">
                                                                    <span class="item_titulo">BC ICMS:</span>
                                                                    <input class="form-control" style="width: 150px" type="text" name="base_calc" />
                                                                </div>
                                                                <div class="item">
                                                                    <span class="item_titulo">alíquota apl. calc. de crédito:</span>
                                                                    <input class="form-control" style="width: 150px" type="text" name="aliq_calc_cred" />
                                                                </div>
                                                                <div class="item">
                                                                    <span class="item_titulo">Crédito ICMS aproveitado:</span>
                                                                    <input class="form-control" style="width: 150px" type="text" name="cred" />
                                                                </div>
                                                            </div>
                                                            <!-- ICMS -->
                                                            <div id="div_icms" class="item" style="margin: 0px">
                                                                ICMS
                                                                <br />
                                                                <div class="item" style="border: 1px solid #666; padding: 10px 10px 0px 10px">
                                                                    <div class="item">
                                                                        <span class="item_titulo">Modal. determ. da BC:</span>
                                                                        <select class="form-control" name="modbc">
                                                                            <option value=""></option>
                                                                            <option value="0">0 - Margem Valor Agregado (%)</option>
                                                                            <option value="1">1 - Pauta (Valor)</option>
                                                                            <option value="2">2 - Preço Tabelado Máx. (Valor)</option>
                                                                            <option value="3">3 - Valor da operação</option>
                                                                        </select>
                                                                    </div>
                                                                    <br />
                                                                    <div class="item">
                                                                        <span class="item_titulo">% de redução da BC ICMS:</span>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input class="form-control" type="text" name="p_reducao_bc" />
                                                                    </div>
                                                                    <br />
                                                                    <div class="item">
                                                                        <span class="item_titulo">BC ICMS:</span>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input class="form-control" type="text" name="vbc" />
                                                                    </div>
                                                                    <br />
                                                                    <div class="item">
                                                                        <span class="item_titulo">Alíquota do ICMS:</span>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;
                                                                        <input class="form-control" type="text" name="aliq" />
                                                                    </div>
                                                                    <br />
                                                                    <div class="item">
                                                                        <span class="item_titulo">ICMS da Operação:</span>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;
                                                                        <input class="form-control" type="text" name="val_op" />
                                                                    </div>
                                                                    <br />
                                                                    <div class="item" style="visibility: hidden">
                                                                        <span class="item_titulo"></span>
                                                                        <input class="form-control" type="text"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- ICMS ST -->
                                                            <div id="div_icmsst" class="item" style="margin: 0px">
                                                                ICMSST
                                                                <br />
                                                                <div class="item" style="border: 1px solid #666; padding: 10px 10px 0px 10px">
                                                                    <div class="item">
                                                                        <span class="item_titulo">Modal. determ. da BC:</span>
                                                                        &nbsp;
                                                                        <select class="form-control" name="modbcst">
                                                                            <option value=""></option>
                                                                            <option value="0">0 - Preço tab. ou máx. sugerido</option>
                                                                            <option value="1">1 - Lista Negativa (Valor)</option>
                                                                            <option value="2">2 - Lista Positiva (Valor)</option>
                                                                            <option value="3">3 - Lista Neutra (Valor)</option>
                                                                            <option value="4">4 - Margem Valor Agregado (%)</option>
                                                                            <option value="5">5 - Pauta (Valor)</option>
                                                                        </select>
                                                                    </div>
                                                                    <br />
                                                                    <div class="item">
                                                                        <span class="item_titulo">% de redução da BC ICMS ST:</span>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input class="form-control" type="text" name="p_reducao_bcst" />
                                                                    </div>
                                                                    <br />
                                                                    <div class="item">
                                                                        <span class="item_titulo">% margem de valor adic. ICMS ST:</span>
                                                                        &nbsp;
                                                                        <input class="form-control" type="text" name="p_m_vast" />
                                                                    </div>
                                                                    <br />
                                                                    <div class="item">
                                                                        <span class="item_titulo">BC ICMS ST:</span>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input class="form-control" type="text" name="vbcst" />
                                                                    </div>
                                                                    <br />
                                                                    <div class="item">
                                                                        <span class="item_titulo">Alíquota do ICMS ST:</span>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;
                                                                        <input class="form-control" type="text" name="aliq_st" />
                                                                    </div>
                                                                    <br />
                                                                    <div class="item">
                                                                        <span class="item_titulo">ICMS ST:</span>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        &nbsp;&nbsp;&nbsp;
                                                                        <input class="form-control" type="text" name="val_st" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- ICMS RETIDO -->
                                                            <div id="div_icmsret" class="item" style="margin: 0px">
                                                                ICMS Retido
                                                                <br />
                                                                <div class="item" style="border: 1px solid #666; padding: 10px 10px 0px 10px">
                                                                    <div class="item">
                                                                        <span class="item_titulo">BC ICMS ST retido anteriormente:</span>
                                                                        <input class="form-control" type="text" name="vbc_ret_ant_st" />
                                                                    </div>
                                                                    <div class="item">
                                                                        <span class="item_titulo">ICMS ST retido anteriormente:</span>
                                                                        <input class="form-control" type="text" name="v_ret_ant_st" />
                                                                    </div>
                                                                </div>
                                                                </div>
                                                        </div>
                                                    </div>

                                                    <!-- IPI -->
                                                    <div style="display: none;" class="tab-pane" id="3d">

                                                        <div id="div_ipi" style="height: 430px;">
                                                            <div class="item">
                                                                <span class="item_titulo">Situação Tributária:</span>
                                                                    <select class="form-control" required name="sit_ipi" style="width: 535px">
                                                                        <option></option>
                                                                        <option value="00">IPI 00 - Entrada com Recuperação de Crédito</option>
                                                                        <option value="01">IPI 01 - Entrada Tributada com Alíquota Zero</option>
                                                                        <option value="02">IPI 02 - Entrada Isenta</option>
                                                                        <option value="03">IPI 03 - Entrada Não Tributada</option>
                                                                        <option value="04">IPI 04 - Entrada Imune</option>
                                                                        <option value="05">IPI 05 - Entrada com Suspensão</option>
                                                                        <option value="49">IPI 49 - Outras Entradas</option>
                                                                        <option value="50">IPI 50 - Saída Tributada</option>
                                                                        <option value="51">IPI 51 - Saída Tributada com Alíquota Zero</option>
                                                                        <option selected value="52">IPI 52 - Saída Isenta</option>
                                                                        <option value="53">IPI 53 - Saída Não Tributada</option>
                                                                        <option value="54">IPI 54 - Saída Imune</option>
                                                                        <option value="55">IPI 55 - Saída com Suspensão</option>
                                                                        <option value="99">IPI 99 - Outras Saídas</option>
                                                                    </select>
                                                                </div>
                                                            <br />
                                                            <div class="item">
                                                                <span class="item_titulo">Classe de enquadramento:</span>
                                                                <input class="form-control" value="999" type="text" name="classe_enq_ipi" />
                                                            </div>
                                                            <div class="item">
                                                                <span class="item_titulo">Código de enquadramento:</span>
                                                                <input class="form-control" value="999" type="text" name="cod_enq_ipi" />
                                                            </div>
                                                            <br />
                                                            <div class="item">
                                                                <span class="item_titulo">Código de selo de controle:</span>
                                                                <input class="form-control" style="width: 480px" type="text" name="cod_selo_ipi" />
                                                            </div>
                                                            <br />
                                                            <div class="item">
                                                                <span class="item_titulo">Qtd. do selo de controle:</span>
                                                                &nbsp;&nbsp;
                                                                <input class="form-control" type="text" name="qtd_selo_ipi" />
                                                            </div>
                                                            <div class="item">
                                                                <span class="item_titulo">Tipo de cálculo:</span>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    &nbsp;
                                                                    <select class="form-control" style="width: 140px" name="tipo_calc_ipi">
                                                                        <option></option>
                                                                        <option value="0">Percentual</option>
                                                                        <option value="1">Em Valor</option>
                                                                    </select>
                                                                </div>
                                                            <br />
                                                            <div class="item">
                                                                <span class="item_titulo">Valor da base de cálculo:</span>
                                                                &nbsp;&nbsp;
                                                                <input class="form-control" type="text" name="val_bc_ipi" />
                                                            </div>
                                                            <br />
                                                            <div class="item">
                                                                <span class="item_titulo">Valor da alíquota:</span>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <input class="form-control" type="text" name="aliq_ipi" />
                                                            </div>
                                                            <br />
                                                            <div class="item">
                                                                <span class="item_titulo">Qtd. total unidade padrão:</span>
                                                                &nbsp;
                                                                <input class="form-control" type="text" name="qtd_tot_padr_ipi" />
                                                            </div>
                                                            <br />
                                                            <div class="item">
                                                                <span class="item_titulo">Valor por unidade:</span>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <input class="form-control" type="text" name="val_unid_ipi" />
                                                            </div>
                                                            <br />
                                                            <div class="item">
                                                                <span class="item_titulo">Valor do IPI:</span>  
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <input class="form-control" type="text" name="val_ipi" />
                                                            </div>
                                                            <br />

                                                        </div>  

                                                    </div>

                                              </div>

                                           </div>
                                       </div>
                                    
                                    <input style="margin: 5px;" class="btn btn-sinfe-1 btn-block" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" value="Adicionar" />
                                    </form>
                                    
                                </div>
                                    
                                
                           </div>
                            
                        </div>
                    </div>
                    
                    <!-- transporte -->
                    <div class="tab-pane fix" id="4a">
                      <form id="info_transp" action="" method="post">
                            <div class="item">
                                <span class="item_titulo">Modalidade do Frete: </span>
                                <br />
                                <select class="form-control" name="mod_frete">
                                   <option></option>
                                   <option <?php if($venda[0]['mod_frete']=="0"){echo 'selected="selected"';} ?> value="0">0 - Por conta do Emitente</option>
                                   <option <?php if($venda[0]['mod_frete']=="1"){echo 'selected="selected"';} ?> value="1">1 - Por conta do Destinatário/Remetente</option>
                                   <option <?php if($ind_transp){if($venda[0]['mod_frete']=="2"){echo 'selected="selected"';}} ?> value="2">2 - Por conta de Terceiros</option>
                                   <option <?php if($venda[0]['mod_frete']=="9"){echo 'selected="selected"';} ?> value="9">9 - Sem Frete</option>
                                </select>
                            </div>
                            <div class="item">
                                 <span class="item_titulo">Nome/Razão Social: </span>
                                 <br />
                                 <select class="form-control" id="id_transp_f" onchange="busca_transp();" style="width: 750px" name="nome_raz_soc" style="width: 100px">
                                    <option></option>
                                    <?php foreach($transp as $index=>$key){
                                        if($ind_transp){
                                            if($venda[0]['id_transp_nfe'] == $key['id_transportadora']){
                                                echo '<option selected value="'.$key['id_transportadora'].'">'.$key['nome_razao_social_transportadora'].'</option>';
                                            }else{
                                                echo '<option value="'.$key['id_transportadora'].'">'.$key['nome_razao_social_transportadora'].'</option>';
                                            }
                                        }else{
                                            echo '<option value="'.$key['id_transportadora'].'">'.$key['nome_razao_social_transportadora'].'</option>';
                                        }
                                     } ?>
                                 </select>
                            </div>
                            <div id="div_transp">
                                <div class="item">
                                    <span class="item_titulo">Código ANTT:</span>
                                    <br />
                                    <input class="form-control" value="<?php if($ind_transp){echo $venda[0]['cod_antt_nfe'];} ?>" name="cod_antt" type="text" style="width: 120px" />
                                </div>
                                <div class="item">
                                    <span class="item_titulo">Placa do Veículo:</span>
                                    <br />
                                    <input class="form-control" value="<?php if($ind_transp){echo $venda[0]['placa_veic_nfe'];} ?>" name="placa" type="text" style="width: 120px" />
                                </div>
                                <div class="item">
                                    <span class="item_titulo">UF do Veículo:</span>
                                    <br />
                                    <select class="form-control" name="uf_vei" id="uf_vei">
                                        <option></option>
                                         <?php foreach ($estados as $value => $name) { ?>
                                                <option <?php if($ind_transp){if($venda[0]['uf_veic_nfe']==$name['uf']){echo 'selected="selected"';}} ?> value="<?php echo $name['uf'] ?>"><?php echo $name['uf'] ?></option>
                                         <?php } ?>
                                     </select>
                                </div>
                                <div class="item">
                                    <span class="item_titulo">Tipo de Documento:</span>
                                    <br />
                                    <select class="form-control" name="tipo_doc" id="tipo_doc">
                                        <option></option>
                                        <option <?php if($ind_transp){if($venda[0]['tipo_doc_transp_nfe']=="1"){echo 'selected="selected"';}} ?> value="1">1 - CPF</option>
                                        <option <?php if($ind_transp){if($venda[0]['tipo_doc_transp_nfe']=="2"){echo 'selected="selected"';}} ?> value="2">2 - CNPJ</option>
                                     </select>
                                </div>
                                <div class="item">
                                    <span class="item_titulo">CPF/CNPJ:</span>
                                    <br />
                                    <input class="form-control" value="<?php if($ind_transp){echo $transp_venda[0]['cnpj_transportadora'];} ?>" name="cpf_cnpj" type="text" style="width: 120px" />
                                </div>
                                <div class="item">
                                    <span class="item_titulo">Logradouro:</span>
                                    <br />
                                    <input class="form-control" value="<?php if($ind_transp){echo $transp_venda[0]['logradouro_transportadora'];} ?>" type="text" name="logr_transp" style="width: 300px"  />
                                </div>
                                <div class="item">
                                    <span class="item_titulo" for="uf">UF: </span>
                                    <br />
                                    <select class="form-control" id="estado_transp" name="uf" onchange="buscar_cidades_transp()">
                                        <option></option>
                                         <?php foreach ($estados as $value => $name) { ?>
                                            <option <?php if($ind_transp){if($transp_venda[0]['uf_transportadora']==$name['uf']){ echo 'selected';}} ?> value="<?php echo $name['codigo_ibge']."|".$name['uf'] ?>"><?php echo $name['uf'] ?></option>
                                         <?php } ?>
                                     </select>
                                </div>
                                <div class="item" id="load_cidades_transp">
                                     <span class="item_titulo" for="municipio">Município: </span>
                                     <br />
                                     <select class="form-control" class="cidade" name="municipio" style="width: 280px">
                                        <option value="<?php if($ind_transp){echo $transp_venda[0]['cod_municipio_transportadora']."|".$transp_venda[0]['municipio_transportadora'];} ?>"><?php if($ind_transp){echo $transp_venda[0]['municipio_transportadora'];} ?></option>
                                     </select>
                                </div>
                                <div class="item">
                                    <span class="item_titulo">Inscrição Estadual:</span>
                                    <br />
                                    <input class="form-control" value="<?php if($ind_transp){echo $transp_venda[0]['inscricao_estadual_transportadora'];} ?>" type="text" name="ie_transp" style="width: 100px"  />
                                </div>
                                <br />
                            </div>
                            <div class="item">
                                <span class="item_titulo">Quantidade:</span>
                                <br />
                                <input class="form-control" value="<?php if($ind_transp){echo $venda[0]['qtd_vol_nfe'];} ?>" type="text" name="qtd_vol" style="width: 100px"  />
                            </div>
                            <div class="item">
                                <span class="item_titulo">Espécie:</span>
                                <br />
                                <input class="form-control" value="<?php if($ind_transp){echo $venda[0]['especie_vol_nfe'];} ?>" type="text" name="esp_vol" style="width: 150px"  />
                            </div>
                            <div class="item">
                                <span class="item_titulo">Marca:</span>
                                <br />
                                <input class="form-control" value="<?php if($ind_transp){echo $venda[0]['marca_vol_nfe'];} ?>" type="text" name="marca_vol" style="width: 150px"  />
                            </div>
                            <div class="item">
                                <span class="item_titulo">Numeração:</span>
                                <br />
                                <input class="form-control" value="<?php if($ind_transp){echo $venda[0]['num_vol_nfe'];} ?>" type="text" name="num_vol" style="width: 100px"  />
                            </div>
                            <div class="item">
                                <span class="item_titulo">Peso Bruto:</span>
                                <br />
                                <input class="form-control" value="<?php if($ind_transp){echo $venda[0]['peso_bruto_nfe'];} ?>" type="text" name="peso_b_vol" style="width: 100px"  />
                            </div>
                            <div class="item">
                                <span class="item_titulo">Peso Líquido:</span>
                                <br />
                                <input class="form-control" value="<?php if($ind_transp){echo $venda[0]['peso_liq_nfe'];} ?>" type="text" name="peso_l_vol" style="width: 100px"  />
                            </div>
                            <div class="item">
                                <span class="item_titulo">Valor:</span>
                                <br />
                                <input class="form-control" value="<?php if($ind_transp){echo $venda[0]['val_transp_nfe'];} ?>" type="text" name="val_transp" style="width: 100px"  />
                            </div>
                            
                            <button class="btn btn-sinfe-1 btn-block" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> onclick="aponta_transp();" type="submit">Atualizar</button>
                        </form>
                    </div>  
                    
                    <!-- cobranca -->
                    <div class="tab-pane fix" id="5a">
                      <article id="fatura" style="padding: 10px;">
                        <center>
                            <div class="roll-200-a">
                                <table id="lista">
                                    <tr id="lista_titulo" style="text-align: center">
                                        <td>
                                            Número
                                        </td>
                                        <td>
                                            Vencimento
                                        </td>
                                        <td>
                                            Valor
                                        </td>
                                        <td>
                                            Op.
                                        </td>
                                    </tr>
                                    <?php foreach ($fat as $key) { ?>
                                        <tr id="lista_content">
                                            <td>
                                                <?php echo $key['num_fatura'] ?>
                                            </td>
                                            <td>
                                                <?php echo implode("/",array_reverse(explode("-",$key['vencimento_fatura']))) ?>
                                            </td>
                                            <td>
                                                R$<?php echo number_format($key['val_fatura'],2,',','') ?>
                                            </td>
                                            <td>
                                                <form action="php/remove_fat.php" method="post" onsubmit="return confirm('Realmente deseja remover o item?');">
                                                    <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                                    <input type="hidden" name="id" value="<?php echo $key['id_fatura'] ?>" />
                                                    <button <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit">Remover</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <br />
                            <form id="fatura" method="post" class="form form-inlne" action="php/add_fatura.php">

                                <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                <input type="hidden" name="num_fat" value="<?php echo  substr($venda[0]['cod_numero_nfe'],0,4) ?>" />

                                <div class="item">
                                    <span>Vencimento: </span>
                                    <br />
                                    <input required class="form-control" placeholder="dd/mm/aaaa" type="date" style="width: 200px" name="vencimento" value="" />
                                </div>

                                <div class="item">
                                    <span>Valor: </span>
                                    <br />
                                    <input required class="form-control" type="number" step=".01" name="valor" value="" />
                                </div>

                                <br />
                                <br />

                                <button class="btn btn-sinfe-1 btn-block" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="">
                                    Adicionar Fatura
                                </button>

                            </form>
                        </center>
                      </article>
                    </div>
                    
                    <!-- info. adicional -->
                    <div class="tab-pane fix" id="6a">
                      <article id="adicional">
                        <form method="post" action="php/adicional_nfe.php" class="form form-inline">
                            <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                            <center>
                                <div class="item" id="adicional">
                                    <span>Informação Complementar</span>
                                    <br />
                                    <textarea placeholder="<?= INFO_COMPL; ?>" class="form-control" cols="50" rows="10" name="compl"><?php if($venda[0]['inf_ad_compl_nfe']!=''){echo $venda[0]['inf_ad_compl_nfe'];}else{} ?></textarea>
                                </div>
                                <div class="item" id="adicional">
                                    <span>Informação do Fisco</span>
                                    <br />
                                    <textarea placeholder="<?= INFO_FISCO; ?>" class="form-control" cols="50" rows="10" name="fisco"><?php if($venda[0]['inf_ad_fisco_nfe']!=''){echo $venda[0]['inf_ad_fisco_nfe'];}else{} ?></textarea>
                                </div>
                            </center>
                            <br />
                            <button class="btn btn-sinfe-1 btn-block" type="submit">Salvar</button>
                        </form>
                        <br />
                    </article>
                  </div>  
                    
                    <!-- NF-e referencia -->
                    <div class="tab-pane fix" id="7a">
                        <center>
                        <article id="referencia">
                            <br />
                            <div class="roll-200-a">
                                <table id="lista">
                                    <tr id="lista_titulo" style="text-align: center">
                                        <td>
                                            Chave
                                        </td>
                                        <td>
                                            Op.
                                        </td>
                                    </tr>
                                    <?php foreach ($nref as $key) { ?>
                                        <tr id="lista_content">
                                            <td>
                                                <?php echo $key['chave_nref'] ?>
                                            </td>
                                            <td>
                                                <form action="php/remove_nref.php" method="post" onsubmit="return confirm('Realmente deseja remover o item?');">
                                                    <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                                    <input type="hidden" name="id" value="<?php echo $key['id_nref'] ?>" />
                                                    <button <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit">Remover</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            
                            <br />
                            
                            <form id="referencia" method="post" action="php/add_nref.php" class="form form-inline">
                                
                                <div class="item" id="load_cidades_3">
                                    <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                    
                                    <span>Nova Chave</span>
                                    <br />
                                    <input 
                                        pattern=".{44,44}" 
                                        required class="form-control" 
                                        style="width: 400px" 
                                        type="text" 
                                        minlegth="44" 
                                        name="chave" 
                                        value="" 
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                    />
                                </div>
                              
                                <button class="btn btn-sinfe-1 btn-block" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="">
                                    Registrar Nova Nfe Ref.
                                </button>
                                
                            </form>
                        </article>
                      </center>
                    </div>
                    
                    <!-- CCE -->
                    <div class="tab-pane fix" id="8a">
                        <?php 
                        $cce = $pdo->query('SELECT * FROM tab_cce WHERE id_venda = ' . $venda[0]['id_nfe'] .' ORDER BY num_seq_cce '); 
                        $cce = $cce->fetchAll();
                        ?>
                        <article id="cce" >
                            <center>
                                <div class="roll-200">
                                    <table id="lista">
                                        <tr id="lista_titulo" style="text-align: center">
                                            <td>
                                                Ordem
                                            </td>
                                            <td>
                                                Op.
                                            </td>
                                        </tr>
                                        <?php foreach ($cce as $key) { ?>
                                            <tr id="lista_content">
                                                <td>
                                                    <?php echo "Carta nr° - ".$key['num_seq_cce'] ?>
                                                </td>
                                                <td>
                                                    <form target="blank" action="php/Dacce.php" method="post">
                                                        <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                                        <input type="hidden" name="id" value="<?php echo $key['id_cce'] ?>" />
                                                        <button type="submit">Imprimir</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </center>

                            <br />

                            <form class="form form-inline" id="cartace" method="post" action="php/gera_cce.php">
                                <center>
                                    <div class="item">
                                        <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                        <input type="hidden" name="modelo" value="55" />
                                        <textarea minlength="15" class="form-control" placeholder="Correção Aqui." cols="100" rows="10" name="motivo" id="mot_canc"></textarea>
                                    </div>
                                </center>
                                <br />
                                <button <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){}else{echo "disabled";}}else{echo "disabled";} ?> class="btn btn-primary btn-block" type="submit" >Registrar</button>
                            </form>
                            <br />
                        </article>	    		
                    </div>
                    
                </div>
                
            </div>
            
            <!-- botoes -->
            <div style="padding-left: 10px">
                
                <input class="btn btn-default" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="submitForm('php/edita_venda_mec.php');" value="Salvar" />
                <button class="btn btn-default" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="gera_nfe();" name="id" value="<?php echo $venda[0]['id_nfe'] ?>">Gerar Nfe</button>
                <button class="btn btn-default" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="assina_nfe();" name="id_as1" value="<?php echo $venda[0]['id_nfe'] ?>">Assinar Nfe</button>
                <!-- <button class="btn btn-default" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="valida_nfe();" name="id_va" value="<?php echo $venda[0]['id_nfe'] ?>">Validar Nfe</button>-->
                <button class="btn btn-default" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="transmite_nfe();" name="id_en" value="<?php echo $venda[0]['id_nfe'] ?>">Transmitir Nfe</button>
                
                <?php 
                //if($ind_xml){
                    if(@$xml[0]['transmitido_xml']==1){
                        ?>
                        <button class="btn btn-success" type="submit" onclick="submitForm('php/danfe nfe.php');" name="id_df" value="<?php echo $venda[0]['id_nfe'] ?>">
                            Impressão da DANFE
                        </button> 
                        <?php
                    }else{
                        ?>
                        <button class="btn btn-warning" type="submit" onclick="submitForm('php/danfe nfe.php');" name="id_df" value="<?php echo $venda[0]['id_nfe'] ?>">
                            Prévia da DANFE
                        </button> 
                        <?php
                    }
                //} 
                ?>
                
                <button class="btn btn-sinfe-1" type="submit" onclick="submitForm('php/duplica_venda_mec.php');">Duplicar Nota</button>
                <button class="btn btn-sinfe-1" type="submit" onclick="submitForm('php/exporta_xml_nfe.php');">Exportar XML</button>
                
            </div>
            
            <br />
            
            <!-- mensagens de retorno -->
	    	<div class="panel panel-default corpo">
                <div style="font-size: 14pt" class="panel-heading">
                    Mensagens
                </div>
                <div class="panel-body">
                    <article id="erro"  style="padding: 10px;">
                        <div id="teste"></div>	
                        <div id="err"></div>
                    </article>
                </div>
            </div>
	    	
	    	<!--         CANCELAMENTO          -->
            <div class="panel panel-default corpo">
                <div style="font-size: 14pt" class="panel-heading">
                    Cancelamento - 
                    <a href="javascript:void(0);" onclick="$('#cancelamento').slideToggle(600);">+</a>
                    /
                    <a href="javascript:void(0);" onclick="$('#cancelamento').slideToggle(600);">-</a>
                 </div>
                 <div class="panel-body">
                    <article id="cancelamento" >
                        <form class="form form-inline" id="cancelamento" method="post" action="php/cancela nfe_nfe.php">
                            <center>
                                <div class="item" id="load_cidades_3">
                                    <br />
                                    <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                    <textarea class="form-control" placeholder="Motivo do cancelamento aqui." cols="100" rows="10" name="motivo" id="mot_canc"></textarea>
                                </div>
                            </center>
                            <br />
                            <button class="btn btn-danger btn-block" type="submit" onclick="cancela_nfe();">Cancelar</button>
                        </form>
                        <br />
                    </article>
                 </div>
            </div>
            
    	</div>
        
        <!-- não apaga essa caceta -->
    	<!--
    	<br />
		    <form onsubmit="return confirm('Os itens serão abatidos do estoque. NÃO continue em caso de DEVOLUÇÃO!');" action="php/fecha_venda.php" method="post" style="display: inline-block">
	    		<input name="total" type="hidden" value="<?php echo $total_tudo ?>" />
	    		<input name="id" type="hidden" value="<?php echo $_GET['id'] ?>" />
	    		<center>
	    			<input type="submit" value="Fechar Venda" />
	    		</center>
	    	</form>
	    	&nbsp;&nbsp;&nbsp;&nbsp;
	    	<form action="php/gera_orcamento.php" method="post" style="display: inline-block">
	    		<input name="total" type="hidden" value="<?php echo $total_tudo ?>" />
	    		<input name="id" type="hidden" value="<?php echo $_GET['id'] ?>" />
	    		<center>
	    			<input <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" value="Gerar Orcamento" />
	    		</center>
	    	</form>
	    -->
    	
    </section>
    
  </body>
  
</html>
