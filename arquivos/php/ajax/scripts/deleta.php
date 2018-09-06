<?php
	require_once("../../../configura/config.php");
	$id = $_POST['id'];
	$mysqli->query("DELETE FROM scripts WHERE id='$id'");
?>
<div id="results">
	<div class="box">
		<div class="titulo verde">
			SCRIPT EXCLUÍDO!
			<div class="icone" style="cursor:pointer;" onclick="fechar('gerenciascr');"><i class="demo-icon icon-cancel-6"></i></div>
		</div>
		<div class="corpo">
			O SCRIPT FOI EXCLUÍDO COM SUCESSO!
		</div>
	</div>
</div>