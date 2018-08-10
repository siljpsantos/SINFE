<?php

	if(isset($_SESSION['user'])){
		header("location: cliente_lista.php");
	}
    
	if(isset($_GET['resp'])){
		
		if($_GET['resp'] == 0){
			
			echo "<script type=\"text/javascript\">alert('Usuário eu Senha Incorretos.');</script>";
		 
		} 
	} 
	
	if(isset($_GET['log'])){
		
		if($_GET['log'] == 0){
			
			echo "<script type=\"text/javascript\">alert('Efetue login para usar o Sistema.');</script>";
		 
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

    <link rel="stylesheet" type="text/css" href="css/css_section.css" />
    <link rel="stylesheet" type="text/css" href="css/css_menu.css" />
    
    <link rel="stylesheet" type="text/css" href="css/ativos.css" />
    
    <!-- AJUSTA A IMPRESSÃO -->
    <style type="text/css" media="print">
		@page {
		    size: auto;   /* auto is the initial value */
		    margin: 0;  /* this affects the margin in the printer settings */
		}
	</style>
	
	<style type="text/css" media="all">
		#login{
			text-align: left;
			padding: 10px;
			border: 1px dashed #333;
		}
	</style>
   
  </head>
  <body>
  
    <header>
      <h1 class="float-l">
        <a href="#" title="Titulo do Site">SINFE - Sistema Emissor NFe/NFce</a>
      </h1>
      
      
      <input type="checkbox" id="control-nav" />
      <label for="control-nav" class="control-nav"></label>
      <label for="control-nav" class="control-nav-close"></label>

      <nav class="float-r">
      	<!--
      	<ul class="list-auto">
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
       </ul>
       -->
      </nav>
      
      
    </header>
    
    <section id="cadastro">
    	<p/><p/><p/><p/>
    	<form action="php/login.php" method="post" style="display: inline-block">
    			Bem vindo(a) ao Sistema!
    			<br />
    			Para continuar, por favor efetue login:
    		</label>
    		<p/>
	       	<div id="login" style="padding: 25px">
	       		<div style="display: inline-block">

	       			<label>Login:</label>
	       			<br />
                    <br />
	       			<label>Senha:</label>
	       		</div>
	       		<div style="display: inline-block">
	       			<input type="text" name="login" style="width: 220px" autofocus/>
	       			<br />
                    <br />
	       			<input type="password" name="senha" style="width: 220px" />
	       		</div>
	       	</div>
	   		<br />
	   		<button type="submit" class="css_btn_class">Login</button>
        </form>	
        <p/>
        
        
        <i>
	        
    	</i>
    </section>   
    
  </body>  
</html>
