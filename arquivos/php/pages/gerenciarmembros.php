<?php
	require_once("../../configura/config.php");
?>
<div class="coluna" style="width:100%">
	<div class="box">
		<div class="titulo rosa">MEMBROS</div>
		<div class="corpo">
			<table class="perfil">
				<tR>
					<td>Nick</td>
					<td>TAG</td>
					<td>Cargo</td>
					<td>Editar</td>
					<td>Desativar</td>
				</tR>
				<?php
					$sql = $mysqli->query("SELECT * FROM usuarios WHERE ativo='1' ORDER BY cargo_id DESC, nick DESC");
					while($membros = $sql->fetch_array()) {
						$carg = $mysqli->query("SELECT nome FROM cargos WHERE id='".$membros['cargo_id']."'")->fetch_array();
				?>
						<tr>
							<td><?php echo $membros['nick']; ?></td>
							<td>[<?php echo $membros['tag']; ?>]</td>
							<td><?php echo $carg['nome']; ?></td>
							<td><div class="botao verde" onclick="membros.editar('<?php echo $membros['id']; ?>');" style="text-align:center;">EDITAR</div></td>
							<td><div class="botao vermelho" onclick="membros.desativar('<?php echo $membros['id']; ?>');" style="text-align:center;">DESATIVAR</div></td>
						</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</div>
<div id="reqresults"></div>