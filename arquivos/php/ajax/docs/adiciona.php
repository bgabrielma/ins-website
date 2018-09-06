<?php
	require_once("../../../configura/config.php");
	$tipo = $_POST['tipo'];
	$titulo = $_POST['titulo'];
	$cargos = $_POST['cargos'];
	foreach($cargos AS $permissao) {
			$permissoes = $permissoes.",".$permissao;
	}
	$conteudo = $_POST['conteudo'];

	if($tipo == "") {
		$erroTipo = "Insira o tipo de documento.<br>";
	}
	if($titulo == "") {
		$erroTitulo = "Insira o título do script.<br>";
	}

	if($cargos == "") {
		$erroCargos = "Insira os cargos com permissão.<br>";
	}

	if($conteudo == "") {
		$erroConteudo = "Insira o conteudo do script.<br>";
	}

	if(isset($erroTipo) OR isset($erroTitulo) OR isset($erroCargos) OR isset($erroConteudo)) {
?>
			<div class="box">
				<div class="titulo vermelho">
					ERROS ENCONTRADOS
					<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
				</div>
				<div class="corpo">
					<?php echo $erroTipo.$erroTitulo.$erroCargos.$erroConteudo; ?>
				</div>
			</div>
		<?php
	}else {
		$data = date('d/m/Y');
		$mysqli->query("INSERT INTO docs (id,titulo,conteudo,cargos,data,tipo) VALUES('','$titulo','$conteudo','$permissoes','$data','$tipo')");
?>
		<div class="box">
			<div class="titulo verde">
				AGORA SIM
				<div class="icone" style="cursor:pointer;" onclick="fechar('gerenciascr');"><i class="demo-icon icon-cancel-6"></i></div>
			</div>
			<div class="corpo">
				O documento foi adicionado com sucesso.<br>
				Obrigado.
			</div>
		</div>
<?php
}
?>