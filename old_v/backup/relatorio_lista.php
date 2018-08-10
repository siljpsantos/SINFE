<?php

	include "php/conection.php";
	include "php/querys.php";
	
	include "php/checa.php";
	
	$info = $_POST;
	
	if(!isset($_POST['ass'])){
		$info['ass'] = 2;
	}
	if(!isset($_POST['aut'])){
		$info['aut'] = 2;
	}
	if(!isset($_POST['canc'])){
		$info['canc'] = 2;
	}
	if(!isset($_POST['dig'])){
		$info['dig'] = 2;
	}
	if(!isset($_POST['rej'])){
		$info['rej'] = 2;
	}
	if(!isset($_POST['val'])){
		$info['val'] = 2;
	}
	if(!isset($_POST['inu'])){
		$info['inu'] = 2;
	}
	
	
	$select = emitente($pdo); //seleciona o emitente pricipal
	
	function venda_entre($pdo,$ini,$fin){
		
		$ini = implode("-", array_reverse(explode("/", $ini)));
		$fin = implode("-", array_reverse(explode("/", $fin)));
		
		$select = $pdo->query(" SELECT * FROM tab_nfe WHERE data_emis_nfe BETWEEN '".$ini." 00:00:00' AND '".$fin." 23:59:59' ");
		return $select->fetchAll();
		
		
	}
	
	if(isset($_POST['ini']) && $_POST['ini'] != NULL && $_POST['fin'] && $_POST['fin'] != NULL){
		$venda_all = venda_entre($pdo,$_POST['ini'],$_POST['fin']); 
	}else {
		$venda_all = array();
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
		    } 
		);
		
		function uncheckAll(){

			$('input[type="checkbox"]:checked').attr('checked',false);
		
		}
		
		function checkAll(){

			$('input[type="checkbox"]').attr('checked',true);
		
		}
	</script>
    
    <!-- AJUSTA A IMPRESSÃO -->
    <style type="text/css" media="print">
		@page {
		    size: auto;   /* auto is the initial value */
		    margin: 0;  /* this affects the margin in the printer settings */
		}
		button, #topo_menu{
			display: none;
		}
		#lista{
			display: block;
		}
		#op{
			display: block;
		}
		#total{
			display: block;
		}
	</style>
	
   
  </head>
  <!-- chamada do body e todo menu superior-->
  <?php include "menu_links.php";?>
    
    <section id="cadastro">
    	
    <div>
		<center>
			<article id="op" class="grupo" style="width: 1180px">
				<br />
				<form style="text-align: left" action="relatorio_lista.php" id="form_rel" method="post" style="display: inline-block;">
					<div>
						<?php //print_r($venda_all) ?>
						<div class="item">
							<label>Data:</label>
						</div>
						<div class="item">
							<span>
								Início:
							</span>
							<input type="text" value="<?php echo date('d/m/Y',strtotime( "-1 month" ) ); ?>" name="ini" id="pesquisa_2" placeholder="dd/mm/aaaa" />
						</div>
						<div class="item">
							<span>
								Final:
							</span>
							<input type="text" value="<?php echo date('d/m/Y'); ?>" name="fin" id="pesquisa_2" placeholder="dd/mm/aaaa" />
						</div>
						<br />
						<div class="item">
							<label>Situação:</label>
						</div>
						<br />
						<div class="item">
							<input <?php if($info['ass']=='1'){echo "checked";} ?> type="checkbox" name="ass" value="1" />
							<label>Assinada:</label>
						</div>
						<div class="item">
							<input <?php if($info['aut']=='1'){echo "checked";} ?> type="checkbox" name="aut" value="1" />
							<label>Autorizada:</label>
						</div>
						<div class="item">
							<input <?php if($info['canc']=='1'){echo "checked";} ?> type="checkbox" name="canc" value="1" />
							<label>Cancelada:</label>
						</div>
						<div class="item">
							<input <?php if($info['dig']=='1'){echo "checked";} ?> type="checkbox" name="dig" value="1" />
							<label>Em Digitação:</label>
						</div>
						<div class="item">
							<input <?php if($info['rej']=='1'){echo "checked";} ?> type="checkbox" name="rej" value="1" />
							<label>Rejeitada:</label>
						</div>
						<div class="item">
							<input <?php if($info['val']=='1'){echo "checked";} ?> type="checkbox" name="val" value="1" />
							<label>Validada:</label>
						</div>
						<div class="item">
							<input <?php if($info['inu']=='1'){echo "checked";} ?> type="checkbox" name="inu" value="1" />
							<label>N°s Inutilizados:</label>
						</div>
						<div class="item">
							<button onclick="checkAll();">Todas</button>
							<button onclick="uncheckAll();">Limpar</button>
						</div>
						<br />
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;
						<button style="position: relative; float: left" type="submit">Pesquisar</button>
						<br /><br />
					</div>
				</form>
			</article>
		</center>
	</div>
	
	<br />
	
	<span>
		<a href="" onclick="window.print();" class="interno">Imprimir</a>
	</span>	

    <br /><br />
    
    	<div class="corpo_venda" style="height: 400px; width: 1210px; overflow: auto; border-radius: 4px" >
    		
    		<table  id="lista" class="tablesorter">
    			<thead>
	    			<tr id="lista_titulo" style="text-align: center">
	    				<th style="width: 50px">
	    					N°
	    				</th>
	    				<th style="width: 150px">
	    					Status da Venda
	    				</th>
	    				<th>
	    					Data de Emissão
	    				</th>
	    				<th style="width: 170px">
	    					CNPJ do Dest.
	    				</th>
	    				<th style="width: 100px">
	    					Valor total
	    				</th>
	    			</tr>
	    		</thead>
	    		<tbody>
		    		<?php $cont = 0; $tot_nfe = 0; foreach($venda_all as $index=>$key){ ?>
		    			
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
		    			
		    				<!-- AUTORIZADA -->
		    				<?php if($sit == "autorizada" && $info['aut'] == '1'){ $tot_nfe += $key['val_total_nfe']; ?>
				    			<tr id='lista_content'>
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
				    					<?php echo $cnpj_cpf ?>
				    				</td>
				    				<td>
				    					R$<?php echo number_format($key['val_total_nfe'], 2, ',', '.'); ?>
				    				</td>
				    			</tr>
			    			<?php } ?>
			    			
			    			<!-- ASSINADA -->
		    				<?php if($sit == "assinada" && $info['ass'] == '1'){ $tot_nfe += $key['val_total_nfe']; ?>
				    			<tr id='lista_content'>
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
				    					<?php echo $cnpj_cpf ?>
				    				</td>
				    				<td>
				    					R$<?php echo number_format($key['val_total_nfe'], 2, ',', '.'); ?>
				    				</td>
				    			</tr>
			    			<?php } ?>
			    			
			    			<!-- CANCELADA -->
		    				<?php if($sit == "cancelada" && $info['canc'] == '1'){ $tot_nfe += $key['val_total_nfe']; ?>
				    			<tr id='lista_content'>
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
				    					<?php echo $cnpj_cpf ?>
				    				</td>
				    				<td>
				    					R$<?php echo number_format($key['val_total_nfe'], 2, ',', '.'); ?>
				    				</td>
				    			</tr>
			    			<?php } ?>
			    			
			    			<!-- EM DIGITACAO -->
		    				<?php if($sit == "em digitação" && $info['dig'] == '1'){ $tot_nfe += $key['val_total_nfe']; ?>
				    			<tr id='lista_content'>
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
				    					<?php echo $cnpj_cpf ?>
				    				</td>
				    				<td>
				    					R$<?php echo number_format($key['val_total_nfe'], 2, ',', '.'); ?>
				    				</td>
				    			</tr>
			    			<?php } ?>
			    			
			    			<!--REJEITADA -->
		    				<?php if($sit == "rejeitada" && $info['rej'] == '1'){ $tot_nfe += $key['val_total_nfe']; ?>
				    			<tr id='lista_content'>
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
				    					<?php echo $cnpj_cpf ?>
				    				</td>
				    				<td>
				    					R$<?php echo number_format($key['val_total_nfe'], 2, ',', '.'); ?>
				    				</td>
				    			</tr>
			    			<?php } ?>
			    			
			    			<!--VALIDADA -->
		    				<?php if($sit == "validada" && $info['val'] == '1'){ $tot_nfe += $key['val_total_nfe']; ?>
				    			<tr id='lista_content'>
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
				    					<?php echo $cnpj_cpf ?>
				    				</td>
				    				<td>
				    					R$<?php echo number_format($key['val_total_nfe'], 2, ',', '.'); ?>
				    				</td>
				    			</tr>
			    			<?php } ?>
			    			
			    			<!-- INUTILIZADA -->
		    				<?php if($sit == "inutilizada" && $info['inu'] == '1'){ $tot_nfe += $key['val_total_nfe']; ?>
				    			<tr id='lista_content'>
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
				    					<?php echo $cnpj_cpf ?>
				    				</td>
				    				<td>
				    					R$<?php echo number_format($key['val_total_nfe'], 2, ',', '.'); ?>
				    				</td>
				    			</tr>
			    			<?php } ?>
			    			
		    			<?php } ?>
		    	</tbody>
	    		
    		</table>
    	</div> 
    	
    	<br />
    </section>
    <center>
	    <article id="total" style="width: 1180px; padding: 20px" class="grupo">
	    	<?php echo "TOTAL DAS NOTAS: R$".number_format($tot_nfe, 2, ',', '.'); ?> 
	    </article>
    </center>
    <br /><br /><br /><br /><br />
  </body>  
</html>
