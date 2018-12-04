<div class="botao_categoria_responsivo"> 
    <img id="filtro_menu" src="icones/categoria.png">
</div>

<div class="filtro_responsivo_container" id="filtro_responsivo">
    <div class="filtro_responsivo" id="filtro_submenu">
        <div class="close-subcategoria">x</div>
        <div class="filtro_itens filtro_responsivo_item">
            Classificação

            <div class="opcoes_filtro">
                <div class="opcao_item classificacao_container" onClick="filtrarClassificacao('A', <?php echo($id) ?>)">
                    A
                </div>
                
                <div class="opcao_item classificacao_container" onClick="filtrarClassificacao('B', <?php echo($id) ?>)">
                    B
                </div>
                
                <div class="opcao_item classificacao_container" onClick="filtrarClassificacao('C', <?php echo($id) ?>)">
                    C
                </div>
            </div>
        </div>

        <div class="filtro_itens filtro_responsivo_item">
            Preço

            <div class="opcoes_filtro">
                <div class="opcao_item">
                    <div class="preco_container" id="preco">
                        <input class="preco_item min" type="number" name="txtmin">

                        <input class="preco_item max" type="number" name="txtmax" onblur="filtrarPreco(<?php echo($id) ?>)">
                    </div>
                </div>
            </div>
        </div>

        <div class="filtro_itens filtro_responsivo_item">
            Medidas

            <div class="opcoes_filtro">
                <div class="opcao_item">
                    <div class="tamanho_container">
                        <?php
                            //instâcia da controller
                            $listMedidas = new controllerProduto();
                            
                            //armazenando as medidas numa variável
                            $rsMedidas = $listMedidas->listarMedidas();
                     
                            //contador
                            $cont = 0;
                     
                            //percorrendo os dados
                            while($cont < count($rsMedidas)){
                        ?>
                        <div class="tamanho_item" onClick="filtrarTamanho(<?php echo($rsMedidas[$cont]->getId()) ?>, <?php echo($id) ?>)">
                            <?php echo($rsMedidas[$cont]->getTamanho()) ?>
                        </div>
                        <?php
                            //contador
                            $cont++;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="filtro_itens filtro_responsivo_item">
            Números
            <div class="opcoes_filtro">
                <div class="opcao_item">
                    <div class="tamanho_container">
                        <?php
                            //instância da controller
                            $listMedidas = new controllerProduto();
                        
                            //armazenando os números numa variável
                            $rsMedidas = $listMedidas->listarNumeros();
                        
                            //contador
                            $cont = 0;
                        
                            //percorrendo os dados
                            while($cont < count($rsMedidas)){
                        ?>
                        <div class="tamanho_item numeros" onClick="filtrarTamanho(<?php echo($rsMedidas[$cont]->getId()) ?>, <?php echo($id) ?>)">
                            <?php echo($rsMedidas[$cont]->getTamanho()) ?>
                        </div>
                        <?php
                            //contador
                            $cont++;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="filtro_itens filtro_responsivo_item">
            Cores

            <div class="opcoes_filtro">
                <div class="opcao_item">
                    <div class="cor_container">
                        <?php
                            //instância da controller
                            $listCor =  new controllerProduto();
                        
                            //armazenando as cores numa variável
                            $rsCor = $listCor->listarCores();
                        
                            //contador
                            $cont = 0;
                        
                            //percorrendo os dados
                            while($cont < count($rsCor)){
                        ?>
                        <div class="cor_item" style="background-color:<?php echo($rsCor[$cont]->getCor()) ?>;" onclick="filtrarCor(<?php echo($rsCor[$cont]->getId()) ?>, <?php echo($id) ?>)"></div>
                        <?php
                            //incrementando o contador
                            $cont++;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="filtro_itens filtro_responsivo_item">
            Marcas

            <div class="opcoes_filtro">
                <div class="marca_container">
                    <div class="opcao_item">
                        <?php
                            //instância da controller
                            $listMarca = new controllerProduto();
                        
                            //armazenando as marcas numa variável
                            $rsMarca = $listMarca->listarMarca();
                        
                            //contador
                            $cont = 0;
                        
                            //percorrendo os dados
                            while($cont < count($rsMarca)){
                        ?>
                        <div class="marca_item" onClick="filtrarMarca(<?php echo($rsMarca[$cont]->getId()) ?>, <?php echo($id) ?>)">
                            <?php echo($rsMarca[$cont]->getMarca()) ?>
                        </div>
                        <?php
                        //incrementando o contador
                        $cont++;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>