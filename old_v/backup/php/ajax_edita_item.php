<?php

	include "conection.php";
	include "querys.php";
	
	$cfop = cfop($pdo);
	
	$produto = produto($pdo);
	$item = item_view_1($pdo,$_GET['id']);
		
	$info = $_GET;
	
	echo '<pre>';
	//print_r($produto_v);
	echo '</pre>';
	
	echo $_GET['id'];
	
	
?>

<input type="hidden" name="id_nfe" value="<?php echo $venda[0]['id_nfe'] ?>" />
		
	    		<label id="titulo" for="cliente">Item</label>
	    		<article id="itens" style="height: 500px !important;" class="grupo">
		    			
					<div class="item" style="padding-top: 12px;">
	    				<label class="item_titulo">Produto:</label>
						<select name="id_produto" >
							<option value=""></option>
							<?php foreach($produto as $key){ ?>
								<option value="<?php echo $key['id_produto']."|".number_format($key['valor_produto'], 2, '.', ''); ?>"><?php echo $key['descricao_produto'] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="item">
						<label class="item_titulo">Quantidade:</label>
						<input type="text" name="qtd_item" />
					</div>
					<div class="item">	
		    			<label class="item_titulo" for="cfop">CFOP: </label>
		    			<br />
		    			<select name="cfop" style="width: 180px">
		    				<option></option>
		    				<?php foreach($cfop as $index=>$key){ ?>
		    					<option value="<?php echo utf8_encode($key['id']) ?>"><?php echo utf8_encode($key['id']."-".substr($key['descricao'], 0, 110)."...") ?></option>
		    				<?php } ?>
		    			</select>
		    		</div>
		    		<br />
		    		<div class="item">
						<label class="item_titulo">Situação Tributária:</label>
						<select name="sit_trib" onchange="esconde();">
							<option value="101">101 - Tributada com permissão de crédito</option>
							<option value="102">102 - Ttibutada sem permissão de crédito</option>
							<option value="103">103 - Isenção do ICMS para faixa de recita bruta</option>
							<option value="201">201 - Tributada com permissão de crédito e com cobrança do ICMS por ST</option>
							<option value="202">202 - Tributada sem permissão de crédito e com cobrança do ICMS por ST</option>
							<option value="203">203 - Isenção do ICMS para faixa de recita bruta e com cobrança do ICMS por ST</option>
							<option value="300">300 - Imune</option>
							<option value="400">400 - Não tributada</option>
							<option value="500">500 - ICMS cobrado anteriormente por ST ou por antecipação</option>
							<option value="900">900 - Outros</option>
						</select>
					</div>
					<br />
					<div class="item">
						<label class="item_titulo">Origem:</label>
						<select name="origem">
							<option value="0">0 - Nacional, exceto as indicadas nos códigos 3,4,5 E 8</option>
							<option value="1">1 - Estrangeira - Importação Direta, exceto a indicada no código 6</option>
							<option value="2">2 - Estrangeira - Adiquirida no Mercado Interno, exceto a indicada no código 7</option>
							<option value="3">3 - Nacional, mercadoria ou bem com conteúdo de Importação superior a 40% e inferior ou igual a 70%</option>
							<option value="4">4 - Nacional, cuja produção tenha sido feia em conformidade com os processos produtivos básicos de que tratam as legislações citadas nos Ajustes</option>
							<option value="5">5 - Nacional, mercadoria ou bem com conteúdo de Importação inferior ou igual a 40%</option>
							<option value="6">6 - Estrangeira - Importação diretta, sem similar nacional, constante em lista da CAMEX e gás natural</option>
							<option value="7">7 - Estrangeira - Adquirida no mercado interno, sem similar nacional, constante em lista da CAMEX e gás natural</option>
						</select>
					</div>
					<br />
					<div id="div_bc">
						<div class="item">
							<label class="item_titulo">BC ICMS:</label>
							<input type="text" name="base_calc" value="<?php echo $item[0]['base_calc_icms'] ?>" />
						</div>
						<div class="item">
							<label class="item_titulo">alíquota aplicável de calc. de crédito:</label>
							<input type="text" name="aliq_calc_cred" />
						</div>
						<div class="item">
							<label class="item_titulo">Crédito do ICMS que pode ser aproveitado:</label>
							<input type="text" name="cred" />
						</div>
					</div>
					<!-- ICMS -->
					<div id="div_icms" class="item" style="margin: 0px">
						ICMS
						<br />
						<div class="item" style="border: 1px solid #333; padding: 10px 10px 0px 10px">
							<div class="item">
								<label class="item_titulo">Modalid. de determ. da BC ICMS:</label>
								<select name="modbc">
									<option value=""></option>
									<option value="0">0 - Margem Valor Agregado (%)</option>
									<option value="1">1 - Pauta (Valor)</option>
									<option value="2">2 - Preço Tabelado Máx. (Valor)</option>
									<option value="3">3 - Valor da operação</option>
								</select>
							</div>
							<br />
							<div class="item">
								<label class="item_titulo">% de redução da BC ICMS:</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="text" name="p_reducao_bc" />
							</div>
							<br />
							<div class="item">
								<label class="item_titulo">BC ICMS:</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="text" name="vbc" />
							</div>
							<br />
							<div class="item">
								<label class="item_titulo">Alíquota do ICMS:</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;
								<input type="text" name="aliq" />
							</div>
							<br />
							<div class="item">
								<label class="item_titulo">ICMS da Operação:</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;
								<input type="text" name="val_op" />
							</div>
							<br />
							<div class="item" style="visibility: hidden">
								<label class="item_titulo"></label>
								<input type="text"/>
							</div>
						</div>
					</div>
					<!-- ICMS ST -->
					<div id="div_icmsst" class="item" style="margin: 0px">
						ICMSST
						<br />
						<div class="item" style="border: 1px solid #333; padding: 10px 10px 0px 10px">
							<div class="item">
								<label class="item_titulo">Modalid. de determ. da BC ICMS:</label>
								&nbsp;&nbsp;&nbsp;
								<select name="modbcst">
									<option value=""></option>
									<option value="0">0 - Preço tabelado ou máximo sugerido</option>
									<option value="1">1 - Lista Negativa (Valor)</option>
									<option value="2">2 - Lista Positiva (Valor)</option>
									<option value="3">3 - Lista Neutra (Valor)</option>
									<option value="4">4 - Margem Valor Agregado (%)</option>
									<option value="5">5 - Pauta (Valor)</option>
								</select>
							</div>
							<br />
							<div class="item">
								<label class="item_titulo">% de redução da BC ICMS ST:</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="text" name="p_reducao_bcst" />
							</div>
							<br />
							<div class="item">
								<label class="item_titulo">% margem de valor adic. ICMS ST:</label>
								&nbsp;
								<input type="text" name="p_m_vast" />
							</div>
							<br />
							<div class="item">
								<label class="item_titulo">BC ICMS ST:</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="text" name="vbcst" />
							</div>
							<br />
							<div class="item">
								<label class="item_titulo">Alíquota do ICMS ST:</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;
								<input type="text" name="aliq_st" />
							</div>
							<br />
							<div class="item">
								<label class="item_titulo">ICMS ST:</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;
								<input type="text" name="val_st" />
							</div>
						</div>
					</div>
					<br />
					<div id="div_icmsret" class="item" style="margin: 0px">
						ICMS Retido
						<br />
						<div class="item" style="border: 1px solid #333; padding: 10px 10px 0px 10px">
							<div class="item">
								<label class="item_titulo">BC ICMS ST retido anteriormente:</label>
								<input type="text" name="vbc_ret_ant_st" />
							</div>
							<div class="item">
								<label class="item_titulo">ICMS ST retido anteriormente:</label>
								<input type="text" name="v_ret_ant_st" />
							</div>
						</div>
						</div>
					</div>
		    		
		    		<input type="submit" value="Adicionar" />
		    		<br />
		    			
	    		</article>