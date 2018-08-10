<?php

	include "conection.php";
	include "querys.php";	
	
	echo '<pre>';
	//print_r($info);
	echo '</pre>';
	
	$estados = estados($pdo_estados);
	$cliente = cliente_view_1_id($pdo,$_GET['id']);
	
	//print_r($cliente)
	
?>
<div class="item">
	<label class="item_titulo" for="CPF/CNPJ">Tipo de Documento: </label>
	<br />
	<select id="tipo_doc" name="tipo_doc" style="width: 126px; min-width: 126px;">
		<option value="1">CPF</option>
		<option value="2">CNPJ</option>
	</select>
</div>
<div class="item">
	<label class="item_titulo" for="CPF/CNPJ">CPF/CNPJ: </label>
	<br />
	<input value="<?php echo $cliente[0]['cpf_cnpj_cliente'] ?>" type="text" name="cpf_cnpj" style="width: 100px; min-width: 100px;" />
</div>
<div class="item">
	<label class="item_titulo" for="inscricao estadual">Inscrição Estadual: </label>
	<br />
	<input value="<?php echo $cliente[0]['inscricao_estadual_cliente'] ?>" type="text" name="inscricao_estadual" style="width: 150px; min-width: 126px;" />
</div>
<div class="item">
	<label class="item_titulo" for="inscricao estadual">Inscrição Municipal: </label>
	<br />
	<input type="text" name="inscricao_municipal" style="width: 150px; min-width: 126px;" />
</div>
<div class="item">
	<label class="item_titulo">Isento do ICMS</label>
	<br />
	<input <?php if($cliente[0]['isento_icms_cliente']=="sim"){echo 'checked';} ?> class="item_titulo" type="checkbox" name="isencao_icms" value="1">
</div>
<div class="item">
	<label class="item_titulo" for="SUFRAMA">Inscrição SUFRAMA: </label>
	<br />
	<input value="<?php echo $cliente[0]['inscricao_suframa_cliente'] ?>" type="text" name="suframa" style="width: 150px; min-width: 84px;" />
</div>
<div class="item">
	<label class="item_titulo" for="email">Email: </label>
	<br />
	<input value="<?php echo $cliente[0]['email_cliente'] ?>" type="text" name="email" style="width: 220px; min-width: 220px;" />
</div>
<!--                  ENDEREÇO                 -->
<div class="item">
	<label class="item_titulo" for="Logradouro">Logradouro: </label>
	<br />
	<input value="<?php echo $cliente[0]['logradouro_cliente'] ?>" type="text" name="logradouro" style="width: 660px; min-width: 362px;" />
</div>
<div class="item">
	<label class="item_titulo" for="numero">Número: </label>
	<br />
	<input value="<?php echo $cliente[0]['numero_cliente'] ?>" type="text" name="numero" style="width: 80px; min-width: 33px;" />
</div>
<div class="item">
	<label class="item_titulo" for="complmento">Complemento: </label>
	<br />
	<input value="<?php echo $cliente[0]['complemento_cliente'] ?>" type="text" name="complemento" style="width: 340px; min-width: 126px;" />
</div>
<div class="item">
	<label class="item_titulo" for="bairro">Bairro: </label>
	<br />
	<input value="<?php echo $cliente[0]['bairro_cliente'] ?>" type="text" name="bairro" style="width: 270px; min-width: 126px;" />
</div>
<div class="item">
	<label class="item_titulo" for="CEP">CEP: </label>
	<br />
	<input value="<?php echo $cliente[0]['cep_cliente'] ?>" type="text" name="cep" style="width: 100px; min-width: 113px;" />
</div>
<div class="item">
	<label class="item_titulo" for="uf">UF: </label>
	<br />
	<select id="estado_dest" name="uf" id="uf" onchange="buscar_cidades_dest()">
		<option></option>
		 <?php foreach ($estados as $value => $name) {
		 	if($cliente[0]['uf_cliente'] == $name['codigo_ibge']){
	     		echo "<option selected value=".$name['codigo_ibge'].">".$name['uf']."</option>";
			}else{
				echo "<option value=".$name['codigo_ibge'].">".$name['uf']."</option>";
			}
	     }?>
	 </select>
</div>
<div class="item" id="load_cidades_dest">
	 <label class="item_titulo" for="municipio">Município: </label>
	 <br />
	 <select id="cidade" name="municipio" style="width: 310px; min-width: 113px;">
	 	<option value="<?php echo $cliente[0]['cod_municipio_cliente'] ?>"><?php echo $cliente[0]['municipio_cliente'] ?></option>	
	 </select>
</div>
<div class="item">
	 <label class="item_titulo" for="telefone">Telefone: </label>
	 <br />
	 <input value="<?php echo $cliente[0]['telefone_cliente'] ?>" type="text" name="telefone" style="width: 220px; min-width: 92px;" />
</div>