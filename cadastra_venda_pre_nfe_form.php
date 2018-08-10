<?php

	include "_app/Config.inc.php";
	
	include "php/checa.php";
	
	$emitente = emitente($pdo);
	
?>
<!DOCTYPE html>
<html>
  <head>
    <title>SINFE - Sistema Emissor NFe/NFce</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />
    
    <link rel="stylesheet" type="text/css" href="css/ativos.css" />
     
  </head>
  <!-- chamada do body e todo menu superior-->
  <?php include "menu_links.php";?>
    
    <section id="cadastro">
    	
        <center>
            
            <div class="panel panel-default corpo">
                <div style="font-size: 14pt" class="panel-heading">
                    Dados da nota
                </div>
                <div class="panel-body">

                    <form action="php/cadastra_venda_pre_nfe_mec.php" method="post" class="form form-inline" >

                        <?php date_default_timezone_set('America/Sao_Paulo');  ?>

                        <div class="item">
                            <span>*Natureza da Operação: </span>
                            <br />
                            <input class="form-control" type="text" name="nop" style="width: 250px">
                        </div>
                        <div class="item">
                            <span class="item_titulo">Número: </span>
                            <br />
                            <span>?</span>
                        </div>
                        <div class="item">
                            <span class="item_titulo">Modelo:</span>
                            <br />
                            <select class="form-control" name="modelo" style="width: 120px">
                                <option <?php if($emitente[0]['padrao_emis_emitente']=="55"){ echo "selected"; } ?> value="55">55 - NFe</option>
<!--                                <option <?php if($emitente[0]['padrao_emis_emitente']=="65"){ echo "selected"; } ?> value="65">65 - NFCe</option>-->
                            </select>	
                        </div>
                        <div class="item">
                            <span class="item_titulo">Série:</span>
                            <br />
                            <span>?</span>
                        </div>
                        <div class="item">
                            <span class="item_titulo">Data Emiss.:</span>
                            <br />
                            <input class="form-control i-data" type="text" name="data_emis" value="<?php echo date("d/m/Y") ?>" style="width: 100px" />
                        </div>
                        <div class="item">
                            <span class="item_titulo">Data Estrada/Saída: </span>
                            <br />
                            <input class="form-control i-data" type="text" name="data_saida_entrada" value="<?php echo date("d/m/Y") ?>" style="width: 100px" />
                        </div>
                        <div class="item">
                            <span class="item_titulo">Hora Estrada/Saída: </span>
                            <br />
                            <label><?php echo date("H:i:s") ?></label>
                            <input type="hidden" name="hora_saida_entrada" value="<?php echo date("H:i:s") ?>" />
                        </div>

                        <button class="btn btn-default btn-block" type="submit">Avançar</button>
                        
                    </form>
    	
                </div>
            </div>
                
        </center>
    	
    </section>
        
  </body>
  
</html>
