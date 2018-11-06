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
		alert('Insira uma data válida!!');

		//destacando o campo com erro
		$(input).css('border', '1px solid red');

		return false;
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
	$('#erro').append(mensagem);
	$('#erro').fadeIn(400);
}

function mostrarInfo(mensagem){
	$('.mensagens').fadeIn(400);
	$('#info').append(mensagem);
	$('#info').fadeIn(400);
}

function mostrarSucesso(mensagem){
	$('.mensagens').fadeIn(400);
	$('#sucesso').append(mensagem);
	$('#sucesso').fadeIn(400);
}

function fecharMensagem(){
	$('.mensagens').fadeOut(400);
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