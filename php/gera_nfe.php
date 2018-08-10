<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

error_reporting(0);
ini_set('display_errors', 0);

require "../_app/Config.inc.php";
require "../nfephp/vendor/autoload.php";

use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\Common\Soap\SoapCurl;
use NFePHP\NFe\Make;
use NFePHP\NFe\Common\Standardize;
use NFePHP\NFe\Factories\Protocol;
use NFePHP\NFe\Complements;

//acertando a data
//acertando a data
date_default_timezone_set('America/Sao_Paulo');
$bool = date('I');
if ($bool) {
    $timestamp = mktime(date("H") - 2, date("i"), date("s"), date("m"), date("d"), date("Y"));
    //echo gmdate("Y-m-d\TH:i:s", $timestamp);
} else {
    $timestamp = mktime(date("H") - 3, date("i"), date("s"), date("m"), date("d"), date("Y"));
    //echo gmdate("Y-m-d\TH:i:s", $timestamp);
}

//------------------------------------------------------
//------------------------------------------------------
//Recolhimento de informações para preenchimento da nota
//------------------------------------------------------
//------------------------------------------------------
//
//jsons de config
$configJson = file_get_contents('../nfephp/config/config.json');
$certJson = json_decode(file_get_contents('../nfephp/config/cert.json'), true);

//certificado A1
$cert = file_get_contents('../nfephp/certs/' . $certJson['certPfxName']);
$tools = new NFePHP\NFe\Tools($configJson, Certificate::readPfx($cert, $certJson['certPassword']));

//xml banco
$xml_q = xml_venda($pdo, $_GET['id']);

//caso a nota não tenha sido transmitida, passa adiante
if (@$xml_q[0]['transmitido_xml'] != 1) {
    
    //venda
    $venda = venda_view_1($pdo,$_GET['id']);

    //cliente
    $cliente = cliente_view_1_id($pdo, $venda[0]['id_cliente']);

    //estados
    $estados = estados($pdo_estados);

    //notas referenciadas
    $nref = nref_venda($pdo, $_GET['id']);
    $ind_nref = 0;
    if ($nref != array()) {
        $ind_nref = 1;
    }

    //emitente
    $emitente = emitente($pdo);

    //faturas e/ou duplicatas
    $fat = fat_nfe($pdo, $_GET['id']);

    //transportadoras
    $transp_venda = transp_id($pdo, $venda[0]['id_transp_nfe']);
    $ind_transp = 0;
    if ($transp_venda != array()) {
        $ind_transp = 1;
    }

    //entrega e retirada diferente do destinatário
    $lista_entrega = entrega_view_1($pdo, $venda[0]['id_entrega']);
    $lista_retirada = retirada_view_1($pdo, $venda[0]['id_retirada']);

    //acerta o estado da retirada e/ou entrega
    if ($venda[0]['id_retirada'] != 0) {
        $estado_retirada = estado_cod($pdo_estados, $lista_retirada[0]['uf_retirada']);
    }if ($venda[0]['id_entrega'] != 0) {
        $estado_entrega = estado_cod($pdo_estados, $lista_entrega[0]['uf_entrega']);
    }

    //produtos da nota
    $produtos = itens_venda($pdo, $_GET['id']);
    foreach ($produtos as $index => $key) {
        $temp = produto_view_1($pdo, $key['id_produto']);
        $lista_produto[] = $temp[0];
    }

    // CHECAGENS E SCAPES DE FALTA DE INFORMAÇÃO   
    $erro_s = false;

    //falta de Produtos na nota
    if (!isset($lista_produto) || $lista_produto === array()) {
        echo "<center><img src=./imgs/erro_b.png style=\"width: 30px\" /><h4 style=\"display: inline-block\"><font color=red>"
        . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nota Fiscal sem Produtos Registrados!"
        . "</font></h4></center>";
        $erro_s = true;
    }

    //falta de cliente registrado na nota (somente modelo 55)
    if (!isset($cliente) || $cliente === array()) {
        if ($venda[0]['modelo_nfe'] !== '65') {
            echo "<center><img src=./imgs/erro_b.png style=\"width: 30px\" /><h4 style=\"display: inline-block\"><font color=red>"
            . "&nbsp;&nbsp;&nbsp;Nota Fiscal sem Destinatário Registrado!"
            . "</font></h4></center>";
            $erro_s = true;
        }
    }

    //caso haja erro, vai até a div display da mensagem e para o script
    if ($erro_s) {
        if ($venda[0]['modelo_nfe'] === '65') {
            echo "<script>$('#teste')[0].scrollIntoView(true);</script>";
        }
        die();
    }
}

//caso a nota não tenha sido transmitida e não haja nenhum erro, passa adiante
if (@$xml_q[0]['transmitido_xml'] != 1) {

    //instancia a nota
    $nfe = new Make();

    //node principal
    $std = new stdClass();
    $std->versao = '4.00'; //versão do layout
    $chave = $std->Id = ''; //se o Id de 44 digitos não for passado será gerado automaticamente
    $std->pk_nItem = null; //deixe essa variavel sempre como NULL
    
    $elem = $nfe->taginfNFe($std);
    //--------------------------------------------

    //identificação da nota
    $std = new stdClass();
    $std->cUF = $venda[0]['uf_nfe'];
    $std->cNF = $venda[0]['cod_numero_nfe'];
    $std->natOp = $venda[0]['nop_nfe'];

    $std->indPag = 0; //NÃO EXISTE MAIS NA VERSÃO 4.00 

    $mod = $std->mod = $venda[0]['modelo_nfe'];
    
    //Numeração diferente de 55 e 65
	if($mod!='65'){
		$std->serie = (int)(($emitente[0]['n_nota_emitente']+1)/10000)+1; //serie da NFe
		$std->nNF = $emitente[0]['n_nota_emitente']+1; // numero da NFe ------ALTERAR
	}else{
		$std->serie = (int)(($emitente[0]['n_nfce_emitente']+1)/10000)+1; //serie da NFe
		$std->nNF = $emitente[0]['n_nfce_emitente']+1;
	}
    
    //horário diferente de 55 e 65
	if($bool){
		if($mod!='65'){
			$std->dhEmi = str_replace(" ","T",$venda[0]['data_emis_nfe'])."-02:00";//Formato: “AAAA-MM-DDThh:mm:ssTZD” (UTC)
		}else{
			$std->dhEmi = gmdate("Y-m-d\TH:i:s-02:00", $timestamp);
		}
	}else{
		if($mod!='65'){
			$std->dhEmi = str_replace(" ","T",$venda[0]['data_emis_nfe'])."-03:00";//Formato: “AAAA-MM-DDThh:mm:ssTZD” (UTC)
		}else{
			$std->dhEmi = gmdate("Y-m-d\TH:i:s-03:00", $timestamp);
		}
	}
    
    //dh de saída/estrada diferente 55 e 65
    if($mod!='65'){
		 $std->dhSaiEnt = str_replace(" ","T",$venda[0]['data_hora_saida_entrada_nfe'])."-02:00";//Não informar este campo para a NFC-e.
	}else{
		 $std->dhSaiEnt = null;
	}
    
    $std->tpNF = $venda[0]['tipo_documento_nfe'];
    $std->idDest = $venda[0]['destino_operacao_nfe'];
    $std->cMunFG = $venda[0]['cod_municipio_ocorrencia_nfe'];
    $std->tpImp = $venda[0]['formato_danfe_nfe'];
    $std->tpEmis = $venda[0]['forma_emissao_nfe'];
    $std->cDV = null;
    $std->tpAmb = TP_AMB;
    $finNFe = $std->finNFe = $venda[0]['finalidade_emissao_nfe'];
    $std->indFinal = $venda[0]['comprador_final_nfe'];
    $std->indPres = $venda[0]['presenca_comprador_nfe'];
    $std->procEmi = '0';
    $std->verProc = '3.0.1';
    $std->dhCont = null;
    $std->xJust = null;

    $elem = $nfe->tagide($std);
    //--------------------------------------------

    //notas referenciadas
    if($finNFe!=1){
		if($ind_nref){
			foreach($nref as $key){
                $std = new stdClass();
                $std->refNFe = $key['chave_nref'];

                $elem = $nfe->tagrefNFe($std);
			}
		}
	}
    //--------------------------------------------
    
    //emitente
    $std = new stdClass();
    $std->xNome = $emitente[0]['nome_razao_social_emitente'];
    $std->xFant = $emitente[0]['nome_fantasia_emitente'];
    $std->IE = $emitente[0]['inscricao_estadual_emitente'];
    $std->IEST = $emitente[0]['inscricao_estadual_trib_emitente'];
    $std->IM = $emitente[0]['inscricao_municipal_emitente'];
    $std->CNAE = $emitente[0]['cnae_fiscal_emitente'];
    $std->CRT = 1;
    $std->CNPJ = $emitente[0]['cnpj_emitente']; //indicar apenas um CNPJ ou CPF
    $std->CPF = null;

    $elem = $nfe->tagemit($std);
    //--------------------------------------------

    //endereço do emitente
    $std = new stdClass();
    $std->xLgr = $emitente[0]['logradouro_emitente'];
    $std->nro = $emitente[0]['numero_emitente'];
    $std->xCpl = $emitente[0]['complemento_emitente'];
    $std->xBairro = $emitente[0]['bairro_emitente'];
    $std->cMun = $emitente[0]['cod_municipio_emitente'];
    $std->xMun = $emitente[0]['municipio_emitente'];
    $std->UF = $emitente[0]['uf_emitente'];
    $std->CEP = $emitente[0]['cep_emitente'];
    $std->cPais = '1058';
    $std->xPais = 'Brasil';
    $std->fone = limpa($emitente[0]['telefone_emitente']);

    $elem = $nfe->tagenderEmit($std);
    //--------------------------------------------
    
    //caso haja destinatário cadastrado
    if($venda[0]['id_cliente'] != 0){
        
        //destinatário
        $std = new stdClass();
        $std->xNome = $cliente[0]['nome_razao_social_cliente'];
        
        if($mod=='55'){
            $std->indIEDest = '1';
            $std->IE = limpa($cliente[0]['inscricao_estadual_cliente']);
        }else if($mod=='65'){
            $indIEDest = '9';
            $IE = '';
        }
        
        $std->ISUF = NULL;
        $std->IM = NULL;
        $std->email = $cliente[0]['email_cliente'];
        
        $cpf_cnpj_dest = limpa($cliente[0]['cpf_cnpj_cliente']);
        if(strlen($cpf_cnpj_dest) == 14){
            $std->CNPJ = $cpf_cnpj_dest;
            $std->CPF = null;
        }else if(strlen($cpf_cnpj_dest) == 11){
            $std->CNPJ = null;
            $std->CPF = $cpf_cnpj_dest;
        }else{
            echo "<script>alert('CPF/CNPJ Inválido!');</script>";
            die();
        }
        
        $std->idEstrangeiro = null;

        $elem = $nfe->tagdest($std);
        //--------------------------------------------

        //endereço do destinatário
        if($mod=='55'){
            $std = new stdClass();
            $std->xLgr = $cliente[0]['logradouro_cliente'];
            $std->nro = $cliente[0]['numero_cliente'];
            $std->xCpl = $cliente[0]['complemento_cliente'];
            $std->xBairro = $cliente[0]['bairro_cliente'];
            $std->cMun = $cliente[0]['cod_municipio_cliente'];
            $std->xMun = $cliente[0]['municipio_cliente'];
            foreach($estados as $index=>$name){
                if($cliente[0]['uf_cliente'] == $name['codigo_ibge']){
                    $std->UF = $name['uf'];
                }
            }
            $std->CEP = limpa($cliente[0]['cep_cliente']);
            $std->cPais = '1058';
            $std->xPais = 'Brasil';
            $std->fone = limpa($cliente[0]['telefone_cliente']);

            $elem = $nfe->tagenderDest($std);
        }
        //--------------------------------------------
        
    }

    //retirada diferente do destinatário
    if ($venda[0]['id_retirada'] != 0) {
        $std = new stdClass();
        $std->xLgr = $lista_retirada[0]['logradouro_retirada'];
        $std->nro = $lista_retirada[0]['numero_retirada'];
        $std->xCpl = $lista_retirada[0]['complemento_retirada'];
        $std->xBairro = $lista_retirada[0]['bairro_retirada'];
        $std->cMun = $lista_retirada[0]['cod_mun_retirada'];
        $std->xMun = $lista_retirada[0]['mun_retirada'];
        $std->UF = $estado_retirada[0]['uf'];
        $std->CNPJ = limpa($lista_retirada[0]['cnpj_retirada']);
        $std->CPF = limpa($lista_retirada[0]['cpf_retirada']);

        $elem = $nfe->tagretirada($std);
    }
    //--------------------------------------------

    //entrega diferente do destinatário
    if ($venda[0]['id_entrega'] != 0) {
        $std = new stdClass();
        $std->xLgr = $lista_retirada[0]['logradouro_retirada'];
        $std->nro = $lista_retirada[0]['numero_retirada'];
        $std->xCpl = $lista_retirada[0]['complemento_retirada'];
        $std->xBairro = $lista_retirada[0]['bairro_retirada'];
        $std->cMun = $lista_retirada[0]['cod_mun_retirada'];
        $std->xMun = $lista_retirada[0]['mun_retirada'];
        $std->UF = $estado_retirada[0]['uf'];
        $std->CNPJ = limpa($lista_retirada[0]['cnpj_retirada']);
        $std->CPF = limpa($lista_retirada[0]['cpf_retirada']);

        $elem = $nfe->tagentrega($std);
    }
    //--------------------------------------------
    
    //pessoas autorizadas
    $std = new stdClass();
    $std->CNPJ = null; //indicar um CNPJ ou CPF
    $std->CPF = "61924157144";
    $elem = $nfe->tagautXML($std);    
    //--------------------------------------------
    
    //--------------------------------------------
    //produtos------------------------------------
    //--------------------------------------------
    
    //totais
    $tot_prod = 0;
    $tot_desc = 0;
    
	//numero de produtos
	$pont = 0;
    
	//checa se tem valor de frete
	//if($venda[0]['val_transp_nfe']==NULL || $venda[0]['val_transp_nfe']==0.00){
	//	$indi = '1';
	//}else{
	//	$indi = '1';
	//}
    
	//percorre os produtos
	foreach($lista_produto as $pont=>$row){
		$std = new stdClass();
        $std->item = $pont + 1; //item da NFe
        $std->cProd = $row['codigo_produto'];
        $std->cEAN = $row['ean_produto']=="" ? "SEM GTIN" : $row['ean_produto'];
        $std->xProd = $row['descricao_produto'];
        $std->NCM = $row['ncm_produto'];

        $std->cBenef = ""; //incluido no layout 4.00

        $std->EXTIPI = "";
        $std->CFOP = $produtos[$pont]['cfop_item'];
        $std->uCom = $row['unid_produto'];
        $std->qCom = $produtos[$pont]['qtd_item'];
        $std->vUnCom = $row['valor_produto'];
        $std->vProd = number_format($row['valor_produto']*$produtos[$pont]['qtd_item'],2, '.', '');
        $std->cEANTrib = $row['ean_produto']=="" ? "SEM GTIN" : $row['ean_produto']; 
        $std->uTrib = $row['unid_produto'];
        $std->qTrib = $produtos[$pont]['qtd_item'];
        $std->vUnTrib = $row['valor_produto'];
        $std->vFrete = ($std->item==1 && $venda[0]['val_transp_nfe']!='0.00') ? $venda[0]['val_transp_nfe'] : '' ;
        $std->vSeg = "";
        $std->vDesc = ($produtos[$pont]['val_desc_item']!=='0.00' || $produtos[$pont]['val_desc_unit_item']!=='0.00') ? number_format((($row['valor_produto']*$produtos[$pont]['qtd_item'])/100*$produtos[$pont]['val_desc_item'])+($produtos[$pont]['val_desc_unit_item']),2, '.', '') : '';
        $std->vOutro = "";
        $std->indTot = $produtos[$pont]['ind_total_item'];
        $std->xPed = "16";
        $std->nItemPed = $pont;
        $std->nFCI = "";

        $elem = $nfe->tagprod($std);
            
        //calibra os totais
        $tot_prod += ($row['valor_produto']*$produtos[$pont]['qtd_item']);
        if($produtos[$pont]['val_desc_item']!=='0.00' || $produtos[$pont]['val_desc_unit_item']!=='0.00'){
            $tot_desc += number_format((($row['valor_produto']*$produtos[$pont]['qtd_item'])/100*$produtos[$pont]['val_desc_item'])+($produtos[$pont]['val_desc_unit_item']),2, '.', '');
        }        
    }
    //--------------------------------------------
    
    //info adicional produto
    $pont = 0;
	foreach($lista_produto as $pont=>$row){
        $std = new stdClass();
        $std->item = $pont+1; //item da NFe
        $std->infAdProd = ".";
        //$std->infAdProd = $row['descricao_produto']." - x".$produtos[$pont]['qtd_item']." - Pedido N°".$_GET['id'];

        $elem = $nfe->taginfAdProd($std);
    }
    //--------------------------------------------
    
    //Iniciando variáveis
    $tot_bc_icms = 0;
	$tot_icms = 0;
	$tot_bcst_icms = 0;
	$tot_icmsst = 0;
    //--------------------------------------------
    
    //impostos
    $pont = 0;
	foreach($lista_produto as $pont=>$row){
        $std = new stdClass();
        $std->item = $pont+1; //item da NFe
        $vTotTrib = $std->vTotTrib = $produtos[$pont]['val_op_icms']+$produtos[$pont]['val_st_icms'];

        $elem = $nfe->tagimposto($std);
    }
    //--------------------------------------------
    
    //ICMS
    foreach($lista_produto as $pont=>$row){
        $std = new stdClass();
        $std->item = $pont+1; //item da NFe
        $std->orig = $produtos[$pont]['origem_icms'];
        $std->CSOSN = $produtos[$pont]['sit_trib_icms'];
        $std->pCredSN = 2.33;
        $std->vCredICMSSN = 4.66;
        $std->modBCST = $produtos[$pont]['modbcst_icms'];
        $std->pMVAST = $produtos[$pont]['p_m_vast_icms'];
        $std->pRedBCST = $produtos[$pont]['p_reducao_bcst_icms'];
        $vBCST = $std->vBCST = $produtos[$pont]['vbcst_icms'];
        $std->pICMSST = $produtos[$pont]['aliq_st_icms'];
        $vICMSST = $std->vICMSST = $produtos[$pont]['val_st_icms'];
        
        $std->vBCFCPST = null; //incluso no layout 4.00
        $std->pFCPST = null; //incluso no layout 4.00
        $std->vFCPST = null; //incluso no layout 4.00

        
        $std->vBCSTRet = $produtos[$pont]['vbc_ret_ant_st_icms'];
        $std->pST = null;
        $std->vICMSSTRet = $produtos[$pont]['v_ret_ant_st_icms'];
        
        $std->vBCFCPSTRet = null; //incluso no layout 4.00
        $std->pFCPSTRet = null; //incluso no layout 4.00
        $std->vFCPSTRet = null; //incluso no layout 4.00
        
        $std->modBC = $produtos[$pont]['modbc_icms'];
        $vBC = $std->vBC = $produtos[$pont]['vbc_icms'];
        $std->pRedBC = $produtos[$pont]['p_reducao_bc_icms'];
        $std->pICMS = $produtos[$pont]['aliq_icms'];
        $vICMS = $std->vICMS = $produtos[$pont]['val_op_icms'];

        $elem = $nfe->tagICMSSN($std);
        
        //calibra o toal dos impostos
        $tot_bc_icms += $vBC;
		$tot_icms += $vICMS;
		$tot_bcst_icms += $vBCST;
		$tot_icmsst += $vICMSST;
        
    }
    //--------------------------------------------
    
    //IPI
    if($mod!='65'){
        $pont = 0;
		foreach($lista_produto as $pont=>$row){
            
            $std = new stdClass();
            $std->item = $pont+1; //item da NFe
            //$std->clEnq = '999';
            $std->CNPJProd = '';
            $std->cSelo = null;
            $std->qSelo = null;
            $std->cEnq = '340';
            $std->CST = '52';
            $std->vIPI = 0;
            $std->vBC = 0;
            $std->pIPI = 0;
            $std->qUnid = null;
            $std->vUnid = null;
            
            $elem = $nfe->tagIPI($std);
        }
    }
    //--------------------------------------------
    
    //PIS
    $pont = 0;
	foreach($lista_produto as $pont=>$row){
        
        $std = new stdClass();
        $std->item = $pont+1; //item da NFe
        $std->CST = '07';
        $std->vBC = null;
        $std->pPIS = null;
        $std->vPIS = 0;
        $std->qBCProd = 0;
        $std->vAliqProd = 0;

        $elem = $nfe->tagPIS($std);
    }
    //--------------------------------------------
    
    //COFINS
    $pont = 0;
	foreach($lista_produto as $pont=>$row){
        
        $std = new stdClass();
        $std->item = $pont+1; //item da NFe
        $std->CST = '07';
        $std->vBC = null;
        $std->pCOFINS = null;
        $std->vCOFINS = 0;
        $std->qBCProd = 0;
        $std->vAliqProd = 0;

        $elem = $nfe->tagCOFINS($std);
    }
    //--------------------------------------------
    
    //Iniciando variáveis
	$vII = isset($vII) ? $vII : 0;
	$vIPI = isset($vIPI) ? $vIPI : 0;
	$vIOF = isset($vIOF) ? $vIOF : 0;
	$vPIS = isset($vPIS) ? $vPIS : 0;
	$vCOFINS = isset($vCOFINS) ? $vCOFINS : 0;
	$vICMS = isset($vICMS) ? $vICMS : 0;
	$vBCST = isset($vBCST) ? $vBCST : 0;
	$vST = isset($vST) ? $vST : 0;
	$vISS = isset($vISS) ? $vISS : 0;
    //--------------------------------------------
    
    //TOTAL DE IMPOSTOS
    $std = new stdClass();
    $std->vBC = $tot_bc_icms;
    $vICMS = $std->vICMS = $tot_icms;
    $vICMSDeson = $std->vICMSDeson = 0.00;
    
    $std->vFCP = null; //incluso no layout 4.00
    
    $std->vBCST = $tot_bcst_icms;
    $vST = $std->vST = $tot_icmsst;
    
    $std->vFCPST = null; //incluso no layout 4.00
    $std->vFCPSTRet = null; //incluso no layout 4.00
    
    $vProd = $std->vProd = number_format($tot_prod,2, '.', '');
    
    if($venda[0]['val_transp_nfe']==NULL || $venda[0]['val_transp_nfe']=='0.00'){
        $vFrete = $std->vFrete = '';
    }else{
        $vFrete = $std->vFrete = $venda[0]['val_transp_nfe'];
    }
    
    $vSeg = $std->vSeg = 0.00;
    $vDesc = $std->vDesc = number_format($tot_desc,2,'.','');
    $vII = $std->vII = 0.00;
    $vIPI = $std->vIPI = 0.00;
    
    $std->vIPIDevol = 0.00; //incluso no layout 4.00
    
    $vPIS = $std->vPIS = 0.00;
    $vCOFINS = $std->vCOFINS = 0.00;
    $vOutro = $std->vOutro = 0.00;
    
    $vNF = $std->vNF = number_format($vProd-$vDesc-$vICMSDeson+$vST+$vFrete+$vSeg+$vOutro+$vII+$vIPI, 2, '.', '');
    $std->vTotTrib = number_format($vICMS+$vST+$vII+$vIPI+$vPIS+$vCOFINS+$vIOF+$vISS, 2, '.', '');

    $elem = $nfe->tagICMSTot($std);
    
    //atualiza valor da nota fiscal
    //$update = $pdo->query("UPDATE tab_nfe SET val_total_nfe = ".$vNF." WHERE id_nfe = '".$_GET['id']."' ");
    
    //--------------------------------------------
    
    //--------------------------------------------
    //frete---------------------------------------
    //--------------------------------------------
    $std = new stdClass();
    
    if($venda[0]['mod_frete']==NULL){
        $modFrete = $std->modFrete = '9';
    }else{
        $modFrete = $std->modFrete = $venda[0]['mod_frete'];
    }
    
    $elem = $nfe->tagtransp($std);
    //--------------------------------------------
    
    //Iniciando variáveis
    $CPF = '';
	$CNPJ = '';
	$xNome = '';
	$IE = '';
	$xEnder = '';
	$xMun = '';
	$UF = '';
    //--------------------------------------------
    
    if($mod!='65'){		
               
        //transportadora
		if($modFrete != '9' && $modFrete != '0' && $modFrete != '1'){
            $std = new stdClass();
            if($ind_transp){$std->xNome = $transp_venda[0]['nome_razao_social_transportadora'];}
            if($ind_transp){$std->IE = $transp_venda[0]['inscricao_estadual_transportadora'];}
            if($ind_transp){$std->xEnder = $transp_venda[0]['logradouro_transportadora'];}
            if($ind_transp){$std->xMun = $transp_venda[0]['municipio_transportadora'];}
            if($ind_transp){$std->UF = $transp_venda[0]['uf_transportadora'];}
            
            if($venda[0]['tipo_doc_transp_nfe']==1){
                if($ind_transp){$std->CNPJ = null;}//só pode haver um ou CNPJ ou CPF
                if($ind_transp){$std->CPF = $transp_venda[0]['cnpj_transportadora'];}
            }else{
                if($ind_transp){$std->CNPJ = $transp_venda[0]['cnpj_transportadora'];}//só pode haver um ou CNPJ ou CPF
                if($ind_transp){$std->CPF = null;}
            }

            $elem = $nfe->tagtransporta($std);
        }
        //--------------------------------------------
        
        //veículo de transporte
        if($modFrete != '9' && $modFrete != '0' && $modFrete != '1'){
            $std = new stdClass();
            $placa = $std->placa = $venda[0]['placa_veic_nfe'];
            $UF = $std->UF = $venda[0]['uf_veic_nfe'];
            $std->RNTC = $venda[0]['cod_antt_nfe'];

            $elem = $nfe->tagveicTransp($std);
        }else{
            $placa = "AAA1111";
			$UF = "RJ";
        }
        //--------------------------------------------
        
        //Volumes transportados
        if($modFrete != '9' && $modFrete != '0' && $modFrete != '1'){
            $std = new stdClass();
            $std->item = 1; //indicativo do numero do volume
            $std->qVol = (int)$venda[0]['qtd_vol_nfe'];
            $std->esp = $venda[0]['especie_vol_nfe'];
            $std->marca = $venda[0]['marca_vol_nfe'];
            $std->nVol = $venda[0]['num_vol_nfe'];
            $std->pesoL = $venda[0]['peso_liq_nfe']==0 ? null : number_format($venda[0]['peso_liq_nfe'],3,".","");
            $std->pesoB = $venda[0]['peso_bruto_nfe']==0 ? null : number_format($venda[0]['peso_bruto_nfe'],3,".","");

            $elem = $nfe->tagvol($std);
        }
        //--------------------------------------------
        
        
    }
    //--------------------------------------------
    //FIM frete-----------------------------------
    //--------------------------------------------
    
    if($mod!='65'){
        
        //Fatura
        $std = new stdClass();
        $std->nFat = 'NF ' . rand(00000,99999);
        $std->vOrig = number_format($vNF,2, '.', '');
        $std->vDesc = '0.00';
        $std->vLiq = number_format($vNF,2, '.', '');

        $elem = $nfe->tagfat($std);
        //--------------------------------------------
        
        //duplicatas se houver
        if($fat != array()){
            
            foreach($fat as $key){
				$aDup[] = array($key['num_fatura'],$key['vencimento_fatura'],$key['val_fatura']);
			}
            
            foreach ($aDup as $dup) {
                $std = new stdClass();
                $std->nDup = $dup[0];
                $std->dVenc = $dup[1];
                $std->vDup = number_format($dup[2],2, '.', '');

                $elem = $nfe->tagdup($std);
            }
            
            
        }
        //--------------------------------------------
        
    }
    
    //--------------------------------------------
    //pagamento-----------------------------------
    //--------------------------------------------
    
    //pag obrigatório
    $std = new stdClass();
    $std->vTroco = 0.00; //incluso no layout 4.00, obrigatório informar para NFCe (65)

    $elem = $nfe->tagpag($std);
    //--------------------------------------------
    
    //Detalhamento do pagamento -- 65 NFCE
    //if($mod=='65'){
        
        if($venda[0]['finalidade_emissao_nfe']=='4'){
            $venda[0]['tipo_pg_nfe'] = '90';
        }
        
        if($venda[0]['tipo_pg_nfe']==""){
            $venda[0]['tipo_pg_nfe'] = '01';
        }
        
        $std = new stdClass();
        $std->tPag = $venda[0]['tipo_pg_nfe'];
        $std->vPag = $venda[0]['val_pg_nfe']=="" ? $vNF : number_format($venda[0]['val_pg_nfe'],2,".",""); //Obs: deve ser informado o valor pago pelo cliente
        $std->CNPJ = $venda[0]['cnpj_oper_nfe'];
        $std->tBand = $venda[0]['bandeira_pg_nfe'];
        $std->cAut = $venda[0]['cod_aut_pg_nfe'];
        $std->tpIntegra = 2; //incluso na NT 2015/002

        $elem = $nfe->tagdetPag($std);
        
    //}
    //--------------------------------------------
    
    //Informação Adicional

    // Calculo de carga tributária similar ao IBPT - Lei 12.741/12
	$federal = number_format($vII+$vIPI+$vIOF+$vPIS+$vCOFINS, 2, ',', '.');
	$estadual = number_format($vICMS+$vST, 2, ',', '.');
	$municipal = number_format($vISS, 2, ',', '.');
	$totalT = number_format($federal+$estadual+$municipal, 2, ',', '.');
	$textoIBPT = $venda[0]['inf_ad_compl_nfe'];
    
    //$infAdFisco = "SAIDA COM SUSPENSAO DO IPI CONFORME ART 29 DA LEI 10.637";
	$infAdFisco = $venda[0]['inf_ad_fisco_nfe'];
    $infAdFisco .= " Conf. Lei 12.741/12 Impts Aprox. Incidentes: 4% no valor de R$ " . number_format(($vNF*0.04), 2, ",", ".");
	$infCpl = "Pedido Nº ".$_GET['id'] . ". {$textoIBPT} ";
    
    $std = new stdClass();
    $std->infAdFisco = $infAdFisco;
    $std->infCpl = $infCpl;

    $elem = $nfe->taginfAdic($std);
    
    //--------------------------------------------
    
    //--------------------------------------------
    //--------------FINALIZAÇÃO-------------------
    //--------------------------------------------
    
    //header('Content-type: text/xml');
    
    //monta e armazena em variável
    $resp = $nfe->montaNFe();
    
    //caso a nota seja montada com sucesso
    if ($resp) {
        $xml = $nfe->getXML();    
        $chave = $nfe->getChave();

        //salva em arquivo
        $filename = "../nfephp/xmls/NF-e/" . TP_AMB_N ."/entradas/{$chave}-nfe.xml"; // Ambiente Windows
        //$filename = "./xml/{$chave}-nfe.xml"; // provisório
        file_put_contents($filename, $xml);
        chmod($filename, 0777);

        //vetor de alimentação do banco
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

        //checa existencia de um xml para esta nota
        $check = xml_venda($pdo,$_GET['id']);

        //testa as possibilidades - adição ou edição de XML
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
        
    //caso tenha ocorrido erro na montagem da nota  
    } else {
	    header('Content-type: text/html; charset=UTF-8');
	    foreach ($nfe->erros as $err) {
	        echo 'tag: &lt;'.$err['tag'].'&gt; ---- '.$err['desc'].'<br>';
	    }
	}
    
    
    //--------------------------------------------
    //--------------FINALIZAÇÃO-------------------
    //--------------------------------------------
  
//caso a nota ja tenha sido transmitida - ELSE do PRIMEIRO IF
}else{
	echo "<script>alert('Nota já Transmitida! Faça outra Nota');</script>";
}




