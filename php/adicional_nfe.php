<?php

	include "conection.php";
	include "querys.php";	
	
	$info = $_POST;

	echo '<pre>';
	//print_r($info);
	echo '</pre>';
	
	try{
		
		$update = $pdo->query("
			UPDATE tab_nfe
			SET
				inf_ad_fisco_nfe = '".preg_replace( "/\r|\n|\r\n/", " ", $info['fisco'] )."',	
				inf_ad_compl_nfe = '".preg_replace( "/\r|\n|\r\n/", " ", $info['compl'] )."'
			WHERE
				id_nfe = '".$info['id_nfe']."'
		");
		
	}catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
    	die();
	}
	
	header('Location: ../cadastra_venda_pos_nfe_form.php?id='.$info['id_nfe']);
	
?>