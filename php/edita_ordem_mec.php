<?php

	include "conection.php";
	include "querys.php";
	
	echo '<pre>';
	//print_r($_POST);
	//echo '</pre>';
	
	$info = $_POST;
	
	$garantia = explode("/",$info['garantia_ate']);
	$info['garantia_ate'] = $garantia[2]."-".$garantia[1]."-".$garantia[0];
	
	//echo "<br />";
	
	//abertura
	$data = explode("/",$info['data_abertura']);
	$info['data_chamado'] = $data[2]."-".$data[1]."-".$data[0]." ".$info['hora_abertura'];
	
	//fechamento
	$data_f = explode("/",$info['data_fechamento']);
	$info['data_chamado_f'] = $data_f[2]."-".$data_f[1]."-".$data_f[0]." ".$info['hora_fechamento'];
	
	//preenche checkboxes nulas
	
	//acessorios
	if(!isset($_POST['cabo_forca_yn'])){
		$info['cabo_forca_yn'] = 0;
	}
	if(!isset($_POST['cabo_video_yn'])){
		$info['cabo_video_yn'] = 0;
	}
	if(!isset($_POST['bandejas_yn'])){
		$info['bandejas_yn'] = 0;
	}
	if(!isset($_POST['base_yn'])){
		$info['base_yn'] = 0;
	}
	if(!isset($_POST['toner_yn'])){
		$info['toner_yn'] = 0;
	}
	if(!isset($_POST['cartucho_preto_yn'])){
		$info['cartucho_preto_yn'] = 0;
	}
	if(!isset($_POST['cartucho_color_yn'])){
		$info['cartucho_color_yn'] = 0;
	}
	if(!isset($_POST['fonte_yn'])){
		$info['fonte_yn'] = 0;
	}
	if(!isset($_POST['drive_dvd_yn'])){
		$info['drive_dvd_yn'] = 0;
	}
	if(!isset($_POST['pendrive_yn'])){
		$info['pendrive_yn'] = 0;
	}
	if(!isset($_POST['case_yn'])){
		$info['case_yn'] = 0;
	}
	
	//tipo de servico
	if(!isset($_POST['garantia_yn'])){
		$info['garantia_yn'] = 0;
	}
	if(!isset($_POST['contrato_yn'])){
		$info['contrato_yn'] = 0;
	}
	if(!isset($_POST['avulso_yn'])){
		$info['avulso_yn'] = 0;
	}
	if(!isset($_POST['inviavel_yn'])){
		$info['inviavel_yn'] = 0;
	}
	if(!isset($_POST['sem_conserto_yn'])){
		$info['sem_conserto_yn'] = 0;
	}
	if(!isset($_POST['n_aprov_yn'])){
		$info['n_aprov_yn'] = 0;
	}

	//concerto ou orcamento
	
	if(!isset($_POST['conserto_yn'])){
		$info['conserto_yn'] = 0;
	}
	if(!isset($_POST['orcamento_yn'])){
		$info['orcamento_yn'] = 0;
	}
	
	print_r($info);
	
	$ordem_f = ordem_id($pdo,$info['id']);
	$ordem_f = ordem_id($pdo,$info['id']);
	
	if($ordem_f[0]['status_ordem']=='fechada'){
		try{
			$prepara = $pdo->prepare("
			UPDATE tab_ordem SET
			
				forma_pg_ordem = ?
			
			WHERE id_ordem = ?
			");
			
			$prepara->bindParam(1, $info['forma_pg'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['id'], PDO::PARAM_INT );
			
			
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
	}else{
		edita_ordem($pdo,$info);
	}
	
    window.history.back();
	//header('Location: ../ordem_lista.php');
	
?>