<?php
	if(isset($_SESSION['usuario'])){
		$usuario = $_SESSION['usuario'];
	}else{
		$usuario = 'Entrar';
	}

	require_once('check_carrinho.php');
?>
<script>
    $(function(){
        if($(window).width() == '980'){
            submenuMobile();
            painelUsuario();
        }
    });
</script>
<div class="menu_paginas">
	<div class="menu_paginas_site">
		<a href="../view/fale_conosco.php" class="link_paginas"> Fale Conosco </a>
		<a href="../view/nossas_lojas.php" class="link_paginas"> Nossas Lojas </a>
		<a href="../view/sobre.php" class="link_paginas"> Sobre </a>

        <div class="idioma_container">
           <form method="POST" action="<?php $_SERVER['REQUEST_URI'] ?>?lang=ptbr">
                <label for="ptbr">
                    <img src="icones/brazil24.png">
                </label>

                <input type="submit" id="ptbr">
            </form>

            <form method="POST" action="<?php $_SERVER['REQUEST_URI'] ?>?lang=en">
                <label for="en">
                    <img src="icones/usa24.png">
                </label>

                <input type="submit" id="en">
            </form>
        </div>
        
		<div id="pesquisa">
			<div class="pesquisa_cabecalho">
				<form name="search" method="POST" action="pesquisa.php">
					<input class="campo_pesquisa_cabecalho" name="txtpesquisa" type="text">
				</form>
                
                <div class="pesquisa_cabecalho_icone">
                    <img src="../view/icones/pesquisa.png" alt="#">
			    </div>
			</div>
		</div>
	</div>
</div>

<div class="menu_principal">
	<div class="menu_principal_site">
		<div class="menu_lado_esquerdo">
			<div class="menu_responsivo">
            <img id="menu" src="icones/menu_responsivo.png">
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

                            <div class="subcategorias_responsivo" id="subcategorias">

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
            <a href="../index.php">
                <div class="logo">
                    <img src="imagens/logoBrecho3.png" alt="#">
                </div>
            </a>
		</div>
		<div class="menu_lado_direito">
			<div class="login_carrinho">
					<div class="login">
						<a  href="../view/login.php">
						<div class="icone_login">
							<img id="login" src="../view/icones/login.png" alt="#">
						</div>
						<div class="texto_login">
							<?php echo($usuario) ?>   
						</div>
						</a>
						<div class="sub_login">
							<a href="../view/perfil.php">
								<div class="texto_perfil perfil_usuario">
									Perfil   
								</div>
							</a>

							<div class="texto_perfil logout" data-login="<?php echo($login) ?>" onClick="logout()">
								Logout   
							</div>
						</div>
					</div>
				<a href="../view/carrinho.php">
					<div class="login carrinho">
						<div class="bolinha" id="carrinho"><?php echo($qtdItems) ?></div>
						<div class="icone_login">
							<img src="../view/icones/carrinho.png" alt="#">
						</div>
						<div class="texto_login">
							Carrinho   
						</div>
					</div>
				</a>
			</div>
            
            <div class="menu_usuario_responsivo" id="painel_usuario">
                <div class="idiomas">
                    <form method="POST" action="../index.php?lang=ptbr">
                        <label for="ptbr">
                            <img src="icones/ptbr.png">
                        </label>

                        <input type="submit" id="ptbr">
                    </form>

                    <form method="POST" action="../index.php?lang=en">
                        <label for="en">
                            <img src="icones/usa.png">
                        </label>

                        <input type="submit" id="en">
                    </form>
                </div>

                <div class="menu_usuario_itens entrar">
                    <a href="login.php">
                        Entrar
                    </a>
                </div>

                <div class="menu_usuario_itens perfil_usuario">
                    <a href="perfil.php">
                        Perfil
                    </a>
                </div>

                <div class="menu_usuario_itens logout">
                    <a href="login.php" data-login="<?php echo($login) ?>" onClick="logout()">
                        Logout
                    </a>
                </div> 
            </div>
		</div>
	</div>
</div>

<div class="menu_categoria">
    <div class="menu">
        <?php
            require_once('../controller/controllerCategoria.php');

            $listCategoria = new controllerCategoria();
            $rsCategoria = $listCategoria->listarCategoria();

            $cont = 0;

            while($cont < count($rsCategoria)){
        ?>

        <div class="menu_item">
            <a href="visualizar_categoria.php?idCategoria=<?php echo($rsCategoria[$cont]->getId())?>">
                <?php echo($rsCategoria[$cont]->getNome())?>
            </a>

            <div class="subcategoria_container">
                <?php
                    $listSubcategoria = new controllerCategoria();
                    $rsSubcategoria = $listSubcategoria->listarSubcategoria($rsCategoria[$cont]->getId());
                    $index = 0;
                    while($index < count($rsSubcategoria)){
                ?>
                <div class="subcategoria_item">
                    <a href="visualizar_subcategoria.php?idSubcategoria=<?php echo($rsSubcategoria[$index]->getId()) ?>">
                        <?php echo($rsSubcategoria[$index]->getNome()) ?>
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
        <a href="promocao.php">
            <div class="menu_item">
                Promoção
            </div> 
        </a>
        <a href="eventos.php">
            <div class="menu_item">
                Eventos
            </div> 
        </a>
    </div>
</div>