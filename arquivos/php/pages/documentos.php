	<?php

		error_reporting(0);
		ini_set(“display_errors”, 0 );
		require_once("../../configura/config.php");
		$id = $_POST['id'];
	?>
	<div class="coluna" style="width:100%">
	<?php
		if($id=="") {
			$sql = $mysqli->query("SELECT * FROM docs ORDER BY tipo DESC, id DESC");
				if($sql->num_rows == 0) {
					echo"Não temos scripts cadastrados.";
				}else {
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
					<div onclick="carrega('documentos','<?php echo $scr['id']; ?>');" class="botaos laranja"><?php echo $scr['titulo']; ?></div>
				<?php
				}
			}
		}
	}elseif(is_numeric($id)) {
		$sql = $mysqli->query("SELECT * FROM docs WHERE id='$id'")->fetch_array();
		$teste = explode(',', $sql['cargos']);
		$pesquisa = 'string(1) "'.$dadosCargo['id'].'"';
		foreach($teste as $id) {
			if($id === $dadosCargo['id']) {
				$passou = "sim";
				break;
			}else {
				$passou="nao";
			}
		}
		if($passou == "sim") {
		?>
			<div class="botao vermelho" onclick="carrega('documentos','');">VOLTAR</div>
			<div class="box">
				<div class="titulo preto"><?php echo $sql['titulo']; ?></div>
				<div class="corpo">
					<?php echo $sql['conteudo']; ?>
					<br><br><b>Postado em:</b> <?php echo $sql['data']; ?>
				</div>
			</div>
				<?php
				}
			}
		?>
	</div>