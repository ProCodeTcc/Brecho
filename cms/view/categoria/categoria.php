<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
	var url = '../../';
	
	$(document).ready(function(){
		$('#tabs').tabs();
	});
</script>

	<div id="tabs" data-id="<?php echo($id) ?>">
        <ul>
            <li>
                <a href="frm_categoria.php?id=<?php echo($id) ?>">Categoria</a>
            </li>
            <li>
                <a href="subcategoria.php?id=<?php echo($id) ?>">Subcategoria</a>
            </li>

			<img class="fechar" src="../imagens/fechar.png" onclick="fecharModal()">
        </ul>
    </div>