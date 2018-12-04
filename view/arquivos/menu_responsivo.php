<div class="menu_responsivo">
    <img id="menu" src="icones/menu_responsivo.png" alt="icone do menu">
    <div class="submenu_responsivo" id="submenu">
        <div class="submenu_responsivo_itens">
            <div id="categorias">
                Categorias
            </div>

            <div class="menu_responsivo_categorias" id="menu_categoria">
                <?php
                    //inclusão do arquivo da controller
                    require_once('../controller/controllerCategoria.php');
                
                    //instância da controller
                    $listCategoria = new controllerCategoria();
                
                    //armazenando os dados numa variável
                    $rsCategoria = $listCategoria->listarCategoria();
                
                    //contador
                    $cont = 0;
                
                    //percorrendo os dados
                    while($cont < count($rsCategoria)){
                ?>
                <div class="categorias_responsivo_itens categoria_item">
                    <?php echo($rsCategoria[$cont]->getNome()) ?>

                    <div class="subcategorias_responsivo subcategorias">
                    
                    <?php
                        //inclusão da controller
                        require_once('../controller/controllerCategoria.php');
                        
                        //instância da controller
                        $listSubcategoria = new controllerCategoria();
                        
                        //armazenando os dados numa variável
                        $rsSubcategoria = $listSubcategoria->listarSubcategoria($rsCategoria[$cont]->getId());
                        
                        //contador
                        $index = 0;
                        
                        //percorrendo os dados
                        while($index < count($rsSubcategoria)){    
                    ?>
                        <div class="subcategorias_responsivo_itens">
                            <a href="visualizar_subcategoria.php?idSubcategoria=<?php echo($rsSubcategoria[$index]->getId()) ?>&mobile=true">
                                <?php
                                    echo($rsSubcategoria[$index]->getNome());
                                ?>
                            </a>
                        </div>
                    <?php
                        //incrementando o contador
                        $index++;
                        }
                    ?>
                    </div>
                </div>
                
            <?php
                //incrementando o contador
                $cont++;
                }
            ?>

            </div>
        </div>

        <div class="submenu_responsivo_itens">
            <a href="fale_conosco.php">
                Fale Conosco
            </a>
        </div>

        <div class="submenu_responsivo_itens">
            <a href="nossas_lojas.php">
                Nossas Lojas
            </a>
        </div>

        <div class="submenu_responsivo_itens">
            <a href="sobre.php">
                Sobre
            </a>
        </div>
    </div>
</div>