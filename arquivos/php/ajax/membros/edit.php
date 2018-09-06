<?php
	require_once("../../../configura/config.php");
	$id = $_POST['id'];
	$nick = $_POST['nick'];
	$tag = $_POST['tag'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];

	if($nick == "") {
		$erroNick = "Selecione o nick do usuário.<br>";
	}else {
		$checa = $mysqli->query("SELECT * FROM usuarios WHERE nick='$nick' AND id!=$id")->num_rows;
		if($checa != 0) {
			$erroNick = "Nick já está em uso.<Br>";
		}
	}

	if($tag == "") {
		$erroTag = "Insira a TAG do usuário.<br>";
	}else {
		$checat = $mysqli->query("SELECT * FROM usuarios WHERE tag='$tag' AND id!=$id")->num_rows;
		if($checat != 0) {
			$erroTag = "TAG já está em uso.<br>";
		}
	}

	if($email == "") {
		$erroEmail = "Insira o email do usuário.<br>";
	}else {
		$checae = $mysqli->query("SELECT * FROM usuarios WHERE email='$email' AND id!=$id")->num_rows;
		if($checae != 0) {
			$erroEmail = "E-mail já está em uso.<br>";
		}
	}

	if($senha == "") {
		$erroSenha = "Insira uma senha de acesso para o usuário.<br>";
	}else {
		$checas = $mysqli->query("SELECT * FROM usuarios WHERE id='$id'")->fetch_array();
		if($checas['senha'] != $senha) {
			$novasenha = hash('sha512', $senha);
		}else {
			$novasenha = $checas['senha'];
		}
	}

	if(isset($erroNick) OR isset($erroEmail) OR isset($erroSenha) OR isset($erroTag)) {
		?>
			<div class="box">
				<div class="titulo vermelho">
					ERROS ENCONTRADOS
					<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
				</div>
				<div class="corpo">
					<?php echo $erroNick.$erroEmail.$erroTag.$erroSenha; ?>
				</div>
			</div>
		<?php
	}else {
		$mysqli->query("UPDATE usuarios SET nick='$nick', tag='$tag', email='$email', senha='$novasenha' WHERE id='$id'");
		?>
			<div class="box">
				<div class="titulo verde">
					EDIÇÃO CONCLUÍDA
					<div class="icone" style="cursor:pointer;" onclick="fechar('gerenciarmembros');"><i class="demo-icon icon-cancel-6"></i></div>
				</div>
				<div class="corpo">
					As edições feitas no usuário foram salvas.
				</div>
			</div>
		<?php
	}
?>