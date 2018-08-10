<?php

	include "conection.php";
	include "querys.php";	

	
	//$venda = venda_view_1($pdo,$_GET['id']);
	
	$info = $_GET;
	
	echo '<pre>';
	//print_r($info);
	echo '</pre>';
	
	try{
		$prepara = $pdo->prepare("
		UPDATE tab_nfe SET
		
			tipo_pg_nfe = ?, 
			val_pg_nfe = ?
			
		WHERE id_nfe = ?
		
		");
		
		$prepara->bindParam(1, $info['tipo'], PDO::PARAM_INT );
		$prepara->bindParam(2, $info['val'], PDO::PARAM_INT );
		$prepara->bindParam(3, $info['id_nfe'], PDO::PARAM_INT );
		
		$prepara->execute();
		
	}catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
    	die();
	}
	
	try{
		$prepara = $pdo->prepare("
		UPDATE tab_item_nfe SET
		
			val_desc_item = ?
			
		WHERE id_nfe = ?
		
		");
		
		$prepara->bindParam(1, $info['desc'], PDO::PARAM_INT );
		$prepara->bindParam(2, $info['id_nfe'], PDO::PARAM_INT );
		
		$prepara->execute();
		
	}catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
    	die();
	}
	
	echo "<script>alert('Pagamento editado com Sucesso!');location.reload();</script>";
	
?>