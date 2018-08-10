<?php

	include "conection.php";
	include "querys.php";
	
	$estado = explode("|",$_GET['estado']);  //codigo do estado passado por parametro

	$cidades = cidades($pdo_estados,$estado[0]);
	
?>

<label class="item_titulo" for="municipio">Município: </label>
<br />
<select id="cidade" name="municipio" style="width: 310px">
	
  <?php foreach($cidades as $value => $nome){
    echo utf8_encode("<option value='".$nome['id']."|".$nome['nome']."'>".$nome['nome']."</option>");
  	}
	?>
	
</select>