<?php
	if(isset($_POST['idCategoria'])){
		$id = $_POST['idCategoria'];
	}else{
		$id = null;
    }
    
    if(isset($_POST['idSubcategoria'])){
        $id = $_POST['idSubcategoria'];
    }
?>

<script>
    var url = '../../';
    
    //função que exibe os dados da subcategoria para edição
    function exibirDados(id){
        $.ajax({
            type: 'POST', //tipo de requisição
            url: url+'router.php', //url onde será enviada a requisição
            data:{id:id, controller: 'categoria', modo:'buscarSubcategoria'}, //parâmetros enviados
            success: function(dados){
                //conversão dos dados para JSON
                json = JSON.parse(dados);
    
                //colocando os valores nas caixas de texto
                $('.txtnome').val(json.nome);
            }
        });
    }
	$(document).ready(function(){
        mudarModal('350', '400');
        
        //resgatando o id da subcategoria
        var idSubcategoria = $('#frmSubcategoria').attr('data-idSubcategoria');

        //verificando se existe algum id
        if(idSubcategoria != ""){
            //exibe os dados pra edição
            exibirDados(idSubcategoria);
        }

		//função para submeter o form
		$('#frmSubcategoria').submit(function(e){
			//desativando o submit do formulário
            e.preventDefault();
            
            //armazenando os dados do form numa variável
            formulario = new FormData($('#frmSubcategoria')[0]);

            //setando o controller no formulário
            formulario.set('controller', 'categoria');

            //resgatando o ID
            var id = $('#frmSubcategoria').attr('data-id');

            //verificando se existe o ID da subcategoria
            if(idSubcategoria == ""){
                //setando o modo
                formulario.set('modo', 'inserirSubcategoria');

                //setando o ID da categoria
                formulario.set('idCategoria', id);
            }else{
                //setando o modo
                formulario.set('modo', 'editarSubcategoria');

                //setando o ID da subcategoria
                formulario.set('id', idSubcategoria);
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

                    //verificando se foi inserido
                    if(json.status == 'inserido'){
                        //mensagem de sucesso
                        mostrarSucesso('Subcategoria inserida com sucesso!!');
                    }else if(json.status == 'atualizado'){ //verificando se foi atualizado
                        //mensagem de sucesso
                        mostrarSucesso('Subcategoria atualizada com sucesso!!');
                    }else{
                        //mensagem de erro
                        mostrarErro('Ocorreu um erro ao realizar essa operação..');
                    }
				}
			});
		});
	});
</script>

<img class="close" src="../imagens/fechar.png" onclick="fecharModal()">
<div class="form_container">
	<form class="frm_categoria" data-id="<?php echo($id) ?>" data-idSubcategoria="<?php echo($id) ?>" id="frmSubcategoria" name="frm_categoria">
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