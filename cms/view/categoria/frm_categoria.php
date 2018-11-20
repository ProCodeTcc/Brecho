<?php
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}else{
		$id = null;
	}
?>

<script>
    var url = '../../';
        //função que exibe os dados da categoria para edição
        function exibirDados(id){
            $.ajax({
                type: 'POST', //tipo de requisição
                url: url+'router.php', //url onde será enviada a requisição
                data:{id:id, controller: 'categoria', modo:'buscar'}, //parâmetros enviados
                success: function(dados){
                    //conversão dos dados para JSON
                    json = JSON.parse(dados);
                    $('.sub_btn').val('ATUALIZAR');
        
                    //colocando os valores nas caixas de texto
                    $('.txtnome').val(json.nomeCategoria);
                }
            });
	    }
	$(document).ready(function(){
        var id = $('#tabs').data('id');

        $('#tabs ul').hide();

        mudarModal('300', '400');

		if(id != ""){
            exibirDados(id);
            $('#tabs ul').show();
            $('#fechar').hide();
        }
		
		//função para submeter o form
		$('#frmCategoria').submit(function(e){
			//desativando o submit do formulário
			e.preventDefault();
			//armazenando o formulário em uma variável
			var formulario = new FormData($('#frmCategoria')[0]);

			//atribuindo a controller ao form
			formulario.set('controller', 'categoria');
			
			//verificando se existe algum ID
			if(id == ""){
				//se não, atualiza o modo para inserir
				formulario.set('modo', 'inserir');
			}else{
				//caso contrário, atualiza pra editar
				formulario.set('modo', 'editar');

				//atribuindo o ID ao form
				formulario.set('id', id);
			}
			
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'router.php', //url onde será enviada a requisição
				data: formulario,
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					//conversão dos dados para JSON
					json = JSON.parse(dados);

                    if(id == ""){
                        //verifica se foi inserido
                        if(json.status == 'sucesso'){
                            //mensagem de sucesso
                            mostrarSucesso('Categoria inserida com sucesso!!');
                        }else if(json.status == 'erro'){
                            mostrarErro('Ocorreu um erro ao inserir a categoria');
                        }
                    }else{
                        if(json.status == 'atualizado'){ //verifica se foi atualizado
                            //mensagem de sucesso
                            mostrarSucesso('Categoria atualizada com sucesso!!');
                        }else if(json.status == 'erro'){
                            //mensagem de erro
                            mostrarErro('Ocorreu um erro ao atualizar a categoria!!');
                        }
                    }
				}
			});
		});
	});
</script>

<img class="fechar" id="fechar" src="../imagens/fechar.png" onclick="fecharModal()">
<div class="form_container">
    <form class="frm_categoria" id="frmCategoria" name="frm_categoria">
        <div class="form_linha">
            <label class="lbl_cadastro">
                Nome:
            </label>
            
            <input type="text" class="cadastro_input txtnome" name="txtnome" id="txtnome">
        </div>
        
        <div class="form_linha" id="btn_linha">
            <input type="submit" class="sub_btn" value="CADASTRAR">
        </div>
    </form>
</div>