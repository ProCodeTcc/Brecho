<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}
?>

<script>
	var url = '../../'
	
	function alterarImagem(id, caminho){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: 'frm_alterar_imagem.php', //url onde será enviada a requisição
			data: {id:id, caminho:caminho}, //parâmetros enviados
			success: function(dados){
				//fechando o conteúdo atual da modal
				$('.container_imagens').hide('fast');
				
				//mostrando o novo conteúdo
				$('.modal').html(dados);
			}
		});
	}
	
	//função que exclui uma imagem
	function excluirImagem(idItem){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {id:idItem, controller: 'produto', modo: 'excluirImagem'}, //parâmetros enviados
			success: function(dados){
                //listagem dos dados
                listar();
                
				//conversão dos dados para JSON
                json = JSON.parse(dados);
                
                //verificando o status
                if(json.status == 'erro'){
                    //mensagem de erro
                    mostrarErro('Ocorreu um erro ao excluir a imagem');
                }
			}
		});
	}
	
	$(document).ready(function(){
		mudarModal('400','800');
	});
</script>

<div class="container_imagens">
	<img class="fechar" src="../imagens/fechar.png" onclick="fecharModal()">
	<div class="dados_imagens">
		<?php
            //armazenando o diretório
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
        
            //inclusão da controller
			require_once($diretorio.'controller/controllerProduto.php');
        
            //instância da controller
			$listImagens = new controllerProduto();
        
            //armazenando os dados numa variável
			$rsImagem = $listImagens->listarImagens($id);
			
            //contador
			$cont = 0;
		  
            //percorrendo os dados
			while($cont < count($rsImagem)){
		?>
		
		<div class="dados_imagens_container">
			<img id="imagens" src="../arquivos/<?php echo($rsImagem[$cont]->getImagem()) ?>">
			
			<div class="acoes">
				<span class="editar_imagem" onClick="alterarImagem(<?php echo($rsImagem[$cont]->getId()) ?>, '<?php echo($rsImagem[$cont]->getImagem()) ?>')">
					<img src="../imagens/edit-image.png">
				</span>
				
				<span onClick="excluirImagem(<?php echo($rsImagem[$cont]->getId()) ?>)">
					<img src="../imagens/delete16.png">
				</span>
			</div>
		</div>
		<?php
            //incrementando o contador
			$cont++;
			}
		?>

	</div>
</div>