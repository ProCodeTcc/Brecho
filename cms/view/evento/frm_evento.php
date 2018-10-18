<script>
	var url = '../../'
	$(document).ready(function(){
		$('.fechar').click(function(){
			$('.container_modal').fadeOut(400);
		});
	});
</script>

<div class="form_container">
	<img class="fechar" src="../imagens/delete.png">
	<form method="post" id="frmUnidade" data-id="<?php echo($id) ?>" class="frmUnidade" name="frmUnidade">
		<div class="form_linha">
			<div id="visualizar">
				<label for="imagem">
					<img src="../imagens/image.png">
				</label>
				
				<input type="file" id="imagem" name="fleimagem">
			</div>
		</div>
		
		<div class="form_linha">
			<label>
				Nome:
			</label>
			
			<input type="text" class="cadastro_input" name="txtnome" id="txtnome">
		</div>
		
		<div class="form_linha">
			<label>
				Descrição:
			</label>
			
			<input type="text">
		</div>
		
		<div class="form_linha">
			<label>
				Loja
			</label>
			
			<select class="cadastro_select">
			
			</select>
		</div>
		
		<div class="form_linha" id="lbl_data">
            <label class="lbl_cadastro">
                Início:
            </label>

             <label class="lbl_cadastro">
                Término:
            </label>
        </div>

        <div class="form_linha" id="input_data">
			<input type="date" class="cadastro_input" name="dtinicio" id="dtinicio">
			
			<input type="date" class="cadastro_input" name="dttermino" id="dttermino">
        </div>
		
		<div class="form_linha">
			<input type="submit" class="sub_btn" value="ENVIAR">
		</div>
	</form>
</div>