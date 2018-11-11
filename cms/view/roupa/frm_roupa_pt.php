<script>
    $(function(){
        var id = $('#frmRoupa').data('id');
        
		if(id != ""){
            buscarProduto(id, 'pt');
            $('#frmRoupa').attr('data-modo', 'editar');
		}

        listarCategoria();
		listarMarca();
        listarCor();

        $('#txtnumero').click(function(){
			//exibindo os tamanhos
			buscarNumero(2);
		});
		
		$('#txtmedida').click(function(){
			//exibindo os tamanhos
			buscarMedida(1);
		});
    });
</script>

<div class="form_container" id="form_container_roupa">
    <div class="form_linha">
        <div class="imagens_container">
            <label for="imagem">
                <img id="prev_imagem" src="../imagens/image.png">
            </label>

            <input type="file" name="fleimagem[]" id="imagem" onChange="mostrarPrevia(this, '#prev_imagem')">

            <label for="imagem2">
                <img id="prev_imagem2" src="../imagens/image.png">
            </label>

            <input type="file" name="fleimagem[]" id="imagem2" onChange="mostrarPrevia(this, '#prev_imagem2')">

            <label for="imagem3">
                <img id="prev_imagem3" src="../imagens/image.png">
            </label>

            <input type="file" name="fleimagem[]" id="imagem3" onChange="mostrarPrevia(this, '#prev_imagem3')">
        </div>
    </div>

    <div id="roupas_form">
        <div id="roupas_col1">
            <div class="form_linha">
                <label class="lbl_cadastro">Nome: </label>
                <input type="text" class="cadastro_input txtnome" name="txtnome" id="txtnome">
            </div>

            <div class="form_linha">
                <label class="lbl_cadastro">Descrição: </label>
                <textarea name="txtdescricao" class="cadastro_text txtdesc" id="txtdesc"></textarea>
            </div>

            <div class="form_linha" id="radio_linha">
                <label class="lbl_cadastro">Tipo: </label>

                <div class="radio">
                    <label for="txtmedida">Medida</label>
                    <input type="radio" id="txtmedida" name="txttipo" value="medida" onClick="buscarMedida">

                    <label for="txtnumero">Número</label>
                    <input type="radio" id="txtnumero" name="txttipo" value="numero" onClick="buscarNumero">
                </div>
            </div>

            <div class="form_linha">
                <select name="txttamanho" class="cadastro_select" id="txttamanho">
                    <option></option>
                </select>
            </div>

            <div class="form_linha">
                <label class="lbl_cadastro">Categoria: </label>
                <select name="txtcategoria" class="cadastro_select" id="txtcategoria" onchange="selecionarSubcategoria()">

                </select>
            </div>
        </div>

        <div id="roupas_col2">
            <div class="form_linha">
                <label class="lbl_cadastro">Marca: </label>
                <select name="txtmarca" class="cadastro_select" id="txtmarca">
                </select>
            </div>

            <div class="form_linha">
                <label class="lbl_cadastro">Cor: </label>
                <select name="txtcor" class="cadastro_select" id="txtcor">
            
                </select>
            </div>

            <div class="form_linha">
                <label class="lbl_cadastro">Classificação: </label>
                <select name="txtclassificacao" class="cadastro_select" id="txtclassificacao">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="B">C</option>
                </select>
            </div>

            <div class="form_linha">
                <label class="lbl_cadastro">Valor: </label>
                <input type="number" class="cadastro_input" name="txtpreco" id="txtpreco">
            </div>

            <div class="form_linha" id="subcategoria">
                <label class="lbl_cadastro">Subcategoria: </label>
                <select name="txtsubcategoria" class="cadastro_select" id="txtsubcategoria">
                    <option>teste</option>
                </select>
            </div>
        </div>
    </div>

    <div style="margin-top: 15px;">
        <input type="submit" class="sub_btn" value="ENVIAR">
    </div>
</div>