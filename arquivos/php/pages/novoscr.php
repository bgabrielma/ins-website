<?php
	require_once("../../configura/config.php");
?>
<div class="coluna" style="width:100%">
	<div class="box">
		<div class="titulo azul2">ADICIONAR SCRIPT</div>
		<div class="corpo">
			<div class="item azul2">
				<span class="item">TÍTULO</span>
				<div class="input">
					<div class="icone"><i class="demo-icon icon-newspaper-1"></i></div>
					<input type="text" id="titulo"/>
				</div>
			</div>
			<div class="item azul2">
				<span class="item">CARGOS COM PERMISSÃO</span>
				<?php
					$sql = $mysqli->query("SELECT * FROM cargos ORDER BY nvhie DESC");
					while($carg = $sql->fetch_array()) {
				?>
				<input class="permissao" type="checkbox" name="permissao[]" value='<?php echo $carg['id']; ?>' data-labelauty="<?php echo $carg['nome']; ?>"/>
				<?php } ?>
				<div style="clear:both;"></div>
			</div>
			<Div class="item azul2">
				<span class="item">CONTEÚDO</span>
				<textarea class="ckeditor conteudo" cols="80" id="editor1" name="editor1" rows="10"></textarea>
				<script type="text/javascript">
      				CKEDITOR.replace( 'editor1');
      				CKEDITOR.instances[instanceName].updateElement();
    			</script>  
				<script type="text/javascript">
					function setCKEditorToTextarea() {
						for(var instanceName in CKEDITOR.instances)
							CKEDITOR.instances[instanceName].updateElement();            
					}
				</script>
			</Div>
			<div class="botao azul2" onclick="setCKEditorToTextarea();script.adiciona();">ADICIONAR SCRIPT</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$(".permissao").labelauty();
	});
</script>
<Div id="reqresults"></Div>