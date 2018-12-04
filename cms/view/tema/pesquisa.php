<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		})
	});
</script>

<?php
    //verificando se existe algo para pesquisar
    if(isset($_POST['pesquisa'])){
        //resgatando o termo
        $pesquisa = $_POST['pesquisa'];
    }

    //armazenando o diretório numa variável
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';

    //inclusão da controller
	require($diretorio.'controller/controllerTema.php');

    //instância da controller
	$listTema = new controllerTema();

    //armazenando os dados numa variável
	$rsTema = $listTema->pesquisarTema($pesquisa);

    //contador
	$cont = 0;
	
    //percorrendo os dados
	while($cont < count($rsTema)){
?>

<div class="users_view_list">
	<div class="users_view_itens"><?php echo($rsTema[$cont]->getId()) ?></div>
	<div class="users_view_itens"><?php echo($rsTema[$cont]->getNome()) ?></div>
	<div class="users_view_itens"><?php echo($rsTema[$cont]->getGenero())?></div>
	<div class="users_view_itens">
		<span data-id="<?php ?>" onclick="buscar(<?php echo($rsTema[$cont]->getId()) ?>);">
		   <img class="editar" data-modo="editar" src="../imagens/pencil.png">
		</span>
		
		<span onclick="excluir(<?php echo($rsTema[$cont]->getId()) ?>)">
			<img src="../imagens/delete16.png">
		</span>
		
		<span onClick="status(<?php echo($rsTema[$cont]->getStatus())?>, <?php echo($rsTema[$cont]->getId()) ?>, '<?php echo($rsTema[$cont]->getGenero()) ?>')">
			<?php
                //armazenando o status
				$status = $rsTema[$cont]->getStatus();
				
                //verificando o satus
				if($status == 1){
					echo('<img src="../imagens/ativar.png">');
				}else{
					echo('<img src="../imagens/desativar.png">');
				}
			?>
		</span>
	</div>
</div>

<?php
    //incrementando o contador
	$cont++;
	}
?>