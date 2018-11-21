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

//função no logout
function logout(){
	$.ajax({
		type: 'POST', //tipo de requisição
		url: '../router.php?controller=login&modo=deslogar', //url onde será enviada a requisição
		success: function(dados){
            //redireciona o usuário
			window.location.href="login.php";
		}
	});
}

//função para verificar os dados existentes no banco
function checkDados(controller, campo, input){
    //resgatando o valor do campo
	txtvalor = $(input).val();
	
	$.ajax({
		type: 'POST', //tipo de requisição
		url: '../router.php?controller='+controller+'&modo=validar'+campo, //url onde será enviada a requisição
		data: {campo:txtvalor},
		success: function(dados){
            //verifiando se os dados existem
			if(dados == 'false'){
                //se existirem
				lowCampo = campo.toLowerCase();
                
                //coloca uma borda vermelha no campo
				$(input).css('border', '1px solid red');
                
                //mostra div de erro
				$('#erro_campo').show();
                
                //mensagem de erro
				$('#erro_campo').html('O '+lowCampo+' '+txtvalor+' já está cadastrado!!');
                
                //limpa o campo
				$(input).val('');
			}else{
                //limpa a div
				$('#erro_campo').empty();
                
                //esconde a div de erro
				$('#erro_campo').hide();
                
                //borda padrão
				$(input).css('border', '1px solid lightgray');
			}
		}
	});
}

//função para atualizar o clique
function atualizarClique(element, event, idProduto){
    //desativando o clique
	event.preventDefault();

    //pegando a url
	url = $(element).attr('href');
	
	$.ajax({
		type: 'POST', //tipo de requisiçã
		url: '/brecho/router.php?controller=produto&modo=clique', //url onde será enviada a requisição
		data: {id:idProduto},
		success: function(dados){
            //redirecionando o usuario
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

//função para mostrar mensagem de erro
function mostrarErro(mensagem){
    //abrindo a mensagem
	$('.mensagens').fadeIn(400);
    
    //preenchendo a mensagem
	$('.msg').html(mensagem);
    
    //exibindo a mensagem de erro
	$('#erro').fadeIn(400);
}

//função para mostrar mensagem de informação
function mostrarInfo(mensagem){
    //abrindo a mensagem
	$('.mensagens').fadeIn(400);
    
    //preenchendo a mensagem
	$('.msg').html(mensagem);
    
    //exibindo a mensagem de informação
	$('#info').fadeIn(400);
}

//função para mostrar uma mensagem de sucesso
function mostrarSucesso(mensagem){
    //mostrando a mensagem
	$('.mensagens').fadeIn(400);
    
    //preenchendo a mensagem
	$('.msg').html(mensagem);
    
    //exibindo a mensagem de sucesso
	$('#sucesso').fadeIn(400);
}

//função para fechar a mensagem
function fecharMensagem(e){
    //fechando a modal
	$('.mensagens').fadeOut(400);
    
    //fechando as mensagens
    $('.mensagens').children().hide();
}

//função para redirecionar o usuário
function redirecionarUsuario(url){
	$('.close').click(function(){
		window.location.href=url;
	})
}

//função para mostrar a mensagem de diálogo
function mostrarDialogo(mensagem){
    //exibindo a janela
    $('.mensagens').fadeIn(400);
    
    //preenchendo a mensagem
	$('.msg-dialog').html(mensagem);
    
    //exibindo a mensagem
	$('#dialog').fadeIn(400);
}

//função para fechar a modal
function fecharModal(){
    //fechando a modal
    $('.container_modal').fadeOut(400);
}

//função para exibir o filtro nos dispositivos móveis
function filtroResponsivo(){
    //função no click do menu do filtro
    $('#filtro_menu').click(function(){
        //mostra o submenu
       $('#filtro_submenu').toggle();
    });

    //função num item do filtro
    $('.filtro_responsivo_item').click(function(){
        //mostra as opções de filtro
       $('.opcao_item').fadeToggle(); 
        
        //esconde as outras opções
       $('.filtro_responsivo_item').not($(this)).find('.opcao_item').hide();
    });
    
    //função no click do input de preço
    $('.preco_container').click(function(e){
        //desativa o fechamento da opção
       e.stopPropagation(); 
    });
}

//função para exibir o submenu do mobile
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

//função para exibir o painel do usuário nos dispositivos móveis
function painelUsuario(){
    //função no click do ícone
    $('.login a').click(function(e){
        //desabilitando o link
        e.preventDefault();
    });
    
    //função no click do ícone
    $('#login').click(function(){
        //mostrando o painel
        $('#painel_usuario').fadeToggle();
    });
}

//função para verificar se o acesso é via dispositivo móvel
function verificarMobile(){
    //verificando se dispositivo é android
    if (/Mobi|Android/i.test(navigator.userAgent)) {
        //retorna verdadeiro
        return true;
    }
}

//função para verificar se existe algum produto
function verificarProdutos(){
    //verifica o conteúdo da div
    var resultado = $.trim($('.filtro_categoria').html()).length;

    //verifica o resultado
    if(resultado == 0){
        //mostra mensagem caso não haja nennhum
        $('.nenhum_produto').show();
    }
}

 //função para adicionar um item ao carrinho
function adicionarCarrinho(id, event){
    event.preventDefault();
    $.ajax({
        type: 'POST', //tipo de requisição
        url: '../router.php?controller=produto&modo=adicionarCarrinho', //url onde será enviada a requisição
        data: {id:id}, //parâmetros enviados
        success: function(dados){
            //verifica se o item já existe
            if(dados == 'existe'){
                //se existir, manda uma mensagem de erro
                alert('Esse item já foi adicionado ao carrinho!!');
            }else{
                //se não, adiciona o item ao carrinho
                $('#carrinho').html(dados);
            }
        }
    });
}