<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	require_once("../../configura/config.php");
?>
<div class="coluna" style="width:100%;">
	<div class="box">
		<div class="titulo preto">SEMANAL OU MENSAL?</div>
		<div class="corpo">
			<table style="width:100%;">
				<tr>
					<td><div class="botao verde2" style="text-align:center;" onclick="aulas.semanal();">SEMANAL</div></td>
					<td><div class="botao azul2" style="text-align:center;" onclick="aulas.mensal();">MENSAL</div></td>
				</tr>
			</table>
		</div>
	</div>
	<div id="recebe">
	</div>
	<div id="recebe2">
	</div>
</div>
<div id="reqresults"></div>