<script>
    //abrir a modal quando for clicado no ícone de editar
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		});
	});

    
</script>

<?php
    if(isset($_POST['pesquisa'])){
        $pesquisa = $_POST['pesquisa'];
    }

    $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
    require_once($diretorio.'/controller/controllerUsuario.php');
    $listUsuarios = new controllerUsuario();
    $rsUsuarios = $listUsuarios->pesquisarUsuario($pesquisa);
    $cont = 0;

    while($cont < count($rsUsuarios)){
?>

    <div class="users_view_list">
        <div class="users_view_itens"><?php echo($rsUsuarios[$cont]->getId()) ?></div>
        <div class="users_view_itens"><?php echo($rsUsuarios[$cont]->getUsuario()) ?></div>
        <div class="users_view_itens"><?php echo($rsUsuarios[$cont]->getNomeNivel()) ?></div>
        <div class="users_view_itens">
            <span onclick="excluir(<?php echo($rsUsuarios[$cont]->getId()) ?>)">
                <img src="../imagens/delete16.png">
            </span>

            <span data-id="<?php echo($rsUsuarios[$cont]->getId()) ?>" onclick="buscar(<?php echo($rsUsuarios[$cont]->getId()) ?>)">
               <img class="editar" data-modo="editar" src="../imagens/pencil.png">
            </span>

            <span onclick="status(<?php echo($rsUsuarios[$cont]->getId())?>, <?php echo($rsUsuarios[$cont]->getStatus())?>)">
                <?php
                    // verifica qual o status atual e atribui o caminho do ícone á variável img
                    $status = $rsUsuarios[$cont]->getStatus();
                    if($status == 1){
                        $img = 'ativar.png';
                    }else{
                        $img ='desativar.png';
                    }
                ?>
                <img src="../imagens/<?php echo($img) ?>">
            </span>
        </div>
    </div>
    <?php 
    $cont++;
    } ?>

    <div class="voltar" onclick="voltar()">
        <img src="../imagens/back.png">
    </div>