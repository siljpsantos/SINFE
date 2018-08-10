<?php

require_once '../nfephp/bootstrap.php';

include "conection.php";	
include "querys.php";

use NFePHP\NFe\MakeNFe;
use NFePHP\NFe\ToolsNFe;

$cliente = cliente_view_1_id($pdo,$_GET['cliente']);
$xml_q = xml_venda($pdo,$_GET['id']);

$estados = estados($pdo_estados);

$nref = nref_venda($pdo,$_GET['id']);

$ind_nref = 0;
if($nref!=array()){
	$ind_nref = 1;
}

//----------------nota já transmitida
if(@$xml_q[0]['transmitido_xml'] != 1){
	
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	
	//---------------------------------------------------------------------------------------------------
	
	$venda = venda_view_1($pdo,$_GET['id']);
	$emitente = emitente($pdo);
	
	$fat = fat_nfe($pdo,$_GET['id']);
	
	$transp_venda = transp_id($pdo,$venda[0]['id_transp_nfe']);
	
	$ind_transp = 0;
	if($transp_venda != array()){
		$ind_transp = 1;
	}
	
	$lista_retirada = retirada_view_1($pdo,$venda[0]['id_retirada']);
	$lista_entrega = entrega_view_1($pdo,$venda[0]['id_entrega']);
	
	$produtos = itens_venda($pdo,$_GET['id']);
	
	foreach($produtos as $index=>$key){
		$temp = produto_view_1($pdo,$key['id_produto']);
		$lista_produto[] = $temp[0];
	}
	
	if($venda[0]['id_retirada'] != 0){
		$estado_retirada = estado_cod($pdo_estados,$lista_retirada[0]['uf_retirada']);
	}if($venda[0]['id_entrega'] != 0){
		$estado_entrega = estado_cod($pdo_estados,$lista_entrega[0]['uf_entrega']);
	}
	
	date_default_timezone_set('America/Sao_Paulo');
	$bool = date('I');
	
	if($bool){
		$timestamp = mktime(date("H")-2, date("i"), date("s"), date("m"), date("d"), date("Y"));
		//echo gmdate("Y-m-d\TH:i:s", $timestamp);
	}else{
		$timestamp = mktime(date("H")-3, date("i"), date("s"), date("m"), date("d"), date("Y"));
		//echo gmdate("Y-m-d\TH:i:s", $timestamp);
	}
	
	
	//---------------------------------------------------------------------------------------------------
	
	$nfe = new MakeNFe();
	
	$nfeTools = new ToolsNFe('../nfephp/config/config.json');
	
	//Dados da NFe - infNFe
	$cUF = $venda[0]['uf_nfe']; //codigo numerico do estado
	$cNF = $venda[0]['cod_numero_nfe']; //numero aleatório da NF
	$natOp = $venda[0]['nop_nfe']; //natureza da operação
	$indPag = $venda[0]['forma_pagamento']; //0=Pagamento à vista; 1=Pagamento a prazo; 2=Outros
	$mod = $venda[0]['modelo_nfe']; //modelo da NFe 55 ou 65 essa última NFCe
	//NUMERAÇÃO DIFERENCIADA
	if($mod!='65'){
		$serie = (int)(($emitente[0]['n_nota_emitente']+1)/10000)+1; //serie da NFe
		$nNF = $emitente[0]['n_nota_emitente']+1; // numero da NFe ------ALTERAR
	}else{
		$serie = (int)(($emitente[0]['n_nfce_emitente']+1)/10000)+1; //serie da NFe
		$nNF = $emitente[0]['n_nfce_emitente']+1;
	}
	//HORÁRIO DIFERENCIADO
	if($bool){
		if($mod!='65'){
			$dhEmi = str_replace(" ","T",$venda[0]['data_emis_nfe'])."-02:00";//Formato: “AAAA-MM-DDThh:mm:ssTZD” (UTC)
		}else{
			$dhEmi = gmdate("Y-m-d\TH:i:s-02:00", $timestamp);
		}
	}else{
		if($mod!='65'){
			$dhEmi = str_replace(" ","T",$venda[0]['data_emis_nfe'])."-03:00";//Formato: “AAAA-MM-DDThh:mm:ssTZD” (UTC)
		}else{
			$dhEmi = gmdate("Y-m-d\TH:i:s-03:00", $timestamp);
		}
	}
	
	if($mod!='65'){
		$dhSaiEnt = str_replace(" ","T",$venda[0]['data_hora_saida_entrada_nfe'])."-02:00";//Não informar este campo para a NFC-e.
	}else{
		$dhSaiEnt = '';
	}
	$tpNF = $venda[0]['tipo_documento_nfe'];;
	$idDest = $venda[0]['destino_operacao_nfe']; //1=Operação interna; 2=Operação interestadual; 3=Operação com exterior.
	$cMunFG = $venda[0]['cod_municipio_ocorrencia_nfe'];
	$tpImp = $venda[0]['formato_danfe_nfe'];
				  //0=Sem geração de DANFE; 1=DANFE normal, Retrato; 2=DANFE normal, Paisagem;
	              //3=DANFE Simplificado; 4=DANFE NFC-e; 5=DANFE NFC-e em mensagem eletrônica
	              //(o envio de mensagem eletrônica pode ser feita de forma simultânea com a impressão do DANFE;
	              //usar o tpImp=5 quando esta for a única forma de disponibilização do DANFE).
	$tpEmis = $venda[0]['forma_emissao_nfe']; //1=Emissão normal (não em contingência);
	               //2=Contingência FS-IA, com impressão do DANFE em formulário de segurança;
	               //3=Contingência SCAN (Sistema de Contingência do Ambiente Nacional);
	               //4=Contingência DPEC (Declaração Prévia da Emissão em Contingência);
	               //5=Contingência FS-DA, com impressão do DANFE em formulário de segurança;
	               //6=Contingência SVC-AN (SEFAZ Virtual de Contingência do AN);
	               //7=Contingência SVC-RS (SEFAZ Virtual de Contingência do RS);
	               //9=Contingência off-line da NFC-e (as demais opções de contingência são válidas também para a NFC-e);
	               //Nota: Para a NFC-e somente estão disponíveis e são válidas as opções de contingência 5 e 9.
	$tpAmb = $emitente[0]['ambiente_nfe_emitente']; //1=Produção; 2=Homologação
	$finNFe = $venda[0]['finalidade_emissao_nfe']; //1=NF-e normal; 2=NF-e complementar; 3=NF-e de ajuste; 4=Devolução/Retorno.
	$indFinal = $venda[0]['comprador_final_nfe']; //0=Normal; 1=Consumidor final;
	$indPres = $venda[0]['presenca_comprador_nfe']; 
				   //0=Não se aplica (por exemplo, Nota Fiscal complementar ou de ajuste);
	               //1=Operação presencial;
	               //2=Operação não presencial, pela Internet;
	               //3=Operação não presencial, Teleatendimento;
	               //4=NFC-e em operação com entrega a domicílio;
	               //9=Operação não presencial, outros.
	$procEmi = $venda[0]['procemi_nfe']; //0=Emissão de NF-e com aplicativo do contribuinte;
	                //1=Emissão de NF-e avulsa pelo Fisco;
	                //2=Emissão de NF-e avulsa, pelo contribuinte com seu certificado digital, através do site do Fisco;
	                //3=Emissão NF-e pelo contribuinte com aplicativo fornecido pelo Fisco.
	$verProc = '0.5'; //versão do aplicativo emissor
	
	if($finNFe!=1){
		if($ind_nref){
			foreach($nref as $key){
				$resp = $nfe->tagrefNFe($key['chave_nref']);
			}
		}
	}
	
	$dhCont = ''; //entrada em contingência AAAA-MM-DDThh:mm:ssTZD
	$xJust = ''; //Justificativa da entrada em contingência
	
	//Numero e versão da NFe (infNFe)
	$ano = date('y', strtotime($dhEmi));
	$mes = date('m', strtotime($dhEmi));
	$cnpj = $nfeTools->aConfig['cnpj'];
	$chave = $nfe->montaChave($cUF, $ano, $mes, $cnpj, $mod, $serie, $nNF, $tpEmis, $cNF);
	$versao = '3.10';
	$resp = $nfe->taginfNFe($chave, $versao);
	
	$cDV = substr($chave, -1); //Digito Verificador da Chave de Acesso da NF-e, o DV é calculado com a aplicação do algoritmo módulo 11 (base 2,9) da Chave de Acesso.
	
	//tag IDE
	$resp = $nfe->tagide($cUF, $cNF, $natOp, $indPag, $mod, $serie, $nNF, $dhEmi, $dhSaiEnt, $tpNF, $idDest, $cMunFG, $tpImp, $tpEmis, $cDV, $tpAmb, $finNFe, $indFinal, $indPres, $procEmi, $verProc, $dhCont, $xJust);
	
	//Dados do emitente - (Importando dados do config.json)
	$CNPJ = $nfeTools->aConfig['cnpj'];
	$CPF = ''; // Utilizado para CPF na nota
	$xNome = $nfeTools->aConfig['razaosocial'];
	$xFant = $nfeTools->aConfig['nomefantasia'];
	$IE = $nfeTools->aConfig['ie'];
	$IEST = $nfeTools->aConfig['iest'];
	$IM = $nfeTools->aConfig['im'];
	$CNAE = $nfeTools->aConfig['cnae'];
	$CRT = $nfeTools->aConfig['regime'];
	$resp = $nfe->tagemit($CNPJ, $CPF, $xNome, $xFant, $IE, $IEST, $IM, $CNAE, $CRT);
	
	//endereço do emitente
	$xLgr = $emitente[0]['logradouro_emitente'];
	$nro = $emitente[0]['numero_emitente'];
	$xCpl = $emitente[0]['complemento_emitente'];
	$xBairro = $emitente[0]['bairro_emitente'];
	$cMun = $emitente[0]['cod_municipio_emitente'];
	$xMun = $emitente[0]['municipio_emitente'];;
	$UF = $emitente[0]['uf_emitente'];;
	$CEP = $emitente[0]['cep_emitente'];;
	$cPais = '1058';
	$xPais = 'Brasil';
	$fone = $emitente[0]['telefone_emitente'];;
	$resp = $nfe->tagenderEmit($xLgr, $nro, $xCpl, $xBairro, $cMun, $xMun, $UF, $CEP, $cPais, $xPais, $fone);
	
	if($mod!='65'){
		//destinatário
		if($_GET['tipo'] == 2){
			$CNPJ = $cliente[0]['cpf_cnpj_cliente'];
			$CPF = '';
		}else if($_GET['tipo'] == 1){
			$CPF = $cliente[0]['cpf_cnpj_cliente'];
			$CNPJ = '';
		}
		$idEstrangeiro = $cliente[0]['estrangeiro_cliente'];
		$xNome = $cliente[0]['nome_razao_social_cliente'];
		
		//if($cliente[0]['nome_razao_social_cliente'] == "sim"){
			$indIEDest = '1';
			$IE = $cliente[0]['inscricao_estadual_cliente'];
		//}else{
		//	$indIEDest = '2';
		//	$IE = '';
		//}
		$ISUF =  ''; //$cliente[0]['inscricao_suframa_cliente'];
		$IM = '';
		$email = $cliente[0]['email_cliente'];
		$resp = $nfe->tagdest($CNPJ, $CPF, $idEstrangeiro, $xNome, $indIEDest, $IE, $ISUF, $IM, $email);
		
		//Endereço do destinatário
		$xLgr = $cliente[0]['logradouro_cliente'];
		$nro = $cliente[0]['numero_cliente'];
		$xCpl = $cliente[0]['complemento_cliente'];
		$xBairro = $cliente[0]['bairro_cliente'];
		$cMun = $cliente[0]['cod_municipio_cliente'];
		$xMun = $cliente[0]['municipio_cliente'];
		foreach($estados as $index=>$name){
			if($cliente[0]['uf_cliente'] == $name['codigo_ibge']){
				$UF = $name['uf'];
			}
		}
		$CEP = $cliente[0]['cep_cliente'];
		$cPais = '1058';
		$xPais = 'Brasil';
		$fone = $cliente[0]['telefone_cliente'];
		$resp = $nfe->tagenderDest($xLgr, $nro, $xCpl, $xBairro, $cMun, $xMun, $UF, $CEP, $cPais, $xPais, $fone);
		
	}

	if($venda[0]['id_retirada'] != 0){
		//Identificação do local de Retirada (se diferente do emitente)
		$CNPJ = $lista_retirada[0]['cnpj_retirada'];
		$CPF = $lista_retirada[0]['cpf_retirada'];
		$xLgr = $lista_retirada[0]['logradouro_retirada'];
		$nro = $lista_retirada[0]['numero_retirada'];
		$xCpl = $lista_retirada[0]['complemento_retirada'];
		$xBairro = $lista_retirada[0]['bairro_retirada'];
		$cMun = $lista_retirada[0]['cod_mun_retirada'];
		$xMun = $lista_retirada[0]['mun_retirada'];
		$UF = $estado_retirada[0]['uf'];
		$resp = $nfe->tagretirada($CNPJ, $CPF, $xLgr, $nro, $xCpl, $xBairro, $cMun, $xMun, $UF);
	}
	if($venda[0]['id_entrega'] != 0){
		//Identificação do local de Entrega (se diferente do destinatário)
		$CNPJ = $lista_entrega[0]['cnpj_entrega'];
		$CPF = $lista_entrega[0]['cpf_entrega'];
		$xLgr = $lista_entrega[0]['logradouro_entrega'];
		$nro = $lista_entrega[0]['numero_entrega'];
		$xCpl = $lista_entrega[0]['complemento_entrega'];
		$xBairro = $lista_entrega[0]['bairro_entrega'];
		$cMun = $lista_entrega[0]['cod_mun_entrega'];
		$xMun = $lista_entrega[0]['mun_entrega'];
		$UF = $estado_entrega[0]['uf'];
		$resp = $nfe->tagentrega($CNPJ, $CPF, $xLgr, $nro, $xCpl, $xBairro, $cMun, $xMun, $UF);
	}
	
	//Identificação dos autorizados para fazer o download da NFe (somente versão 3.1)
	/*$aAut = array('23401454000170');
	foreach ($aAut as $aut) {
	    if (strlen($aut) == 14) {
	        $resp = $nfe->tagautXML($aut);
	    } else {
	        $resp = $nfe->tagautXML('', $aut);
	    }
	}*/
	
	$tot_prod = 0;
	//produtos
	$pont = 0;
	foreach($lista_produto as $pont=>$row){
		$aP[] = array(
	        'nItem' => $pont+1,
	        'cProd' => $row['codigo_produto'],
	        'cEAN' => "",
	        'xProd' => $row['descricao_produto'],
	        'NCM' => $row['ncm_produto'],
	        'EXTIPI' => "",
	        'CFOP' => $produtos[$pont]['cfop_item'],
	        'uCom' => $row['unid_produto'],
	        'qCom' => $produtos[$pont]['qtd_item'],
	        'vUnCom' => $row['valor_produto'],
	        'vProd' => number_format($row['valor_produto']*$produtos[$pont]['qtd_item'],2, '.', ''),
	        'cEANTrib' => '',
	        'uTrib' => $row['unid_produto'],
	        'qTrib' => $produtos[$pont]['qtd_item'],
	        'vUnTrib' => $row['valor_produto'],
	        'vFrete' => '',
	        'vSeg' => '',
	        'vDesc' => '',
	        'vOutro' => '',
	        'indTot' => '1',
	        'xPed' => '16',
	        'nItemPed' => $pont,
	        'nFCI' => '');
			$tot_prod += $row['valor_produto']*$produtos[$pont]['qtd_item'];
	}
	 
	foreach ($aP as $prod) {
	    $nItem = $prod['nItem'];
	    $cProd = $prod['cProd'];
	    $cEAN = $prod['cEAN'];
	    $xProd = $prod['xProd'];
		
	    $NCM = $prod['NCM'];
	    $EXTIPI = $prod['EXTIPI'];
	    $CFOP = $prod['CFOP'];
		$CEST = '0100200';
	    $uCom = $prod['uCom'];
	    $qCom = $prod['qCom'];
	    $vUnCom = $prod['vUnCom'];
	    $vProd = number_format($prod['vProd'],2, '.', '');
	    $cEANTrib = $prod['cEANTrib'];
	    $uTrib = $prod['uTrib'];
	    $qTrib = $prod['qTrib'];
	    $vUnTrib = $prod['vUnTrib'];
	    $vFrete = $prod['vFrete'];
	    $vSeg = $prod['vSeg'];
	    $vDesc = $prod['vDesc'];
	    $vOutro = $prod['vOutro'];
	    $indTot = $prod['indTot'];
	    $xPed = $prod['xPed'];
	    $nItemPed = $prod['nItemPed'];
	    $nFCI = $prod['nFCI'];
	    $resp = $nfe->tagprod($nItem, $cProd, $cEAN, $xProd, $NCM, $EXTIPI, $CFOP, $uCom, $qCom, $vUnCom, $vProd, $cEANTrib, $uTrib, $qTrib, $vUnTrib, $vFrete, $vSeg, $vDesc, $vOutro, $indTot, $xPed, $nItemPed, $nFCI);
		$resp = $nfe->tagcest($nItem,$CEST);
	}
	
	//Informaçõe adicionais do produto
	$pont = 0;
	foreach($lista_produto as $pont=>$row){
		$nItem = $pont+1;
		$vDesc = $row['descricao_produto']." - x".$produtos[$pont]['qtd_item']." - Pedido N°".$_GET['id'];
		$resp = $nfe->taginfAdProd($nItem, $vDesc);
	}
	
	$tot_bc_icms = 0;
	$tot_icms = 0;
	$tot_bcst_icms = 0;
	$tot_icmsst = 0;
	
	//Impostos
	$pont = 0;
	foreach($lista_produto as $pont=>$row){
		$nItem = $pont+1;
		$vTotTrib = $produtos[$pont]['val_op_icms']+$produtos[$pont]['val_st_icms'];
		$resp = $nfe->tagimposto($nItem, $vTotTrib);
	}
	
	//ICMS
	foreach($lista_produto as $pont=>$row){
		$nItem = $pont+1;
		$orig = $produtos[$pont]['origem_icms'];
		$csosn = $produtos[$pont]['sit_trib_icms']; // Tributado Integralmente
		$modBC = $produtos[$pont]['modbc_icms'];
		$pRedBC = $produtos[$pont]['p_reducao_bc_icms'];
		$vBC = $produtos[$pont]['vbc_icms']; // = $qTrib * $vUnTrib
		$pICMS = $produtos[$pont]['aliq_icms']; // Alíquota do Estado de GO p/ 'NCM 2203.00.00 - Cervejas de Malte, inclusive Chope'
		$vICMS = $produtos[$pont]['val_op_icms']; // = $vBC * ( $pICMS / 100 )
		$vICMSDeson = '';
		$motDesICMS = '';
		$modBCST = $produtos[$pont]['modbcst_icms'];
		$pMVAST = $produtos[$pont]['p_m_vast_icms'];
		$pRedBCST = $produtos[$pont]['p_reducao_bcst_icms'];
		$vBCST = $produtos[$pont]['vbcst_icms'];
		$pICMSST = $produtos[$pont]['aliq_st_icms'];
		$vICMSST = $produtos[$pont]['val_st_icms'];
		$pDif = '';
		$vICMSDif = '';
		$vICMSOp = '';
		$vBCSTRet = $produtos[$pont]['vbc_ret_ant_st_icms'];
		$vICMSSTRet = $produtos[$pont]['v_ret_ant_st_icms'];
		
		$tot_bc_icms += $vBC;
		$tot_icms += $vICMS;
		$tot_bcst_icms += $vBCST;
		$tot_icmsst += $vICMSST;
		
		//icms sn
		$pCredSN = '2.33';
		$vCredICMSSN = '4.66';
		
		$resp = $nfe->tagICMSSN($nItem, $orig, $csosn, $modBC, $vBC, $pRedBC, $pICMS, $vICMS, $pCredSN, $vCredICMSSN, $modBCST, $pMVAST, $pRedBCST, $vBCST, $pICMSST, $vICMSST, $vBCSTRet, $vICMSSTRet);
		
	}
	
	$vST = $vICMSST; // Total de ICMS ST
	
	if($mod!='65'){
	//IPI - Imposto sobre Produto Industrializado
	$pont = 0;
		foreach($lista_produto as $pont=>$row){
			$nItem = $pont+1;
			$cst = '99'; // 50 - Saída Tributada (Código da Situação Tributária)
			$clEnq = '999';
			$cnpjProd = '';
			$cSelo = '';
			$qSelo = '';
			$cEnq = '999';
			$vBC = '0';
			$pIPI = '0'; //Calculo por alíquota - 6% Alíquota GO.
			$qUnid = '';
			$vUnid = '';
			$vIPI = '0'; // = $vBC * ( $pIPI / 100 )
			$resp = $nfe->tagIPI($nItem, $cst, $clEnq, $cnpjProd, $cSelo, $qSelo, $cEnq, $vBC, $pIPI, $qUnid, $vUnid, $vIPI);
		}
	}
	
	//PIS - Programa de Integração Social
	$pont = 0;
	foreach($lista_produto as $pont=>$row){
		$nItem = $pont+1;
		$cst = '07'; //simples nacional
		$vBC = ''; 
		$pPIS = '';
		$vPIS = '0';
		$qBCProd = '0';
		$vAliqProd = '0';
		$resp = $nfe->tagPIS($nItem, $cst, $vBC, $pPIS, $vPIS, $qBCProd, $vAliqProd);
	}
	
	//PISST
	//$resp = $nfe->tagPISST($nItem, $vBC, $pPIS, $qBCProd, $vAliqProd, $vPIS);
	
	//COFINS - Contribuição para o Financiamento da Seguridade Social
	$pont = 0;
	foreach($lista_produto as $pont=>$row){
		$nItem = $pont+1;
		$cst = '07'; //simples nacional
		$vBC = '';
		$pCOFINS = '';
		$vCOFINS = '0';
		$qBCProd = '0';
		$vAliqProd = '0';
		$resp = $nfe->tagCOFINS($nItem, $cst, $vBC, $pCOFINS, $vCOFINS, $qBCProd, $vAliqProd);
	}
	
	//Inicialização de váriaveis não declaradas...
	$vII = isset($vII) ? $vII : 0;
	$vIPI = isset($vIPI) ? $vIPI : 0;
	$vIOF = isset($vIOF) ? $vIOF : 0;
	$vPIS = isset($vPIS) ? $vPIS : 0;
	$vCOFINS = isset($vCOFINS) ? $vCOFINS : 0;
	$vICMS = isset($vICMS) ? $vICMS : 0;
	$vBCST = isset($vBCST) ? $vBCST : 0;
	$vST = isset($vST) ? $vST : 0;
	$vISS = isset($vISS) ? $vISS : 0;
	
	//total
	$vBC = $tot_bc_icms;
	$vICMS = $tot_icms;
	$vICMSDeson = '0';
	$vBCST = $tot_bcst_icms;
	$vST = $tot_icmsst;
	$vProd = number_format($tot_prod,2, '.', '');
	$vFrete = '0.00';
	$vSeg = '0.00';
	$vDesc = '0.00';
	$vII = '0.00';
	$vIPI = '0.00';
	$vPIS = '0';
	$vCOFINS = '0';
	$vOutro = '0';
	$vNF = number_format($vProd-$vDesc-$vICMSDeson+$vST+$vFrete+$vSeg+$vOutro+$vII+$vIPI, 2, '.', '');
	$update = $pdo->query("UPDATE tab_nfe SET val_total_nfe = ".$vNF." WHERE id_nfe = '".$_GET['id']."' ");
	$vTotTrib = number_format($vICMS+$vST+$vII+$vIPI+$vPIS+$vCOFINS+$vIOF+$vISS, 2, '.', '');
	$resp = $nfe->tagICMSTot($vBC, $vICMS, $vICMSDeson, $vBCST, $vST, $vProd, $vFrete, $vSeg, $vDesc, $vII, $vIPI, $vPIS, $vCOFINS, $vOutro, $vNF, $vTotTrib);
	
	
	//frete
	if($venda[0]['mod_frete']==NULL){
		$modFrete = '9';
	}else{
		$modFrete = $venda[0]['mod_frete'];
	} //0=Por conta do emitente; 1=Por conta do destinatário/remetente; 2=Por conta de terceiros; 9=Sem Frete;
	$resp = $nfe->tagtransp($modFrete);
	
	//starta variaveis
	$CPF = '';
	$CNPJ = '';
	$xNome = '';
	$IE = '';
	$xEnder = '';
	$xMun = '';
	$UF = '';
	
	if($mod!='65'){
		
		if($modFrete != '9'){
			
				//dados da transportadora
				if($venda[0]['tipo_doc_transp_nfe']==1){
					if($ind_transp){$CPF = $transp_venda[0]['cnpj_transportadora'];}
				}else{
					if($ind_transp){$CNPJ = $transp_venda[0]['cnpj_transportadora'];}
				}
				if($ind_transp){$xNome = $transp_venda[0]['nome_razao_social_transportadora'];}
				if($ind_transp){$IE = $transp_venda[0]['inscricao_estadual_transportadora'];}
				if($ind_transp){$xEnder = $transp_venda[0]['logradouro_transportadora'];}
				if($ind_transp){$xMun = $transp_venda[0]['municipio_transportadora'];}
				if($ind_transp){$UF = $transp_venda[0]['uf_transportadora'];}
	
		}
		
		$resp = $nfe->tagtransporta($CNPJ, $CPF, $xNome, $IE, $xEnder, $xMun, $UF);
		
		if($modFrete != '9'){
			//dados dos veiculos de transporte
			$placa = $venda[0]['placa_veic_nfe'];
			$UF = $venda[0]['uf_veic_nfe'];
			$RNTC = $venda[0]['cod_antt_nfe'];
			$resp = $nfe->tagveicTransp($placa, $UF, $RNTC);
		}else{
			$placa = "AAA1111";
			$UF = "RJ";
		}
		
		//Dados dos Volumes Transportados
		$aVol = array(
		    array((int)$venda[0]['qtd_vol_nfe'],$venda[0]['especie_vol_nfe'],$venda[0]['marca_vol_nfe'],$venda[0]['num_vol_nfe'],$venda[0]['peso_bruto_nfe'],$venda[0]['peso_liq_nfe'],'')
		);
		
		foreach ($aVol as $vol) {
		    $qVol = $vol[0]; //Quantidade de volumes transportados
		    $esp = $vol[1]; //Espécie dos volumes transportados
		    $marca = $vol[2]; //Marca dos volumes transportados
		    $nVol = $vol[3]; //Numeração dos volume
		    $pesoL = intval($vol[4]); //Kg do tipo Int, mesmo que no manual diz que pode ter 3 digitos verificador...
		    $pesoB = intval($vol[5]); //...se colocar Float não vai passar na expressão regular do Schema. =\
		    $aLacres = $vol[6];
		    $resp = $nfe->tagvol($qVol, $esp, $marca, $nVol, $pesoL, $pesoB, $aLacres);
		}
	}
	
	//-------------------------------------------------
	
	if($mod!='65'){
		//dados da fatura
		$nFat = '000035342';
		$vOrig = number_format($tot_prod,2, '.', '');
		$vDesc = '';
		$vLiq = number_format($tot_prod+$vTotTrib,2, '.', '');
		$resp = $nfe->tagfat($nFat, $vOrig, $vDesc, $vLiq);
		
		if($fat != array()){
			
			foreach($fat as $key){
				$aDup[] = array($key['num_fatura'],$key['vencimento_fatura'],$key['val_fatura']);
			}
	
		}else{
			
			$timestamp = strtotime("+3 months");
			$aDup[] = array(($venda[0]['cod_numero_nfe']."-1"),date('Y-m-d',$timestamp),($tot_prod + $vTotTrib));
			
		}
		
		foreach ($aDup as $dup) {
		    $nDup = $dup[0]; //Código da Duplicata
		    $dVenci = $dup[1]; //Vencimento
		    $vDup = number_format($dup[2],2, '.', ''); // Valor
		    $resp = $nfe->tagdup($nDup, $dVenci, $vDup);
		}
	}
	
	
	if($mod=='65'){
		//*************************************************************
		//Grupo obrigatório para a NFC-e. Não informar para a NF-e.
		$tPag = $venda[0]['tipo_pg_nfe'];
		//$tPag = '01'; //01=Dinheiro 02=Cheque 03=Cartão de Crédito 04=Cartão de Débito 05=Crédito Loja 10=Vale Alimentação 11=Vale Refeição 12=Vale Presente 13=Vale Combustível 99=Outros
		$vPag = $venda[0]['val_pg_nfe'];
		$resp = $nfe->tagpag($tPag, $vPag);
		
		if($tPag=='03'){
			//se a operação for com cartão de crédito essa informação é obrigatória
			$CNPJ = $venda[0]['cnpj_oper_nfe']; //CNPJ da operadora de cartão
			$tBand = $venda[0]['bandeira_pg_nfe']; //01=Visa 02=Mastercard 03=American Express 04=Sorocred 99=Outros
			$cAut = $venda[0]['cod_aut_pg_nfe']; //número da autorização da tranzação
			$resp = $nfe->tagcard($CNPJ, $tBand, $cAut);
		}
		//**************************************************************
	}
	
	// Calculo de carga tributária similar ao IBPT - Lei 12.741/12
	$federal = number_format($vII+$vIPI+$vIOF+$vPIS+$vCOFINS, 2, ',', '.');
	$estadual = number_format($vICMS+$vST, 2, ',', '.');
	$municipal = number_format($vISS, 2, ',', '.');
	$totalT = number_format($federal+$estadual+$municipal, 2, ',', '.');
	$textoIBPT = $venda[0]['inf_ad_compl_nfe'];
	
	//Informações Adicionais
	//$infAdFisco = "SAIDA COM SUSPENSAO DO IPI CONFORME ART 29 DA LEI 10.637";
	$infAdFisco = $venda[0]['inf_ad_fisco_nfe'];
	$infCpl = "Pedido Nº".$_GET['id']." - {$textoIBPT} ";
	$resp = $nfe->taginfAdic($infAdFisco, $infCpl);
	
	//monta a NFe e retorna na tela
	$resp = $nfe->montaNFe();
	if ($resp) {
	    $xml = $nfe->getXML();
	    $filename = "../nfephp/xmls/NF-e/producao/entradas/{$chave}-nfe.xml"; // Ambiente Windows
	    file_put_contents($filename, $xml);
	    chmod($filename, 0777);
		//---------------------------MONTA O REGISTRO DA XML
		
		$info['venda'] = $_GET['id'];
		$info['chave'] = $chave;
		$info['xml'] = $xml;
		$info['assinado'] = 0;
		
		//tipo de documento
		if($venda[0]['tipo_documento_nfe'] == 0){
			$info['tipo'] = "Entrada";
		}else if ($venda[0]['tipo_documento_nfe'] == 1){
			$info['tipo'] = "Saída";
		}
		
		//finalidade da emissão
		if($venda[0]['finalidade_emissao_nfe'] == 1){
			$info['finalidade'] = "Normal";
		}else if($venda[0]['finalidade_emissao_nfe'] == 2){
			$info['finalidade'] = "Complementar";
		}else if($venda[0]['finalidade_emissao_nfe'] == 3){
			$info['finalidade'] = "Ajuste";
		}else if($venda[0]['finalidade_emissao_nfe'] == 4){
			$info['finalidade'] = "Devolução/Retorno";
		}
		
		$check = xml_venda($pdo,$_GET['id']);
		
		if($check != array()){
			$edita = edit_xml($pdo, $info);
			if($chave != $check[0]['chave_xml']){
				del_xml_venda($pdo,$_GET['id']); // ----- deleta a xml com a chave errada
				$add = add_xml($pdo,$info);
				if($add == '1'){
					echo "<script>alert('Nota Adicionada com sucesso!');</script>";
				}else{
					echo "<script>alert('Nota Não Adicionada!');</script>";
				}
			}else{
				if($edita == '1'){
					echo "<script>alert('Nota Editada com sucesso!');</script>";
				}else{
					echo "<script>alert('Nota Não Editada!');</script>";
				}
			}
		}else{
			$add = add_xml($pdo,$info);
			if($add == '1'){
				echo "<script>alert('Nota Adicionada com sucesso!');</script>";
			}else{
				echo "<script>alert('Nota Não Adicionada!');</script>";
			}
		}
		
		//----------------------------------------------------------------
		
	} else {
	    header('Content-type: text/html; charset=UTF-8');
	    foreach ($nfe->erros as $err) {
	        echo 'tag: &lt;'.$err['tag'].'&gt; ---- '.$err['desc'].'<br>';
	    }
	}
//-----------------------------ELSE DO PRIMEIRO IF, DA NOTA TRANSMITIDA
}else{
	echo "<script>alert('Nota já Transmitida! Faça outra Nota');</script>";
}




