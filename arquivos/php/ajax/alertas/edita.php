<?php
	require_once("../../../configura/config.php");
	$id = $_POST['id'];
	$titulo = $_POST['titulo'];
	$tipo = $_POST['tipo'];
	$cargos = $_POST['cargos'];
	foreach($cargos AS $permissao) {
		$permissoes = $permissoes.",".$permissao;
	}
	$descricao = $_POST['descricao'];
	$conteudo = $_POST['conteudo'];
	
	if($titulo == "") {
		$erroTitulo = "Insira o título do alerta.<bR>";
	}

	if($tipo == "") {
		$erroTipo = "Insira o tipo de alerta.<br>";
	}

	if($cargos == "") {
		$erroCargos = "Você deve selecionar pelo menos um cargo.<br>";
	}

	if($descricao == "") {
		$erroDescricao = "Insira a descrição do alerta, que irá aparecer na tela inicial.<br>";
	}

	if($conteudo == "") {
		$erroConteudo = "Insira o conteúdo do alerta, que conterá a notícia na integra.";
	}

	if(isset($erroTitulo) OR isset($erroTipo) OR isset($erroCargos) OR isset($erroDescricao) OR isset($erroConteudo)) {
		?>
			<div class="box">
				<div class="titulo vermelho">
					ERROS ENCONTRADOS
					<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
				</div>
				<div class="corpo">
					<?php echo $erroTitulo.$erroTipo.$erroCargos.$erroDescricao.$erroConteudo; ?>
				</div>
			</div>
		<?php
	}else {
		$mysqli->query("UPDATE alertas SET titulo='$titulo', tipo='$tipo', cargos_id='$permissoes', descricao='$descricao', conteudo='$conteudo' WHERE id='$id'");
		?>
			<div class="box">
				<div class="titulo verde">
					AGORA SIM
					<div class="icone" style="cursor:pointer;" onclick="fechar('alertas');"><i class="demo-icon icon-cancel-6"></i></div>
				</div>
				<div class="corpo">
					O alerta foi editado.<br>
					Obrigado pela paciência.
				</div>
			</div>
		<?php
	}
?>