<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}
?>

<script>
	var url = '../../';
	
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
		$('.modal').height(300);
		$('.modal').width(300);
		
		$('#imagem').live('change', function(){
			mostrarPrevia(this);
		});
		
		//função para submeter o formulário
		$('#send_image').submit(function(e){
			e.preventDefault();
			
			//armazenando o formulário em uma variável
			var formulario = new FormData($('#send_image')[0]);
			
			//armazenando o id da imagem em uma variável
			var id = $('#send_image').data('id');
			
			//atribuindo ao formulário o parâmetro id
			formulario.append('id', id);
			
			//atribuindo ao formulário o parâmetro controller
			formulario.append('controller', 'produto');
			
			//atribuindo ao formulário o parâmetro modo
			formulario.append('modo', 'atualizarImagem');
			
			
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'router.php', //url onde será enviada a requisição
				data: formulario, //dados enviados
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					alert(dados);
					listar();
					$('.container_modal').fadeOut(400);
				}
			});
			
		});
	});
</script>

<form id="send_image" data-id="<?php echo($id) ?>">
	<div id="visualizar_roupa">
		<label for="imagem">
			<img id="img" src="../imagens/image.png">
			<input type="file" name="fleimagem" id="imagem">
		</label>
	</div>
	
	<input type="submit" class="sub_btn" value="ENVIAR">
</form>