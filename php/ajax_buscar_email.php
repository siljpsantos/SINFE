<?php

	include "conection.php";
	include "querys.php";

	$cliente = $pdo->query("SELECT * FROM tab_cliente WHERE id_cliente = '".$_GET['id']."' ");
	$cliente = $cliente->fetchAll();
	
?>

<input input type="text" name="email_cliente" style="width: 400px" value="<?php echo $cliente[0]['telefone_cliente'] ?>" readonly>