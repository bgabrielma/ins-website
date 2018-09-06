<?php
	require_once("../../../configura/config.php");
	$id = $_POST['id'];
	$info = $mysqli->query("SELECT * FROM meta WHERE id='$id'")->fetch_array();
	$data = $info['data'];
	$ano = $info['ano'];
	$separa = explode(" ", $info['dat']);
	$comeco = explode("/", $separa[0]);
	$fim = explode("/", $separa[1]);
?>
<div class="titulo verde" style="border-radius:0px;">
	<table class="meta">
		<tr>
			<td>EXCELENTE</td>
			<td>2+ cfi</td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
		<?php
			$sql = $mysqli->query("SELECT * FROM quantidadegrad WHERE grad>='2' AND semana='$data' AND ano='$ano' ORDER BY grad");
			while($grad = $sql->fetch_array()) {
				$ins = $mysqli->query("SELECT nick FROM usuarios WHERE id='".$grad['graduador_id']."'")->fetch_array();
				?>
					<tr>
						<td><?php echo $ins['nick']; ?></td>
						<td><?php echo $grad['grad']; ?> cfi.</td>
					</tr>
				<?php
			}
		?>
	</table>
</div>

<div class="titulo preto" style="border-radius:0px;">
	<table class="meta">
		<tr>
			<td>Regulares</td>
			<td>1 cfi</td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
		<?php
			$sql = $mysqli->query("SELECT * FROM quantidadegrad WHERE grad='1' AND semana='$data' AND ano='$ano' ORDER BY grad");
			while($grad = $sql->fetch_array()) {
				$ins = $mysqli->query("SELECT nick FROM usuarios WHERE id='".$grad['graduador_id']."'")->fetch_array();
				?>
					<tr>
						<td><?php echo $ins['nick']; ?></td>
						<td><?php echo $grad['grad']; ?> cfi.</td>
					</tr>
				<?php
			}
		?>
	</table>
</div>

<div class="titulo vermelho" style="border-radius:0px;">
	<table class="meta">
		<tr>
			<td>Irregulares</td>
			<td>0 cfi</td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
		<?php
			$sql = $mysqli->query("SELECT * FROM quantidadegrad WHERE grad='0' AND semana='$data' AND ano='$ano' ORDER BY grad");
			while($grad = $sql->fetch_array()) {
				$ins = $mysqli->query("SELECT nick FROM usuarios WHERE id='".$grad['graduador_id']."'")->fetch_array();
				?>
					<tr>
						<td><?php echo $ins['nick']; ?></td>
						<td><?php echo $grad['grad']; ?> cfi.</td>
					</tr>
				<?php
			}
		?>
	</table>
</div>

<div class="titulo azul" style="border-radius:0px;">
	<table class="meta">
		<tr>
			<td>Casos especiais</td>
			<td>Motivo</td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
	</table>
</div>