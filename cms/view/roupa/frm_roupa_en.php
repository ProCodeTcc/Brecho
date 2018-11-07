<script>
    $(function(){
        var id = $('#frmRoupa').data('id');
		
		if(id != ""){
			buscarProduto(id, 'pt');
		}
    });
</script>

<div class="form_container" id="form_container_roupa">
    <div class="form_linha">
        <label class="lbl_cadastro">Nome: </label>
        <input type="text" class="cadastro_input" name="txtnome" id="txtnome">
    </div>

    <div class="form_linha">
        <label class="lbl_cadastro">Descrição: </label>
        <textarea name="txtdescricao" class="cadastro_text" id="txtdesc"></textarea>
    </div>

    <div style="margin-top: 15px;">
        <input type="submit" class="sub_btn" value="ENVIAR">
    </div>
</div>