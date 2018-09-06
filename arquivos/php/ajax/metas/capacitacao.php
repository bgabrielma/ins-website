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
			<td>6 ou + Pontos</td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
		<?php
			$sql = $mysqli->query("SELECT * FROM quantidadecap WHERE cap>='2' AND semana='$data' AND ano='$ano' ORDER BY cap");
			while($cap = $sql->fetch_array()) {
				$ins = $mysqli->query("SELECT nick FROM usuarios WHERE id='".$cap['capacitador_id']."'")->fetch_array();
				?>
					<tr>
						<td><?php echo $ins['nick']; ?></td>
						<td><?php echo $cap['cap']; ?> CAPACITAÇÃO.</td>
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
			<td>01 a 05 Pontos</td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
		<?php
			$sql = $mysqli->query("SELECT * FROM quantidadecap WHERE cap='1' AND semana='$data' AND ano='$ano' ORDER BY cap");
			while($cap = $sql->fetch_array()) {
				$ins = $mysqli->query("SELECT nick FROM usuarios WHERE id='".$cap['capacitador_id']."'")->fetch_array();
				?>
					<tr>
						<td><?php echo $ins['nick']; ?></td>
						<td><?php echo $cap['cap']; ?> CAPACITAÇÃO.</td>
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
			<td>0 pontos</td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
		<?php
			$sql = $mysqli->query("SELECT * FROM quantidadecap WHERE cap='0' AND semana='$data' AND ano='$ano' ORDER BY cap");
			while($cap = $sql->fetch_array()) {
				$ins = $mysqli->query("SELECT nick FROM usuarios WHERE id='".$cap['capacitador_id']."'")->fetch_array();
				?>
					<tr>
						<td><?php echo $ins['nick']; ?></td>
						<td><?php echo $cap['cap']; ?> CAPACITAÇÃO.</td>
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