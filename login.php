<?php
	require_once("arquivos/configura/config.php");
	if(isset($_SESSION['nick'])) {
		session_destroy();
		setcookie("id","");	
		setcookie("logado","");	
		echo"<script>location.reload();</script>";
	}
	if($_SESSION['logado'] == 5) {
		$lugar = "index.php";
		header("Location: $lugar");
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Instrutores - Login</title>
		<script src="arquivos/javascript/jquery-3.0.0.js" type="text/javascript"></script>
		<script src="arquivos/javascript/nLogin.js" type="text/javascript"></script>
		<link rel="stylesheet" href="arquivos/css/login.css"/>
	</head>
	<body>
		<div id="carregando"></div>
		<div id="box">
			<div class="logo"></div>
			<div id="resultado"></div>
			<div class="input"><div class="icone"><i class="demo-icon icon-user-1"></i></div><input type="text" name="user" id="user" placeholder="Usuário"/></div>
			<div class="input"><div class="icone"><i class="demo-icon icon-lock-6"></i></div><input type="password" name="pass" id="pass" placeholder="Senha"/></div>
			<input type="checkbox" id="lembrar" name="lembrar" value='lembrar'/><label for="lembrar">Lembre-se de mim</label>
			<input onclick="logar();" type="submit" value="ENTRAR" id="login"/>
			<a href="/registro"><input type="button" value="REGISTRE-SE"></a>
		</div>
		<script>
			function ajeitaBox() {
				var height = $("#box").height();
				var width = $("#box").width();
				var nHeight = height/2;
				var nWidth = width/2;
				var styles = {
					position: 'fixed',
					left: '50%',
					top: '50%',
					marginLeft: '-'+nWidth+'px',
					marginTop: '-'+nHeight+'px'
				}
				$("#box").css(styles);
			}
			ajeitaBox();
			$('#user, #pass, #lembrar').on('keydown', function(event) { // também pode usar keyup
    			if(event.keyCode === 13) {
        			logar();
    			}
			});
		</script>
	</body>
</html>