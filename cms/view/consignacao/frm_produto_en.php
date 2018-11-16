<script>
    //função para verificar se o produto tem tradução
    function verificarTraducao(id){
        $.ajax({
           type: 'POST', //tipo de requisição
            url: '../../router.php', //url onde será enviada a requisição
            data: {id:id, controller: 'produto', modo: 'verificar'}, //dados enviados
            success: function(dados){
                //conversão dos dados para JSON
                json = JSON.parse(dados);
                
                //verificando o status
                if(json.status == 'inserir'){
                    //atualiza o modo
                    $('#frmRoupa').attr('data-modo', 'inserir');
                    
                    //atualiza o idioma
                    $('#frmRoupa').attr('data-lang', 'en');
                }else if(json.status == 'atualizar'){
                    //atualiza o modo
                    $('#frmRoupa').attr('data-modo', 'atualizarTraducao');
        			buscarProduto(id, 'en');
                }
            }
        });
    }
    
    $(function(){
        var id = $('#frmRoupa').data('id');
		if(id != ""){
            verificarTraducao(id);
		}
    });
</script>

<div class="form_container" id="form_container_roupa">
    <div class="form_linha">
        <label class="lbl_cadastro">Nome: </label>
        <input type="text" class="cadastro_input txtnome" name="txtnome" id="txtnome">
    </div>

    <div class="form_linha">
        <label class="lbl_cadastro">Descrição: </label>
        <textarea name="txtdescricao" class="cadastro_text txtdesc" id="txtdesc"></textarea>
    </div>

    <div style="margin-top: 15px;">
        <input type="submit" class="sub_btn" value="ENVIAR">
    </div>
</div>