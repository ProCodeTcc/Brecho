<script>
	var url = '../../'
	$(document).ready(function(){
		$('.fechar').click(function(){
			$('.container_modal').fadeOut(400);
		});
	});
</script>

<div class="form_container">
    <img class="fechar" src="../imagens/fechar.png">
	
	<form class="frmImagem" id="frmImagem" name="frmImagem" action="upload.php" method="post" enctype="multipart/form-data">
		<div id="visualizar">
			<label for="imagem">
				<img id="img" src="../imagens/user.png">
			</label>

			<input type="file" name="fleimagem" id="imagem">
		</div>
	</form>
	
	<form class="frm_cadastro" method="post" name="frmEvento" id="frm_evento" action="enquete_view.php">
		<div class="form_row">
			<label class="lbl_cadastro">
				Título:
			</label>
			
			<input type="text" class="cadastro_input" name="txttitulo" id="txttitulo">
			<input type="hidden" name="txtimagem">
		</div>
		
		<div class="form_row">
			<label class="lbl_cadastro">
				Descrição:
			</label>
			
			<textarea name="txtdesc" id="txtdesc"></textarea>
		</div>
		
        <div class="form_row">
            <label class="lbl_cadastro">
                Data de Início:
            </label>

            <input type="date" class="cadastro_input" name="dtinicio" id="dtinicio">
        </div>

        <div class="form_row">
            <label class="lbl_cadastro">
                Data de Término:
            </label>

            <input type="date" class="cadastro_input" name="dttermino" id="dttermino">
        </div>
		
		<div class="form_row">
			<label class="lbl_cadastro">
				Lojas:
			</label>
		</div>

        <div class="form_row">
            <input type="submit" class="page_btn" value="CADASTRAR">
        <div> 
    </form>
</div>