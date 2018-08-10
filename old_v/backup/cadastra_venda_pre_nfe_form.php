<?php

	include "php/conection.php";
	include "php/querys.php";
	
	include "php/checa.php";
	
	$emitente = emitente($pdo);
	
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
				padding: 10px 10px 10px;
				margin: 0px 10px 0px;
				background: #ece9d8;
				
			}
			
	</style>
    
  </head>
  <!-- chamada do body e todo menu superior-->
  <?php include "menu_links.php";?>
    
    <section id="cadastro">
    	
    	<div id="corpo">
    		
    		<form action="php/cadastra_venda_pre_nfe_mec.php" method="post">
    		
	    		<label id="titulo" for="cliente">Dados da nota</label>
	    		<article id="cliente" class="grupo">
	    			
	    			<?php date_default_timezone_set('America/Sao_Paulo');  ?>
	    			
		    				<div class="item">
			    				<label class="item_titulo">*Natureza da Operação: </label>
			    				<br />
			    				<input type="text" name="nop" style="width: 300px">
		    				</div>
		    				<div class="item">
			    				<label class="item_titulo">Número: </label>
			    				<br />
			    				<label>&nbsp;</label>
		    				</div>
		    				<div class="item">
			    				<label class="item_titulo">Modelo:</label>
			    				<br />
			    				<select name="modelo" style="width: 100px">
			    					<option <?php if($emitente[0]['padrao_emis_emitente']=="55"){ echo "selected"; } ?> value="55">55 - NFe</option>
			    					<option <?php if($emitente[0]['padrao_emis_emitente']=="65"){ echo "selected"; } ?> value="65">65 - NFCe</option>
			    				</select>	
		    				</div>
		    				<div class="item">
			    				<label class="item_titulo">Série:</label>
			    				<br />
			    				<label>&nbsp;</label>
			    			</div>
			    			<div class="item">
		    					<label class="item_titulo">Data Emiss.:</label>
		    					<br />
		    					<input type="text" name="data_emis" value="<?php echo date("d/m/Y") ?>" style="width: 80px" />
	    					</div>
	    					<div class="item">
		    					<label class="item_titulo">Data Estrada/Saída: </label>
		    					<br />
		    					<input type="text" name="data_saida_entrada" value="<?php echo date("d/m/Y") ?>" style="width: 80px" />
	    					</div>
	    					<div class="item">
		    					<label class="item_titulo">Hora Estrada/Saída: </label>
		    					<br />
		    					<label><?php echo date("H:i:s") ?></label>
		    					<input type="hidden" name="hora_saida_entrada" value="<?php echo date("H:i:s") ?>" />
	    					</div>
	    					
	    		</article>
	    		
	    		<center>
	    			<input type="submit" value="Avançar" />
	    		</center>
	    		
	    	</form>
    	
    	</div>
    	
    	
    	
    	
    </section>
        
  </body>
  
</html>
