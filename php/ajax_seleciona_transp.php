<?php

	include "conection.php";
	include "querys.php";	
	
	//echo '<pre>';
	//print_r($info);
	//echo '</pre>';
	
	$ind_xml = 1;
	
	$estados = estados($pdo_estados);
	
	$venda = venda_view_1($pdo,$_GET['venda']);
	$transp_g = transp($pdo);
	$transp = transp_id($pdo,$_GET['id']);
	
	//print_r($venda);
	
?>
<div class="item">
	 <span class="item_titulo">Modalidade do Frete: </span>
	 <br />
	 <select class="form-control" name="mod_frete">
	 	<option></option>
	 	<option <?php if($venda[0]['mod_frete']=="0"){echo 'selected="selected"';} ?> value="0">0 - Por conta do Emitente</option>
	 	<option <?php if($venda[0]['mod_frete']=="1"){echo 'selected="selected"';} ?> value="1">1 - Por conta do Destinatário/Remetente</option>
	 	<option <?php if($venda[0]['mod_frete']=="2"){echo 'selected="selected"';} ?> value="2">2 - Por conta de Terceiros</option>
	 	<option <?php if($venda[0]['mod_frete']=="9"){echo 'selected="selected"';} ?> value="9">9 - Sem Frete</option>
	 </select>
</div>
<div class="item">
	<span class="item_titulo">Código ANTT:</span>
	<br />
	<input class="form-control" value="<?php echo $venda[0]['cod_antt_nfe'] ?>" name="cod_antt" type="text" style="width: 120px" />
</div>
<div class="item">
	<span class="item_titulo">Placa do Veículo:</span>
	<br />
	<input class="form-control" value="<?php echo $venda[0]['placa_veic_nfe'] ?>" name="placa" type="text" style="width: 120px" />
</div>
<div class="item">
	<span class="item_titulo">UF do Veículo:</span>
	<br />
	<select class="form-control" name="uf_vei" id="uf_vei">
		<option></option>
		 <?php foreach ($estados as $value => $name) { ?>
	        	<option <?php if($venda[0]['uf_veic_nfe']==$name['uf']){echo 'selected="selected"';} ?> value="<?php echo $name['uf'] ?>"><?php echo $name['uf'] ?></option>
	     <?php } ?>
	 </select>
</div>
<div class="item">
	<span class="item_titulo">Tipo de Documento:</span>
	<br />
	<select class="form-control" name="tipo_doc" id="tipo_doc">
		<option></option>
		<option <?php if($venda[0]['tipo_doc_transp_nfe']=="1"){echo 'selected="selected"';} ?> value="1">1 - CPF</option>
		<option <?php if($venda[0]['tipo_doc_transp_nfe']=="2"){echo 'selected="selected"';} ?> value="2">2 - CNPJ</option>
	 </select>
</div>
<div class="item">
	<span class="item_titulo">CPF/CNPJ:</span>
	<br />
	<input class="form-control" value="<?php echo $transp[0]['cnpj_transportadora'] ?>" name="cpf_cnpj" type="text" style="width: 120px" />
</div>
<div class="item">
	<span class="item_titulo">Logradouro:</span>
	<br />
	<input class="form-control" value="<?php echo $transp[0]['logradouro_transportadora'] ?>" type="text" name="logr_transp" style="width: 300px"  />
</div>
<div class="item">
	<span class="item_titulo" for="uf">UF: </span>
	<br />
	<select class="form-control" id="estado_transp" name="uf" onchange="buscar_cidades_transp()">
		<option></option>
		 <?php foreach ($estados as $value => $name) { ?>
        	<option <?php if($transp[0]['uf_transportadora']==$name['uf']){ echo 'selected';} ?> value="<?php echo $name['codigo_ibge']."|".$name['uf'] ?>"><?php echo $name['uf'] ?></option>
    	 <?php } ?>
	 </select>
</div>
<div class="item" id="load_cidades_transp">
	 <span class="item_titulo" for="municipio">Município: </span>
	 <br />
	 <select class="form-control" class="cidade" name="municipio" style="width: 280px">
	 	<option value="<?php echo $transp[0]['cod_municipio_transportadora']."|".$transp[0]['municipio_transportadora']; ?>"><?php echo utf8_encode($transp[0]['municipio_transportadora']) ?></option>
	 </select>
</div>
<div class="item">
	<span class="item_titulo">Inscrição Estadual:</span>
	<br />
	<input class="form-control" value="<?php echo $transp[0]['inscricao_estadual_transportadora'] ?>" type="text" name="ie_transp" style="width: 100px"  />
</div>
