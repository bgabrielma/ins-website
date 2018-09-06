<?php
	$dia = 7;
	$mes = 1;
	$ano = 2019;
	$data = 40;
	$semana = 40;
		if($data<$semana) {
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
		}
?>

asd