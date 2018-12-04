<script>
    //armazenando o ID numa variável
    var id = $('#frmEvento').data('id');
    
    //verificando se existe o ID
    if(id != ""){
        //muda o modo para atualização
        $('#frmEvento').attr('data-modo', 'atualizarTraducao');
        
        //exibe os dados no form
        exibirDados(id, 'en');
    }
</script>

<div class="frmEvento">
    <div class="form_linha">
        <label>
            Nome:
        </label>
        
        <input type="text" class="cadastro_input txtnome" name="txtnome" id="txtnome">
    </div>

    <div class="form_linha">
        <label>
            Descrição:
        </label>
        
        <textarea class="cadastro_text txtdesc" name="txtdesc" id="txtdesc"></textarea>
    </div>

    <div class="form_linha">
        <input type="submit" class="sub_btn" value="ENVIAR">
    </div>
</div>