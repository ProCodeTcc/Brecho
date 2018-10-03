<script>
	var url = '../../'
	$(document).ready(function(){
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
			
			//atribuindo ao formulário o parâmetro modo
			formulario.append('modo', 'inserirLayout1');
			
			//desabilitando o submit do botão
			e.preventDefault();
			
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
	
	<form method="POST" class="sobre_layout" name="frmSobre" id="frm_sobreLayout1">
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