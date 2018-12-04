<?php
    //verificando se existe o ID
	if(isset($_POST['id'])){
        //resgatando o ID
		$idImagem = $_POST['id'];
        
        //resgatando o caminho da imagem
		$caminho = $_POST['caminho'];
	}
?>

<script>
    //função para exibir a prévia
	function mostrarPrevia(input){
		if(input.files && input.files[0]){
            //criando um novo leitor
			var leitor = new FileReader();
			
            //função no evento do carregamento
			leitor.onload = function(event){
                //exibindo a prévia da imagem
				$('#prev_imagem').attr('src', event.target.result);
			}
			
			leitor.readAsDataURL(input.files[0]);
		}
	}
	
	$(document).ready(function(){
		var url = '../../';
		
		//restatando o id da imagem
		var id = $('#frmImagem').data('id');
		
		//resgatando o caminho da imagem
		var caminho = $('#frmImagem').data('caminho');

		//verificando de há alguma imagem
		if(caminho != ""){
			//se ouver, mostra a prévia
			$('#prev_imagem').attr('src', '../arquivos/'+caminho);
		}else{
			//se não houver, mostra uma imagem genérica
			$('#prev_imagem').attr('src', '../imagens/picture.png');
		}
		
		$('#imagem').live('change', function(){
			mostrarPrevia(this);
		});
		
		//função no submit do form
		$('#frmImagem').submit(function(e){
			//desativando o submit
			e.preventDefault();
			
			//armazenando o formulário em uma variável
			var formulario = new FormData($('#frmImagem')[0]);
			
			//acrescentando ao formulário o parâmetro modo
			formulario.append('modo', 'atualizarImagem');
			
			//acrescentando ao formulário o parâmetro controller
			formulario.append('controller', 'produto');
			
			//acrescentando ao formulário o parâmetro ID
			formulario.append('id', id);
			
			//acrescentando ao formulário o parâmetro imagem
			formulario.append('imagem', caminho);
			
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'router.php', //url onde será enviada a requisição
				data: formulario, //dados enviados
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					//mensagem de sucesso
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

<form id="frmImagem" name="frmImagem" data-id="<?php echo($idImagem) ?>" data-caminho="<?php echo($caminho) ?>">
	<div id="visualizar_edicao">
		<label for="imagem">
			<img id="prev_imagem" src="">
		</label>
		
		<input type="file" id="imagem" name="fleimagem">
	</div>
	
	<input type="submit" class="sub_btn" value="ENVIAR">
</form>