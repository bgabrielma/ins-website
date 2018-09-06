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
			<td>2+ Testes de Admissão/td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
		<?php
			$sql = $mysqli->query("SELECT * FROM quantidadegrad WHERE adm>='2' AND semana='$data' AND ano='$ano' ORDER BY adm");
			while($adm = $sql->fetch_array()) {
				$ins = $mysqli->query("SELECT nick FROM usuarios WHERE id='".$adm['aplicador_id']."'")->fetch_array();
				?>
					<tr>
						<td><?php echo $ins['nick']; ?></td>
						<td><?php echo $adm['adm']; ?> cfi.</td>
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
			<td>1 Teste de Admissão</td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
		<?php
			$sql = $mysqli->query("SELECT * FROM quantidadegrad WHERE adm='1' AND semana='$data' AND ano='$ano' ORDER BY adm");
			while($adm = $sql->fetch_array()) {
				$ins = $mysqli->query("SELECT nick FROM usuarios WHERE id='".$adm['aplicador_id']."'")->fetch_array();
				?>
					<tr>
						<td><?php echo $ins['nick']; ?></td>
						<td><?php echo $adm['adm']; ?> cfi.</td>
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
			<td>0 Testes de Admissão</td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
		<?php
			$sql = $mysqli->query("SELECT * FROM quantidadegrad WHERE adm='0' AND semana='$data' AND ano='$ano' ORDER BY adm");
			while($adm = $sql->fetch_array()) {
				$ins = $mysqli->query("SELECT nick FROM usuarios WHERE id='".$adm['aplicador_id']."'")->fetch_array();
				?>
					<tr>
						<td><?php echo $ins['nick']; ?></td>
						<td><?php echo $adm['adm']; ?> cfi.</td>
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