<div class="botao_categoria_responsivo"> 
    <img id="filtro_menu" src="icones/categoria.png">
</div>

<div class="filtro_responsivo_container" id="filtro_responsivo">
    <div class="filtro_responsivo" id="filtro_submenu">
        <div class="filtro_itens filtro_responsivo_item">
            Classificação

            <div class="opcoes_filtro">
                <div class="opcao_item classificacao_container" onClick="filtrarClassificacao('A')">
                    A
                </div>
                
                <div class="opcao_item classificacao_container" onClick="filtrarClassificacao('B')">
                    B
                </div>
                
                <div class="opcao_item classificacao_container" onClick="filtrarClassificacao('C')">
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

                        <input class="preco_item max" type="number" name="txtmax" onblur="filtrarPreco()">
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
                            $listMedidas = new controllerProduto();
                            $rsMedidas = $listMedidas->listarMedidas();
                            $cont = 0;
                            while($cont < count($rsMedidas)){
                        ?>
                        <div class="tamanho_item" onClick="filtrarTamanho(<?php echo($rsMedidas[$cont]->getId()) ?>)">
                            <?php echo($rsMedidas[$cont]->getTamanho()) ?>
                        </div>
                        <?php
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
                            $listMedidas = new controllerProduto();
                            $rsMedidas = $listMedidas->listarNumeros();
                            $cont = 0;
                            while($cont < count($rsMedidas)){
                        ?>
                        <div class="tamanho_item numeros" onClick="filtrarTamanho(<?php echo($rsMedidas[$cont]->getId()) ?>)">
                            <?php echo($rsMedidas[$cont]->getTamanho()) ?>
                        </div>
                        <?php
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
                            $listCor =  new controllerProduto();
                            $rsCor = $listCor->listarCores();
                            $cont = 0;
                            while($cont < count($rsCor)){
                        ?>
                        <div class="cor_item" style="background-color:<?php echo($rsCor[$cont]->getCor()) ?>;" onclick="filtrarCor(<?php echo($rsCor[$cont]->getId()) ?>)"></div>
                        <?php
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
                            $listMarca = new controllerProduto();
                            $rsMarca = $listMarca->listarMarca();
                            $cont = 0;
                            while($cont < count($rsMarca)){
                        ?>
                        <div class="marca_item" onClick="filtrarMarca(<?php echo($rsMarca[$cont]->getId()) ?>)">
                            <?php echo($rsMarca[$cont]->getMarca()) ?>
                        </div>
                        <?php
                        $cont++;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>