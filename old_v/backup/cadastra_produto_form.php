<?php
	include "php/conection.php";
	include "php/querys.php";
	
	include "php/checa.php";
	
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
    		
    		<form action="php/cadastra_produto_mec.php" method="post">
    		
	    		<label id="titulo" for="cliente">Produto</label>
	    		<article id="cliente" class="grupo">
	    			
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
    				<input type="hidden" name="classe_ipi" style="width: 200px; " value="" />
	    			<input type="hidden" name="cod_enquadr_ipi" style="width: 220px; " value="" />
		    		
		    	</article>
	    		
	    		<center>
	    			<input type="submit" value="cadastrar" />
	    		</center>
	    		
	    	</form>
    	
    	</div>
    	
    	
    	
    	
    </section>
        
  </body>
  
</html>
