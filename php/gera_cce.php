<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require "../_app/Config.inc.php";
require "../nfephp/vendor/autoload.php";

use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\NFe\Complements;

//jsons de config
$configJson = file_get_contents('../nfephp/config/config.json');
$certJson = json_decode(file_get_contents('../nfephp/config/cert.json'), true);

//certificado A1
$cert = file_get_contents('../nfephp/certs/' . $certJson['certPfxName']);
$tools = new NFePHP\NFe\Tools($configJson, Certificate::readPfx($cert, $certJson['certPassword']));
$tools->model($_POST['modelo']);

//traz info sobre nfe
$xml = xml_venda($pdo,$_POST['id_nfe']);
@$chave = $xml[0]['chave_xml'];

//verifica o ultimo evento da nfe
$nSeq = $pdo->query('SELECT max(num_seq_cce) as nseq FROM tab_cce WHERE id_venda = ' . $_POST['id_nfe'] .' ');
$nSeq = $nSeq->fetchAll();
echo $nSeq = $nSeq[0]['nseq']+1;

//junta informações para a CCE
$chNFe = $chave;
$xCorrecao = preg_replace( "/\r|\n|\r\n/", " ", $_POST['motivo'] );
$nSeqEvento = $nSeq;
$retorno = $tools->sefazCCe($chNFe, $xCorrecao, $nSeqEvento);

//retorna organizado
$simple = $retorno;
$p = xml_parser_create();
xml_parse_into_struct($p, $simple, $vals, $index);
xml_parser_free($p);

/*
echo "<pre>";
echo "Index array\n";
print_r($index);
echo "\nVals array\n";
print_r($vals);
*/

$resp = $vals[8]['value'];
$cStat = $vals[15]['value'];
$xMotivo = $vals[16]['value'];
$chave = $vals[17]['value'];

//recebe data
$data = date('Ym');

//evento não processado
if ($resp != 128){
    
    echo "<script>alert('Erro: 128 - evento não processado. ');</script>";   
    
}else{
    
    //sucesso
    if ($cStat == '135' || $cStat == '136') {
        
        //salva no banco
        try{
            $select = $pdo->prepare("
            INSERT INTO tab_cce (
                id_venda,
                chave_nfe_cce, 
                num_seq_cce,
                mes_ano_cce
            )
            VALUES
            (
                ?,?,?,?
            )
            ");

            $select->bindParam(1, $_POST['id_nfe'], PDO::PARAM_INT );
            $select->bindParam(2, $chave, PDO::PARAM_INT );
            $select->bindParam(3, $nSeqEvento, PDO::PARAM_INT );
            $select->bindParam(4, $data, PDO::PARAM_INT );

            $select->execute();

        }catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        
        $xml = Complements::toAuthorize($tools->lastRequest, $retorno);
        
        //grava xml protocolado da CCE		
		file_put_contents("../xml_o/cce/{$chave}-cce-$nSeqEvento.xml",$xml);
        
        
    //falha no evento   
    }else{
        
        echo "<script>alert('Erro " . $cStat . ": " . $xMotivo ." ');</script>";
        
    }
    
}

echo "<script>window.history.back();</script>";
