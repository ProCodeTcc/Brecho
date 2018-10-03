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
    $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
    require_once($diretorio.'/controller/controllerUsuario.php');
    $listUsuarios = new controllerUsuario();
    $rsUsuarios = $listUsuarios->listarUsuarios();
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

    <div class="erro_tabela" data-erro="<?php echo($cont) ?>">
        <h1>Desculpe, não há registros em nosso banco de dados!!</h1>

        <img src="../imagens/sad.png">
    </div>