<script>
    $(document).ready(function(){
        //abrir a modal quando for clicado no ícone de editar
        $('.editar').click(function(){
            $('.container_modal').fadeIn(400);
        });
    });

    
</script>

<?php
    //verificando se existe algo para pesquisar
    if(isset($_POST['pesquisa'])){
        //armazenando o termo a ser pesquisado
        $pesquisa = $_POST['pesquisa'];
    }
    
    //armazenando os dados numa variável
    $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';

    //inclusão da controller
    require_once($diretorio.'/controller/controllerNivel.php');

    //instância da controller
    $listNiveis = new controllerNivel();

    //armazenando os dados numa variável
    $rsNiveis = $listNiveis->pesquisarNivel($pesquisa);

    //contador
    $cont = 0;

    //percorrendo os dados
    while($cont < count($rsNiveis)){
?>

    <div class="users_view_list">
        <div class="users_view_itens"><?php echo($rsNiveis[$cont]->getId()) ?></div>
        <div class="users_view_itens"><?php echo($rsNiveis[$cont]->getNome()) ?></div>
        <div class="users_view_itens">
			<span onClick="permissao(<?php echo($rsNiveis[$cont]->getId()) ?>)">
				<img src="../imagens/permissao.png">
			</span>
            
			<span onclick="excluir(<?php echo($rsNiveis[$cont]->getId()) ?>)">
                <img src="../imagens/delete16.png">
            </span>

            <span data-id="<?php echo($rsNiveis[$cont]->getId()) ?>" onclick="buscar(<?php echo($rsNiveis[$cont]->getId()) ?>);">
               <img class="editar" data-modo="editar" src="../imagens/pencil.png">
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

                <img src="../imagens/<?php echo($img) ?>">
            </span>
        </div>
    </div>
    <?php 
        //incrementando o contador
        $cont++;
    } ?>

    <div class="voltar" onclick="voltar()">
        <img src="../imagens/back.png">
    </div>