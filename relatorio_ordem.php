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
	
	//checa ordens abertas por cliente
	$cont_tot = 0;
	$cont = 0;
	$lista_deb = array();
	$cliente_deb = array();
	$tot_cliente = array();
	//percorre clientes
	foreach($cliente as $key_1){
		//percorre ordens
		foreach($ordem as $index=>$key_2){
			//se o cliente tiver ordem
			if($key_1['id_cliente']==$key_2['id_cliente_ordem']){
				//checa se tem debito
				//if(($key_2['val_a_pg_ordem']-$key_2['val_pg_ordem']) > 0){
					
					$lista_deb[$index]['id_cliente'] = $key_1['id_cliente'];
					$lista_deb[$index]['id_ordem'] = $key_2['id_ordem'];
					$lista_deb[$index]['deb_ordem'] = $key_2['val_a_pg_ordem']-$key_2['val_pg_ordem'];
					
					$cont = 1;
					$cont_tot += $lista_deb[$index]['deb_ordem'];
					
				//}
				
			}
			
		}
		
		if($cont==1){
			$cliente_deb[] = $key_1['id_cliente'];
			$tot_cliente[$key_1['id_cliente']] = $cont_tot; 
			$cont_tot = 0;
			$cont = 0;
		}
		
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
	
	//print_r($lista_deb);

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
    	
		<?php 
			foreach($cliente_deb as $key_1){ 
				$cliente_view_1 = cliente_view_1_id($pdo,$key_1);
				
		?>
			<center>
			<article class="grupo" style="width: 1200px; background: #445A8C; color: #fff; height: 27px; font-size: 12pt;">
				<label style="position: relative; float: left;" ><?php echo $cliente_view_1[0]['nome_razao_social_cliente']; ?></label>
				<label style="position: relative; float: right;"><?php echo "R$".number_format($tot_cliente[$key_1],2,",",""); ?></label>
			</article>
			</center>
			<div id="corpo_ordem" style="width: 1205px;">
				<table id="lista" class="tablesorter">
					<thead>
						<tr id="lista_titulo" style="text-align: center">
							<th style="width: 65px;">
								Número
							</th>
							<th style="width: 80px">
								Data
							</th>
							<th>
								Descrição de Serviços
							</th>
							<th style="width: 50px;">
								Débito
							</th>
							<th style="width: 90px;">
								Telefone
							</th>
							<th style="width: 90px;">
								Celular
							</th>
							<th style="width: 50px;">
								Status
							</th>
							<td style="width: 35px">
								
							</td>
						</tr>
					</thead>
					<?php foreach($lista_deb as $key) { ?>
						
						<?php 
						
							$cliente_view_1 = cliente_view_1_id($pdo,$key_1);
							$ordem_view_1 = ordem_view_1($pdo,$key['id_ordem']);
							
							if($key_1 == $key['id_cliente']){ 
							
						?>
						
							<tr id="lista_content">
								<td>
									<?php echo sprintf('%05d',$ordem_view_1[0]['id_ordem']) ?>
								</td>
								<td>
									<?php 
										$data = explode(" ", $ordem_view_1[0]['data_hora_abertura_ordem']);
										echo  $data[0];
									?>
								</td>
								<td>
									<?php echo $ordem_view_1[0]['defeito_rel_ordem'] ?>
								</td>
								<td>
									<?php echo "R$".number_format($key['deb_ordem'],2,',','')?>
								</td>
								<td>
									<?php echo $cliente_view_1[0]['telefone_cliente'] ?>
								</td>
								<td>
									<?php echo $cliente_view_1[0]['celular_cliente'] ?>
								</td>
								<td>
									<?php echo $ordem_view_1[0]['status_ordem'] ?>
								</td>
								<td>
									<form action="edita_ordem_deb.php" method="get">
										<input type="hidden" name="id" value="<?php echo $key['id_ordem'] ?>" />
										<button type="submit"><img src="imgs/editar.png" style="width: 20px; margin-bottom: -2px" /></button>
									</form>
								</td>
							</tr>
					
					<?php }} ?>
				</table>
			</div>
    	<?php } ?>
    	<br />
    	
    </section>       
  </body>  
</html>
