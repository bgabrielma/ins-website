<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	require_once("../../configura/config.php");
?>
<div class="coluna" style="width:100%;">
	<div class='box'>
		<div class='titulo preto'>
			DIGITE A DATA
		</div>
		<Div class='corpo'>
			<div class='item preto'>
				<span class='item'>INSIRA A DATA</span>
				<div class='input'>
					<div class='icone'>
						<i class='demo-icon icon-calendar-inv'></i>
					</div>
					<input type='text' id='data' name='data' placeholder='DD/MM/AAAA' onkeyup='mascaraData(this.value,"#"+this.id);'/>
				</div>
			</div>
		<div class='botao vermelho' onclick='admi.sem();'>VISUALIZAR AULAS</div></div></div>
	<div id="recebe">
	</div>
</div>
<div id="reqresults"></div>