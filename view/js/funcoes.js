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