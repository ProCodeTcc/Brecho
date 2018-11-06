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
                //mudando o modo para editar
                $('#frm_enquete').attr('data-modo', 'editar');
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
                    // if(validarTermino() != false){
                    //     listar();
                    //     $('.container_modal').fadeOut(400);
                    // }

                    json = JSON.parse(dados);
    
                    if(modo == 'inserir'){
                        if(json.retorno == 'inserido'){
                            $('#frm_enquete').attr('data-submit', true);
                            $('#frm_enquete').attr('data-lang', 'en');
                            $('#frm_enquete').attr('data-id', json.id);
                            
                            verificarSubmit();
                        }else if(json.retorno == 'traduzido'){
                            alert('Enquete inserida com sucesso!!');
                        }
                    }else{
                        if(json.retorno == 'atualizado'){
                            alert('Enquete atualizada com sucesso!!');
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