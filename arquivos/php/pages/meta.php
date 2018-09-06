<?php
	require_once("../../configura/config.php");
?>
<div class="coluna" style="width:49%;">
	<div class="sessao">
		META SEMANAL
	</div>
	<?php
		$sql = $mysqli->query("SELECT * FROM meta WHERE tipo='1' ORDER BY id DESC");
		while($meta = $sql->fetch_array()) {
			if($meta['patente']==2) {
				if($dadosCargo['id']==3 OR $dadosCargo['id']>=5) {
					?>
						<div class="botaos azul2" onclick="meta.carrega('<?php echo $meta['id']; ?>');"><?php echo $meta['qual']; ?> - Graduadores</div>
					<?php
				}
			}elseif($meta['patente']==1) {
				if($dadosCargo['id']>=1) {
					?>
						<div class="botaos azul2" onclick="meta.carrega('<?php echo $meta['id']; ?>');"><?php echo $meta['qual']; ?></div>
					<?php
				}
			}
	?>
	<?php
		}
	?>
</div>
<div class="coluna" style="width:49%;">
	<div class="sessao rosa">
		META MENSAL
	</div>
</div>