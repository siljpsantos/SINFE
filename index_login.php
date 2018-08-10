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
    
    <link rel="stylesheet" type="text/css" href="css/ativos.css" />
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
    <script src="bootstrap/bootstrap.min.js"></script>
	
	<style type="text/css" media="all">
		#login{
			text-align: left;
			padding: 10px;
			border: 1px dashed #333;
		}
	</style>
   
  </head>
  <body style="background: #D7DDEC">
  
    <header>
      
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
                        <a href="#" class="pull-left navbar-brand">&nbsp;<img class="nav_logo" src="imgs/logosinfe.png" /></a>
                    </li>
                </ul>
            </div>
        </nav>
      
    </header>
    
    <section id="cadastro">
    	<p/><p/><p/><p/>
        <center>
            <div class="panel panel-default" style="width: 400px">
                <div style="font-size: 14pt" class="panel-heading">
                    Login
                </div>
                <div class="panel-body">
                    <form class="form form-inline" action="php/login.php" method="post" style="display: inline-block">
                        <input type="hidden" name="url" value="<?= isset($_GET) ? (isset($_GET['url']) ? $_GET['url'] : '' ) : ''  ?>" />
                        <div>
                            <div style="display: inline-block; width: 100px">
                                <span>Login:</span>
                                <br />
                                <br />
                                <span>Senha:</span>
                            </div>
                            <div style="display: inline-block">
                                <input class="form-control" type="text" name="login" style="width: 220px; margin-bottom: -8px;" autofocus/>
                                <br />
                                <br />
                                <input class="form-control" type="password" name="senha" style="width: 220px" />
                            </div>
                        </div>
                        <br />
                        <button type="submit" class="btn btn-info btn-block">Login</button>
                    </form>	
                </div>
            </div>
        </center>
    </section>   
    
  </body>  
</html>
