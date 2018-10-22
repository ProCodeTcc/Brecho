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