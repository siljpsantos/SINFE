<?php
	include "_app/Config.inc.php";
	
	include "php/checa.php";
	
	
	
	$produto = produto_view_1($pdo,$_POST['id']); //seleciona o cliente pelo cpr registrado na ordem
	
	
?>
<!DOCTYPE html>
<html>
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
				padding: 10px 10px 0px;
				margin: 0px 10px 0px;
				background: #ece9d8;
				
			}

			
	</style>
    
  </head>
  <!-- chamada do body e todo menu superior-->
  <?php include "menu_links.php";?>
    
    <section id="cadastro">
    	
    	<div id="corpo">
    		
    		<form action="php/entrada_produto_mec.php" method="post">
    			
    			<input type="hidden" name="id" value="<?php echo $_POST['id'] ?> " />
    		
	    		<label id="titulo" for="cliente">Produto</label>
	    		<article id="cliente" class="grupo">
	    			
	    			<div class="item">
	    				<label class="item_titulo"for="descricao">*Descrição: </label>
	    				<br />
	    				<input disabled type="text" name="descricao" value="<?php echo $produto[0]['descricao_produto'] ?>" style="width: 346px; " />
	    			</div>
	    			<div class="item">
	    				<label class="item_titulo"for="codigo">Código: </label>
	    				<br />
		    			<input disabled type="text" name="codigo" value="<?php echo $produto[0]['codigo_produto'] ?>" style="width: 200px; " />
		    		</div>  			
	    			
	    		</article>
		    	
		    	<label id="titulo" for="cliente">Dados de entrada</label>
	    		<article id="entrada" class="grupo">
		    	
		    		<div class="item">	
		    			<label class="item_titulo" for="">Quantidade Entrada: </label>
		    			<br />
		    			<input required type="text" name="qtd_movimentada" style="width: 200px; " />
		    		</div>
		    		<div class="item">	
		    			<label class="item_titulo" for="">Valor unitário: </label>
		    			<br />
		    			<input required type="text" name="val_unit" style="width: 200px; " />
		    		</div>
		    		|
		    		<div class="item">	
		    			<label class="item_titulo" for="">Numero da nf: </label>
		    			<br />
		    			<input required type="text" name="numero_nfe" style="width: 200px; " />
		    		</div>
		    		<div class="item">	
		    			<label class="item_titulo" for="">Série da nf: </label>
		    			<br />
		    			<input required type="text" name="serie_nfe" style="width: 200px; " />
		    		</div>
	    			
	    		</article>
	    		
	    		<center>
	    			<input type="submit" value="Registrar Entrada" />
	    		</center>
	    		
	    	</form>
    	
    	</div>
    	
    	
    	
    	
    </section>
        
  </body>
  
</html>
