<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
	
	//função para exibir os dados no formulário
	function exibirDados(id, idioma){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {id:id, idioma:idioma, modo: 'buscar', controller: 'sobre'}, //dados enviados
			success: function(dados){
				$('.form').attr('data-lang', idioma);
                $('.sub_btn').val('ATUALIZAR');
                
				json = JSON.parse(dados);
				
				//colocando os valores nas caixas de texto
				$('.txttitulo').val(json.titulo);
				$('.txtdesc').val(json.descricao);
				$('.txtdesc2').val(json.descricao2);
				
				//verificando se a imagem não está vazia, e então mostra ela na div
				//de visualizar
				if(json.imagem != null){
					$('#imgSobre').attr('src', '../arquivos/'+json.imagem);
					$('#frm_sobreLayout2').attr('data-imagem', json.imagem);
				}
			}
		});
	}
	
    //função para exibir a prévia da imagem
	function mostrarPrevia(input){
		if(input.files && input.files[0]){
            //criando um novo leitor
			var leitor = new FileReader();
			
            //função no evento do carregamento
			leitor.onload = function(event){
                //exibição da imagem
				$('#imgSobre').attr('src', event.target.result);
			}
			
			leitor.readAsDataURL(input.files[0]);
		}
	}
	
	$(document).ready(function(){
		$('#tabs').tabs();
		$('#tabs').tabs('disable', 1);
		
		$('#imagem').live('change', function(){
			mostrarPrevia(this);
		});
		
		$('#frm_sobreLayout2').submit(function(e){
			//desabilitando o submit do botão
			e.preventDefault();

			//armazenando o formulario em uma variável
			var formulario =  new FormData($('#frm_sobreLayout2')[0]);
			
			//armazenando o tipo de layout numa variável
			var layout = $('#frm_sobreLayout2').attr('data-layout');

			//atribuindo ao formulário o parâmetro layout
			formulario.set('layout', layout);
			
			//armazenando o modo em uma variável
			var modo = $('#frm_sobreLayout2').attr('data-modo');
            
            //verificando se o modo é pra inserir
            if(modo == 'inserirLayout'){
                //verificando se a imagem foi selecionada
                if(verificarImagem() == 1){
                    //mostra informação
                    mostrarInfo('Selecione a imagem');
                }
            }

			//atribuindo ao formulário o parâmetro modo
			formulario.set('modo', modo);

			//armazenando o idioma em uma variável
			var idioma = $('#frm_sobreLayout2').attr('data-lang');

			//atribuindo ao formulário o idioma
			formulario.set('idioma', idioma);

			//armazenando o ID em uma variável
			var id = $('#frm_sobreLayout2').attr('data-id');

			//atribuindo ao formulário o ID
			formulario.set('id', id);

			//atribuindo ao formulário o parâmetro controller
			formulario.set('controller', 'sobre');
			
			//armazenando a imagem em uma variável
			var imagem = $('#frm_sobreLayout2').attr('data-imagem');
			
			//atribuindo ao formulário o parâmetro imagem
			formulario.set('imagem', imagem);
			
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'router.php', //url onde será enviada a requisição
				data: formulario, //dados que serão enviados
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					//conversão dos dados para JSON
					json = JSON.parse(dados);

					//verificando o modo
					if(modo == 'inserirLayout'){
						//se for inserirido, troca de aba e atualiza as informações do form
						if(json.status == 'inserido'){
							$('#frm_sobreLayout2').attr('data-submit', true);
							$('#frm_sobreLayout2').attr('data-id', json.id);
							$('#frm_sobreLayout2').attr('data-lang', 'en');

							verificarSubmit();
						}else if(json.status == 'traduzido'){
							//se for traduzido, mostra uma msg de sucesso e fecha o form
							mostrarSucesso('Layout inserido com sucesso!!');

                            //listagem dos dados
							listar();
						}else if(json.status == 'erro'){
                            //mensagem de erro
                            mostrarErro('Ocorreu um erro ao inserir o layout');
                        }
					}else{
						if(json.status == 'atualizado'){
                            //mensagem de sucesso
							mostrarSucesso('Layout atualizado com sucesso!!');
                            
                            //listagem dos dados
							listar();
						}else if(json.status == 'erro'){
                            //mensagem de erro
                            mostrarErro('Ocorreu um erro ao atualizar o Layout');
                        }
					}
				}
			});
		});
	});
</script>

<div class="frm_container">
	<form method="POST" class="form" data-id="<?php echo($id) ?>" enctype="multipart/form-data" data-lang="pt" data-layout="2" name="frmSobre" id="frm_sobreLayout2">
		<div id="tabs">
			<ul>
				<li>
					<a href="frm_layout2_pt.php">PT</a>
				</li>

				<li>
					<a href="frm_layout2_en.php">EN</a>
				</li>

				<img class="fechar" src="../imagens/fechar.png" onclick="fecharModal()">
			</ul>
		</div>
	</form>
</div>