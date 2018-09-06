<?php
	require_once("../../configura/config.php");
?>
<div class="coluna" style="width:100%;">
	<div class="box">
		<div class="titulo vermelho">
			ATIVAR MEMBROS
		</div>
		<div class="corpo">
			<table class="perfil">
				<?php
					$sql = $mysqli->query("SELECT * FROM usuarios WHERE ativo!='1' ORDER BY nick ASC");
					while($membro = $sql->fetch_array()) {
				?>
					<tr>
						<td><?php echo $membro['nick']; ?></td>
						<td><div class="botao azul2" style="text-align:center;" onclick="membros.ativar('<?php echo $membro['id']; ?>');">ATIVAR</div></td>
					</tr>
				<?PHP } ?>
			</table>
		</div>
	</div>
</div>
<div id="reqresults"></div>