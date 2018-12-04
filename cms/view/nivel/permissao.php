<?php
    //armazenando o diretório
    $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';

    //inclusão da controller
    require_once($diretorio.'/controller/controllerNivel.php');

    //instância da controller
    $listPaginas = new controllerNivel();

    //armazenando as páginas numa variável
    $rsPaginas = $listPaginas->listarPaginas();

    //contador
    $cont = 0;

    //perorrendo os dados
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
				//conversão dos dados para JSON
				json = JSON.parse(dados);

				//verificando o status
				if(json.status == 'sucesso'){
					//mensagem de sucesso
					mostrarSucesso('Permissão concedida com sucesso');
				}else if(json.status == 'permitido'){
					//informação
					mostrarInfo('A permissão já foi concedida');
				}else if(json.status == 'erro'){
					//mensagem de erro
					mostrarErro('Ocorreu um erro ao conceder a permissão');
				}
			}
		});
	}
	
	function retirarPermissao(idNivel, idPagina){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'/router.php', //url onde será enviada a requisição
			data: {idNivel:idNivel, idPagina:idPagina, controller: 'nivel', modo: 'negar'}, //dados que serão enviados
			success: function(dados){
				//conversão dos dados para JSON
				json = JSON.parse(dados);

				//verificando o status
				if(json.status == 'erro'){
					//mensagem de erro
					mostrarErro('Ocorreu um erro ao retirar a permissão');
				}else if(json.status == 'sucesso'){
					//mensagem de sucesso
					mostrarSucesso('Permissão retirada com sucesso');
				}
			}
		});
	}
</script>
    <div class="users_view_list">
        <div class="users_view_itens"><?php echo($rsPaginas[$cont]->getId()) ?></div>
        <div class="users_view_itens"><?php echo($rsPaginas[$cont]->getPagina()) ?></div>
        <div class="users_view_itens">
            <span id="permitir" onClick="permitirPagina(idNivel, <?php echo($rsPaginas[$cont]->getId()) ?>)">
				<img src="../imagens/permitir.png" alt="ícone para permitir o acesso">
			</span>
			
			<span id="naoPermitir" onClick="retirarPermissao(idNivel, <?php echo($rsPaginas[$cont]->getId()) ?>)">
				<img src="../imagens/npermitir.png" alt="ícone para negar o acesso">
			</span>
        </div>
    </div>
    <?php 
    //incremetnando o contador
    $cont++;
    } ?>