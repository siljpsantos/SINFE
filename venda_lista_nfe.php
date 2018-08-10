<?php
include "_app/Config.inc.php";

include "php/checa.php";

$select = emitente($pdo); //seleciona o emitente pricipal

$data = 0;
$mes = 0;
$doc = 0;

if (isset($_POST['data']) && $_POST['data'] != NULL) {
    $venda_all = venda_data_nfe($pdo, $_POST['data']); //seleciona vendas por data
    $data = 1;
} else {
    $venda_all = venda_all_nfe($pdo);
}

if ($data == 0) {
    if (isset($_POST['doc']) && $_POST['doc'] != NULL) {

        $select = $pdo->query("SELECT * FROM tab_cliente WHERE cpf_cnpj_cliente = '" . $_POST['doc'] . "' ");
        $select = $select->fetchAll();

        $venda_all = $pdo->query("SELECT * FROM tab_nfe WHERE id_cliente = '" . $select[0]['id_cliente'] . "' AND modelo_nfe = '55' ");

        $doc = 1;
    } else {
        $venda_all = venda_all_nfe($pdo);
    }
}

if ($data == 0 && $doc == 0) {

    if (isset($_POST['mes']) && $_POST['mes'] != NULL) {
        $venda_all = venda_mensal_nfe($pdo, $_POST['mes']); //seleciona todas as vendas do mes
    } else {
        $venda_all = venda_all_nfe($pdo);
    }
}
?>

<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
    <head>
        <title>SINFE - Sistema Emissor NFe/NFce</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />

        <meta name="description" content="See this example of responsive three highlights without using javascript. Using only html and css. by Palloi Hofmann">
        <meta name="keywords" content="css4html, css+for+html, css 4 html, css4, css4 html, css, css3, html, html5" />

        <meta property="og:image" content="http://palloi.github.io/responsive-header-only-css/assets/images/image-shared-2.png" />
        <meta property="og:keywords" content="css4html, css+for+html, css 4 html, css4, css4 html, css, css3, html, html5" />
        <meta name="description" content="See this example of responsive three highlights without using javascript. Using only html and css. by Palloi Hofmann">

        <!-- --------------------------------------------------------------------------------------- -->

        <link rel="stylesheet" type="text/css" href="css/ativos.css" />

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

        <!-- AJUSTA A IMPRESSÃO -->
        <style type="text/css" media="print">
            @page {
                size: auto;   /* auto is the initial value */
                margin: 0;  /* this affects the margin in the printer settings */
            }
        </style>


    </head>
    <!-- chamada do body e todo menu superior-->
<?php include "menu_links.php"; ?>

    <link rel="stylesheet" type="text/css" href="js/tema/style.css" />
    <script type="text/javascript" src="js/tabela/jquery-latest.js"></script>
    <script type="text/javascript" src="js/tabela/jquery.tablesorter.js"></script> 

    <script>
        $(document).ready(function ()
        {
            $("#lista").tablesorter();
            //$("#lista").tablesorter( {sortList: [[0,0]]} );  

            $('#inutil').hide();
        }
        );
    </script>

    <section id="cadastro">

        <center>
            <div class="panel panel-default corpo">
                <div style="font-size: 14pt" class="panel-heading">
                </div>
                <div class="panel-body">
                    <form style="position: relative; float: left" action="venda_lista_nfe.php" method="post" >
                        <div id="search">
                            <span>
                                Pesquisa por data de emissão dd/mm/aaaa:
                            </span>
                            <input class="form-control" type="date" name="data" id="pesquisa_2" placeholder="Pesquisa de vendas" autofocus />
                            <input type="submit" style="position: absolute; left: -9999px"/>
                        </div>
                    </form>
                    <form style="position: relative; float: left" action="venda_lista_nfe.php" id="form_mes" method="post">
                        <div id="search">
                            <span>
                                Por mês de emissão:
                            </span>
                            <select class="form-control" onchange="$('#form_mes').submit();" style="border: 0; width: auto" name="mes" id="pesquisa_2"/>
                            <option></option>
<?= MES_OPT_REL ?>
                            </select>
                            <input type="submit" style="position: absolute; left: -9999px"/>
                        </div>
                    </form>
                    <form style="position: relative; float: left" action="venda_lista_nfe.php" method="post">
                        <div id="search">
                            <span>
                                Por CPF/CNPJ do Dest.:
                            </span>
                            <input class="form-control" type="text" name="doc" id="pesquisa_3" placeholder="Pesquisa de vendas"/>
                            <input type="submit" style="position: absolute; left: -9999px"/>
                        </div>
                    </form>
                    <br /><br /><br />
                    <form style="position: relative; float: left" method="POST" action="php/exporta_xml_massa_nfe.php">
                        <input name="mes" type="hidden" value="<?php if (isset($_POST['mes']) && $_POST['mes'] != NULL) {
    echo $_POST['mes'];
} else {
    echo date('m/Y');
} ?>" />
                        <button class="btn btn-default" type="submit">Exportar XMLS do mês selecionado acima ou o mês atual</button>
                    </form>
                </div>
            </div>
        </center>
        <br />

        <center>
            <span>
                <a href="cadastra_venda_pre_nfe_form.php" class="btn btn-success btn-block" style="width: 1200px">Emitir Nota</a>
            </span>
        </center>

        <br />

        <div class="corpo_venda" style="height: 400px; width: 1205px; overflow: auto;">

            <table id="lista" class="tablesorter">
                <thead>
                    <tr id="lista_titulo" style="text-align: center">
                        <th style="width: 40px">
                            N°
                        </th>
                        <th style="width: 200px">
                            Status da Venda
                        </th>
                        <th style="width: 200px;">
                            Data de Emissão
                        </th>
                        <th style="width: 200px">
                            CNPJ do Dest.
                        </th>
                        <th style="width: 200px">
                            Valor total
                        </th>
                        <td style="width: 100px">

                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php $cont = 0;
                    foreach ($venda_all as $index => $key) { ?>

                        <?php
                        //echo $cont+=1;
                        $xml = xml_venda($pdo, $key['id_nfe']);

                        if ($xml != array()) {

                            $xml_1 = simplexml_load_string($xml[0]['conteudo_xml']);
                            //print_r($xml_1);
                            if ($xml[0]['transmitido_xml'] != 0) {

                                @$num = $xml_1->NFe->infNFe->ide->nNF;

                                if (@$xml_1->NFe->infNFe->dest->CNPJ != 0) {
                                    @$cnpj_cpf = $xml_1->NFe->infNFe->dest->CNPJ;
                                } else {
                                    @$cnpj_cpf = $xml_1->NFe->infNFe->dest->CPF;
                                }

                                $sit = "autorizada";
                            } else {
                                @$num = $xml_1->infNFe->ide->nNF;

                                if (@$xml_1->infNFe->dest->CNPJ != 0) {
                                    @$cnpj_cpf = $xml_1->infNFe->dest->CNPJ;
                                } else {
                                    @$cnpj_cpf = $xml_1->infNFe->dest->CPF;
                                }
                            }


                            if ($xml[0]['inutilizado_xml'] != 0) {
                                $sit = "inutilizada";
                            } else if ($xml[0]['cancelado_xml'] != 0) {
                                $sit = "cancelada";
                            } else if ($xml[0]['rejeitado_xml'] != 0) {
                                $sit = "rejeitada";
                            } else if ($xml[0]['transmitido_xml'] != 0) {
                                $sit = "autorizada";
                            } else if ($xml[0]['valido_xml'] != 0) {
                                $sit = "validada";
                            } else if ($xml[0]['assinado_xml'] != 0) {
                                $sit = "assinada";
                            } else {
                                $sit = "em digitação";
                            }
                        } else {

                            $num = 'X';

                            $doc = $pdo->query("SELECT * FROM tab_cliente WHERE id_cliente = '" . $key['id_cliente'] . "' ");
                            $doc = $doc->fetchAll();

                            @$cnpj_cpf = $doc[0]['cpf_cnpj_cliente'];

                            $sit = "em digitação";
                        }
                        ?>

                        <tr id="lista_content">
                            <td>
                                <?php echo $num ?>
                            </td>
                            <td>
                                <?php echo $sit ?>
                            </td>
                            <td>
                                <?php
                                $data_tmp = explode(" ", $key['data_emis_nfe']);
                                $data_fin = implode("/", array_reverse(explode("-", $data_tmp[0])));
                                echo $data_fin . " às " . $data_tmp[1];
                                ?>
                            </td>
                            <td>
                                <?php echo $cnpj_cpf ?>
                            </td>
                            <td>
                                R$<?php echo number_format($key['val_total_nfe'], 2, ',', '.'); ?>
                            </td>
                            <td>
                                <form action="cadastra_venda_pos_nfe_form.php" method="get">
                                    <input type="hidden" name="id" value="<?php echo $key['id_nfe'] ?>" />
                                    <button type="submit">Vizualizar</button>
                                </form>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>

            </table>
        </div> 

        <br /><br />

        <!--         INUTILIZAÇÃO          -->
        <center>
            <div class="panel panel-default corpo">
                <div style="font-size: 14pt" class="panel-heading">
                    Inutilização de N°s -
                    <a href="javascript:void(0);" onclick="$('#inutil').slideToggle(600);">+</a>
                    /
                    <a href="javascript:void(0);" onclick="$('#inutil').slideToggle(600);">-</a>
                </div>
                <div class="panel-body">
                    <article id="inutil">
                        <form id="cancelamento" method="post" action="php/inutiliza nfe.php">
                            <div class="item">
                                <label class="item_titulo">Início da faixa: </label>
                                <br />
                                <input class="form-control" type="text" name="ini" style="width: 150px; min-width: 92px;" />
                            </div>
                            <div class="item">
                                <label class="item_titulo">Final da faixa: </label>
                                <br />
                                <input class="form-control" type="text" name="fin" style="width: 150px; min-width: 92px;" />
                            </div>
                            <br />
                            <div class="item" id="load_cidades_3">
                                <textarea class="form-control" placeholder="Motivo aqui." cols="80" rows="5" name="motivo"></textarea>
                            </div>
                            <input type="hidden" name="modelo" value="55" />
                            <br />
                            <button class="btn btn-sinfe-1 btn-block" type="submit" onclick="cancela_nfe();">Inutilizar</button>
                        </form>
                    </article>
                </div>
            </div>
        </center>

    </section>       
</body>  
</html>
