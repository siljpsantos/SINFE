<?php

	session_start();
	
	if(!isset($_SESSION['user'])){
		$log = 0;
		header("location: index_login.php?log=".$log);
	}else{
		$sessao = 1;
	}
	

?>