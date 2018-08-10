<?php

	include "php/conection.php";
	include "php/querys.php";

	//include "php/checa.php";
	
	$item = item_view_1($pdo,$_POST['id']);
	
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Votação</title>
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
				padding: 10px 10px 10px;
				margin: 0px 10px 0px;
				background: #ece9d8;
				
			}
			
	</style>
    
  </head>
  <body>
  
    <header>
      <h1 class="float-l">
        <a href="index_index.php" title="Titulo do Site">Home ERP</a>
      </h1>
      
      <input type="checkbox" id="control-nav" />
      <label for="control-nav" class="control-nav"></label>
      <label for="control-nav" class="control-nav-close"></label>

      <nav class="float-r">
      	<ul class="list-auto">
       	<li>
       		<a href="cliente_lista.php">Clientes</a>
       	</li>
       	<li>
       		<a href="produto_lista.php">Produtos</a>
       	</li>
       	<li>
       		<a href="ordem_lista.php">Ordens de Serviço</a>
       	</li>
       	<li>
       		<a href="transp_lista.php">Transportadoras</a>
       	</li>
       </ul>
      </nav>
      
      
    </header>
    
    <section id="cadastro">
    	
    	<div id="corpo">
    		
    		<form action="php/cadastra_venda_pre_mec.php" method="post">
    		
	    		<label id="titulo" for="cliente">Dados da nota</label>
	    		<article id="cliente" class="grupo">
	    			
	    			
		    				<div class="item">
			    				<label class="item_titulo">Modelo:</label>
			    				<br />
			    				<input type="text" name="modelo" style="width: 100px" />
		    				</div>
		    				
	    					
	    		</article>
	    		
	    		<!--
	    		<label id="titulo" for="cliente">Dados do Emitente</label>
	    		<article id="cliente" class="grupo">
		    			
		    				<div class="item">
			    				<label class="item_titulo">Inscrição Estadual:</label>
			    				<br />
			    				<input type="text" name="inscricao_estadual" style="width: 200px" />
		    				</div>
		    				<div class="item">
			    				<label class="item_titulo">Inscrição Estadual Sub. Tributária:</label>
			    				<br />
			    				<input type="text" name="inscricao_estadual_sub_trib" style="width: 200px" />
		    				</div>
		    				<div class="item">
			    				<label class="item_titulo">CNPJ:</label>
			    				<br />
			    				<input type="text" name="cnpj" style="width: 200px" />
		    				</div>
		    				<div class="item">
			    				<label class="item_titulo">Protoolo de Autorização de Uso:</label>
			    				<br />
			    				<input type="text" name="protocolo_uso" style="width: 440px" />
		    				</div>
	    						
	    		</article>
	    		-->
	    		
	    		<center>
	    			<input type="submit" value="Avançar" />
	    		</center>
	    		
	    	</form>
    	
    	</div>
    	
    	
    	
    	
    </section>
        
  </body>
  
</html>
