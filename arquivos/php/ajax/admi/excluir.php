<?php
	require_once("../../../configura/config.php");
	$id = $_POST['id'];
	$tipo = $_POST['tipo'];
	$info = $mysqli->query("SELECT * FROM admissao WHERE id='$id'")->fetch_array();
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
	$ins = $info['aplicador_id'];
	$quantidade = $mysqli->query("SELECT * FROM quantidadeadmi WHERE aplicador_id='$ins' AND semana='$semana'AND $ano='$ano'")->fetch_array();
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
	$mysqli->query("DELETE FROM admissao WHERE id='$id'");

	$quant = $quantidade['admi'];
	$nvquant = $quant-1;
	$mysqli->query("UPDATE quantidadeadmi SET admi='$nvquant' WHERE aplicador_id='$ins' AND semana='$semana' AND $ano='$ano'");
	$retorna = "admi.sem();";
?>
<div id="results">
					<div class="box">
						<div class="titulo vermelho">
							QUE PENA!
							<div class="icone" style="cursor:pointer;" onclick="fechar('');<?php echo $retorna; ?>"><i class="demo-icon icon-cancel-6"></i></div>
						</div>
						<div class="corpo">
							A admissão foi deletada.
						</div>
					</div>
				</div>