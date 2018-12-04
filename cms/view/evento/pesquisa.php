<script>
    //abrir a modal quando for clicado no ícone de editar
        $(document).ready(function(){
            $('.editar').click(function(){
                $('.container_modal').fadeIn(400);
            });
        });

    
</script>
    <?php
        //verificando se existe algo para pesquisar
        if(isset($_POST['pesquisa'])){
            //resgatando termo da pesquisa
            $pesquisa = $_POST['pesquisa'];
        }
    
        //armazenando o diretório numa variável
        $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';

        //inclusão da controller
		require_once($diretorio.'controller/controllerEvento.php');

        //instância da controller
		$listEvento = new controllerEvento();

        //armazenando os dados numa variável
		$rsEvento = $listEvento->pesquisarEvento($pesquisa);

        //contador
		$cont = 0;

        //percorrendo os dados
		while($cont < count($rsEvento)){
    ?>

    <div class="users_view_list">
        <div class="users_view_itens"><?php echo($rsEvento[$cont]->getId()) ?></div>
        <div class="users_view_itens"><?php echo($rsEvento[$cont]->getNome()) ?></div>
        <div class="users_view_itens"><?php echo($rsEvento[$cont]->getDtTermino()) ?></div>
        <div class="users_view_itens">
            <span onclick="excluir(<?php echo($rsEvento[$cont]->getId()) ?>)">
                <img src="../imagens/delete16.png">
            </span>

            <span onclick="buscar(<?php echo($rsEvento[$cont]->getId()) ?>)">
               <img class="editar" data-modo="editar" src="../imagens/pencil.png">
            </span>

            <span onclick="status(<?php echo($rsEvento[$cont]->getId()) ?>, <?php echo($rsEvento[$cont]->getStatus()) ?>)">
                <?php
                    // verifica qual o status atual e atribui o caminho do ícone á variável img
                    $status = $rsEvento[$cont]->getStatus();
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
		}
     ?>

     <div class="voltar" onclick="voltar()">
        <img src="../imagens/back.png">
     </div>