<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
	var url = '../../'
	
	//função para exibir os dados
	function exibirDados(id){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'/router.php', //url onde será enviada a requisição
			data:{id:id, modo: 'buscarLayout1', controller: 'sobre'}, //parâmetros enviados
			success: function(dados){
				json = JSON.parse(dados); //convertendo os dados para json
				
				//colocando os valores nas caixas de texto
				$('#txttitulo').val(json.titulo); 
				$('#txtdesc').val(json.descricao);
				
				//checando se a imagem está vazia, se não, preencher a div de visualizar
				//e atribuir o valor ao txtimagem
				
				if(json.imagem != 0){
					$('#imgSobre').attr('src', json.imagem);
					$('#txtimagem').val(json.imagem);
				}
			}
		})
	}
	
	$(document).ready(function(){
		var id = $('#frm_sobreLayout1').data('id');
		
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
		
		$('#frm_sobreLayout1').submit(function(e){
			//armazenando o formulario em uma variável
			var formulario =  new FormData($('#frm_sobreLayout1')[0]);
			
			//atribuindo ao formulário o parâmetro controller
			formulario.append('controller', 'sobre');
			
			//desabilitando o submit do botão
			e.preventDefault();
			
			if(id == ""){
				//atribuindo ao formulário o parâmetro modo, contendo a ação de inserir
				formulario.append('modo', 'inserirLayout1');
			}else{
				//atribuindo ao formulário o parâmetro modo, contendo a ação de editar
				formulario.append('modo', 'atualizarLayout1');
				formulario.append('id', id);
			}
			
			//chamando o ajax
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'/router.php', //url onde será enviada a requisição
				data: formulario, //dados enviados
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					alert(dados); //mensagem de sucesso
					listar();
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
	
	<form method="POST" data-id="<?php echo($id) ?>" data-layout="1" class="sobre_layout" name="frmSobre" id="frm_sobreLayout1">
		<div class="form_row">
			<label class="lbl_cadastro">
				Titulo:
			</label>
			
			<input class="cadastro_input" type="text" id="txttitulo" name="txttitulo" required>
			<input type="hidden" id="txtimagem" name="txtimagem">
		</div>
		
		<div class="form_row">
			<label class="lbl_cadastro">
				Descrição:
			</label>
			
			<textarea name="txtdesc" id="txtdesc" required></textarea>
		</div>
		
		<div class="form_row">
			<input type="submit" class="page_btn" value="CADASTRAR">
		</div>
	</form>
</div>