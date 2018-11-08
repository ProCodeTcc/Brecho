<script>
    var id = $('#frmEvento').data('id');
		
    if(id != ""){
        $('#frmEvento').attr('data-modo', 'editar');
        exibirDados(id, 'pt');
    }
</script>

<div class="frmEvento">
    <div class="form_linha">
        <div id="visualizar_evento">
            <label for="imagem">
                <img id="img" src="../imagens/image.png">
            </label>
            
            <input type="file" id="imagem" name="fleimagem">
        </div>
    </div>

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
        <label>
            Loja
        </label>
        
        <select class="cadastro_select" name="txtloja">
        
            <?php
                $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
                require_once($diretorio.'controller/controllerEvento.php');
                $listLojas = new controllerEvento();
                $rsLojas = $listLojas->listarLojas();
                $cont = 0;
                while($cont < count($rsLojas)){
            ?>
            
            <option value="<?php echo($rsLojas[$cont]->getIdLoja()) ?>">
                <?php echo($rsLojas[$cont]->getLoja()) ?>
            </option>
            
            <?php
            $cont++;
                }
            ?>
        </select>
    </div>

    <div class="form_linha container_data" id="lbl_data">
        <label class="lbl_cadastro">
            Início:
        </label>

            <label class="lbl_cadastro">
            Término:
        </label>
    </div>

    <div class="form_linha container_data" id="input_data">
        <input type="date" class="cadastro_input dtinicio" name="dtinicio" id="dtinicio" onBlur="validarData('#dtinicio')">
        
        <input type="date" class="cadastro_input dttermino" name="dttermino" id="dttermino" onBlur="validarData('#dttermino')">
    </div>

    <div class="form_linha">
        <input type="submit" class="sub_btn" value="ENVIAR">
    </div>
</div>