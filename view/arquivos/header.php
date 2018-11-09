<?php
	if(isset($_SESSION['usuario'])){
		$usuario = $_SESSION['usuario'];
	}else{
		$usuario = 'Entrar';
	}

	require_once('check_carrinho.php');
?>

<div class="menu_paginas">
	<div class="menu_paginas_site">
		<a href="../view/fale_conosco.php" class="link_paginas"> Fale Conosco </a>
		<a href="../view/nossas_lojas.php" class="link_paginas"> Nossas Lojas </a>
		<a href="../view/sobre.php" class="link_paginas"> Sobre </a>

		<div class="pesquisa_cabecalho_icone">

			<img src="../view/icones/pesquisa.png" alt="#">
		</div>

	<div class="pesquisa_cabecalho">
		<form name="search" method="POST" action="pesquisa.php">
			<input class="campo_pesquisa_cabecalho" id="pesquisa" name="txtpesquisa" type="text">
		</form>
	</div>
	</div>
</div>

<div class="menu_principal">
	<div class="menu_principal_site">
		<div class="menu_lado_esquerdo">
			<div class="menu_responsivo">
				<img src="../view/icones/menu_responsivo.png">
			</div>
			<a href="../index.php">
				<div class="logo">
					<img src="../view/imagens/logoBrecho3.png" alt="#">
				</div>
			</a>
		</div>
		<div class="menu_lado_direito">
			<div class="login_carrinho">
					<div class="login">
						<a  href="../view/login.php">
						<div class="icone_login">
							<img src="../view/icones/login.png" alt="#">
						</div>
						<div class="texto_login">
							<?php echo($usuario) ?>   
						</div>
						</a>
						<div class="sub_login">
							<a href="../view/perfil.php">
								<div class="texto_perfil">
									Perfil   
								</div>
							</a>

							<div class="texto_perfil" id="logout" data-login="<?php echo($login) ?>" onClick="logout()">
								Logout   
							</div>
						</div>
					</div>
				<a href="../view/carrinho.php">
					<div class="login">
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
		</div>
	</div>
</div>

<div class="menu_categoria">
	<div class="menu">
		<?php
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
			require_once($diretorio.'controller/controllerCategoria.php');

			$listCategoria = new controllerCategoria();
			$rsCategoria = $listCategoria->listarCategoria();

			$cont = 0;

			while($cont < count($rsCategoria)){
		?>
		<a href="../view/visualizar_categoria.php?idCategoria=<?php echo($rsCategoria[$cont]->getId())?>">
			<div class="menu_item">
				<?php echo($rsCategoria[$cont]->getNome())?>
			</div>
		</a>

		<?php
			$cont++;
			}
		?>
		<a href="../view/promocao.php">
			<div class="menu_item">
				Promoção
			</div> 
		</a>
		<a href="../view/eventos.php">
			<div class="menu_item">
				Eventos
			</div> 
		</a>
	</div>
</div>