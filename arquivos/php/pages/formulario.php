<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	require_once("../../configura/config.php");
?>
<div id="recebe" class="coluna" style="width:0px">
</div> 
<div id="lista" class="coluna" style="width:100%;">
	<div class="botaos azul2" onclick="form.formulario('1');">FORMULÁRIO DE AULAS</div>
	<?php if($dadosCargo['nvhie'] == 3 Or $dadosCargo['nvhie'] >= 5) { ?>
		<div class="botaos azul2" onclick="form.formulario('2');">FORMULÁRIO DE CFI</div>
	<?php } ?>
	<?php if($dadosCargo['nvhie'] == 4 Or $dadosCargo['nvhie'] >= 5) { ?>
		<div class="botaos azul2" onclick="form.formulario('3');">FORMULÁRIO DE AVALIAÇÃO</div>
	<?php } ?>
	<?php if($dadosCargo['nvhie'] == 5 Or $dadosCargo['nvhie'] >= 5) { ?>
		<div class="botaos azul2" onclick="form.formulario('4');">FORMULÁRIO DE CAPACITAÇÃO</div>
	<?php } ?>
	<?php if($dadosCargo['nvhie'] == 11) { ?>
		<div class="botaos azul2" onclick="form.formulario('6');">FORMULÁRIO DE ADMISSÃO</div>
	<?php } ?>
</div>
<div id="reqresults"></div>