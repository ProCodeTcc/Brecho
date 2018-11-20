<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}
?>

<script>
	var url = '../../';
	
	///função que exibe os dados do produto
	function exibirDados(id){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada requisição
			data: {id:id, controller: 'avaliação', modo: 'buscar'}, //parâmetros enviados
			success: function(dados){
				//conversão dos dados pra JSON
				json = JSON.parse(dados);
				
				//colocando os valores nas caixas de texto
				$('#txtnome').text(json.nomeProduto);
				$('#txtpreco').text(json.preco);
				$('#txtcor').text(json.nome);
				$('#txtclassificacao').text(json.classificacao);
				$('#txtmarca').text(json.marca);
				$('#txtcategoria').text(json.categoria);
				$('#txttamanho').text(json.tamanho);
				$('#txtdesc').text(json.descricao);
			}
		});
	}
	
	$(document).ready(function(){
		var id = $('.visualizar_container').data('id');
		
		exibirDados(id);
		
		$('.fechar').click(function(){
			$('.container_modal').fadeOut(400);
		});
	});
</script>

<div class="visualizar_container" data-id="<?php echo($id) ?>">
	<img class="fechar" src="../imagens/fechar.png">
	<div class="imagens_container">
		<?php
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
	 		require_once($diretorio.'controller/controllerAvaliacao.php');
	 		$listImagens = new controllerAvaliacao();
	 		$rsImagens = $listImagens->listarImagens($id);
	 
	 		$cont = 0;
	 		while($cont < count($rsImagens)){
		?>
		<img src="../arquivos/<?php echo($rsImagens[$cont]->getImagem()) ?>">
		<?php
		$cont++;
		}?>
	</div>
	
	<div class="visualizar_detalhes">
		<div class="detalhe_item">
			<span class="detalhes_titulo">
				Nome do Produto:
			</span>
			
			<span id="txtnome">
				
			</span>
		</div>

		<div class="detalhe_item">
			<span class="detalhes_titulo">
				Preço:
			</span>
			
			<span id="txtpreco">
				
			</span>
		</div>
		
		<div class="detalhe_item">
			<span class="detalhes_titulo">
				Cor:
			</span>
			
			<span id="txtcor">
				
			</span>
		</div>
		
		<div class="detalhe_item">
			<span class="detalhes_titulo">
				Classificação:
			</span>
			
			<span id="txtclassificacao">
				
			</span>
		</div>
		
		<div class="detalhe_item">
			<span class="detalhes_titulo">
				Marca:
			</span>
			
			<span id="txtmarca">
				
			</span>
		</div>
		
		<div class="detalhe_item">
			<span class="detalhes_titulo">
				Categoria:
			</span>
			
			<span id="txtcategoria">
				
			</span>
		</div>
		
		<div class="detalhe_item">
			<span class="detalhes_titulo">
				Tamanho:
			</span>
			
			<span id="txttamanho">
				
			</span>
		</div>
		
		<div class="descricao_container">
			<textarea class="visualizar_desc" id="txtdesc"></textarea>
		</div>
	</div>
</div>