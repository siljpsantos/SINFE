<?php

	function registra_entrada($pdo,$info){
		
		//seleciona a quantidade atual do produto a ser adicionado pelo id
		$select = $pdo->query("SELECT qtd_atual_produto FROM tab_produto WHERE id_produto = ".$info['id']." ");
		$select = $select->fetchAll();
		//gera a qtd_saldo para a operação
		$qtd_total = 0;
		$qtd_total = $select[0][0]+$info['qtd_movimentada'];
		
		//zera a variavel $select
		$select = array();
		
		try{
			//registra a operação
			$insert = $pdo->prepare("
			INSERT INTO tab_op
			(
				data_movimento,
				tipo_movimento,
				qtd_movimentada,
				val_unit,
				qtd_saldo
			)
			VALUES
			(
				NOW(),?,?,?,?
			)
			
			");
			
			$insert->bindParam(1, $info['tipo_movimento'], PDO::PARAM_INT );
			$insert->bindParam(2, $info['qtd_movimentada'], PDO::PARAM_INT );
			$insert->bindParam(3, $info['val_unit'], PDO::PARAM_INT );
			$insert->bindParam(4, $qtd_total, PDO::PARAM_INT );
			
			$insert->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
		//zera a variavel $insert
		$insert = array();
		
		//recupera a operação que acabou de ser registrada
		$select = $pdo->query("SELECT * FROM tab_op ORDER BY id_op DESC LIMIT 1");
		$select = $select->fetchAll();
		
		//print_r($select);
		
		
		//----------------------LOG-------------------------------------
		try{
			//registra o log do estoque
			$insert = $pdo->prepare("
			INSERT INTO tab_log_estoque
			(
				id_produto,
				id_op,
				numero_nfe,
				serie_nfe,
				data_movimento,
				tipo_movimento
			)
			VALUES
			(
				?,?,?,?,?,?
			)
			
			");
			
			$insert->bindParam(1, $info['id'], PDO::PARAM_INT );
			$insert->bindParam(2, $select[0]['id_op'], PDO::PARAM_INT );
			$insert->bindParam(3, $info['numero_nfe'], PDO::PARAM_INT );
			$insert->bindParam(4, $info['serie_nfe'], PDO::PARAM_INT );
			$insert->bindParam(5, $select[0]['data_movimento'], PDO::PARAM_INT );
			$insert->bindParam(6, $select[0]['tipo_movimento'], PDO::PARAM_INT );
			
			$insert->execute();
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}

		
		//---------------ATUALIZA QUANTIDADE DO PRODUTO EM ESTOQUE-------
		try{
			//atualiza quantidade do produto
			$update = $pdo->prepare("
			UPDATE tab_produto
			SET
				qtd_atual_produto = ?
			WHERE
				id_produto = ".$info['id']."
			
			");
			
			$update->bindParam(1, $qtd_total, PDO::PARAM_INT );
			
			$update->execute();

		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}

	function registra_saida($pdo,$item,$venda,$total){
		
		//seleciona a quantidade atual do produto a ser removido pelo id
		$select = $pdo->query("SELECT qtd_atual_produto FROM tab_produto WHERE id_produto = ".$item['id_produto']." ");
		$select = $select->fetchAll();
		//gera a qtd_saldo para a operação
		$qtd_total = 0;
		$qtd_total = $select[0][0]-$item['qtd_item'];
		
		//zera a variavel $select
		$select = array();
		
		try{
			//registra a operação
			$insert = $pdo->prepare("
			INSERT INTO tab_op
			(
				data_movimento,
				tipo_movimento,
				qtd_movimentada,
				val_unit,
				qtd_saldo
			)
			VALUES
			(
				NOW(),'saida',?,?,?
			)
			
			");
			$insert->bindParam(1, $item['qtd_item'], PDO::PARAM_INT );
			$insert->bindParam(2, $item['val_unit'], PDO::PARAM_INT );
			$insert->bindParam(3, $qtd_total, PDO::PARAM_INT );
			
			$insert->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
		//zera a variavel $insert
		$insert = array();
		
		//recupera a operação que acabou de ser registrada
		$select = $pdo->query("SELECT * FROM tab_op ORDER BY id_op DESC LIMIT 1");
		$select = $select->fetchAll();
		
		//print_r($select);
		
		
		//----------------------LOG-------------------------------------
		try{
			//registra o log do estoque
			$insert = $pdo->prepare("
			INSERT INTO tab_log_estoque
			(
				id_produto,
				id_op,
				numero_nfe,
				serie_nfe,
				data_movimento,
				tipo_movimento
			)
			VALUES
			(
				?,?,?,?,?,?
			)
			
			");
			
			$insert->bindParam(1, $item['id_produto'], PDO::PARAM_INT );
			$insert->bindParam(2, $select[0]['id_op'], PDO::PARAM_INT );
			$insert->bindParam(3, $venda[0]['id_nfe'], PDO::PARAM_INT );
			$insert->bindParam(4, $venda[0]['serie_nfe'], PDO::PARAM_INT );
			$insert->bindParam(5, $select[0]['data_movimento'], PDO::PARAM_INT );
			$insert->bindParam(6, $select[0]['tipo_movimento'], PDO::PARAM_INT );
			
			$insert->execute();
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}

		
		//---------------ATUALIZA QUANTIDADE DO PRODUTO EM ESTOQUE-------
		try{
			//atualiza quantidade do produto
			$update = $pdo->prepare("
			UPDATE tab_produto
			SET
				qtd_atual_produto = ?,
				qtd_saida_produto = qtd_saida_produto + ?
			WHERE
				id_produto = ".$item['id_produto']."
			
			");
			
			$update->bindParam(1, $qtd_total, PDO::PARAM_INT );
			$update->bindParam(2, $item['qtd_item'], PDO::PARAM_INT );
			
			$update->execute();

		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
		//registra o total da venda na venda
		try{
			$update = $pdo->prepare("
			UPDATE tab_nfe
			SET
				val_total_nfe = ?,
				status_venda_nfe = 'fechada'
			WHERE
				id_nfe = ".$venda[0]['id_nfe']."
			
			");
			
			$update->bindParam(1, $total, PDO::PARAM_INT );
			
			$update->execute();

		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
		
	}

	function registra_orcamento($pdo,$item,$venda,$total){
		
		//seleciona a quantidade atual do produto a ser removido pelo id
		$select = $pdo->query("SELECT qtd_atual_produto FROM tab_produto WHERE id_produto = ".$item['id_produto']." ");
		$select = $select->fetchAll();
		//gera a qtd_saldo para a operação
		$qtd_total = 0;
		$qtd_total = $select[0][0]-$item['qtd_item'];
		
		//zera a variavel $select
		$select = array();
		
		
		
		//zera a variavel $insert
		$insert = array();
		
		//recupera a operação que acabou de ser registrada
		$select = $pdo->query("SELECT * FROM tab_op ORDER BY id_op DESC LIMIT 1");
		$select = $select->fetchAll();
		

		//registra o total da venda na venda
		try{
			$update = $pdo->prepare("
			UPDATE tab_nfe
			SET
				val_total_nfe = ?,
				status_venda_nfe = 'aberta'
			WHERE
				id_nfe = ".$venda[0]['id_nfe']."
			
			");
			
			$update->bindParam(1, $total, PDO::PARAM_INT );
			
			$update->execute();

		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
		
	}


?>
