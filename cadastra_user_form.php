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
        <a href="index_index.php" title="Titulo do Site">Home ERP</a>
      </h1>
      
      
      <input type="checkbox" id="control-nav" />
      <label for="control-nav" class="control-nav"></label>
      <label for="control-nav" class="control-nav-close"></label>

      <nav class="float-r">
      </nav>
      
      
    </header>
    
    <section id="cadastro">
    	
    	<p/><p/><p/><p/>
    	<form action="php/cadastra_user_mec.php" method="post" style="display: inline-block">
    		<label>
    			Cadastro de Usuário.
    			<br />
    			Para continuar, Informe os dados do 
    			<br />
    			usuário e a senha master do Administrador.
    		</label>
    		<p/>
	       	<div id="login">
	       		<div style="display: inline-block">
	       			<label>Nome:</label>
	       			<br />
	       			<label>Login:</label>
	       			<br />
	       			<label>Senha:</label>
	       			<br />
	       			<br />
	       			<label>Master:</label>
	       		</div>
	       		<div style="display: inline-block">
	       			<input type="text" name="nome" style="width: 280px" placeholder="Primeiro e último nomes do usuário" autofocus required/>
	       			<br />
	       			<input type="text" name="login" style="width: 280px" placeholder="nick que será usado para logar-se ao Sistema" required/>
	       			<br />
	       			<input type="password" name="senha" style="width: 280px" placeholder="Senha do usuário" required/>
	       			<br />
	       			<br />
	       			<input type="password" name="master" style="width: 280px" placeholder="Senha master" required/>
	       		</div>
	       	</div>
	   		<br />
	   		<button type="submit">Login</button>
        </form>	
   
    </section>       
  </body>  
</html>