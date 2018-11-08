<script>
    var id = $('#frm_sobreLayout2').data('id');
		
    if(id != ""){
        $('.form').attr('data-modo', 'atualizarTraducao');
        exibirDados(id, 'en');
    }
</script>

<div class="sobre_layout">
    <div class="form_linha">
        <label class="lbl_cadastro">
            Titulo:
        </label>
        
        <input class="cadastro_input txttitulo" type="text" id="txttitulo" name="txttitulo" required>
        <input type="hidden" id="txtimagem" name="txtimagem">
    </div>
    
    <div class="form_linha">
        <label class="lbl_cadastro">
            Descrição 1:
        </label>
        
        <textarea name="txtdesc" class="cadastro_text txtdesc" id="txtdesc" required></textarea>
    </div>
    
    <div class="form_linha">
        <label class="lbl_cadastro">
            Descrição 2:
        </label>
        
        <textarea name="txtdesc2" class="cadastro_text txtdesc2" id="txtdesc2" required></textarea>
    </div>
    
    <div class="form_linha" id="btn_linha">
        <input type="submit" class="sub_btn" value="CADASTRAR">
    </div>
</div>