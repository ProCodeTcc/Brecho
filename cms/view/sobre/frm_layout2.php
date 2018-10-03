<script>
	$(document).ready(function(){
		$('.fechar').click(function(){
			$('.container_modal').fadeOut(400);
		});
		
		$('#imagem').change(function(){
			$('#frmImagem').ajaxForm({
				target: '#visualizar_sobre'
			}).submit();
		});
		
		$('#frm_sobreLayout2').submit(function(e){
			e.preventDefault();
			
			var formulario = new FormData($('#frm_sobreLayout2')[0]);
			
			formulario.append('controller', 'sobre');
			formulario.append('modo', 'inserirLayout2');
			
			$.ajax({
				type: 'POST',
				url: url+'router.php',
				data: formulario,
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					alert(dados);
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
	
	<form method="POST" class="sobre_layout" name="frmSobre" id="frm_sobreLayout2">
		<div class="form_row">
			<label class="lbl_cadastro">
				Titulo:
			</label>
			
			<input class="cadastro_input" type="text" id="txttitulo" name="txttitulo" required>
			<input type="hidden" id="txtimagem" name="txtimagem">
		</div>
		
		<div class="form_row">
			<label class="lbl_cadastro">
				Descrição 1:
			</label>
			
			<textarea name="txtdesc" id="txtdesc" required></textarea>
		</div>
		
		<div class="form_row">
			<label class="lbl_cadastro">
				Descrição 2:
			</label>
			
			<textarea name="txtdesc2" id="txtdesc2" required></textarea>
		</div>
		
		<div class="form_row">
			<input type="submit" class="page_btn" value="CADASTRAR">
		</div>
	</form>
</div>