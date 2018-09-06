<?php
	require_once("../../../configura/config.php");
	$alerta = $_POST['alerta'];
	$comentario = $_POST['comentario'];
	if($comentario == "") {
		$erroComentario = "Para comentar algo, você deve escrever algo.";
	}

	if(isset($erroComentario)) {
		?>
			<div class="box">
				<div class="titulo vermelho">
					ERROS ENCONTRADOS
					<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
				</div>
				<div class="corpo">
					<?php echo $erroComentario; ?>
				</div>
			</div>
		<?php
	}else {
		$data = date('d/m/Y')." às ".date('H:i');
		$mysqli->query("INSERT INTO comentarios (id,autor_id,alerta_id,data,conteudo) VALUES('','".$dadosUsu['id']."','$alerta','$data','$comentario')");
		?>
			<div class="box">
				<div class="titulo verde">
					Comentário enviado.
					<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
				</div>
				<div class="corpo">
					Seu comentário foi enviado. Parabéns.<script>comentarios.atualizar('<?php echo $alerta; ?>');</script>
				</div>
			</div>
		<?php
	}
?>