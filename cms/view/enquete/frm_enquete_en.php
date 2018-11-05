<script>
    var id = $('#frm_enquete').data('id');
		
    if(id != ""){
        exibirDados(id, 'en');
    }
    
</script>

    <div class="frm_enquete">
        <div class="form_linha">
            <label class="lbl_cadastro">
                Pergunta:
            </label>

            <input type="text" class="cadastro_input txtpergunta" name="txtpergunta">
        </div>

        <div class="form_linha">
                <label class="lbl_cadastro">
                    Alternativa A:
                </label>

                <input type="text" class="cadastro_input alternativa_a" name="txtalta">

                <label class="lbl_cadastro">
                    Alternativa B:
                </label>

                <input type="text" class="cadastro_input alternativa_b" name="txtaltb">

                <label class="lbl_cadastro">
                    Alternativa C:
                </label>

                <input type="text" class="cadastro_input alternativa_c" name="txtaltc">

                <label class="lbl_cadastro">
                    Alternativa D:
                </label>

                <input type="text" class="cadastro_input alternativa_d" name="txtaltd">

                <input type="hidden" class="cadastro_input" name="dtinicio" value="">

                <input type="hidden" class="cadastro_input" name="dttermino" value="">

                <input type="hidden" class="cadastro_input" name="txttema" value="">
        </div>

        <div class="form_linha" id="btn_linha">
            <input type="submit" class="sub_btn" value="CADASTRAR">
        <div> 
    </div>