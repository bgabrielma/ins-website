<?php
	require_once("../../configura/config.php");
	$tipo = $_POST['tipo'];
	$id = $_POST['id'];
	if($tipo == "deleta") {
		$mysqli->query("DELETE FROM scripts WHERE id='$id'");
		?>
			<div id="results">
				<div class="box">
					<div class="titulo verde">
						ALERTA EXCLUÍDO!
						<div class="icone" style="cursor:pointer;" onclick="fechar('gerenciascr');"><i class="demo-icon icon-cancel-6"></i></div>
					</div>
					<div class="corpo">
						O ALERTA FOI EXCLUÍDO COM SUCESSO!
					</div>
				</div>
			</div>
		<?php
	}elseif($tipo == "adiciona") {
		$titulo = $_POST['titulo'];
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
			$mysqli->query("INSERT INTO scripts (id,titulo,conteudo,cargos) VALUES('','$titulo','$conteudo','$permissoes')");
			?>
				<div class="box">
					<div class="titulo verde">
						AGORA SIM
						<div class="icone" style="cursor:pointer;" onclick="fechar('gerenciascr');"><i class="demo-icon icon-cancel-6"></i></div>
					</div>
					<div class="corpo">
						O script foi adicionado com sucesso.<br>
						Obrigado.
					</div>
				</div>
			<?php
		}
	}
?>