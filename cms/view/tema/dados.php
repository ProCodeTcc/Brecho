<script>
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		})
	});
</script>

<?php
    //armazenando os dados numa variável
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';

    //inclusão da controller
	require($diretorio.'controller/controllerTema.php');

    //instância da controller
	$listTema = new controllerTema();

    //armazenando os dados numa variável
	$rsTema = $listTema->listarTema();

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
		   <img class="editar" data-modo="editar" src="../imagens/pencil.png" alt="ícone para edição">
		</span>
		
		<span onclick="excluir(<?php echo($rsTema[$cont]->getId()) ?>)">
			<img src="../imagens/delete16.png" alt="ícone para exclusão">
		</span>
		
		<span onClick="status(<?php echo($rsTema[$cont]->getStatus())?>, <?php echo($rsTema[$cont]->getId()) ?>, '<?php echo($rsTema[$cont]->getGenero()) ?>')">
			<?php
                //armazenando o status numa variável
				$status = $rsTema[$cont]->getStatus();
				
                //verificando o status
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