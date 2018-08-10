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
	    
	     function aponta_cliente(){
	      var id = $('#info [name=id_nfe]').val();
	      var id_cliente = $('#nome_cliente option:selected').val();
	      
	      var avulso = $('#info [name=avulso]').val();
	      
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
		  var desc = $('#info_pg [name=val_desc]').val(); 
	      var id = $('#info_pg [name=id_nfe]').val();
	      var tipo = $('#info_pg [name=tipo_pg] option:selected').val();
	      var val = $('#info_pg [name=val_pg]').val();
	      if(id && tipo){
	        var url = 'php/ajax_cadastra_pg.php?id_nfe='+id+'&tipo='+tipo+'&val='+val+'&desc='+desc;
	        $.get(url, function(dataReturn) {
	          $('#teste').html(dataReturn);
              location.reload();
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
              assina_nfe();
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
              //valida_nfe();
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
            $(this).scrollTop(0);
            
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
            $('#cce').hide();
		    $('#fatura').hide();
		    $('#venda_1').hide();
		    $('#venda_ent').hide();
		    $('#adicional').hide();
			$('#dest').hide();
		    
		    $("#div_tot_icms").hide();
		    $("#div_ipi").hide();
		    $("#new_prod").hide();
		    
		    $("#div_icms").hide();
    		$("#div_icmsst").hide();
    		$("#div_icmsret").hide();
    		$("#div_bc").show();
            
            //highlight pagamento
            
    		
    		//mecanismo do troco
		    
		    pg = $("#info_pg [name=val_pg]").val();
		    tot = $("#troco_mec [name=tot]").val();
		    troco = pg-tot;
		    
		    if(troco < 0){
		    	$("#info_pg [name=troco]").val(0.00);
		    }else{
		    	$("#info_pg [name=troco]").val(troco.toFixed(2));
		    }
		    
		    
		    //------
		    
		    $("#novo_item [name=aliq_calc_cred]").change(function(e){
		    	var bc = $("#novo_item [name=base_calc]").val();
		    	var aliq = $("#novo_item [name=aliq_calc_cred]").val();
		    	var result = (bc/100)*aliq;
		    	$("#novo_item [name=cred]").val(result);
		    });
		    
		    $("#novo_item [name=qtd_item]").keyup(function(e){
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
        
        document.addEventListener('keydown', function(event) {
            if(event.keyCode === 119) {
                $('#modal_pg').click();
                $('#myModal').on('shown.bs.modal', function() {
                    $('#pg_sl_1').focus();
                  });
            }else if(event.keyCode === 120) {
                $('#gera_btn').click();
            }else if(event.keyCode === 121) {
                $('#transmite_btn').click();
            }else if(event.keyCode === 122) {
                event.preventDefault();
                $('#imprime_btn').click();
            }else if(event.keyCode === 113) {
                event.preventDefault();
                window.location.href = "php/cadastra_venda_pre_mec.php";
            }
        });
	    
	</script>
  </head>
  
  <!-- chamada do body e todo menu superior-->
  <?php include "menu_links.php";?>
    </header>
    <section id="cadastro">
        
        <div id="itens"></div>
    	
    	<div id="corpo">
    		
    		<div class="panel panel-default corpo">
                <div style="font-size: 14pt" class="panel-heading">
                    Itens
                </div>
                <div class="panel-body">
                    
                    <article id="lista_item">
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
                                    <?php 
                                        $total_tudo = 0.00; 

                                        foreach ($item as $key) {

                                            //traz o nome do produto
                                            $produto_1 = produto_view_1($pdo,$key['id_produto']); 
                                            //calcula o valor com desconto
                                            $val_tot = number_format($key['val_total']-($key['val_total']/100*$key['val_desc_item'])-($key['val_desc_unit_item']),2,'.','');  
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
                                                <?php echo "R$".@number_format($val_tot,2,",",""); $total_tudo += $val_tot; ?>
                                            </td>

                                            <td>
                                                <form action="<?php if(@$xml[0]['transmitido_xml']!=1){echo "php/cadastra_desc_unit.php";} ?>" method="post">
                                                    <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                                    <input type="hidden" name="id_item" value="<?php echo $key['id_item'] ?>" />
                                                    <input autocomplete=off type="text" name="val_desc" placeholder="Desconto em valor" />
                                                </form>
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
                                        <td colspan="4">
                                            R$<?php echo number_format($total_tudo, 2, ',', '.'); ?>
                                            <form id="troco_mec">
                                                <input type="hidden" name="tot" value="<?php echo number_format($total_tudo, 2, '.', ''); ?>" />
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </center>
                        </div>
                    </article>
                    
                </div>
            </div>
    		
    		<div id="item_div">
	    		<!--<form class="form form-inline" action="php/add_item_mec.php" onsubmit="return confirm('As informações do Item foram devidamente inseridas?(O Item não poderá ser editado, somente removido.)');" method="post" id="novo_item">-->
	    		<form class="form form-inline" action="php/add_item_mec.php" method="post" id="novo_item">
                    
	    		<input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
	    		
	    		
	    		<div class="panel panel-default corpo">
                    <div style="font-size: 14pt" class="panel-heading">
                        Novo Item
                    </div>
                    <div class="panel-body">

                        <article id="itens" style="height:auto !important;">
                            
                            <div class="item" style="padding-top: 12px;">
                                <span class="item_titulo">Produto:</span>
                                <!--
                                <select autofocus class="form-control" autofocus style="width: 578px" name="id_produto">
                                    <option value=""></option>
                                    <?php foreach($produto as $key){ ?>
                                        <option value="<?php echo $key['id_produto']."|".number_format($key['valor_produto'], 2, '.', ''); ?>"><?php echo $key['descricao_produto'] ?></option>
                                    <?php } ?>
                                </select>
                                -->
                                <input type="text" autocomplete="off" class="form-control" list="data-produto" autofocus style="width: 700px" name="id_produto" />
                            </div>
                           
                            
                            <datalist id="data-produto">
                                <?php foreach($produto as $key){ ?>
                                    <option value="<?php echo $key['codigo_produto']." - ".$key['descricao_produto']; ?>">
                                <?php } ?>
                            </datalist>
                            
                            <div class="item">
                                <span class="item_titulo">Quantidade:</span>
                                <input class="form-control" type="number" value="1" name="qtd_item" min="1" />
                            </div>

                            <div class="item" style="display: none">	
                                <span class="item_titulo" for="cfop">CFOP: </span>
                                <br />
                                <select required name="cfop" style="width: 180px">
                                    <option></option>
                                    <?php foreach($cfop as $index=>$key){ ?>
                                        <option <?php if($key['id']=="5102"){echo "selected";} ?> value="<?php echo utf8_encode($key['id']) ?>"><?php echo utf8_encode($key['id']."-".substr($key['descricao'], 0, 110)."...") ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div style="display: none" class="item">	
                                <span class="item_titulo" for="cfop">Indicador de Total: </span>
                                <br />
                                <select required name="ind_total" style="width: 180px">
                                    <option selected value="1">1 - sim</option>
                                    <option value="0">0 - não</option>
                                </select>
                            </div>
                            <!--
                            <br />
                            <span style="margin: 0px" id="titulo">
                                ICMS
                                <a href="javascript:void(0);" onclick="$('#div_tot_icms').show();">+</a>
                                /
                                <a href="javascript:void(0);" onclick="$('#div_tot_icms').hide();">-</a>
                            </span>
                            -->
                            <div id="div_tot_icms" style="background: #fff; border: 1px solid #000; padding: 10px; height: 470px;">
                                <div class="item">
                                    <span class="item_titulo">Situação Tributária:</span>
                                    <select required name="sit_trib" onchange="esconde();">
                                        <option></option>
                                        <option value="101">101 - Tributada com permissão de crédito</option>
                                        <option selected value="102">102 - Tributada sem permissão de crédito</option>
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
                                        <span class="item_titulo">BC ICMS:</span>
                                        <input type="text" name="base_calc" />
                                    </div>
                                    <div class="item">
                                        <span class="item_titulo">alíquota aplicável de calc. de crédito:</span>
                                        <input type="text" name="aliq_calc_cred" />
                                    </div>
                                    <div class="item">
                                        <span class="item_titulo">Crédito do ICMS que pode ser aproveitado:</span>
                                        <input type="text" name="cred" />
                                    </div>
                                </div>
                                <!-- ICMS -->
                                <div id="div_icms" class="item" style="margin: 0px">
                                    ICMS
                                    <br />
                                    <div class="item" style="border: 1px solid #333; padding: 10px 10px 0px 10px">
                                        <div class="item">
                                            <span class="item_titulo">Modalid. de determ. da BC ICMS:</span>
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
                                            <span class="item_titulo">% de redução da BC ICMS:</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="text" name="p_reducao_bc" />
                                        </div>
                                        <br />
                                        <div class="item">
                                            <span class="item_titulo">BC ICMS:</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="text" name="vbc" />
                                        </div>
                                        <br />
                                        <div class="item">
                                            <span class="item_titulo">Alíquota do ICMS:</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="text" name="aliq" />
                                        </div>
                                        <br />
                                        <div class="item">
                                            <span class="item_titulo">ICMS da Operação:</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;
                                            <input type="text" name="val_op" />
                                        </div>
                                        <br />
                                        <div class="item" style="visibility: hidden">
                                            <span class="item_titulo"></span>
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
                                            <span class="item_titulo">Modalid. de determ. da BC ICMS:</span>
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
                                            <span class="item_titulo">% de redução da BC ICMS ST:</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="text" name="p_reducao_bcst" />
                                        </div>
                                        <br />
                                        <div class="item">
                                            <span class="item_titulo">% margem de valor adic. ICMS ST:</span>
                                            &nbsp;
                                            <input type="text" name="p_m_vast" />
                                        </div>
                                        <br />
                                        <div class="item">
                                            <span class="item_titulo">BC ICMS ST:</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="text" name="vbcst" />
                                        </div>
                                        <br />
                                        <div class="item">
                                            <span class="item_titulo">Alíquota do ICMS ST:</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="text" name="aliq_st" />
                                        </div>
                                        <br />
                                        <div class="item">
                                            <span class="item_titulo">ICMS ST:</span>
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
                                            <span class="item_titulo">BC ICMS ST retido anteriormente:</span>
                                            <input type="text" name="vbc_ret_ant_st" />
                                        </div>
                                        <div class="item">
                                            <span class="item_titulo">ICMS ST retido anteriormente:</span>
                                            <input type="text" name="v_ret_ant_st" />
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <br />

                                <input class="btn btn-sinfe-1 btn-block" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" value="Adicionar" />
                                
                        </article>
                    </div>
                </div>
            </form>
		    
    		<form class="form form-inline" id="info" method="post">
	    		
	    			<?php date_default_timezone_set('America/Sao_Paulo');  ?>
					<input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
    				<input type="hidden" name="assinatura" value=A1 />
    				
					<!--<input type="hidden" name="assinatura" value="A1" />-->
					<input type="hidden" name="id_as" value="<?php echo $venda[0]['id_nfe'] ?>" />
					<input type="hidden" name="id_va" value="<?php echo $venda[0]['id_nfe'] ?>" />
					<input type="hidden" name="id_en" value="<?php echo $venda[0]['id_nfe'] ?>" />

	    		<br/>
                
                <!-- botoes -->
                 <div style="padding-left: 10px">
                     
                    <!-- controle de modal -->
                    <button style="display: none" type="button" id="modal_pg" data-toggle="modal" data-target="#myModal"></button>
                    <button style="display: none;" id="fecha_modal_pg" type="button" class="btn btn-default" data-dismiss="modal"</button>
                    
                    <button class="btn btn-default" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> onclick="location.reload();" name="id">Novo Produto - F5</button>
                    <button id="pg_btn" class="btn btn-default" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> onclick="$('#modal_pg').click();" name="id">Pagamento - F8</button>
                    
                    <!--<input class="btn btn-default" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="submitForm('php/edita_venda_mec.php');" value="Salvar" />-->
                    <button id="gera_btn" class="btn btn-default" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="gera_nfe();" name="id" value="<?php echo $venda[0]['id_nfe'] ?>">Gerar Nfe - F9</button>
                    <!--<button class="btn btn-default" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="assina_nfe();" name="id_as1" value="<?php echo $venda[0]['id_nfe'] ?>">Assinar Nfe</button>-->
                    <!--<button class="btn btn-default" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="valida_nfe();" name="id_va" value="<?php echo $venda[0]['id_nfe'] ?>">Validar Nfe</button>-->
                    <button id="transmite_btn" class="btn btn-default" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="transmite_nfe();" name="id_en" value="<?php echo $venda[0]['id_nfe'] ?>">Transmitir Nfe - F10</button>

                    <button id="imprime_btn" class="btn btn-success" type="submit" onclick="submitForm('php/danfe nfe.php');" name="id_df" value="<?php echo $venda[0]['id_nfe'] ?>">Impressão - F11</button>
                    <button class="btn btn-sinfe-1" type="submit" onclick="submitForm('php/duplica_venda_mec.php');">Duplicar Nota</button>
                    <button class="btn btn-sinfe-1" type="submit" onclick="submitForm('php/exporta_xml.php');">Exportar XML</button>
                    
                    <a href="php/cadastra_venda_pre_mec.php" id="nova_btn" class="btn btn-warning" <?= $ind_xml ? ($xml[0]['transmitido_xml']==1) ? "enabled" : "disabled" : "disabled"  ?> >Nova Venda - F2</a>
                                        
                </div>
                
                <!--
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
                -->
                
                <br />
                
	    		<!-- DESTINATÁRIO --> 
                
                <div class="panel panel-default corpo">
                    <div style="font-size: 14pt" class="panel-heading">
                        Destinatário -
                        <a href="javascript:void(0);" onclick="$('#dest').slideToggle(600);">+</a>
                        /
                        <a href="javascript:void(0);" onclick="$('#dest').slideToggle(600);">-</a>
                    </div>
                    <div class="panel-body">
                        <article id="dest" >	
                            <div>
                                <!-- <form id="info_dest" method="post"> -->
                                    <div class="item" style="display: none">
                                        <span class="item_titulo" for="nome_razao social">*Pesquisa por Nome/Razão Social: </span>
                                        <br/>
                                        <select class="form-control" id="nome_cliente" name="nome/razao_social" onchange="busca_cliente();" style="width: 1140px; min-width: 400px;">
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
                                    <!--<span>Cliente Avulso: </span>-->
                                    <input type="hidden" name="avulso" value="sim"/>
                                    <!--
                                    <font size="3"><u>Em caso de cliente avulso, marque a caixa ao lado e preencha os campos abaixo:</u></font>
                                    <br />
                                    -->
                                   
                                    <!-- AQUI -->
                                    
                                    <div class="item">
                                        <span class="item_titulo" for="nome_razao social">Nome: </span>
                                        <br />
                                        <input class="form-control" value="<?php if($cliente_n){echo $cliente_nfe[0]['nome_razao_social_cliente'];} ?>" type="text" name="nome_avulso" style="width: 800px; min-width: 400px;">
                                    </div>
                                    <div class="item">
                                        <span class="item_titulo" for="CPF/CNPJ">CPF/CNPJ: </span>
                                        <br />
                                        <input class="form-control" value="<?php if($cliente_n){echo $cliente_nfe[0]['cpf_cnpj_cliente'];} ?>" type="text" name="cpf_cnpj" style="width: 200px; min-width: 100px;" />
                                    </div>
                                    
                                    <!-- AQUI -->
                                    
                                    <div id="div_dest">
                                        <div class="item" style="display: none;">
                                            <span class="item_titulo" for="CPF/CNPJ">Tipo de Documento: </span>
                                            <br />
                                            <select class="form-control" required id="tipo_doc" name="tipo_doc" style="width: 126px; min-width: 126px;">
                                                <option selected value="1">CPF</option>
                                                <option value="2">CNPJ</option>
                                            </select>
                                        </div>
                                        <div style="display: none;">
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
                                                <input class="form-control" <?php if($cliente_n){if($cliente_nfe[0]['isento_icms_cliente']=="sim"){echo 'checked';}} ?> class="item_titulo" type="checkbox" name="isencao_icms" value="1">
                                            </div>
                                            <div class="item">
                                                <span class="item_titulo" for="SUFRAMA">Inscrição SUFRAMA: </span>
                                                <br />
                                                <input class="form-control" value="<?php if($cliente_n){echo $cliente_nfe[0]['inscricao_suframa_cliente'];} ?>" type="text" name="suframa" style="width: 150px; min-width: 84px;" />
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
                                                <input class="form-control" value="<?php if($cliente_n){echo $cliente_nfe[0]['logradouro_cliente'];} ?>" type="text" name="logradouro" style="width: 660px; min-width: 362px;" />
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
                                                    <option value="<?php if($cliente_n){echo $cliente_nfe[0]['cod_municipio_cliente'];} ?>"><?php if($cliente_n){echo $cliente_nfe[0]['municipio_cliente'];} ?></option>	
                                                 </select>
                                            </div>
                                            <div class="item">
                                                 <span class="item_titulo" for="telefone">Telefone: </span>
                                                 <br />
                                                 <input class="form-control" value="<?php if($cliente_n){echo $cliente_nfe[0]['telefone_cliente'];} ?>" type="text" name="telefone" style="width: 220px; min-width: 92px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-sinfe-1 btn-block" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="aponta_cliente();" name="id">Salvar Cliente</button>
                                <!-- </form> -->
                            </div>
                        </article>
                    </div>
                </div>
                
	    	</form>
	    	
	    	<!-- PAGAMENTO NFC-E -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                      
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Pagamento</h4>
                    </div>
                      
                    <div class="modal-body">
                      <form class="form form-inline" id="info_pg" action="" method="post">
                            <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                            <div class="item">
                                 <span class="item_titulo">Tipo de Pagamento: </span>
                                 <br />
                                 <select id="pg_sl_1" class="form-control" name="tipo_pg">
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
                                <span class="item_titulo">Valor do Pagamento:</span>
                                <br />
                                <input class="form-control" value="<?php if($venda[0]['val_pg_nfe']!=''){echo $venda[0]['val_pg_nfe'];}else{echo $venda[0]['val_total_nfe'];} ?>" name="val_pg" type="number" step=".01" style="width: 120px" />
                            </div>
                            <div class="item">
                                <span class="item_titulo">Desconto:</span>
                                <input class="form-control" style="width: 50px" value="<?php echo number_format(@$item[0]['val_desc_item'],0) ?>" id="val_desc" name="val_desc" type="text" style="width: 120px" /> %
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div id="troco" class="item" style="color: green; font-weight: bold;">
                                <span class="item_titulo">Troco: </span>
                                <br />
                                <input class="form-control" style="color: green; font-weight: bold;" disabled type="text" name="troco" />
                            </div>
                            <br />
                            <button class="btn btn-sinfe-1 btn-block" <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){echo "disabled";}} ?> type="submit" onclick="add_pagamento();$('#fecha_modal_pg').click();" name="id">Cadastrar Pagamento</button>
                        </form>
                    </div>
                   
                  </div>

                </div>
              </div>
            
	    	
            <br />
            
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
	    	
	    	<br />
            
	    	<!--         CANCELAMENTO          -->
             <div class="panel panel-default corpo">
                <div style="font-size: 14pt" class="panel-heading">
                    Cancelamento -
                    <a href="javascript:void(0);" onclick="$('#cancelamento').slideToggle(600);">+</a>
                    /
                    <a href="javascript:void(0);" onclick="$('#cancelamento').slideToggle(600);">-</a>
                </div>
                <div class="panel-body">
                    <article id="cancelamento">
                        <form class="form form-inline" id="cancelamento" method="post" action="php/cancela nfe.php">
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
            
            <!--         CCE          -->
            <!--
            <?php 
            $cce = $pdo->query('SELECT * FROM tab_cce WHERE id_venda = ' . $venda[0]['id_nfe'] .' ORDER BY num_seq_cce '); 
            $cce = $cce->fetchAll();
            ?>
            <div class="panel panel-default corpo">
                <div style="font-size: 14pt" class="panel-heading">
                    Cartas de Correção - 
                    <a href="javascript:void(0);" onclick="$('#cce').slideToggle(600);">+</a>
                    /
                    <a href="javascript:void(0);" onclick="$('#cce').slideToggle(600);">-</a>
                 </div>
                 <div class="panel-body">
                    <article id="cce" >
                        <center>
                            <table id="lista">
                                <tr id="lista_titulo" style="text-align: center">
                                    <td>
                                        Ordem
                                    </td>
                                    <td>
                                        Op.
                                    </td>
                                </tr>
                                        <td>
                                            <?php echo "Carta nr° - ".$key['num_seq_cce'] ?>
                                        </td>
                                        <td>
                                <?php foreach ($cce as $key) { ?>
                                    <tr id="lista_content">
                                            <form action="php/Dacce.php" method="post">
                                                <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                                <input type="hidden" name="id" value="<?php echo $key['id_cce'] ?>" />
                                                <button type="submit">Imprimir</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </center>
                        
                        <br />
                        
                        <form class="form form-inline" id="cartace" method="post" action="php/gera_cce.php">
                            <center>
                                <div class="item">
                                    <input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
                                    <input type="hidden" name="modelo" value="65" />
                                    <textarea class="form-inline" placeholder="Correção Aqui." cols="100" rows="10" name="motivo" id="mot_canc"></textarea>
                                </div>
                            </center>
                            <br />
                            <button <?php if($ind_xml){if($xml[0]['transmitido_xml']==1){}else{echo "disabled";}}else{echo "disabled";} ?> class="btn btn-primary btn-block" type="submit" >Registrar</button>
                        </form>
                        <br />
                    </article>
                 </div>
            </div>
            -->
            
    	</div>
    	
    </section>
    
  </body>
  
</html>
