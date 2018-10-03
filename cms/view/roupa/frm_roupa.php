<script>
	$(document).ready(function(){
		$('.fechar').click(function(){
			$('.container_modal').fadeOut(400);
		});
	});
</script>

<div class="form_container" id="form_container_roupa">
	<img class="fechar" src="../imagens/fechar.png">
    <form class="frm_roupa" id="frmRoupa" method="post" name="frmRoupa" enctype="multipart/form-data" name="frmImagem" action="usuario_view.php">
        <div id="roupas_col1">
			<div class="form_linha">
				<label>Nome: </label>
				<input type="text" name="txtnome" id="txtnome">
			</div>
			
			<div class="form_linha">
				<label>Descrição: </label>
				<textarea name="txtdesc" id="txtdesc"></textarea>
			</div>
			
			<div class="form_linha">
				<label>Tipo: </label>
				<select name="txttipo" id="txttipo">
					<option>tipo</option>
				</select>
			</div>
			
			<div class="form_linha">
				<label>Categoria: </label>
				<select name="txtcategoria" id="txtcategoria">
					<option>categoria</option>
				</select>
			</div>
			
			<div class="form_linha">
				<label>Marca: </label>
				<select name="txtmarca" id="txtmarca">
					<option>marca</option>
				</select>
			</div>
		</div>
		
		<div id="roupas_col2">
			<div class="form_linha">
				<label>Cor: </label>
				<select name="txtcor" id="txtcor">
					<option>cor</option>
				</select>
			</div>
			
			<div class="form_linha">
				<label>Fotos: </label>
				
				<img src="#">
				<img src="#">
				<img src="#">
			</div>
			
			<div class="form_linha">
				<label>Valor: </label>
				<input type="text" name="txtnome" id="txtnome">
			</div>
		</div>
    </form>
	
	<input type="submit" class="page_btn" value="ENVIAR">
</div>