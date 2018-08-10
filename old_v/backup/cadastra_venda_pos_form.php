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
					    					<form action="php/remove_item_mec.php" method="post" onsubmit="return confirm('Realmente deseja remover o item?');">
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
	    		<form action="php/add_item_mec.php" onsubmit="return confirm('As informações do Item foram devidamente inseridas?(O Item não poderá ser editado, somente removido.)');" method="post" id="novo_item">
	    		
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
					
					<div class="item">
						<label class="item_titulo">Quantidade:</label>
						<input type="text" name="qtd_item" />
					</div>
					
					<div class="item" style="display: none">	
		    			<label class="item_titulo" for="cfop">CFOP: </label>
		    			<br />
		    			<select required name="cfop" style="width: 180px">
		    				<option></option>
		    				<?php foreach($cfop as $index=>$key){ ?>
		    					<option <?php if($key['id']=="5102"){echo "selected";} ?> value="<?php echo utf8_encode($key['id']) ?>"><?php echo utf8_encode($key['id']."-".substr($key['descricao'], 0, 110)."...") ?></option>
		    				<?php } ?>
		    			</select>
		    		</div>
		    		<div style="display: none" class="item">	
		    			<label class="item_titulo" for="cfop">Indicador de Total: </label>
		    			<br />
		    			<select required name="ind_total" style="width: 180px">
		    				<option selected value="1">1 - sim</option>
		    				<option value="0">0 - não</option>
		    			</select>
		    		</div>
		    		<!--
		    		<br />
		    		<label style="margin: 0px" id="titulo">
		    			ICMS
		    			<a href="javascript:void(0);" onclick="$('#div_tot_icms').show();">+</a>
			    		/
			    		<a href="javascript:void(0);" onclick="$('#div_tot_icms').hide();">-</a>
		    		</label>
		    		-->
		    		<div id="div_tot_icms" style="background: #fff; border: 1px solid #000; padding: 10px; height: 470px;">
			    		<div class="item">
							<label class="item_titulo">Situação Tributária:</label>
							<select required name="sit_trib" onchange="esconde();">
								<option></option>
								<option value="101">101 - Tributada com permissão de crédito</option>
								<option selected value="102">102 - Ttibutada sem permissão de crédito</option>
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
						<!--
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
			    		-->
		    			<input style="position: relative; float: right" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" value="Adicionar" />
		    			<br />
					</div>
	    		</article>
	    	</form>
		    
    		<form id="info" method="post">
	    		
	    			<?php date_default_timezone_set('America/Sao_Paulo');  ?>
					<input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
    				<input type="hidden" name="assinatura" value=A1 />
    				
					<!--<input type="hidden" name="assinatura" value="A1" />-->
					<input type="hidden" name="id_as" value="<?php echo $venda[0]['id_nfe'] ?>" />
					<input type="hidden" name="id_va" value="<?php echo $venda[0]['id_nfe'] ?>" />
					<input type="hidden" name="id_en" value="<?php echo $venda[0]['id_nfe'] ?>" />

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
	    	</form>
	    	
	    	
	    	<article id="erro" class="grupo" style="padding: 10px;">
	    		<div style="display: none" id="teste"></div>	
	    		<div id="err"></div>
	    	</article>
	    	
	    	<!-- PAGAMENTO NFC-E -->
	    	
	    	<br />
	    	<label id="titulo" for="cliente">Pagamento (NFC-e)</label>
	    	<article id="pg" class="grupo" style="padding: 10px;">
	    		<form id="info_pg" action="" method="post">
	    			<input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
	    			<div class="item">
						 <label class="item_titulo">Tipo de Pagamento: </label>
						 <br />
						 <select name="tipo_pg">
						 	<option></option>
						 	<option <?php if($venda[0]['tipo_pg_nfe']=="01"){echo 'selected="selected"';} ?> value="01">01 - Dinheiro</option>
						 	<option <?php if($venda[0]['tipo_pg_nfe']=="02"){echo 'selected="selected"';} ?> value="02">02 - Cheque</option>
						 	<option <?php if($venda[0]['tipo_pg_nfe']=="03"){echo 'selected="selected"';} ?> value="03">03 - Cartão de Crédito</option>
						 	<option <?php if($venda[0]['tipo_pg_nfe']=="04"){echo 'selected="selected"';} ?> value="04">04 - Cartão de Débito</option>
						 	<option <?php if($venda[0]['tipo_pg_nfe']=="04"){echo 'selected="selected"';} ?> value="05">05 - Crédito em Loja</option>
						 	<option <?php if($venda[0]['tipo_pg_nfe']=="04"){echo 'selected="selected"';} ?> value="10">10 - Vale Alimentação</option>
						 	<option <?php if($venda[0]['tipo_pg_nfe']=="04"){echo 'selected="selected"';} ?> value="11">11 - Vale Refeição</option>
						 	<option <?php if($venda[0]['tipo_pg_nfe']=="04"){echo 'selected="selected"';} ?> value="12">12 - Vale Presente</option>
						 	<option <?php if($venda[0]['tipo_pg_nfe']=="04"){echo 'selected="selected"';} ?> value="13">13 - Vale Combustível</option>
						 	<option <?php if($venda[0]['tipo_pg_nfe']=="04"){echo 'selected="selected"';} ?> value="99">99 - Vale Outros</option>
						 </select>
					</div>
					<div class="item">
						<label class="item_titulo">Valor do Pagamento::</label>
						<br />
						<input value="<?php if($venda[0]['val_pg_nfe']!='0.00'){echo $venda[0]['val_pg_nfe'];} ?>" name="val_pg" type="text" style="width: 120px" />
					</div>
					<br />
					<center>
	    				<button style="position: relative; float: right" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="add_pagamento();" name="id">Cadastrar Pagamento</button>
	    			</center>
	    			<br />
	    		</form>
	    	</article>
	    	<br />
	    	
	    	<br />
	    	<!--         CANCELAMENTO          -->
	    	<label id="titulo" for="cliente">Cancelamento - 
	    		<a href="javascript:void(0);" onclick="$('#cancelamento').show();">+</a>
	    		/
	    		<a href="javascript:void(0);" onclick="$('#cancelamento').hide();">-</a>
	    	</label>
	    	<article id="cancelamento" class="grupo">
	    		<form id="cancelamento" method="post" action="php/cancela nfe.php">
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
	    	<!--
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
	    	-->
	    	<!--	
    		<label id="titulo" for="cliente">Novo Produto (caso não esteja na base) - 
	    		<a href="javascript:void(0);" onclick="$('#new_prod').show();">+</a>
	    		/
	    		<a href="javascript:void(0);" onclick="$('#new_prod').hide();">-</a>
	    	</label>
    		<article id="new_prod" class="grupo">
    			
    			<form action="php/cadastra_produto_mec_pos.php" method="post">
    			
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
    	-->
    	</div>
    	
    </section>
    
  </body>
  
</html>
