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
?>
<div class="box">
	<div class="titulo preto">Aulas da <?php echo $semana; ?> de <?php echo $ano; ?></div>
	<div class="corpo">
		<table class="perfil">
			<tr>
				<td>ID</td>
				<td>DATA DE POSTAGEM</td>
				<td>DATA E HORA DO INÍCIO DA AULA</td>
				<td>INSTRUTOR</td>
				<td>TIPO DE AULA</td>
				<td>SALA EM QUE FOI APLICADA</td>
				<td>ALUNOS PRESENTES</td>
				<td>ALUNOS APROVADOS</td>
				<td>QUALIDADE</td>
				<td>EXCLUIR</td>
			</tr>
<?php	
	$sql = $mysqli->query("SELECT * FROM aulas WHERE semana='$semana' AND ano='$ano' ORDER BY id");
	while($aulas = $sql->fetch_array()) {
	$instrutor = $mysqli->query("SELECT * FROM usuarios WHERE id='".$aulas['instrutor_id']."'")->fetch_array();
	if($aulas['tipo'] == 1) {
		$tipo = "Recruta(s)";
	}elseif($aulas['tipo'] == 2) {
		$tipo = "Cabo(s)";
	}elseif($aulas['tipo'] == 3) {
		$tipo = "Subtenente(s)";
	}else {
		$tipo = "Indefinido";
	}
	
	if($aulas['sala'] >= 1 AND $aulas['sala'] <= 8) {
		$sala = "[INS] Sala de Instrução ".$aulas['sala'];
	}elseif($aulas['sala'] == 9) {
		$sala = "[RCC] Batalhão Auxiliar (Barracas)";
	}elseif($aulas['sala'] == 10) {
		$sala = "Sala de Aula Particular";
	}elseif($aulas['sala'] == 11) {
		$sala = "[INS] Sala de CFC [01]";
	}elseif($aulas['sala'] == 12) {
		$sala = "[INS] Sala de CFC [02]";
	}else {
		$sala = "Indefinido";
	}
	if($aulas['nota'] == 2) {
		$nota = "Péssima";
	}elseif($aulas['nota'] == 4) {
		$nota = "Ruim";
	}elseif($aulas['nota'] == 6) {
		$nota = "Regular";
	}elseif($aulas['nota'] == 8) {
		$nota = "Boa";
	}elseif($aulas['nota'] == 10) {
		$nota = "Ótima";
	}else {
		$nota = "Indefinido";
	}
?>
			<tr>
				<td><?php echo $aulas['id']; ?></td>
				<td><?php echo $aulas['postagem']; ?></td>
				<td><?php echo $aulas['inicio']; ?></td>
				<td><?php echo $instrutor['nick']; ?></td>
				<td><?php echo $tipo; ?></td>
				<td><?php echo $sala; ?></td>
				<td><?php echo $aulas['alunosinicio']; ?></td>
				<td><?php echo $aulas['alunosaprovados']; ?></td>
				<td><?php echo $nota; ?></td>
				<td><div class="botao vermelho" onclick="aulas.excluir('<?php echo $aulas['id']; ?>','semanal');">Excluir</div></td>
			</tr>
<?php } ?>
		</table>
	</div>
</div>