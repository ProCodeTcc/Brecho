<script>
	var url = '../../';
	
	//função que abre a modal para edição de imagem
	function editarImagem(id){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: 'alterar_imagem.php', //url onde será enviada a requisição
			data:{id:id}, //dados enviados
			success:function(dados){
				//abrindo a modal
				$('.modal').show();
				
				//mostrando os dados da página
				$('.modal').html(dados);
			}
		});
	}
	
	//função que deleta a imagem
	function excluirImagem(id){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {id:id, controller: 'produto', modo: 'excluirImagem'}, //parâmetros enviados
			success: function(dados){
				alert(dados); //mensagem de sucesso
				$('.container_modal').fadeOut(400);
			}
		});
	}

	
	$(document).ready(function(){
		$('.fechar').click(function(){
			$('.container_modal').fadeOut(400);
		});
		
		$('.editar_imagem').click(function(){
			$('.modal').hide();
		});
	});
</script>

<img class="fechar" src="../imagens/delete.png">
<?php
	if(isset($_POST['id'])){
		$idProduto = $_POST['id'];
	}

	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
	require_once($diretorio.'controller/controllerProduto.php');
	$listImagens = new controllerProduto();
	$rsImagens = $listImagens->listarImagens($idProduto);

	$cont = 0;

	while($cont < count($rsImagens)){
?>

<div class="dados_imagens">
	<div class="imagem_linha">
		
		<div class="imagem_visualizar">
			<?php
				if($rsImagens[$cont]->getImagem() == null){
					echo("<img src='../imagens/nullimage.png'>");
				}else{
					echo("<img src='../arquivos/{$rsImagens[$cont]->getImagem()}'>");
				}
			?>
		</div>
		
		<span class="editar_imagem" style="margin-left: 25px; margin-right: 15px;" onClick="editarImagem(<?php echo($rsImagens[$cont]->getId()) ?>)">
			<img src="../imagens/edit-image.png">
		</span>
		
		<span onClick="excluirImagem(<?php echo($rsImagens[$cont]->getId()) ?>)">
			<img src="../imagens/delete16.png">
		</span>
	</div>	
	
	<?php
		$cont++;
		}
	?>

</div>