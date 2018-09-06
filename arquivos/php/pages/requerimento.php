<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	require_once("../../configura/config.php");
?>
<div class="coluna" style="width:100%">
	<div class="botao vermelho" onclick="carrega('listademembros','');">LISTA DE MEMBROS</div>
	<div class="box">
		<div class="titulo azul2">
			ABRIR REQUERIMENTO
			<div class="icone">
				<i class="demo-icon icon-book-open"></i>
			</div>
		</div>
		<div class="corpo">
			<select style="width:100%" id="req" onchange="formulario(this.value);">
				<option value="">Selecione</option>
				<option value="licenca">Licença da Companhia</option>
				<option value="volta">Volta de licença da Companhia</option>
				<option value="saida">Saida da Companhia</option>

				<?php
					if($dadosCargo['nvhie'] == 3 Or $dadosCargo['nvhie'] >= 5) {
						echo"<option value='promocao'>Promoção de membro</option>";
					}
					if($dadosCargo['nvhie'] >= 5) {
						echo"<option value='rebaixamento'>Rebaixamento de membro</option>";
						echo"<option value='expulsa'>Expulsão de membro da Companhia</option>";
					}
				?>
			</select>
		</div>
	</div>
	<div id="recebe" style="display:none;"></div>
</div>
			  <script type="text/javascript">
			  	$("#req").selectric();
  			</script>