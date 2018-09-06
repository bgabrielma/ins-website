<?php
	require_once("../../../configura/config.php");
	$tipo = $_POST['tipo'];
	$id = $_POST['id'];
?>

<?php 
	if($tipo == "") {
		$info = $mysqli->query("SELECT * FROM usuarios WHERE id='$id'")->fetch_Array();
		?>
			<div id="results">
				<div class="box">
					<div class="titulo laranja">
						TEM CERTEZA?
						<div class="icone"><i class="demo-icon  icon-help-2"></i></div>
					</div>
					<div class="corpo">
						Você tem certeza que deseja desativar o usuário <?php echo $info['nick']; ?>?<br><br>
						<table style="width:100%;">
							<tr>
								<td><div style="text-align:center;" class="botao verde" onclick="membros.desat('<?php echo $id; ?>');">SIM</div></td>
								<td><div style="text-align:center;" class="botao vermelho" onclick="fechar('');">NÃO</div></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		<?php
	}
?>

<?php if($tipo == "desat") {
	$info = $mysqli->query("SELECT * FROM usuarios WHERE id='$id'")->fetch_Array();
	$mysqli->query("UPDATE usuarios SET ativo='0' WHERE id='$id'");
	?>
		<div id="results">
			<div class="box">
				<div class="titulo preto">
					CERTO.
					<div class="icone" style="cursor:pointer;" onclick="fechar('gerenciarmembros');"><i class="demo-icon icon-cancel-6"></i></div>
				</div>
				<div class="corpo">
					O usuário <?php echo $info['nick']; ?> foi desativado.
				</div>
			</div>
		</div>
	<?php
}
?>