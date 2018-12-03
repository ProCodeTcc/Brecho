<div class="menu_responsivo">
    <img id="menu" src="icones/menu_responsivo.png" alt="icone do menu">
    <div class="submenu_responsivo" id="submenu">
        <div class="submenu_responsivo_itens">
            <div id="categorias">
                Categorias
            </div>

            <div class="menu_responsivo_categorias" id="menu_categoria">
                <?php
                    require_once('../controller/controllerCategoria.php');
                    $listCategoria = new controllerCategoria();
                    $rsCategoria = $listCategoria->listarCategoria();
                    $cont = 0;
                    while($cont < count($rsCategoria)){
                ?>
                <div class="categorias_responsivo_itens categoria_item">
                    <?php echo($rsCategoria[$cont]->getNome()) ?>

                    <div class="subcategorias_responsivo subcategorias">
                    
                    <?php
                        require_once('../controller/controllerCategoria.php');
                        $listSubcategoria = new controllerCategoria();
                        $rsSubcategoria = $listSubcategoria->listarSubcategoria($rsCategoria[$cont]->getId());
                        $index = 0;
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
                        $index++;
                        }
                    ?>
                    </div>
                </div>
                
            <?php
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