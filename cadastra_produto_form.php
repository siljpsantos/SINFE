<?php
	include "_app/Config.inc.php";
	
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

					<form action="php/cadastra_produto_mec.php" method="post">

						<div class="panel panel-sinfe-1 corpo-in">
							<div style="font-size: 14pt" class="panel-heading">
								Produto
							</div>
							<div class="panel-body">

								<div class="item">
									<label class="item_titulo" for="descricao">*Descrição: </label>
									<br />
									<input class="form-control" type="text" name="descricao" style="width: 346px; " />
								</div>
								<div class="item">
									<label class="item_titulo" for="codigo">Código: </label>
									<br />
									<input class="form-control" type="text" name="codigo" style="width: 200px; " />
								</div>
								<div class="item">
									<label class="item_titulo" for="ncm">NCM: </label>
									<br />
									<input class="form-control" type="text" name="ncm" style="width: 180px; " />
								</div>
                                <div class="item">
				    				<label class="item_titulo"for="ncm">CEAN: </label>
				    				<br />
					    			<input class="form-control" type="text" name="ean" style="width: 180px; " />
					    		</div>
								<div class="item">
									<label class="item_titulo" for="unid_com">Unid. Produto: </label>
									<br />
									<input class="form-control" type="text" name="unid" style="width: 170px; " />
								</div>
								<div class="item">
									<label class="item_titulo" for="val_unid_com">Val. Produto: </label>
									<br />
									<input class="form-control" type="number" step=".01" name="val" style="width: 170px; " />
								</div>
								<input class="form-control" type="hidden" name="classe_ipi" style="width: 200px; " value="" />
								<input class="form-control" type="hidden" name="cod_enquadr_ipi" style="width: 220px; " value="" />

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
