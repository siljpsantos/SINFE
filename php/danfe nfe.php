<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require "../_app/Config.inc.php";
require "../nfephp/vendor/autoload.php";

use NFePHP\DA\NFe\Danfe;
use NFePHP\DA\NFe\Danfce;
use NFePHP\DA\Legacy\FilesFolders;

//recupera informações

//nfe
$venda = venda_view_1($pdo,$_POST['id_nfe']);
//xml
$xml = xml_venda($pdo,$_POST['id_nfe']);
//chave
@$chave = $xml[0]['chave_xml'];
//conteudo xml
@$xml_1 = simplexml_load_string($xml[0]['conteudo_xml']);
//data e hora
@$data = explode('-',$xml_1->NFe->infNFe->ide->dhEmi);
@$data = $data[0].$data[1];
//path da logo
$pathLogo = "..\/nfephp\/images\/logo.jpg";

//----------------nota não existente
if($xml != array()){

    if($venda[0]['modelo_nfe']=='65'){

        //----------------nota não transmitida
        if($xml[0]['transmitido_xml'] == 1){
            
            //CAMINHOS           
            $xmlProt = "../nfephp/xmls/NF-e/" . TP_AMB_N ."/enviadas/aprovadas/".$data."/{$chave}-protNFe.xml";
            //$xmlProt = "./xml/$chave-nfe.xml"; //provisório
            
            $docxml = FilesFolders::readFile($xmlProt);           

            @$danfce = new Danfce($docxml, $pathLogo, 1);
            @$id = $danfce->monta();
            $pdf = $danfce->render();

            header('Content-Type: application/pdf');
            echo $pdf;
            
        }else{
            echo "
                <script>
                    alert('Nota Não Transmitida! Transmita antes de poder imprimir a DANFE');
                     window.location.href='../cadastra_venda_pos_form.php?id=".$_POST['id_nfe']."';
                </script>
            ";
            exit;
        }

    }else{
        
        
        //Descomentar - METODO PRINCIPAL
        if($xml[0]['transmitido_xml'] == 1){
            $xmlProt = "../nfephp/xmls/NF-e/" . TP_AMB_N ."/enviadas/aprovadas/".$data."/{$chave}-protNFE.xml";
        }else{
            $xmlProt = "../nfephp/xmls/NF-e/" . TP_AMB_N ."/entradas/$chave-nfe.xml";
        }
        //$xmlProt = "./xml/$chave-nfe.xml"; //provisório
        
        $docxml = FilesFolders::readFile($xmlProt);

        $danfe = new Danfe($docxml, 'P', 'A4', $pathLogo, 'I', '');
        $id = $danfe->montaDANFE();
        $pdf = $danfe->render();

        header('Content-Type: application/pdf');
        echo $pdf;           

    }
	

}else{
	echo "
		<script>
			alert('Nota Não Existente!');
			//window.location.href='../cadastra_venda_pos_form.php?id=".$_POST['id_nfe']."';
            window.history.back();
		</script>
	";
	exit;
}








