<?php
	require_once("../../../configura/config.php");
	$id = $_POST['id'];
	$tipo = $_POST['tipo'];
	$info = $mysqli->query("SELECT * FROM capacitacao WHERE id='$id'")->fetch_array();
	$data = $info['postagem'];
	$semana = strftime("%U", mktime(0,0,0,date('m'),date('d'),date('Y')));
	$sepa = explode(" ", $data);
	$sepa2 = $sepa[0];
	$sepa = explode("/", $sepa2);
	$dia = $sepa[0];
	$mes = $sepa[1];
	$ano = $sepa[2];
	$semanaAtual = strftime("%U", mktime(0,0,0,$mes,$dia,$ano));
	$ultimaSemana = strftime("%U", mktime(0,0,0,$mes,31, $ano));
	$ins = $info['capacitador_id'];
	$quantidade = $mysqli->query("SELECT * FROM quantidadecap WHERE capacitador_id='$ins' AND semana='$semana'AND $ano='$ano'")->fetch_array();
	if($semanaAtual == $ultimaSemana) {
		if($mes == 12) {
			$mes = 1;
			$ano = $ano+1;
		}else {
			$mes = $mes+1;
		}
		$semanaQueVem = strftime("%U", mktime(0,0,0,$mes,1,$ano));
		if($semanaAtual == $semanaQueVem) {
			}else {
			if($mes == 1) {
				$mes=12;
				$ano = $ano-1;
			}else {
				$mes=$mes-1;
			}
		}
	}
	$mysqli->query("DELETE FROM capacitacao WHERE id='$id'");

	$quant = $quantidade['cap'];
	$nvquant = $quant-1;
	$mysqli->query("UPDATE quantidadecap SET cap='$nvquant' WHERE capacitador_id='$ins' AND semana='$semana' AND $ano='$ano'");
	$retorna = "capaci.sem();";
?>
<div id="results">
					<div class="box">
						<div class="titulo vermelho">
							QUE PENA!
							<div class="icone" style="cursor:pointer;" onclick="fechar('');<?php echo $retorna; ?>"><i class="demo-icon icon-cancel-6"></i></div>
						</div>
						<div class="corpo">
							A capacitação foi deletada.
						</div>
					</div>
				</div>