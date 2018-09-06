<?php
	require_once("../../../configura/config.php");
	$id = $_POST['id'];
	$membro = $mysqli->query("SELECT * FROM usuarios WHERE id='$id'")->fetch_array();
?>
<div class="coluna" style="width:100%;">
<div class="botao rosa" onclick="carrega('gerenciarmembros','');">VOLTAR AO GERENCIAMENTO DE MEMBROS</div>
	<div class="box">
		<div class="titulo azul2">
			EDITAR <?php echo $membro['nick']; ?>
		</div>
		<div class="corpo">
			<div class="item azul2">
				<span class="item">NICK</span>
				<div class="input">
					<div class="icone"><i class="demo-icon icon-user"></i></div>
					<input type="text" name="nick" id="nick" value="<?php echo $membro['nick']; ?>"/>
				</div>
			</div>
			<div class="item azul2">
				<span class="item">EMAIL</span>
				<div class="input">	
					<div class="icone"><i class="demo-icon icon-mail-6"></i></div>
					<input type="text" name="email" id="email" value="<?php echo $membro['email']; ?>"/>
				</div>
			</div>
			<div class="item azul2">
				<span class="item">TAG</span>
				<div class="input">
					<div class="icone"><i class="demo-icon icon-tag-3"></i></div>
					<input type="text" name="tag" id="tag" value="<?php echo $membro['tag']; ?>"/>
				</div>
			</div>
			<div class="item cinza">
				<span class="item">SENHA</span>
				<div class="input">
					<div class="icone"><i class="demo-icon icon-lock-filled"></i></div>
					<input type="password" name="senha" id="senha" value="<?php echo $membro['senha']; ?>"/>
				</div>
			</div>
			<div class="botao laranja" onclick="membros.edit('<?php echo $id; ?>');">EDITAR USUÁRIO</div>
		</div>
	</div>
</div>
<script>
	inputs();
</script>
<div id="reqresults"></div>