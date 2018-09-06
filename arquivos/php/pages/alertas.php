<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	require_once("../../configura/config.php");
?>
<div class="coluna" id="umdois" style="width:100%;">
	<div class="botao sessao verde2" style="padding: 19px 14px;font-size: 14px;font-weight: bold;" onclick="alerta.opcao('abrir')">INSERIR UM ALERTA/AVISO</div>
</div>
<div class="coluna" id="um" style="width:0px;opacity:0;height:0">
	<div class="botao sessao verde2" style="padding: 19px 14px;font-size: 14px;font-weight: bold;" onclick="alerta.opcao('fechar')">FECHAR O FORMULÁRIO</div>
	<div class="box">
		<div class="titulo azul2">
			FORMULÁRIO DE ADIÇÃO DE ALERTA/AVISO
			<div class="icone">
				<i class="demo-icon  icon-list-add"></i>
			</div>
		</div>
		<div class="corpo">
			<div class="item cinza">
				<span class="item">TÍTULO</span>
				<div class="input">
					<div class="icone"><i class="demo-icon icon-bookmark-2"></i></div>
					<input type="text" name="titulo" id="titulo" placeholder="Título do alerta."/>
				</div>
			</div>
			<div class="item cinza">
				<span class="item">TIPO</span>
				<div class="input">
					<select id="tipo">
						<option value="">Selecione</option>
						<option value="1">Alertas</option>
						<option value="2">Avisos</option>
						<option value="3">Eventos</option>
						<option value="4">Portarias</option>
						<option value="5">Aviso Técnico</option>
					</select>
					<script>
						$("#tipo").selectric();
					</script>
				</div>
			</div>
			<div class="item cinza">
				<span class="item">CARGOS QUE IRÃO VER</span>
				<div class="input">
					<?php
						$carg = $mysqli->query("SELECT * FROM cargos ORDER BY id");
						while($cargos = $carg->fetch_array()) {
					?>
						<input type="checkbox" class="opcao" id="a<?php echo $cargos['id']; ?>" name="permissao[]" value="<?php echo $cargos['id']; ?>">
                  		<label for="a<?php echo $cargos['id']; ?>"><?php echo $cargos['nome']; ?></label><br>
					<?php
						}
					?>
				</div>
			</div>
			<div class="item cinza">
				<span class="item">DESCRIÇÃO</span>
				<div class="item">
					<textarea class="ckeditor descricao" cols="80" id="editor1" name="editor1" rows="10"></textarea>
				</div>
			</div>
			<div class="item cinza">
				<span class="item">CONTEÚDO</span>
				<div class="item">
					<textarea class="ckeditor conteudo" cols="80" id="editor2" name="editor1" rows="10"></textarea>
				    <script type="text/javascript">
						CKEDITOR.replace( 'editor1', {
							// Define the toolbar groups as it is a more accessible solution.
							toolbarGroups: [
								{"name":"basicstyles","groups":["basicstyles"]}
							]
						} );
						CKEDITOR.replace( 'editor2', {
							// Define the toolbar groups as it is a more accessible solution.
							toolbarGroups: [
								{"name":"basicstyles","groups":["basicstyles"]}
							]
						} );
			      		CKEDITOR.instances[instanceName].updateElement();
			      		CKEDITOR.instances[instanceName].updateElement();
      					CKEDITOR.replace( 'editor1');
      					CKEDITOR.replace( 'editor2');
    				</script>  
					<script type="text/javascript">
						function setCKEditorToTextarea() {
							for(var instanceName in CKEDITOR.instances)
								CKEDITOR.instances[instanceName].updateElement();            
						}
					</script>
				</div>
			</div>
			<div class="botao azul2" onclick="setCKEditorToTextarea();alerta.adicionar()">ENVIAR</div>
		</div>
	</div>
</div>
<div class="coluna" id="dois" style="width:100%">
			<div class="sessao">ALERTAS E EVENTOS</div>
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
					<div class="box">
						<div class="titulo <?php echo $estilo; ?>">
							<?php echo $evento['titulo']; ?>
							<div class="icone">
								<i onclick="alerta.deleta('<?php echo $evento['id']; ?>','');" class="demo-icon icon-cancel-circled-2" style="cursor:pointer;"></i>
								<i onclick="alerta.editar('<?php echo $evento['id']; ?>');" class="demo-icon icon-edit" style="cursor:pointer;"></i>
							</div>
						</div>
						<div class="corpo">
							<?php echo $evento['descricao']; ?>
							<hr>
							<?php echo $evento['conteudo']; ?>
						</div>
					</div>
		<?php
				}
			}
		?>
	<div id="reqresults"></div>
</div>