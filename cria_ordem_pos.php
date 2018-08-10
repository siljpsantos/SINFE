<?php
	include "_app/Config.inc.php";
	
	include "php/checa.php";
	
	
	$select = emitente($pdo); //seleciona o emitente pricipal
	$cliente = cliente($pdo); //seleciona todos os clientes
	$ordem = ordem_view_1($pdo,$_GET['id']); //seleciona a ordem a ser concluída
	$cliente_view_1 = cliente_view_1_id($pdo,$ordem[0]['id_cliente_ordem']); //seleciona o cliente pelo cpr registrado na ordem
	
	//print_r($ordem);
?>
<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
  <head>
    <title>SINFE - Sistema Emissor NFe/NFce</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />
    
    <meta name="description" content="See this example of responsive three highlights without using javascript. Using only html and css. by Palloi Hofmann">
    <meta name="keywords" content="css4html, css+for+html, css 4 html, css4, css4 html, css, css3, html, html5" />

    <meta property="og:image" content="http://palloi.github.io/responsive-header-only-css/assets/images/image-shared-2.png" />
    <meta property="og:keywords" content="css4html, css+for+html, css 4 html, css4, css4 html, css, css3, html, html5" />
    <meta name="description" content="See this example of responsive three highlights without using javascript. Using only html and css. by Palloi Hofmann">

    <link rel="stylesheet" type="text/css" href="css/css_section.css" />
    <link rel="stylesheet" type="text/css" href="css/css_menu.css" />
    
    <link rel="stylesheet" type="text/css" href="css/ativos.css" />
    
    <style type="text/css" media="print">
		@page {
		    size: auto;   /* auto is the initial value */
		    margin: 0;  /* this affects the margin in the printer settings */
            margin-top: -50px;
		}
	</style>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script>
	
	    function buscar_cpf_cnpj(){
	      var id = $('#id_nome option:selected').val();
	      if(id){
	        var url = 'php/ajax_buscar_cpf_cnpj.php?id='+id;
	        $.get(url, function(dataReturn) {
	          $('#div_cpf_cnpj').html(dataReturn);
	        });
	      }
	    }
		
		function buscar_email(){
	      var id = $('#id_nome option:selected').val();
	      if(id){
	        var url = 'php/ajax_buscar_email.php?id='+id;
	        $.get(url, function(dataReturn) {
	          $('#div_email').html(dataReturn);
	        });
	      }
	    }
		
    </script>
    
  </head>
  <!-- chamada do body e todo menu superior-->
  <?php include "menu_links.php";?>
    
    <section id="cadastro">
    	
    	<div id="corpo">
    		
    		<form action="php/cadastra_ordem_mec.php" method="post">
    		
	    		<!-- <label id="titulo" for="cliente">Cadastro de Ordem de Serviço</label> -->
	    		<article id="cliente" class="grupo">
	    			
	    			<p>
	    				<table id="titulo_form">
	    					<tr>
	    						<td class="topo">
	    							<?php echo '<img src="'.$select[0]['logo_emitente'].'" style="width: 350px" />' ?>
	    						</td>
	    						<td class="topo">
	    							CNPJ: <?php echo $select[0]['cnpj_emitente'] ?>
	    							<br />
	    							INSC.MUN: <?php echo $select[0]['inscricao_municipal_emitente'] ?>
	    							<br />
	    							<br />
	    							TEL.: <?php echo $select[0]['telefone_emitente'] ?>
	    						</td>
	    						<td class="topo">
	    							ORDEM DE SERVIÇO N°: <br /><?php echo sprintf('%05d',$ordem[0]['id_ordem']) ?>
	    						</td>
	    					</tr>
	    					<tr>
	    						<td colspan="3" id="cabecalho" style="padding-top: 20px;">
	    							NOME/RAZÃO SOCIAL: <?php echo $select[0]['nome_razao_social_emitente'] ?>
				    				<br />
				    				ENDEREÇO: <?php echo $select[0]['logradouro_emitente']," N°",$select[0]['numero_emitente'],
				    									" ",$select[0]['complemento_emitente']," BAIRRO: ",$select[0]['bairro_emitente'],
				    									" CIDADE: ",$select[0]['municipio_emitente']," UF: ",$select[0]['uf_emitente']
				    							?>
				    				<br />
				    				CHAMADO POR: <input type="text" name="chamado_por" value="<?php echo $ordem[0]['aberto_por_ordem'] ?>" style="width: 143px" />
				    				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				    				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				    				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				    				&nbsp;&nbsp;&nbsp;&nbsp;
				    				RESPONSÁVEL: <input type="text" name="responsavel" value="<?php echo $ordem[0]['responsavel_ordem'] ?>" style="width: 143px" />
				    				<p />
	    					</tr>
	    					<tr>
	    						<td colspan=3 style="padding: 10px 0px">
	    							<strong>MODELO EQUIPAMENTO: </strong>
	    							<input type="text" name="equip" value="<?php echo $ordem[0]['equip_ordem'] ?>" style="width: 320px" />
	    							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    							<strong>SÉRIE: </strong>
	    							<input type="text" name="serie_equip" value="<?php echo $ordem[0]['serie_equip_ordem'] ?>" style="width: 320px" />
	    						</td>
	    					</tr>
	    					<tr>
	    						<td colspan="3" style="padding: 10px 0px">
		    						CPF/CNPJ:
									<div id="div_cpf_cnpj" style="display: inline-block">
										<input type="text" name="cpf_cnpj_cliente" value="<?php echo $cliente_view_1[0]['cpf_cnpj_cliente'] ?>" required>
									</div>
		    						Nome:
		    						<select id="id_nome" name="nome_cliente" style="width: 320px" readonly onchange="buscar_cpf_cnpj();buscar_email();">
										<option></option>
										<?php foreach($cliente as $key){?>
											<option <?php if($ordem[0]['id_cliente_ordem']==$key['id_cliente']){echo"selected";} ?> value="<?php echo $key['id_cliente'] ?>"><?php echo $key['nome_razao_social_cliente'] ?></option>
										<?php } ?>
									</select>
		    						Email:
									<div id="div_email" style="display: inline-block">
										<input type="text" name="email_cliente" style="width: 400px" value="<?php echo $cliente_view_1[0]['email_cliente'] ?>" readonly/>
									</div>
	    						</td>
	    					</tr>
	    					<tr style="text-align: center; background: #dcdcdc">
	    						<td style="padding: 5px 0px">
	    							<strong>
	    								<u>
	    									ROTINA DE SERVIÇOS
	    								</u>
	    							</strong>
	    						</td>
	    						<td colspan="2" style="padding: 5px 0px;">
	    							<strong>
	    								<u>
	    									INFORMAÇÕES P/ RETIRADA DE EQUIPAMENTOS
	    								</u>
	    							</strong>
	    						</td>
	    					</tr>
	    					<tr>
	    						<td style="padding: 0px 5px;  height: 400px">
	    							<div>
	    								<table id="servico">
	    									<tr>
	    										<td>
	    											<input type="checkbox" name="garantia_yn" <?php if($ordem[0]['garantia_yn_ordem'] == 1){echo'checked';} ?> value="1" /> Garantia
	    											<br />
	    											<input type="checkbox" name="inviavel_yn" <?php if($ordem[0]['inviavel_yn_ordem'] == 1){echo'checked';} ?> value="1" /> Inviável  
	    										</td>
	    										<td>
	    											<input type="checkbox" name="contrato_yn" <?php if($ordem[0]['contrato_yn_ordem'] == 1){echo'checked';} ?> value="1" /> Contrato 
	    											<br />
	    											<input type="checkbox" name="sem_conserto_yn" <?php if($ordem[0]['sem_conserto_yn_ordem'] == 1){echo'checked';} ?> value="1" /> S/ Conserto 
	    										</td>
	    										<td>
	    											<input type="checkbox" name="avulso_yn" <?php if($ordem[0]['avulso_yn_ordem'] == 1){echo'checked';} ?> value="1" /> Avulso 
	    										</td>
	    									</tr>
	    								</table>
	    							</div>
	    							<?php 
	    								//define a hora e data para brasilia
	    								date_default_timezone_set('America/Sao_Paulo'); 
										
										//calcula a data da garantia(3 meses - 90 dias)
	    								$time = strtotime("+3 month"); 
	    							?>
	    							<br />
	    							Garantia até: 
	    							<input type="text" style="width: 150px; float: right" value="<?php echo date("d/m/Y", $time)?>" disabled/>
	    							<input type="hidden" name="garantia_ate" value="<?php echo date("Y-m-d", $time)?>" />
	    							<br />
	    							<br />
	    							Data do Chamado: 
	    							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    							<span><?php echo date("d/m/Y") ?></span>
	    							<br />
	    							<br />
	    							Horário: 
	    							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    							<span><?php echo date("H:i:s") ?></span>
	    							<br />
	    							<br />
	    							Valor Pago: R$ <input type="text" name="val_pg" value="<?php echo $ordem[0]['val_pg_ordem'] ?>" style="width: 150px; float: right" />
	    							<br />
	    							<br />
	    							Forma de Pagamento:
	    							<select name="forma_pg" style="width: 153px; float: right" >
	    								<option></option>
	    								<option <?php if($ordem[0]['forma_pg_ordem'] == 'Dinheiro'){echo'selected="selected"';} ?> >Dinheiro</option>
	    								<option <?php if($ordem[0]['forma_pg_ordem'] == 'Débito'){echo'selected="selected"';} ?> >Débito</option>
	    								<option <?php if($ordem[0]['forma_pg_ordem'] == 'Crédito'){echo'selected="selected"';} ?> >Crédito</option>
	    							</select>
	    							<p />
	    							<p />
	    							<p />
	    						</td>
	    						<td colspan="2" style="padding: 5px 5px">
	    							<input type="checkbox" name="conserto_yn" <?php if($ordem[0]['conserto_yn_ordem'] == 1){echo'checked';} ?> value="1" /> Conserto 
	    							&nbsp;&nbsp;
	    							<input type="checkbox" name="orcamento_yn" <?php if($ordem[0]['orcamento_yn_ordem'] == 1){echo'checked';} ?> value="1" /> Orçamento
	    							&nbsp;&nbsp;&nbsp;
	    							Técnico Responsável: Balcão_ 
	    							<input type="text" name="responsavel_balcao" value="<?php echo $ordem[0]['tecnico_balcao_ordem'] ?>" style="width: 190px; float: right" />
	    							<div>
	    								
	    							</div>
	    							<br />
	    							Equipamento recebido em: <span><?php echo date("d/m/Y") ?></span>_ e entregamos com:
	    							<div>
	    								<table>
	    									<tr id="retirada">
	    										<td>
	    											<input type="checkbox" name="cabo_forca_yn" <?php if($ordem[0]['cabo_forca_yn_ordem'] == 1){echo'checked';} ?>  value="1" /> Cabo de força
	    											<br />
			    									<input type="checkbox" name="toner_yn" <?php if($ordem[0]['toner_yn_ordem'] == 1){echo'checked';} ?>  value="1" /> Toner
			    									<br />
			    									<input type="checkbox" name="drive_dvd_yn" <?php if($ordem[0]['drive_dvd_yn_ordem'] == 1){echo'checked';} ?>  value="1" /> Drive de CD/DVD
	    										</td>
	    										<td >
	    											<input type="checkbox" name="cabo_video_yn" <?php if($ordem[0]['cabo_video_yn_ordem'] == 1){echo'checked';} ?>  value="1" /> Cabo de vídeo
	    											<br />
			    									<input type="checkbox" name="cartucho_preto_yn" <?php if($ordem[0]['cartucho_preto_yn_ordem'] == 1){echo'checked';} ?>  value="1" /> Cartucho preto 
			    									<br />
			    									<input type="checkbox" name="pendrive_yn" <?php if($ordem[0]['pendrive_yn_ordem'] == 1){echo'checked';} ?>  value="1" /> Pendrive
	    										</td>
	    										<td>
	    											<input type="checkbox" name="bandejas_yn" <?php if($ordem[0]['bandejas_yn_ordem'] == 1){echo'checked';} ?>  value="1" /> Bandejas
	    											<br />
			    									<input type="checkbox" name="cartucho_color_yn" <?php if($ordem[0]['cartucho_color_yn_ordem'] == 1){echo'checked';} ?>  value="1" /> Cartucho color
			    									<br />
			    									<input type="checkbox" name="case_yn" <?php if($ordem[0]['case_yn_ordem'] == 1){echo'checked';} ?>  value="1" /> Case
			    								</td>
	    										<td>
	    											<input type="checkbox" name="base_yn" <?php if($ordem[0]['base_yn_ordem'] == 1){echo'checked';} ?>  value="1" /> Base
	    											<br />
	    											<input type="checkbox" name="fonte_yn" <?php if($ordem[0]['fonte_yn_ordem'] == 1){echo'checked';} ?>  value="1" /> Fonte
	    										</td>
	    									</tr>
	    									<tr>
	    										<td colspan="4" style="border: 0px">
	    											<input type="checkbox" name="outro_yn" value="1" /> Outro
	    											<input type="text" name="outro" value="<?php echo $ordem[0]['outro_ordem'] ?>" style="width: 630px" />
	    										</td>
	    									</tr>
	    								</table>
	    							</div>
	    							<br />
	    							<div style="text-align: justify; padding: 0px 25px">
	    								Não nos responsibilizamos pela procedência e documentação do(s) equipamento(s)
										acima descritos(s). O prazo máximo p? retirada do equipamento após o orçamento
										ou conserto é de 90 dias, caso contrário a INFORWAY cobrará despesas com o 
										armazenamento e a guarda do equipamento descrito asima. Taxa diária será de
										01 (uma) UFIR.
	    							</div>
	    							<br />
	    							<br />
	    							<div>
	    								CLIENTE (Ok) IDA:________________
	    								&nbsp;&nbsp;
	    								CLIENTE (Ok) VOLTA:________________ 
	    							</div>
	    						</td>
	    					</tr>
	    					<tr>
	    						<td colspan="3" style="padding: 5px 10px">
	    							Defeito Relatado:
		    						<br />
		    						<textarea name="defeito_rel" rows="4" cols="139"><?php echo $ordem[0]['defeito_rel_ordem'] ?></textarea>
		    						<p />
	    						</td>
	    					</tr>
	    					<tr>
	    						<td colspan="3" style="border-top: 0px; padding: 5px 10px">
	    							Defeito Constatado:
		    						<br />
		    						<textarea name="defeito_const" rows="4" cols="139"><?php echo $ordem[0]['defeito_const_ordem'] ?></textarea>
		    						<p />
	    						</td>
	    					</tr>
	    					<tr>
	    						<td colspan="3" style="border-top: 0px; padding: 5px 10px">
	    							Solução:
		    						<br />
		    						<textarea name="solucao" rows="4" cols="139"><?php echo $ordem[0]['solucao_ordem'] ?></textarea>
		    						<p />
	    						</td>
	    					</tr>
	    					<tr>
	    						<td colspan="3" style="border-top: 0px; padding: 5px 10px">
	    							Observação:
		    						<br />
		    						<textarea name="obs" rows="4" cols="139"><?php echo $ordem[0]['obs_ordem'] ?></textarea>
		    						<p />
	    						</td>
	    					</tr>
	    					<tr style="text-align: center">
	    						<td colspan="3" style="padding: 10px 0px">
	    							<span id="menor">
		    							O Cliente recebeu os serviços acima, sendo assim, firma o presente e se compromete  
		    							a pagar o preço por esta estipulado.
	    							</span>
	    							<br />
	    							<br />
	    							<table id="rodape">
	    								<tr>
	    									<td style="border: 0px">
	    										Local e Data:_________________________,______________ 
	    										<br /><br />
	    										Cliente:
	    									</td>
	    									<td style="border: 0px">
	    										Técnico:_______________________________   
	    										<br /><br />
	    										Carimbo e Assinatura:____________________
	    									</td>
	    								</tr>
	    							</table>
	    							<br />
	    						</td>
	    					</tr>
	    				</table>
	    			</p>
	    		</article>
	    		<br />
	    		<center>
		    		<span id="esconder">
			    		<a href="javascript:self.print()" id="imprimir" style="font-size: 20pt">IMPRIMIR</a>
		    		</span>
				</center>	    		
	    	</form>
    	</div> 	
    </section>       
  </body>  
</html>
