<?php
	include "_app/Config.inc.php";
	
	include "php/checa.php";
	
	$produto = produto_view_1($pdo,$_POST['id']);
	
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

		<link rel="stylesheet" type="text/css" href="css/ativos.css" />

	</head>
	<!-- chamada do body e todo menu superior-->
	<?php
		include "menu_links.php";
	?>

	<section id="cadastro">
		<center>
			<div class="panel panel-default corpo">
				<div style="font-size: 14pt" class="panel-heading">
					Dados
				</div>
				<div class="panel-body">

					<form action="php/edita_produto_mec.php" method="post">
						
						<input type="hidden" name="id" value="<?php echo $_POST['id'] ?> " />

						<div class="panel panel-sinfe-1 corpo-in">
							<div style="font-size: 14pt" class="panel-heading">
								Produto
							</div>
							<div class="panel-body">

								<div class="item">
				    				<label class="item_titulo"for="descricao">*Descrição: </label>
				    				<br />
				    				<input class="form-control" type="text" name="descricao" value="<?php echo $produto[0]['descricao_produto'] ?>" style="width: 346px; " />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo"for="codigo">Código: </label>
				    				<br />
					    			<input class="form-control" type="text" name="codigo" value="<?php echo $produto[0]['codigo_produto'] ?>" style="width: 200px; " />
					    		</div>
				    			<div class="item">
				    				<label class="item_titulo"for="ncm">NCM: </label>
				    				<br />
					    			<input class="form-control" type="text" name="ncm" value="<?php echo $produto[0]['ncm_produto'] ?>" style="width: 180px; " />
					    		</div>
                                <div class="item">
				    				<label class="item_titulo"for="ncm">CEAN: </label>
				    				<br />
					    			<input class="form-control" type="text" name="ean" value="<?php echo $produto[0]['ean_produto'] ?>" style="width: 180px; " />
					    		</div>
					    		<div class="item">
					    			<label class="item_titulo"for="unid_com">Unid. Produto: </label>
					    			<br />
					    			<input class="form-control" type="text" name="unid" value="<?php echo $produto[0]['unid_produto'] ?>" style="width: 170px; " />
					    		</div>
					    		<div class="item">
					    			<label class="item_titulo"for="val_unid_com">Val. Produto: </label>
					    			<br />
					    			<input class="form-control" type="number" step=".01" name="val" value="<?php echo number_format($produto[0]['valor_produto'],2) ?>" style="width: 170px; " />
					    		</div>
			    				<input class="form-control" type="hidden" name="classe_ipi" value="<?php echo $produto[0]['classe_ipi_produto'] ?>" style="width: 200px; " />
				    			<input class="form-control" type="hidden" name="cod_enquadr_ipi" value="<?php echo $produto[0]['cod_enquadramento_ipi_produto'] ?>" style="width: 220px; " />

							</div>
						</div>

						<input class="btn btn-sinfe-1 btn-block" type="submit" value="Salvar" />

					</form>

				</div>
			</div>
		</center>

	</section>

	</body>

</html>
