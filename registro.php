<?php
	require_once("arquivos/configura/config.php");
	if($_SESSION['logado'] == 1) {
		$lugar = "index.php";
		header("Location: $lugar");
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Instrutores - Registro</title>
		<script src="arquivos/javascript/jquery-3.0.0.js" type="text/javascript"></script>
		<script src="arquivos/javascript/nLogin.js" type="text/javascript"></script>
		<link rel="stylesheet" href="arquivos/css/login.css"/>
	</head>
	<body>
		<div id="carregando"></div>
		<div id="box">
			<div class="logo"></div>
			<div id="resultado"></div>
			<div class="input"><div class="icone"><i class="demo-icon icon-user-1"></i></div><input type="text" name="user" id="user" placeholder="Nick do Habbo Hotel"/></div>
			<div class="input"><div class="icone"><i class="demo-icon icon-tag-1"></i></div><input maxlength="3" type="text" name="tag" id="tag" placeholder="Tag na RCC"/></div>
			<div class="input"><div class="icone"><i class="demo-icon icon-email"></i></div><input type="email" name="email" id="email" placeholder="Email"/></div>
			<div class="input"><div class="icone"><i class="demo-icon icon-lock-6"></i></div><input type="password" name="pass" id="pass" placeholder="Senha"/></div>
			<input onclick="registrar();" type="submit" value="REGISTRAR" id="registro" style="width:100%";/>
			<a href="/login"><input type="button" value="JÁ SOU CADASTRADO"></a>
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
        			registrar();
    			}
			});
		</script>
	</body>
</html>