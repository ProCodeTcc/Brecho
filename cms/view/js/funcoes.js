// JavaScript Document

//função que valida a data
function validarData(input){
	//data atual
	var dataAtual = new Date();

	//data do formulário
	var data = new Date($(input).val());

	//verificando se a data é menor que a atual ou se é nula
	if(data < dataAtual || data == 'Invalid Date'){
		//mensagem de erro
		mostrarErro('Insira uma data válida!!');

		//destacando o campo com erro
		$(input).css('border', '1px solid red');

		return false;
	}else{
		//destacando o campo com erro
		$(input).css('border', '1px solid black');
	}
}

function validarTermino(inicio, termino){
	//verificando se a data é menor que a atual ou se é nula
	if(inicio < termino){
		//mensagem de erro
		mostrarErro('A data de término não pode ser menor que a de início');

		//destacando o campo com erro
		$(input).css('border', '1px solid red');

		return false;
	}else{
		//destacando o campo com erro
		$(input).css('border', '1px solid black');
	}
}

//função que verifica se o form em pt foi submetido
function verificarSubmit(){
	//armazenando o valor em uma variável
	var submit = $('.form').data('submit');

	//verificando se é verdadeiro
	if(submit == true){
		//habilita a guia em inglês
		$('#tabs').tabs('enable', 1);

		//desabilita em português
		$('#tabs').tabs('disable', 0);

		//seta a guia em inglês como ativa
		$('#tabs').tabs('option', 'active', 1);
	}
}

function mostrarErro(mensagem){
	$('.mensagens').fadeIn(400);
	$('#erro .msg').html(mensagem);
	$('#erro').fadeIn(400);
}

function mostrarInfo(mensagem){
	$('.mensagens').fadeIn(400);
	$('#info .msg').html(mensagem);
	$('#info').fadeIn(400);
}

function mostrarSucesso(mensagem){
	$('.mensagens').fadeIn(400);
	$('#sucesso .msg').html(mensagem);
	$('#sucesso').fadeIn(400);
}

function fecharMensagem(){
	$('.mensagens').fadeOut(400);
	$('.mensagens').children().hide();
}

function fecharModal(){
	$('.container_modal').fadeOut(400);
}

function mudarModal(altura, largura){
	$('.modal').height(altura);
	$('.modal').width(largura);
}

function voltar(){
	$('#pesquisa').hide();
	$('#consulta').show();
}

function pesquisar(e){
	if(e.keyCode == 13 || e.button == 0){
		var termo = $('#pesquisar').val();

		$.ajax({
			type: 'POST',
			url: 'pesquisa.php',
			data: {pesquisa:termo},
			success: function(dados){
				$('#consulta').hide();
				$('#pesquisa').show();
				$('#pesquisa').html(dados);
			}
		});
	}
}

//função para validar as imagens
function verificarImagem(){
	var arquivos = 0;

	//percorrendo os inputs
	$('input[type=file]').each(function(){
		//verificando se estão vazios
		if(!$(this).val()){
			//conta quantos inputs estão vazios
			arquivos += 1;
		}
	});

	//retorna a quantidade
	return arquivos;
}

function verificarDados(local){
	var resultado = $.trim($(local).html()).length;
    
	if(resultado == 0 || resultado == 108 || resultado == 36 || resultado == 38){
		$.ajax({
			type: 'POST',
			url: '../erro_tabela.php',
			success: function(dados){
				$(local).html(dados);
			}
		});
	}
}

function exibirSubmenu(){
    //evento no click de um item do menu
    $('.menu .menu_itens').click(function(e){
        //mostrando o submenu somente do item clicado
        $(this).find('.submenu').toggle(400);

        //escondendo os submenus dos itens que não forem clicados
        $('.menu_itens').not(this).find('.submenu').hide('fast');
    });
}

function graficoPizza(qtdA, qtdB, qtdC, qtdD){
    var ctx = document.getElementById('grafico').getContext('2d');
    
    var data = {
        labels: ['Alternativa A', 'Alternativa B', 'Alternativa C', 'Alternativa D'],
        datasets: [{
            label: 'Quantidade de Respostas',
            data: [qtdA, qtdB, qtdC, qtdD],
            backgroundColor: ['#F7464A', '#E2EAE9', '#D4CCC5', '#949FB1']
        }]
    };
    var options = {
        animation: {
            easing: 'easeInOutQuart',
            duration: 1000
        }
    }
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options:options
    });
}
