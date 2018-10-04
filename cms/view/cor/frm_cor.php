<script>
	url = '../../';
	$(document).ready(function(){
		$('#frmCor').submit(function(e){
			e.preventDefault();
			var formulario = new FormData($('#frmCor')[0]);
			formulario.append('controller', 'cor');
			formulario.append('modo', 'inserir');
			
			$.ajax({
				type: 'POST',
				url: url+'/router.php',
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
	<form class="frm_cor" id="frmCor" name="frm_cor">
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
		
		<div class="form_linha" id="btn_linha">
			<input type="submit" class="sub_btn" value="CADASTRAR">
		</div>
	</form>
</div>