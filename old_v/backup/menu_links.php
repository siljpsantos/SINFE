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

<body onLoad="initTimer();">

<header id="topo_menu">
  <h1 class="float-l">
	<a href="index_index.php" title="Titulo do Site">Home</a>
  </h1>

  <nav class="float-r">

	<ul class="list-auto">
		<li>
			<a><span id="timer"><?php echo date("H:i:s", time()-(3600*3)); ?></span></a>
		</li>
		<li>
			<a href="Relatorio_lista.php">Relatórios</a>
		</li>
		<li>
			<a href="venda_lista_nfe.php">Gerenciar NFe</a>
		</li>
		<!--
		<li>
	<a href="venda_lista_nfce.php">Gerenciar NFce</a>
</li>
		-->
		<li>
			<a href="cliente_lista.php">Clientes</a>
		</li>
		<li>
			<a href="produto_lista.php">Produtos</a>
		</li>
		
		<li>
			<a href="ordem_lista.php">Ordens de Serviço</a>
		</li>
		
		<li>
			<a href="transp_lista.php">Transportadoras</a>
		</li>
		<li>
			<a href="config.php">
				<img src="assets/images/config.png" style="width: 25px; height: 25px; "/>
			</a>
		</li>
		<li>
			<a href="php/logout.php">Sair</a>
		</li>
	  </ul>
	</nav>
  
  
</header>    




