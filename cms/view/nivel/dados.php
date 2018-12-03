<script>
    $(document).ready(function(){
        //abrir a modal quando for clicado no ícone de editar
        $('.editar').click(function(){
            $('.container_modal').fadeIn(400);
        });
    });

    
</script>

<?php
    $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
    require_once($diretorio.'/controller/controllerNivel.php');
    $listNiveis = new controllerNivel();
    $rsNiveis = $listNiveis->listarNiveis();
    $cont = 0;

    while($cont < count($rsNiveis)){
?>

    <div class="users_view_list">
        <div class="users_view_itens"><?php echo($rsNiveis[$cont]->getId()) ?></div>
        <div class="users_view_itens"><?php echo($rsNiveis[$cont]->getNome()) ?></div>
        <div class="users_view_itens">
			<span onClick="permissao(<?php echo($rsNiveis[$cont]->getId()) ?>)">
				<img src="../imagens/permissao.png" alt="ícone pra ir á tela de permissões">
			</span>
            
			<span onclick="excluir(<?php echo($rsNiveis[$cont]->getId()) ?>)">
                <img src="../imagens/delete16.png" alt="ícone pra exclusão">
            </span>

            <span data-id="<?php echo($rsNiveis[$cont]->getId()) ?>" onclick="buscar(<?php echo($rsNiveis[$cont]->getId()) ?>);">
               <img class="editar" data-modo="editar" src="../imagens/pencil.png" alt="ícone para edição">
            </span>

            <span onclick="status(<?php echo($rsNiveis[$cont]->getId())?>, <?php echo($rsNiveis[$cont]->getStatus())?>)">
                <?php
                    // verifica qual o status atual e atribui o caminho do ícone á variável img
                    $status = $rsNiveis[$cont]->getStatus();
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
    $cont++;
    } ?>