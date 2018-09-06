<?php
	require_once("../../../configura/config.php");
	$id = $_POST['id'];
	$passagem = $mysqli->query("SELECT * FROM usuarios WHERE id='$id'")->fetch_array();
	$passage = $passagem['passagem'];
	$pass = $passage+1;
	$data = date('d/m/Y');
	$mysqli->query("UPDATE usuarios SET ativo='1', passagem='$pass', entrada='$data' WHERE id='$id'");
?>
<div class="box">
				<div class="titulo verde">
					MEMBRO ATIVADO
					<div class="icone" style="cursor:pointer;" onclick="fechar('ativarmembros');"><i class="demo-icon icon-cancel-6"></i></div>
				</div>
				<div class="corpo">
					O membro em questão foi ativado.
				</div>
			</div>