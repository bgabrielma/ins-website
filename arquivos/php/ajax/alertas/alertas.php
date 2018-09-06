<?php
	require_once("../../../configura/config.php");
	$titulo = $_POST['titulo'];
	$tipo = $_POST['tipo'];
	$cargos = $_POST['cargos'];
	foreach($cargos AS $permissao) {
		if($permissao == 1) {
			$permissoes = $permissao;
		}elseif($permissoes{0} == ",") {
			$permissoes = $permissoes.",".$permissao;
			$permissoes = substr($permissoes, 1);
		}else {
			$permissoes = $permissoes.",".$permissao;
		}
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
		$data = date('d/m/Y').' às '.date('H:i');
		$mysqli->query("INSERT INTO alertas (id,titulo,descricao,conteudo,tipo,data,autor_id,cargos_id) VALUES('','$titulo','$descricao','$conteudo','$tipo','$data','".$dadosUsu['id']."','$permissoes')");
		?>
			<div class="box">
				<div class="titulo verde">
					AGORA SIM
					<div class="icone" style="cursor:pointer;" onclick="fechar('alertas');"><i class="demo-icon icon-cancel-6"></i></div>
				</div>
				<div class="corpo">
					O alerta foi enviado.<br>
					Obrigado pela paciência.
				</div>
			</div>
		<?php
	}
?>