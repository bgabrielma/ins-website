<?php
	require_once("../../configura/config.php");
	$tipo = $_POST['tipo'];
	$id = $_POST['id'];

	if($tipo == "promo") {
		$user = $mysqli->query("SELECT * FROM usuarios WHERE id='$id'")->fetch_array();
		$cargo = $mysqli->query("SELECT * FROM cargos WHERE id='".$user['cargo_id']."'")->fetch_array();
		$nvhie = $dadosCargo['nvhie'];
		$sMaior = $mysqli->query("SELECT * FROM cargos ORDER BY nvhie DESC")->fetch_array();
		$sql = $mysqli->query("SELECT * FROM cargos ORDER BY nvhie DESC");
		if($nvhie==$sMaior['nvhie']) {
			$nC = $nvhie+1;
		}else {
			$nC = $nvhie;
		}
		echo"<option value=''>Selecione</option>";
		while($car = $sql->fetch_array()) {
			if($car['nvhie']>$cargo['nvhie']) {
				if($car['nvhie']<$nC) {
					echo"<option value='".$car['id']."'>".$car['nome']."</option>";
				}
			}
		}
	}

	if($tipo == "rebai") {
		$user = $mysqli->query("SELECT * FROM usuarios WHERE id='$id'")->fetch_array();
		$cargo = $mysqli->query("SELECT * FROM cargos WHERE id='".$user['cargo_id']."'")->fetch_array();
		$nvhie = $dadosCargo['nvhie'];
		$sMaior = $mysqli->query("SELECT * FROM cargos ORDER BY nvhie DESC")->fetch_array();
		$sql = $mysqli->query("SELECT * FROM cargos ORDER BY nvhie DESC");
		if($nvhie==$sMaior['nvhie']) {
			$nC = $nvhie+1;
		}else {
			$nC = $nvhie;
		}
		echo"<option value=''>Selecione</option>";
		while($car = $sql->fetch_array()) {
			if($car['nvhie']<$cargo['nvhie']) {
				if($car['nvhie']<$nC) {
					echo"<option value='".$car['id']."'>".$car['nome']."</option>";
				}
			}
		}
	}
?>