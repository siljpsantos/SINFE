<?php

	@session_start(); 
	
	if ( isset( $_SESSION["tempo"] ) ) {
		 
		if ($_SESSION["tempo"] < time() ) {
			
			session_destroy();
			$_SESSION = array();
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			echo "<script type=\"text/javascript\">alert('Sessão expirada!');";
			//Redireciona para login
			echo "javascript:window.location='index_login.php?url=$actual_link';</script>";
		} else {
			//echo "<script type=\"text/javascript\">alert('Logado ainda!');</script>";
			//Seta mais tempo 60 segundos
			$_SESSION["tempo"] = time() + (60 * 20);
		}
	} else { 
		session_destroy();
		$log = 0;
		//Redireciona para login
		header("location:index_login.php");
	}

?>