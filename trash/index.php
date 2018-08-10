<?php

	//include "query's/conection.php";
	//include "query's/querys.php";
	
	//$select = jogadores_all($pdo);
	
	echo '<pre>';
	//print_r($select);
	echo '</pre>';


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<title>Votação</title>
	
	<meta name="author" content="Silvio José Pereira dos Santos" />
	<meta name="description" content="Grupo vila Rio." />
	<meta name="keywords"  content="grupo,vila,rio,site" />
	<meta name="Resource-type" content="Document" />
	
	<style>
	
		body {margin:0;}
		
		ul.topnav {
		  list-style-type: none;
		  margin: 0;
		  padding: 0;
		  overflow: hidden;
		  background-color: #333;
		}
		
		ul.topnav li {float: left;}
		
		ul.topnav li a {
		  display: inline-block;
		  color: #f2f2f2;
		  text-align: center;
		  padding: 14px 16px;
		  text-decoration: none;
		  transition: 0.3s;
		  font-size: 17px;
		}
		
		ul.topnav li a:hover {background-color: #555;}
		
		ul.topnav li.icon {display: none;}
		
		@media screen and (max-width:680px) {
		  ul.topnav li:not(:first-child) {display: none;}
		  ul.topnav li.icon {
		    float: right;
		    display: inline-block;
		  }
		}
		
		@media screen and (max-width:680px) {
		  ul.topnav.responsive {position: relative;}
		  ul.topnav.responsive li.icon {
		    position: absolute;
		    right: 0;
		    top: 0;
		  }
		  ul.topnav.responsive li {
		    float: none;
		    display: inline;
		  }
		  ul.topnav.responsive li a {
		    display: block;
		    text-align: left;
		  }
		}
		
	</style>
	
	<script>
	
		function myFunction() {
			var x = document.getElementById("myTopnav");
		    if (x.className === "topnav") {
		        x.className += " responsive";
		    } else {
		        x.className = "topnav";
		    }
		}
		
	</script>
	
</head>

<body>

	<nav>
		<ul class="topnav" id="myTopnav">
			
			<li><a class="active" href="#home">Escola 1</a></li>
			<li><a href="#news">Escola 2</a></li>
			<li><a href="#contact">Escola 3</a></li>
			<li><a href="#about">Escola 4</a></li>
		    <li class="icon">
				<a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">☰</a>
		    </li>
		    
		</ul>
	</nav>
	
</body>

</html>