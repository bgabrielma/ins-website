<?php
	require_once("../../../configura/config.php");
	$id = $_POST['id'];
?>
<div class="sessao">COMENTÁRIOS</div>
<?php
	$sql = $mysqli->query("SELECT * FROM comentarios WHERE alerta_id='$id' ORDER BY id DESC");
	while($coment = $sql->fetch_array()) {
		$autor = $mysqli->query("SELECT * FROM usuarios WHERE id='".$coment['autor_id']."'")->fetch_array();
		?>
			<div class="box">
				<div class="titulo laranja">
					<?php echo $autor['nick']; ?>
					<?php if($dadosCargo >= 5) { ?>
						<div class="icone" onclick="comentarios.deleta('<?php echo $coment['id']; ?>','');" style="cursor:pointer;">
							<i class="demo-icon icon-cancel-6"></i>
						</div>
					<?php } ?>
				</div>
				<div class="corpo">
					<?php echo $coment['conteudo']; ?>
				</div>
			</div>
		<?php
	}
?>