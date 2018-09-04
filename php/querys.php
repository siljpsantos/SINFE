<?php
    
    //registra log de erro
    function error_log_s($msg){
        
        $file  = fopen('../log/error.txt', 'a');
        $data  = "\n\n ------------------------" . date('d/m/Y H:i:s') . "------------------------ \n\n";
        $data .= $msg;
        
        fwrite($file, $data);
        fclose($file);
        
    }
    
    //limpa string numerica
    function limpa($string){
        return $resp = preg_replace('/[^0-9]/', '', $string);
    }

	//checa login
	function login($pdo,$login,$senha){
		
		$select_tmp = $pdo->query("SELECT * FROM tab_adm WHERE login_adm = '".$login."' AND senha_adm = '".$senha."' ");
		$select = $select_tmp->fetchAll();
		
		if(!empty($select)){
			return 1;
		}else{
			return 0;
		}
		
	}
	
	//cadastra usuário
	function add_user($pdo,$info){
		
		try{
			$select = $pdo->prepare("
			INSERT INTO tab_adm (
				nome_adm,
				login_adm,
				senha_adm
			)
			VALUES
			(
				?,?,?
			)
			");
		
			$select->bindParam(1, $info['nome'], PDO::PARAM_INT );
			$select->bindParam(2, $info['login'], PDO::PARAM_INT );
			$select->bindParam(3, $info['senha'], PDO::PARAM_INT );
			
			$select->execute();
		
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
    

	//cadastra clientes
	function add_cliente($pdo,$info){
		
		if (!isset($info['isencao_icms'])){
			$icms = "nao";
		}else{
			$icms = $info['isencao_icms'];
		}
		
		try{
			$prepara = $pdo->prepare("
			INSERT INTO tab_cliente
			(	
				status_cliente,
				data_cadastro_cliente,
				nome_razao_social_cliente, 
				cpf_cnpj_cliente, 
				inscricao_estadual_cliente, 
				isento_icms_cliente, 
				inscricao_suframa_cliente, 
				email_cliente, 
				banco_cliente, 
				agencia_cliente, 
				conta_cliente, 
				logradouro_cliente, 
				numero_cliente, 
				complemento_cliente, 
				bairro_cliente, 
				cep_cliente, 
				pais_cliente, 
				uf_cliente, 
				municipio_cliente,
				cod_municipio_cliente,  
				telefone_cliente, 
				nome_contato_cliente, 
				telefone_contato_cliente, 
				email_contato_cliente
			) 
			VALUES 
			(
				?,NOW(),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
			)
			
			");
			
			$prepara->bindParam(1, $info['status'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['nome/razao_social'], PDO::PARAM_INT );
			$prepara->bindParam(3, $info['cpf/cnpj'], PDO::PARAM_INT );
			$prepara->bindParam(4, $info['inscricao_estadual'], PDO::PARAM_INT );
			$prepara->bindParam(5, $icms, PDO::PARAM_INT );
			$prepara->bindParam(6, $info['suframa'], PDO::PARAM_INT );
			$prepara->bindParam(7, $info['email'], PDO::PARAM_INT );
			$prepara->bindParam(8, $info['banco'], PDO::PARAM_INT );
			$prepara->bindParam(9, $info['agencia'], PDO::PARAM_INT );
			$prepara->bindParam(10, $info['conta'], PDO::PARAM_INT );
			$prepara->bindParam(11, $info['logradouro'], PDO::PARAM_INT );
			$prepara->bindParam(12, $info['numero'], PDO::PARAM_INT );
			$prepara->bindParam(13, $info['complemento'], PDO::PARAM_INT );
			$prepara->bindParam(14, $info['bairro'], PDO::PARAM_INT );
			$prepara->bindParam(15, $info['cep'], PDO::PARAM_INT );
			$prepara->bindParam(16, $info['pais'], PDO::PARAM_INT );
			$prepara->bindParam(17, $info['uf'], PDO::PARAM_INT );
			$prepara->bindParam(18, $info['municipio'], PDO::PARAM_INT );
			$prepara->bindParam(19, $info['cod_municipio'], PDO::PARAM_INT );
			$prepara->bindParam(20, $info['telefone'], PDO::PARAM_INT );
			$prepara->bindParam(21, $info['nome_contato'], PDO::PARAM_INT );
			$prepara->bindParam(22, $info['telefone_contato'], PDO::PARAM_INT );
			$prepara->bindParam(23, $info['email_contato'], PDO::PARAM_INT );
			
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
			
	}

	//edita clientes
	function edita_cliente($pdo,$info){
		
		if (!isset($info['isencao_icms'])){
			$icms = "nao";
		}else{
			$icms = $info['isencao_icms'];
		}
		
		try{
			$prepara = $pdo->prepare("
			UPDATE tab_cliente SET
				
				status_cliente = ?,
				nome_razao_social_cliente = ?,
				cpf_cnpj_cliente = ?, 
				inscricao_estadual_cliente = ?, 
				isento_icms_cliente = ?, 
				inscricao_suframa_cliente = ?, 
				email_cliente = ?, 
				banco_cliente = ?, 
				agencia_cliente = ?, 
				conta_cliente = ?, 
				logradouro_cliente = ?, 
				numero_cliente = ?, 
				complemento_cliente = ?, 
				bairro_cliente = ?, 
				cep_cliente = ?, 
				pais_cliente = ?, 
				uf_cliente = ?, 
				municipio_cliente = ?,
				cod_municipio_cliente = ?,  
				telefone_cliente = ?, 
				nome_contato_cliente = ?, 
				telefone_contato_cliente = ?, 
				email_contato_cliente = ?
			
			WHERE id_cliente = ?
			
			");
			
			$prepara->bindParam(1, $info['status'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['nome/razao_social'], PDO::PARAM_INT );
			$prepara->bindParam(3, $info['cpf/cnpj'], PDO::PARAM_INT );
			$prepara->bindParam(4, $info['inscricao_estadual'], PDO::PARAM_INT );
			$prepara->bindParam(5, $icms, PDO::PARAM_INT );
			$prepara->bindParam(6, $info['suframa'], PDO::PARAM_INT );
			$prepara->bindParam(7, $info['email'], PDO::PARAM_INT );
			$prepara->bindParam(8, $info['banco'], PDO::PARAM_INT );
			$prepara->bindParam(9, $info['agencia'], PDO::PARAM_INT );
			$prepara->bindParam(10, $info['conta'], PDO::PARAM_INT );
			$prepara->bindParam(11, $info['logradouro'], PDO::PARAM_INT );
			$prepara->bindParam(12, $info['numero'], PDO::PARAM_INT );
			$prepara->bindParam(13, $info['complemento'], PDO::PARAM_INT );
			$prepara->bindParam(14, $info['bairro'], PDO::PARAM_INT );
			$prepara->bindParam(15, $info['cep'], PDO::PARAM_INT );
			$prepara->bindParam(16, $info['pais'], PDO::PARAM_INT );
			$prepara->bindParam(17, $info['uf'], PDO::PARAM_INT );
			$prepara->bindParam(18, $info['municipio'], PDO::PARAM_INT );
			$prepara->bindParam(19, $info['cod_municipio'], PDO::PARAM_INT );
			$prepara->bindParam(20, $info['telefone'], PDO::PARAM_INT );
			$prepara->bindParam(21, $info['nome_contato'], PDO::PARAM_INT );
			$prepara->bindParam(22, $info['telefone_contato'], PDO::PARAM_INT );
			$prepara->bindParam(23, $info['email_contato'], PDO::PARAM_INT );
			$prepara->bindParam(24, $info['id'], PDO::PARAM_INT );
			
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
			
	}

	//edita emitente
	function edita_emitente($pdo,$info){
		
		try{
			$prepara = $pdo->prepare("
			UPDATE tab_emitente SET
			
				nome_razao_social_emitente= ?, 
				nome_fantasia_emitente= ?,
				cnpj_emitente= ?, 
				inscricao_estadual_emitente= ?, 
				cnae_fiscal_emitente= ?, 
				inscricao_municipal_emitente= ?, 
				inscricao_estadual_trib_emitente= ?, 
				regime_tributario_emitente= ?, 
				logradouro_emitente= ?, 
				numero_emitente= ?, 
				complemento_emitente= ?, 
				bairro_emitente= ?, 
				cep_emitente= ?, 
				pais_emitente= ?, 
				cod_pais_emitente= ?, 
				uf_emitente= ?, 
				municipio_emitente= ?, 
				cod_municipio_emitente= ?, 
				telefone_emitente= ?, 
				base_pis_emitente= ?, 
				base_cofins_emitente = ?,
				ambiente_nfe_emitente = ?,
				padrao_emis_emitente = ?
			
			
			
			");
			
			$pais = "Brasil";
			
			$prepara->bindParam(1, $info['nome/razao_social'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['nome_fantasia'], PDO::PARAM_INT );
			$prepara->bindParam(3, $info['cnpj'], PDO::PARAM_INT );
			$prepara->bindParam(4, $info['inscricao_estadual'], PDO::PARAM_INT );
			$prepara->bindParam(5, $info['cnae_fiscal'], PDO::PARAM_INT );
			$prepara->bindParam(6, $info['inscricao_municipal'], PDO::PARAM_INT );
			$prepara->bindParam(7, $info['inscricao_estadual_trib'], PDO::PARAM_INT );
			$prepara->bindParam(8, $info['regime_tributario'], PDO::PARAM_INT );
			$prepara->bindParam(9, $info['logradouro'], PDO::PARAM_INT );
			$prepara->bindParam(10, $info['numero'], PDO::PARAM_INT );
			$prepara->bindParam(11, $info['complemento'], PDO::PARAM_INT );
			$prepara->bindParam(12, $info['bairro'], PDO::PARAM_INT );
			$prepara->bindParam(13, $info['cep'], PDO::PARAM_INT );
			$prepara->bindParam(14, $pais, PDO::PARAM_INT );
			$prepara->bindParam(15, $info['pais'], PDO::PARAM_INT );
			$prepara->bindParam(16, $info['uf'], PDO::PARAM_INT );
			$prepara->bindParam(17, $info['municipio'], PDO::PARAM_INT );
			$prepara->bindParam(18, $info['cod_municipio'], PDO::PARAM_INT );
			$prepara->bindParam(19, $info['telefone'], PDO::PARAM_INT );
			$prepara->bindParam(20, $info['pis'], PDO::PARAM_INT );
			$prepara->bindParam(21, $info['cofins'], PDO::PARAM_INT );
			$prepara->bindParam(22, $info['ambiente'], PDO::PARAM_INT );
			$prepara->bindParam(23, $info['emis'], PDO::PARAM_INT );
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
			
	}
    
    function edita_n_nota($pdo,$info){
		
		try{
			$prepara = $pdo->prepare("
			UPDATE tab_emitente SET
			
				n_nota_emitente = ?,
				n_nfce_emitente = ?
			
			");
			
			$prepara->bindParam(1, $info['n_nota_nfe'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['n_nota_nfce'], PDO::PARAM_INT );
			
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
    }


	//cadastra produtos
	function add_produto($pdo,$info){
				
		$info['qtd_atual'] = 0;
		
		try{
			$prepara = $pdo->prepare("
			INSERT INTO tab_produto
			(
				qtd_saida_produto,
				descricao_produto, 
				codigo_produto,
				ncm_produto,
				unid_produto, 
				valor_produto,
				classe_ipi_produto, 
				cod_enquadramento_ipi_produto,
                ean_produto
			) 
			VALUES 
			(
				0,?,?,?,?,?,?,?,?
			)
			
			");
			
			$prepara->bindParam(1, $info['descricao'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['codigo'], PDO::PARAM_INT );
			$prepara->bindParam(3, $info['ncm'], PDO::PARAM_INT );
			$prepara->bindParam(4, $info['unid'], PDO::PARAM_INT );
			$prepara->bindParam(5, $info['val'], PDO::PARAM_INT );
			$prepara->bindParam(6, $info['classe_ipi'], PDO::PARAM_INT );
			$prepara->bindParam(7, $info['cod_enquadr_ipi'], PDO::PARAM_INT );
            $prepara->bindParam(8, $info['ean'], PDO::PARAM_INT );
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
			
	}

	//edita produtos
	function edita_produto($pdo,$info){
				
		try{
			$prepara = $pdo->prepare("
			UPDATE tab_produto SET
			
				descricao_produto = ?, 
				codigo_produto = ?, 
				ncm_produto = ?, 
				unid_produto = ?, 
				valor_produto = ?, 
				classe_ipi_produto = ?, 
				cod_enquadramento_ipi_produto = ?,
                ean_produto = ?
			
			WHERE id_produto = ?
			
			");
			
			$prepara->bindParam(1, $info['descricao'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['codigo'], PDO::PARAM_INT );
			$prepara->bindParam(3, $info['ncm'], PDO::PARAM_INT );
			$prepara->bindParam(4, $info['unid'], PDO::PARAM_INT );
			$prepara->bindParam(5, $info['val'], PDO::PARAM_INT );
			$prepara->bindParam(6, $info['classe_ipi'], PDO::PARAM_INT );
			$prepara->bindParam(7, $info['cod_enquadr_ipi'], PDO::PARAM_INT );
            $prepara->bindParam(8, $info['ean'], PDO::PARAM_INT );
			$prepara->bindParam(9, $info['id'], PDO::PARAM_INT );
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
			
	}

	//cadastra Transportadora
	function add_transp($pdo,$info){
		
		try{
			$prepara = $pdo->prepare("
			INSERT INTO tab_transportadora
			(
				nome_razao_social_transportadora, 
				cnpj_transportadora, 
				inscricao_estadual_transportadora, 
				isento_icms_transportadora, 
				logradouro_transportadora, 
				numero_transportadora, 
				complemento_transportadora, 
				bairro_transportadora, 
				cep_transportadora, 
				pais_transportadora, 
				uf_transportadora, 
				municipio_transportadora,
				cod_municipio_transportadora,
				telefone_transportadora
			) 
			VALUES 
			(
				?,?,?,?,?,?,?,?,?,?,?,?,?,?
			)
			
			");
			
			$prepara->bindParam(1, $info['nome/razao_social'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['cpf/cnpj'], PDO::PARAM_INT );
			$prepara->bindParam(3, $info['inscricao_estadual'], PDO::PARAM_INT );
			$prepara->bindParam(4, $info['icms'], PDO::PARAM_INT );
			$prepara->bindParam(5, $info['logradouro'], PDO::PARAM_INT );
			$prepara->bindParam(6, $info['numero'], PDO::PARAM_INT );
			$prepara->bindParam(7, $info['complemento'], PDO::PARAM_INT );
			$prepara->bindParam(8, $info['bairro'], PDO::PARAM_INT );
			$prepara->bindParam(9, $info['cep'], PDO::PARAM_INT );
			$prepara->bindParam(10, $info['pais'], PDO::PARAM_INT );
			$prepara->bindParam(11, $info['uf'], PDO::PARAM_INT );
			$prepara->bindParam(12, $info['municipio'], PDO::PARAM_INT );
			$prepara->bindParam(13, $info['cod_municipio'], PDO::PARAM_INT );
			$prepara->bindParam(14, $info['telefone'], PDO::PARAM_INT );
			
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
			
	}
	
	//edita Transportadora
	function edita_transp($pdo,$info){
		
		if (!isset($info['isencao_icms'])){
			$info['icms'] = "nao";
		}else{
			$info['icms'] = "sim";
		}
		
		try{
			$prepara = $pdo->prepare("
			UPDATE tab_transportadora SET
			
				nome_razao_social_transportadora = ?, 
				cnpj_transportadora = ?, 
				inscricao_estadual_transportadora = ?, 
				isento_icms_transportadora = ?, 
				logradouro_transportadora = ?, 
				numero_transportadora = ?, 
				complemento_transportadora = ?, 
				bairro_transportadora = ?, 
				cep_transportadora = ?, 
				pais_transportadora = ?, 
				uf_transportadora = ?, 
				municipio_transportadora = ?,
				cod_municipio_transportadora = ?,
				telefone_transportadora = ?
			 
			WHERE id_transportadora = ?
			
			");
			
			$prepara->bindParam(1, $info['nome/razao_social'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['cpf/cnpj'], PDO::PARAM_INT );
			$prepara->bindParam(3, $info['inscricao_estadual'], PDO::PARAM_INT );
			$prepara->bindParam(4, $info['icms'], PDO::PARAM_INT );
			$prepara->bindParam(5, $info['logradouro'], PDO::PARAM_INT );
			$prepara->bindParam(6, $info['numero'], PDO::PARAM_INT );
			$prepara->bindParam(7, $info['complemento'], PDO::PARAM_INT );
			$prepara->bindParam(8, $info['bairro'], PDO::PARAM_INT );
			$prepara->bindParam(9, $info['cep'], PDO::PARAM_INT );
			$prepara->bindParam(10, $info['pais'], PDO::PARAM_INT );
			$prepara->bindParam(11, $info['uf'], PDO::PARAM_INT );
			$prepara->bindParam(12, $info['municipio'], PDO::PARAM_INT );
			$prepara->bindParam(13, $info['cod_municipio'], PDO::PARAM_INT );
			$prepara->bindParam(14, $info['telefone'], PDO::PARAM_INT );
			$prepara->bindParam(15, $info['id'], PDO::PARAM_INT );
			
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
			
	}

	//cadastra ordem
	function add_ordem($pdo,$info){
		
		try{
			$prepara = $pdo->prepare("
			INSERT INTO tab_ordem
			(
				status_ordem,
				id_cliente_ordem, 
				aberto_por_ordem, 
				responsavel_ordem, 
				data_hora_abertura_ordem,
				data_hora_fechamento_ordem,				
				equip_ordem, 
				serie_equip_ordem, 
				garantia_yn_ordem, 
				contrato_yn_ordem, 
				avulso_yn_ordem, 
				inviavel_yn_ordem,
				n_aprov_yn_ordem,				
				sem_conserto_yn_ordem, 
				garantia_ate_ordem, 
				val_a_pg_ordem, 
				val_pg_ordem, 
				forma_pg_ordem, 
				conserto_yn_ordem, 
				orcamento_yn_ordem, 
				tecnico_balcao_ordem, 
				cabo_forca_yn_ordem, 
				cabo_video_yn_ordem, 
				bandejas_yn_ordem, 
				base_yn_ordem, 
				toner_yn_ordem, 
				cartucho_preto_yn_ordem, 
				cartucho_color_yn_ordem, 
				fonte_yn_ordem, 
				drive_dvd_yn_ordem, 
				pendrive_yn_ordem, 
				case_yn_ordem, 
				outro_ordem, 
				defeito_rel_ordem, 
				defeito_const_ordem, 
				solucao_ordem, 
				obs_ordem
			) 
			VALUES
			(
				'aberta',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
			)			
			
			
			");
			
			$prepara->bindParam(1, $info['nome_cliente'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['chamado_por'], PDO::PARAM_INT );
			$prepara->bindParam(3, $info['responsavel'], PDO::PARAM_INT );
			$prepara->bindParam(4, $info['data_chamado'], PDO::PARAM_INT );
			$prepara->bindParam(5, $info['data_chamado_f'], PDO::PARAM_INT );
			$prepara->bindParam(6, $info['equip'], PDO::PARAM_INT );
			$prepara->bindParam(7, $info['serie_equip'], PDO::PARAM_INT );
			$prepara->bindParam(8, $info['garantia_yn'], PDO::PARAM_INT );
			$prepara->bindParam(9, $info['contrato_yn'], PDO::PARAM_INT );
			$prepara->bindParam(10, $info['avulso_yn'], PDO::PARAM_INT );
			$prepara->bindParam(11, $info['inviavel_yn'], PDO::PARAM_INT );
			$prepara->bindParam(12, $info['n_aprov_yn'], PDO::PARAM_INT );
			$prepara->bindParam(13, $info['sem_conserto_yn'], PDO::PARAM_INT );
			$prepara->bindParam(14, $info['garantia_ate'], PDO::PARAM_INT );
			$prepara->bindParam(15, $info['val_a_pg'], PDO::PARAM_INT );
			$prepara->bindParam(16, $info['val_pg'], PDO::PARAM_INT );
			$prepara->bindParam(17, $info['forma_pg'], PDO::PARAM_INT );
			$prepara->bindParam(18, $info['conserto_yn'], PDO::PARAM_INT );
			$prepara->bindParam(19, $info['orcamento_yn'], PDO::PARAM_INT );
			$prepara->bindParam(20, $info['responsavel_balcao'], PDO::PARAM_INT );
			$prepara->bindParam(21, $info['cabo_forca_yn'], PDO::PARAM_INT );
			$prepara->bindParam(22, $info['cabo_video_yn'], PDO::PARAM_INT );
			$prepara->bindParam(23, $info['bandejas_yn'], PDO::PARAM_INT );
			$prepara->bindParam(24, $info['base_yn'], PDO::PARAM_INT );
			$prepara->bindParam(25, $info['toner_yn'], PDO::PARAM_INT );
			$prepara->bindParam(26, $info['cartucho_preto_yn'], PDO::PARAM_INT );
			$prepara->bindParam(27, $info['cartucho_color_yn'], PDO::PARAM_INT );
			$prepara->bindParam(28, $info['fonte_yn'], PDO::PARAM_INT );
			$prepara->bindParam(29, $info['drive_dvd_yn'], PDO::PARAM_INT );
			$prepara->bindParam(30, $info['pendrive_yn'], PDO::PARAM_INT );
			$prepara->bindParam(31, $info['case_yn'], PDO::PARAM_INT );
			$prepara->bindParam(32, $info['outro'], PDO::PARAM_INT );
			$prepara->bindParam(33, $info['defeito_rel'], PDO::PARAM_INT );
			$prepara->bindParam(34, $info['defeito_const'], PDO::PARAM_INT );
			$prepara->bindParam(35, $info['solucao'], PDO::PARAM_INT );
			$prepara->bindParam(36, $info['obs'], PDO::PARAM_INT );
			
			
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
			
	}

	//edita ordem
	function edita_ordem($pdo,$info){
		
		try{
			$prepara = $pdo->prepare("
			UPDATE tab_ordem SET
			
				id_cliente_ordem = ?, 
				aberto_por_ordem = ?, 
				responsavel_ordem = ?, 
				data_hora_abertura_ordem = ?,
				data_hora_fechamento_ordem = ?, 				
				equip_ordem = ?, 
				serie_equip_ordem = ?, 
				garantia_yn_ordem = ?, 
				contrato_yn_ordem = ?, 
				avulso_yn_ordem = ?, 
				inviavel_yn_ordem = ?,
				n_aprov_yn_ordem = ?,				
				sem_conserto_yn_ordem = ?, 
				garantia_ate_ordem = ?,
				val_a_pg_ordem = ?,				
				val_pg_ordem = ?, 
				forma_pg_ordem = ?, 
				conserto_yn_ordem = ?, 
				orcamento_yn_ordem = ?, 
				tecnico_balcao_ordem = ?, 
				cabo_forca_yn_ordem = ?, 
				cabo_video_yn_ordem = ?, 
				bandejas_yn_ordem = ?, 
				base_yn_ordem = ?, 
				toner_yn_ordem = ?, 
				cartucho_preto_yn_ordem = ?, 
				cartucho_color_yn_ordem = ?, 
				fonte_yn_ordem = ?, 
				drive_dvd_yn_ordem = ?, 
				pendrive_yn_ordem = ?, 
				case_yn_ordem = ?, 
				outro_ordem = ?, 
				defeito_rel_ordem = ?, 
				defeito_const_ordem = ?, 
				solucao_ordem = ?, 
				obs_ordem = ?
			
			WHERE id_ordem = ?
			");
			
			$prepara->bindParam(1, $info['nome_cliente'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['chamado_por'], PDO::PARAM_INT );
			$prepara->bindParam(3, $info['responsavel'], PDO::PARAM_INT );
			$prepara->bindParam(4, $info['data_chamado'], PDO::PARAM_INT );
			$prepara->bindParam(5, $info['data_chamado_f'], PDO::PARAM_INT );
			$prepara->bindParam(6, $info['equip'], PDO::PARAM_INT );
			$prepara->bindParam(7, $info['serie_equip'], PDO::PARAM_INT );
			$prepara->bindParam(8, $info['garantia_yn'], PDO::PARAM_INT );
			$prepara->bindParam(9, $info['contrato_yn'], PDO::PARAM_INT );
			$prepara->bindParam(10, $info['avulso_yn'], PDO::PARAM_INT );
			$prepara->bindParam(11, $info['inviavel_yn'], PDO::PARAM_INT );
			$prepara->bindParam(12, $info['n_aprov_yn'], PDO::PARAM_INT );
			$prepara->bindParam(13, $info['sem_conserto_yn'], PDO::PARAM_INT );
			$prepara->bindParam(14, $info['garantia_ate'], PDO::PARAM_INT );
			$prepara->bindParam(15, $info['val_a_pg'], PDO::PARAM_INT );
			$prepara->bindParam(16, $info['val_pg'], PDO::PARAM_INT );
			$prepara->bindParam(17, $info['forma_pg'], PDO::PARAM_INT );
			$prepara->bindParam(18, $info['conserto_yn'], PDO::PARAM_INT );
			$prepara->bindParam(19, $info['orcamento_yn'], PDO::PARAM_INT );
			$prepara->bindParam(20, $info['responsavel_balcao'], PDO::PARAM_INT );
			$prepara->bindParam(21, $info['cabo_forca_yn'], PDO::PARAM_INT );
			$prepara->bindParam(22, $info['cabo_video_yn'], PDO::PARAM_INT );
			$prepara->bindParam(23, $info['bandejas_yn'], PDO::PARAM_INT );
			$prepara->bindParam(24, $info['base_yn'], PDO::PARAM_INT );
			$prepara->bindParam(25, $info['toner_yn'], PDO::PARAM_INT );
			$prepara->bindParam(26, $info['cartucho_preto_yn'], PDO::PARAM_INT );
			$prepara->bindParam(27, $info['cartucho_color_yn'], PDO::PARAM_INT );
			$prepara->bindParam(28, $info['fonte_yn'], PDO::PARAM_INT );
			$prepara->bindParam(29, $info['drive_dvd_yn'], PDO::PARAM_INT );
			$prepara->bindParam(30, $info['pendrive_yn'], PDO::PARAM_INT );
			$prepara->bindParam(31, $info['case_yn'], PDO::PARAM_INT );
			$prepara->bindParam(32, $info['outro'], PDO::PARAM_INT );
			$prepara->bindParam(33, $info['defeito_rel'], PDO::PARAM_INT );
			$prepara->bindParam(34, $info['defeito_const'], PDO::PARAM_INT );
			$prepara->bindParam(35, $info['solucao'], PDO::PARAM_INT );
			$prepara->bindParam(36, $info['obs'], PDO::PARAM_INT );
			$prepara->bindParam(37, $info['id'], PDO::PARAM_INT );
			
			
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
			
	}

	//cadastra Venda
	function add_venda($pdo,$info){
		
		$emitente = emitente($pdo);
		
		$numero = $emitente[0]['n_nota_emitente']+4+rand(1000,9999);
		
		$cod = rand(10000000,99999999);
		
		$info['serie'] = (int)(($emitente[0]['n_nota_emitente']+1)/10000)+1;
		
		try{
			$prepara = $pdo->prepare("
			INSERT INTO tab_nfe
			(
				nop_nfe,
				modelo_nfe,
				serie_nfe,
				num_nfe,
				data_emis_nfe,
				data_hora_saida_entrada_nfe,
				cod_numero_nfe,
				status_venda_nfe
			) 
			VALUES 
			(
				?,?,?,?,NOW(),?,?,'aberta'
			)
			
			");
			
			$prepara->bindParam(1, $info['nop'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['modelo'], PDO::PARAM_INT );
			$prepara->bindParam(3, $info['serie'], PDO::PARAM_INT );
			$prepara->bindParam(4, $numero, PDO::PARAM_INT );
			$prepara->bindParam(5, $info['data_hora_saida_entrada'], PDO::PARAM_INT );
			$prepara->bindParam(6, $cod, PDO::PARAM_INT );
			
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
			
	}
	
	//cadastra Venda
	function edita_venda($pdo,$info){
		
		try{
			$prepara = $pdo->prepare("
			UPDATE tab_nfe SET
			
				uf_nfe = ?, 
				cod_numero_nfe = ?, 
				nop_nfe = ?, 
				forma_pagamento = ?, 
				modelo_nfe = ?, 
				serie_nfe = ?, 
				data_emis_nfe = NOW(), 
				data_hora_saida_entrada_nfe = NOW(), 
				tipo_documento_nfe = ?, 
				destino_operacao_nfe = ?, 
				cod_municipio_ocorrencia_nfe = ?, 
				formato_danfe_nfe = ?, 
				forma_emissao_nfe = ?,
				finalidade_emissao_nfe = ?, 
				comprador_final_nfe = ?, 
				presenca_comprador_nfe = ?, 
				procemi_nfe = ?, 
				verproc_nfe = ?,
				num_nfe = ?
				
			WHERE id_nfe = ?
			
			");
			
			$prepara->bindParam(1, $info['uf_1'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['cod_numero'], PDO::PARAM_INT );
			$prepara->bindParam(3, $info['nop'], PDO::PARAM_INT );
			$prepara->bindParam(4, $info['forma_pg'], PDO::PARAM_INT );
			$prepara->bindParam(5, $info['modelo'], PDO::PARAM_INT );
			$prepara->bindParam(6, $info['serie'], PDO::PARAM_INT );
			$prepara->bindParam(7, $info['tipo_documento'], PDO::PARAM_INT );
			$prepara->bindParam(8, $info['destino_operacao'], PDO::PARAM_INT );
			$prepara->bindParam(9, $info['municipio_1'], PDO::PARAM_INT );
			$prepara->bindParam(10, $info['tipo_impressao'], PDO::PARAM_INT );
			$prepara->bindParam(11, $info['tipo_emissao'], PDO::PARAM_INT );
			$prepara->bindParam(12, $info['finalidade_emissao'], PDO::PARAM_INT );
			$prepara->bindParam(13, $info['consumidor_final'], PDO::PARAM_INT );
			$prepara->bindParam(14, $info['presenca_comprador'], PDO::PARAM_INT );
			$prepara->bindParam(15, $info['procemi'], PDO::PARAM_INT );
			$prepara->bindParam(16, $info['versao'], PDO::PARAM_INT );
			$prepara->bindParam(17, $info['numero_nfe'], PDO::PARAM_INT );
			$prepara->bindParam(18, $info['id_nfe'], PDO::PARAM_INT );
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
				
	}

	function fecha_venda($pdo,$id){
		
		try{
			$prepara = $pdo->prepare("
			UPDATE tab_nfe SET
			
				status_venda_nfe = 'fechada'
			
			WHERE id_nfe = ?
			
			");
			
			$prepara->bindParam(1, $id, PDO::PARAM_INT );
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
	
	//adicionar item da venda
	function add_item($pdo,$info){
		
		try{
			$prepara = $pdo->prepare("
			INSERT INTO tab_item_nfe
			(
				id_produto, 
				id_nfe, 
				qtd_item, 
				val_unit, 
				val_total,
				ind_total_item, 
				cfop_item, 
				sit_trib_icms, 
				origem_icms, 
				base_calc_icms, 
				aliq_calc_cred_icms, 
				cred_icms, 
				modbc_icms, 
				p_reducao_bc_icms, 
				vbc_icms, 
				aliq_icms, 
				val_op_icms, 
				modbcst_icms, 
				p_reducao_bcst_icms, 
				p_m_vast_icms, 
				vbcst_icms, 
				aliq_st_icms, 
				val_st_icms, 
				vbc_ret_ant_st_icms, 
				v_ret_ant_st_icms
				
			) 
			VALUES 
			(
				?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
			)
			
			");
			
			$prepara->bindParam(1, $info['id_produto'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['id_nfe'], PDO::PARAM_INT );
			$prepara->bindParam(3, $info['qtd_item'], PDO::PARAM_INT );
			$prepara->bindParam(4, $info['val_unit'], PDO::PARAM_INT );
			$prepara->bindParam(5, $info['val_total'], PDO::PARAM_INT );
			$prepara->bindParam(6, $info['ind_total'], PDO::PARAM_INT );
			$prepara->bindParam(7, $info['cfop'], PDO::PARAM_INT );
			$prepara->bindParam(8, $info['sit_trib'], PDO::PARAM_INT );
			$prepara->bindParam(9, $info['origem'], PDO::PARAM_INT );
			$prepara->bindParam(10, $info['base_calc'], PDO::PARAM_INT );
			$prepara->bindParam(11, $info['aliq_calc_cred'], PDO::PARAM_INT );
			$prepara->bindParam(12, $info['cred'], PDO::PARAM_INT );
			$prepara->bindParam(13, $info['modbc'], PDO::PARAM_INT );
			$prepara->bindParam(14, $info['p_reducao_bc'], PDO::PARAM_INT );
			$prepara->bindParam(15, $info['vbc'], PDO::PARAM_INT );
			$prepara->bindParam(16, $info['aliq'], PDO::PARAM_INT );
			$prepara->bindParam(17, $info['val_op'], PDO::PARAM_INT );
			$prepara->bindParam(18, $info['modbcst'], PDO::PARAM_INT );
			$prepara->bindParam(19, $info['p_reducao_bcst'], PDO::PARAM_INT );
			$prepara->bindParam(20, $info['p_m_vast'], PDO::PARAM_INT );
			$prepara->bindParam(21, $info['vbcst'], PDO::PARAM_INT );
			$prepara->bindParam(22, $info['aliq_st'], PDO::PARAM_INT );
			$prepara->bindParam(23, $info['val_st'], PDO::PARAM_INT );
			$prepara->bindParam(24, $info['vbc_ret_ant_st'], PDO::PARAM_INT );
			$prepara->bindParam(25, $info['v_ret_ant_st'], PDO::PARAM_INT );
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
    
    //adicionar item da venda
	function add_item_nfce($pdo,$info){
        
        //$qtd = 1;
		
		try{
			$prepara = $pdo->prepare("
			INSERT INTO tab_item_nfe
			(
				id_produto, 
				id_nfe, 
				qtd_item, 
				val_unit, 
				val_total,
				ind_total_item, 
				cfop_item, 
				sit_trib_icms, 
				origem_icms, 
				base_calc_icms, 
				aliq_calc_cred_icms, 
				cred_icms, 
				modbc_icms, 
				p_reducao_bc_icms, 
				vbc_icms, 
				aliq_icms, 
				val_op_icms, 
				modbcst_icms, 
				p_reducao_bcst_icms, 
				p_m_vast_icms, 
				vbcst_icms, 
				aliq_st_icms, 
				val_st_icms, 
				vbc_ret_ant_st_icms, 
				v_ret_ant_st_icms
				
			) 
			VALUES 
			(
				?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
			)
			
			");
			
			$prepara->bindParam(1, $info['id_produto'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['id_nfe'], PDO::PARAM_INT );
			$prepara->bindParam(3, $info['qtd_item'], PDO::PARAM_INT );
			$prepara->bindParam(4, $info['val_unit'], PDO::PARAM_INT );
			$prepara->bindParam(5, $info['val_total'], PDO::PARAM_INT );
			$prepara->bindParam(6, $info['ind_total'], PDO::PARAM_INT );
			$prepara->bindParam(7, $info['cfop'], PDO::PARAM_INT );
			$prepara->bindParam(8, $info['sit_trib'], PDO::PARAM_INT );
			$prepara->bindParam(9, $info['origem'], PDO::PARAM_INT );
			$prepara->bindParam(10, $info['base_calc'], PDO::PARAM_INT );
			$prepara->bindParam(11, $info['aliq_calc_cred'], PDO::PARAM_INT );
			$prepara->bindParam(12, $info['cred'], PDO::PARAM_INT );
			$prepara->bindParam(13, $info['modbc'], PDO::PARAM_INT );
			$prepara->bindParam(14, $info['p_reducao_bc'], PDO::PARAM_INT );
			$prepara->bindParam(15, $info['vbc'], PDO::PARAM_INT );
			$prepara->bindParam(16, $info['aliq'], PDO::PARAM_INT );
			$prepara->bindParam(17, $info['val_op'], PDO::PARAM_INT );
			$prepara->bindParam(18, $info['modbcst'], PDO::PARAM_INT );
			$prepara->bindParam(19, $info['p_reducao_bcst'], PDO::PARAM_INT );
			$prepara->bindParam(20, $info['p_m_vast'], PDO::PARAM_INT );
			$prepara->bindParam(21, $info['vbcst'], PDO::PARAM_INT );
			$prepara->bindParam(22, $info['aliq_st'], PDO::PARAM_INT );
			$prepara->bindParam(23, $info['val_st'], PDO::PARAM_INT );
			$prepara->bindParam(24, $info['vbc_ret_ant_st'], PDO::PARAM_INT );
			$prepara->bindParam(25, $info['v_ret_ant_st'], PDO::PARAM_INT );
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
	
	//altera quantidade do item da venda
	function edita_qtd_item($pdo,$info){
		
		try{
			$prepara = $pdo->prepare("
			UPDATE tab_item_nfe SET
			
				qtd_item = ?,
				val_total = ?
			
			WHERE id_item = ".$info['id']."
			
			");
			
			$prepara->bindParam(1, $info['nova_qtd'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['val_total'], PDO::PARAM_INT );
			
			
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
	
	//remove item da venda
	function remove_item($pdo,$id){
		
		$remove = $pdo->query("
		DELETE FROM tab_item_nfe
		WHERE id_item = ".$id."
		
		");
		
	}
	
	//atrela cliente a venda
	function aponta_cliente($pdo,$info){
		
		$insert = $pdo->prepare("
		UPDATE tab_nfe SET
			
			id_cliente = ?
		
		WHERE id_nfe = ?
		
		");
		
		$insert->bindParam(1, $info['cliente'], PDO::PARAM_INT );
		$insert->bindParam(2, $info['nfe'], PDO::PARAM_INT );
		
		$insert->execute();
		
	}
	
	//atrela transportadora a venda
	function aponta_transp($pdo,$info){
		
		$insert = $pdo->prepare("
		UPDATE tab_nfe SET
			
			id_transp_nfe = ?,
			mod_frete = ?, 
			tipo_doc_transp_nfe = ?, 
			cod_antt_nfe = ?, 
			placa_veic_nfe = ?, 
			uf_veic_nfe = ?, 
			qtd_vol_nfe = ?,
			especie_vol_nfe = ?,
			marca_vol_nfe = ?, 
			num_vol_nfe = ?,
			peso_bruto_nfe = ?,
			peso_liq_nfe = ?,
			val_transp_nfe = ?
		
		WHERE id_nfe = ?
		
		");
		
		$insert->bindParam(1, $info['id_transp'], PDO::PARAM_INT );
		$insert->bindParam(2, $info['mod'], PDO::PARAM_INT );
		$insert->bindParam(3, $info['tipo_doc'], PDO::PARAM_INT );
		$insert->bindParam(4, $info['antt'], PDO::PARAM_INT );
		$insert->bindParam(5, $info['placa'], PDO::PARAM_INT );
		$insert->bindParam(6, $info['uf'], PDO::PARAM_INT );
		$insert->bindParam(7, $info['qtd'], PDO::PARAM_INT );
		$insert->bindParam(8, $info['esp'], PDO::PARAM_INT );
		$insert->bindParam(9, $info['marca'], PDO::PARAM_INT );
		$insert->bindParam(10, $info['num'], PDO::PARAM_INT );
		$insert->bindParam(11, $info['pesob'], PDO::PARAM_INT );
		$insert->bindParam(12, $info['pesol'], PDO::PARAM_INT );
		$insert->bindParam(13, $info['val'], PDO::PARAM_INT );
		$insert->bindParam(14, $info['id'], PDO::PARAM_INT );
		
		$insert->execute();
		
	}
	
	//cadastra nota referenciada
	function add_nref($pdo,$info){
		
		try{
			$select = $pdo->prepare("
			INSERT INTO tab_nref
			(
				id_nfe_nref,
				chave_nref
			)
			VALUES
			(
				?,?
			)
			");
			
			$select->bindParam(1, $info['id_nfe'], PDO::PARAM_INT );
			$select->bindParam(2, $info['chave'], PDO::PARAM_INT );
			
			$select->execute();
		
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
	
	function delete_nref($pdo,$id){
		
		$select = $pdo->query("DELETE FROM tab_nref WHERE id_nref = '".$id."' ");
		
	}
	
	//cadastra fatura
	function add_fat($pdo,$info){
		
		try{
			$select = $pdo->prepare("
			INSERT INTO tab_fatura
			(
				id_nfe,
				num_fatura,
				vencimento_fatura,
				val_fatura
			)
			VALUES
			(
				?,?,?,?
			)
			");
			
			$select->bindParam(1, $info['id_nfe'], PDO::PARAM_INT );
			$select->bindParam(2, $info['num_fat_fin'], PDO::PARAM_INT );
			$select->bindParam(3, $info['vencimento'], PDO::PARAM_INT );
			$select->bindParam(4, $info['valor'], PDO::PARAM_INT );
			
			$select->execute();
		
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}

	function delete_fat($pdo,$id){
		
		$select = $pdo->query("DELETE FROM tab_fatura WHERE id_fatura = '".$id."' ");
		
	}
	
	
	//cadastra usuário
	function add_retirada($pdo,$info){
		
		try{
			$select = $pdo->prepare("
			INSERT INTO tab_retirada
			(
				cnpj_retirada,
				cpf_retirada,
				logradouro_retirada,
				numero_retirada,
				complemento_retirada,
				bairro_retirada,
				cod_mun_retirada,
				mun_retirada,
				uf_retirada
			)
			VALUES
			(
				?,?,?,?,?,?,?,?,?
			)
			");
			
			$select->bindParam(1, $info['cnpj'], PDO::PARAM_INT );
			$select->bindParam(2, $info['cpf'], PDO::PARAM_INT );
			$select->bindParam(3, $info['logr'], PDO::PARAM_INT );
			$select->bindParam(4, $info['num'], PDO::PARAM_INT );
			$select->bindParam(5, $info['compl'], PDO::PARAM_INT );
			$select->bindParam(6, $info['bairro'], PDO::PARAM_INT );
			$select->bindParam(7, $info['cod_mun'], PDO::PARAM_INT );
			$select->bindParam(8, $info['mun'], PDO::PARAM_INT );
			$select->bindParam(9, $info['uf'], PDO::PARAM_INT );
			
			$select->execute();
		
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}

	//cadastra usuário
	function add_entrega($pdo,$info){
		
		try{
			$select = $pdo->prepare("
			INSERT INTO tab_entrega
			(
				cnpj_entrega,
				cpf_entrega,
				logradouro_entrega,
				numero_entrega,
				complemento_entrega,
				bairro_entrega,
				cod_mun_entrega,
				mun_entrega,
				uf_entrega
			)
			VALUES
			(
				?,?,?,?,?,?,?,?,?
			)
			");
			
			$select->bindParam(1, $info['cnpj'], PDO::PARAM_INT );
			$select->bindParam(2, $info['cpf'], PDO::PARAM_INT );
			$select->bindParam(3, $info['logr'], PDO::PARAM_INT );
			$select->bindParam(4, $info['num'], PDO::PARAM_INT );
			$select->bindParam(5, $info['compl'], PDO::PARAM_INT );
			$select->bindParam(6, $info['bairro'], PDO::PARAM_INT );
			$select->bindParam(7, $info['cod_mun'], PDO::PARAM_INT );
			$select->bindParam(8, $info['mun'], PDO::PARAM_INT );
			$select->bindParam(9, $info['uf'], PDO::PARAM_INT );
			
			$select->execute();
		
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}

	function add_xml($pdo, $info){
			
		try{
			$select = $pdo->prepare("
				INSERT INTO tab_xml
				(
					id_venda,
					chave_xml,
					finalidade_xml,
					tipo_xml,
					conteudo_xml,
					assinado_xml
				)
				VALUES
				(
					?,?,?,?,?,?
				)
				");
			
			$select->bindParam(1, $info['venda'], PDO::PARAM_INT );
			$select->bindParam(2, $info['chave'], PDO::PARAM_INT );
			$select->bindParam(3, $info['finalidade'], PDO::PARAM_INT );
			$select->bindParam(4, $info['tipo'], PDO::PARAM_INT );
			$select->bindParam(5, $info['xml'], PDO::PARAM_INT );
			$select->bindParam(6, $info['assinado'], PDO::PARAM_INT );
			
			$select->execute();
			
			return "1";
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
	
	function edit_xml($pdo, $info){
			
		try{
			$select = $pdo->prepare("
				UPDATE tab_xml SET
					
					chave_xml = ?,
					conteudo_xml = ?,
					finalidade_xml = ?,
					tipo_xml = ?,
					protocolo_xml = ?,
					transmitido_xml = ?
				
				WHERE chave_xml = ?
				
				");
				
			$select->bindParam(1, $info['chave'], PDO::PARAM_INT );
			$select->bindParam(2, $info['xml'], PDO::PARAM_INT );
			$select->bindParam(3, $info['finalidade'], PDO::PARAM_INT );
			$select->bindParam(4, $info['tipo'], PDO::PARAM_INT );
			$select->bindParam(5, $info['protocolo'], PDO::PARAM_INT );
			$select->bindParam(6, $info['transmitido'], PDO::PARAM_INT );
			$select->bindParam(7, $info['chave'], PDO::PARAM_INT );
			
			$select->execute();
			
			return "1";
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
	
	function assina_xml($pdo, $info){
			
		try{
			$select = $pdo->prepare("
				UPDATE tab_xml SET
				
					conteudo_xml = ?,
					assinado_xml = ?,
					valido_xml = 1
				
				WHERE chave_xml = ?
				
				");
			
			$select->bindParam(1, $info['xml'], PDO::PARAM_INT );
			$select->bindParam(2, $info['assinado'], PDO::PARAM_INT );
			$select->bindParam(3, $info['chave'], PDO::PARAM_INT );
			
			
			$select->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
	
	function valida_xml($pdo, $info){
			
		try{
			$select = $pdo->prepare("
				UPDATE tab_xml SET
				
					valido_xml = ?
				
				WHERE chave_xml = ?
				
				");
			
			$select->bindParam(1, $info['valido'], PDO::PARAM_INT );
			$select->bindParam(2, $info['chave'], PDO::PARAM_INT );
			
			
			$select->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
	
	function xml_chave($pdo,$chave){
		
		$select = $pdo->query("SELECT * FROM tab_xml WHERE chave_xml = '".$chave."' ");
		return $select->fetchAll();
		
	}
	
	function xml_venda($pdo,$venda){
		
		$select = $pdo->query("SELECT * FROM tab_xml WHERE id_venda = '".$venda."' ");
		return $select->fetchAll();
		
	}
	
	function del_xml_venda($pdo,$venda){
		
		$pdo->query("DELETE FROM tab_xml WHERE id_venda = '".$venda."' ");
		
	}
	
	function get_last_retirada($pdo){
		
		$select = $pdo->query("SELECT id_retirada FROM tab_retirada ORDER BY id_retirada DESC LIMIT 1");
		return $select->fetchAll();
		
	}
	
	function get_last_entrega($pdo){
		
		$select = $pdo->query("SELECT id_entrega FROM tab_entrega ORDER BY id_entrega DESC LIMIT 1");
		return $select->fetchAll();
		
	}
	
	function venda_retirada($pdo,$retirada,$venda){
		
		try{
			$select = $pdo->prepare("
			UPDATE tab_nfe SET
			
				id_retirada = ?
			
			WHERE id_nfe = ?
			");
			
			$select->bindParam(1, $retirada, PDO::PARAM_INT );
			$select->bindParam(2, $venda, PDO::PARAM_INT );
			
			$select->execute();
		
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
	
	function venda_entrega($pdo,$entrega,$venda){
		
		try{
			$select = $pdo->prepare("
			UPDATE tab_nfe SET
			
				id_entrega = ?
			
			WHERE id_nfe = ?
			");
			
			$select->bindParam(1, $entrega, PDO::PARAM_INT );
			$select->bindParam(2, $venda, PDO::PARAM_INT );
			
			$select->execute();
		
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
	
	//seleciona os itens da venda
	function itens_venda($pdo,$id_nfe){
		
		$select = $pdo->query("
		SELECT DISTINCT tab_item_nfe.* FROM tab_item_nfe
		
		INNER JOIN tab_produto
		ON tab_item_nfe.id_produto = tab_item_nfe.id_produto
		
		INNER JOIN tab_nfe
		ON tab_item_nfe.id_nfe = tab_nfe.id_nfe
		
		WHERE tab_item_nfe.id_nfe = ".$id_nfe."
		
		");
		
		return $select->fetchAll();
		
		
	}
	
	//seleciona todos os registros do produto pelo id do produto
	function rel_prod($pdo,$id){
			
		$select = $pdo->query("select * from tab_log_estoque WHERE id_produto = ".$id." ORDER BY data_movimento ");	
		return $select->fetchAll();
		
	}
	
	//seleciona todos os registros do produto pelo id do produto
	function rel_op_prod($pdo,$id){
			
		$select = $pdo->query("
		SELECT DISTINCT tab_op.* FROM tab_op
		
		INNER JOIN tab_log_estoque
		ON tab_op.id_op = tab_log_estoque.id_op
		
		WHERE tab_log_estoque.id_produto = ".$id."
		
		");	
		return $select->fetchAll();
		
	}
	
	//todas as vendas abertas (orçamentos)
	function venda_a($pdo){
		
		$select = $pdo->query("SELECT * FROM tab_nfe WHERE status_venda_nfe = 'aberta' ");
		return $select->fetchAll();
		
	}
	
	//todas as vendas fechadas (nfes prontas)
	function venda_f($pdo){
		
		$select = $pdo->query("SELECT * FROM tab_nfe WHERE status_venda_nfe = 'fechada' ");
		return $select->fetchAll();
		
	}
	
	//vendas abertas por data (orçamentos) nfe
	function venda_data_nfe($pdo,$data){
		
		//$data = explode("/",$data);
		//$data = $data[2]."-".$data[1]."-".$data[0];
		
		$select = $pdo->query("SELECT * FROM tab_nfe WHERE data_emis_nfe LIKE '%".$data."%' AND modelo_nfe = '55' ");
		return $select->fetchAll();
		
	}
	
	//vendas abertas por data (orçamentos) nfce
	function venda_data_nfce($pdo,$data){
		
		//$data = explode("/",$data);
		//$data = $data[2]."-".$data[1]."-".$data[0];
		
		$select = $pdo->query("SELECT * FROM tab_nfe WHERE data_emis_nfe LIKE '%".$data."%' AND modelo_nfe = '65' ");
		return $select->fetchAll();
		
	}
	
	//vendas abertas por data (orçamentos)
	function venda_a_data($pdo,$data){
		
		$data = explode("/",$data);
		$data = $data[2]."-".$data[1]."-".$data[0];
		
		$select = $pdo->query("SELECT * FROM tab_nfe WHERE status_venda_nfe = 'aberta' AND data_emis_nfe LIKE '%".$data."%' ");
		return $select->fetchAll();
		
	}
	
	//vendas fechadas por data (nfes prontas)
	function venda_f_data($pdo,$data){
				
		$data = explode("/",$data);
		$data = $data[2]."-".$data[1]."-".$data[0];
		
		
		$select = $pdo->query("SELECT * FROM tab_nfe WHERE status_venda_nfe = 'fechada' AND data_emis_nfe LIKE '%".$data."%' ");
		return $select->fetchAll();
		
	}
	
	//relatorio mensal de vendas nfe
	function venda_mensal_nfe($pdo,$mes){

		$data = explode("/",$mes);
		
		try{
			$select = $pdo->query("
			SELECT 
				* FROM tab_nfe 
			WHERE 
					MONTH(data_emis_nfe) = '".$data[0]."'
				AND
					YEAR(data_emis_nfe) =  '".$data[1]."' 
				AND
					modelo_nfe = '55'
		");
		
		return $select->fetchAll();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
		
	}
	
	//relatorio mensal de vendas nfce
	function venda_mensal_nfce($pdo,$mes){

		$data = explode("/",$mes);
		
		try{
			$select = $pdo->query("
			SELECT 
				* FROM tab_nfe 
			WHERE 
					MONTH(data_emis_nfe) = '".$data[0]."'
				AND
					YEAR(data_emis_nfe) =  '".$data[1]."' 
				AND
					modelo_nfe = '65'
		");
		
		return $select->fetchAll();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
		
	}
	
	//relatorio de vendas do período
	function venda_periodo($pdo,$data1,$data2){
		
		try{
			$select = $pdo->query("
			SELECT 
				* FROM tab_nfe 
			WHERE 
					status_venda_nfe = 'fechada' 
				AND 
					(data_emis_nfe BETWEEN '".$data1."' AND '".$data2."')
		");
		
		return $select->fetchAll();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
		
	}
	
	//relatorio de vendas nfe
	function venda_all_nfe($pdo){
		
		try{
			$select = $pdo->query("SELECT * FROM tab_nfe WHERE modelo_nfe = '55' ORDER BY data_emis_nfe DESC");
		
		return $select->fetchAll();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
		
	}
	
	//relatorio de vendas nfce
	function venda_all_nfce($pdo){
		
		try{
			$select = $pdo->query("SELECT * FROM tab_nfe WHERE modelo_nfe = '65' ORDER BY data_emis_nfe DESC");
		
		return $select->fetchAll();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
		
	}
	
	//todas as ordens
	function nref_venda($pdo,$id){
		
		$select = $pdo->query("SELECT * FROM tab_nref WHERE id_nfe_nref = ".$id." ");
		return $select->fetchAll();
		
	}
	
	//seleciona o emitente
	function emitente($pdo){
		
		$select = $pdo->query("SELECT * FROM tab_emitente LIMIT 1");
		return $select->fetchAll();
		
	}
	
	//todos os clientes
	function cliente($pdo){
		
		$select = $pdo->query("SELECT * FROM tab_cliente");
		return $select->fetchAll();
		
	}
	
	//todos os clientes inativos
	function cliente_inativo($pdo){
		
		$select = $pdo->query("SELECT * FROM tab_cliente WHERE status_cliente = 'nao ativo' ");
		return $select->fetchAll();
		
	}
	
	//todos os produtos
	function produto($pdo){
		
		$select = $pdo->query("SELECT * FROM tab_produto ORDER BY descricao_produto ");
		return $select->fetchAll();
		
	}
	
	//todas as ordens
	function ordem($pdo){
		
		$select = $pdo->query("SELECT * FROM tab_ordem ");
		return $select->fetchAll();
		
	}
	
	//todas as transportadoras
	function transp($pdo){
		
		$select = $pdo->query("SELECT * FROM tab_transportadora ");
		return $select->fetchAll();
		
	}
	
	//todas as ordens abertas
	function ordem_aberta($pdo){
		
		$select = $pdo->query("SELECT * FROM tab_ordem WHERE status_ordem = 'aberta' ORDER BY status_ordem ASC ");
		return $select->fetchAll();
		
	}
	
	//todas as ordens abertas
	function ordem_fechada($pdo){
		
		$select = $pdo->query("SELECT * FROM tab_ordem WHERE status_ordem = 'fechada' ORDER BY status_ordem ASC ");
		return $select->fetchAll();
		
	}
	
	//todas as ordens ordenadas por data
	function ordem_data($pdo){
		
		$data = explode("/",$data);
		$data = $data[2]."-".$data[1]."-".$data[0];
		
		$select = $pdo->query("SELECT * FROM tab_ordem WHERE data_hora_abertura_ordem LIKE '%".$data."%' ");
		return $select->fetchAll();
		
	}
	
	//relatorio mensal de vendas nfe
	function ordem_mensal($pdo,$mes){

		$data = explode("/",$mes);
		
		try{
			$select = $pdo->query("
			SELECT 
				* FROM tab_ordem 
			WHERE 
					MONTH(data_hora_abertura_ordem) = '".$data[0]."'
				AND
					YEAR(data_hora_abertura_ordem) =  '".$data[1]."'
		");
		
		return $select->fetchAll();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
		
	}
	
	//produtos por codigo
	function produto_codigo($pdo,$codigo){
		
		$select = $pdo->query("SELECT * FROM tab_produto WHERE codigo_produto = ".$codigo." ORDER BY descricao_produto ");
		return $select->fetchAll();
		
	}
    
    //produtos por codigo
	function produto_nome($pdo,$nome){
		
		$select = $pdo->query("SELECT * FROM tab_produto WHERE descricao_produto LIKE '%".$nome."%' ORDER BY descricao_produto ");
		return $select->fetchAll();
		
	}
	
	//todas as ordens ordenadas por data
	function ordem_data_n($pdo){
		
		$select = $pdo->query("SELECT * FROM tab_ordem ORDER BY data_hora_abertura_ordem DESC ");
		return $select->fetchAll();
		
	}
	
	//produtos por mais vendidos
	function produto_qtd($pdo){
		
		$select = $pdo->query("SELECT * FROM tab_produto ORDER BY qtd_saida_produto DESC ");
		return $select->fetchAll();
		
	}
	
	//clientes por cpf
	function cliente_cpf($pdo,$cpf){
		
		$select = $pdo->query("SELECT * FROM tab_cliente WHERE cpf_cnpj_cliente = ".$cpf." ");
		return $select->fetchAll();
		
	}
	
	//clientes por nome
	function cliente_nome($pdo,$nome){
		
		$select = $pdo->query("SELECT * FROM tab_cliente WHERE nome_razao_social_cliente LIKE '%".$nome."%' ");
		return $select->fetchAll();
		
	}
	
	//ordens por cpf do cliente
	function ordem_cpf($pdo,$cpf){
		
		$select = $pdo->query("SELECT * FROM tab_ordem WHERE cpf_cnpj_cliente_ordem = ".$cpf." ");
		return $select->fetchAll();
		
	}
	
	//faturas por nfe
	function fat_nfe($pdo,$id){
		
		$select = $pdo->query("SELECT * FROM tab_fatura WHERE id_nfe = ".$id." ");
		return $select->fetchAll();
		
	}
	
	//ordens por cpf do cliente
	function ordem_id($pdo,$id){
		
		$select = $pdo->query("SELECT * FROM tab_ordem WHERE id_ordem = ".$id." ");
		return $select->fetchAll();
		
	}
	
	
	//transportadoras por cnpj
	function transp_cnpj($pdo,$cnpj){
		
		$select = $pdo->query("SELECT * FROM tab_transportadora WHERE cnpj_transportadora = ".$cnpj." ");
		return $select->fetchAll();
		
	}
	
	//transportadoras por id
	function transp_id($pdo,$id){
		
		$select = $pdo->query("SELECT * FROM tab_transportadora WHERE id_transportadora = ".$id." ");
		return $select->fetchAll();
		
	}
	
	// 1 produto por id
	function produto_view_1($pdo,$id){
		
		$select = $pdo->query("SELECT * FROM tab_produto WHERE id_produto = '".$id."'");
		return $select->fetchAll();
		
	}
    
    // 1 produto por codigo
	function produto_view_1_cod($pdo,$cod){
		
		$select = $pdo->query("SELECT * FROM tab_produto WHERE codigo_produto = '".$cod."'");
		return $select->fetchAll();
		
	}
	
	// 1 cliente por cpf
	function cliente_view_1($pdo,$cpf){
		
		$select = $pdo->query("SELECT * FROM tab_cliente WHERE cpf_cnpj_cliente = '".$cpf."'");
		return $select->fetchAll();
		
	}
	
	// i cliente por id
	function cliente_view_1_id($pdo,$id){
		
		$select = $pdo->query("SELECT * FROM tab_cliente WHERE id_cliente = '".$id."'");
		return $select->fetchAll();
		
	}
	
	// 1 ordem por id
	function ordem_view_1($pdo,$id){
		
		$select = $pdo->query("SELECT * FROM tab_ordem WHERE id_ordem = ".$id."");
		return $select->fetchAll();
		
	}
	
	// 1 ordem por id
	function venda_view_1($pdo,$id){
		
		$select = $pdo->query("SELECT * FROM tab_nfe WHERE id_nfe = ".$id." ");
		return $select->fetchAll();
		
	}
	
	// 1 transportadora por id
	function transp_view_1($pdo,$id){
		
		$select = $pdo->query("SELECT * FROM tab_transportadora WHERE id_transportadora = ".$id."");
		return $select->fetchAll();
		
	}
	
	// 1 transportadora por id
	function item_view_1($pdo,$id){
		
		$select = $pdo->query("SELECT * FROM tab_item_nfe WHERE id_item = ".$id."");
		return $select->fetchAll();
		
	}
	
	//pega ultima ordem pra pos process
	function get_last_ordem($pdo){
		
		$select = $pdo->query("SELECT id_ordem FROM tab_ordem ORDER BY id_ordem DESC LIMIT 1");
		return $select->fetchAll();
		
	}
	
	//pega ultima venda pra pos process
	function get_last_venda($pdo){
		
		$select = $pdo->query("SELECT id_nfe FROM tab_nfe ORDER BY id_nfe DESC LIMIT 1");
		return $select->fetchAll();
		
	}
	
	function estados($pdo_estados){
		
		$select = $pdo_estados->query("SELECT * FROM tab_estados ORDER BY uf");
		return $select->fetchAll();
		
	}
	
	function estado_cod($pdo_estados,$cod){
		
		$select = $pdo_estados->query("SELECT * FROM tab_estados WHERE codigo_ibge = ".$cod." ");
		return $select->fetchAll();
		
	}
	
	function cidades($pdo_estados,$uf){
		
		$select = $pdo_estados->query("SELECT * FROM tab_municipios WHERE iduf = '".$uf."' ORDER BY nome");
		return $select->fetchAll();
		
	}
	
	function retirada_view_1($pdo,$id){
		
		$select = $pdo->query("SELECT * FROM tab_retirada WHERE id_retirada = '".$id."' ");
		return $select->fetchAll();
		
	}
	
	
	function entrega_view_1($pdo,$id){
		
		$select = $pdo->query("SELECT * FROM tab_entrega WHERE id_entrega = '".$id."' ");
		return $select->fetchAll();
		
	}
	
	function cfop($pdo){
		
		$select = $pdo->query("SELECT id,descricao FROM tab_cfop");
		return $select->fetchAll();
		
	}
	
	
