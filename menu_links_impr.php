<script>
 function showTimer() {
  var time=new Date();
  var hour=time.getHours();
  var minute=time.getMinutes();
  var second=time.getSeconds();
  if(hour<10)   hour  ="0"+hour;
  if(minute<10) minute="0"+minute;
  if(second<10) second="0"+second;
  var st=hour+":"+minute+":"+second;
  document.getElementById("timer").innerHTML=st; 
 }
 function initTimer() {
  setInterval(showTimer,1000);
 }
</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
<script src="bootstrap/bootstrap.min.js"></script>

<body style="background: #D7DDEC" onLoad="initTimer();">
	
<nav class="navbar navbar-default navbar-fixed-top">
<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<ul class="nav navbar-nav" id="logo_menu">
			<li>
                <a href="index_index.php" class="pull-left navbar-brand">&nbsp;<img class="nav_logo" src="imgs/logosinfe.png" /></a>
			</li>
		</ul>
	</div>
	<div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-left" id="bs-example-navbar-collapse-1">
            <li>
                <a href="javascript:self.print()">Imprimir</a>
            </li>
            <li>
                <a href="php/fecha_ordem.php?id=<?php echo $ordem[0]['id_ordem'] ?>" onclick="return confirm('Realmente deseja fechar a ordem?')">Fechar a SOT</a>
            </li>            
		</ul>

		<ul class="nav navbar-nav navbar-right" id="bs-example-navbar-collapse-1">
			<li>
			<a><span id="timer"><?php echo date("H:i:s", time()-(3600*5)); ?></span></a>
            </li>
            <!--
            <li>
                <a href="Index_rel.php">Relatórios</a>
            </li>
            -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Relatórios
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="relatorio_lista.php">NFE/NFCe</a></li>
<!--                    <li><a href="relatorio_ordem.php">ORDEM - Todas</a></li>
                    <li><a href="relatorio_ordem_open.php">ORDEM - Abertas</a></li>
                    <li><a href="relatorio_ordem_closed.php">ORDEM - Fechadas</a></li>-->
                </ul>
           </li>
            <li>
                <a href="venda_lista_nfe.php">Gerenciar NFe</a>
            </li>
            <li>
                <a href="venda_lista_nfce.php">Gerenciar NFce</a>
            </li>
            <li>
                <a href="cliente_lista.php">Clientes</a>
            </li>
            <li>
                <a href="produto_lista.php">Produtos</a>
            </li>
<!--
            <li>
                <a href="ordem_lista.php">Ordens de Serviço</a>
            </li>-->

            <li>
                <a href="transp_lista.php">Transportadoras</a>
            </li>
            <li>
                <a href="config.php">
                    <img src="assets/images/config_2.png" style="width: 25px; height: 25px; "/>
                </a>
            </li>
            <li>
                <a href="php/logout.php">Sair</a>
            </li>
		</ul>
	</div>
</div>
</nav>



