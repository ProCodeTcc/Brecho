<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
	var url = '../../';
	
	//função para exibir os dados no formulário
	function exibirDados(id){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {id:id, controller: 'slider', modo: 'buscar'}, //parâmetros enviados
			success: function(dados){
				//conversão dos dados para JSON
				json = JSON.parse(dados);
				
				//verificando se a imagem é nula
				if(json.caminhoImagem != null){
					//se não for, coloca a imagem
					$('#img').attr('src', '../arquivos/'+json.caminhoImagem);
					
					//armazena o caminho da imagem num data-atributo
					$('#frmSlider').data('imagem', json.caminhoImagem);
				}
			}
		});
	}
	
	function mostrarPrevia(input){
		if(input.files && input.files[0]){
			var leitor = new FileReader();
			
			leitor.onload = function(event){
				$('#img').attr('src', event.target.result);
			}
			
			leitor.readAsDataURL(input.files[0]);
		}
	}
	
	$(document).ready(function(){
		var id = $('#frmSlider').data('id');
		
		if(id != ""){
			exibirDados(id);
		}
		
		$('#frmSlider').submit(function(e){
			//desativando o submit do formulário
			e.preventDefault();
			
			//armazenando o formulário em uma variável
			var formulario = new FormData($('#frmSlider')[0]);
			
			//acrescentando ao formulário o parâmetro controller
			formulario.append('controller', 'slider');
			
			//verificando se o ID é nulo
			if(id == ""){
				//se for nulo, atribui ao formulário o parâmetro modo
				//contendo inserir
				formulario.append('modo', 'inserir');
			}else{
				//se existir o ID
				
				//resgata a imagem
				var imagem = $('#frmSlider').data('imagem');
				
				//atribui ao modo o parâmetro editar
				formulario.append('modo', 'editar');
				
				//acrescenta o id
				formulario.append('id', id);
				
				//acrescenta a imagem
				formulario.append('imagem', imagem);
			}
			
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'router.php', //url onde será enviada a requisição
				data: formulario, //dados enviados
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					//mensagem
					alert(dados);
					
					//listagem dos dados
					listar();
					
					//fechando a modal
					$('.container_modal').fadeOut(400);
				}
			});
		});
		
	});
</script>

<div class="form_container">
	<form method="post" class="frm_slider" data-id="<?php echo($id) ?>" id="frmSlider" name="frmSlider" enctype="multipart/form-data">
		<div class="form_linha">
			<div id="visualizar_slider">
				<label for="imagem">
					<img id="img" src="../imagens/picture.png">
				</label>

				<input type="file" class="cadastro_input" name="fleimagem" id="imagem" onChange="mostrarPrevia(this)">
			</div>
		</div>
		
		<div class="form_linha">
			<input type="submit" class="sub_btn" value="ENVIAR">
		</div>
	</form>
</div>