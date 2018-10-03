<script>
    //abrir a modal quando for clicado no ícone de editar
        $(document).ready(function(){
            $('.editar').click(function(){
                $('.container_modal').fadeIn(400);
            });
            
            //criando a variável erro e atribuindo a ela o valor contido
            //no data-atributo "erro", criado na div
            var erro = $('.erro_tabela').data('erro');
            
            //verificando se o valor contido em erro é 0, se for
            //mostra a mensagem de erro
            if(erro == 0){
                $('.erro_tabela').show();
            }
        });

    
</script>
    <?php
        
    ?>

    <div class="users_view_list">
        <div class="users_view_itens"><?php  ?></div>
        <div class="users_view_itens"><?php  ?></div>
        <div class="users_view_itens"><?php  ?></div>
        <div class="users_view_itens">
            <span onclick="excluir(<?php  ?>)">
                <img src="../imagens/delete16.png">
            </span>

            <span data-id="<?php  ?>" onclick="buscar(<?php  ?>)">
               <img class="editar" data-modo="editar" src="../imagens/pencil.png">
            </span>

            <span onclick="status(<?php ?>, <?php ?>)">
                <?php
                    // verifica qual o status atual e atribui o caminho do ícone á variável img
                    $status = 1;
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
     ?>

    <div class="erro_tabela" data-erro="<?php echo($cont) ?>">
        <h1>Desculpe, não há registros em nosso banco de dados!!</h1>

        <img src="../imagens/sad.png">
    </div>
