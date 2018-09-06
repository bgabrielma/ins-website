<?php require_once("arquivos/configura/config.php"); ?>
<?php
	if(isset($_SESSION['nick'])) {
		session_destroy();
		setcookie("id","");	
		setcookie("nick","");	
		setcookie("logado","");	
		echo"<script>location.reload();</script>";
	}
	if($_SESSION['cookie'] == 2) {
		setcookie("logado",5,(time() + (86400 * 36500)));
		$nick = $dadosUsu['id'];
		setcookie("id",$dadosUsu['id'],(time() + (86400 * 36500)));
	}
	if(isset($_COOKIE['logado'])) {
		$_SESSION['logado'] = 5;
		$_SESSION['id'] = $_COOKIE['id'];
		$reinicia = "<script>location.reload();</script>";
		if($_SESSION['restart'] == 1) {
			$reinicia = "";
		}
		$_SESSION['restart'] = 1;
		echo $reinicia;
	}
    if($_SESSION['logado'] != 5) {
        $lugar = "login";
        header("Location: $lugar");
    }
	if($_SESSION['sair'] == 1) {
		session_destroy();
		setcookie("id","");	
		setcookie("logado","");	
		echo"<script>location.reload();</script>";
	}
	if($_SESSION['logado'] != 5) {
		$lugar = "login";
		header("Location: $lugar");
	}
?>
<link rel="icon" href="arquivos/imagem/favico.png" />
<title>Instrutores</title>
<meta charset="UTF-8" >
<script src="arquivos/javascript/jquery-3.0.0.js" type="text/javascript"></script>
<script src="arquivos/javascript/jquery.selectric.min.js" type="text/javascript"></script>
<script src="arquivos/javascript/gerais.js" type="text/javascript"></script>
<link rel="stylesheet" href="arquivos/css/header.css"/>
<link rel="stylesheet" href="arquivos/css/selectric.css"/>
<script src="ckeditor/ckeditor.js"></script>
<div id="linha-de-cores"><div class="carrega"></div></div>
<link rel="stylesheet" href="arquivos/css/jquery.mCustomScrollbar.min.css">
<script src="arquivos/javascript/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>
<link href="arquivos/css/sm-core-css.css" rel="stylesheet" type="text/css" />
<link href="arquivos/css/sm-blue.css" rel="stylesheet" type="text/css" />
<script src="arquivos/javascript/jquery-labelauty.js"></script>
<script src="arquivos/javascript/bootstrap-tagsinput.js"></script>
<script src="arquivos/javascript/bootstrap-tagsinput-angulas.js"></script>
<link rel="stylesheet" href="arquivos/css/bootstrap-tagsinput.css">
<link rel="stylesheet" type="text/css" href="arquivos/css/jquery-labelauty.css">
<div id="menu">
	<div class="menu">
		<li class="inicio"><a href="#inicio" onclick="carrega('inicio','');"><i class="demo-icon icon-home-3"></i></a></li>
		<li><a href="#formulario" onclick="carrega('formulario','');">FORMULÁRIOS</a></li>
		<li><a href="#scripts" onclick="carrega('scripts','');">SCRIPTS</a></li>
		<li><a href="#listademembros" onclick="carrega('listademembros','');">LISTA DE MEMBROS</a></li>
		<li><a onclick="carrega('meta','');" href="#meta">META</a></li>
		<li><a onclick="carrega('documentos','');" href="#docs">DOCUMENTOS</a></li>
		<?php if($dadosCargo['id'] >= 5) { ?>
		<li><a href="#administração" onclick="adm();">ADMINISTRAÇÃO</a></li>
		<?php } ?>
		<?php if($dadosCargo['id'] == 11) { ?>
		<li><a href="#desenvolvimento" onclick="dsv();">DESENVOLVIMENTO</a></li>
		<?php } ?>
		<div class="perfil">
			<li id="eopcoes" onclick="opcoes();"><i class="demo-icon icon-down-open-3"></i>  <?php echo $dadosUsu['nick']." | ".$dadosCargo['nome']; ?><div class="avatar" style="background-image:url('https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $dadosUsu['nick']; ?>&direction=3&head_direction=3');"></div></li>
			<div class="opcoes">
				<li><a href="#sair" onclick="sair();">Sair</a></li>
			</div>
		</div>
	</div>
</div>
<nav id="main-nav" role="navigation">
  <!-- Sample menu definition -->
  <ul id="main-menu" class="sm sm-blue">
  	<?php if($dadosCargo['id'] >= 5) { ?>
    <li><a href="#aulas" onclick="carrega('gerenciaraulas','');">Aulas</a></li>
    <li><a href="#graduacoes" onclick="carrega('graduacoes','');">Graduações</a></li>
    <li><a href="#avaliacoes" onclick="carrega('avaliacoes','');">Avaliações</a></li>
    <li><a href="#capacitacoes" onclick="carrega('capacitacoes','');">Capacitações</a></li>
    <li><a href="#alertas" onclick="carrega('alertas','');">ALERTAS&AVISOS</a></li>
    <li><a href="#">Gestão de Scripts</a>
    	<ul>
    		<li><a href="#adicionar" onclick="carrega('novoscr','');">NOVO SCRIPT</a></li>
    		<li><a href="#gerenciar" onclick="carrega('gerenciascr','');">GERENCIAR SCRIPTS</a></li>
    	</ul>
    </li>
    <li><a href="#">Gestão de Membros</a>
    	<ul>
    		<li><a href="#ativar" onclick="carrega('ativarmembros','');">ATIVAR CONTAS</a></li>
    		<li><a href="#gerenciar" onclick="carrega('gerenciarmembros','');">GERENCIAR MEMBROS</a></li>
    	</ul>
    </li>
    <li><a href="#">Gestão de documentos</a>
    	<ul>
    		<li><a href="#adicionar" onclick="carrega('novodoc','');">NOVO DOCUMENTO</a></li>
    		<li><a href="#gerenciar" onclick="carrega('gerenciadocs','');">GERENCIAR DOCUMENTOS</a></li>
    	</ul>
    </li>
    <?php } ?>
  </ul>
</nav>
<nav id="main-nav" role="navigation">
  <!-- Sample menu definition -->
  <ul id="sec-menu" class="sm sm-blue"> 
    <li><a href="#">BOXES</a>
    	<ul>
    		<li><a href="#boxes" onclick="carrega('boxes','');">BOXES</a></li>
    	</ul>
    </li>
  </ul>
</nav>
<script type="text/javascript" src="arquivos/javascript/jquery.smartmenus.min.js"></script>
<script type="text/javascript">
	$(function() {
		$('#main-menu').smartmenus({
		});
	});
	$(function() {
		$('#sec-menu').smartmenus({
		});
	});
</script>