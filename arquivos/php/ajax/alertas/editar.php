<?php
	require_once("../../../configura/config.php");
	$id = $_POST['id'];
	$info = $mysqli->query("SELECT * FROM alertas WHERE id='$id'")->fetch_array();
	$cargo = explode(",", $info['cargos_id']);
?>
<div class="coluna" style="width:100%;">
	<div class="box">
		<div class="titulo azul2">
			EDITANDO - <?php echo $info['titulo']; ?>
			<div class="icone">
				<i class="demo-icon  icon-list-add"></i>
			</div>
		</div>
		<div class="corpo">
			<div class="item cinza">
				<span class="item">TÍTULO</span>
				<div class="input">
					<div class="icone"><i class="demo-icon icon-bookmark-2"></i></div>
					<input type="text" name="titulo" id="titulo" value="<?php echo $info['titulo']; ?>"/>
				</div>
			</div>
			<div class="item cinza">
				<span class="item">TIPO</span>
				<div class="input">
					<select id="tipo">
						<option value="">Selecione</option>
						<option <?php if($info['tipo'] == 1) { echo "selected"; } ?> value="1">Alertas</option>
						<option <?php if($info['tipo'] == 2) { echo "selected"; } ?> value="2">Avisos</option>
						<option <?php if($info['tipo'] == 3) { echo "selected"; } ?> value="3">Eventos</option>
						<option <?php if($info['tipo'] == 4) { echo "selected"; } ?> value="4">Portarias</option>
						<option <?php if($info['tipo'] == 5) { echo "selected"; } ?> value="5">Aviso Técnico</option>
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
						$sql = $mysqli->query("SELECT * FROM cargos ORDER BY nvhie DESC");
						while($carg = $sql->fetch_array()) {
					?>
					<input <?php foreach($cargo as $cid) { if($cid == $carg['id']) { echo"checked"; brek; } } ?> class="permissao" type="checkbox" name="permissao[]" value='<?php echo $carg['id']; ?>' data-labelauty="<?php echo $carg['nome']; ?>"/>
					<?php } ?>
				</div>
				<div style="clear:both;"></div>
			</div>
			<div class="item cinza">
				<span class="item">DESCRIÇÃO</span>
				<div class="item">
					<textarea class="ckeditor descricao" cols="80" id="editor1" name="editor1" rows="10">
						<?php echo $info['descricao']; ?>
					</textarea>
				</div>
			</div>
			<div class="item cinza">
				<span class="item">CONTEÚDO</span>
				<div class="item">
					<textarea class="ckeditor conteudo" cols="80" id="editor2" name="editor1" rows="10">
						<?php echo $info['conteudo']; ?>
					</textarea>
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
			<div class="botao azul2" onclick="setCKEditorToTextarea();alerta.edita('<?php echo $id; ?>')">ENVIAR</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$(".permissao").labelauty();
	});
	inputs();
</script>
<Div id="reqresults"></Div>