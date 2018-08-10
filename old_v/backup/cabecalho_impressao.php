<?php
	//include "php/conection.php";
	//include "php/querys.php";
	
	//include "php/checa.php";
	
	
	
	$select = emitente($pdo); //seleciona o emitente pricipal
	
	
?>
<link rel="stylesheet" type="text/css" href="css/css_section.css" />
<link rel="stylesheet" type="text/css" href="css/css_menu.css" />

<link rel="stylesheet" type="text/css" href="css/ativos.css" />
    
<style type="text/css" media="all">

	#titulo_form{
		display: static;
		background: #ddd;
	}

</style>    

<table id="titulo_form">
	<tr>
		<td class="topo">
			<?php echo '<img src="'.$select[0]['logo_emitente'].'" style="width: 350px" />' ?>
		</td>
		<td class="topo">
			CNPJ: <?php echo $select[0]['cnpj_emitente'] ?>
			<br />
			INSC.MUN: <?php echo $select[0]['inscricao_municipal_emitente'] ?>
			<br />
			<br />
			TEL.: <?php echo $select[0]['telefone_emitente'] ?>
		</td>
		<td class="topo">
			<?php echo $select[0]['nome_razao_social_emitente'] ?>
			<br /><br />
			ENDEREÇO: <?php echo $select[0]['logradouro_emitente']," N°",$select[0]['numero_emitente'],
								" ",$select[0]['complemento_emitente'],", ",$select[0]['bairro_emitente'],
								", ",$select[0]['municipio_emitente']," - ",$select[0]['uf_emitente']
						?>
			<br />
		</td>
	</tr>
</table>