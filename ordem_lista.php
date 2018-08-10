<?php
	include "_app/Config.inc.php";
	
	include "php/checa.php";
	
	
	$select = emitente($pdo); //seleciona o emitente pricipal
	$cliente = cliente($pdo); //seleciona todos os clientes
	
	$id = 0;
	$data = 0;
	$nome = '0';
	
	if(isset($_POST['id']) && $_POST['id'] != NULL){
		$ordem = ordem_id($pdo,$_POST['id']); //seleciona ordens por id-------------------
		$id = 1;
	}else {
		$ordem = ordem($pdo); //seleciona todas as ordens---------------------------------
	}
	
	if($id == 0){
		
		if(isset($_POST['nome']) && $_POST['nome'] != NULL){
			$nome = '1';
		}
		
	}
	
	if($id == 0 && $nome == '0'){
		
		if(isset($_POST['data']) && $_POST['data'] != NULL){
			@$ordem = ordem_data($pdo,$_POST['data']);
			$data = 1;
		}else {
			@$ordem = ordem($pdo);
		}
	
	}
	
	if($data == 0 && $nome == '0' && $id == 0){
		
		if(isset($_POST['mes']) && $_POST['mes'] != NULL){
			$ordem = ordem_mensal($pdo,$_POST['mes']);
		}else {
			$ordem = ordem($pdo);
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

    <link rel="stylesheet" type="text/css" href="css/ativos.css" />
    
    <!-- AJUSTA A IMPRESSÃO -->
    <style type="text/css" media="print">
		@page {
		    size: auto;   /* auto is the initial value */
		    margin: 0;  /* this affects the margin in the printer settings */
		}
	</style>
	
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
	</script>
    
  </head>
  <!-- chamada do body e todo menu superior-->
  <?php include "menu_links.php";?>
    
    <section id="cadastro">
    	
		<center>
			<div class="panel panel-default corpo">
				<div style="font-size: 14pt" class="panel-heading">
				</div>
				<div class="panel-body">
					<form style="position: relative; float: left" action="ordem_lista.php" method="post" >
						<div id="search">
							<span>
								Pesquisa por data de emissão dd/mm/aaaa:
							</span>
							<input class="form-control" type="text" name="data" id="pesquisa_2" placeholder="Pesquisa de vendas" autofocus />
							<input type="submit" style="position: absolute; left: -9999px"/>
						</div>
					</form>
					<form style="position: relative; float: left; margin-left: 10px;" action="ordem_lista.php" id="form_mes" method="post">
						<div id="search">
							<span>
								Por mês de emissão:
							</span>
							<select class="form-control" onchange="$('#form_mes').submit();" style="border: 0; width: auto" name="mes" id="pesquisa_2"/>
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
					<form style="position: relative; float: left" action="ordem_lista.php" method="post" style="display: inline-block">
					<div id="search">
						<span>
							Nome do cliente:
						</span>
						<select class="form-control" name="nome" style="width: 320px" onchange="this.form.submit()">
							<option></option>
							<?php foreach($cliente as $key){?>
								<option <?php if($nome==1){if($_POST['nome']==$key['id_cliente']){echo"selected";}} ?> value="<?php echo $key['id_cliente'] ?>"><?php echo $key['nome_razao_social_cliente'] ?></option>
							<?php } ?>
						</select>
						<input type="submit" style="position: absolute; left: -9999px"/>
					</div>
				   </form>
				   <form style="position: relative; float: left; margin-left: 10px;" action="ordem_lista.php" method="post" style="display: inline-block">
					<div id="search">
						<span>
							N° da Ordem
						</span>
						<input class="form-control" type="text" name="id" id="pesquisa2" placeholder="Pesquisa de ordens" />
						<input type="submit" style="position: absolute; left: -9999px"/>
					</div>
				   </form>
			   </div>
			</div>
		</center>
		
		<br />
    	
    	<div id="corpo_ordem" style="height: 400px; width: 1205px; overflow: auto;">
    		<table id="lista" class="tablesorter">
				<thead>
					<tr id="lista_titulo" style="text-align: center">
						<th style="width: 65px;">
							Número
						</th>
						<!--
						<th>
							CPF/CNPJ
						</th>
						-->
						<th style="width: 100px">
							Data
						</th>
						<th style="width: 220px;">
							Nome do Cliente
						</th>
						<th>
							Descrição de Serviços
						</th>
						<th style="width: 100px;">
							Telefone
						</th>
						<th style="width: 100px;">
							Celular
						</th>
						<th style="width: 50px;">
							Status
						</th>
						<td style="width: 35px">
							
						</td>
					</tr>
				</thead>
	    		<?php foreach($ordem as $key) { ?>
	    			
					<?php 
					
						$cliente_view_1 = cliente_view_1_id($pdo,$key['id_cliente_ordem']);
					
						if($nome=='1'){
							if($_POST['nome'] == $key['id_cliente_ordem']){ 
						
					?>			
					
									<tr id="lista_content">
										<td>
											<?php echo sprintf('%05d',$key['id_ordem']) ?>
										</td>
										<!--
										<td>
											<?php echo $cliente_view_1[0]['cpf_cnpj_cliente'] ?>
										</td>
										-->
										<td>
											<?php 
												$data = explode(" ", $key['data_hora_abertura_ordem']);
												echo  $data[0];
											?>
										</td>
										<td>
											<?php echo $cliente_view_1[0]['nome_razao_social_cliente'] ?>
										</td>
										<td>
											<?php echo $key['defeito_rel_ordem'] ?>
										</td>
										<td>
											<?php echo $cliente_view_1[0]['telefone_cliente'] ?>
										</td>
										<td>
											<?php echo $cliente_view_1[0]['celular_cliente'] ?>
										</td>
										<td>
											<?php echo $key['status_ordem'] ?>
										</td>
										<td>
											<form action="edita_ordem.php" method="get">
												<input type="hidden" name="id" value="<?php echo $key['id_ordem'] ?>" />
												<button type="submit"><img src="imgs/editar.png" style="width: 20px; margin-bottom: -2px" /></button>
											</form>
										</td>
									</tr>
					
						<?php 
							
								}
							}else{ 
						
						?>
									<tr id="lista_content">
										<td>
											<?php echo sprintf('%05d',$key['id_ordem']) ?>
										</td>
										<!--
										<td>
											<?php echo $cliente_view_1[0]['cpf_cnpj_cliente'] ?>
										</td>
										-->
										<td>
											<?php 
												$data = explode(" ", $key['data_hora_abertura_ordem']);
												echo  $data[0];
											?>
										</td>
										<td>
											<?php echo $cliente_view_1[0]['nome_razao_social_cliente'] ?>
										</td>
										<td>
											<?php echo $key['defeito_rel_ordem'] ?>
										</td>
										<td>
											<?php echo $cliente_view_1[0]['telefone_cliente'] ?>
										</td>
										<td>
											<?php echo $cliente_view_1[0]['celular_cliente'] ?>
										</td>
										<td>
											<?php echo $key['status_ordem'] ?>
										</td>
										<td>
											<form action="edita_ordem.php" method="get">
												<input type="hidden" name="id" value="<?php echo $key['id_ordem'] ?>" />
												<button type="submit"><img src="imgs/editar.png" style="width: 20px; margin-bottom: -2px" /></button>
											</form>
										</td>
									</tr>
	    		
	    		<?php }} ?>
    		</table>
    	</div>
    	
    	<br />
    	<span>
    		<a href="cria_ordem_pre_form.php" class="interno">Cadastrar Nova O.S.</a>
    	</span> 	
    	
    </section>       
  </body>  
</html>
