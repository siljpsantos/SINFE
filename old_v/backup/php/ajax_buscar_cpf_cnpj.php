<?php

	include "conection.php";
	include "querys.php";

	$cliente = $pdo->query("SELECT * FROM tab_cliente WHERE id_cliente = '".$_GET['id']."' ");
	$cliente = $cliente->fetchAll();
	
?>

<input type="text" name="cpf_cnpj_cliente" value="<?php echo $cliente[0]['cpf_cnpj_cliente'] ?>" readonly>