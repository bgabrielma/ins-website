<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	require_once("../../configura/config.php");
	$tipo = $_POST['tipo'];
?>
<?php
	if($tipo == "licenca") {
?>
	<div class="box">
		<div class="titulo preto">
			FORMULÁRIO DE LICENÇA DE SERVIÇO
			<div class="icone">
				<i class="demo-icon icon-moon-inv"></i>
			</div>
		</div>
		<div class="corpo">
			<div class="item azul2">
				<span class="item">Término da licença:</span>
				<div class="input"><div class="icone"><i class="demo-icon icon-moon-inv"></i></div><input type="text" id="ate" name="ate" placeholder="DD/MM/AAAA" onkeyup="mascaraData(this.value,this.id);"/></div>
			</div>
			<div class="item azul2">
				<span class="item">Motivo da licença</span>
					<textarea class="ckeditor motivos" cols="80" id="editor1" name="editor1" rows="10"></textarea>
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
			</div>
			<div class="item azul2">
				<span class="item">Policial que permitiu:</span><br>
				<select id="permitiu">
					<option value="">Selecione</option>
					<?php
						$sql = $mysqli->query("SELECT * FROM usuarios WHERE ativo='1' ORDER BY nick ASC");
						while($usu = $sql->fetch_array()) {
							$cargo = $mysqli->query("SELECT * FROM cargos WHERE id='".$usu['cargo_id']."'")->fetch_array();
							if($cargo['nvhie']>=5) {
								echo"<option value='".$usu['id']."'>".$usu['nick']."</option>";
							}
						}
					?>
				</select>
				<script>
					$("#permitiu").selectric();
				</script>
			</div>
			<div class="botao laranja" onclick="setCKEditorToTextarea();requerimento.licenca();">ENVIAR REQUERIMENTO</div>
		</div>
	</div>
<?php
	}
?>




<?php
	if($tipo == "volta") {
?>
		<div class="box">
			<div class="titulo preto">
				FORMULÁRIO VOLTA DE LICENÇA
				<div class="icone">
					<i class="demo-icon icon-sun-filled"></i>
				</div>
			</div>
			<div class="corpo">
				<div class="botao laranja" onclick="requerimento.volta();">ENVIAR REQUERIMENTO</div>
			</div>
		</div>
<?php
	}
?>



<?php
	if($tipo == "promocao") {
?>
<link rel="stylesheet" href="arquivos/css/chosen.min.css"/>
<script src="arquivos/javascript/chosen.jquery.min.js" type="text/javascript"></script>
	<div class="box">
		<div class="titulo preto">
			FORMULÁRIO DE PROMOÇÃO DE MEMBRO
			<div class="icone">
				<i class="demo-icon icon-user-add-1"></i>
			</div>
		</div>
		<div class="corpo">
			<div class="item azul2">
				<span class="item">MEMBRO À SER PROMOVIDO:</span>
				<select id="membro">
					<option value="">Selecione</option>
					<?php
						$sMaior = $mysqli->query("SELECT * FROM cargos ORDER BY nvhie DESC")->fetch_array();
						if($dadosCargo['nvhie'] == $sMaior['nvhie']) {
							$permitido = $dadosCargo['nvhie']+1;
						}else {
							$permitido = $dadosCargo['nvhie']-1;
						}
						$sql = $mysqli->query("SELECT * FROM usuarios WHERE ativo='1' ORDER BY nick ASC");
						while($usus = $sql->fetch_array()) {
							$car = $mysqli->query("SELECT * FROM cargos WHERE id='".$usus['cargo_id']."'")->fetch_array();
							if($car['nvhie'] < $permitido) {
								echo"<option value='".$usus['id']."'>".$usus['nick']."</option>";
							}
						}
					?>
				</select>
			</div>
			<div class="item azul2">
				<span class="item">MOTIVO DA PROMOÇÃO:</span>
					<textarea class="ckeditor motivo" cols="80" id="editor1" name="editor1" rows="10"></textarea>
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
			</div>
			<div class="item azul2">
				<span class="item">CARGO À SER PROMOVIDO</span>
				<select id="promovido">
					<option value="">Selecione</option>
				</select>
			</div>
			<div class="botao laranja" onclick="setCKEditorToTextarea();requerimento.promocao();">ENVIAR REQUERIMENTO</div>
	</div>
	<Script>
		$("#membro").selectric();
		$("#membro").change(function() {
			atualizaCargos('promo',this.value,'#promovido');
		});
		$("#promovido").selectric();
	</Script>
<?php
	}
?>

<?php
	if($tipo == "rebaixamento") {
?>
<link rel="stylesheet" href="arquivos/css/chosen.min.css"/>
<script src="arquivos/javascript/chosen.jquery.min.js" type="text/javascript"></script>
	<div class="box">
		<div class="titulo preto">
			FORMULÁRIO DE REBAIXAMENTO DE MEMBRO
			<div class="icone">
				<i class="demo-icon icon-user-delete"></i>
			</div>
		</div>
		<div class="corpo">
			<div class="item azul2">
				<span class="item">MEMBRO À SER REBAIXADO:</span>
				<select id="membro">
					<option value="">Selecione o membro</option>
					<?php
						$sMaior = $mysqli->query("SELECT * FROM cargos ORDER BY nvhie DESC")->fetch_array();
						$permitido = $dadosCargo['nvhie']+1;
						$sql = $mysqli->query("SELECT * FROM usuarios WHERE ativo='1' ORDER BY nick ASC");
						while($usus = $sql->fetch_array()) {
							$car = $mysqli->query("SELECT * FROM cargos WHERE id='".$usus['cargo_id']."'")->fetch_array();
							if($car['nvhie'] < $permitido) {
								echo"<option value='".$usus['id']."'>".$usus['nick']."</option>";
							}
						}
					?>
				</select>
			</div>
			<div class="item azul2">
				<span class="item">MOTIVO DO REBAIXAMENTO:</span>
					<textarea class="ckeditor motivo" cols="80" id="editor1" name="editor1" rows="10"></textarea>
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
			</div>
			<div class="item azul2">
				<span class="item">CARGO À SER REBAIXADO</span>
				<select id="rebaixado">
					<option value="">Selecione o membro</option>
				</select>
			</div>
			<div class="botao laranja" onclick="setCKEditorToTextarea();requerimento.rebaixamento();">ENVIAR REQUERIMENTO</div>
	</div>
	<Script>
		$("#membro").selectric();
		$("#membro").change(function() {
			atualizaCargos('rebai',this.value,'#rebaixado');
		});
		$("#rebaixado").selectric();
	</Script>
<?php
	}
?>

<?php
	if($tipo == "expulsa") {
?>
		<div class="box">
			<div class="titulo preto">
				FORMULÁRIO DE EXPULSÃO DE MEMBRO DA COMPANHIA
				<div class="icone">
					<i class="demo-icon icon-cancel-circle-2"></i>
				</div>
			</div>
			<div class="corpo">
				<div class="item azul2">
					<span class="item">NICK DO USUÁRIO</span>
					<select id="membro">
						<option value="">Selecione o membro</option>
						<?php
							$sMaior = $mysqli->query("SELECT * FROM cargos ORDER BY nvhie DESC")->fetch_array();
							if($dadosCargo['nvhie'] == $sMaior['nvhie']) {
								$permitido = $dadosCargo['nvhie']+1;
							}else {
								$permitido = $dadosCargo['nvhie']-1;
							}
							$sql = $mysqli->query("SELECT * FROM usuarios WHERE ativo='1' ORDER BY nick ASC");
							while($usus = $sql->fetch_array()) {
								$car = $mysqli->query("SELECT * FROM cargos WHERE id='".$usus['cargo_id']."'")->fetch_array();
								if($car['nvhie'] < $permitido) {
									echo"<option value='".$usus['id']."'>".$usus['nick']."</option>";
								}
							}
						?>
					</select>
				</div>
				<div class="item azul2">
					<span class="item">MOTIVO DA EXPULSÃO</span>
					<textarea class="ckeditor motivo" cols="80" id="editor1" name="editor1" rows="10"></textarea>
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
				</div>
				<div class="botao laranja" onclick="setCKEditorToTextarea();requerimento.expulsao();">ENVIAR REQUERIMENTO</div>
			</div>
		</div>
		<script>
			$("#membro").selectric();
		</script>
<?php
	}
?>

<?php
	if($tipo == "saida") {
		?>
			<div class="box">
				<div class="titulo preto">FORMULÁRIO PARA SAÍDA DA COMPANHIA
				<div class="icone"><i class="demo-icon icon-logout-2"></i></div></div>
				<div class="corpo">
					<div class="item azul2">
						<span class="item">MOTIVO DA SAÍDA</span>
						<textarea class="ckeditor motivo" cols="80" id="editor1" name="editor1" rows="10"></textarea>
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
					</div>
					<div class="item azul2">
						<span class="item">Policial que permitiu:</span><br>
						<select id="permitiu">
							<option value="">Selecione</option>
							<?php
								$sql = $mysqli->query("SELECT * FROM usuarios WHERE ativo='1' ORDER BY nick ASC");
								while($usu = $sql->fetch_array()) {
									$cargo = $mysqli->query("SELECT * FROM cargos WHERE id='".$usu['cargo_id']."'")->fetch_array();
									if($cargo['nvhie']>=5) {
										echo"<option value='".$usu['id']."'>".$usu['nick']."</option>";
									}
								}
							?>
						</select>
						<script>
							$("#permitiu").selectric();
						</script>
					</div>
					<div class="botao laranja" onclick="setCKEditorToTextarea();requerimento.saida();">ENVIAR REQUERIMENTO</div>
				</div>
			</div>
		<?php
	}
?>
<div id="reqresults"></div>