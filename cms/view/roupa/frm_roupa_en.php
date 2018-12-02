<script>
    $(function(){
        var id = $('#frmRoupa').data('id');
        mudarModal('420','600');
        
		if(id != ""){
            $('#frmRoupa').attr('data-modo', 'atualizarTraducao');
			buscarProduto(id, 'en');
		}
    });
</script>

<div class="frm_ingles" id="form_container_roupa">
    <div class="form_linha">
        <label class="lbl_cadastro">Nome: </label>
        <input type="text" class="cadastro_input txtnome" name="txtnome" id="txtnome" required>
    </div>

    <div class="form_linha">
        <label class="lbl_cadastro">Descrição: </label>
        <textarea name="txtdescricao" class="cadastro_text txtdesc" id="txtdesc" required></textarea>
    </div>

    <div style="margin-top: 15px;">
        <input type="submit" class="sub_btn" value="ENVIAR">
    </div>
</div>