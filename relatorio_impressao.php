<?php

	include "_app/Config.inc.php";
	
	include "php/checa.php";
	
	
	$select = emitente($pdo); //seleciona o emitente pricipal
	
	if(isset($_POST['mes']) && $_POST['mes'] != NULL){
		
		$regex = '/^[0-9]{2}\\/[0-9]{4}$/';
			
		if(!preg_match($regex,$_POST['mes'])){
			header('location: relatorio_lista.php');
			exit;
		}
	
		$venda = venda_mensal($pdo,$_POST['mes']); //seleciona todas as vendas do mes
	}else{
		
		//echo "<pre>";
		//print_r($_POST);
		
		$data1 = $_POST['ano_1']."-".$_POST['mes_1']."-".$_POST['dia_1'];
		$data2 = $_POST['ano_2']."-".$_POST['mes_2']."-".$_POST['dia_2'];
		
		$venda = venda_periodo($pdo,$data1,$data2); //seleciona todas as vendas entre as datas
		
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
    <link rel="stylesheet" type="text/css" href="css/impressao.css" />
    
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
    		<?php include "cabecalho_impressao.php" ?>
    	</center>
    	
    	
    	<br />
        <span id="esconder">
			<a href="javascript:self.print()" class="interno" style="font-size: 20pt">IMPRIMIR</a>
		</span>
		<br />
    
    <div class="corpo_venda">
 			
    		<div class="titulo">
    			<br />
    			<span>
    				<center>
	    				Vendas do Mês
    				</center>
	    		</span>
	    		<br/>
    		</div>
    		
    		<table id="lista">
    			<tr id="lista_titulo" style="text-align: center">
    				<td>
    					N°
    				</td>
    				<td>
    					Status da Venda
    				</td>
    				<td>
    					Data de Emissão
    				</td>
    				<td>
    					Valor total
    				</td>
    				<td>
    					
    				</td>
    			</tr>
	    		<?php $cont = 0; foreach($venda as $key) { ?>
	    			
	    			<?php $cont += $key['val_total_nfe']; ?>
	    			
	    			<tr id="lista_content">
	    				<td>
	    					<?php echo $key['id_nfe'] ?>
	    				</td>
	    				<td>
	    					<?php echo $key['status_venda_nfe'] ?>
	    				</td>
	    				<td>
	    					<?php echo $key['data_emis_nfe'] ?>
	    				</td>
	    				<td>
	    					R$<?php echo number_format($key['val_total_nfe'], 2, ',', '.'); ?>
	    				</td>
	    				<td>
	    					<form action="cadastra_venda_pos_form.php" method="get">
	    						<input type="hidden" name="id" value="<?php echo $key['id_nfe'] ?>" />
	    						<button type="submit">Editar</button>
	    					</form>
	    				</td>
	    			</tr>
	    		
	    		<?php } ?>
	    		
	    		<tr id="lista_content">
	    			<td colspan="3">
	    				Total das Venda do Mês:
	    			</td>
	    			<td colspan="2">
	    				R$<?php echo number_format($cont, 2, ',', '.'); ?>
	    			</td>
	    		</tr>
	    		
    		</table>
    	</div> 	
    	
    	</div> 
    	
    	
    	
    	
    </section>       
  </body>  
</html>
