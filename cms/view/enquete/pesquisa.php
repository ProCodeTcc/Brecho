<script>
    //abrir a modal quando for clicado no ícone de editar
	$(document).ready(function(){
		$('.editar').click(function(){
			$('.container_modal').fadeIn(400);

			$.ajax({
			type: 'POST',
			url: 'frm_enquete.php',
			success: function(dados){
				$('.modal').html(dados);
				}
			});
		});

		$('.visualizar').click(function(){
			$('#consulta').hide();
		});
	});


</script>
    <?php
        if(isset($_POST['pesquisa'])){
            $pesquisa = $_POST['pesquisa'];
        }

        $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
        require_once($diretorio.'/controller/controllerEnquete.php');
        $listEnquetes = new controllerEnquete();
        $rsEnquetes = $listEnquetes->pesquisarEnquete($pesquisa);

        $cont = 0;
        while($cont < count($rsEnquetes)){
    ?>

    <div class="users_view_list" id="dados">
        <div class="users_view_itens"><?php echo($rsEnquetes[$cont]->getPergunta()) ?></div>
        <div class="users_view_itens"><?php echo($rsEnquetes[$cont]->getTema()) ?></div>
        <div class="users_view_itens"><?php echo($rsEnquetes[$cont]->getDtTermino()) ?></div>
        <div class="users_view_itens">
            <span onclick="excluir(<?php echo($rsEnquetes[$cont]->getId()) ?>)">
                <img src="../imagens/delete16.png">
            </span>

            <span data-id="<?php echo($rsEnquetes[$cont]->getId()) ?>" onclick="buscar(<?php echo($rsEnquetes[$cont]->getId()) ?>)">
               <img class="editar" data-modo="editar" src="../imagens/pencil.png">
            </span>

			<span class="visualizar" onClick="visualizar(<?php echo($rsEnquetes[$cont]->getId()) ?>)">
				<img src="../imagens/visualizar.png">
			</span>

            <span onclick="status(<?php echo($rsEnquetes[$cont]->getId())?>, <?php echo($rsEnquetes[$cont]->getStatus())?>)">
                <?php
                    // verifica qual o status atual e atribui o caminho do ícone á variável img
                    $status = $rsEnquetes[$cont]->getStatus();
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
