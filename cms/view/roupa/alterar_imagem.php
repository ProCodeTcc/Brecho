<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}
?>

<script>
	var url = '../../';
	$(document).ready(function(){
		$('.modal').height(300);
		$('.modal').width(300);
		
		$('#imagem').live('change', function(){
			$('#frmImagem').ajaxForm({
				target: '#visualizar_roupa',

			}).submit();
		});
		
		//função para submeter o formulário
		$('#send_image').submit(function(e){
			e.preventDefault();
			
			//armazenando o formulário em uma variável
			var formulario = new FormData($('#send_image')[0]);
			
			//armazenando o caminho da imagem em uma variável
			var imagem = $('#img1').attr('src');
			
			//armazenando o id da imagem em uma variável
			var id = $('#send_image').data('id');
			
			//atribuindo ao formulário o parâmetro imagem
			formulario.append('imagem', imagem);
			
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
					$('.container_modal').fadeOut(400);
				}
			});
			
		});
	});
</script>

<form method="post" class="frmImagem" id="frmImagem" name="frmImagem" enctype="multipart/form-data" action="upload.php">
	<div id="visualizar_roupa">
		<label for="imagem">
			<img src="../imagens/image.png">
			<input type="file" name="fleimagem[]" id="imagem">
		</label>
	</div>
</form>

<form id="send_image" data-id="<?php echo($id) ?>">
	<input type="submit" class="sub_btn" value="ENVIAR">
</form>