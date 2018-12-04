<?php
    //verificando se existe o ID
	if(isset($_POST['id'])){
        //resgatando o ID
		$id = $_POST['id'];
	}else{
        //setando pra nulo
		$id = null;
	}
?>

<script>
	var url = '../../'
	
	//função que mostra a prévia da imagem
	function mostrarPrevia(input){
		if(input.files && input.files[0]){
			//criando um novo File Reader
			var leitor = new FileReader();
			
			leitor.onload = function(event){
				//colocando a imagem no local da prévia
				$('#img').attr('src', event.target.result);
			}
			
			leitor.readAsDataURL(input.files[0]);
		}
	}
	
	//função que exibe os dados no formulário
	function exibirDados(id, idioma){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {id:id, idioma:idioma, controller: 'evento', modo: 'buscar'}, //parâmetros enviados
			success: function(dados){
                $('.sub_btn').val('ATUALIZAR');
				$('#frmEvento').attr('data-lang', idioma);
				//conversão dos dados para JSON
				json = JSON.parse(dados);
				
				//resgatando os valores das caixas de texto
				$('.txtnome').val(json.nomeEvento);
				$('.txtdesc').val(json.descricaoEvento);
				$('.dtinicio').val(json.dataInicio);
				$('.dttermino').val(json.dataFim);
				
				//verificando se a imagem é nula
				if(json.imagemEvento != null){
					//mostrando a imagem do banco
					$('#img').attr('src', '../arquivos/'+json.imagemEvento);
					
					//colocando o caminho no data-atributo
					$('#frmEvento').attr('data-imagem', json.imagemEvento);
				}
			}
		});
	}
	
	$(document).ready(function(){
		mudarModal('750', '400');
		$('#tabs').tabs();
	
		$('#tabs').tabs('disable', 1);
		
		$('#imagem').live('change', function(){
			mostrarPrevia(this);
		});
		
		//função no submit do formulário
		$('#frmEvento').submit(function(e){
			//desativando o evento de submit
			e.preventDefault();
			
			//armazenando os dados do formulário em uma variável
			var formulario = new FormData($('#frmEvento')[0]);
			
			//atribuindo ao formulário o parâmetro controller
			formulario.set('controller', 'evento');
		
			//resgatando o caminho da imagem do data-atributo
			var imagem = $('#frmEvento').attr('data-imagem');

			//atribuindo ao formulário o parâmetro imagem
			formulario.set('imagem', imagem);
			
			//armazenando o modo em uma variável
			var modo = $('#frmEvento').attr('data-modo')

			//atribuindo o modo ao formulário
			formulario.set('modo', modo);
            
            //verificando se o modo é pra inserir
            if(modo == 'inserir'){
                //verificando se a imagem foi selecionada
                if(verificarImagem() == 1){
                    //mensagem de informação
                    mostrarInfo('Selecione a imagem');
                    
                    //parando o formulário
                    return false;
                }
            }
			
			//armazenando o ID em uma variável
			var id = $('#frmEvento').attr('data-id');

			//atribuindo ao formulário o parâmetro ID
			formulario.set('id', id);
			

			//armazenando o idioma em uma variável
			var idioma = $('#frmEvento').attr('data-lang');
			
			//atribuindo o idioma ao formulário
			formulario.set('idioma', idioma);
			
			
			$.ajax({
				type: 'POST',
				url: url+'router.php',
				data: formulario,
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					//conversão dos dados para JSON
					json = JSON.parse(dados);
					
					//verificando se o modo é pra inserir
					if(modo == 'inserir'){
						//verificando se foi inserido
						if(json.status == 'inserido'){
							//muda o submit pra true
							$('#frmEvento').attr('data-submit', true);

							//troca o idioma pra inglês
							$('#frmEvento').attr('data-lang', 'en');

							//troca o ID inserido
							$('#frmEvento').attr('data-id', json.id);

							//muda de aba
							verificarSubmit();
						}else if(json.status == 'traduzido'){ //verificando se foi traduzido
							//mensagem de sucesso
							mostrarSucesso('Evento inserido com sucesso!!');
							
							//listando os dados
							listar();
						}else if(json.status == 'erro'){
                            mostrarErro('Ocorreu um erro ao inserir o evento');
                        }
					}else{
						//verifica se foi atualizado
						if(json.status == 'atualizado'){
							//mensagem de sucesso
							mostrarSucesso('Evento atualizado com sucesso!!');
							
							//listagem dos dados
							listar();
						}else if(json.status == 'erro'){
                            mostrarErro('Ocorreu um erro ao atualizar o evento');
                        }else if(json.status == 'data'){
                            mostrarErro('Ocorreu um erro ao atualizar a data');
                        }
					}
				}
			});
		});
	});
</script>

<div class="form_container">
	<form method="post" id="frmEvento" data-id="<?php echo($id) ?>" data-lang="pt" class="form" name="frmEvento">
		<div id="tabs">
			<ul>
				<li>
					<a href="frm_evento_pt.php">PT</a>
				</li>

				<li>
					<a href="frm_evento_en.php">EN</a>
				</li>

				<img class="fechar" src="../imagens/delete.png" onclick="fecharModal()">
			</ul>
		</div>
	</form>
</div>