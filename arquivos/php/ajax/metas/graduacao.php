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