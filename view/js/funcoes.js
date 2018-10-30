// JavaScript Document
function checarLogin(login){
	if(login == 1){
		$('#logout').css('display', 'block');
		$('.login a').attr('href', '../view/perfil.php');
	}else{
		$('#logout').css('display', 'none');
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