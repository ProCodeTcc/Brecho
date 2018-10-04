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
		   data: {id:id, modo: 'buscar', controller: 'nivel'}, //dados enviados
		   success: function(dados){
				json = JSON.parse(dados); //conversão dos dados para JSON
				//inserindo os valores nas caixas de texto
				$('#txtnome').val(json.nomeNivel);
		   } 
		});
	}
	
    $(document).ready(function(){
		//resgatando o id do formulário
        var id = $('#frm_nivel').data('id');
		
		//verificando se o id está vazio
		//caso estiver fazio, a função de exibir os dados é chamada, pois o usuário deseja editar
		if(id != ""){
			exibirDados(id);
		}
		
        
		$('.fechar').click(function(){
            $('.container_modal').fadeOut(400);
        });

        $('#frm_nivel').submit(function(event){
            //desabilitando a função de submit do botão
            event.preventDefault();

            //armazenando o formulário em uma variável
            var formulario = new FormData($('#frm_nivel')[0]);
            
            //atribuindo o id ao formulário
            formulario.append('id', id);

            //atribuindo a variável controller, contendo nivel como parâmetro
            formulario.append('controller', 'nivel');
            
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
                    listar();
                    $('.container_modal').fadeOut(400); //fechar a modal em caso de sucesso
                }
            });
        });
    });
</script>

<div class="form_container">
    <img class="fechar" src="../imagens/fechar.png">
    <form class="frm_nivel" method="post" data-id="<?php echo($id) ?>" name="frmNivel" id="frm_nivel" action="nivel_view.php">
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