
<script>
	var url = '../../';
	$(document).ready(function(){
		$('#frmTema').submit(function(e){
			e.preventDefault();
			
			var formulario = new FormData($('#frmTema')[0]);
			formulario.append('modo', 'inserir');
			formulario.append('controller', 'tema');
			
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

<div class="form_container">
	<form class="frm_tema" id="frmTema" name="frm_tema">
		<div class="form_linha">
			<label class="lbl_cadastro">
				Nome:
			</label>
			
			<input type="text" class="cadastro_input" name="txtnome" id="txtnome">
		</div>
		
		<div class="form_linha">
			<label class="lbl_cadastro" id="lbl_cor">
				Cor:
			</label>
			
			<input type="color" name="txtcor" class="cadastro_cor" id="txtcor">
		</div>
		
		<div class="form_linha">
			<label class="lbl_cadastro">
				Gênero
			</label>
			
			<div class="radio_buttons">
				<label for="masculino">Masculino</label>
				<input type="radio" name="txtgenero" id="masculino" value="M">
				
				<label for="feminino">Feminino</label>
				<input type="radio" name="txtgenero" id="feminino" value="F">
			</div>
			
		</div>
		
		<div class="form_linha" id="btn_linha">
			<input type="submit" class="sub_btn" value="CADASTRAR">
		</div>
	</form>
</div>