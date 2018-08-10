<?php
	
	include "php/conection.php";
	include "php/querys.php";

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
	$data_emis = explode(" ",$venda[0]['data_emis_nfe']); 
	$data_emis = explode("-",$data_emis[0]); 
	$data_emis = $data_emis[2]."/".$data_emis[1]."/".$data_emis[0];
	
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
    
    <meta name="keywords" content="css4html, css+for+html, css 4 html, css4, css4 html, css, css3, html, html5" />

    <meta property="og:image" content="http://palloi.github.io/responsive-header-only-css/assets/images/image-shared-2.png" />
    <meta property="og:keywords" content="css4html, css+for+html, css 4 html, css4, css4 html, css, css3, html, html5" />
    
    <link rel="stylesheet" type="text/css" href="css/css_section.css" />
    <link rel="stylesheet" type="text/css" href="css/css_menu.css" />
    
    <link rel="stylesheet" type="text/css" href="css/ativos.css" />
    
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
    <style type="text/css" media="all">
			
			#cadastro {
			  padding: 80px 00px 50px;
			  border-top: 1px solid #ccc;
			  font-size: 20px;
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
			
	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
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
	      var cpf_cnpj = $('#info [name=cpf_cnpj]').val();
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
	      if(id){
	        var url = 'php/ajax_aponta_transp.php?id='+id+'&id_transp='+id_transp+'&mod='+mod_frete+'&antt='+antt+'&placa='+placa+'&uf='+uf+'&tipo_doc='+tipo_doc+'&qtd='+qtd+'&esp='+esp+'&marca='+marca+'&num='+num+'&pesob='+pesob+'&pesol='+pesol; 
	        $.get(url, function(dataReturn) {
	          $('#teste').html(dataReturn);
	        });
	      }
	    }
	    
	    function cancela_nfe(){
	      var id = $('#cancelamento [name=id_nfe]').val();
	      var motivo = $('#cancelamento [name=motivo]').val();
	      if(id && motivo){
	        var url = 'php/cancela nfe.php?id_nfe='+id+'&motivo='+motivo;
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
	    	var op = $('#novo_item [name=sit_trib] option:selected').val();
	    	
	    	if(op=='101'){
	    		$("#div_icms").hide();
	    		$("#div_icmsst").hide();
	    		$("#div_icmsret").hide();
	    		$("#div_bc").show();
	    	}
	    	if(op=='102' || op=='103' || op=='300' || op=='400'){
	    		$("#div_icms").hide();
	    		$("#div_icmsst").hide();
	    		$("#div_icmsret").hide();
	    		$("#div_bc").hide();
	    	}
	    	if(op=='201'){
	    		$("#div_icms").hide();
	    		$("#div_icmsst").show();
	    		$("#div_icmsret").hide();
	    		$("#div_bc").show();
	    	}
	    	if(op=='202' || op=='203'){
	    		$("#div_icms").hide();
	    		$("#div_icmsst").show();
	    		$("#div_icmsret").hide();
	    		$("#div_bc").hide();
	    	}
	    	if(op=='500'){
	    		$("#div_icms").hide();
	    		$("#div_icmsst").hide();
	    		$("#div_icmsret").show();
	    		$("#div_bc").hide();
	    	}
	    	if(op=='900'){
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
		    
		    $("#transp").hide();
		    $('#referencia').hide();
		    $('#cancelamento').hide();
		    $('#fatura').hide();
		    $('#venda_1').hide();
		    $('#venda_ent').hide();
		    $('#adicional').hide();
		    
		    $("#div_tot_icms").hide();
		    $("#div_ipi").hide();
		    $("#new_prod").hide();
		    $("#pg").hide();
		    
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
    </header>
    <section id="cadastro">
    	
    	<div id="corpo">
    		<form id="info" method="post">
	    		<label id="titulo" for="cliente">Dados da nota</label>
	    		<article id="venda" class="grupo">
	    			<?php date_default_timezone_set('America/Sao_Paulo');  ?>
					<input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
    				<div class="item">
	    				<label class="item_titulo">*Natureza da Op.: </label>
	    				<br />
	    				<input type="text" name="nop" value="<?php echo $venda[0]['nop_nfe'] ?>" style="width: 100px">
    				</div>
    				<div class="item">
    					<input type="hidden" name="numero_nfe" value="<?php echo $venda[0]['num_nfe'] ?>" />
	    				<label class="item_titulo">Número ERP: </label>
	    				<br />
	    				<label><?php echo $venda[0]['num_nfe'] ?></label>
    				</div>
    				<div class="item">
    					<input type="hidden" name="cod_numero" value="<?php echo $venda[0]['cod_numero_nfe'] ?>" />
	    				<label class="item_titulo">C.Número: </label>
	    				<br />
	    				<label><?php echo $venda[0]['cod_numero_nfe'] ?></label>
    				</div>
    				<div class="item">
	    				<label class="item_titulo">Modelo:</label>
	    				<br />
	    				<select name="modelo" style="width: 100px">
	    					<option <?php if($venda[0]['modelo_nfe']=="55"){ echo "selected"; } ?> value="55">55 - NFe</option>
	    					<option <?php if($venda[0]['modelo_nfe']=="65"){ echo "selected"; } ?> value="65">65 - NFCe</option>
	    				</select>
    				</div>
    				<div class="item">
	    				<label class="item_titulo">Série:</label>
	    				<br />
	    				<input type="hidden" value="<?php echo $venda[0]['serie_nfe'] ?>" name="serie" style="width: 50px" />
	    				<label><?php echo $venda[0]['serie_nfe'] ?></label>
	    			</div>
	    			<div class="item">
    					<label class="item_titulo">Data Emiss.:</label>
    					<br />
    					<input type="text" value="<?php echo $data_emis ?>" name="data_emis" value="<?php echo date("d/m/Y") ?>" style="width: 80px" />
					</div>
					<div class="item">
    					<label class="item_titulo">Data Entrada/Saída: </label>
    					<br />
    					<input type="text" name="data_saida_entrada" value="<?php echo $data_s ?>" style="width: 80px" />
					</div>
					<div class="item">
    					<label class="item_titulo">Hora Entrada/Saída: </label>
    					<br />
    					<label><?php echo $hora_s ?></label>
    					<input type="hidden" name="hora_saida_entrada" value="<?php echo $hora_s ?>" />
					</div>
					<!--estado e cidade-->
					<div class="item">
		    			<label class="item_titulo" for="uf">UF: </label>
		    			<br />
		    			<select id="estado_1" name="uf_1" id="uf" onchange="buscar_cidades_1()">
		    				<option></option>
							 <?php foreach ($estados as $value => $name) { ?>
						        	<option <?php if($venda[0]['uf_nfe']==$name['codigo_ibge']){ echo 'selected';} ?> value="<?php echo $name['codigo_ibge']."|".$name['uf'] ?>"><?php echo $name['uf'] ?></option>
						     <?php } ?>
						 </select>
					</div>
					<div class="item" id="load_cidades_1">
						 <label class="item_titulo" for="municipio">Município: </label>
						 <br />
						 <select class="cidade" name="municipio_1" style="width: 280px">
						 	<option value="<?php echo $venda[0]['cod_municipio_ocorrencia_nfe'] ?>"><?php echo utf8_encode($nome_municipio[0]['nome']) ?></option>	
						 </select>
					</div>
					<!--fim estado cidade-->
					<div class="item">
						 <label class="item_titulo">Tipo de Nfe: </label>
						 <br />
						 <select name="tipo_documento" style="width: 100px">
						 	<option <?php if($venda[0]['tipo_documento_nfe']=="0"){echo 'selected="selected"';} ?> value="0">Entrada</option>
						 	<option <?php if($venda[0]['tipo_documento_nfe']=="1"){echo 'selected="selected"';} ?> value="1">Saída</option>		
						 </select>
					</div>
					<div class="item">
						 <label class="item_titulo">Destino da Op.: </label>
						 <br />
						 <select name="destino_operacao" style="width: 160px">
						 	<option <?php if($venda[0]['destino_operacao_nfe']=="1"){echo 'selected="selected"';} ?> value="1">Operação Interna</option>
						 	<option <?php if($venda[0]['destino_operacao_nfe']=="2"){echo 'selected="selected"';} ?> value="2">Operação Interestadual</option>	
						 	<option <?php if($venda[0]['destino_operacao_nfe']=="3"){echo 'selected="selected"';} ?> value="3">Operação com Exterior</option>		
						 </select>
					</div>
					<div class="item">
						 <label class="item_titulo">Tipo de DANFE: </label>
						 <br />
						 <select name="tipo_impressao" style="width: 295px">
						 	<option value="0">Sem Geração de DANFE</option>
						 	<option selected value="1">DANFE normal, retrato</option>	
						 	<option value="2">DANFE normal, paisagem</option>
						 	<option value="3">DANFE simplificado</option>
						 	<option value="4">DANFE NFC-e</option>
						 	<option value="5">DANFE NFC-e em mensagem eletrônica</option>		
						 </select>
					</div>
					<div class="item">
						 <label class="item_titulo">Tipo de Emissão: </label>
						 <br />
						 <select name="tipo_emissao" style="width: 250px">
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
						 <label class="item_titulo">Finalidade de Emissão: </label>
						 <br />
						 <select name="finalidade_emissao" style="width: 250px">
						 	<option <?php if($venda[0]['finalidade_emissao_nfe']=="1"){echo 'selected="selected"';} ?> value="1">NF-e Normal</option>
						 	<option <?php if($venda[0]['finalidade_emissao_nfe']=="2"){echo 'selected="selected"';} ?> value="2">NF-e complementar</option>	
						 	<option <?php if($venda[0]['finalidade_emissao_nfe']=="3"){echo 'selected="selected"';} ?> value="3">NF-e de ajuste</option>
						 	<option <?php if($venda[0]['finalidade_emissao_nfe']=="4"){echo 'selected="selected"';} ?> value="4">Devolução/Retorno</option>	
						 </select>
					</div>
					<div class="item">
						 <label class="item_titulo">Cunsumidor Final: </label>
						 <br />
						 <select name="consumidor_final" style="width: 50px">
						 	<option <?php if($venda[0]['comprador_final_nfe']=="1"){echo 'selected="selected"';} ?> value="1">Sim</option>
						 	<option <?php if($venda[0]['comprador_final_nfe']=="0"){echo 'selected="selected"';} ?> value="0">Não</option>
						 </select>
					</div>
					<div class="item">
						 <label class="item_titulo">Presença do Comprador: </label>
						 <br />
						 <select name="presenca_comprador" style="width: 330px">
						 	<option <?php if($venda[0]['presenca_comprador_nfe']=="0"){echo 'selected="selected"';} ?> value="0">Não se aplica</option>
						 	<option <?php if($venda[0]['presenca_comprador_nfe']=="1"){echo 'selected="selected"';} ?> value="1">Operação Presencial</option>	
						 	<option <?php if($venda[0]['presenca_comprador_nfe']=="2"){echo 'selected="selected"';} ?> value="2">Operação não Presencial, Internet</option>
						 	<option <?php if($venda[0]['presenca_comprador_nfe']=="3"){echo 'selected="selected"';} ?> value="3">Operação não Presencial, Teleatendimento</option>
						 	<option <?php if($venda[0]['presenca_comprador_nfe']=="4"){echo 'selected="selected"';} ?> value="4">NFC-e em operação com entrega a domicílio</option>
						 	<option <?php if($venda[0]['presenca_comprador_nfe']=="9"){echo 'selected="selected"';} ?> value="9">Operação não presencial, outros</option>	
						 </select>
					</div>
					<div class="item">
						 <label class="item_titulo">Processo de Emiss.: </label>
						 <br />
						 <select name="procemi" style="width: 370px">
						 	<option <?php if($venda[0]['procemi_nfe']=="0"){echo 'selected="selected"';} ?> value="0">Emissão de NF-e com aplicativo do contribuinte</option>
						 	<option <?php if($venda[0]['procemi_nfe']=="1"){echo 'selected="selected"';} ?> value="1">Emissão de NF-e avulsa pelo Fisco</option>	
						 	<option <?php if($venda[0]['procemi_nfe']=="2"){echo 'selected="selected"';} ?> value="2">Emissão de NF-e com Certificado, pelo Fisco</option>
						 	<option <?php if($venda[0]['procemi_nfe']=="3"){echo 'selected="selected"';} ?> value="3">Emissão de NF-e com aplicativo fornecido pelo Fisco</option>	
						 </select>
					</div>
					<div class="item">
						 <label class="item_titulo">Forma de Pag.: </label>
						 <br />
						 <select name="forma_pg" style="width: 100px">
						 	<option <?php if($venda[0]['forma_pagamento']=="0"){echo 'selected="selected"';} ?> value="0">Á Vista</option>
						 	<option <?php if($venda[0]['forma_pagamento']=="1"){echo 'selected="selected"';} ?> value="1">Á Prazo</option>	
						 	<option <?php if($venda[0]['forma_pagamento']=="2"){echo 'selected="selected"';} ?> value="2">Outros</option>
						 </select>
					</div>
					<div class="item">
						<input type="hidden" name="versao" value="0.5" />
						 <label class="item_titulo">Versão do Aplicativo: </label>
						 <br />
						 <label>0.5</label>
						 </select>
					</div>
					
					<div class="item">
						 <label class="item_titulo">Assinatura: </label>
						 <br />
						 <select name="assinatura" style="width: 100px">
						 	<option>A1</option>
						 	<option>A3</option>
						 </select>
					</div>
					
					<!--<input type="hidden" name="assinatura" value="A1" />-->
					<input type="hidden" name="id_as" value="<?php echo $venda[0]['id_nfe'] ?>" />
					<input type="hidden" name="id_va" value="<?php echo $venda[0]['id_nfe'] ?>" />
					<input type="hidden" name="id_en" value="<?php echo $venda[0]['id_nfe'] ?>" />
	    		</article>
	    		<br/>
	    		<div style="padding-left: 10px">
	    			<input <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="submitForm('php/edita_venda_mec.php');" value="Salvar" />
	    			<button <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="gera_nfe();" name="id" value="<?php echo $venda[0]['id_nfe'] ?>">Gerar Nfe</button>
	    			<button <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="assina_nfe();" name="id_as1" value="<?php echo $venda[0]['id_nfe'] ?>">Assinar Nfe</button>
	    			<button <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="valida_nfe();" name="id_va" value="<?php echo $venda[0]['id_nfe'] ?>">Validar Nfe</button>
	    			<button <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="transmite_nfe();" name="id_en" value="<?php echo $venda[0]['id_nfe'] ?>">Transmitir Nfe</button>
	    			<button type="submit" onclick="submitForm('php/duplica_venda_mec.php');">Duplicar</button>
	    			<button type="submit" onclick="submitForm('php/danfe nfe.php');" name="id_df" value="<?php echo $venda[0]['id_nfe'] ?>">Impressão da DANFE</button>
	    			<button type="submit" onclick="submitForm('php/exporta_xml.php');">Exportar XML</button>
	    		</div>
	    		<br />
	    	<!-- </form> -->
	    	
	    	
	    	<article id="erro" class="grupo" style="padding: 10px;">
	    		<div id="teste"></div>	
	    		<div id="err"></div>
	    	</article>
	    	
	    	<label id="titulo" for="cliente">Destinatário</label>
	    	<article id="dest" class="grupo">	
	    		<div>
	    			<!-- <form id="info_dest" method="post"> -->
	    				<div class="item">
		    				<label class="item_titulo" for="nome_razao social">*Pesquisa por Nome/Razão Social: </label>
		    				<br/>
		    				<select id="nome_cliente" name="nome/razao_social" onchange="busca_cliente();" style="width: 1140px; min-width: 400px;">
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
    					<label>Cliente Avulso: </label><input type="checkbox" name="avulso" value="1"/>
    					<font size="3"><u>Em caso de cliente avulso, marque a caixa ao lado e preencha os campos abaixo:</u></font>
    					<br />
    					<div class="item">
    						<label class="item_titulo" for="nome_razao social">*Nome/Razão Social: </label>
    						<br />
    						<input type="text" name="nome_avulso" style="width: 1140px; min-width: 400px;">
    					</div>
		    			<div id="div_dest">
		    				<div class="item">
								<label class="item_titulo" for="CPF/CNPJ">Tipo de Documento: </label>
								<br />
								<select required id="tipo_doc" name="tipo_doc" style="width: 126px; min-width: 126px;">
									<option value="1">CPF</option>
									<option value="2">CNPJ</option>
								</select>
							</div>
							<div class="item">
								<label class="item_titulo" for="CPF/CNPJ">CPF/CNPJ: </label>
								<br />
								<input value="<?php if($cliente_n){echo $cliente_nfe[0]['cpf_cnpj_cliente'];} ?>" type="text" name="cpf_cnpj" style="width: 100px; min-width: 100px;" />
							</div>
							<div class="item">
								<label class="item_titulo" for="inscricao estadual">Inscrição Estadual: </label>
								<br />
								<input value="<?php if($cliente_n){echo $cliente_nfe[0]['inscricao_estadual_cliente'];} ?>" type="text" name="inscricao_estadual" style="width: 150px; min-width: 126px;" />
							</div>
							<div class="item">
								<label class="item_titulo" for="inscricao estadual">Inscrição Municipal: </label>
								<br />
								<input type="text" name="inscricao_municipal" style="width: 150px; min-width: 126px;" />
							</div>
							<div class="item">
								<label class="item_titulo">Isento do ICMS</label>
								<br />
								<input <?php if($cliente_n){if($cliente_nfe[0]['isento_icms_cliente']=="sim"){echo 'checked';}} ?> class="item_titulo" type="checkbox" name="isencao_icms" value="1">
							</div>
							<div class="item">
								<label class="item_titulo" for="SUFRAMA">Inscrição SUFRAMA: </label>
								<br />
								<input value="<?php if($cliente_n){echo $cliente_nfe[0]['inscricao_suframa_cliente'];} ?>" type="text" name="suframa" style="width: 150px; min-width: 84px;" />
							</div>
							<div class="item">
								<label class="item_titulo" for="email">Email: </label>
								<br />
								<input value="<?php if($cliente_n){echo $cliente_nfe[0]['email_cliente'];} ?>" type="text" name="email" style="width: 220px; min-width: 220px;" />
							</div>
							<!--                  ENDEREÇO                 -->
							<div class="item">
								<label class="item_titulo" for="Logradouro">Logradouro: </label>
								<br />
								<input value="<?php if($cliente_n){echo $cliente_nfe[0]['logradouro_cliente'];} ?>" type="text" name="logradouro" style="width: 660px; min-width: 362px;" />
							</div>
							<div class="item">
								<label class="item_titulo" for="numero">Número: </label>
								<br />
								<input value="<?php if($cliente_n){echo $cliente_nfe[0]['numero_cliente'];} ?>" type="text" name="numero" style="width: 80px; min-width: 33px;" />
							</div>
							<div class="item">
								<label class="item_titulo" for="complmento">Complemento: </label>
								<br />
								<input value="<?php if($cliente_n){echo $cliente_nfe[0]['complemento_cliente'];} ?>" type="text" name="complemento" style="width: 340px; min-width: 126px;" />
							</div>
							<div class="item">
								<label class="item_titulo" for="bairro">Bairro: </label>
								<br />
								<input value="<?php if($cliente_n){echo $cliente_nfe[0]['bairro_cliente'];} ?>" type="text" name="bairro" style="width: 270px; min-width: 126px;" />
							</div>
							<div class="item">
								<label class="item_titulo" for="CEP">CEP: </label>
								<br />
								<input value="<?php if($cliente_n){echo $cliente_nfe[0]['cep_cliente'];} ?>" type="text" name="cep" style="width: 100px; min-width: 113px;" />
							</div>
							<div class="item">
								<label class="item_titulo" for="uf">UF: </label>
								<br />
								<select id="estado_dest" name="uf" id="uf" onchange="buscar_cidades_dest()">
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
								 <label class="item_titulo" for="municipio">Município: </label>
								 <br />
								 <select id="cidade" name="municipio" style="width: 310px; min-width: 113px;">
								 	<option value="<?php if($cliente_n){echo $cliente_nfe[0]['cod_municipio_cliente'];} ?>"><?php if($cliente_n){echo $cliente_nfe[0]['municipio_cliente'];} ?></option>	
								 </select>
							</div>
							<div class="item">
								 <label class="item_titulo" for="telefone">Telefone: </label>
								 <br />
								 <input value="<?php if($cliente_n){echo $cliente_nfe[0]['telefone_cliente'];} ?>" type="text" name="telefone" style="width: 220px; min-width: 92px;" />
							</div>
			    		</div>
	    				<button style="position: relative; float: right" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="aponta_cliente();" name="id">Salvar Cliente</button>
	    				<br />
	    			</form>
	    		</div>
	    	</article>
	    	
	    	<!-- TRANSPORTADORA -->
	    	
	    	<br />
	    	<label id="titulo" for="cliente">Transporte - 
	    		<a href="javascript:void(0);" onclick="$('#transp').show();">+</a>
	    		/
	    		<a href="javascript:void(0);" onclick="$('#transp').hide();">-</a>
	    	</label>
	    	<article id="transp" class="grupo" style="padding: 10px;">
	    		<form id="info_transp" action="" method="post">
	    			<div class="item">
						 <label class="item_titulo">Nome/Razão Social: </label>
						 <br />
						 <select id="id_transp_f" onchange="busca_transp();" style="width: 1140px" name="nome_raz_soc" style="width: 100px">
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
							 <label class="item_titulo">Modalidade do Frete: </label>
							 <br />
							 <select name="mod_frete">
							 	<option></option>
							 	<option <?php if($ind_transp){if($venda[0]['mod_frete']=="0"){echo 'selected="selected"';}} ?> value="0">0 - Por conta do Emitente</option>
							 	<option <?php if($ind_transp){if($venda[0]['mod_frete']=="1"){echo 'selected="selected"';}} ?> value="1">1 - Por conta do Destinatário/Remetente</option>
							 	<option <?php if($ind_transp){if($venda[0]['mod_frete']=="2"){echo 'selected="selected"';}} ?> value="2">2 - Por conta de Terceiros</option>
							 	<option <?php if($ind_transp){if($venda[0]['mod_frete']=="9"){echo 'selected="selected"';}} ?> value="9">9 - Sem Frete</option>
							 </select>
						</div>
						<div class="item">
							<label class="item_titulo">Código ANTT:</label>
							<br />
							<input value="<?php if($ind_transp){echo $venda[0]['cod_antt_nfe'];} ?>" name="cod_antt" type="text" style="width: 120px" />
						</div>
						<div class="item">
							<label class="item_titulo">Placa do Veículo:</label>
							<br />
							<input value="<?php if($ind_transp){echo $venda[0]['placa_veic_nfe'];} ?>" name="placa" type="text" style="width: 120px" />
						</div>
						<div class="item">
							<label class="item_titulo">UF do Veículo:</label>
							<br />
							<select name="uf_vei" id="uf_vei">
								<option></option>
								 <?php foreach ($estados as $value => $name) { ?>
							        	<option <?php if($ind_transp){if($venda[0]['uf_veic_nfe']==$name['uf']){echo 'selected="selected"';}} ?> value="<?php echo $name['uf'] ?>"><?php echo $name['uf'] ?></option>
							     <?php } ?>
							 </select>
						</div>
						<div class="item">
							<label class="item_titulo">Tipo de Documento:</label>
							<br />
							<select name="tipo_doc" id="tipo_doc">
								<option></option>
								<option <?php if($ind_transp){if($venda[0]['tipo_doc_transp_nfe']=="1"){echo 'selected="selected"';}} ?> value="1">1 - CPF</option>
								<option <?php if($ind_transp){if($venda[0]['tipo_doc_transp_nfe']=="2"){echo 'selected="selected"';}} ?> value="2">2 - CNPJ</option>
							 </select>
						</div>
						<div class="item">
							<label class="item_titulo">CPF/CNPJ:</label>
							<br />
							<input value="<?php if($ind_transp){echo $transp_venda[0]['cnpj_transportadora'];} ?>" name="cpf_cnpj" type="text" style="width: 120px" />
						</div>
						<div class="item">
							<label class="item_titulo">Logradouro:</label>
							<br />
							<input value="<?php if($ind_transp){echo $transp_venda[0]['logradouro_transportadora'];} ?>" type="text" name="logr_transp" style="width: 300px"  />
						</div>
						<div class="item">
							<label class="item_titulo" for="uf">UF: </label>
							<br />
							<select id="estado_transp" name="uf" onchange="buscar_cidades_transp()">
								<option></option>
								 <?php foreach ($estados as $value => $name) { ?>
						        	<option <?php if($ind_transp){if($transp_venda[0]['uf_transportadora']==$name['uf']){ echo 'selected';}} ?> value="<?php echo $name['codigo_ibge']."|".$name['uf'] ?>"><?php echo $name['uf'] ?></option>
						    	 <?php } ?>
							 </select>
						</div>
						<div class="item" id="load_cidades_transp">
							 <label class="item_titulo" for="municipio">Município: </label>
							 <br />
							 <select class="cidade" name="municipio" style="width: 280px">
							 	<option value="<?php if($ind_transp){echo $transp_venda[0]['cod_municipio_transportadora']."|".$transp_venda[0]['municipio_transportadora'];} ?>"><?php if($ind_transp){echo utf8_encode($transp_venda[0]['municipio_transportadora']);} ?></option>
							 </select>
						</div>
						<div class="item">
							<label class="item_titulo">Inscrição Estadual:</label>
							<br />
							<input value="<?php if($ind_transp){echo $transp_venda[0]['inscricao_estadual_transportadora'];} ?>" type="text" name="ie_transp" style="width: 100px"  />
						</div>
						<br />
					</div>
					<div class="item">
	    				<label class="item_titulo">Quantidade:</label>
	    				<br />
	    				<input value="<?php if($ind_transp){echo $venda[0]['qtd_vol_nfe'];} ?>" type="text" name="qtd_vol" style="width: 150px"  />
					</div>
					<div class="item">
	    				<label class="item_titulo">Espécie</label>
	    				<br />
	    				<input value="<?php if($ind_transp){echo $venda[0]['especie_vol_nfe'];} ?>" type="text" name="esp_vol" style="width: 150px"  />
					</div>
					<div class="item">
	    				<label class="item_titulo">Marca:</label>
	    				<br />
	    				<input value="<?php if($ind_transp){echo $venda[0]['marca_vol_nfe'];} ?>" type="text" name="marca_vol" style="width: 150px"  />
					</div>
					<div class="item">
	    				<label class="item_titulo">Numeração:</label>
	    				<br />
	    				<input value="<?php if($ind_transp){echo $venda[0]['num_vol_nfe'];} ?>" type="text" name="num_vol" style="width: 150px"  />
					</div>
					<div class="item">
	    				<label class="item_titulo">Peso Bruto:</label>
	    				<br />
	    				<input value="<?php if($ind_transp){echo $venda[0]['peso_bruto_nfe'];} ?>" type="text" name="peso_b_vol" style="width: 150px"  />
					</div>
					<div class="item">
	    				<label class="item_titulo">Peso Líquido:</label>
	    				<br />
	    				<input value="<?php if($ind_transp){echo $venda[0]['peso_liq_nfe'];} ?>" type="text" name="peso_l_vol" style="width: 150px"  />
					</div>
		    		<br />
		    		<center>
		    			<button style="position: relative; float: right" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> onclick="aponta_transp();" type="submit">Atualizar</button>
		    		</center>
		    		<br />
		    	</form>
	    	</article>
	    	<br /><br />
	    	
	    	<!-- FATURA/DUPLICATA -->
	    	
	    	<label id="titulo" for="cliente">Fatura/Duplicata - 
	    		<a href="javascript:void(0);" onclick="$('#fatura').show();">+</a>
	    		/
	    		<a href="javascript:void(0);" onclick="$('#fatura').hide();">-</a>
	    	</label>
	    	<article id="fatura" class="grupo" style="padding: 10px;">
	    		<center>
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
			    					<?php echo $key['vencimento_fatura'] ?>
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
					<br />
					<form id="fatura" method="post" action="php/add_fatura.php">
		    			<div class="item">
		    				<br />
			    			<input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
			    			<input type="hidden" name="num_fat" value="<?php echo  substr($venda[0]['cod_numero_nfe'],0,4) ?>" />
			    			<label>Vencimento: </label>
			    			<input placeholder="dd/mm/aaaa" type="text" style="width: 100px" name="vencimento" value="" />
			    			<label>Valor: </label>
			    			<input type="text" name="valor" value="" />
			    		</div>
		    			<br /><br />
		    			<button style="position: relative; float: right" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="">Adicionar Fatura</button>
		    			<br />
			    		
		    		</form>
		    	</center>
	    	</article>
	    	<br /><br />
	    	
	    	<!-- RETIRADA -->
	    	
	    	<label id="titulo" for="cliente">Local de Retirada (Diferente do Emit.)
	    		<a href="javascript:void(0);" onclick="$('#venda_1').show();">+</a>
	    		/
	    		<a href="javascript:void(0);" onclick="$('#venda_1').hide();">-</a>
	    	</label>
	    	<article id="venda_1" class="grupo">
	    		<form id="info_1" method="post">
	    			<input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
		    		<div class="item">
	    				<label class="item_titulo">CNPJ:</label>
	    				<br />
	    				<input type="text" value="<?php if($retirada){ echo $lista_retirada[0]['cnpj_retirada']; } ?>" name="cnpj_retirada" style="width: 100px"  />
					</div>
					<div class="item">
	    				<label class="item_titulo">CPF:</label>
	    				<br />
	    				<input type="text" value="<?php if($retirada){ echo $lista_retirada[0]['cpf_retirada']; } ?>" name="cpf_retirada" style="width: 100px"  />
					</div>
					<div class="item">
	    				<label class="item_titulo">Logradouro:</label>
	    				<br />
	    				<input type="text" value="<?php if($retirada){ echo $lista_retirada[0]['logradouro_retirada']; } ?>" name="logradouro_retirada" style="width: 300px"  />
					</div>
					<div class="item">
	    				<label class="item_titulo">Número:</label>
	    				<br />
	    				<input type="text" value="<?php if($retirada){ echo $lista_retirada[0]['numero_retirada']; } ?>" name="numero_retirada" style="width: 100px"  />
					</div>
					<div class="item">
	    				<label class="item_titulo">Complemento:</label>
	    				<br />
	    				<input type="text" value="<?php if($retirada){ echo $lista_retirada[0]['complemento_retirada']; } ?>" name="complemento_retirada" style="width: 300px"  />
					</div>
					<div class="item">
	    				<label class="item_titulo">Bairro:</label>
	    				<br />
	    				<input type="text" value="<?php if($retirada){ echo $lista_retirada[0]['bairro_retirada']; } ?>" name="bairro_retirada" style="width: 300px"  />
					</div>
					<!--estado e cidade-->
						<div class="item">
			    			<label class="item_titulo" for="uf">UF: </label>
			    			<br />
			    			<select id="estado_2" name="uf" onchange="buscar_cidades_2()">
			    				<option></option>
								 <?php foreach ($estados as $value => $name) { ?>
						        	<option <?php if($retirada){ if($lista_retirada[0]['uf_retirada']==$name['codigo_ibge']){ echo 'selected';}} ?> value="<?php echo $name['codigo_ibge'] ?>"><?php echo $name['uf'] ?></option>
						    	 <?php } ?>
							 </select>
						</div>
						<div class="item" id="load_cidades_2">
							 <label class="item_titulo" for="municipio">Município: </label>
							 <br />
							 <select class="cidade" name="municipio" style="width: 280px">
							 	<option value="<?php if($retirada){ echo $lista_retirada[0]['cod_mun_retirada']."|".$lista_retirada[0]['mun_retirada'];} ?>"><?php echo utf8_encode($lista_retirada[0]['mun_retirada']) ?></option>
							 </select>
						</div>
						<!--fim estado cidade-->
						<center>
							<button style="position: relative; float: right" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" value="<?php if($retirada){ echo $lista_retirada[0]['id_retirada']; } ?>" onclick="cadastra_retirada();" name="post" >Atualizar</button>
						</center>
						<br />
					</form>
	    	</article>
	    	<br /><br />
	    	
	    	<!-- ENTREGA -->
	    	
	    	<label id="titulo" for="cliente">Local de Entrega (Diferente do Dest.)
	    		<a href="javascript:void(0);" onclick="$('#venda_ent').show();">+</a>
	    		/
	    		<a href="javascript:void(0);" onclick="$('#venda_ent').hide();">-</a>
	    	</label>
	    	<article id="venda_ent" class="grupo">
	    		<form id="info_2" method="post">
	    			<input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
		    		<div class="item">
	    				<label class="item_titulo">CNPJ:</label>
	    				<br />
	    				<input type="text" value="<?php if($entrega){ echo $lista_entrega[0]['cnpj_entrega']; } ?>" name="cnpj_entrega" style="width: 100px"  />
					</div>
					<div class="item">
	    				<label class="item_titulo">CPF:</label>
	    				<br />
	    				<input type="text" value="<?php if($entrega){ echo $lista_entrega[0]['cpf_entrega']; } ?>" name="cpf_entrega" style="width: 100px"  />
					</div>
					<div class="item">
	    				<label class="item_titulo">Logradouro:</label>
	    				<br />
	    				<input type="text" value="<?php if($entrega){ echo $lista_entrega[0]['logradouro_entrega']; } ?>" name="logradouro_entrega" style="width: 300px"  />
					</div>
					<div class="item">
	    				<label class="item_titulo">Número:</label>
	    				<br />
	    				<input type="text" value="<?php if($entrega){ echo $lista_entrega[0]['numero_entrega']; } ?>" name="numero_entrega" style="width: 100px"  />
					</div>
					<div class="item">
	    				<label class="item_titulo">Complemento:</label>
	    				<br />
	    				<input type="text" value="<?php if($entrega){ echo $lista_entrega[0]['complemento_entrega']; } ?>" name="complemento_entrega" style="width: 300px"  />
					</div>
					<div class="item">
	    				<label class="item_titulo">Bairro:</label>
	    				<br />
	    				<input type="text" value="<?php if($entrega){ echo $lista_entrega[0]['bairro_entrega']; } ?>" name="bairro_entrega" style="width: 300px"  />
					</div>
					<!--estado e cidade-->
						<div class="item">
			    			<label class="item_titulo" for="uf">UF: </label>
			    			<br />
			    			<select id="estado_3" name="uf" onchange="buscar_cidades_3()">
			    				<option></option>
								 <?php foreach ($estados as $value => $name) { ?>
						        	<option <?php if($entrega){ if($lista_entrega[0]['uf_entrega']==$name['codigo_ibge']){ echo 'selected';}} ?> value="<?php echo $name['codigo_ibge'] ?>"><?php echo $name['uf'] ?></option>
						    	 <?php } ?>
							 </select>
						</div>
						<div class="item" id="load_cidades_3">
							 <label class="item_titulo" for="municipio">Município: </label>
							 <br />
							 <select class="cidade" name="municipio" style="width: 280px">
							 	<option value="<?php if($entrega){ echo $lista_entrega[0]['cod_mun_entrega']."|".$lista_entrega[0]['mun_entrega'];} ?>"><?php echo utf8_encode($lista_entrega[0]['mun_entrega']) ?></option>
							 </select>
						</div>
						<!--fim estado cidade-->
						<center>
							<button style="position: relative; float: right" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" value="<?php if($retirada){ echo $lista_entrega[0]['id_entrega']; } ?>" onclick="cadastra_entrega();" name="post" >Atualizar</button>
						</center>
						<br />
					</form>
	    	</article>
	    	
	    	<br /><br />
	    	<!--         NOTAS REFERENCIADAS          -->
		    <label id="titulo" for="cliente">NFes Referenciadas
		    	<a href="javascript:void(0);" onclick="$('#referencia').show();">+</a>
	    		/
	    		<a href="javascript:void(0);" onclick="$('#referencia').hide();">-</a>	
		    </label>
	    	<center>
		    	<article id="referencia" class="grupo">
	    			<br />
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
		    		<form id="referencia" method="post" action="php/add_nref.php">
		    			<div class="item" id="load_cidades_3">
		    				<br />
			    			<input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
			    			<input type="text" name="chave" value="" />
			    		</div>
		    			<br /><br />
		    			<button style="position: relative; float: right" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="">Registrar Nova Nfe Ref.</button>
		    			<br />
		    		</form>
		    	</article>
		    </center>
	    	
	    	<br />
	    	<!--         CANCELAMENTO          -->
	    	<label id="titulo" for="cliente">Cancelamento - 
	    		<a href="javascript:void(0);" onclick="$('#cancelamento').show();">+</a>
	    		/
	    		<a href="javascript:void(0);" onclick="$('#cancelamento').hide();">-</a>
	    	</label>
	    	<article id="cancelamento" class="grupo">
	    		<form id="cancelamento" method="post" action="php/cancela nfe_nfe.php">
	    			<center>
		    			<div class="item" id="load_cidades_3">
		    				<br />
			    			<input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
			    			<textarea placeholder="Motivo do cancelamento aqui." cols="100" rows="10" name="motivo" id="mot_canc"></textarea>
			    		</div>
			    	</center>
			    	<br />
			    	<button style="position: relative; float: right" type="submit" onclick="cancela_nfe();">Cancelar</button>
	    		</form>
	    		<br />
	    	</article>
	    	
	    	<br /><br />
	    	
	    	<!--         INFORMAÇÃO ADICIONAL         -->
	    	<label id="titulo" for="cliente">Info. Adicional - 
	    		<a href="javascript:void(0);" onclick="$('#adicional').show();">+</a>
	    		/
	    		<a href="javascript:void(0);" onclick="$('#adicional').hide();">-</a>
	    	</label>
	    	<article id="adicional" class="grupo">
	    		<form id="cancelamento" method="post" action="php/adicional_nfe.php">
	    			<input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
	    			<center>
		    			<div class="item" id="adicional">
		    				<label>Informação complementar</label>
		    				<br />
			    			<textarea cols="50" rows="10" name="compl"><?php echo $venda[0]['inf_ad_compl_nfe'] ?></textarea>
			    		</div>
			    		<div class="item" id="adicional">
		    				<label>Informação do Fisco</label>
		    				<br />
			    			<textarea cols="50" rows="10" name="fisco"><?php echo $venda[0]['inf_ad_fisco_nfe'] ?></textarea>
			    		</div>
			    	</center>
			    	<br />
			    	<button style="position: relative; float: right" type="submit">Salvar</button>
	    		</form>
	    		<br />
	    	</article>
	    	
	    	<br /><br />
	    		
    		<label id="titulo" for="cliente">Novo Produto (caso não esteja na base) - 
	    		<a href="javascript:void(0);" onclick="$('#new_prod').show();">+</a>
	    		/
	    		<a href="javascript:void(0);" onclick="$('#new_prod').hide();">-</a>
	    	</label>
    		<article id="new_prod" class="grupo">
    			
    			<form action="php/cadastra_produto_mec_pos_nfe.php" method="post">
    			
    			<input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
    			
    			<div class="item">
    				<label class="item_titulo" for="descricao">*Descrição: </label>
    				<br />
    				<input required type="text" name="descricao" style="width: 346px; " />
    			</div>
    			<div class="item">	
    				<label class="item_titulo" for="codigo">Código: </label>
    				<br />
	    			<input required type="text" name="codigo" style="width: 200px; " />
	    		</div>
    			<div class="item">
    				<label class="item_titulo" for="ncm">NCM: </label>
    				<br />
	    			<input required type="text" name="ncm" style="width: 180px; " />
	    		</div>
	    		<div class="item">	
	    			<label class="item_titulo" for="unid_com">Unid. Produto: </label>
	    			<br />
	    			<input required type="text" name="unid" style="width: 170px; " />
	    		</div>
	    		<div class="item">	
	    			<label class="item_titulo" for="val_unid_com">Val. Produto: </label>
	    			<br />
	    			<input required type="text" name="val" style="width: 170px; " />
	    		</div>   			
    			<div class="item">	
    				<label class="item_titulo" for="classe_ipi">Classe IPI: </label>
    				<br />
    				<input type="text" name="classe_ipi" style="width: 200px; " />
    			</div>
    			<div class="item">	
    				<label class="item_titulo" for="cod_enquadr_ipi">Cod. Enquadr. IPI: </label>
	    			<br />
	    			<input type="text" name="cod_enquadr_ipi" style="width: 220px; " />
	    		</div>
	    		<br /><br />
    			<input style="position: relative; float: right" type="submit" value="cadastrar" />
	    		</form>
	    		<br />
	    	</article>
	    	<br /><br />
	    	
	    	<center>
	    		<!--<?php include "cabecalho_impressao.php" ?>-->
	    	</center>
	    	
	    		<label id="titulo" for="cliente">Itens</label>
	    		<article id="lista_item" class="grupo">
	    			<div>
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
				    					Valor Total do Item
				    				</td>
				    				<td>
				    					Operações
				    				</td>
				    			</tr>
			    				<?php $total_tudo = 0; foreach ($item as $key) { ?>
			   						<!--traz o nome do produto-->
			    					<?php $produto_1 = produto_view_1($pdo,$key['id_produto']) ?>
			    					<tr id="lista_content">
					    				<td>
					    					<?php echo $produto_1[0]['descricao_produto'] ?>
					    				</td>
					    				<td>
					    					<?php echo $key['qtd_item'] ?>
					    				</td>
					    				<td>
					    					<?php echo "R$".$key['val_unit'] ?>
					    				</td>
					    				<td>
					    					<?php echo "R$".$key['val_total']; $total_tudo += $key['val_total'] ?>
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
									<td colspan="2">
										R$<?php echo number_format($total_tudo, 2, ',', '.'); ?>
									</td>
								</tr>
							</table>
						</center>
	    			</div>
	    		</article>
	    		
	    		<div id="item_div">
		    		<form action="php/add_item_mec_nfe.php" onsubmit="return confirm('As informações do Item foram devidamente inseridas?(O Item não poderá ser editado, somente removido.)');" method="post" id="novo_item">
		    		
		    		<input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
		    		
		    		
		    		<label id="titulo" for="cliente">Novo Item</label>
		    		<article id="itens" style="height:auto !important;" class="grupo">
			    			
						<div class="item" style="padding-top: 12px;">
		    				<label class="item_titulo">Produto:</label>
							<select style="width: 578px" name="id_produto">
								<option value=""></option>
								<?php foreach($produto as $key){ ?>
									<option value="<?php echo $key['id_produto']."|".number_format($key['valor_produto'], 2, '.', ''); ?>"><?php echo $key['descricao_produto'] ?></option>
								<?php } ?>
							</select>
						</div>
						<br />
						<div class="item">
							<label class="item_titulo">Quantidade:</label>
							<input type="text" name="qtd_item" />
						</div>
						<div class="item">	
			    			<label class="item_titulo" for="cfop">CFOP: </label>
			    			<br />
			    			<select required name="cfop" style="width: 180px">
			    				<option></option>
			    				<?php foreach($cfop as $index=>$key){ ?>
			    					<option <?php if($key['id']=="5102"){echo "selected";} ?> value="<?php echo utf8_encode($key['id']) ?>"><?php echo utf8_encode($key['id']."-".substr($key['descricao'], 0, 110)."...") ?></option>
			    				<?php } ?>
			    			</select>
			    		</div>
			    		<div class="item">	
			    			<label class="item_titulo" for="cfop">Indicador de Total: </label>
			    			<br />
			    			<select required name="ind_total" style="width: 180px">
			    				<option value="1">1 - sim</option>
			    				<option value="0">0 - não</option>
			    			</select>
			    		</div>
			    		<br />
			    		<label style="margin: 0px" id="titulo">
			    			ICMS
			    			<a href="javascript:void(0);" onclick="$('#div_tot_icms').show();">+</a>
				    		/
				    		<a href="javascript:void(0);" onclick="$('#div_tot_icms').hide();">-</a>
			    		</label>
			    		<div id="div_tot_icms" style="background: #fff; border: 1px solid #000; padding: 10px; height: 470px;">
				    		<div class="item">
								<label class="item_titulo">Situação Tributária:</label>
								<select required name="sit_trib" onchange="esconde();">
									<option></option>
									<option value="101">101 - Tributada com permissão de crédito</option>
									<option value="102">102 - Ttibutada sem permissão de crédito</option>
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
								<label class="item_titulo">Origem:</label>
								<select name="origem">
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
									<label class="item_titulo">BC ICMS:</label>
									<input type="text" name="base_calc" />
								</div>
								<div class="item">
									<label class="item_titulo">alíquota aplicável de calc. de crédito:</label>
									<input type="text" name="aliq_calc_cred" />
								</div>
								<div class="item">
									<label class="item_titulo">Crédito do ICMS que pode ser aproveitado:</label>
									<input type="text" name="cred" />
								</div>
							</div>
							<!-- ICMS -->
							<div id="div_icms" class="item" style="margin: 0px">
								ICMS
								<br />
								<div class="item" style="border: 1px solid #333; padding: 10px 10px 0px 10px">
									<div class="item">
										<label class="item_titulo">Modalid. de determ. da BC ICMS:</label>
										<select name="modbc">
											<option value=""></option>
											<option value="0">0 - Margem Valor Agregado (%)</option>
											<option value="1">1 - Pauta (Valor)</option>
											<option value="2">2 - Preço Tabelado Máx. (Valor)</option>
											<option value="3">3 - Valor da operação</option>
										</select>
									</div>
									<br />
									<div class="item">
										<label class="item_titulo">% de redução da BC ICMS:</label>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name="p_reducao_bc" />
									</div>
									<br />
									<div class="item">
										<label class="item_titulo">BC ICMS:</label>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name="vbc" />
									</div>
									<br />
									<div class="item">
										<label class="item_titulo">Alíquota do ICMS:</label>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;
										<input type="text" name="aliq" />
									</div>
									<br />
									<div class="item">
										<label class="item_titulo">ICMS da Operação:</label>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;
										<input type="text" name="val_op" />
									</div>
									<br />
									<div class="item" style="visibility: hidden">
										<label class="item_titulo"></label>
										<input type="text"/>
									</div>
								</div>
							</div>
							<!-- ICMS ST -->
							<div id="div_icmsst" class="item" style="margin: 0px">
								ICMSST
								<br />
								<div class="item" style="border: 1px solid #333; padding: 10px 10px 0px 10px">
									<div class="item">
										<label class="item_titulo">Modalid. de determ. da BC ICMS:</label>
										&nbsp;&nbsp;&nbsp;
										<select name="modbcst">
											<option value=""></option>
											<option value="0">0 - Preço tabelado ou máximo sugerido</option>
											<option value="1">1 - Lista Negativa (Valor)</option>
											<option value="2">2 - Lista Positiva (Valor)</option>
											<option value="3">3 - Lista Neutra (Valor)</option>
											<option value="4">4 - Margem Valor Agregado (%)</option>
											<option value="5">5 - Pauta (Valor)</option>
										</select>
									</div>
									<br />
									<div class="item">
										<label class="item_titulo">% de redução da BC ICMS ST:</label>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name="p_reducao_bcst" />
									</div>
									<br />
									<div class="item">
										<label class="item_titulo">% margem de valor adic. ICMS ST:</label>
										&nbsp;
										<input type="text" name="p_m_vast" />
									</div>
									<br />
									<div class="item">
										<label class="item_titulo">BC ICMS ST:</label>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name="vbcst" />
									</div>
									<br />
									<div class="item">
										<label class="item_titulo">Alíquota do ICMS ST:</label>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;
										<input type="text" name="aliq_st" />
									</div>
									<br />
									<div class="item">
										<label class="item_titulo">ICMS ST:</label>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;
										<input type="text" name="val_st" />
									</div>
								</div>
							</div>
							<br />
							<div id="div_icmsret" class="item" style="margin: 0px">
								ICMS Retido
								<br />
								<div class="item" style="border: 1px solid #333; padding: 10px 10px 0px 10px">
									<div class="item">
										<label class="item_titulo">BC ICMS ST retido anteriormente:</label>
										<input type="text" name="vbc_ret_ant_st" />
									</div>
									<div class="item">
										<label class="item_titulo">ICMS ST retido anteriormente:</label>
										<input type="text" name="v_ret_ant_st" />
									</div>
								</div>
								</div>
							</div>
							<br />
							
							<!--          IPI             -->
							<br />
							<label style="margin: 0px" id="titulo">
								IPI
								<a href="javascript:void(0);" onclick="$('#div_ipi').show();">+</a>
					    		/
					    		<a href="javascript:void(0);" onclick="$('#div_ipi').hide();">-</a>
							</label>
				    		<div id="div_ipi" style="background: #fff; border: 1px solid #000; padding: 10px; height: 480px;">
				    			<div class="item">
									<label class="item_titulo">Situação Tributária:</label>
										<select required name="sit_ipi" style="width: 535px">
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
									<label class="item_titulo">Classe de enquadramento:</label>
									<input value="999" type="text" name="classe_enq_ipi" />
								</div>
								<div class="item">
									<label class="item_titulo">Código de enquadramento:</label>
									<input value="999" type="text" name="cod_enq_ipi" />
								</div>
								<br />
								<div class="item">
									<label class="item_titulo">Código de selo de controle:</label>
									<input style="width: 480px" type="text" name="cod_selo_ipi" />
								</div>
								<br />
								<div class="item">
									<label class="item_titulo">Qtd. do selo de controle:</label>
									&nbsp;&nbsp;
									<input type="text" name="qtd_selo_ipi" />
								</div>
								<br />
								<div class="item">
									<label class="item_titulo">Tipo de cálculo:</label>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;
										<select style="width: 140px" name="tipo_calc_ipi">
											<option></option>
											<option value="0">Percentual</option>
											<option value="1">Em Valor</option>
										</select>
									</div>
								<br />
								<div class="item">
									<label class="item_titulo">Valor da base de cálculo:</label>
									&nbsp;&nbsp;
									<input type="text" name="val_bc_ipi" />
								</div>
								<br />
								<div class="item">
									<label class="item_titulo">Valor da alíquota:</label>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="text" name="aliq_ipi" />
								</div>
								<br />
								<div class="item">
									<label class="item_titulo">Qtd. total unidade padrão:</label>
									&nbsp;
									<input type="text" name="qtd_tot_padr_ipi" />
								</div>
								<br />
								<div class="item">
									<label class="item_titulo">Valor por unidade:</label>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="text" name="val_unid_ipi" />
								</div>
								<br />
								<div class="item">
									<label class="item_titulo">Valor do IPI:</label>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="text" name="val_ipi" />
								</div>
								<br />
				    			
				    		</div>
			    			<input style="position: relative; float: right" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" value="Adicionar" />
			    			<br />
						</div>
		    		</article>
		    	</form>	
		    </div>
    	
    	</div>
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
