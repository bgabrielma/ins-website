<?php
	require_once("../../../configura/config.php");
	$data = addslashes($_POST['data']);
	$hora = addslashes($_POST['hora']);
	$aula = addslashes($_POST['aula']);
	$sala = addslashes($_POST['sala']);
	if($aula == 1) {
		$pontos = 2; 
	}elseif($aula == 2) {
		$pontos = 2;
	}elseif($aula == 3) {
		$pontos = 1;
	}elseif($aula == 4) {
		$pontos = 1;
	}else {
		$pontos = 0;
	}
	$presentes = $_POST['presentes'];
	foreach($presentes as $presente) {
		if(isset($presente2)) {
			$presente2 = $presente2." / ".$presente;
		}else {
			$presente2 = $presente;
		}
	}
	$aprovados = $_POST['aprovados'];
	$dia = date('d');
	$mes = date('m');
	$ano = date('Y');
	$mesExtenso = strftime('%B', strtotime($mes."/".$dia."/".$ano));
	$primeira = substr($mesExtenso, 0, 1);
	$primeira = strtoupper($primeira);
	$restante = substr($mesExtenso, 1, 2);
	$mMes = $primeira.$restante;
	foreach($aprovados as $aprovado) {
		if(isset($aprovado2)) {
			$aprovado2 = $aprovado2." / ".$aprovado;
			$tags = $tags."<Br>".$aprovado." [".$dadosUsu['tag']."] ".date('d')." ".$mMes." ".date('Y')."";
		}else {
			$aprovado2 = $aprovado;
			$tags = $aprovado." [".$dadosUsu['tag']."] ".date('d')." ".$mMes." ".date('Y')."";
		}
	}
	$quali = $_POST['quali'];
	if($data == "" OR $hora == "") {
		$erroData = "Insira a data e hora do início da aula.<Br>";
	}else {
		function validateDate($date, $format = 'd/m/Y H:i') {
	    		$d = DateTime::createFromFormat($format, $date);
    			return $d && $d->format($format) == $date;
		}
		$checa = validateDate($data." ".$hora);
		if($checa == false) {
			$erroData = "Insira a data e hora correta do início da aula.<Br>";
		}
	}

	if($aula == "") {
		$erroAula = "Insira para quem deu aula.<br>";
	}

	if($sala == "") {
		$erroSala = "Insira a sala em que aplicou aula.<br>";
	}

	if($presentes == "") {
		$erroPresentes = "Insira o nick dos alunos presentes.<br>";
	}

	if($quali == "") {
		$erroQuali = "Insira a qualidade da aula.<br>";
	}

	if(isset($erroData) OR isset($erroAula) OR isset($erroSala) OR isset($erroPresentes) OR isset($erroQuali)) {
		?>
				<div id="results">
					<div class="box">
						<div class="titulo vermelho">
							ERROS FORAM ENCONTRADOS
							<div class="icone" style="cursor:pointer;" onclick="fechar('');"><i class="demo-icon icon-cancel-6"></i></div>
						</div>
						<div class="corpo">
							<?php echo $erroData.$erroAula.$erroSala.$erroPresentes.$erroQuali; ?>
						</div>
					</div>
				</div>
		<?php
	}else {
		$ins = $dadosUsu['id'];
		$semana = strftime("%U", mktime(0,0,0,date('m'),date('d'),date('Y')));
		$dia = date('d');
		$mes = date('m');
		$ano = date('Y');
		$comp = $semana-1;
		$comp2 = $mes-1;
		$info = $mysqli->query("SELECT * FROM meta WHERE tipo='1' AND patente='1' AND data='$comp' AND ano='$ano' ORDER BY id DESC LIMIT 1")->num_rows;
		$info2 = $mysqli->query("SELECT * FROM meta WHERE tipo='2' AND patente='1' AND data='$comp2' AND ano ='$ano' ORDER BY id DESC LIMIT 1")->num_rows;
		if($info==0 OR $info2==0) {
			$dia1 = $dia-7;
			$diaDaSemana = strftime('%w', mktime(00, 00, 00, $mes, $dia1, $ano));
			if($diaDaSemana == 0) {
				$dia1 = $dia1;
				$mes1 = $mes;
				if($dia1 < 0) {
					$mes1 = $mes-1;
					$ultimo_dia = date("t", mktime(0,0,0,$mes1,'01',$ano));
					$dia1 = $ultimo_dia+$dia1;
				}
			}else {
				$dia1 = $dia1-$diaDaSemana;
				$mes1 = $mes-1;
				if($dia1 < 0) {
					$mes1 = $mes-1;
					$ultimo_dia = date("t", mktime(0,0,0,$mes1,'01',$ano));
					$dia1 = $ultimo_dia+$dia1;
				}
			}
			if($mes1 == 0) {
				$mes1 = 12;
				$ano1 = $ano-1;
			}else {
				$ano1 = $ano;
			}
			$dia2 = $dia1+6;
			$ultimo_dia = date("t", mktime(0,0,0,$mes1,'01',$ano));
			if($dia2>$ultimo_dia) {
				$dia2=$dia2-$ultimo_dia;
				$dia2=0+$dia2;
				$mes2=$mes1+1;
				if($mes2==13) {
					$mes2=1;
					$ano2=$ano1+1;
				}else {
					$mes2=$mes2;
					$ano2=$ano1;
				}
			}else {
				$mes2=$mes1;
				$ano2=$ano1;
			}
			$mesExtenso = strftime('%B', strtotime($mes1."/".$dia1."/".$ano1));
			$outMesExtendo = strftime('%B', strtotime($mes2."/".$dia2."/".$ano2));
			$qual = $dia1." de ".$mesExtenso." de ".$ano1." à ".$dia2." de ".$outMesExtendo." de ".$ano2;
			$qual2 = $mesExtenso." de ".$ano1;
			$dat = $dia1."/".$mes1."/".$ano1." ".$dia2."/".$mes2."/".$ano2;
			$data = strftime("%U", mktime(0,0,0,$mes1,$dia1,$ano1));
			if($info==0) {
				$mysqli->query("INSERT INTO meta (id,tipo,patente,qual,data,ano,dat) VALUES('','1','1','$qual','$data','$ano1','$dat')");
			}
			if($info2==0) {
				$mysqli->query("INSERT INTO meta (id,tipo,patente,qual,data,ano,dat) VALUES('','2','1','$qual2','$comp2','$ano1','$dat')");
			}
		}
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
		$checaSemana = $mysqli->query("SELECT * FROM quantidade WHERE instrutor_id='$ins' AND semana='$semana' AND mes='$mes' AND ano='$ano'")->num_rows;
		if($checaSemana == 0) {
				$mysqli->query("INSERT INTO quantidade (id,instrutor_id,aulas,pontos,semana,mes,ano) VALUES('','$ins','1','$pontos','$semana','$mes','$ano')");
		}else {
			$peg = $mysqli->query("SELECT * FROM quantidade WHERE instrutor_id='$ins' AND semana='$semana' AND mes='$mes' AND ano='$ano'")->fetch_array();
			$aulas = $peg['aulas']+1;
			$ponto = $peg['pontos']+$pontos;
			$mysqli->query("UPDATE quantidade SET aulas='$aulas', pontos='$ponto' WHERE instrutor_id='$ins' AND semana='$semana' AND mes='$mes' AND ano='$ano'");
		}
		$postagem = date("d/m/Y H:i");
		$inicio = $data." ".$hora;
		$mysqli->query("INSERT INTO aulas (id,instrutor_id,tipo,sala,inicio,postagem,alunosinicio,alunosaprovados,nota,semana,ano,mes) VALUES('','$ins','$aula','$sala','$inicio','$postagem','$presente2','$aprovado2','$quali','$semana','$ano','$mes')");
		$checaMes = $mysqli->query("SELECT * FROM quantidademensal WHERE instrutor_id='$ins' AND mes='$mes' AND ano='$ano'")->num_rows;
		if($checaMes == 0) {
			$mysqli->query("INSERT INTO quantidademensal (id,instrutor_id,aulas,pontos,mes,ano) VALUES('','$ins','1','$pontos','$mes','$ano')");
		}else {
			$peg = $mysqli->query("SELECT * FROM quantidademensal WHERE instrutor_id='$ins' AND mes='$mes' AND ano='$ano'")->fetch_array();
			$aulas = $peg['aulas']+1;
			$ponto = $peg['pontos']+$pontos;
			$mysqli->query("UPDATE quantidademensal SET aulas='$aulas', pontos='$ponto' WHERE instrutor_id='$ins' AND mes='$mes' AND ano='$ano'");
		}	
		?>
			<div id="results">
					<div class="box">
						<div class="titulo verde">
							PARABÉNS INSTRUTOR!
							<div class="icone" style="cursor:pointer;" onclick="fechar('inicio');"><i class="demo-icon icon-cancel-6"></i></div>
						</div>
						<div class="corpo">
							Sua aula foi postada. Parabéns!
							<?php if($aula == 1) { ?><br><b>Aqui está o código para postar em Requerimentos:</b><br>
							<div class="code" style="background: #D8D8D8;color: #000;padding: 7px;border: 1px dashed #2F2F2F;">
							<code>	
								[center][b][color=#003300]Modelo I - Instrução[/color][/b][/center]

								[b]Nick e TAG do Instrutor:[/b] <?php echo $dadosUsu['nick']; ?><br> [<?php echo $dadosUsu['tag']; ?>]<bR>
								[b]Recruta(s) aprovado(s):[/b] [b]<?php echo $tags; ?>[/b]<br>

								
								<br><br>
							</code>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
		<?php
	}
?>