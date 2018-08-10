<?php

	include "conection.php";
	include "querys.php";
	
	$estado = $_GET['estado'];  //codigo do estado passado por parametro

	$cidades = cidades($pdo_estados,$estado);
	
?>
<span class="item_titulo" for="municipio">Município: </span>
<br />
<select class="form-control" class="cidade" name="municipio_1" style="width: 280px">
	
  <?php foreach($cidades as $value => $nome){
    echo utf8_encode("<option value='".$nome['id']."|".$nome['nome']."'>".$nome['nome']."</option>");
  	}
	?>
	
</select>