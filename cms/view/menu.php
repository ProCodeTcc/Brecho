<?php
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
?>

<script>
	//evento no click de um item do menu
	$('.menu .menu_itens').click(function(e){
		//mostrando o submenu somente do item clicado
		$(this).find('.submenu').toggle(400);

		//escondendo os submenus dos itens que não forem clicados
		$('.menu_itens').not(this).find('.submenu').hide('fast');
	});
</script>

<ul class="menu">
	<li class="menu_itens">
		<div class="menu_item_container">
			<img src="../imagens/admin.png">

			<p class="item_titulo">Administração</p>
		</div>

		<ul class="submenu">
			<li class="submenu-itens">
				<a class="paginas_link" href="../usuario/usuario_view.php">
					Usuários
				</a>
			</li>

			<li class="submenu-itens">
				<a class="paginas_link" href="../nivel/nivel_view.php">
					Níveis
				</a>
			</li>
			
			<li class="submenu-itens">
				<a class="paginas_link" href="../unidade/unidade_view.php">
					Unidades
				</a>
			</li>
			
		</ul>
	</li>

	<li class="menu_itens">
		<div class="menu_item_container">
			<img src="../imagens/content.png">

			<p class="item_titulo">Conteúdo</p>
		</div>

		<ul class="submenu">
			<li class="submenu-itens">
				<a class="paginas_link" href="../enquete/enquete_view.php">
					Enquetes
				</a>
			</li>

			<li class="submenu-itens">
				<a class="paginas_link" href="../sobre/sobre_view.php">
					Sobre nós
				</a>
			</li>

			<li class="submenu-itens">
				<a class="paginas_link" href="../evento/evento_view.php">
					Eventos
				</a>
			</li>
			
			<li class="submenu-itens">
				<a class="paginas_link" href="../fale_conosco/fale_conosco_view.php">
					Fale Conosco
				</a>
			</li>
		</ul>
	</li>

	<li class="menu_itens">
		<div class="menu_item_container">
			<img src="../imagens/cart.png">

			<p class="item_titulo">Produtos</p>
		</div>

		<ul class="submenu">
			<li class="submenu-itens">
				<a class="paginas_link" href="../avaliacao/avaliacao_view.php">
					Avaliação
				</a>
			</li>

			<li class="submenu-itens">
				<a class="paginas_link" href="../roupa/roupa_view.php">
					Roupas
				</a>
			</li>

			<li class="submenu-itens">
				<a class="paginas_link" href="../promocao/promocao_view.php">
					Promoção
				</a>
			</li>
			
			<li class="submenu-itens">
				<a class="paginas_link" href="../retirada/retirada_view.php">
					Retiradas
				</a>
			</li>
		</ul>
	</li>

	<li class="menu_itens">
		<div class="menu_item_container">
			<img src="../imagens/visual.png">

			<p class="item_titulo">Visual</p>
		</div>

		<ul class="submenu">
			<li class="submenu-itens">
				<a class="paginas_link" href="../tema/tema_view.php">
					Temas
				</a>
			</li>

			<li class="submenu-itens">
				<a class="paginas_link" href="../cor/cor_view.php">
					Cores
				</a>
			</li>
		</ul>
	</li>
</ul>