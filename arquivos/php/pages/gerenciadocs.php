<?php
	require_once("../../configura/config.php");
?>
<div class="coluna" style="width:100%;">
<?php
	$sql = $mysqli->query("SELECT * FROM docs ORDER BY id");
		while($scr = $sql->fetch_array()) {
			$ids = explode(",", $scr['cargos']);
			foreach($ids as $id) {
				if($id === $dadosCargo['id']) {
					$passou = "sim";
					break;
				}else {
					$passou="nao";
				}
			}
			if($passou == "sim") {
			?>
				<div class="botaos laranja" style="cursor:pointer;"><?php echo $scr['titulo']; ?> <div class="icone"><i onclick="script.deleta('<?php echo $scr['id']; ?>');" class="demo-icon icon-cancel-circled-2"></i><i onclick="script.edita('<?php echo $scr['id']; ?>');" class="demo-icon icon-edit"></i></div></div>
			<?php
			}
		}
?>
</div>
<div id="reqresults"></div>