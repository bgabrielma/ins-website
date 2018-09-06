<?php
	require_once("../../configura/config.php");
	if($_SESSION['logado'] != 5) {
		$nick = @$_POST['nick'];
		$senha = $_POST['senha'];
		$endereco = $_POST['endereco'];
		$enick = NULL;
		$esenha = NULL;
		$checado = $_POST['checado'];
		if($nick == NULL) {
			$enick = 1;
			$mensagemn = "- Insira o nick igual ao do Habbo Hotel.<br>";
		}

		if($senha == NULL) {
			$esenha = 1;
			$mensagems = "- Insira a senha de login.<br>";
		}

		if($enick ==1 || $esenha == 1) {
			echo"Erros encontrados:<br>".$mensagemn.$mensagems.$mensageme;
		}else {
			$checanome = $mysqli->query("SELECT * FROM usuarios WHERE nick='$nick' AND ativo='1'")->num_rows;
			if($checanome <= 0) {
				$enick = 1;
				$mensagemn = "- O nick informado não está cadastrado ou não foi ativado.";
			}

			if($enick == 1) {
				echo"Erros encontrados:<br>".$mensagemn;
			}else {
				$novaSenha = hash('sha512', $senha);
				$checausu = $mysqli->query("SELECT * FROM usuarios WHERE nick='$nick' AND senha='$novaSenha'")->num_rows;
				if($checausu >= 1) {
					$info = $mysqli->query("SELECT * FROM usuarios WHERE nick='$nick' AND senha='$novaSenha'")->fetch_array();
					$_SESSION['logado'] = 5;
					$_SESSION['id'] = $info['id'];
					if($checado=="true") {
						$_SESSION['cookie'] = 2;
					}
					echo"Olá, ".$nick.". Seja bem-vindo!<script>location.href='".$endereco."';</script>";
				}else {
					echo"Erros encontrados:<br>- Nick e senha não coincidem.";
				}
			}
		}
	}else {
		echo"sai daqui noob";
	}
?>