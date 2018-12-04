﻿<script>
    //abrir a modal quando for clicado no ícone de editar
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);
		});
	});


</script>

<?php
    //armazenando o diretório numa variável
    $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';

    //inclusão da controller
    require_once($diretorio.'/controller/controllerUsuario.php');

    //instância da controller
    $listUsuarios = new controllerUsuario();

    //armazenando os dados numa variável
    $rsUsuarios = $listUsuarios->listarUsuarios();

    //contador
    $cont = 0;

    //percorrendo os dados
    while($cont < count($rsUsuarios)){
?>

    <div class="users_view_list">
        <div class="users_view_itens"><?php echo($rsUsuarios[$cont]->getId()) ?></div>
        <div class="users_view_itens"><?php echo($rsUsuarios[$cont]->getUsuario()) ?></div>
        <div class="users_view_itens"><?php echo($rsUsuarios[$cont]->getNomeNivel()) ?></div>
        <div class="users_view_itens">
            <span onclick="excluir(<?php echo($rsUsuarios[$cont]->getId()) ?>)">
                <img src="../imagens/delete16.png" alt="ícone pra excluir">
            </span>

            <span data-id="<?php echo($rsUsuarios[$cont]->getId()) ?>" onclick="buscar(<?php echo($rsUsuarios[$cont]->getId()) ?>)">
               <img class="editar" data-modo="editar" src="../imagens/pencil.png" alt="ícone pra editar">
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
                <img src="../imagens/<?php echo($img) ?>" alt="ícone pra alterar o status">
            </span>
        </div>
    </div>
    <?php
    //incrementando o contador
    $cont++;
    } ?>
