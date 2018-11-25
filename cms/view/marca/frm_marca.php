<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
    var url = '../../';
	
	//função que exibe os dados no formulário
	function exibirDados(id){
		$.ajax({
		   type: 'POST', //tipo de requisição
		   url: url+'/router.php', //url para onde será enviada a requisição
		   data: {id:id, modo: 'buscar', controller: 'marca'}, //dados enviados
		   success: function(dados){
				json = JSON.parse(dados); //conversão dos dados para JSON
				//inserindo os valores nas caixas de texto
				$('#txtnome').val(json.nomeMarca);
		   } 
		});
	}
	
    $(document).ready(function(){
		//resgatando o id do formulário
        var id = $('#frm_marca').data('id');
		
		//verificando se o id está vazio
		//caso estiver fazio, a função de exibir os dados é chamada, pois o usuário deseja editar
		if(id != ""){
			exibirDados(id);
		}
		
        
		$('.fechar').click(function(){
            $('.container_modal').fadeOut(400);
        });

        $('#frm_marca').submit(function(event){
            //desabilitando a função de submit do botão
            event.preventDefault();

            //armazenando o formulário em uma variável
            var formulario = new FormData($('#frm_marca')[0]);
            
            //atribuindo o id ao formulário
            formulario.append('id', id);

            //atribuindo a variável controller, contendo marca como parâmetro
            formulario.append('controller', 'marca');
            
            //verificando se o ID for nulo, se sim, envia a variável modo com o parâmetro inserir, caso contrário, envia com o parâmetro de editar
            if(id == ""){
                formulario.append('modo', 'inserir');
            }else{
                formulario.append('modo', 'editar');
            }
            
            //chamando o ajax
            $.ajax({
                type: 'POST', //tipo de requisição
                url: url+'/router.php', //url
                data: formulario, //dados a serem enviados
                cache: false,
                contentType: false,
                processData: false,
                async: true,
                success: function(dados){
                    //conversão dos dados para JSON
                    json = JSON.parse(dados);

                    if(id == ""){
                        //verificando o status de inserção
                        if(json.status == 'sucesso'){
                            //mensagem de sucesso
                            mostrarSucesso('Marca inserida com sucesso');
                            
                            //listagem dos dados
                            listar();
                        }else if(json.status == 'erro'){
                            //mensagem de erro
                            mostrarErro('Ocorreu um erro ao inserir a marca');
                        }   
                    }else{
                        //verificando o status de update
                        if(json.status == 'atualizado'){
                            //mensagem de sucesso
                            mostrarSucesso('Marca atualizada com sucesso');
                            
                            //listagem dos dados
                            listar();
                        }else if(json.status == 'erro'){
                            //mensagem de erro
                            mostrarErro('Ocorreu um erro ao atualizar a marca');
                        }   
                    }
                }
            });
        });
    });
</script>
<img class="fechar" src="../imagens/fechar.png">
<div class="form_container">
    <form class="frmMarca" method="post" data-id="<?php echo($id) ?>" name="frmMarca" id="frm_marca">
        <div class="form_linha">
            <label class="lbl_cadastro">
                Nome:
            </label>

            <input type="text" class="cadastro_input" name="txtnome" id="txtnome">
        </div>

        <div class="form_linha" id="btn_linha">
            <input type="submit" class="sub_btn" value="CADASTRAR">
        <div>
        </div>
    </form>
</div>