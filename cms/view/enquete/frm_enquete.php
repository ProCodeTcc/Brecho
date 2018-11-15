<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
    var url = '../../';
	
	//função que exibe os dados
	function exibirDados(id, idioma){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'/router.php', //url para onde será enviada a requisição
			data: {id:id, idioma:idioma, modo: 'buscar', controller: 'enquete'}, //dados a serem enviados
			success: function(dados){
                $('#frm_enquete').attr('data-lang', idioma);

				//conversão dos dados para JSON
				json = JSON.parse(dados);

				//atribuindo os valores para as caixas de texto
				$('#frm_enquete').data('id', json.idEnquete);
				$('.txtpergunta').val(json.pergunta);
				$('.txttema').val(json.idNivel);
				$('.alternativa_a').val(json.alternativaA);
				$('.alternativa_b').val(json.alternativaB);
				$('.alternativa_c').val(json.alternativaC);
				$('.alternativa_d').val(json.alternativaD);
				$('.dtinicio').val(json.dataInicial);
				$('.dttermino').val(json.dataFinal);
			}
		});
	}
	
    function validarTermino(){
		var dtInicio = $('#dtinicio').val();
		var dtTermino = $('#dttermino').val();

		if(dtInicio > dtTermino){
			alert("A DATA DE INÍCIO NÃO PODE SER MAIOR QUE A DE TÉRMINO!!");
			$('#dttermino').css('border', '1px solid red');
			return false;
		}
    } 
	
    $(document).ready(function(){
        mudarModal('650', '400');
        $('#tabs').tabs();
        $('#tabs').tabs('disable', 1);
        
        $('.fechar').click(function(){
            $('.container_modal').fadeOut(400);
        });

        $('#frm_enquete').submit(function(event){
            //desativando o submit do botão
            event.preventDefault();

            //armazenando os dados do formulário em uma variável
            var formulario = new FormData($('#frm_enquete')[0]);

            //armazenando o idioma do form em uma variável
            var idioma = $('#frm_enquete').attr('data-lang');

            //armazenando o ID da enquete em uma variável
            var id = $('#frm_enquete').attr('data-id');

            //armazenando o modo da enquete em uma variável
            var modo = $('#frm_enquete').attr('data-modo');

            //atribuindo o id ao formulário
            formulario.set('id', id);

            //atribuindo o idioma ao formulário
            formulario.set('idioma', idioma);

            //atribuindo o modo ao formulário
            formulario.set('modo', modo);
            
            //atribuindo a variável controller com o parâmetro enquete
            formulario.set('controller', 'enquete');

            $.ajax({
                type: 'POST', //tipo de requisição
                url: url+'/router.php', //url onde será feita a requisição
                data: formulario, //dados a serem enviados
                cache: false,
                contentType: false,
                processData: false,
                async: true,
                success: function(dados){
                    //conversão dos dados para JSON
                    json = JSON.parse(dados);
    
                    //verificando se o modo é pra inserir
                    if(modo == 'inserir'){
                        //verificndo se foi inserido
                        if(json.status == 'inserido'){
                            //atualizando os data-atributo
                            $('#frm_enquete').attr('data-submit', true);
                            $('#frm_enquete').attr('data-lang', 'en');
                            $('#frm_enquete').attr('data-id', json.id);
                            
                            //trocando a guia
                            verificarSubmit();
                        }else if(json.status == 'traduzido'){ //verificando se foi traduzido
                            //mensagem de sucesso
                            mostrarSucesso('Enquete inserida com sucesso!!');

                            //listagem dos dados
                            listar();
                        }else if(json.status == 'erro'){
                            //mensagem de rro
                            mostrarErro('Ocorreu um erro ao inserir a enquete');
                        }
                    }else{
                        if(json.status == 'atualizado'){ //verificando se foi atualizado
                            //mensagem de sucesso
                            mostrarSucesso('Enquete atualizada com sucesso!!');

                            //listagem dos dados
                            listar();
                        }else if(json.status == 'erro'){
                            //mensagem de erro
                            mostrarErro('Ocorreu um erro ao inserir a enquete');
                        }
                    }
                }
            });
        });
    });
</script>
    <form class="form" data-id="<?php echo($id) ?>" data-submit="false" data-lang="pt" method="post" name="form" id="frm_enquete" action="enquete_view.php">
        <div id="tabs">
            <ul>
                <li>
                    <a href="frm_enquete_pt.php">PT</a>
                </li>

                <li>
                    <a href="frm_enquete_en.php">EN</a>
                </li>
                <img class="fechar" src="../imagens/fechar.png">
            </ul>
        </div>
    </form>