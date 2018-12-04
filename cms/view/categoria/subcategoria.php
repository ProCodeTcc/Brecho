<?php
	if(isset($_GET['id'])){
		$idCategoria = $_GET['id'];
	}else{
		$idCategoria = null;
	}
?>

<script>
    //função para mostrar o form preenchido
    function buscarSubcategoria(id){
        //escondendo o conteúdo atual
        $('.subcategoria_container').hide();

        $.ajax({
            type: 'POST', //tipo de requisição
            url: 'frm_subcategoria.php', //url onde será enviada a requisição
            data: {idSubcategoria:id}, //dados enviados
            success: function(dados){
                //mostrando os dados preenchidos
                $('.modal').html(dados);
            }
        });
    }

    $(function(){
        //ajustando a modal
        mudarModal('300', '800');
    });
</script>


<div class="subcategoria_container">
    <?php
        //armazenando o diretório numa variável
        $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
    
        //inclusão da controller
        require_once($diretorio.'/controller/controllerCategoria.php');
    
        //instância da controller
        $listSubcategoria = new controllerCategoria();
    
        //armazenando as subcategorias
        $rsSubcategoria = $listSubcategoria->listarSubcategoria($idCategoria);

        //contador
        $cont = 0;

        //percorrendo os dados
        while($cont < count($rsSubcategoria)){
    ?>
    
    <div class="subcategorias">
            <?php echo($rsSubcategoria[$cont]->getNome()) ?>

        <span onclick="buscarSubcategoria(<?php echo($rsSubcategoria[$cont]->getId()) ?>)">
            <img src="../imagens/pencil.png">
        </span>

        <span onclick="excluirSubcategoria(<?php echo($rsSubcategoria[$cont]->getId()) ?>)">
            <img src="../imagens/delete16.png">
        </span>
    </div>

    <?php
        //incrementando o contador
        $cont++;
            }
    ?>
</div>