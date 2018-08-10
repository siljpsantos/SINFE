<?php
	include "php/conection.php";
	include "php/querys.php";
	
	include "php/checa.php";
	
	
	if(isset($_POST['codigo']) && $_POST['codigo'] != NULL){
		$produto = produto_codigo($pdo,$_POST['codigo']); //seleciona ordens por cpf
	}else {
		$produto = produto($pdo); //seleciona todas as ordens
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
		    	<form action="produto_lista.php" method="post" style="display: inline-block">
		       	<div id="search">
		       		<span>
		       			Pesquisa por codigo do produto:
		       		</span>
		       		<input type="text" name="codigo" id="pesquisa_2" placeholder="Pesquisa de produtos" autofocus />
		       		<img src="assets/images/lupa.png" id="pesquisa_img">
		       		<input type="submit" style="position: absolute; left: -9999px"/>
		       	</div>
		       </form>
		    </article>
		</center>
		
		<br />
    	
    	<div id="corpo_produto" style="height: 400px; width: 1205px; overflow: auto;">
    		
    		<table id="lista" class="tablesorter">
    			
    			<tr id="lista_titulo" style="text-align: center">
    				<thead>
	    				<th style="width: 300px;">
	    					Produto
	    				</th>
	    				<th style="width: 80px;">
	    					Código
	    				</th>
	    				<td style="width: 50px;">
	    					
	    				</td>
    				</thead>
    			</tr>
	    		<?php foreach($produto as $key) { ?>
	    			
	    			<tr id="lista_content">
	    				<td>
	    					<?php echo $key['descricao_produto'] ?>
	    				</td>
	    				<td>
	    					<?php echo $key['codigo_produto'] ?>
	    				</td>
	    				<td>
	    					<form action="edita_produto.php" method="post">
	    						<input type="hidden" name="id" value="<?php echo $key['id_produto'] ?>" />
	    						<button type="submit">Editar</button>
	    					</form>
	    				</td>
	    				<!--
	    				<td>
	    					<form action="entrada_produto_form.php" method="post">
	    						<input type="hidden" name="id" value="<?php echo $key['id_produto'] ?>" />
	    						<button type="submit">Registrar entrada</button>
	    					</form>
	    				</td>
	    				<td>
	    					<form action="log_produto_lista.php" method="get">
	    						<input type="hidden" name="id" value="<?php echo $key['id_produto'] ?>" />
	    						<button type="submit">Movimentação</button>
	    					</form>
	    				</td>
	    				-->
	    			</tr>
	    		
	    		<?php } ?>
    		</table>
    	</div> 	
    	
    	<br />
    	<span>
    		<a href="cadastra_produto_form.php" class="interno">Cadastrar Produto</a>
    	</span>
    	
    </section>       
  </body>  
</html>
