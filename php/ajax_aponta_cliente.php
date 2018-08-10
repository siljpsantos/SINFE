<?php

	include "conection.php";
	include "querys.php";	
	
	$estados = estados($pdo_estados);
	//$cliente = cliente_view_1_id($pdo,$_GET['id']);
	
	$info = $_GET;
	
	$mun = explode("|",$_GET['mun']);
	
	@$info['mun'] = $mun[1];
	@$info['cod_mun'] = $mun[0];
		
	//caso o cliente não seja da base, seja AVULSO
	if($_GET['avulso']=='sim'){
        
        $cliente = $pdo->query("SELECT * FROM tab_cliente WHERE cpf_cnpj_cliente = '" . $info['cpf_cnpj'] . "'");
        $cliente = $cliente->fetchAll();
        
		if($cliente == array()){
            try{
                $prepara = $pdo->prepare("
                INSERT INTO tab_cliente
                (	

                    data_cadastro_cliente,
                    nome_razao_social_cliente, 
                    cpf_cnpj_cliente, 
                    inscricao_estadual_cliente, 
                    isento_icms_cliente, 
                    inscricao_suframa_cliente, 
                    email_cliente,
                    logradouro_cliente, 
                    numero_cliente, 
                    complemento_cliente, 
                    bairro_cliente, 
                    cep_cliente, 
                    pais_cliente, 
                    uf_cliente, 
                    municipio_cliente,
                    cod_municipio_cliente,  
                    telefone_cliente

                ) 
                VALUES 
                (
                    NOW(),?,?,?,?,?,?,?,?,?,?,?,'1058',?,?,?,?
                )

                ");

                $prepara->bindParam(1, $info['nome'], PDO::PARAM_INT );
                $prepara->bindParam(2, $info['cpf_cnpj'], PDO::PARAM_INT );
                $prepara->bindParam(3, $info['ie'], PDO::PARAM_INT );
                $prepara->bindParam(4, $info['icms'], PDO::PARAM_INT );
                $prepara->bindParam(5, $info['suframa'], PDO::PARAM_INT );
                $prepara->bindParam(6, $info['email'], PDO::PARAM_INT );
                $prepara->bindParam(7, $info['logr'], PDO::PARAM_INT );
                $prepara->bindParam(8, $info['num'], PDO::PARAM_INT );
                $prepara->bindParam(9, $info['compl'], PDO::PARAM_INT );
                $prepara->bindParam(10, $info['bairro'], PDO::PARAM_INT );
                $prepara->bindParam(11, $info['cep'], PDO::PARAM_INT );
                $prepara->bindParam(12, $info['uf'], PDO::PARAM_INT );
                $prepara->bindParam(13, $info['mun'], PDO::PARAM_INT );
                $prepara->bindParam(14, $info['cod_mun'], PDO::PARAM_INT );
                $prepara->bindParam(15, $info['tel'], PDO::PARAM_INT );


                $prepara->execute();

            }catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }

            $select = $pdo->query("SELECT * FROM tab_cliente ORDER BY id_cliente DESC LIMIT 1");
            $select = $select->fetchAll();

            $info_1['nfe'] = $_GET['id'];
            $info_1['cliente'] = $select[0]['id_cliente'];

            aponta_cliente($pdo,$info_1);
            
            echo "<script>alert('Cliente atrelado com Sucesso!');</script>";
            die();
            
        }else{
            
            //caso o cliente seja da base
            $info_1['nfe'] = $_GET['id'];
            $info_1['cliente'] = $cliente[0]['id_cliente'];

            aponta_cliente($pdo,$info_1);
            
            echo "<script>alert('Cliente já na base, nome cadastrado previamente será utilizado!');</script>";
            die();
            
        }
		
	}else{
		
		//caso o cliente seja da base
		$info_1['nfe'] = $_GET['id'];
		$info_1['cliente'] = $_GET['cliente'];
		
		aponta_cliente($pdo,$info_1);
        
        echo "<script>alert('Cliente atrelado com Sucesso!');</script>";
        die();
	}
	
?>