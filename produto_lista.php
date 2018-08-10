<?php
	include "_app/Config.inc.php";
	
	include "php/checa.php";
	
	
	if(isset($_POST['codigo']) && $_POST['codigo'] != NULL){
		$produto = produto_nome($pdo,$_POST['codigo']); //seleciona ordens por cpf
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
    
     <link rel="stylesheet" type="text/css" href="css/ativos.css" />

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
    
    <section id="cadastro">
    	
    	<center>
			<div class="panel panel-default corpo">
				<div style="font-size: 14pt" class="panel-heading">
				</div>
				<div class="panel-body">
			    	<form action="produto_lista.php" method="post" class="form form-inline" style="display: inline-block">
			       	<div id="search">
			       		<span>
			       			Pesquisa por nome do produto:
			       		</span>
			       		<input class="form-control" type="text" name="codigo" id="pesquisa_2" placeholder="Pesquisa de produtos" autofocus />
			       		<input type="submit" style="position: absolute; left: -9999px"/>
			       	</div>
			        </form>
		    	</div>
		    </div>
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
        
        <center>
            <span>
                <a class="btn btn-sinfe-1 btn-block" style="width: 1200px" href="cadastra_produto_form.php" >Cadastrar Produto</a>
            </span>
        </center>
    	
    </section>       
  </body>  
</html>
