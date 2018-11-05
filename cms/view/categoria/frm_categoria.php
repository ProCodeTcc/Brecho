<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
	var url = '../../';
	
	$(document).ready(function(){
		var id = $('#frmCategoria').data('id');
		
		if(id != ""){
			exibirDados(id);
		}
		
		$('#frmCategoria').submit(function(e){
			e.preventDefault();
			
			var formulario = new FormData($('#frmCategoria')[0]);
			formulario.set('controller', 'categoria');
			
			if(id == ""){
				formulario.set('modo', 'inserir');
			}else{
				formulario.set('modo', 'editar');
				formulario.set('id', id);
			}
			
			$.ajax({
				type: 'POST',
				url: url+'router.php',
				data: formulario,
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					json = JSON.parse(dados);

					if(json.status == 'sucesso'){
						mostrarSucesso('Categoria inserida com sucesso!!');
					}else{
						mostrarErro('Ocorreu um erro ao inserir a categoria!!');
					}
				}
			});
		});
	});
</script>

<div class="form_container">
	<form class="frm_categoria" data-id="<?php echo($id) ?>" id="frmCategoria" name="frm_categoria">
		<div class="form_linha">
			<label class="lbl_cadastro">
				Nome:
			</label>
			
			<input type="text" class="cadastro_input" name="txtnome" id="txtnome">
		</div>
		
		<div class="form_linha">
			<label class="lbl_cadastro">
				Gênero
			</label>
			
			<div class="radio">
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