<?php
	require_once("../../../configura/config.php");
	$id = $_POST['id'];
	$info = $mysqli->query("SELECT * FROM meta WHERE id='$id'")->fetch_array();
	$data = $info['data'];
	$ano = $info['ano'];
	$separa = explode(" ", $info['dat']);
	$comeco = explode("/", $separa[0]);
	$fim = explode("/", $separa[1]);
?>
<div class="titulo laranja" style="border-radius:0px;">
	<table class="meta">
		<tr>
			<td>EXCELENTE</td>
			<td><?php if($info['tipo'] == 1) { echo"26"; }elseif($info['tipo'] == 2) { echo"50"; } ?> OU MAIS PONTOS</td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
		<?php
			if($info['tipo'] == 1) {
				$sql = $mysqli->query("SELECT * FROM quantidade WHERE pontos>='26' AND semana='$data' AND ano='$ano' ORDER BY pontos DESC");
			}elseif($info['tipo'] == 2) {
				$sql = $mysqli->query("SELECT * FROM quantidademensal WHERE pontos>='50' AND mes='$data' AND ano='$ano' ORDER BY pontos DESC");
			}
			while($meta = $sql->fetch_array()) {
				$ins = $mysqli->query("SELECT * FROM usuarios WHERE id='".$meta['instrutor_id']."'")->fetch_array();
				?>
					<tr>
						<td><?php echo $ins['nick']; ?></td>
						<td><?php echo $meta['pontos']; ?> pontos.</td>
					</tr>
				<?php
			}
		?>
	</table>
</div>

<div class="titulo roxo" style="border-radius:0px;">
	<table class="meta">
		<tr>
			<td>ÓTIMO</td>
			<td><?php if($info['tipo'] == 1) { echo"20 À 25"; }elseif($info['tipo'] == 2) { echo"35 À 49"; } ?> PONTOS</td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
		<?php
			if($info['tipo'] == 1) {
				$sql = $mysqli->query("SELECT * FROM quantidade WHERE pontos>='15' AND pontos<='24' AND semana='$data' AND ano='$ano' ORDER BY pontos DESC");
			}elseif($info['tipo'] == 2) {
				$sql = $mysqli->query("SELECT * FROM quantidademensal WHERE pontos>='35' AND pontos<='49' AND mes='$data' AND ano='$ano' ORDER BY pontos DESC");
			}
			while($meta = $sql->fetch_array()) {
				$ins = $mysqli->query("SELECT * FROM usuarios WHERE id='".$meta['instrutor_id']."'")->fetch_array();
				?>
					<tr>
						<td><?php echo $ins['nick']; ?></td>
						<td><?php echo $meta['pontos']; ?> pontos.</td>
					</tr>
				<?php
			}
		?>
	</table>
</div>

<div class="titulo verde" style="border-radius:0px;">
	<table class="meta">
		<tr>
			<td>BOM</td>
			<td><?php if($info['tipo'] == 1) { echo"14 À 19"; }elseif($info['tipo'] == 2) { echo"25 À 34"; } ?> PONTOS</td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
		<?php
			if($info['tipo'] == 1) {
				$sql = $mysqli->query("SELECT * FROM quantidade WHERE pontos>='7' AND pontos<='14' AND semana='$data' AND ano='$ano' ORDER BY pontos DESC");
			}elseif($info['tipo'] == 2) {
				$sql = $mysqli->query("SELECT * FROM quantidademensal WHERE pontos>='25' AND pontos<='34' AND mes='$data' AND ano='$ano' ORDER BY pontos DESC");
			}
			while($meta = $sql->fetch_array()) {
				$ins = $mysqli->query("SELECT * FROM usuarios WHERE id='".$meta['instrutor_id']."'")->fetch_array();
				?>
					<tr>
						<td><?php echo $ins['nick']; ?></td>
						<td><?php echo $meta['pontos']; ?> pontos.</td>
					</tr>
				<?php
			}
		?>
	</table>
</div>

<div class="titulo preto" style="border-radius:0px;">
	<table class="meta">
		<tr>
			<td>REGULARES</td>
			<td><?php if($info['tipo'] == 1) { echo"9 À 13"; }elseif($info['tipo'] == 2) { echo"15 À 24"; } ?> PONTOS</td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
		<?php
			if($info['tipo'] == 1) {
				$sql = $mysqli->query("SELECT * FROM quantidade WHERE pontos>='4' AND pontos<='5' AND semana='$data' AND ano='$ano' ORDER BY pontos DESC");
			}elseif($info['tipo'] == 2) {
				$sql = $mysqli->query("SELECT * FROM quantidademensal WHERE pontos>='15' AND pontos<='24' AND mes='$data' AND ano='$ano' ORDER BY pontos DESC");
			}
			while($meta = $sql->fetch_array()) {
				$ins = $mysqli->query("SELECT * FROM usuarios WHERE id='".$meta['instrutor_id']."'")->fetch_array();
				?>
					<tr>
						<td><?php echo $ins['nick']; ?></td>
						<td><?php echo $meta['pontos']; ?> pontos.</td>
					</tr>
				<?php
			}
		?>
	</table>
</div>

<div class="titulo vermelho" style="border-radius:0px;">
	<table class="meta">
		<tr>
			<td>RUIM</td>
			<td><?php if($info['tipo'] == 1) { echo"00 À 08"; }elseif($info['tipo'] == 2) { echo"0 À 14"; } ?> PONTOS</td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
		<?php
			if($info['tipo'] == 1) {
				$sql = $mysqli->query("SELECT * FROM quantidade WHERE pontos>='0' AND pontos<='4' AND semana='$data' AND ano='$ano' ORDER BY pontos DESC");
			}elseif($info['tipo'] == 2) {
				$sql = $mysqli->query("SELECT * FROM quantidademensal WHERE pontos>='0' AND pontos<='14' AND mes='$data' AND ano='$ano' ORDER BY pontos DESC");
			}
			while($meta = $sql->fetch_array()) {
				$ins = $mysqli->query("SELECT * FROM usuarios WHERE id='".$meta['instrutor_id']."'")->fetch_array();
				$especial = NULL;
				if($ins['cargo_id']>=5) {
					$especial = 1;
				}
				$consulta = $mysqli->query("SELECT * FROM r_licenca WHERE usuario_id='".$ins['id']."'");
				$entrada = explode("/", $ins['entrada']);
				$dia = (int)$entrada[0];
				$mes = (int)$entrada[1];
				$ano = (int)$entrada[2];
				$semana = strftime("%U", mktime(0,0,0,$mes,$dia,$ano));
				if($semana < $info['data'] AND $ano<=$info['ano']) {
					$consulta = $mysqli->query("SELECT * FROM r_licenca WHERE usuario_id='".$ins['id']."' ORDER BY id DESC");
					while($lic = $consulta->fetch_array()) {
						$inicio = explode("/", $lic['inicio']);
						$idia = intval($inicio[0]);
						$imes = intval($inicio[1]);
						$iano = intval($inicio[2]);

						$termino = explode("/", $lic['termino']);
						$tdia = intval($termino[0]);
						$tmes = intval($termino[1]);
						$tano = intval($termino[2]);
						for($i = $iano; $i<=$tano; $i++) {
							for ($a = $imes; $a <= $tmes; $a++) {
								if($info['tipo'] == 2) {
									if($info['data']==$a AND $info['ano'] ==$i) {
										$especial = 1;
										break;
									}
								}elseif($info['tipo'] == 1) {
									for($b = $idia; $b <= 31 ; $b++) {
										$semana2 = strftime('%U', mktime(0,0,0,$a, $b, $i));
										if($semana2 == $info['data'] AND $i == $info['ano']) {
											$especial = 1;
											break;
										}
										if($b == $tdia AND $a == $tmes AND $i == $tano) {
											break;
										}
		    						}
		    					}
							}
						}
					}
					if($especial != 1 ) {
						?>
							<tr>
								<td><?php echo $ins['nick']; ?></td>
								<td><?php echo $meta['pontos']; ?> pontos.</td>
							</tr>
						<?php
					}
				}
			}
			$sql = $mysqli->query("SELECT * FROM usuarios ORDER BY id DESC");
			while($ins = $sql->fetch_array()) {
				$especial = NULL;
				if($ins['cargo_id']>=5) {
					$especial = 1;
				}
				if($info['tipo'] == 1) {
					$checa = $mysqli->query("SELECT * FROM quantidade WHERE instrutor_id='".$ins['id']."' AND semana='".$info['data']."' AND ano='".$info['ano']."'")->num_rows;
					if($checa>0) {
						$especial = 1;
					}
				}

				if($info['tipo'] == 2) {
					$checa = $mysqli->query("SELECT * FROM quantidademensal WHERE instrutor_id='".$ins['id']."' AND mes='".$info['data']."' AND ano='".$info['ano']."'")->num_rows;
					if($checa>0) {
						$especial = 1;
					}
				}
				$entrada = explode("/", $ins['entrada']);
				$dia = (int)$entrada[0];
				$mes = (int)$entrada[1];
				$ano = (int)$entrada[2];
				$semana = strftime("%U", mktime(0,0,0,$mes,$dia,$ano));
				if(($info['tipo'] == 1 AND $semana < $info['data']) OR ($info['tipo'] == 2 AND $mes < $info['data']) AND $ano<=$info['ano']) {
					$consulta = $mysqli->query("SELECT * FROM r_licenca WHERE usuario_id='".$ins['id']."' ORDER BY id DESC");
					while($lic = $consulta->fetch_array()) {
						$inicio = explode("/", $lic['inicio']);
						$idia = intval($inicio[0]);
						$imes = intval($inicio[1]);
						$iano = intval($inicio[2]);

						$termino = explode("/", $lic['termino']);
						$tdia = intval($termino[0]);
						$tmes = intval($termino[1]);
						$tano = intval($termino[2]);
						for($i = $iano; $i<=$tano; $i++) {
							for ($a = $imes; $a <= $tmes; $a++) {
								if($info['tipo'] == 2) {
									if($info['data']==$a AND $info['ano'] ==$i) {
										$especial = 1;
										break;
									}
								}elseif($info['tipo'] == 1) {
									for($b = $idia; $b <= 31 ; $b++) {
										$semana2 = strftime('%U', mktime(0,0,0,$a, $b, $i));
										if($semana2 == $info['data'] AND $i == $info['ano']) {
											$especial = 1;
											break;
										}
										if($b == $tdia AND $a == $tmes AND $i == $tano) {
											break;
										}
		    						}
		    					}
							}
						}
					}
					if($especial != 1 ) {
						?>
							<tr>
								<td><?php echo $ins['nick']; ?></td>
								<td>Nenhuma aula.</td>
							</tr>
						<?php
					}
				}
			}
		?>
	</table>
</div>
<div class="titulo azul" style="border-radius:0px;">
	<table class="meta">
		<tr>
			<td>CASOS ESPECIAIS</td>
			<td>MOTIVO</td>
		</tr>
	</table>
</div>
<div class="corpo">
	<table class="met">
		<?php
			$sql = $mysqli->query("SELECT * FROM usuarios ORDER BY id DESC");
			while($ins = $sql->fetch_array()) {
				$especial = NULL;
				if($ins['cargo_id']>=5) {
					$especial = 0;
				}
				if($info['tipo'] == 1) {
					$checa = $mysqli->query("SELECT * FROM quantidade WHERE instrutor_id='".$ins['id']."' AND semana='".$info['data']."' AND ano='".$info['ano']."'")->num_rows;
					if($checa>0) {
						$especial = 0;
					}
				}

				if($info['tipo'] == 2) {
					$checa = $mysqli->query("SELECT * FROM quantidademensal WHERE instrutor_id='".$ins['id']."' AND mes='".$info['data']."' AND ano='".$info['ano']."'")->num_rows;
					if($checa>0) {
						$especial = 0;
					}
				}
				$entrada = explode("/", $ins['entrada']);
				$dia = (int)$entrada[0];
				$mes = (int)$entrada[1];
				$ano = (int)$entrada[2];
				$semana = strftime("%U", mktime(0,0,0,$mes,$dia,$ano));
				if(($info['tipo'] == 1 AND $semana <= $info['data']) OR ($info['tipo'] == 2 AND $mes <= $info['data']) AND $ano<=$info['ano']) {
					if(($info['tipo'] == 1 AND $semana == $info['data']) OR ($info['tipo'] == 2 AND $mes == $info['data']) AND $ano<=$info['ano']) {
						$especial = 1;
						$motivo = "Novo na companhia";
					}
					$consulta = $mysqli->query("SELECT * FROM r_licenca WHERE usuario_id='".$ins['id']."' ORDER BY id DESC");
					while($lic = $consulta->fetch_array()) {
						$inicio = explode("/", $lic['inicio']);
						$idia = intval($inicio[0]);
						$imes = intval($inicio[1]);
						$iano = intval($inicio[2]);

						$termino = explode("/", $lic['termino']);
						$tdia = intval($termino[0]);
						$tmes = intval($termino[1]);
						$tano = intval($termino[2]);
						for($i = $iano; $i<=$tano; $i++) {
							if($ins['cargo_id']>=5) {
								break;
							}
							for ($a = $imes; $a <= $tmes; $a++) {
								if($info['tipo'] == 2) {
									if($info['data']==$a AND $info['ano'] ==$i) {
										$especial = 1;
										$motivo = "Licença";
										break;
									}
								}elseif($info['tipo'] == 1) {
									for($b = $idia; $b <= 31 ; $b++) {
										$semana2 = strftime('%U', mktime(0,0,0,$a, $b, $i));
										if($semana2 == $info['data'] AND $i == $info['ano']) {
											$especial = 1;
											$motivo = "Licença";
											break;
										}
										if($b == $tdia AND $a == $tmes AND $i == $tano) {
											break;
										}
		    						}
		    					}
							}
						}
					}
					if($especial == 1 ) {
						?>
							<tr>
								<td><?php echo $ins['nick']; ?></td>
								<td><?php echo $motivo; ?></td>
							</tr>
						<?php
					}
				}
			}
		?>
	</table>
</div>