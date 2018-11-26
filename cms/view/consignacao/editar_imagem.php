<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}
?>

<script>
	var url = '../../'
//	function listarImagens(){
//		$.ajax({
//			type: 'POST',
//			url: 'dados_imagens.php',
//			success: function(dados){
//				$('.modal').html(dados);
//			}
//		});
//	}
	
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
		mudarModal('400', '800');
		
//		$('.editar_imagem').click(function(){
//			$('.container_imagens').hide('fast');
//			$('.modal').show();
//		});
		
		$('.fechar').click(function(){
			$.ajax({
				type: 'POST',
				success: function(dados){
					$('.container_modal').fadeOut(400);
				}
			});
		});
	});
</script>

<div class="container_imagens">
	<img class="fechar" src="../imagens/fechar.png">
	<div class="dados_imagens">
		<?php
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'controller/controllerProduto.php');
			$listImagens = new controllerProduto();
			$rsImagem = $listImagens->listarImagens($id);
			
			$cont = 0;
		
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
			$cont++;
			}
		?>

	</div>
</div>