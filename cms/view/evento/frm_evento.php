<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
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
		mudarModal('650', '400');
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
						if(json.retorno == 'inserido'){
							//muda o submit pra true
							$('#frmEvento').attr('data-submit', true);

							//troca o idioma pra inglês
							$('#frmEvento').attr('data-lang', 'en');

							//troca o ID inserido
							$('#frmEvento').attr('data-id', json.id);

							//muda de aba
							verificarSubmit();
						}else if(json.retorno == 'traduzido'){ //verificando se foi traduzido
							//mensagem de sucesso
							alert('Evento inserido com sucesso!!');
							
							//listando os dados
							listar();
							
							//fechando a modal
							$('.container_modal').fadeOut(400);
						}
					}else{
						//verifica se foi atualizado
						if(json.retorno == 'atualizado'){
							//mensagem de sucesso
							alert('Evento atualizado com sucesso!!');
							
							//listagem dos dados
							listar();

							//fechando a modal
							$('.container_modal').fadeOut(400);
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