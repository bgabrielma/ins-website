<?php
	require_once("../../../configura/config.php");
	$id = $_POST['id'];
	$dados = $mysqli->query("SELECT * FROM usuarios WHERE id='$id'")->fetch_array();
	$cargo = $mysqli->query("SELECT * FROM cargos WHERE id='".$dados['cargo_id']."'")->fetch_array();
	$consulta = $mysqli->query("SELECT * FROM r_promocao WHERE usuario_id='$id' ORDER BY id DESC LIMIT 1");
	if($consulta->num_rows == 1) {
		$promo = $consulta->fetch_array();
		$pega = $mysqli->query("SELECT * FROM requerimentos WHERE id='".$promo['id']."'")->fetch_array();
		$prom = $pega['data'];
	}else {
		$prom = $dados['entrada'];
	}
?>
<div id="results">
	<div class="box">
		<div class="titulo preto">
			<?php echo $dados['nick']; ?> - <?php echo $cargo['nome']; ?>
			<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
		</div>
		<div class="corpo">
			<div class="local" style="margin:0px;width:113px;">
				<div class="avatar" style="background-image:url('https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=gif&user=<?php echo $dados['nick']; ?>&action=wav&direction=3&head_direction=3&gesture=sml&size=l');"></div>
				<div style="clear:both;"></div>
				<div class="botao verde" style="text-align:center;" onclick="lista.historico('<?php echo $dados['id'] ?>');">histórico</div>
			</div>
			<div class="local" style="margin: 0px;margin-left: 10px;width: 357px;text-align: right;">
				<div class="nick" style="margin:7px 0px;text-align:left;"><b>Nick:</b> <?php echo $dados['nick']; ?></div>
				<div class="nick" style="margin:7px 0px;text-align:left;"><b>Cargo:</b> <?php echo $cargo['nome']; ?></div>
				<div class="nick" style="margin:7px 0px;text-align:left;"><b>Entrada:</b> <?php echo $dados['entrada']; ?></div>
				<div class="nick" style="margin:7px 0px;text-align:left;"><b>Última promoção:</b> <?php echo $prom; ?></div>
			</div>
			<div style="clear:both;"></div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div style="clear:both;"></div>
</div>