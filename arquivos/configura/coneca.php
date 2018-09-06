<?php
	// Define HOST da base de dados
	$hostDB = "sql108.byetcluster.com";

	// Define USER da base de dados
	$usuarioDB = "b12_22123114";

	// Define SENHA da base de dados
	$senhaDB = "RCCins2018";

	// Define nome do Banco de dados
	$bancoDB = "b12_22123114_db";

	//Faz conexão com banco de dados
	$mysqli = new mysqli($hostDB, $usuarioDB, $senhaDB, $bancoDB) or die("Erro:".mysqli_error($mysqli));

	$dadosUsu = $mysqli->query("SELECT * FROM usuarios WHERE nick='".$_SESSION['nick']."'")->fetch_array();
	$dadosCargo = $mysqli->query("SELECT * FROM cargos WHERE id='".$dadosUsu['cargo_id']."'")->fetch_Array();
	$mysqli->set_charset('utf8');

	setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	date_default_timezone_set('America/Sao_Paulo');
?>