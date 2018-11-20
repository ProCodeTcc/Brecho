// JavaScript Document
function checarLogin(login){
	if(login == 1){
        $('.logout').css('display', 'block');
        $('.perfil_usuario').show();

        if($(window).width() == '980'){
            $('.entrar').hide('fast');
        }

    }else{
        $('.logout').css('display', 'none');
        $('.perfil_usuario').hide('fast');

        if($(window).width() == '980'){
            $('.entrar').show();
        }
    }
}

function logout(){
	$.ajax({
		type: 'POST',
		url: '../router.php?controller=login&modo=deslogar',
		success: function(dados){
			window.location.href="login.php";
		}
	});
}

function checkDados(controller, campo, input){
	txtvalor = $(input).val();
	
	$.ajax({
		type: 'POST',
		url: '../router.php?controller='+controller+'&modo=validar'+campo,
		data: {campo:txtvalor},
		success: function(dados){
			if(dados == 'false'){
				lowCampo = campo.toLowerCase();
				$(input).css('border', '1px solid red');
				$('#erro_campo').show();
				$('#erro_campo').html('O '+lowCampo+' '+txtvalor+' já está cadastrado!!');
				$(input).val('');
			}else{
				$('#erro_campo').empty();
				$('#erro_campo').hide();
				$(input).css('border', '1px solid lightgray');
			}
		}
	});
}

function atualizarClique(element, event, idProduto){
	event.preventDefault();

	url = $(element).attr('href');
	
	$.ajax({
		type: 'POST',
		url: '/brecho/router.php?controller=produto&modo=clique',
		data: {id:idProduto},
		success: function(dados){
			window.location.href=url;
		}
	});
}

function sliderProduto(local){
	$(function() {
		var film_roll = new FilmRoll({
			container: local,
			position: 'left',
		});
	});
}

function sliderPrincipal(local){
	$(function() {
		var film_roll = new FilmRoll({
			container: local,
		});
	});
}

function sliderCartao(local){
	$(function() {
		var film_roll = new FilmRoll({
			container: local,
            prev: prev,
            next: next,
            configure_load: true,
		});
	});
}

function mostrarErro(mensagem){
	$('.mensagens').fadeIn(400);
	$('.msg').html(mensagem);
	$('#erro').fadeIn(400);
}

function mostrarInfo(mensagem){
	$('.mensagens').fadeIn(400);
	$('.msg').html(mensagem);
	$('#info').fadeIn(400);
}

function mostrarSucesso(mensagem){
	$('.mensagens').fadeIn(400);
	$('.msg').html(mensagem);
	$('#sucesso').fadeIn(400);
}

function fecharMensagem(e){
	$('.mensagens').fadeOut(400);
    $('.mensagens').children().hide();
}

function redirecionarUsuario(url){
	$('.close').click(function(){
		window.location.href=url;
	})
}

function mostrarDialogo(mensagem){
    $('.mensagens').fadeIn(400);
	$('.msg-dialog').html(mensagem);
	$('#dialog').fadeIn(400);
}

function fecharModal(){
    $('.container_modal').fadeOut(400);
}

function filtroResponsivo(){
    $('#filtro_menu').click(function(){
       $('#filtro_submenu').toggle();
    });

    $('.filtro_responsivo_item').click(function(){
       $('.opcao_item').fadeToggle(); 
       $('.filtro_responsivo_item').not($(this)).find('.opcao_item').hide();
    });
    
    $('.preco_container').click(function(e){
       e.stopPropagation(); 
    });
}

function submenuMobile(){
    //ação no click do menu
    $('#menu').click(function(){
        //mostrando o submenu
        $('#submenu').toggle(); 
    });

    //ação no click da categoria
    $('#categorias').click(function(){
        //mostando as categorias
        $('#menu_categoria').toggle();
    })

    //ação no click de uma categoria
    $('.categoria_item').click(function(){
        //mostrando as subcategorias
       $(this).find('#subcategorias').toggle(); 
        $('.categoria_item').not($(this)).find('#subcategorias').hide('fast');
    });
}

function painelUsuario(){
    $('.login a').click(function(e){
        e.preventDefault();
    });
    
    $('#login').click(function(){
        $('#painel_usuario').fadeToggle();
    });
}

function verificarMobile(){
    if (/Mobi|Android/i.test(navigator.userAgent)) {
        return true;
    }
}

function verificarProdutos(){
    var resultado = $.trim($('.filtro_categoria').html()).length;

    if(resultado == 0){
        $('.nenhum_produto').show();
    }
}