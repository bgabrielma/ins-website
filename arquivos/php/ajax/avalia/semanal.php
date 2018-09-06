<?php
	require_once("../../../configura/config.php");
	$data = $_POST['data'];
	$Dataseparada = explode("/", $data);
	$dia = $Dataseparada[0];
	$mes = $Dataseparada[1];
	$ano = $Dataseparada[2];
	$diaDaSemana = strftime('%w', mktime(00, 00, 00, $mes, $dia, $ano));
	if($diaDaSemana == 1) {
		$dia = $dia;
	}else {
		$dia = $dia-$diaDaSemana;
	}
	$ndia = $dia+6;
	if($mes == 12 OR $mes == 10 OR $mes == 8 OR $mes == 7 OR $mes == 5 OR $mes == 3 OR $mes == 1) {
		if($ndia > 31) {
			$calcula = $ndia-31;
			$ndia=$calcula;
		}
	}elseif($mes == 2) {
		if ((($ano % 4) == 0 and ($ano % 100)!=0) or ($ano % 400)==0) {
			if($ndia > 28) {
				$calcula = $ndia-28;
				$ndia=$calcula;
			}
		} else {
			if($ndia > 29) {
				$calcula = $ndia-29;
				$ndia=$calcula;
			}
		}
	}elseif($mes == 4 OR $mes == 6 OR $mes == 9 OR $mes == 11) {
		if($ndia > 30) {
			$calcula = $ndia-30;
			$ndia=$calcula;
		}
	}
	if($ndia<$dia) {
		if($mes > 12) {
			$nmes = 1;
		}else {
			$nmes = $mes+1;
		}
	}else {
		$nmes = $mes;
	}
	if($nmes<$mes) {
		$nano = $ano+1;
	}else {
		$nano = $ano;
	}
	$semana = strftime('%U', mktime(00, 00, 00, $mes, $dia, $ano));
	$mesExtenso = strftime('%B', strtotime($mes."/".$dia."/".$ano));
	$outMesExtendo = strftime('%B', strtotime($nmes."/".$ndia."/".$nano));
?>
<div class="box">
	<div class="titulo preto">Aulas de <?php echo $dia; ?> de <?php echo $mesExtenso; ?> de <?php echo $ano; ?> à <?php echo $ndia; ?> de <?php echo $outMesExtendo; ?> de <?php echo $nano; ?></div>
	<div class="corpo">
		<table class="perfil">
			<tr>
				<td>ID</td>
				<td>DATA DE POSTAGEM</td>
				<td>DATA E HORA DO INÍCIO DA AULA</td>
				<td>AVALIADOR</td>
				<td>APRENDIZES PRESENTES</td>
				<td>APRENDIZES APROVADOS</td>
				<td>TIPO DE AVALIAÇÃO</td>
				<td>COMENTÁRIO</td>
				<td>EXCLUIR</td>
			</tr>
<?php	
	$sql = $mysqli->query("SELECT * FROM avaliacao WHERE semana='$semana' AND ano='$ano' ORDER BY id");
	while($aulas = $sql->fetch_array()) {
		if($aulas['tipo'] == 0) {
			$avaliat = "Aconteceu um erro";
		}elseif($aulas['tipo'] == 1) {
			$avaliat = "Avaliação 1";
		}elseif($aulas['tipo'] == 2) {
			$avaliat = "Avaliação 2";
		}
	$instrutor = $mysqli->query("SELECT * FROM usuarios WHERE id='".$aulas['avaliador_id']."'")->fetch_array();
?>
			<tr>
				<td><?php echo $aulas['id']; ?></td>
				<td><?php echo $aulas['postagem']; ?></td>
				<td><?php echo $aulas['inicio']; ?></td>
				<td><?php echo $instrutor['nick']; ?></td>
				<td><?php echo $aulas['presentes']; ?></td>
				<td><?php echo $aulas['aprovados']; ?></td>
				<td><?php echo $avaliat; ?></td>
				<td><?php echo $aulas['comentario']; ?></td>
				<td><div class="botao vermelho" onclick="avalia.excluir('<?php echo $aulas['id']; ?>','semanal');">Excluir</div></td>
			</tr>
<?php } ?>
		</table>
	</div>
</div>