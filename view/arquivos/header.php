<?php
	if(isset($_SESSION['usuario'])){
		$usuario = $_SESSION['usuario'];
	}else{
		$usuario = 'Entrar';
	}

    $parametro_pt = 'lang=ptbr';
    $parametro_en = 'lang=en';

    if(isset($_GET['id'])){
        $parametro_pt = 'lang=ptbr&id='.$_GET['id'];
        $parametro_en = 'lang=en&id='.$_GET['id'];
    }

    if(isset($_GET['idSubcategoria'])){
        $parametro_pt = 'lang=ptbr&idSubcategoria='.$_GET['idSubcategoria'];
        $parametro_en = 'lang=en&idSubcategoria='.$_GET['idSubcategoria'];
    }

    if(isset($_GET['idCategoria'])){
        $parametro_pt = 'lang=ptbr&idCategoria='.$_GET['idCategoria'];
        $parametro_en = 'lang=en&idCategoria='.$_GET['idCategoria'];
    }

	require_once('check_carrinho.php');
    require_once('idioma.php');
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
           <form method="POST" action="<?php $_SERVER['REQUEST_URI'] ?>?<?php echo($parametro_pt) ?>">
                <label for="ptbr">
                    <img src="icones/brazil24.png" alt="idioma em português">
                </label>

                <input type="submit" id="ptbr">
            </form>

            <form method="POST" action="<?php $_SERVER['REQUEST_URI'] ?>?<?php echo($parametro_en) ?>">
                <label for="en">
                    <img src="icones/usa24.png" alt="idioma em inglês">
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
			<?php require_once('arquivos/menu_responsivo.php') ?>
            <a href="../index.php">
                <div class="logo">
                    <img src="imagens/logoBrecho3.png" alt="logo do brechó">
                </div>
            </a>
		</div>
		<div class="menu_lado_direito">
			<div class="login_carrinho">
					<div class="login">
						<a  href="../view/login.php">
						<div class="icone_login">
							<img id="login" src="../view/icones/login.png" alt="login">
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
							<img src="../view/icones/carrinho.png" alt="ícone do carrinho">
						</div>
						<div class="texto_login">
							Carrinho   
						</div>
					</div>
				</a>
			</div>
            
            <?php require_once('arquivos/painel_usuario_responsivo.php') ?>
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