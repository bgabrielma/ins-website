<?php
	require_once("../../../configura/config.php");
	$data = $_POST['data'];
	$hora = $_POST['hora'];
	$presentes = $_POST['presentes'];
	$aprovados = $_POST['aprovados'];
	$comentario = $_POST['comentario'];
	foreach($presentes AS $presente) {
		if(isset($presente2)) {
			$presente2 = $presente2." / ".$presente;
		}else {
			$presente2 = $presente;
		}
	}

	foreach($aprovados AS $aprovado) {
		if(isset($aprovado2)) {
			$aprovado2 = $aprovado2." / ".$aprovado;
		}else {
			$aprovado2 = $aprovado;
		}
	}

	if($data == "" OR $hora == "") {
		$erroData = "Insira a data e hora do início da capacitação.<br>";
	}else {
		function validateDate($date, $format = 'd/m/Y H:i') {
	    		$d = DateTime::createFromFormat($format, $date);
    			return $d && $d->format($format) == $date;
		}
		$checa = validateDate($data." ".$hora);
		if($checa == false ) {
			$erroData = "Insira a data e hora corretos do início da aula.<br>";
		}
	}

	if($presentes == "") {
		$erroPresentes = "Insira o nick dos aprendizes presentes na capacitação.<br>";
	}

	if($comentario == "") {
		$erroComentario = "Insira nos comentarios detalhes sobre a capacitação.<br>";
	}

	if(isset($erroData) OR isset($erroPresentes) OR isset($erroComentario)) {
		?>
				<div id="results">
					<div class="box">
						<div class="titulo vermelho">
							ERROS FORAM ENCONTRADOS
							<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
						</div>
						<div class="corpo">
							<?php echo $erroData.$erroPresentes.$erroComentario; ?>
						</div>
					</div>
				</div>
		<?php
	}else {
		$semana = strftime("%U", mktime(0,0,0,date('m'),date('d'),date('Y')));
		$dia = date('d');
		$mes = date('m');
		$ano = date('Y');
		$semanaAtual = strftime("%U", mktime(0,0,0,$mes,$dia,$ano));
		$ultimaSemana = strftime("%U", mktime(0,0,0,$mes,31, $ano));
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
		$sql = $mysqli->query("SELECT * FROM usuarios WHERE cargo_id='5' ORDER BY nick ASC");
		while($ins = $sql->fetch_array()) {
			$checa = $mysqli->query("SELECT * FROM quantidadecap WHERE capacitador_id='".$ins['id']."' AND semana='$semana' AND ano='$ano'")->num_rows;
			if($checa ==0) {
				$mysqli->query("INSERT INTO quantidadecap (id,capacitador_id,cap,semana,ano) VALUES('','".$ins['id']."','0','$semana','$ano'");
			}
		}
		$cap = $dadosUsu['id'];
		$checaSemana = $mysqli->query("SELECT * FROM quantidadecap WHERE capacitador_id='$cap' AND semana='$semana' AND ano='$ano'")->num_rows;
		if($checaSemana == 0) {
				$mysqli->query("INSERT INTO quantidadecap (id,capacitador_id,cap,semana,ano) VALUES('','$cap','1','$semana','$ano')");
		}else {
			$peg = $mysqli->query("SELECT * FROM quantidadecap WHERE capacitador_id='$cap' AND semana='$semana' AND ano='$ano'")->fetch_array();
			$aulas = $peg['cap']+1;
			$mysqli->query("UPDATE quantidadecap SET cap='$aulas' WHERE capacitador_id='$cap' AND semana='$semana' AND ano='$ano'");
		}
		$postagem = date("d/m/Y H:i");
		$inicio = $data." ".$hora;
		$mysqli->query("INSERT INTO capacitacao (id,capacitador_id,inicio,postagem,presentes,aprovados,semana,ano,comentario) VALUES('','$cap','$inicio','$postagem','$presente2','$aprovado2','$semana','$ano','$comentario')");
		?>
			<div id="results">
				<div class="box">
					<div class="titulo verde">
						PARABÉNS CAPACITADOR!
						<div class="icone" style="cursor:pointer;" onclick="fechar('inicio');"><i class="demo-icon icon-cancel-6"></i></div>
					</div>
					<div class="corpo">
						A Capacitação foi postada com sucesso.
					</div>
				</div>
			</div>
		<?php
	}
?>