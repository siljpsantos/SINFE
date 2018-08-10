<?php
	
	include "conection.php";
	include "querys.php";
	
	$status = "fechada";
	
	try{
		$select = $pdo->prepare("
		UPDATE tab_ordem SET
		
		status_ordem = ?
		
		WHERE id_ordem = ".$_GET['id']."
		
		");
		
		$select->bindParam(1, $status, PDO::PARAM_INT );
		
		$select->execute();
		
	}catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
    	die();
	}
	
	
	header("location:../ordem_lista.php");
	
	//echo $_GET['id'];
	
?>