<?php
	require_once("../../configura/config.php");
	if($_SESSION['logado'] != NULL) {
		echo"sai daqui noob";
	}else {
		$nick = $_POST['nick'];
		$senha = $_POST['senha'];
		$email = $_POST['email'];
		$tag = $_POST['tag'];
		if($nick == NULL) {
			$enick = 1;
			$mensagemn = "- Insira o nick igual ao do Habbo Hotel.<br>";
		}

		if($senha == NULL) {
			$esenha = 1;
			$mensagems = "- Insira uma senha de login.<br>";
		}

		if($email == NULL) {
			$eemail = 1;
			$mensageme = "- Insira um e-mail para login.<br>";
		}

		if($tag == NULL) {
			$etag = 1;
			$mensagemt = "- Insira sua TAG na Polícia Revolução Contra o Crime.";
		}

		if($enick ==1 || $esenha == 1 || $eemail == 1 || $etag == 1) {
			echo"<div class='titulo vermelho'>Erros encontrados</div>".$mensagemn.$mensagems.$mensageme.$mensagemt;
		}else {
			$checanome = $mysqli->query("SELECT * FROM usuarios WHERE nick='$nick'")->num_rows;
			$checaemail = $mysqli->query("SELECT * FROM usuarios WHERE email='$email'")->num_rows;
			$checatag = $mysqli->query("SELECT * FROM usuarios WHERE tag='$tag'")->num_rows;
			if($checanome >= 1) {
				$enick = 1;
				$mensagemn = "- Nick já está em uso.<br>";
			}
			if($checaemail >= 1) {
				$eemail = 1;
				$mensageme = "- E-mail já em uso.<br>";
			}
			if($checatag >= 1) {
				$etag = 1;
				$mensagemt = "- TAG já está em uso.";
			}
			if($enick == 1 || $eemail == 1 || $etag == 1) {
				echo"<div class='titulo vermelho'>Erros encontrados</div>".$mensagemn.$mensageme.$mensagemt;
			}else {
				$tag = str_replace('[','',$tag);
				$tag = str_replace(']','',$tag);
				$novaSenha = hash('sha512', $senha);
				$registro = date('d/m/Y', time());
				
				if($mysqli->query("INSERT INTO usuarios (id,nick,senha,email,registro,instrutor,ativo,cargo_id,tag) VALUES('','$nick','$novaSenha','$email','$registro','','0','1','$tag')"))
				{
				echo"<div class='titulo verde'>Registro concluído com sucesso.</div>Aguarde um Ministro+ ativar sua conta.";
    			}
    			else
    			{
    			    echo "Ocorreu um erro.\nPor favor tente novamente ou contacte a administração.";
    			}
			}
		}
	}
?>