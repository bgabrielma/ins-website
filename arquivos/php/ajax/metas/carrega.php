<?php
	require_once("../../../configura/config.php");
	$id = $_POST['id'];
	$info = $mysqli->query("SELECT * FROM meta WHERE id='$id'")->fetch_array();

	if($info['tipo'] == 1) {
		$tipo = "semanal";
	}elseif($info['tipo'] == 2) {
		$tipo = "mensal";
	}else {
		$tipo = "indefinido";
	}

	if($info['patente'] == 1) {
		$patente = "aulas aplicadas à Recrutas, Cabos e Subtenentes";
		echo"<script>meta.resultado('".$id."','instrucao');</script>";
	}elseif($info['patente'] == 2) {
		$patente = "CFI aplicados à aprendizes de instrutores";
		echo"<script>meta.resultado('".$id."','cfi');</script>";
	}elseif($info['patente'] == 3) {
		$patente = "avaliações aplicadas";
		echo"<script>meta.resultado('".$id."','avaliacao');</script>";
	}elseif($info['patente'] == 4) {
		$patente = "Capacitações aplicadas a novos aprendizes";
		echo"<script>meta.resultado('".$id."','capacitacao');</script>";
	}elseif($info['patente'] == 5) {
		$patente = "avaliações de instruções feitas em contas fakes";
		echo"<script>meta.resultado('".$id."','avaliacao2');</script>";
	}elseif($info['patente'] == 6) {
		$patente = "testes para instrutor aplicadas";
		echo"<script>meta.resultado('".$id."','teste');</script>";
	}else {
		$patente="indefinido";
	}

?>
<div class="coluna" style="width:100%">
<div class="botao preto" onclick="carrega('meta','');">VOLTAR</div>
	<div class="box">
		<div class="titulo azul2">Essa é a quantidade <?php echo $tipo; ?> de <?php echo $patente; ?> de <?php echo $info['qual']; ?></div>
		<div id="resultado">
			<div class="corpo">
				Isso pode demorar um pouco.
			</div>
		</div>
	</div>
</div>