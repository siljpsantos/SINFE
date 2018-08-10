<?php
	
	include "_app/Config.inc.php";

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

    <link rel="stylesheet" type="text/css" href="css/css_section.css" />
    <link rel="stylesheet" type="text/css" href="css/css_menu.css" />
    <link rel="stylesheet" type="text/css" href="css/ativos.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    
	<style type="text/css" media="all">
		
		.corpo-in{
			transition: all 0.3s ease !important;
		}
		.corpo-in:hover{
			background: #172b4c !important;
			color: #fff !important;
		}
	</style>
 
	</head>
	<!-- chamada do body e todo menu superior-->
	<?php include "menu_links.php";?>
	
	<br /><br />
	<br /><br />
	
	<center>
        <div class="panel panel-default corpo">
            <div style="font-size: 14pt" class="panel-heading">
                Relatórios
            </div>
            <div class="panel-body">
                <center>
                    <a style="text-decoration: none; color: #000;" href="relatorio_lista.php"> 
                        <div class="panel panel-sinfe-1 corpo-in">
                            <div style="font-size: 14pt;" class="panel-heading">
                                <center>Notas Fiscais</center>
                            </div>
                        </div>
                    </a>

                    <a style="text-decoration: none; color: #000;" href="relatorio_ordem.php"> 
                        <div class="panel panel-sinfe-1 corpo-in">
                            <div style="font-size: 14pt;" class="panel-heading">
                                <center>Todas as Ordens</center>
                            </div>
                        </div>
                    </a>

                    <a style="text-decoration: none; color: #fff;" href="relatorio_ordem_open.php">
                         <div class="panel panel-info corpo-in-med">
                            <div style="font-size: 14pt;" class="panel-heading">
                                <center>Ordens Abertas</center>
                            </div>
                        </div>
                    </a>

                    <a style="text-decoration: none; color: #fff;" href="relatorio_ordem_closed.php">
                         <div class="panel panel-info corpo-in-med">
                            <div style="font-size: 14pt;" class="panel-heading">
                                <center>Ordens Fechadas</center>
                            </div>
                        </div>
                    </a>
                </center>
            </div>
        </div>
	</center>
	   
	</body>  
</html>






