<?php
	require_once("../../../configura/config.php");
	$id = $_POST['id'];
	$titulo = $_POST['titulo'];
	$cargos = $_POST['cargos'];
	foreach($cargos AS $permissao) {
		if($permissao == 1) {
			$permissoes = $permissao;
		}elseif($permissoes[0] == ",") {
			$permissoes = $permissoes.",".$permissao;
			$permissoes = substr($permissoes, 1);
		}else {
			$permissoes = $permissoes.",".$permissao;
		}
	}
	$conteudo = $_POST['conteudo'];

	if($titulo == "") {
		$erroTitulo = "Insira o título do script.<br>";
	}

	if($cargos == "") {
		$erroCargos = "Insira os cargos com permissão.<br>";
	}

	if($conteudo == "") {
		$erroConteudo = "Insira o conteudo do script.<br>";
	}

	if(isset($erroTitulo) OR isset($erroCargos) OR isset($erroConteudo)) {
?>
			<div class="box">
				<div class="titulo vermelho">
					ERROS ENCONTRADOS
					<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
				</div>
				<div class="corpo">
					<?php echo $erroTitulo.$erroCargos.$erroConteudo; ?>
				</div>
			</div>
		<?php
	}else {
		$mysqli->query("UPDATE scripts SET titulo='$titulo', conteudo='$conteudo', cargos='$permissoes' WHERE id='$id'");
?>
		<div class="box">
			<div class="titulo verde">
				AGORA SIM
				<div class="icone" style="cursor:pointer;" onclick="fechar('gerenciascr');"><i class="demo-icon icon-cancel-6"></i></div>
			</div>
			<div class="corpo">
				O script foi atualizado com sucesso.<br>
				Obrigado.<?php print_r($cargos); ?>
			</div>
		</div>
<?php
}
?>