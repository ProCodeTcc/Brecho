<script>
	$(document).ready(function(){
		$('.fechar').click(function(){
			$('.container_modal').fadeOut(400);
		});
		
		$('#txtnumero').click(function(){
			alert('numero');
		});
		
		$('#txtmedida').click(function(){
			alert('medida');
		});
	});
</script>

<div class="form_container" id="form_container_roupa">
	<img class="fechar" src="../imagens/fechar.png">
    <form class="frm_roupa" id="frmRoupa" method="post" name="frmRoupa" enctype="multipart/form-data" name="frmImagem" action="usuario_view.php">
        <div id="roupas_col1">
			<div class="form_linha">
				<label class="lbl_cadastro">Nome: </label>
				<input type="text" class="cadastro_input" name="txtnome" id="txtnome">
			</div>
			
			<div class="form_linha">
				<label class="lbl_cadastro">Descrição: </label>
				<textarea name="txtdesc" class="cadastro_text" id="txtdesc"></textarea>
			</div>
			
			<div class="form_linha" id="tipo_tamanho_linha">
				<label class="lbl_cadastro">Tipo: </label>
				
				<div id="tipo_tamanho">
					<label for="txtmedida">Medida</label>
					<input type="radio" id="txtmedida" name="txttipo" value="medida" onClick="buscarMedidas(1)">

					<label for="txtnumero">Número</label>
					<input type="radio" id="txtnumero" name="txttipo" value="numero">
				</div>
			</div>
			
			<div class="form_linha">
				<select name="txttipo" class="cadastro_select" id="txttamanho">
					<option>tipo</option>
				</select>
			</div>
			
			<div class="form_linha">
				<label class="lbl_cadastro">Categoria: </label>
				<select name="txtcategoria" class="cadastro_select" id="txtcategoria">
					<option>categoria</option>
				</select>
			</div>
			
			<div class="form_linha">
				<label class="lbl_cadastro">Marca: </label>
				<select name="txtmarca" class="cadastro_select" id="txtmarca">
					<option>marca</option>
				</select>
			</div>
		</div>
		
		<div id="roupas_col2">
			<div class="form_linha">
				<label class="lbl_cadastro">Cor: </label>
				<select name="txtcor" class="cadastro_select" id="txtcor">
					<option>cor</option>
				</select>
			</div>
			
			<div class="form_linha">
				<label class="lbl_cadastro">Fotos: </label>
				
				<img src="#">
				<img src="#">
				<img src="#">
			</div>
			
			<div class="form_linha">
				<label class="lbl_cadastro">Valor: </label>
				<input type="text" class="cadastro_input" name="txtnome" id="txtnome">
			</div>
		</div>
    </form>
	
	<input type="submit" class="sub_btn" value="ENVIAR">
</div>