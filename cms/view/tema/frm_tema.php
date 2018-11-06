<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
	var url = '../../';
	
	function exibirDados(id){
		$.ajax({
			type: 'POST',
			url: url+'router.php',
			data: {id:id, controller: 'tema', modo: 'buscar'},
			success: function(dados){
				json = JSON.parse(dados);
				
				$('#txtnome').val(json.nomeTema);
				$('#txtcor').val(json.corTema);
			}
		});
	}
	
	$(document).ready(function(){
		mudarModal('350','400');
		var id = $('#frmTema').data('id');
		
		if(id != ""){
			exibirDados(id);
		}
		
		$('#frmTema').submit(function(e){
			e.preventDefault();
			
			var formulario = new FormData($('#frmTema')[0]);
			formulario.append('controller', 'tema');
			
			if(id == ""){
				formulario.append('modo', 'inserir');
			}else{
				formulario.append('modo', 'editar');
				formulario.append('id', id);
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
					listar();
					alert(dados);
					$('.container_modal').fadeOut(400);
				}
			});
		});
	});
</script>

<img class="fechar" src="../imagens/delete.png" onclick="fecharModal()">
<div class="form_container">
	<form class="frm_tema" data-id="<?php echo($id) ?>" id="frmTema" name="frm_tema">
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