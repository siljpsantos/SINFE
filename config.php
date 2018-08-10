<?php
	include "_app/Config.inc.php";
	
	include "php/checa.php";
	
	$estados = estados($pdo_estados);
	
	$emitente = emitente($pdo); //seleciona o emitente
	
	
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
   
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script>
	    function buscar_cidades(){
	      var estado = $('#estado option:selected').val();
	      if(estado){
	        var url = 'php/ajax_buscar_cidades.php?estado='+estado;
	        $.get(url, function(dataReturn) {
	          $('#load_cidades').html(dataReturn);
	        });
	      }
	    }
    </script>
    
  </head>
  <!-- chamada do body e todo menu superior-->
  <?php include "menu_links.php";?>
    
    <section id="cadastro">
    	<center>
	    	<div class="panel panel-default corpo">
				<div style="font-size: 14pt" class="panel-heading">
					Configurações
				</div>
				<div class="panel-body">
                    
                    <form action="backup_db/index.php">
	    				<button class="btn btn-warning btn-block">BACKUP DA BASE DE DADOS</button>
	    			</form>
                    
                    <br />
					
		    		<form action="php/edita_emitente_mec.php" method="post">
		    			
		    			<div class="panel panel-sinfe-1 corpo-in">
							<div style="font-size: 14pt" class="panel-heading">
								Dados do Emitente
							</div>
							<div class="panel-body">
		    		
				    			<input class="form-control" type="hidden" name="id" value="<?php echo $emitente[0]['id_emitente'] ?>" />
					    			
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">*Nome/Razão Social: </label>
				    				<br />
				    				<input class="form-control" type="text" maxlength="60" name="nome/razao_social" value="<?php echo $emitente[0]['nome_razao_social_emitente'] ?>" style="width: 460px; min-width: 400px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">Nome Fantasia: </label>
				    				<br />
				    				<input class="form-control" type="text" maxlength="60" name="nome_fantasia" value="<?php echo $emitente[0]['nome_fantasia_emitente'] ?>" style="width: 460px; min-width: 400px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">CNPJ: </label>
				    				<br />
				    				<input class="form-control" type="text" name="cnpj" value="<?php echo $emitente[0]['cnpj_emitente'] ?>" style="width: 160px; min-width: 30px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">Inscrição Estadual: </label>
				    				<br />
				    				<input class="form-control" type="text" name="inscricao_estadual" value="<?php echo $emitente[0]['inscricao_estadual_emitente'] ?>" style="width: 160px; min-width: 30px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">Inscrição Estadual Trib.: </label>
				    				<br />
				    				<input class="form-control" type="text" name="inscricao_estadual_trib" value="<?php echo $emitente[0]['inscricao_estadual_trib_emitente'] ?>" style="width: 160px; min-width: 30px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">CNAE Fiscal: </label>
				    				<br />
				    				<input class="form-control" type="text" name="cnae_fiscal" value="<?php echo $emitente[0]['cnae_fiscal_emitente'] ?>" style="width: 160px; min-width: 30px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">Inscrição Municipal: </label>
				    				<br />
				    				<input class="form-control" type="text" name="inscricao_municipal" value="<?php echo $emitente[0]['inscricao_municipal_emitente'] ?>" style="width: 160px; min-width: 30px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">Regime Tributário: </label>
				    				<br />
				    				<select class="form-control" redonly name="regime_tributario" style="width: 195px">
				    					<option value="1">Simples Nacional</option>
				    				</select>
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">Ambiente: </label>
				    				<br />
				    				<select class="form-control" redonly name="ambiente" style="width: 180px">
				    					<option <?php if($emitente[0]['ambiente_nfe_emitente']=="1"){ echo "selected"; } ?> value="1">Produção</option>
				    					<option <?php if($emitente[0]['ambiente_nfe_emitente']=="2"){ echo "selected"; } ?> value="2">Homologação</option>
				    				</select>
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">Logradouro: </label>
				    				<br />
				    				<input class="form-control" type="text" name="logradouro" value="<?php echo $emitente[0]['logradouro_emitente'] ?>" style="width: 460px; min-width: 30px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">Numero: </label>
				    				<br />
				    				<input class="form-control" type="text" name="numero" value="<?php echo $emitente[0]['numero_emitente'] ?>" style="width: 60px; min-width: 30px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">Complemento:</label>
				    				<br />
				    				<input class="form-control" type="text" name="complemento" value="<?php echo $emitente[0]['complemento_emitente'] ?>" style="width: 270px; min-width: 30px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">Bairro: </label>
				    				<br />
				    				<input class="form-control" type="text" name="bairro" value="<?php echo $emitente[0]['bairro_emitente'] ?>" style="width: 265px; min-width: 30px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">CEP: </label>
				    				<br />
				    				<input class="form-control" type="text" name="cep" value="<?php echo $emitente[0]['cep_emitente'] ?>" style="width: 160px; min-width: 30px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">País: </label>
				    				<br />
				    				<select class="form-control" name="pais" style="width: 100px">
				    					<option value="55">Brasil</option>
				    				</select>
				    			</div>
				    			<div class="item">
					    			<label class="item_titulo" for="uf">UF: </label>
					    			<br />
					    			<select class="form-control" id="estado" name="uf" id="uf" onchange="buscar_cidades()">
					    				<option></option>
										 <?php 
										 	foreach ($estados as $value => $name) {
											 	if($emitente[0]['uf_emitente']==$name['uf']){
											 		echo "<option selected value=".$name['codigo_ibge']."|".$name['uf'].">".$name['uf']."</option>";
											 	}else{
										          echo "<option value=".$name['codigo_ibge']."|".$name['uf'].">".$name['uf']."</option>";
										        }
										 	}
									     ?>
									 </select>
								</div>
								<div class="item" id="load_cidades">
									 <label class="item_titulo" for="municipio">Município: </label>
									 <br />
									 <select class="form-control" id="cidade" name="municipio" style="width: 310px; min-width: 113px;">
									 	<option value="<?php echo $emitente[0]['cod_municipio_emitente']."|".$emitente[0]['municipio_emitente']; ?>"><?php echo $emitente[0]['municipio_emitente'] ?></option>	
									 </select>
								</div>
								<div class="item">
				    				<label class="item_titulo" for="nome/razao social">Telefone: </label>
				    				<br />
				    				<input class="form-control" type="text" name="telefone" value="<?php echo $emitente[0]['telefone_emitente'] ?>" style="width: 160px; min-width: 30px;" />
				    			</div>
				    			<input class="form-control" type="hidden" name="pis" value="<?php echo $emitente[0]['base_pis_emitente'] ?>" style="width: 110px; min-width: 30px;" />
				    			<input class="form-control" type="hidden" name="cofins" value="<?php echo $emitente[0]['base_cofins_emitente'] ?>" style="width: 107px; min-width: 30px;" />
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">Padrão de Emissão: </label>
				    				<br />
				    				<select class="form-control" name="emis" style="width: 160px; min-width: 30px;">
				    					<option <?php if($emitente[0]['padrao_emis_emitente']=="55"){ echo "selected"; } ?> value="55">55 - NFe</option>
						    			<option <?php if($emitente[0]['padrao_emis_emitente']=="65"){ echo "selected"; } ?> value="65">65 - NFCe</option>
				    				</select>
				    			</div>
                                
                                <!-- CAMPOS DE ALTERAÇÃO DE NUMERO DAS NOTAS -->
                                <div class="item">
                                    <label class="item_titulo" for="nome/razao social">Numer. DANFE: </label>
                                    <br />
                                    <input class="form-control" value="<?php echo $emitente[0]['n_nota_emitente'] ?>" type="number" name="n_nota_nfe" style="width: 100px; min-width: 30px;" />
                                </div>

                                <div class="item">
                                    <label class="item_titulo" for="nome/razao social">Numer. NFCe: </label>
                                    <br />
                                    <input class="form-control" value="<?php echo $emitente[0]['n_nfce_emitente'] ?>" type="number" name="n_nota_nfce" style="width: 100px; min-width: 30px;" />
                                </div>

                                <!-- CASO SO TENHA DANFE, DESCOMENTE ISTO E COMENTE O BLOCO NFCE ACIMA
                                <input value="<?php echo $emitente[0]['n_nfce_emitente'] ?>" type="number" name="n_nota_nfce" style="width: 100px; min-width: 30px;" />
                                -->
                                
				    		</div>
				    	</div>
				    		
			    		<div class="panel panel-sinfe-1 corpo-in-min">
							<div style="font-size: 14pt" class="panel-heading">
								Senha Master
							</div>
							<div class="panel-body">
				    			<div class="item">
				    				<label class="item_titulo">Senha Master: </label>
				    				<br />
				    				<input class="form-control" type="password" name="master" style="width: 107px; min-width: 30px;" />
				    			</div>
				    		</div>
				    	</div>
				    	
				    	<input class="btn btn-sinfe-1" type="submit" value="salvar" />
			    		
			    	</form>
				    	
    			</div>
    		</div>
		</center>
    		
    </section>
    
<!--    <center>
    	<a class="interno" href="cadastra_user_form.php">Cadastrar novo Usuário</a>
    </center>
    
    <br /><br /><br /><br />-->
    
  </body>
  
</html>
