	<?php

		error_reporting(0);
		ini_set(“display_errors”, 0 );
		require_once("../../configura/config.php");
		$id = $_POST['id'];
	?>
	<div class="coluna" id="a1" style="width:67%">
		<div class="sessao">ALERTAS E EVENTOS</div>
		<?php
			$evento = $mysqli->query("SELECT * FROM alertas WHERE id='$id'")->fetch_array();
				$tipo = $evento['tipo'];
				if($tipo == 1) {
					$estilo = "laranja";
					$icone = "icon-alert";
				}elseif($tipo == 2) {
					$estilo = "vermelho";
					$icone = "icon-users";
				}elseif($tipo == 3) {
					$estilo = "rosa";
					$icone = "icon-gamepad";
				}elseif($tipo == 4) {
					$estilo = "cinza";
					$icone="icon-newspaper-2";
				}elseif($tipo == 5) {
					$estilo = "verde2";
					$icone="icon-wrench";
				}else {
					$estilo = "preto";
					$icone ="icon-star";
				}
				$ids = explode(",", $evento['cargos_id']);
				foreach($ids as $id) {
					if($id === $dadosCargo['nvhie']) {
						$passou = "sim";
						break;
					}else {
						$passou="nao";
					}
				}
				if($passou == "sim") {
					$autor = $mysqli->query("SELECT * FROM usuarios WHERE id='".$evento['autor_id']."'")->fetch_array();
		?>
					<div class="box">
						<div onclick="carrega('alerta','<?php echo $evento['id']; ?>');" class="titulo <?php echo $estilo; ?>">
							<?php echo $evento['titulo']; ?>
							<div class="icone">
								<i class="demo-icon <?php echo $icone; ?>"></i>
							</div>
						</div>
						<div class="corpo">
							<?php echo $evento['conteudo']; ?>
							<br>
							<span style="font-size: 11px;text-transform: uppercase;"><b>Enviado por:</b> <?php echo $autor['nick']; ?>.<br><b><?php echo $evento['data']; ?></b></span>
						</div>
					</div>
					<div class="box">
						<div class="titulo azul2">
							FAÇA UM COMENTÁRIO
							<div class="icone">
								<i class="demo-icon icon-comment-inv"></i>
							</div>
						</div>
						<textarea class="ckeditor comentario" cols="80" id="editor1" name="editor1" rows="10"></textarea>
						<script type="text/javascript">
							CKEDITOR.replace( 'editor1', {
								// Define the toolbar groups as it is a more accessible solution.
								toolbarGroups: [
									{"name":"basicstyles","groups":["basicstyles"]}
								]
							} );
					     		CKEDITOR.instances[instanceName].updateElement();
						</script>  
						<script type="text/javascript">
							function setCKEditorToTextarea() {
								for(var instanceName in CKEDITOR.instances)
									CKEDITOR.instances[instanceName].updateElement();            
							}
						</script>
						<div class="corpo">
							<div class="botao azul2" onclick="setCKEditorToTextarea();comentarios.comentar('<?php echo $evento['id']; ?>');">ENVIAR COMENTÁRIO</div>
						</div>
					</div>
					<div id="comentarios"></div>
		<?php
				}
		?>
	</div>
	<div class="coluna" id="a2" style="width:31%">
		<?php
			$sql = $mysqli->query("SELECT * FROM alertas ORDER BY id DESC LIMIT 10");
			while($evento = $sql->fetch_array()) {
				$tipo = $evento['tipo'];
				if($tipo == 1) {
					$estilo = "laranja";
					$icone = "icon-alert";
				}elseif($tipo == 2) {
					$estilo = "vermelho";
					$icone = "icon-users";
				}elseif($tipo == 3) {
					$estilo = "rosa";
					$icone = "icon-gamepad";
				}elseif($tipo == 4) {
					$estilo = "cinza";
					$icone="icon-newspaper-2";
				}elseif($tipo == 5) {
					$estilo = "verde2";
					$icone="icon-wrench";
				}else {
					$estilo = "preto";
					$icone ="icon-star";
				}
				$ids = explode(",", $evento['cargos_id']);
				foreach($ids as $id) {
					if($id === $dadosCargo['nvhie']) {
						$passou = "sim";
						break;
					}else {
						$passou="nao";
					}
				}
				if($passou == "sim") {
		?>
					<div class="botaos azul2" onclick="carrega('alerta','<?php echo $evento['id']; ?>');"><?php echo $evento['titulo']; ?></div>
		<?php
				}
			}
		?>
	</div>
	<script>
		comentarios.atualizar('<?php echo $_POST['id']; ?>');
	</script>
	<div id="reqresults"></div>