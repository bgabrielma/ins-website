<?php
	require_once("../../../configura/config.php");
	$id = $_POST['id'];
	$dados = $mysqli->query("SELECT * FROM usuarios WHERE id='$id'")->fetch_array();
?>
			<div class="titulo verde">
				<?php echo $dados['nick']; ?> (HISTÓRICO)
				<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
			</div>
			<div class="corpo">
				<div class="local" style="margin:0px;width:113px;">
					<div class="avatar" style="background-image:url('https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=gif&user=<?php echo $dados['nick']; ?>&action=wav&direction=3&head_direction=3&gesture=sml&size=l');"></div>
					<div style="clear:both;"></div>
					<div class="botao verde" style="text-align:center;" onclick="lista.perfil('<?php echo $id; ?>','<?php echo $dados['nick']; ?>');">voltar</div>
				</div>
				<div class="local" style="margin: 0px;margin-left: 10px;width: 357px;text-align: right;">
<?php
	$req = $mysqli->query("SELECT * FROM requerimentos ORDER BY id DESC");
	while($re = $req->fetch_array()) {
		$r_expulsa = $mysqli->query("SELECT * FROM r_expulsa WHERE id='".$re['id']."' AND membro_id='$id'");
		$r_licenca = $mysqli->query("SELECT * FROM r_licenca WHERE id='".$re['id']."' AND usuario_id='$id'");
		$r_promocao = $mysqli->query("SELECT * FROM r_promocao WHERE id='".$re['id']."' AND usuario_id='$id'");
		$r_rebaixamento = $mysqli->query("SELECT * FROM r_rebaixamento WHERE id='".$re['id']."' AND usuario_id='$id'");
		$r_saida = $mysqli->query("SELECT * FROM r_saida WHERE id='".$re['id']."' AND usuario_id='$id'");
		$r_volta = $mysqli->query("SELECT * FROM r_volta WHERE id='".$re['id']."' AND usuario_id='$id'");
		if($r_expulsa->num_rows == 1) {
			$dad = $r_expulsa->fetch_array();
			$passou = 1;
			$texto = "<b>".$dados['nick']."</b> foi expulso em <b>".$re['data']."</b>.<br><b>Motivo:</b>.";
		}elseif($r_licenca->num_rows == 1) {
			$dad = $r_licenca->fetch_array();
			$passou = 1;
			$texto = "<b>".$dados['nick']."</b> entrou em licença. <b>De</b> ".$dad['inicio']." <b>até</b> ".$dad['termino'].".<br><b>Motivo:</b> ".$dad['motivo'];
		}elseif($r_promocao->num_rows == 1) {
			$dad = $r_promocao->fetch_array();
			$passou = 1;
			$cargoAtual = $mysqli->query("SELECT * FROM cargos WHERE id='".$dad['cargoAtual_id']."'")->fetch_array();
			$cargo = $mysqli->query("SELECT * FROM cargos WHERE id='".$dad['cargo_id']."'")->fetch_array();
			$texto = "<b>".$dados['nick']."</b> foi promovido de <b>".$cargoAtual['nome']."</b> à <b>".$cargo['nome']."</b>, em ".$re['data'].".<br><b>Motivo:</b> ".$dad['motivo'];
		}
			if($passou==1) {
		?>
					<div class="nick" style="margin:7px 0px;text-align:left;"><?php echo $texto; ?></div>
		<?php
			}
			$texto = "";
			$passou = "";
	}
?>

				</div>
				<div style="clear:both;"></div>
			</div>
			<div style="clear:both;"></div>