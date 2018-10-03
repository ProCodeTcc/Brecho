<?php
    $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
    require_once($diretorio.'/controller/controllerNivel.php');
    $listPaginas = new controllerNivel();
    $rsPaginas = $listPaginas->listarPaginas();
    $cont = 0;

    while($cont < count($rsPaginas)){
?>

<script>
	var url = '../../';
	var idNivel = sessionStorage.getItem('idItem');
	
	//função para permitir o acesso do nível á página
	function permitirPagina(idNivel, idPagina){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'/router.php', //url onde será enviada a requisição
			data: {idNivel:idNivel, idPagina:idPagina, controller: 'nivel', modo: 'permitir'}, //dados que serão enviados
			success: function(dados){
				alert(dados); //mostra uma mensagem
			}
		});
	}
	
	function retirarPermissao(idNivel, idPagina){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'/router.php', //url onde será enviada a requisição
			data: {idNivel:idNivel, idPagina:idPagina, controller: 'nivel', modo: 'negar'}, //dados que serão enviados
			success: function(dados){
				alert(dados); //mostra uma mensagem
			}
		});
	}
</script>
    <div class="users_view_list">
        <div class="users_view_itens"><?php echo($rsPaginas[$cont]->getId()) ?></div>
        <div class="users_view_itens"><?php echo($rsPaginas[$cont]->getPagina()) ?></div>
        <div class="users_view_itens">
            <span id="permitir" onClick="permitirPagina(idNivel, <?php echo($rsPaginas[$cont]->getId()) ?>)">
				<img src="../imagens/permitir.png">
			</span>
			
			<span id="naoPermitir" onClick="retirarPermissao(idNivel, <?php echo($rsPaginas[$cont]->getId()) ?>)">
				<img src="../imagens/npermitir.png">
			</span>
        </div>
    </div>
    <?php 
    $cont++;
    } ?>