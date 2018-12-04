<script>
    //armazenando o ID da enquete
    var id = $('#frm_enquete').data('id');
    
    //verificando o ID da enquete
    if(id != ""){
        //alterando o modo para edição
        $('#frm_enquete').attr('data-modo', 'editar');
        
        //exibindo os dados no form
        exibirDados(id, 'pt');
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
                Tema:
            </label>

            <select class='cadastro_select txttema' name="txttema">

                <?php
                    //armazenando o diretório numa variável
                    $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
                
                    //inclusão da controller
                    require_once($diretorio.'/controller/controllerEnquete.php');
                
                    //instância da controller
                    $listTemas = new controllerEnquete();
                
                    //armazenando os temas numa variável
                    $rsTemas = $listTemas->listarTemas();
                    
                    //contador
                    $cont = 0;
                
                    //percorrendo os temas
                    while($cont < count($rsTemas)){
                ?>
            
                <option value="<?php echo($rsTemas[$cont]->getIdTema())?>">
                    <?php echo($rsTemas[$cont]->getTema())?>
                </option>

                <?php
                    //incrementando o contador
                    $cont++;
                    }
                ?>

            </select>
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
			<input type="date" class="cadastro_input dtinicio" name="dtinicio" onBlur="validarData('.dtinicio')">
			
			<input type="date" class="cadastro_input dttermino" name="dttermino" onBlur="validarData('.dttermino')">
        </div>

        <div class="form_linha" id="btn_linha">
            <input type="submit" class="sub_btn" value="CADASTRAR">
        <div> 
</div>