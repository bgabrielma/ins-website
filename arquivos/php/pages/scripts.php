	<?php

		error_reporting(0);
		ini_set(“display_errors”, 0 );
		require_once("../../configura/config.php");
		$id = $_POST['id'];
	?>
	<div class="coluna" style="width:100%">
	<?php
		if($id=="") {
			$sql = $mysqli->query("SELECT * FROM scripts ORDER BY id");
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
					<div onclick="carrega('scripts','<?php echo $scr['id']; ?>');" class="botaos laranja"><?php echo $scr['titulo']; ?></div>
				<?php
				}
			}
		}
	}elseif(is_numeric($id)) {
		$sql = $mysqli->query("SELECT * FROM scripts WHERE id='$id'")->fetch_array();
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
			<div class="botao vermelho" onclick="carrega('scripts','<?php echo $scr['id']; ?>');">VOLTAR</div>
			<div class="box">
				<div class="titulo preto"><?php echo $sql['titulo']; ?></div>
				<div class="corpo">
					<?php
						$conteudo = $sql['conteudo'];
						$conteudo = str_replace("{NICK}", $dadosUsu['nick'], $conteudo);
						$conteudo = str_replace("{TAG}", $dadosUsu['tag'], $conteudo);
						echo $conteudo;
					?>
				</div>
			</div>
				<?php
				}
			}
		?>
	</div>