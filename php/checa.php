<?php

	include "checa_login.php";
	
	//checa se o checa a checagem de login retornou verdadeiro
	if(isset($sessao)){
		
		if($sessao == 1){
			
			include "checa_tempo.php";
			
		}
		
	}

?>