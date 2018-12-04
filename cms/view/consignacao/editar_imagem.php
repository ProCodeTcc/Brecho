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
				//mensagem de sucesso
				alert(dados);
				
				//listando os dados atualizados
				listar();
				
				//fechando a modal
				$('.container_modal').fadeOut(400);
			}
		});
	}
	
	$(document).ready(function(){
        //ajustando a model
		mudarModal('400', '800');
		
        //função no click do ícone para fechar a model
		$('.fechar').click(function(){
			$.ajax({
				type: 'POST', //tipo de requisição
				success: function(dados){
                    //fechando a modal
					$('.container_modal').fadeOut(400);
				}
			});
		});
	});
</script>

<div class="container_imagens">
	<img class="fechar" src="../imagens/fechar.png" alt="ícone para fechar a modal">
	<div class="dados_imagens">
		<?php
            //armazenando o diretório
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
        
            //inclusão da controller
			require_once($diretorio.'controller/controllerProduto.php');
        
            //armazenando as imagens
			$listImagens = new controllerProduto();
        
            //armazenando as imagens
			$rsImagem = $listImagens->listarImagens($id);
			
            //contador
			$cont = 0;
		  
            //percorrendo as imagens
			while($cont < count($rsImagem)){
		?>
		
		<div class="dados_imagens_container">
			<img id="imagens" src="../arquivos/<?php echo($rsImagem[$cont]->getImagem()) ?>" alt="imagem do produto">
			
			<div class="acoes">
				<span class="editar_imagem" onClick="alterarImagem(<?php echo($rsImagem[$cont]->getId()) ?>, '<?php echo($rsImagem[$cont]->getImagem()) ?>')">
					<img src="../imagens/edit-image.png" alt="ícone para editar a imagem">
				</span>
				
				<span onClick="excluirImagem(<?php echo($rsImagem[$cont]->getId()) ?>)">
					<img src="../imagens/delete16.png" alt="ícone para exclusão">
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