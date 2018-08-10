<?php
	
	include "_app/Config.inc.php";
    
	include "php/checa.php";
	
	$estados = estados($pdo_estados);

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
					Dados
				</div>
				<div class="panel-body">
		
		    		<form action="php/cadastra_cliente_mec.php" method="post">
		    		
			    		<div class="panel panel-sinfe-1 corpo-in">
							<div style="font-size: 14pt" class="panel-heading">
								Pessoal
							</div>
							<div class="panel-body">
			    			
				    			<div class="item">
				    				<label class="item_titulo" for="nome/razao social">*Nome/Razão Social: </label>
				    				<br/>
				    				<input class="form-control" type="text" name="nome/razao_social" style="width: 1120px; min-width: 400px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="CPF/CNPJ">CPF/CNPJ: </label>
				    				<br />
					    			<input class="form-control" type="text" name="cpf/cnpj" style="width: 150px; min-width: 126px;" />
					    		</div>
					    		<div class="item">
					    			<label class="item_titulo" for="inscricao estadual">Inscrição Estadual: </label>
					    			<br />
					    			<input class="form-control" type="text" name="inscricao_estadual" style="width: 150px; min-width: 126px;" />
					    		</div>
					    		<div class="item">
					    			<label class="item_titulo">Isento do ICMS</label>
					    			<br />
					    			<input class="item_titulo" type="checkbox" name="isencao icms" value="sim">
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="SUFRAMA">Inscrição SUFRAMA: </label>
				    				<br />
					    			<input class="form-control" type="text" name="suframa" style="width: 150px; min-width: 84px;" />
					    		</div>
					    		<div class="item">
					    			<label class="item_titulo" for="email">Email: </label>
					    			<br />
					    			<input class="form-control" type="text" name="email" style="width: 296px; min-width: 286px;" />
				    			</div>
				    			<div class="item">
					    			<label class="item_titulo" for="status">Status: </label>
					    			<br />
					    			<select class="form-control" name="status" style="width: 176px; min-width: 100px;">
					    				<option></option>
					    				<option>ativo</option>
					    				<option>nao ativo</option>
					    			</select>
				    			</div>
			    			</div>
			    		</div>
			    		
			    		<div class="panel panel-sinfe-1 corpo-in">
							<div style="font-size: 14pt" class="panel-heading">
								Cobrança
							</div>
							<div class="panel-body">
			    			
				    			<div class="item">
				    				<label class="item_titulo" for="banco">Banco: </label>
				    				<br />
				    				<input class="form-control" type="text" name="banco" style="width: 510px; min-width: 84px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="agencia">Agência: </label>
				    				<br />
				    				<input class="form-control" type="text" name="agencia" style="width: 290px; min-width: 84px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="conta">Conta: </label>
				    				<br />
				    				<input class="form-control" type="text" name="conta" style="width: 285px; min-width: 84px;" />
				    			</div>
			    			</div>
			    		</div>
			    		
			    		<div class="panel panel-sinfe-1 corpo-in">
							<div style="font-size: 14pt" class="panel-heading">
								Endereço
							</div>
							<div class="panel-body">
			    			
				    			<div class="item">
				    				<label class="item_titulo" for="Logradouro">Logradouro: </label>
				    				<br />
				    				<input class="form-control" type="text" name="logradouro" style="width: 660px; min-width: 362px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="numero">Número: </label>
				    				<br />
					    			<input class="form-control" type="text" name="numero" style="width: 80px; min-width: 33px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="complmento">Complemento: </label>
				    				<br />
					    			<input class="form-control" type="text" name="complemento" style="width: 340px; min-width: 126px;" />
					    		</div>
					    		<div class="item">
					    			<label class="item_titulo" for="bairro">Bairro: </label>
					    			<br />
					    			<input class="form-control" type="text" name="bairro" style="width: 270px; min-width: 126px;" />
					    		</div>
					    		<div class="item">
					    			<label class="item_titulo" for="CEP">CEP: </label>
					    			<br />
					    			<input class="form-control" type="text" name="cep" style="width: 100px; min-width: 113px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="pais">País: </label>
				    				<br />
					    			<select class="form-control" name="pais">
					    				<option value=""></option>
										<option value="Brasil" selected="selected">Brasil</option>
									</select>
								</div>
								<div class="item">
					    			<label class="item_titulo" for="uf">UF: </label>
					    			<br />
					    			<select class="form-control" id="estado" name="uf" id="uf" onchange="buscar_cidades()">
					    				<option></option>
										 <?php foreach ($estados as $value => $name) {
									          echo "<option value=".$name['codigo_ibge'].">".$name['uf']."</option>";
									        }?>
									 </select>
								</div>
								<div class="item" id="load_cidades">
									 <label class="item_titulo" for="municipio">Município: </label>
									 <br />
									 <select class="form-control" id="cidade" name="municipio" style="width: 310px; min-width: 113px;">
									 	<option value="">Selecione o estado</option>	
									 </select>
								</div>
								<div class="item">
									 <label class="item_titulo" for="telefone">Telefone: </label>
									 <br />
									 <input class="form-control" type="text" name="telefone" style="width: 220px; min-width: 92px;" />
				    			</div>  			
			    			</div>
			    		</div>
			    		
			    		<div class="panel panel-sinfe-1 corpo-in">
							<div style="font-size: 14pt" class="panel-heading">
								Contato
							</div>
							<div class="panel-body">
			    			
				    			<div class="item">
				    				<label class="item_titulo" for="nome_contato">Nome do contato: </label>
				    				<br />
				    				<input class="form-control" type="text" name="nome_contato" style="width: 350px; min-width: 252px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="telefone_contato">Telefone do contato: </label>
									<br />
									<input class="form-control" type="text" name="telefone_contato" style="width: 220px; min-width: 92px;" />
				    			</div>
				    			<div class="item">
				    				<label class="item_titulo" for="email_contato">Email do contato: </label>
				    				<br />
				    				<input class="form-control" type="text" name="email_contato" style="width: 510px; min-width: 400px;" />
				    			</div>
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
