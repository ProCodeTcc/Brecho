<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = "";
	}
?>

<script>
	var url = '../../';
	
	//função para realizar uma busca para trazer o tamanho através da medida
	function buscarMedida(tamanho){
		//limpando as options
		$('#txttamanho').find('option').remove();
		
		$('#txttamanho').show();
		
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {tamanho: tamanho, controller: 'produto', modo: 'buscarMedida'}, //parâmetros enviados
			success: function(dados){
				json = JSON.parse(dados); //conversão dos dados para json
				
				//percorrendo os tamanhos
				for(var i = 0; i < json.length; i++){
					//criando uma nova option, de acordo com a quantidade de tamanhos
					$('#txttamanho').append(new Option(json[i].tamanho, json[i].idTamanho));
				}
			}
		});
	}
	
	//função para realizar uma busca para trazer o tamanho através do número
	function buscarNumero(tamanho){
		//limpando o select
		$('#txttamanho').find('option').remove();
		
		$('#txttamanho').show();
		
		$.ajax({
			type: 'POST', //tipo de requisiçao
			url: url+'router.php', //url onde será enviada a requisição
			data: {tamanho: tamanho, controller: 'produto', modo: 'buscarMedida'}, //parâmetros enviados
			success: function(dados){
				json = JSON.parse(dados); //conversão dos dados para json
				
				//percorrendo os dados
				for(var i = 0; i < json.length; i++){
					//criando uma nova option, de acordo com a quantidade de tamanhos
					$('#txttamanho').append(new Option(json[i].tamanho, json[i].idTamanho));
				}
			}
		});
	}
	
	//função para lisar as cores disponíveis
	function listarCor(){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {controller: 'produto', modo: 'buscarCor'}, //parâmetros enviados
			success: function(dados){
				//convertendo os dados para json
				json = JSON.parse(dados);
				
				//percorrendo os dados
				for(var i = 0; i < json.length; i++){
					//criando uma nova option, de acordo com a quantidade de cores
					$('#txtcor').append(new Option(json[i].nome, json[i].idCor));
				}
			}
		});
	}
	
	//função para listar as marcas
	function listarMarca(){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {controller: 'produto', modo: 'buscarMarca'}, //parâmetros enviados
			success: function(dados){
				//conversão dos dados para json
				json = JSON.parse(dados);
				
				//percorrendo os dados
				for(var i = 0; i < json.length; i++){
					//criando uma nova option, de acordo com o número de marcas
					$('#txtmarca').append(new Option(json[i].nomeMarca, json[i].idMarca));
				}
			}
		});
	}
	
	//função para listar as categorias
	function listarCategoria(){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {controller: 'produto', modo: 'buscarCategoria'}, //parâmetros enviados
			success: function(dados){
				//conversão dos dados para json
				json = JSON.parse(dados);
				
				for(var i = 0; i < json.length; i++){
					$('#txtcategoria').append(new Option(json[i].nomeCategoria, json[i].idCategoria));
				}
                
                selecionarSubcategoria(json.idCategoria);
			}
		});
	}

	//função para listar as subcategorias de uma categoria
	function selecionarSubcategoria(idCategoria){
		//removendo as options anteriores
		$('#txtsubcategoria').children().remove();
		
		//verificando se o ID da categoria é indefinido
		if(idCategoria == undefined){
			//resgatando o ID da categoria
			var idCategoria = $('#txtcategoria').find('option:selected').val();
		}

		//verificando se existe o ID da categoria
		if(typeof idCategoria == 'string'){
			//mostra a subcategoria
			$('#subcategoria').show();
		}
	
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {controller: 'produto', modo: 'buscarSubcategoria', id:idCategoria}, //dados enviados
			success: function(dados){
				//conversão dos dados para JSON
				json = JSON.parse(dados);

				//percorrendo os dados
				for(var i = 0; i < json.length; i++){
					//criando uma nova option com os dados
					$('#txtsubcategoria').append(new Option(json[i].nome, json[i].idSubcategoria));
				}
			}
		});
	}
	
	//função para buscar o produto
	function buscarProduto(id, idioma){
		$('#frmImagem').hide();
		$('#txttamanho').show();
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'/router.php', //url onde será enviada a requisição
			data: {id:id, idioma:idioma, controller: 'produto', modo: 'buscar'}, //parâmetros enviados
			success: function(dados){
				$('#frmRoupa').attr('data-lang', idioma);
				$('.imagens_container').hide();

				//conversão dos dados para json
				json = JSON.parse(dados);
				
				//colocando os valores nas caixas de texto
				$('.txtnome').val(json.nomeProduto);
				$('.txtdesc').val(json.descricao);
				$('#txtcor').val(json.idCor);
				$('#txtmarca').val(json.idMarca);
				$('#txtcategoria').val(json.idCategoria);
				$('#txtpreco').val(json.preco);
				$('#txtsubcategoria').val(json.idSubcategoria);
				selecionarSubcategoria(json.idCategoria);
			}
		});
	}
	
	function mostrarPrevia(input, localPrevia){
		if(input.files && input.files[0]){
			var leitor = new FileReader();
			
			leitor.onload = function(event){
				$(localPrevia).attr('src', event.target.result);
			}
			
			leitor.readAsDataURL(input.files[0]);
		}
	}
	
	$(document).ready(function(){
		$('#tabs').tabs();
		$('#tabs').tabs('disable', 1);
		
		$('#frmRoupa').submit(function(e){
			e.preventDefault();
			
			//armazenando o formulário me uma variável
			var formulario = new FormData($('#frmRoupa')[0]);
			
			//atribuindo a controller ao form
			formulario.set('controller', 'produto');
			
			//armazenando o modo em uma variável
			var modo = $('#frmRoupa').attr('data-modo');
            
            //verifica se o modo é pra inserir
            if(modo == 'inserir'){
                //verifica se as imagens foram selecionadas
                if(verificarImagem() != 0){
                    //mensagem de informação
                    mostrarInfo('Selecione as imagens');
                }
            }

			//atribuindo o modo ao form
			formulario.set('modo', modo);

			//armazenando o idioma em uma variável
			var idioma = $('#frmRoupa').attr('data-lang');

			//atribuindo o idioma ao form
			formulario.set('idioma', idioma);

			//armazenando o ID em uma variável
			var id = $('#frmRoupa').attr('data-id');

			//atribuindo o ID ao form
			formulario.set('id', id);
			
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'router.php', //url onde será enviada a requisição
				data: formulario, //dados enviados
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					//conversão dos dados para JSON
					json = JSON.parse(dados);

					if(modo == 'inserir'){ //verifica o modo
						if(json.status == 'inserido'){
							
							//muda o atributo submit pra true
							$('#frmRoupa').attr('data-submit', true);

							//muda o idioma para inglês
							$('#frmRoupa').attr('data-lang', 'en');

							//muda o ID para o do produto inserido
							$('#frmRoupa').attr('data-id', json.id);

							//troca de aba
							verificarSubmit();
						}else if(json.status == 'traduzido'){
							//mostra a mensagem de sucesso
							mostrarSucesso('Produto inserido com sucesso!!');

							//lista os dados
							listar();
						}else if(json.status == 'erro-imagem'){
							//mostra mensagem de erro
							mostrarErro('Ocorreu um erro ao inserir a imagem!!');
						}else if(json.status == 'erro'){
							//mostra mensagem de erro
							mostrarErro('Ocorreu um erro ao inserir o produto!!');
						}
					}else{
						if(json.status == 'atualizado'){
							//mostra mensagem de sucesso
							mostrarSucesso('Produto atualizado com sucesso!!');

							//lista os dados
							listar();
						}else{
							//mostra mensagem de erro
							mostrarErro('Ocorreu um erro ao atualizar o produto!!');
						}
					}
				}
			});
		});
	});
</script>

<form class="form" id="frmRoupa" data-id="<?php echo($id) ?>" method="post" name="frmRoupa" data-lang="pt" enctype="multipart/form-data" name="frmImagem">		
	<div id="tabs">
		<ul>
			<li>
			 	<a href="frm_roupa_pt.php">PT</a>
			</li>

			<li>
				<a href="frm_roupa_en.php">EN</a>
			</li>

			<img class="fechar" src="../imagens/fechar.png" onclick="fecharModal()">
		</ul>
	</div>
</form>