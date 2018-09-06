    function opcoes() {
	var confirma = $(".opcoes").hasClass('baixo');
	if(confirma == true) {
		$(".opcoes").animate({height:'0px'}, 500);
		window.setTimeout(function() {
			$(".opcoes").removeClass('baixo').slideUp('fast');
		}, 500);
		$("#eopcoes").removeClass('ativada');
		$("#eopcoes i:first-child").removeClass('icon-up-open-3').addClass('icon-down-open-3');
	}else {
		$(".opcoes").addClass('baixo').slideDown('fast');
		window.setTimeout(function() {
			$(".opcoes").animate({height:'50px'}, 500);
		}, 60);
		$("#eopcoes").addClass('ativada');
		$("#eopcoes i:first-child").removeClass('icon-down-open-3').addClass('icon-up-open-3');
	}
}

window.setTimeout(function() {
	location.reload();
}, 600000*2);

function carrega(pagina, id) {
	if(id == "") {
		$.ajax({
			type:"POST",
			url:"arquivos/php/pages/"+pagina+".php",
			beforeSend:function() {
				$("#corpo").animate({marginTop:'60px'});
				$("#main-menu").animate({top:'-2px'});
				$("#corpo").html("");
				$(".carrega").animate({width:'100%'}, 2400);
				$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'0px',height:'0px'}).animate({opacity:'0'}, 500);
				}, 3000);
			},
			success:function(html) {
				window.setTimeout(function() {
					$("#corpo").html(html);
				}, 3000);
			}
		});
	}else {
		$.ajax({
			type:"POST",
			url:"arquivos/php/pages/"+pagina+".php",
			data:{'id':id},
			beforeSend:function() {
				$("#corpo").animate({marginTop:'60px'});
				$("#main-menu").animate({top:'-2px'});
				$("#corpo").html("");
				$(".carrega").animate({width:'100%'}, 2400);
				$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'0px',height:'0px'}).animate({opacity:'0'}, 500);
				}, 3000);
			},
			success:function(html) {
				window.setTimeout(function() {
					$("#corpo").html(html);
				}, 3000);
			}
		});
	}
}

function inicio() {
	$.ajax({
		type:"POST",
		url:"arquivos/php/pages/inicio.php",
		success:function(html) {
			$("#corpo").html(html);
		}
	})
}

function script(id) {
	$.ajax({
		type:"POST",
		data:{'id':id},
		url:"arquivos/php/pages/scripts.php",
		beforeSend:function() {
			$("#corpo").html("");
			$(".carrega").animate({width:'100%'}, 2400);
			$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
			window.setTimeout(function() {
				$(".carrega").css({width:'0px'});
				$("#carrega").css({width:'0px',height:'0px'}).animate({opacity:'0'}, 500);
			}, 3000);
		},
		success:function(html) {
			window.setTimeout(function() {
				$("#corpo").html(html);
			}, 3000);
		}
	});
}

function atualiza() {
	var n = $("#corpo .coluna").lenght;
	
}

function formulario(tipo) {
	$.ajax({
		type:"POST",
		data:{'tipo':tipo},
		url:'arquivos/php/ajax/formulario.php',
		beforeSend:function() {
			$(".carrega").animate({width:'100%'}, 2400);
			$("#recebe").slideUp('fast');
		},
		success:function(html) {
			window.setTimeout(function() {
				$(".carrega").css({width:'0px'});
				$("#recebe").html(html).slideDown();
				inputs();
			}, 2400);
		}
	});
}

function atualizaCargos(tipo,id,select) {
	$.ajax({
		type:"POST",
		url:"arquivos/php/ajax/atualizaCargos.php",
		data:{'tipo':tipo, 'id':id},
		beforeSend:function() {
			$(select).html("<option value=''>Carregando...</option>").selectric();
		},
		success:function(html) {
			$(select).html(html).selectric();
		}
	})
}

function inputs() {
	var item = $("div.item").width(); 
	var itemI = $(".input .icone").width();
	var nW = (item - itemI)-18;
	$("div.item input[type='text'], input[type='password']").css('width',nW+'px');
}

var requerimento = {
	licenca:function() {
		var termino = $("#ate").val();
		var motivo = $(".motivos").val();
		var permitiu = $("#permitiu").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/requerimento.php",
			data:{'tipo':'licenca', 'termino':termino, 'motivo':motivo, 'permitiu':permitiu},
			beforeSend:function() {
				$(".carrega").animate({width:'100%'}, 500);
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
				}, 500);
			}
		});
	}, volta:function() {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/requerimento.php",
			data:{'tipo':'volta'},
			beforeSend:function() {
				$(".carrega").animate({width:'100%'}, 500);
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
				}, 500);
			}
		});
	}, promocao:function() {
		var membro = $("#membro").val();
		var motivo = $(".motivo").val();
		var promovido = $("#promovido").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/requerimento.php",
			data:{'tipo':'promocao', 'membro':membro, 'motivo':motivo, 'promovido':promovido},
			beforeSend:function() {
				$(".carrega").animate({width:'100%'}, 500);
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
				}, 500);
			}
		})
	}, rebaixamento:function() {
		var membro = $("#membro").val();
		var motivo = $(".motivo").val();
		var rebaixado = $("#rebaixado").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/requerimento.php",
			data:{'tipo':'rebaixamento', 'membro':membro, 'motivo':motivo, 'rebaixado':rebaixado},
			beforeSend:function() {
				$(".carrega").animate({width:'100%'}, 500);
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
				}, 500);
			}
		})
	}, expulsao:function() {
		var membro = $("#membro").val();
		var motivo = $(".motivo").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/requerimento.php",
			data:{'tipo':'expulsao', 'membro':membro, 'motivo':motivo},
			beforeSend:function() {
				$(".carrega").animate({width:'100%'}, 500);
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
				}, 500);
			}
		})
	}, saida:function() {
		var motivo = $(".motivo").val();
		var permitiu = $("#permitiu").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/requerimento.php",
			data:{'tipo':'saida', 'motivo':motivo, 'permitiu':permitiu},
			beforeSend:function() {
				$(".carrega").animate({width:'100%'}, 500);
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
				}, 500);
			}
		});
	}
}
function ajeitaBox() {
	var height = $("#reqresults .box").height();
	var width = $("#reqresults .box").width();
	var nHeight = height/2;
	var nWidth = width/2;
	var styles = {
		position: 'fixed',
		left: '50%',
		top: '50%',
		marginLeft: '-'+nWidth+'px',
		marginTop: '-'+nHeight+'px'
	}
	$("#reqresults .box").css(styles);
}

function fechar(page) {
	$("#reqresults").animate({opacity:'0'}, 1600);
	window.setTimeout(function() {
		$("#reqresults").html("").css({width:'0px',height:'0px'});
		if(page == "") {

		}else {
			carrega(page,'');
		}
	}, 1600);
}

function adm() {
	$("#corpo").animate({marginTop:'120px'});
	$("#main-menu").animate({top:'54px'});
}

function dsv() {
	$("#corpo").animate({marginTop:'120px'});
	$("#sec-menu").animate({top:'54px'});
}

var alerta = {
	adicionar:function() {
		var titulo = $("#titulo").val();
		var tipo = $("#tipo").val();
		var cargos = new Array();
		$("input[name='permissao[]']:checked").each(function(){
			cargos.push($(this).val());
		});
		var descricao = $(".descricao").val();
		var conteudo = $(".conteudo").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/alertas/alertas.php",
			data:{'titulo':titulo, 'tipo':tipo, 'cargos':cargos, 'descricao':descricao, 'conteudo':conteudo},
			beforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">A SUA SOLICITAÇÃO ESTÁ A SER PROCESSADA</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'})
				ajeitaBox();
			}, success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
				}, 400);
			}
		})
	},
	opcao:function(opcao) {
		if(opcao == "abrir") {
			$("#umdois").animate({width:'0px'}, 200);
			$("#um").css({opacity:"1", height:'auto'}).animate({width:'64%'}, 200);
			$("#dois").animate({width:'34%'}, 200);
			window.setTimeout(function() {
				$("#umdois").css({opacity:"0",height:'0px'});
			}, 190);
			window.setTimeout(function() {
				inputs();
			}, 201)
		}
		if(opcao == "fechar") {
			$("#umdois").css({opacity:'1',height:'auto'}).animate({width:'100%'}, 200);
			$("#um").animate({width:'0PX'}, 200);
			$("#dois").animate({width:'100%'}, 200);
			window.setTimeout(function() {
				$("#um").css({opacity:"0",height:'0px'});
			}, 190);
		}
	},
	editar:function(id) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/alertas/editar.php",
			data:{'id':id},
			beforeSend:function() {
				$("#corpo").html("");
				$(".carrega").animate({width:'100%'}, 2400);
				$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'0px',height:'0px'}).animate({opacity:'0'}, 500);
				}, 3000);
			},
			success:function(html) {
				window.setTimeout(function() {
					$("#corpo").html(html);
				}, 3000);
			}
		})
	},
	edita:function(id) {
		var titulo = $("#titulo").val();
		var tipo = $("#tipo").val();
		var cargos = new Array();
		$("input[name='permissao[]']:checked").each(function(){
			cargos.push($(this).val());
		});
		var descricao = $(".descricao").val();
		var conteudo = $(".conteudo").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/alertas/edita.php",
			data:{'id':id, 'titulo':titulo, 'tipo':tipo, 'cargos':cargos, 'descricao':descricao, 'conteudo':conteudo},
			beforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">A SUA SOLICITAÇÃO ESTÁ A SER PROCESSADA</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'})
				ajeitaBox();
			}, success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
				}, 400);
			}
		})
	},
	deleta:function(id,tipo) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/alertas/deleta.php",
			data:{'id':id, 'tipo':tipo},
			beforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">A SUA SOLICITAÇÃO ESTÁ A SER PROCESSADA</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'})
				ajeitaBox();
			}, success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
				}, 400);
			}
		})
	}
}

var comentarios = {
	comentar:function(alerta) {
		var comentario = $(".comentario").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/comentar/comentar.php",
			data:{'comentario':comentario, 'alerta':alerta},
			beforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">A SUA SOLICITAÇÃO ESTÁ A SER PROCESSADA</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'})
				ajeitaBox();
			}, success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
				}, 400);
			}
		})
	},
	atualizar:function(alerta) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/comentar/comentarios.php",
			data:{'id':alerta},
			success:function(html) {
				$("#comentarios").html(html);
			}
		})
	},
	deleta:function(id, tipo) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/comentar/deleta.php",
			data:{'id':id, 'tipo':tipo},
			baforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">A SUA SOLICITAÇÃO ESTÁ A SER PROCESSADA</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
					inputs();
				}, 400);
			}
		});
	}
}

var form = {
	formulario:function(id) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/posta.php",
			data:{'id':id},
			success:function(html) {
				$("#lista").animate({width:'34%'}, 200);
				$("#recebe").html(html).animate({width:'64%'}, 200);
			}
		});
	}
}

function mascaraData(data,id) {
	verificaNum(id);
	var mdata = "";
	mdata = mdata + data;
	var quantidade = $(id).val().length;
	if(quantidade == 2) {
      	mdata = mdata + "/";
        $(id).val(mdata);
    }
	if(quantidade == 5) {
      	mdata = mdata + "/";
        $(id).val(mdata);
    }
	if(quantidade == 10){
		verificaData(id);
	}
	if(quantidade >= 11) {
		$(id).val($(id).val().substring(0,10));
	}
}

function mascaraHora(hora,id) {
	verificaNum(id);
	var mhora = '';
	mhora = mhora + hora;
	var quantHora = $(id).val().length;
	if(quantHora == 2) {
		mhora = mhora + ":";
		$(id).val(mhora);
	}

	if(quantHora == 5) {
		verificaHora(id);
	}

	if(quantHora > 5) {
		$(id).val($(id).val().substring(0,5));
	}
}

function verificaNum(id) {
		$(id).keyup(function(e) {
		$(this).val($(this).val().replace(/[^\d^\/^\:]/,''));
	});
}

var enviar = {
	ins:function() {
		var data = $("#data").val();
		var hora = $("#hora").val();
		var aula = $(".ins:checked").val();
		var sala = $(".sala:checked").val();
		var presentes = $(".presentes").tagsinput('items');
		var aprovados = $(".aprovados").tagsinput('items');
		var quali = $(".quali:checked").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/forms/instrução.php",
			data:{'data':data, 'hora':hora, 'aula':aula, 'sala':sala, 'presentes':presentes, 'aprovados':aprovados, 'quali':quali},
			beforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">A SUA SOLICITAÇÃO ESTÁ A SER PROCESSADA</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
				$(".carrega").css({width:'0px'});
				$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
				$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'})
				ajeitaBox();
			}, 400);
			}
		});
	}, cfi:function() {
		var data = $("#data").val();
		var hora = $("#hora").val();
		var presentes = $(".presentes").tagsinput('items');
		var aprovados = $(".aprovados").tagsinput('items');
		var comentario = $(".comentario").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/forms/cfi.php",
			data:{'data':data, 'hora':hora, 'presentes':presentes, 'aprovados':aprovados, 'comentario':comentario},
			beforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">ESTAMOS PROCESSANDO SUA SOLICITAÇÃO</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
				$(".carrega").css({width:'0px'});
				$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
				$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'})
				ajeitaBox();
			}, 400);
			}
		});
	}, av:function() {
		var data = $("#data").val();
		var hora = $("#hora").val();
		var presentes = $(".presentes").tagsinput('items');
		var aprovados = $(".aprovados").tagsinput('items');
		var comentario = $(".comentario").val();
		var tipo = $(".ava:checked").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/forms/av.php",
			data:{'data':data, 'hora':hora, 'presentes':presentes, 'tipo':tipo, 'aprovados':aprovados, 'comentario':comentario},
			beforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">ESTAMOS PROCESSANDO SUA SOLICITAÇÃO</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
				$(".carrega").css({width:'0px'});
				$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
				$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'})
				ajeitaBox();
			}, 400);
			}
		});
	}, cap:function() {
		var data = $("#data").val();
		var hora = $("#hora").val();
		var presentes = $(".presentes").tagsinput('items');
		var aprovados = $(".aprovados").tagsinput('items');
		var comentario = $(".comentario").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/forms/cap.php",
			data:{'data':data, 'hora':hora, 'presentes':presentes, 'aprovados':aprovados, 'comentario':comentario},
			beforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">ESTAMOS PROCESSANDO SUA SOLICITAÇÃO</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
				$(".carrega").css({width:'0px'});
				$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
				$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'})
				ajeitaBox();
			}, 400);
			}
		});
	}, admi:function() {
		var data = $("#data").val();
		var hora = $("#hora").val();
		var presentes = $(".presentes").tagsinput('items');
		var aprovados = $(".aprovados").tagsinput('items');
		var comentario = $(".comentario").val();
		var tipo = $(".admi:checked").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/forms/admi.php",
			data:{'data':data, 'hora':hora, 'presentes':presentes, 'tipo':tipo, 'aprovados':aprovados, 'comentario':comentario},
			beforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">ESTAMOS PROCESSANDO SUA SOLICITAÇÃO</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
				$(".carrega").css({width:'0px'});
				$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
				$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'})
				ajeitaBox();
			}, 400);
			}
		});
	},
}

function sair() {
	$.ajax({
		url:"arquivos/php/ajax/sair.php",
		success:function() {
			location.reload();
		}
	})
}

var script = {
	deleta:function(id) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/scripts/deleta.php",
			data:{'id':id},
			beforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">ESTAMOS PROCESSANDO SUA SOLICITAÇÃO</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
				$(".carrega").css({width:'0px'});
				$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'})
				ajeitaBox();
				}, 400);
			}
		});
	},
	adiciona:function() {
		var titulo = $("#titulo").val();
		var cargos = new Array();
		$("input[name='permissao[]']:checked").each(function(){
			cargos.push($(this).val());
		});
		var conteudo = $(".conteudo").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/scripts/adiciona.php",
			data:{'titulo':titulo, 'cargos':cargos, 'conteudo':conteudo},
			beforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">ESTAMOS PROCESSANDO SUA SOLICITAÇÃO</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
					inputs();
				}, 400);
			}
		});
	},
	edita:function(id) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/scripts/edita.php",
			data:{"id":id},
			beforeSend:function() {
				$("#corpo").html("");
				$(".carrega").animate({width:'100%'}, 2400);
				$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'0px',height:'0px'}).animate({opacity:'0'}, 500);
				}, 3000);
			},
			success:function(html) {
				window.setTimeout(function() {
					$("#corpo").html(html);
				}, 3000);
			}
		});
	},
	editar:function(id) {
		var titulo = $("#titulo").val();
		var cargos = new Array();
		$("input[name='permissao[]']:checked").each(function(){
			cargos.push($(this).val());
		});
		var conteudo = $(".conteudo").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/scripts/editar.php",
			data:{'id':id, 'titulo':titulo, 'cargos':cargos, 'conteudo':conteudo},
			beforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">ESTAMOS PROCESSANDO SUA SOLICITAÇÃO</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
				}, 400);
			}
		});
	}
}

var membros = {
	ativar:function(id) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/membros/ativar.php",
			data:{'id':id},
			baforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">ESTAMOS PROCESSANDO SUA SOLICITAÇÃO</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
					inputs();
				}, 400);
			}
		});
	},
	editar:function(id) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/membros/editar.php",
			data:{'id':id},
			beforeSend:function() {
				$("#corpo").animate({marginTop:'60px'});
				$("#main-menu").animate({top:'-2px'});
				$("#corpo").html("");
				$(".carrega").animate({width:'100%'}, 2400);
				$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'0px',height:'0px'}).animate({opacity:'0'}, 500);
				}, 3000);
			},
			success:function(html) {
				window.setTimeout(function() {
					$("#corpo").html(html);
				}, 3000);
				inputs();
			}
		});
	},
	edit:function(id) {
		var nick = $("#nick").val();
		var email = $("#email").val();
		var tag = $("#tag").val();
		var senha = $("#senha").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/membros/edit.php",
			data:{'id':id, 'nick':nick, 'email':email, 'tag':tag, 'senha':senha},
			baforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">ESTAMOS PROCESSANDO SUA SOLICITAÇÃO</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
					inputs();
				}, 400);
			}
		});
	},
	desativar:function(id) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/membros/desativar.php",
			data:{'id':id},
			baforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">ESTAMOS PROCESSANDO SUA SOLICITAÇÃO</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
					inputs();
				}, 400);
			}
		});
	},
	desat:function(id) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/membros/desativar.php",
			data:{'id':id, 'tipo':'desat'},
			baforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">ESTAMOS PROCESSANDO SUA SOLICITAÇÃO</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
					inputs();
				}, 400);
			}
		});
	}
}

var aulas = {
	semanal:function() {
		$("#recebe").html("<div class='box'><div class='titulo preto'>DIGITE A DATA</div><Div class='corpo'><div class='item preto'><span class='item'>INSIRA A DATA</span><div class='input'><div class='icone'><i class='demo-icon icon-calendar-inv'></i></div><input type='text' id='data' name='data' placeholder='DD/MM/AAAA' onkeyup='mascaraData(this.value,\"#\"+this.id);'/></div></div><div class='botao vermelho' onclick='aulas.sem();'>VISUALIZAR AULAS</div></div></div>");
		inputs();
	},
	mensal:function() {
		$("#recebe").html("<div class='box'><div class='titulo preto'>DIGITE A DATA</div><Div class='corpo'><div class='item preto'><span class='item'>INSIRA A DATA</span><div class='input'><div class='icone'><i class='demo-icon icon-calendar-inv'></i></div><input type='text' id='data' name='data' placeholder='DD/MM/AAAA' onkeyup='mascaraData(this.value,\"#\"+this.id);'/></div></div><div class='botao vermelho' onclick='aulas.men();'>VISUALIZAR AULAS</div></div></div>");
		inputs();
	},
	sem:function() {
		var data = $("#data").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/aulas/semanal.php",
			data:{"data":data},
			beforeSend:function() {
			},
			success:function(html) {
				$("#recebe2").slideUp().html(html).slideDown('fast');
			}
		})
	},
	men:function() {
		var data = $("#data").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/aulas/mensal.php",
			data:{"data":data},
			beforeSend:function() {
			},
			success:function(html) {
				$("#recebe2").slideUp().html(html).slideDown('fast');
			}
		})
	},
	excluir:function(id,tipo) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/aulas/excluir.php",
			data:{"id":id, "tipo":tipo},
			baforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">ESTAMOS PROCESSANDO SUA SOLICITAÇÃO</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
					inputs();
				}, 400);
			}
		});
	}
}

var meta = {
	carrega:function(id) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/metas/carrega.php",
			data:{'id':id},
			beforeSend:function() {
				$("#corpo").animate({marginTop:'60px'});
				$("#main-menu").animate({top:'-2px'});
				$("#corpo").html("");
				$(".carrega").animate({width:'100%'}, 2400);
				$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'0px',height:'0px'}).animate({opacity:'0'}, 500);
				}, 3000);
			},
			success:function(html) {
				window.setTimeout(function() {
					$("#corpo").html(html);
				}, 3000);
				inputs();
			}
		});
	},
	resultado:function(id,caminho) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/metas/"+caminho+".php",
			data:{"id":id},
			success:function(html) {
				$("#resultado").html(html);
			}
		})
	}
}

var gradua = {
	sem:function() {
		var data = $("#data").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/gradua/semanal.php",
			data:{"data":data},
			beforeSend:function() {
			},
			success:function(html) {
				$("#recebe").slideUp().html(html).slideDown('fast');
			}
		})
	},
	excluir:function(id,tipo) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/gradua/excluir.php",
			data:{"id":id, "tipo":tipo},
			baforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">ESTAMOS PROCESSANDO SUA SOLICITAÇÃO</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
					inputs();
				}, 400);
			}
		});
	}
}

var avalia = {
	sem:function() {
		var data = $("#data").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/avalia/semanal.php",
			data:{"data":data},
			beforeSend:function() {
			},
			success:function(html) {
				$("#recebe").slideUp().html(html).slideDown('fast');
			}
		})
	},
	excluir:function(id,tipo) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/avalia/excluir.php",
			data:{"id":id, "tipo":tipo},
			baforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">A SUA SOLICITAÇÃO ESTÁ A SER PROCESSADA</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
					inputs();
				}, 400);
			}
		});
	}
}

var capaci = {
	sem:function() {
		var data = $("#data").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/capaci/semanal.php",
			data:{"data":data},
			beforeSend:function() {
			},
			success:function(html) {
				$("#recebe").slideUp().html(html).slideDown('fast');
			}
		})
	},
	excluir:function(id,tipo) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/capaci/excluir.php",
			data:{"id":id, "tipo":tipo},
			baforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">ESTAMOS PROCESSANDO SUA SOLICITAÇÃO</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
					inputs();
				}, 400);
			}
		});
	}
}

var admi = {
	sem:function() {
		var data = $("#data").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/admi/semanal.php",
			data:{"data":data},
			beforeSend:function() {
			},
			success:function(html) {
				$("#recebe").slideUp().html(html).slideDown('fast');
			}
		})
	},
	excluir:function(id,tipo) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/admi/excluir.php",
			data:{"id":id, "tipo":tipo},
			baforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">A SUA SOLICITAÇÃO ESTÁ A SER PROCESSADA</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
					inputs();
				}, 400);
			}
		});
	}
}

var lista = {
	perfil:function(id, nick) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/lista/perfil.php",
			data:{"id":id},
			baforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">A SUA SOLICITAÇÃO ESTÁ A SER PROCESSADA</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'});
				ajeitaBox();
			},
			success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#carrega").css({width:'100%',height:'100%'}).animate({opacity:'1'}, 500);
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
					inputs();
				}, 400);
			}
		})
	},
	historico:function(id) {
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/lista/historico.php",
			data:{"id":id},
			beforeSend:function() {
				$("#reqresults #results .box").slideUp('fast');
			},
			success:function(html) {
				$("#reqresults #results .box").html(html).slideDown('fast');
				ajeitaBox();
			}
		})
	}
}

var docs = {
	adiciona:function() {
		var tipo = $(".oq:checked").val();
		var titulo = $("#titulo").val();
		var cargos = new Array();
		$("input[name='permissao[]']:checked").each(function(){
			cargos.push($(this).val());
		});
		var conteudo = $(".conteudo").val();
		$.ajax({
			type:"POST",
			url:"arquivos/php/ajax/docs/adiciona.php",
			data:{'tipo':tipo, 'titulo':titulo, 'cargos':cargos, 'conteudo':conteudo},
			beforeSend:function() {
				$("#reqresults").html('<div class="box"><div class="titulo azul2">A SUA SOLICITAÇÃO ESTÁ A SER PROCESSADA</div><div class="corpo">Por favor aguarde.</div></div>').css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
				$("#reqresults .box").css({width:'500px'})
				ajeitaBox();
			}, success:function(html) {
				window.setTimeout(function() {
					$(".carrega").css({width:'0px'});
					$("#reqresults").html(html).css({width:'100%',height:'100%'}).animate({opacity:"1"}, 500);
					$("#reqresults .box").css({width:'500px'})
					ajeitaBox();
				}, 400);
			}
		})
	}
}