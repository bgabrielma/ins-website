<?php
	require_once("../../configura/config.php");
?>
<div class="coluna" style="width:100%">
<div class="botao vermelho" onclick="carrega('requerimento','');">ABRIR REQUERIMENTO</div>
<?php
	$sql = $mysqli->query("SELECT * FROM cargos ORDER BY nvhie DESC");
	while($cargo = $sql->fetch_array()) {
?>
		<div class="box">
			<div class="titulo <?php echo $cargo['cor']; ?>"><?php echo $cargo['nome']; ?><div class="icone"><i class="demo-icon <?php echo $cargo['icone']; ?>"></i></div></div>
			<div class="corpo">
				<?php
					$use = $mysqli->query("SELECT * FROM usuarios WHERE cargo_id='".$cargo['id']."' AND ativo='1'");
					while($usu = $use->fetch_array()) {
						$id = $usu['id'];
						$nick = $usu['nick'];
				?>
						<div class="local" style="cursor:pointer;" id="a<?php echo $usu['id']; ?>" onclick="lista.perfil('<?php echo $id; ?>','<?php echo $nick; ?>');">
							<div class="nick" <?php if($usu['licenca'] == 1) { echo "style='background: #34495e; color: #fff;'"; } 
							elseif($usu['cursos'] == 1) { echo "style='background: #d42c2c; color: #fff;'"; }
							elseif($usu['cursos'] == 2) { echo "style='background: rgb(249, 98, 2); color: #fff;'"; } ?>><?php echo $usu['nick']; ?></div>
							<div class="avatar" style="background-image:url('https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=gif&user=<?php echo $usu['nick']; ?>&action=wav&direction=3&head_direction=3&gesture=sml&size=l');"></div>
							<div class="<?php echo $usu['nick']; ?>"></div>
						</div>
				<?php
					}
				?>
				<div style="clear:both;"></div>
			</div>
		</div>
<?php
	}
?>
</div>
<div id="reqresults"></div>