<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
	
	//função para exibir os dados no formulário
	function exibirDados(id){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {id:id, modo: 'buscar', controller: 'sobre'}, //dados enviados
			success: function(dados){
				json = JSON.parse(dados);
				
				//colocando os valores nas caixas de texto
				$('#txttitulo').val(json.titulo);
				$('#txtdesc').val(json.descricao);
				$('#txtdesc2').val(json.descricao2);
				
				if(json.imagem != 0){
					$('#imgSobre').attr('src', json.imagem);
					$('#txtimagem').val(json.imagem);
				}
			}
		});
	}
	
	$(document).ready(function(){
		var id = $('#frm_sobreLayout2').data('id');
		
		if(id != ""){
			exibirDados(id);
		}
		
		$('.fechar').click(function(){
			$('.container_modal').fadeOut(400);
		});
		
		$('#imagem').change(function(){
			$('#frmImagem').ajaxForm({
				target: '#visualizar_sobre'
			}).submit();
		});
		
		$('#frm_sobreLayout2').submit(function(e){
			//desabilitando função de submit
			e.preventDefault();
			
			//armazenando o formulario em uma variável
			var formulario = new FormData($('#frm_sobreLayout2')[0]);
			
			//armazenando o layout em uma variável
			var layout = $('#frm_sobreLayout2').data('layout');
			
			//atribuindo ao formulario o parâmetro layout
			formulario.append('layout', layout);
			
			//atribuindo ao formulário o parâmetro controller
			formulario.append('controller', 'sobre');
			
			if(id == ""){
				formulario.append('modo', 'inserirLayout');
			}else{
				formulario.append('modo', 'atualizarLayout');
				formulario.append('id', id);
			}
			
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'router.php', //url onde será enviada a requisição
				data: formulario, //dados que serão enviados
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					alert(dados); //mensagem de sucesso
					listar(); //listagem dos dados
					$('.container_modal').fadeOut(400);
				}
			});
		});
	});
</script>

<div class="frm_container">
	<img class="fechar" src="../imagens/fechar.png">
	<form method="POST" class="frmImagem" id="frmImagem" action="upload.php" enctype="multipart/form-data">
		<div id="visualizar_sobre">
			<label for="imagem" title="clique aqui para selecionar uma imagem">
				<img id="imgSobre" src="../imagens/picture.png">
			</label>
			<input type="file" id="imagem" name="fleimagem">
		</div>
	</form>
	
	<form method="POST" class="sobre_layout" data-id="<?php echo($id) ?>" data-layout="2" name="frmSobre" id="frm_sobreLayout2">
		<div class="form_linha">
			<label class="lbl_cadastro">
				Titulo:
			</label>
			
			<input class="cadastro_input" type="text" id="txttitulo" name="txttitulo" required>
			<input type="hidden" id="txtimagem" name="txtimagem">
		</div>
		
		<div class="form_linha">
			<label class="lbl_cadastro">
				Descrição 1:
			</label>
			
			<textarea name="txtdesc" class="cadastro_text" id="txtdesc" required></textarea>
		</div>
		
		<div class="form_linha">
			<label class="lbl_cadastro">
				Descrição 2:
			</label>
			
			<textarea name="txtdesc2" class="cadastro_text" id="txtdesc2" required></textarea>
		</div>
		
		<div class="form_linha" id="btn_linha">
			<input type="submit" class="sub_btn" value="CADASTRAR">
		</div>
	</form>
</div>