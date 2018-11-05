<script>
    var id = $('#frm_sobreLayout1').data('id');
		
    if(id != ""){
        exibirDados(id, 'pt');
    }
</script>

<div class="sobre_layout">
    <div id="visualizar_sobre">
        <label for="imagem" title="clique aqui para selecionar uma imagem">
            <img id="imgSobre" src="../imagens/picture.png">
        </label>
        <input type="file" id="imagem" name="fleimagem">
    </div>

    <div class="form_linha">
        <label class="lbl_cadastro">
            Titulo:
        </label>
        
        <input class="cadastro_input txttitulo" type="text" id="txttitulo" name="txttitulo" required>
        <input type="hidden" id="txtimagem" name="txtimagem">
    </div>

    <div class="form_linha">
        <label class="lbl_cadastro">
            Descrição:
        </label>
        
        <textarea name="txtdesc" class="cadastro_text txtdesc" id="txtdesc" required></textarea>
    </div>

    <div class="form_linha" id="btn_linha">
        <input type="submit" class="sub_btn" value="CADASTRAR">
    </div>
</div>