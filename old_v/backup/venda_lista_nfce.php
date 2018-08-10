<?php

	include "php/conection.php";
	include "php/querys.php";
	
	include "php/checa.php";
	
	
	$select = emitente($pdo); //seleciona o emitente pricipal
	
	$data = 0;
	$mes = 0;
	$doc = 0;
	
	if(isset($_POST['data']) && $_POST['data'] != NULL){
		$venda_all = venda_data_nfce($pdo,$_POST['data']); //seleciona vendas por data
		$data = 1;
	}else {
		$venda_all = venda_all_nfce($pdo);
	}
	
	if($data == 0){
		
		if(isset($_POST['mes']) && $_POST['mes'] != NULL){
			$venda_all = venda_mensal_nfce($pdo,$_POST['mes']); //seleciona todas as vendas do mes
		}else {
			$venda_all = venda_all_nfce($pdo);
		}
	}
	
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
	
	<!-- --------------------------------------------------------------------------------------- -->
	
    <link rel="stylesheet" type="text/css" href="css/css_section.css" />
    <link rel="stylesheet" type="text/css" href="css/css_menu.css" />
    
    <link rel="stylesheet" type="text/css" href="css/ativos.css" />
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="js/tema/style.css" />
    <script type="text/javascript" src="js/tabela/jquery-latest.js"></script>
    <script type="text/javascript" src="js/tabela/jquery.tablesorter.js"></script> 
    
	<script>
		$(document).ready(function() 
		    { 
		        $("#lista").tablesorter();
		        //$("#lista").tablesorter( {sortList: [[0,0]]} );  
		        
		        $('#inutil').hide();
		    } 
		);
	</script>
    
    <!-- AJUSTA A IMPRESSÃO -->
    <style type="text/css" media="print">
		@page {
		    size: auto;   /* auto is the initial value */
		    margin: 0;  /* this affects the margin in the printer settings */
		}
	</style>
	
   
  </head>
  <!-- chamada do body e todo menu superior-->
  <?php include "menu_links.php";?>
    
    <section id="cadastro">
    	
    <center>
    	<article id="op" class="grupo" style="width: 1180px">
    		<br />
			<form style="position: relative; float: left" action="venda_lista_nfce.php" method="post" >
				<div id="search">
					<span>
						Pesquisa por data de emissão dd/mm/aaaa:
					</span>
					<input type="text" name="data" id="pesquisa_2" placeholder="Pesquisa de vendas" autofocus />
					<img src="assets/images/lupa.png" id="pesquisa_img">
					<input type="submit" style="position: absolute; left: -9999px"/>
				</div>
			</form>
			<br /><br /><br />
			<form style="position: relative; float: left" action="venda_lista_nfce.php" id="form_mes" method="post">
				<div id="search">
					<span>
						ou por mês de emissão:
					</span>
					<select onchange="$('#form_mes').submit();" style="border: 0; width: auto" name="mes" id="pesquisa_2"/>
						<option></option>
						<option>11/2016</option>
						<option>12/2016</option>
						<option>01/2017</option>
						<option>02/2017</option>
						<option>03/2017</option>
						<option>04/2017</option>
						<option>05/2017</option>
						<option>06/2017</option>
						<option>07/2017</option>
						<option>08/2017</option>
						<option>09/2017</option>
						<option>10/2017</option>
						<option>11/2017</option>
						<option>12/2017</option>
					</select>
					<input type="submit" style="position: absolute; left: -9999px"/>
				</div>
			</form>
			<br /><br /><br />
			<form style="position: relative; float: left" method="POST" action="php/exporta_xml_massa.php">
				<input name="mes" type="hidden" value="<?php if(isset($_POST['mes']) && $_POST['mes'] != NULL){ echo $_POST['mes'];}else{ echo date('m/Y'); } ?>" />
				<button type="submit">Exportar XMLS do mês selecionado acima ou o mês atual</button>
			</form>
			<br /><br />
		</article>
	</center>
	<br />

	<span>
		<a href="cadastra_venda_pre_form.php" class="interno">Emitir Nota</a>
	</span>
	    	
    <br /><br />
    
    	<div class="corpo_venda" style="height: 400px; width: 1205px; overflow: auto;">
    		
    		<table id="lista" class="tablesorter">
    			<thead>
	    			<tr id="lista_titulo" style="text-align: center">
	    				<th style="width: 40px">
	    					N°
	    				</th>
	    				<th style="width: 200px">
	    					Status da Venda
	    				</th>
	    				<th style="width: 200px;">
	    					Data de Emissão
	    				</th>
	    				<th style="width: 200px">
	    					Valor total
	    				</th>
	    				<td style="width: 100px">
	    					
	    				</td>
	    			</tr>
	    		</thead>
	    		<tbody>
		    		<?php $cont = 0; foreach($venda_all as $index=>$key) { ?>
		    			
		    			<?php
		    				 
		    				//echo $cont+=1;
		    				$xml = xml_venda($pdo,$key['id_nfe']);
							
		    				if($xml!=array()){
		    					
								$xml_1 = simplexml_load_string($xml[0]['conteudo_xml']);
								//print_r($xml_1);
								if($xml[0]['transmitido_xml']!=0){
									
									$num = $xml_1->NFe->infNFe->ide->nNF;
								
									if($xml_1->NFe->infNFe->dest->CNPJ!=0){
										$cnpj_cpf = $xml_1->NFe->infNFe->dest->CNPJ;
									}else{
										$cnpj_cpf = $xml_1->NFe->infNFe->dest->CPF;
									}
									
									$sit = "autorizada";
								}else{
									$num = $xml_1->infNFe->ide->nNF;
								
									if($xml_1->infNFe->dest->CNPJ!=0){
										$cnpj_cpf = $xml_1->infNFe->dest->CNPJ;
									}else{
										$cnpj_cpf = $xml_1->infNFe->dest->CPF;
									}
								}
								
								
								if($xml[0]['inutilizado_xml']!=0){
									$sit = "inutilizada";
								}else if($xml[0]['cancelado_xml']!=0){
									$sit = "cancelada";
								}else if($xml[0]['rejeitado_xml']!=0){
									$sit = "rejeitada";
								}else if($xml[0]['transmitido_xml']!=0){
									$sit = "autorizada";
								}else if($xml[0]['valido_xml']!=0){
									$sit = "validada";
								}else if($xml[0]['assinado_xml']!=0){
									$sit = "assinada";
								}else{
									$sit = "em digitação";
								}
								
		    				}else{
		    					
		    					$num = 'X';
								
								$doc = $pdo->query("SELECT * FROM tab_cliente WHERE id_cliente = '".$key['id_cliente']."' ");
								$doc = $doc->fetchAll();
								
								@$cnpj_cpf = $doc[0]['cpf_cnpj_cliente'];
								
								$sit = "em digitação";
		    				}
		    				
		    			?>
		    			
		    			<tr id="lista_content">
		    				<td>
		    					<?php echo $num ?>
		    				</td>
		    				<td>
		    					<?php echo $sit ?>
		    				</td>
		    				<td>
		    					<?php echo $key['data_emis_nfe'] ?>
		    				</td>
		    				<td>
		    					R$<?php echo number_format($key['val_total_nfe'], 2, ',', '.'); ?>
		    				</td>
		    				<td>
		    					<form action="cadastra_venda_pos_form.php" method="get">
		    						<input type="hidden" name="id" value="<?php echo $key['id_nfe'] ?>" />
		    						<button type="submit">Vizualizar</button>
		    					</form>
		    				</td>
		    			</tr>
		    		
		    		<?php } ?>
		    	</tbody>
	    		
    		</table>
    	</div> 
    	
    	<br /><br />
    	<!--         INUTILIZAÇÃO          -->
    	<label id="titulo" for="cliente">Inutilização de N°s - 
    		<a href="javascript:void(0);" onclick="$('#inutil').show();">+</a>
    		/
    		<a href="javascript:void(0);" onclick="$('#inutil').hide();">-</a>
    	</label>
    	<center>
	    	<article style="width: 710px" id="inutil" class="grupo">
	    		<form id="cancelamento" method="post" action="php/inutiliza nfe.php">
	    			<div class="item">
						 <label class="item_titulo">Início da faixa: </label>
						 <br />
						 <input type="text" name="ini" style="width: 150px; min-width: 92px;" />
					</div>
					<div class="item">
						 <label class="item_titulo">Final da faixa: </label>
						 <br />
						 <input type="text" name="fin" style="width: 150px; min-width: 92px;" />
					</div>
					<br />
	    			<div class="item" id="load_cidades_3">
		    			<input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
		    			<textarea placeholder="Motivo aqui." cols="80" rows="5" name="motivo"></textarea>
		    		</div>
		    		<br />
		    		<button type="submit" onclick="cancela_nfe();">Inutilizar</button>
		    		<br /><br />
	    		</form>
	    	</article>
    	</center>
    </section>       
  </body>  
</html>
