<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	require_once("../../configura/config.php");
	$tipo = addslashes($_POST['tipo']);
?>

<?php
	// Checa dados do pedido de licença //
	if($tipo == "licenca") {
		$termino = addslashes($_POST['termino']);
		$motivo = addslashes($_POST['motivo']);
		$permitiu = addslashes($_POST['permitiu']);
		$inicio = date('d/m/Y');
		$id = $dadosUsu['id'];
		if($termino == "") {
			$erroData = "- Insira a data do fim da licença.<br>";
		}else {
			$termino2 = explode("/", $termino);
			$dia = $termino2[0];
			$mes = $termino2[1];
			$ano = $termino2[2];
			function validateDate($date, $format) {
	    		$d = DateTime::createFromFormat($format, $date);
    			return $d && $d->format($format) == $date;
			}
			$checaData = validateDate($dia.'/'.$mes.'/'.$ano,'d/m/Y');
			if($checaData == false) {
				$edata = 1;
				$erroData = "- Insira data e hora corretos do fim da licença.<br>";
			}else {
				$term = mktime(00,00,00,$mes,$dia,$ano);
				if($dadosCargo['nvhie']>=5) {
					$limite = mktime(00,00,00,date('m'),date('d')+20,date('Y'));
					$dias = "20";
				}else {
					$limite = mktime(00,00,00,date('m'),date('d')+30,date('Y'));
					$dias = "30";
				}
				$minimo = mktime(00,00,00,date('m'),date('d')+5,date('Y'));
				$data = time();
				if($term>$limite) {
					$erroData = "- O fim da licença ultrapassou o limite de ".$dias." dias permitidos.<br>";
				}elseif($term<$minimo) {
					$erroData = "- O fim da licença está abaixo do mínimo permitido de 5 dias.<br>";
				}elseif($term<$data) {
					$erroData = "- Insira a data válida do fim da semana.<br>";
				}
			}
		}

		if($motivo == "") {
			$erroMotivo = "-Insira o motivo de sua licença.<br>";
		}

		if($permitiu == "") {
			$erroPermitiu = "- Você deve selecionar o membro que permitiu sua licença.<br>";
		}else {
			$sql = $mysqli->query("SELECT * FROM usuarios WHERE id='$permitiu'")->fetch_array();
			$cargo = $mysqli->query("SELECT * FROM cargos WHERE id='".$sql['cargo_id']."'")->fetch_array();
			if($cargo['nvhie']<7 OR $cargo['nvhie']>9) {
				$erroPermitiu = "- O policial que permitiu a licença não pode dar este tipo de permissão.<br>";
			}
		}
		if(isset($erroData) OR isset($erroMotivo) OR isset($erroPermitiu)) {
			?>
				<div id="results">
					<div class="box">
						<div class="titulo vermelho">
							ERROS FORAM ENCONTRADOS
							<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
						</div>
						<div class="corpo">
							<?php echo $erroData.$erroMotivo.$erroPermitiu; ?>
						</div>
					</div>
				</div>
			<?php
		}else {
			$id = addslashes($dadosUsu['id']);
			$inicio = date('d/m/Y');
$passagem = $dadosUsu['passagem'];
			$mysqli->query("INSERT INTO requerimentos (id,passagem,data) VALUES('','$passagem','$inicio')");
			$requerimento_id = $mysqli->insert_id;
			$mysqli->query("INSERT INTO r_licenca (id,usuario_id,inicio,termino,motivo,permissao_id) VALUES('$requerimento_id','$id','$inicio','$termino','$motivo','$permitiu')");
			$mysqli->query("UPDATE usuarios SET licenca='1' WHERE id='$id'");
			?>
				<div id="results">
					<div class="box">
						<div class="titulo verde2">
							SEU REQUERIMENTO FOI ABERTO
							<div class="icone" style="cursor:pointer;" onclick="fechar('inicio');"><i class="demo-icon icon-cancel-6"></i></div>
						</div>
						<div class="corpo">
							Licença postada com sucesso, informamos que será confirmada pelo policial que permitiu.<br>
							Caso seja mentira, estará sujeito a punições.
						</div>
					</div>
				</div>
			<?php
		}
	}
?>

<?php
	if($tipo == "volta") {
		if($dadosUsu['licenca'] == 0) {
			?>
				<div id="results">
					<div class="box">
						<div class="titulo vermelho">
							ERROS FORAM ENCONTRADOS
							<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
						</div>
						<div class="corpo">
							Você não se encontra em licença de serviço.
						</div>
					</div>
				</div>
			<?php
		}else {
		$voltou = date('d/m/Y');
		$passagem = $dadosUsu['passagem'];
		$mysqli->query("INSERT INTO requerimentos (id,passagem,data) VALUES('','$passagem','$voltou')");
		$requerimento_id = $mysqli->insert_id;
		$id = $dadosUsu['id'];
		$mysqli->query("INSERT INTO r_volta (id,usuario_id,voltou) VALUES ('$requerimento_id','$id','$voltou')");
		$mysqli->query("UPDATE usuarios SET licenca='0' WHERE id='$id'");
	?>
			<div id="results">
				<div class="box">
					<div class="titulo verde2">
						SUA VOLTA FOI POSTADA
						<div class="icone" style="cursor:pointer;" onclick="fechar('inicio');"><i class="demo-icon icon-cancel-6"></i></div>
					</div>
					<div class="corpo">
						Sua volta da licença foi acionada. Seja bem-vindo de volta <?php echo $dadosCargo['nome']." ".$dadosUsu['nick']; ?>
					</div>
				</div>
			</div>
	<?php
		}
	}
?>

<?php
	if($tipo == "promocao") {
		$membro = addslashes($_POST['membro']);
		$motivo = addslashes($_POST['motivo']);
		$promovido = addslashes($_POST['promovido']);
		if($membro == "") {
			$erroMembro = "Insira o membro à ser promovido.<br>";
		}

		if($motivo == "") {
			$erroMotivo = "Insira o motivo para promoção.<br>";
		}

		if($promovido == "") {
			$erroPromovido = "Insira o cargo para o qual a pessoa foi promovida.<br>";
		}

		if(isset($erroMembro) OR isset($erroMotivo) OR isset($erroPromovido)) {
			?>
				<div id="results">
					<div class="box">
						<div class="titulo vermelho">
							ERROS FORAM ENCONTRADOS
							<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
						</div>
						<div class="corpo">
							<?php echo $erroMembro.$erroMotivo.$erroPromovido; ?>
						</div>
					</div>
				</div>
			<?php
		}else {
			$dadoMembro = $mysqli->query("SELECT * FROM usuarios WHERE id='$membro'")->fetch_array();
			$data = date('d/m/Y');
			$passagem = $dadoMembro['passagem'];
			$mysqli->query("INSERT INTO requerimentos (id,passagem,data) VALUES('','$passagem','$data')");
			$requerimento_id = $mysqli->insert_id;
			$abriu_id = $dadosUsu['id'];
			$mysqli->query("INSERT INTO r_promocao (id,abriu_id,usuario_id,motivo,cargo_id,cargoAtual_id) VALUES ('$requerimento_id','$abriu_id','$membro','$motivo','$promovido','".$dadoMembro['cargo_id']."')");
			$mysqli->query("UPDATE usuarios SET cargo_id='$promovido' WHERE id='$membro'");
			?>
			<div id="results">
				<div class="box">
					<div class="titulo verde2">
						PROMOÇÃO REALIZADA
						<div class="icone" style="cursor:pointer;" onclick="fechar('listademembros');"><i class="demo-icon icon-cancel-6"></i></div>
					</div>
					<div class="corpo">
						A promoção do <?php echo $dadoMembro['nick']; ?> foi realizada com sucesso.<br>
						Dê os parabéns a ele!
					</div>
				</div>
			</div>
			<?php
		}
	}
?>

<?php
	if($tipo == "rebaixamento") {
		$membro = addslashes($_POST['membro']);
		$motivo = addslashes($_POST['motivo']);
		$rebaixado = addslashes($_POST['rebaixado']);
		if($membro == "") {
			$erroMembro = "Insira o membro à ser promovido.<br>";
		}

		if($motivo == "") {
			$erroMotivo = "Insira o motivo para o rebaixamento.<br>";
		}

		if($rebaixado == "") {
			$erroRebaixado = "Insira o cargo para o qual a pessoa foi rebaixada.<br>";
		}

		if(isset($erroMembro) OR isset($erroMotivo) OR isset($erroPromovido)) {
			?>
				<div id="results">
					<div class="box">
						<div class="titulo vermelho">
							ERROS FORAM ENCONTRADOS
							<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
						</div>
						<div class="corpo">
							<?php echo $erroMembro.$erroMotivo.$erroRebaixado; ?>
						</div>
					</div>
				</div>
			<?php
		}else {
			$dadoMembro = $mysqli->query("SELECT * FROM usuarios WHERE id='$membro'")->fetch_array();
			$data = date('d/m/Y');
			$passagem = $dadoMembro['passagem'];
			$mysqli->query("INSERT INTO requerimentos (id,passagem,data) VALUES('','$passagem','$data')");
			$requerimento_id = $mysqli->insert_id;
			$abriu_id = $dadosUsu['id'];
			$mysqli->query("INSERT INTO r_rebaixamento (id,abriu_id,usuario_id,motivo,cargo_id,cargoAtual_id) VALUES ('$requerimento_id','$abriu_id','$membro','$motivo','$rebaixado','".$dadoMembro['cargo_id']."')");
			$mysqli->query("UPDATE usuarios SET cargo_id='$rebaixado' WHERE id='$membro'");
			?>
			<div id="results">
				<div class="box">
					<div class="titulo verde2">
						REBAIXAMENTO REALIZADA
						<div class="icone" style="cursor:pointer;" onclick="fechar('listademembros');"><i class="demo-icon icon-cancel-6"></i></div>
					</div>
					<div class="corpo">
						O rebaixamento do <?php echo $dadoMembro['nick']; ?> foi realizada com sucesso.<br>
						Auxilie ele!
					</div>
				</div>
			</div>
			<?php
		}
	}
?>

<?php
	if($tipo == "expulsao") {
		$membro = addslashes($_POST['membro']);
		$motivo = addslashes($_POST['motivo']);
		if($membro == "") {
			$erroMembro = "Selecione o membro que irá ser expulso.<br>";
		}
		if($motivo == "") {
			$erroMotivo = "Insira o motivo da expulsão.<br>";
		}

		if(isset($erroMembro) OR isset($erroMotivo)) {
			?>
				<div id="results">
					<div class="box">
						<div class="titulo vermelho">
							ERROS FORAM ENCONTRADOS
							<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
						</div>
						<div class="corpo">
							<?php echo $erroMembro.$erroMotivo; ?>
						</div>
					</div>
				</div>
			<?php
		}else {
			$dadosMembro = $mysqli->query("SELECT * FROM usuarios WHERE id='$membro'")->fetch_array();
			$data = date('d/m/Y');
			$passagem = $dadosMembro['passagem'];
			$mysqli->query("INSERT INTO requerimentos (id,passagem,data) VALUES('','$passagem','$data')");
			$requerimento_id = $mysqli->insert_id;
			$mysqli->query("INSERT INTO r_expulsa (id,membro_id,usuario_id,motivo) VALUES ('$requerimento_id','$membro','".$dadosUsu['id']."','$motivo')");
			$mysqli->query("UPDATE usuarios SET ativo='0', cargo_id='1' WHERE id='$membro'");
			$mysqli->query("INSERT INTO EeS (id,usuario_id,data,tipo) VALUES ('','$membro','$data','1')");
			?>
			<div id="results">
				<div class="box">
					<div class="titulo verde2">
						EXPULSÃO REALIZADA
						<div class="icone" style="cursor:pointer;" onclick="fechar('listademembros');"><i class="demo-icon icon-cancel-6"></i></div>
					</div>
					<div class="corpo">
						O <?php echo $dadosMembro['nick']; ?> foi expulso da companhia.
					</div>
				</div>
			</div>
			<?php
		}
	}
?>

<?php
	if($tipo == "saida") {
		$permitiu = addslashes($_POST['permitiu']);
		$motivo = addslashes($_POST['motivo']);

		if($permitiu == "") {
			$erroPermitiu = "Insira o nick de quem permitiu sua saída da companhia.<bR>";
		}

		if($motivo == "") {
			$erroMotivo = "Insira o motivo da sua saída da companhia.<br>";
		}

		if(isset($erroPermitiu) OR isset($erroMotivo)) {
			?>
				<div id="results">
					<div class="box">
						<div class="titulo vermelho">
							ERROS FORAM ENCONTRADOS
							<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
						</div>
						<div class="corpo">
							<?php echo $erroMembro.$erroMotivo; ?>
						</div>
					</div>
				</div>
			<?php
		}else {
			$dadosMembro = $mysqli->query("SELECT * FROM usuarios WHERE id='$membro'")->fetch_array();
			$data = date('d/m/Y');
			$passagem = $dadosMembro['passagem'];
			$mysqli->query("INSERT INTO requerimentos (id,passagem,data) VALUES('','$passagem','$data')");
			$requerimento_id = $mysqli->insert_id;
			$mysqli->query("INSERT INTO r_saida (id,usuario_id,motivo,permitiu_id) VALUES ('$requerimento_id','".$dadosUsu['id']."','$motivo','$permitiu')");
			$_SESSION['sair'] = 1;
			$mysqli->query("UPDATE usuarios SET ativo='0', cargo_id='1' WHERE id='".$dadosUsu['id']."'");
			$mysqli->query("INSERT INTO EeS (id,usuario_id,data,tipo) VALUES ('','".$dadosUsu['id']."','$data','1')");
			?>
			<div id="results">
				<div class="box">
					<div class="titulo verde2">
						SAÍDA CONCLUÍDA
						<div class="icone" style="cursor:pointer;" onclick="location.reload();"><i class="demo-icon icon-cancel-6"></i></div>
					</div>
					<div class="corpo">
						Você saiu da companhia, por tanto sua conta será automaticamente desativada.<br>
						Sentiremos sua falta na companhia, esperemos que volte!<br>
						Obrigado pelos serviços prestados até aqui. Boa sorte em sua nova jornada.
					</div>
				</div>
			</div>
			<?php
		}
	}
?>