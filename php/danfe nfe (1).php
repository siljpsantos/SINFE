<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../nfephp/bootstrap.php';

include "../_app/Config.Inc.php";

use NFePHP\NFe\ToolsNFe;
use NFePHP\Extras\Danfe;
use NFePHP\Extras\Danfce;
use NFePHP\Common\Files\FilesFolders;

$nfe = new ToolsNFe('../nfephp/config/config.json');

$venda = venda_view_1($pdo,$_POST['id_nfe']);

$xml = xml_venda($pdo,$_POST['id_nfe']);
@$chave = $xml[0]['chave_xml'];

@$xml_1 = simplexml_load_string($xml[0]['conteudo_xml']);

@$data = explode('-',$xml_1->NFe->infNFe->ide->dhEmi);
@$data = $data[0].$data[1];

//----------------nota não existente
if($xml != array()){

    if($venda[0]['modelo_nfe']=='65'){

        //----------------nota não transmitida
        if($xml[0]['transmitido_xml'] == 1){
            $saida = isset($_REQUEST['o']) ? $_REQUEST['o'] : 'pdf'; //pdf ou html

            $ecoNFCe = false; //false = Não (NFC-e Completa); true = Sim (NFC-e Simplificada)
            $xmlProt = "../nfephp/xmls/NF-e/" . TP_AMB_N ."/enviadas/aprovadas/".$data."/{$chave}-protNFe.xml";
            // Uso da nomeclatura '-danfce.pdf' para facilitar a diferenciação entre PDFs DANFE e DANFCE salvos na mesma pasta...
            $pdfDanfe = "../nfephp/xmls/NF-e/" . TP_AMB_N ."/pdf/".$data."/{$chave}-danfce.pdf";

            //$pathLogo = "C:\/Users\/recepcaoiw\/Google Drive\/root\/ERP\/nfephp\/images\/logo.jpg";
            $pathLogo = "..\/nfephp\/images\/logo.jpg";

            $docxml = FilesFolders::readFile($xmlProt);
            $danfce = new Danfce($docxml, $pathLogo, 2);
            $id = $danfce->montaDANFCE($ecoNFCe);
            $salva = $danfce->printDANFCE('html', $pdfDanfe, 'F'); //Salva na pasta pdf
            $abre = $danfce->printDANFCE($saida, $pdfDanfe, 'I'); //Abre na tela
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

        if($xml[0]['transmitido_xml'] == 1){
            $xmlProt = "../nfephp/xmls/NF-e/" . TP_AMB_N ."/enviadas/aprovadas/".$data."/{$chave}-protNFE.xml";
        }else{
            $xmlProt = "../nfephp/xmls/NF-e/" . TP_AMB_N ."/entradas/$chave-nfe.xml";
        }
        // Uso da nomeclatura '-danfe.pdf' para facilitar a diferenciação entre PDFs DANFE e DANFCE salvos na mesma pasta...
        $pdfDanfe = "../nfephp/xmls/NF-e/" . TP_AMB_N ."/pdf/{$chave}-danfe.pdf";
        
        $pathLogo = "..\/nfephp\/images\/logo.jpg";
        
        $docxml = FilesFolders::readFile($xmlProt);
        //@$danfe = new Danfe($docxml, 'P', 'A4', $nfe->aConfig['aDocFormat']->pathLogoFile, 'I', '');
        @$danfe = new Danfe($docxml, 'P', 'A4', $pathLogo, 'I', '');
        $id = $danfe->montaDANFE();
        $salva = $danfe->printDANFE($pdfDanfe, 'F'); //Salva o PDF na pasta
        $abre = $danfe->printDANFE("{$id}-danfe.pdf", 'I'); //Abre o PDF no Navegador

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








