<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require "../_app/Config.inc.php";
require "../nfephp/vendor/autoload.php";

use NFePHP\DA\NFe\Dacce;
use NFePHP\DA\Legacy\FilesFolders;

//recupera cce
$cce = $pdo->query('SELECT * FROM tab_cce WHERE id_cce = ' . $_POST['id'] .' ');
$cce = $cce->fetchAll();

//infos da config.inc
$aEnd = $info_cce;

//path da logo
$pathLogo = "..\/nfephp\/images\/logo.jpg";

//xml da CCE
$xml = "../xml_o/cce/".$cce[0]['chave_nfe_cce']."-cce-".$cce[0]['num_seq_cce'].".xml";

//catch de erros
try {
    
    $docxml = FilesFolders::readFile($xml);

    $dacce = new Dacce($docxml, 'P', 'A4', $pathLogo, 'I', $aEnd);
    $id = $dacce->chNFe . '-CCE';
    $teste = $dacce->printDACCE($id.'.pdf', 'I');
    
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
} catch (RuntimeException $e) {
    echo $e->getMessage();
}