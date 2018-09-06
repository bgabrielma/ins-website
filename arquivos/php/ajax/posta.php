<?php
	require_once("../../configura/config.php");
	$id = addslashes($_POST['id']);
?>
<?php
	if($id == 1) {
		?>
			<div class="box">
				<div class="titulo preto">FORMULÁRIO DE AULAS</div>
				<div class="titulo laranja" style="border-radius:0px;">MEUS DADOS</div>
				<div class="corpo" style="border-radius:0px;">
					<div class="item azul2">
						<span class="item">NICK:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-user-1"></i></div>
							<input type="text" style="cursor: not-allowed; color: #777" readonly="" value="<?php echo $dadosUsu['nick']; ?>"/>
						</div>
					</div>
					<div class="item azul2">
						<span class="item">TAG:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-tag-2"></i></div>
							<input type="text" style="cursor: not-allowed; color: #777" readonly="" value="[<?php echo $dadosUsu['tag']; ?>]"/>
						</div>
					</div>
				</div>
				<div class="titulo laranja" style="border-radius:0px;">DADOS DA AULA</div>
				<div class="corpo">
					<div class="item azul2">
						<span class="item">INÍCIO DA AULA:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-calendar-inv"></i></div>
							<input type="text" id="data" placeholder="DD/MM/AAAA" onkeyup="mascaraData(this.value,'#'+this.id)"/>
						</div>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-clock-circled"></i></div>
							<input type="text" id="hora" placeholder="HH:MM" onkeyup="mascaraHora(this.value,'#'+this.id)"/>
						</div>
					</div>
					<div class="item azul2">
						<span class="item">INSTRUÇÃO PARA</span>
						<input class="ins" type="radio" value='1' name="radio-input" data-labelauty="Não foi para Recrutas|Foi para Recrutas" value=""/>
						<input class="ins" type="radio" value='2' name="radio-input" data-labelauty="Não foi para Cabos - CFC1|Foi para Cabos - CFC1"/>
						<input class="ins" type="radio" value='2' name="radio-input" data-labelauty="Não foi para Cabos - CFC2|Foi para Cabos - CFC2"/>
						<input class="ins" type="radio" value='3' name="radio-input" data-labelauty="Não foi para Subtenentes|Foi para Subtenentes"/>
						<div style="clear:both;"></div>
					</div>
					<div class="item azul2">
						<span class="item">SALA EM QUE FOI APLICADA</span>
						<input class="sala" type="radio" name="sala" value='1' data-labelauty="[INS] Sala de instrução 1"/><br><br>
						<input class="sala" type="radio" name="sala" value='2' data-labelauty="[INS] Sala de Instrução 2"/><br><br>
						<input class="sala" type="radio" name="sala" value='3' data-labelauty="[INS] Sala de Instrução 3"/><br><br>
						<input class="sala" type="radio" name="sala" value='4' data-labelauty="[INS] Sala de Instrução 4"/><br><br>
						<input class="sala" type="radio" name="sala" value='5' data-labelauty="[INS] Sala de Instrução 5"/><br><br>
						<input class="sala" type="radio" name="sala" value='6' data-labelauty="[INS] Sala de Instrução 6"/><br><br>
						<input class="sala" type="radio" name="sala" value='7' data-labelauty="[INS] Sala de Instrução 7"/><br><br>
						<input class="sala" type="radio" name="sala" value='8' data-labelauty="[INS] Sala de Instrução 8"/><br><br>
						<input class="sala" type="radio" name="sala" value='9' data-labelauty="[INS] Sala de Instrução 9"/><br><br>
						<input class="sala" type="radio" name="sala" value='10' data-labelauty="[RCC] BP Aux (Barracas)"/><br><br>
						<input class="sala" type="radio" name="sala" value='11' data-labelauty="Sala de Aula Particular"/><br><br>
						<input class="sala" type="radio" name="sala" value='12' data-labelauty="[INS] Sala de CFC [01]"/><br><br>
						<input class="sala" type="radio" name="sala" value='13' data-labelauty="[INS] Sala de CFC [02]"/><br><br>
						<input class="sala" type="radio" name="sala" value='14' data-labelauty="[INS] Sala de CFC [03]"/><br><br>
						<input class="sala" type="radio" name="sala" value='15' data-labelauty="[INS] Sala de CAP [01]"/><br><br>
						<input class="sala" type="radio" name="sala" value='16' data-labelauty="[INS] Sala de CAP [02]"/><br><br>
						<div style="clear:both;"></div>
					</div>
					<div class="item azul2">
						<span class="item">NICK(S) DO(S) ALUNO(S) PRESENTE(S)</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-users-2"></i></div>
							<input type="text" class="presentes" data-role="tagsinput" />
						</div>
						<script>
							$(document).ready(function(){
								$(".presentes").tagsinput();
							});
						</script>

					</div>
					<div class="item azul2">
						<span class="item">NICK(S) DO(S) ALUNO(S) APROVADO(S)</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-user-add-1"></i></div>
							<input type="text" class="aprovados" data-role="tagsinput" />
						</div>
						<script>
							$(document).ready(function(){
								$(".aprovados").tagsinput();
							});
						</script>
					</div>
					<div class="item azul2">
						<span class="item">QUALIDADE DA AULA</span>
						<input type="radio" name="quali" value="10" class="quali" data-labelauty="Foi excelente."/><br><br>
						<input type="radio" name="quali" value="8" class="quali" data-labelauty="Foi boa."/><br><br>
						<input type="radio" name="quali" value="6" class="quali" data-labelauty="Foi regular."/><br><br>
						<input type="radio" name="quali" value="4" class="quali" data-labelauty="Foi ruim."/><br><br>
						<input type="radio" name="quali" value="2" class="quali" data-labelauty="Foi péssima."/>
						<div style="clear:both;"></div>
					</div>
						<script>
							$(document).ready(function(){
								$(".ins").labelauty();
								$(".sala").labelauty();
								$(".quali").labelauty();
							});
						</script>
					<div class="botao preto" onclick="enviar.ins();">ENVIAR FORMULÁRIO</div>
				</div>
			</div>
		<?php
	}
?>

<?php
	if($id == 2) {
		?>
			<div class="box">
				<div class="titulo preto">FORMULÁRIO DE CFI</div>
				<div class="titulo laranja" style="border-radius:0px;">MEUS DADOS</div>
				<div class="corpo" style="border-radius:0px;">
					<div class="item azul2">
						<span class="item">NICK:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-user-1"></i></div>
							<input type="text" style="cursor: not-allowed; color: #777" readonly="" value="<?php echo $dadosUsu['nick']; ?>"/>
						</div>
					</div>
					<div class="item azul2">
						<span class="item">TAG:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-tag-2"></i></div>
							<input type="text" style="cursor: not-allowed; color: #777" readonly="" value="[<?php echo $dadosUsu['tag']; ?>]"/>
						</div>
					</div>
				</div>
				<div class="titulo laranja" style="border-radius:0px;">DADOS DO TESTE</div>
				<div class="corpo">
					<div class="item azul2">
						<span class="item">INÍCIO DO TESTE:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-calendar-inv"></i></div>
							<input type="text" id="data" placeholder="DD/MM/AAAA" onkeyup="mascaraData(this.value,'#'+this.id)"/>
						</div>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-clock-circled"></i></div>
							<input type="text" id="hora" placeholder="HH:MM" onkeyup="mascaraHora(this.value,'#'+this.id)"/>
						</div>
					</div>
					<div class="item azul2">
						<span class="item">NICK(S) DO(S) APRENDIZ(ES) PRESENTE(S)</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-users-2"></i></div>
							<input type="text" class="presentes" data-role="tagsinput" />
						</div>
						<script>
							$(document).ready(function(){
								$(".presentes").tagsinput();
							});
						</script>

					</div>
					<div class="item azul2">
						<span class="item">NICK(S) DO(S) APRENDIZ(ES) APROVADO(S)</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-user-add-1"></i></div>
							<input type="text" class="aprovados" data-role="tagsinput" />
						</div>
						<script>
							$(document).ready(function(){
								$(".aprovados").tagsinput();
							});
						</script>
					</div>
					<div class="item azul2">
						<span class="item">COMENTÁRIOS SOBRE O TESTE</span>
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
					</div>
					<div class="botao preto" onclick="setCKEditorToTextarea();enviar.cfi();">ENVIAR FORMULÁRIO</div>
				</div>
			</div>
		<?php
	}
?>

<?php
	if($id == 3) {
		?>
			<div class="box">
				<div class="titulo preto">FORMULÁRIO DE AVALIAÇÃO</div>
				<div class="titulo laranja" style="border-radius:0px;">MEUS DADOS</div>
				<div class="corpo" style="border-radius:0px;">
					<div class="item azul2">
						<span class="item">NICK:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-user-1"></i></div>
							<input type="text" style="cursor: not-allowed; color: #777" readonly="" value="<?php echo $dadosUsu['nick']; ?>"/>
						</div>
					</div>
					<div class="item azul2">
						<span class="item">TAG:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-tag-2"></i></div>
							<input type="text" style="cursor: not-allowed; color: #777" readonly="" value="[<?php echo $dadosUsu['tag']; ?>]"/>
						</div>
					</div>
				</div>
				<div class="titulo laranja" style="border-radius:0px;">DADOS DA AVALIAÇÃO</div>
				<div class="corpo">
					<div class="item azul2">
						<span class="item">INÍCIO DA AVALIAÇÃO:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-calendar-inv"></i></div>
							<input type="text" id="data" placeholder="DD/MM/AAAA" onkeyup="mascaraData(this.value,'#'+this.id)"/>
						</div>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-clock-circled"></i></div>
							<input type="text" id="hora" placeholder="HH:MM" onkeyup="mascaraHora(this.value,'#'+this.id)"/>
						</div>
					</div>
					<div class="item azul2">
						<span class="item">QUAL AVALIAÇÃO</span>
						<input class="ava" type="radio" value='1' name="radio-input" data-labelauty="Não foi AV |Foi AV " value=""/>
						<div style="clear:both;"></div>
						<script>
							$(document).ready(function(){
								$(".ava").labelauty();
							});
						</script>
					</div>
					<div class="item azul2">
						<span class="item">NICK(S) DO(S) ALUNO(S) PRESENTE(S)</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-users-2"></i></div>
							<input type="text" class="presentes" data-role="tagsinput" />
						</div>
						<script>
							$(document).ready(function(){
								$(".presentes").tagsinput();
							});
						</script>

					</div>
					<div class="item azul2">
						<span class="item">NICK(S) DO(S) ALUNO(S) APROVADO(S)</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-user-add-1"></i></div>
							<input type="text" class="aprovados" data-role="tagsinput" />
						</div>
						<script>
							$(document).ready(function(){
								$(".aprovados").tagsinput();
							});
						</script>
					</div>
					<div class="item azul2">
						<span class="item">COMENTÁRIOS SOBRE A AVALIAÇÃO</span>
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
					</div>
					<div class="botao preto" onclick="setCKEditorToTextarea();enviar.av();">ENVIAR FORMULÁRIO</div>
				</div>
			</div>
		<?php
	}
?>

<?php
	if($id == 4) {
		?>
			<div class="box">
				<div class="titulo preto">FORMULÁRIO DE CAPACITAÇÃO</div>
				<div class="titulo laranja" style="border-radius:0px;">MEUS DADOS</div>
				<div class="corpo" style="border-radius:0px;">
					<div class="item azul2">
						<span class="item">NICK:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-user-1"></i></div>
							<input type="text" style="cursor: not-allowed; color: #777" readonly="" value="<?php echo $dadosUsu['nick']; ?>"/>
						</div>
					</div>
					<div class="item azul2">
						<span class="item">TAG:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-tag-2"></i></div>
							<input type="text" style="cursor: not-allowed; color: #777" readonly="" value="[<?php echo $dadosUsu['tag']; ?>]"/>
						</div>
					</div>
				</div>
				<div class="titulo laranja" style="border-radius:0px;">DADOS DO TESTE</div>
				<div class="corpo">
					<div class="item azul2">
						<span class="item">INÍCIO DO TESTE:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-calendar-inv"></i></div>
							<input type="text" id="data" placeholder="DD/MM/AAAA" onkeyup="mascaraData(this.value,'#'+this.id)"/>
						</div>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-clock-circled"></i></div>
							<input type="text" id="hora" placeholder="HH:MM" onkeyup="mascaraHora(this.value,'#'+this.id)"/>
						</div>
					</div>
					<div class="item azul2">
						<span class="item">NICK(S) DO(S) APRENDIZ(ES) PRESENTE(S)</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-users-2"></i></div>
							<input type="text" class="presentes" data-role="tagsinput" />
						</div>
						<script>
							$(document).ready(function(){
								$(".presentes").tagsinput();
							});
						</script>

					</div>
					<div class="item azul2">
						<span class="item">NICK(S) DO(S) APRENDIZ(ES) APROVADO(S)</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-user-add-1"></i></div>
							<input type="text" class="aprovados" data-role="tagsinput" />
						</div>
						<script>
							$(document).ready(function(){
								$(".aprovados").tagsinput();
							});
						</script>
					</div>
					<div class="item azul2">
						<span class="item">COMENTÁRIOS SOBRE O TESTE</span>
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
					</div>
					<div class="botao preto" onclick="setCKEditorToTextarea();enviar.cap();">ENVIAR FORMULÁRIO</div>
				</div>
			</div>
		<?php
	}
?>

<?php
	if($id == 5) {
		?>
			<div class="box">
				<div class="titulo preto">FORMULÁRIO DE AVALIAÇÃO DE INSTRUÇÃO</div>
				<div class="titulo laranja" style="border-radius:0px;">MEUS DADOS</div>
				<div class="corpo" style="border-radius:0px;">
					<div class="item azul2">
						<span class="item">NICK:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-user-1"></i></div>
							<input type="text" style="cursor: not-allowed; color: #777" readonly="" value="<?php echo $dadosUsu['nick']; ?>"/>
						</div>
					</div>
					<div class="item azul2">
						<span class="item">TAG:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-tag-2"></i></div>
							<input type="text" style="cursor: not-allowed; color: #777" readonly="" value="[<?php echo $dadosUsu['tag']; ?>]"/>
						</div>
					</div>
					<div class="item azul2">
						<span class="item">NICK DA FAKE</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-user-secret"></i></div>
							<input type="text" name="fake" id="fake">
						</div>
					</div>
				</div>
				<div class="titulo laranja" style="border-radius:0px;">DADOS DA AVALIAÇÃO</div>
				<div class="corpo">
					<div class="item azul2">
						<span class="item">INICIO DA AULA:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-calendar-inv"></i></div>
							<input type="text" id="data" placeholder="DD/MM/AAAA" onkeyup="mascaraData(this.value,'#'+this.id)"/>
						</div>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-clock-circled"></i></div>
							<input type="text" id="hora" placeholder="HH:MM" onkeyup="mascaraHora(this.value,'#'+this.id)"/>
						</div>
					</div>
					<div class="item azul2">
						<span class="item">INSTRUTOR QUE APLICOU A AULA</span>
						<select id="ins">
							<option value="">Selecione</option>
							<?php
								$sql = $mysqli->query("SELECT * FROM usuarios WHERE ativo='1' ORDER BY nick ASC");
								while($membro = $sql->fetch_array()) {
									?>
										<option value="<?php echo $membro['id']; ?>"><?php echo $membro['nick']; ?></option>
									<?php
								}
							?>
						</select>
						<script>
							$("#ins").selectric();
						</script>
					</div>
					<div class="item azul2">
						<span class="item">NÚMERO DE MILITARES RECEBENDO INSTRUÇÃO</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-users-2"></i></div>
							<input type="text" class="presentes"/>
						</div>

					</div>
					<div class="item azul2">
						<span class="item">NÚMERO DE MILITAERS APROVADOS</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-user-add-1"></i></div>
							<input type="text" class="presentes"/>
						</div>
					</div>
					<div class="item azul2">
						<span class="item">SALA EM QUE FOIA PLICADA</span>
						<input class="sala" type="radio" name="sala" value='1' data-labelauty="[INS] Sala de instrução 1"/><br><br>
						<input class="sala" type="radio" name="sala" value='2' data-labelauty="[INS] Sala de Instrução 2"/><br><br>
						<input class="sala" type="radio" name="sala" value='3' data-labelauty="[INS] Sala de Instrução 3"/><br><br>
						<input class="sala" type="radio" name="sala" value='4' data-labelauty="[INS] Sala de Instrução 4"/><br><br>
						<input class="sala" type="radio" name="sala" value='5' data-labelauty="[INS] Sala de Instrução 5"/><br><br>
						<input class="sala" type="radio" name="sala" value='6' data-labelauty="[INS] Sala de Instrução 6"/><br><br>
						<input class="sala" type="radio" name="sala" value='7' data-labelauty="[INS] Sala de Instrução 7"/><br><br>
						<input class="sala" type="radio" name="sala" value='8' data-labelauty="[INS] Sala de Instrução 8"/><br><br>
						<input class="sala" type="radio" name="sala" value='9' data-labelauty="[RCC] Batalhão Auxiliar (Barracas)"/><br><br>
						<input class="sala" type="radio" name="sala" value='10' data-labelauty="Sala de Aula Particular"/><br><br>
						<input class="sala" type="radio" name="sala" value='11' data-labelauty="[INS] Sala de CFC [01]"/><br><br>
						<input class="sala" type="radio" name="sala" value='12' data-labelauty="[INS] Sala de CFC [02]"/><br><br>
						<div style="clear:both;"></div>
						<script>
							$(document).ready(function(){
								$(".sala").labelauty();
							});
						</script>
					</div>
					<div class="item azul2">
						<span class="item">NOTA</span>
						<input class="nota" type="radio" name="nota" value='1' data-labelauty="1"/>
						<input class="nota" type="radio" name="nota" value='2' data-labelauty="2"/>
						<input class="nota" type="radio" name="nota" value='3' data-labelauty="3"/>
						<input class="nota" type="radio" name="nota" value='4' data-labelauty="4"/>
						<input class="nota" type="radio" name="nota" value='5' data-labelauty="5"/>
						<input class="nota" type="radio" name="nota" value='6' data-labelauty="6"/>
						<input class="nota" type="radio" name="nota" value='7' data-labelauty="7"/>
						<input class="nota" type="radio" name="nota" value='8' data-labelauty="8"/>
						<input class="nota" type="radio" name="nota" value='9' data-labelauty="9"/>
						<input class="nota" type="radio" name="nota" value='10' data-labelauty="10"/>
						<div style="clear:both;"></div>
						<script>
							$(document).ready(function(){
								$(".nota").labelauty();
							});
						</script>
					</div>
					<div class="item azul2">
						<span class="item">COMENTÁRIOS SOBRE A AVALIAÇÃO</span>
						<textarea class="ckeditor comentario" cols="80" id="editor1" name="editor1" rows="10"></textarea>
						<script type="text/javascript">
							CKEDITOR.replace( 'editor1', {
								// Define the toolbar groups as it is a more accessible solution.
								toolbar: [
									{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','Image' ] }
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
					<div class="botao preto">ENVIAR FORMULÁRIO</div>
				</div>
			</div>
		<?php
	}
?>

<?php
	if($id == 6) {
		?>
			<div class="box">
				<div class="titulo preto">FORMULÁRIO DE TESTE DE ADMISSÃO</div>
				<div class="titulo laranja" style="border-radius:0px;">MEUS DADOS</div>
				<div class="corpo" style="border-radius:0px;">
					<div class="item azul2">
						<span class="item">NICK:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-user-1"></i></div>
							<input type="text" style="cursor: not-allowed; color: #777" readonly="" value="<?php echo $dadosUsu['nick']; ?>"/>
						</div>
					</div>
					<div class="item azul2">
						<span class="item">TAG:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-tag-2"></i></div>
							<input type="text" style="cursor: not-allowed; color: #777" readonly="" value="[<?php echo $dadosUsu['tag']; ?>]"/>
						</div>
					</div>
				</div>
				<div class="titulo laranja" style="border-radius:0px;">DADOS DO TESTE</div>
				<div class="corpo">
					<div class="item azul2">
						<span class="item">INÍCIO DO TESTE:</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-calendar-inv"></i></div>
							<input type="text" id="data" placeholder="DD/MM/AAAA" onkeyup="mascaraData(this.value,'#'+this.id)"/>
						</div>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-clock-circled"></i></div>
							<input type="text" id="hora" placeholder="HH:MM" onkeyup="mascaraHora(this.value,'#'+this.id)"/>
						</div>
					</div>
					<div class="item azul2">
						<span class="item">NICK(S) DO(S) PRESENTE(S)</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-users-2"></i></div>
							<input type="text" class="presentes" data-role="tagsinput" />
						</div>
						<script>
							$(document).ready(function(){
								$(".presentes").tagsinput();
							});
						</script>

					</div>
					<div class="item azul2">
						<span class="item">NICK(S) DO(S) APROVADO(S)</span>
						<div class="input">
							<div class="icone"><i class="demo-icon icon-user-add-1"></i></div>
							<input type="text" class="aprovados" data-role="tagsinput" />
						</div>
						<script>
							$(document).ready(function(){
								$(".aprovados").tagsinput();
							});
						</script>
					</div>
					<div class="item azul2">
						<span class="item">CAPACITAÇÃO</span>
						<input class="capacitado" type="checkbox" name="capacitado" value='1' data-labelauty="Não foi capacitado(a)|Foi capacitado(a)"/>
						<div style="clear:both;"></div>
						<script>
							$(document).ready(function(){
								$(".capacitado").labelauty();
							});
						</script>
					</div>
					<div class="item azul2">
						<span class="item">COMENTÁRIOS SOBRE O TESTE</span>
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
					</div>
					<div class="botao preto" onclick="setCKEditorToTextarea();enviar.admi();">ENVIAR FORMULÁRIO</div>
				</div>
			</div>
		<?php
	}