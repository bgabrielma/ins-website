function logar() {
	var nick = $("#user").val();
	var senha = $("#pass").val();
	var checado = $("#lembrar:checked").length > 0;
	$.ajax({
		type:"POST",
		url:"arquivos/php/ajax/entra.php",
		data:{'nick':nick, 'senha':senha, 'endereco':'index.php', 'checado':checado},
		beforeSend:function() {
				$("#resultado").css({width:'px',height:'0px'}).animate({opacity:'0'},300);
				$("#box").animate({opacity:'0.2'}, 500);
				$("#carregando").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
				$("#resultado").html("Estamos processando seu login.<br>Aguarde, por favor.");
				ajeitaBox();
			}, success:function(html) {
				window.setTimeout(function() {
					$("#carregando").css({width:'0px',height:'0px'}).animate({opacity:'0'}, 500);
					$("#box").animate({opacity:'1'}, 500);
				}, 2000);
				window.setTimeout(function() {
					$("#resultado").html(html);
					$("#resultado").css({width:'100%',height:'auto'}).animate({opacity:'1'}, 500);
				}, 2200);
				ajeitaBox();
			}
		});
}

function registrar() {
	var nick = $("#user").val();
	var senha = $("#pass").val();
	var email = $("#email").val();
	var tag = $("#tag").val();
	$.ajax({
		type:"POST",
		url:"arquivos/php/ajax/registro.php",
		data:{'nick':nick, 'senha':senha, 'email':email, 'tag':tag},
		beforeSend:function() {
				$("#resultado").css({width:'px',height:'0px'}).animate({opacity:'0'},300);
				$("#box").animate({opacity:'0.2'}, 500);
				$("#carregando").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
				$("#resultado").html("Estamos processando seu login.<br>Aguarde, por favor.");
				ajeitaBox();
			}, success:function(html) {
				window.setTimeout(function() {
					$("#carregando").css({width:'0px',height:'0px'}).animate({opacity:'0'}, 500);
					$("#box").animate({opacity:'1'}, 500);
				}, 2000);
				window.setTimeout(function() {
					$("#resultado").html(html);
					$("#resultado").css({width:'100%',height:'auto'}).animate({opacity:'1'}, 500);
				}, 2200);
				ajeitaBox();
			}
		});
}