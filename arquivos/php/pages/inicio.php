	<?php

		error_reporting(0);
		ini_set(“display_errors”, 0 );
		require_once("../../configura/config.php");
		$semana = strftime("%U", mktime(0,0,0,date('m'),date('d'),date('Y')));
		$aSemana = $mysqli->query("SELECT * FROM quantidade WHERE instrutor_id='".$dadosUsu['id']."' AND semana='".$semana."' AND ano='".date('Y')."'")->fetch_array();
		if($aSemana['aulas'] == "") {
			$aulas = "Nenhuma";
		}else {
			$aulas = $aSemana['aulas'];
		}
		$aMes = $mysqli->query("SELECT * FROM quantidademensal WHERE instrutor_id='".$dadosUsu['id']."' AND mes='".date('m')."' AND ano='".date('Y')."'")->fetch_array();
		if($aMes['aulas'] == "") {
			$aulasM = "Nenhuma";
		}else {
			$aulasM = $aMes['aulas'];
		}

	?>
	<div class="coluna" id="a1" style="width:58%">
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
						<div onclick="carrega('alerta','<?php echo $evento['id']; ?>');" class="titulo <?php echo $estilo; ?> botao">
							<?php echo $evento['titulo']; ?>
							<div class="icone">
								<i class="demo-icon <?php echo $icone; ?>"></i>
							</div>
						</div>
						<div class="corpo">
							<?php echo $evento['descricao']; ?>
						</div>
					</div>
		<?php
				}
			}
		?>
	</div>
	<div class="coluna" id="a2" style="width:41%">
		<div class="box" style="margin:0px">
			<div class="titulo marrom2">Mais instruções na semana passada <div class="icone"><i class="demo-icon icon-trophy"></i></div></div>
			<div class="corpo">
				<?php
					$semana = strftime("%U", mktime(0,0,0,date('m'),date('d'),date('Y')));
					$semana = $semana-1;
					$ano = date('Y');
					$sql = "SELECT * FROM quantidade WHERE semana='$semana' AND ano='$ano' ORDER BY aulas DESC";
					$info = $mysqli->query($sql)->fetch_array();
					$destaque = $mysqli->query("SELECT * FROM usuarios WHERE id='".$info['instrutor_id']."'")->fetch_array();;
				?>
				<div class="nick"><?php echo $destaque['nick']; ?></div>
				<div class="avatar" style="background-image:url('https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=gif&user=<?php echo $destaque['nick']; ?>&action=wav&direction=3&head_direction=3&gesture=sml&size=l');"></div>
				<div class="nick"><?php echo $info['aulas']; ?> aulas.</div>
			</div>
		</div>
		<div class="box">
			<div class="titulo marrom">MEU PERFIL <div class="icone"><i class="demo-icon icon-user-secret"></i></div></div>
			<div class="corpo">
				<div class="nick"><?php echo $dadosUsu['nick']; ?></div>
				<div class="avatar" style="background-image:url('https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=gif&user=<?php echo $dadosUsu['nick']; ?>&action=wav&direction=3&head_direction=3&gesture=sml&size=l');"></div>
				<div class="nick"><?php echo $dadosCargo['nome']; ?></div>
				<table class="perfil">
					<tr>
						<td>Aulas na semana:</td>
						<td><?php echo $aulas; ?></td>
					</tr>
					<tr>
						<td>Aulas no mês:</td>
						<td><?php echo $aulasM; ?></td>
					</tr>
					<tr>
						<td>status</td>
						<td>
							<?php
								if($dadosUsu['licenca'] == 1) {
									echo"Em licença";
								}else {
									echo"Em atividade";
								}
							?>
						</td>
					</tr>
					<?php if($dadosUsu['cargo_id'] == 3) {
						$ano = date('Y');
						$cfi = $mysqli->query("SELECT * FROM quantidadegrad WHERE graduador_id='".$dadosUsu['id']."' AND semana='$semana' AND ano='$ano'")->fetch_array();
							if($cfi['grad'] == NULL) {
								$quant = 0;
							}else {
								$quant = $cfi['grad'];
							}
						?>
							<tr>
								<td>Número de CFI aplicado</td>
								<td><?php echo $quant; ?></td>
							</tr>
						<?php
					}
					?>
					<?php if($dadosUsu['cargo_id'] == 4) {
						$ano = date('Y');
						$av = $mysqli->query("SELECT * FROM quantidadeav WHERE avaliador_id='".$dadosUsu['id']."' AND semana='$semana' AND ano='$ano'")->fetch_array();
							if($av['av'] == NULL) {
								$quant = 0;
							}else {
								$quant = $av['av'];
							}
						?>
							<tr>
								<td>Número de AVs aplicadas</td>
								<td><?php echo $quant; ?></td>
							</tr>
						<?php
					}
					?>
					<?php if($dadosUsu['cargo_id'] == 5) {
						$ano = date('Y');
						$cap = $mysqli->query("SELECT * FROM quantidadecap WHERE capacitador_id='".$dadosUsu['id']."' AND semana='$semana' AND ano='$ano'")->fetch_array();
							if($cap['cap'] == NULL) {
								$quant = 0;
							}else {
								$quant = $cap['cap'];
							}
						?>
							<tr>
								<td>Número de CAPs aplicadas</td>
								<td><?php echo $quant; ?></td>
							</tr>
						<?php
					}
					?>
				</table>
			</div>
		</div>
	</div>
<?php
	