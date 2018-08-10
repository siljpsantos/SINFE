<?php
	include "_app/Config.inc.php";
	
	include "php/checa.php";
	
	
	$logs = rel_prod($pdo,$_GET['id']);
	$logs_2 = rel_op_prod($pdo,$_GET['id']);
	
	//$logs = array_combine($logs,$logs_2);
	
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
   
  </head>
  <!-- chamada do body e todo menu superior-->
  <?php include "menu_links.php";?>
    
    <section id="cadastro">

		<!--<?php echo "<pre>"; print_r($logs); print_r($logs_2); echo "</pre>" ?>-->
		
    	<form action="produto_lista.php" method="post" style="display: inline-block">
       	<div id="search">
       		<span>
       			Registros do produto
       		</span>
       	</div>
       </form>
    	
    	<div id="corpo_movimento">
    		<table id="lista">
    			<tr id="lista_titulo" style="text-align: center">
    				<td>
    					Operação n°
    				</td>
    				<td>
    					Nfe n°
    				</td>
    				<td>
    					Série nfe
    				</td>
    				<td>
    					Data da Operação
    				</td>
    				<td>
    					Tipo de Movimentação
    				</td>
    				<td>
    					Qtd Movimentada
    				</td>
    				<td>
    					Preço Unitário
    				</td>
    				<td>
    					Saldo pós Operação
    				</td>
    			</tr>
	    		<?php foreach($logs as $key => $log) { ?>
	    			
	    			<tr id="lista_content">
	    				<td>
	    					<?php echo $log['id_op'] ?>
	    				</td>
	    				<td>
	    					<?php echo $log['numero_nfe'] ?>
	    				</td>
	    				<td>
	    					<?php echo $log['serie_nfe'] ?>
	    				</td>
	    				<td>
	    					<?php echo $log['data_movimento'] ?>
	    				</td>
	    				<td>
	    					<?php echo $log['tipo_movimento'] ?>
	    				</td>
	    				<td>
	    					<?php echo $logs_2[$key]['qtd_movimentada'] ?>
	    				</td>
	    				<td>
	    					<?php echo "R$".$logs_2[$key]['val_unit'] ?>
	    				</td>
	    				<td>
	    					<?php echo number_format($logs_2[$key]['qtd_saldo'],0,',','.') ?>
	    				</td>
	    			</tr>
	    		
	    		<?php } ?>
    		</table>
    	</div> 	
    	
    	<br />
    	<span>
    		<a href="produto_lista.php" class="interno">Voltar</a>
    	</span>
    	
    </section>       
  </body>  
</html>
