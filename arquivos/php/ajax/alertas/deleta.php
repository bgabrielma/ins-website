<?php
	require_once("../../../configura/config.php");
	$tipo = $_POST['tipo'];
	$id = $_POST['id'];
?>

<?php 
	if($tipo == "") {
		$info = $mysqli->query("SELECT * FROM alertas WHERE id='$id'")->fetch_Array();
		?>
			<div id="results">
				<div class="box">
					<div class="titulo laranja">
						TEM CERTEZA?
						<div class="icone"><i class="demo-icon  icon-help-2"></i></div>
					</div>
					<div class="corpo">
						Você tem certeza que deseja desativar o alerta <b><?php echo $info['titulo']; ?></b><br><br>
						<table style="width:100%;">
							<tr>
								<td><div style="text-align:center;" class="botao verde" onclick="alerta.deleta('<?php echo $id; ?>','deleta');">SIM</div></td>
								<td><div style="text-align:center;" class="botao vermelho" onclick="fechar('');">NÃO</div></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		<?php
	}
?>

<?php if($tipo == "deleta") {
	$info = $mysqli->query("SELECT * FROM alertas WHERE id='$id'")->fetch_Array();
	$mysqli->query("DELETE FROm alertas WHERE id='$id'");
	?>
		<div id="results">
			<div class="box">
				<div class="titulo preto">
					CERTO.
					<div class="icone" style="cursor:pointer;" onclick="fechar('alertas');"><i class="demo-icon icon-cancel-6"></i></div>
				</div>
				<div class="corpo">
					O alerta foi deletado.
				</div>
			</div>
		</div>
	<?php
}
?>