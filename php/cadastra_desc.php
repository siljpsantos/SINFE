<?php

	include "conection.php";
	include "querys.php";	

	
	//$venda = venda_view_1($pdo,$_GET['id']);
	
	$info = $_POST;
    
    $info['val_desc'] = str_replace(",", ".", $info['val_desc']);
	
	//echo '<pre>';
	//print_r($info);
	//echo '</pre>';
		
	try{
		$prepara = $pdo->prepare("
		UPDATE tab_item_nfe SET
		
			val_desc_item = ?
			
		WHERE id_nfe = ?
		
		");
		
		$prepara->bindParam(1, $info['val_desc'], PDO::PARAM_INT );
		$prepara->bindParam(2, $info['id_nfe'], PDO::PARAM_INT );
		
		$prepara->execute();
		
	}catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
    	die();
	}
	
	echo "<script>alert('Desconto aplicado com Sucesso!');</script>";
	//header('Location: ../cadastra_venda_pos_nfe_form.php?id='.$info['id_nfe'].'#itens');
    header('Location: ../cadastra_venda_pos_nfe_form.php?id='.$info['id_nfe']);
	
?>