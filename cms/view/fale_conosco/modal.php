<?php
	$id = $_POST['id'];
?>

<script>
	url = '../../';
	
	//função que exibe os dados no formulário
	function exibirDados(){
		//resgatando o id
		var id = $('.visualizar_container').data('id');
		
		//chamando o ajax
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {id:id, controller: 'FaleConosco', modo: 'buscar'}, //parâmetros enviados
			success: function(dados){
				json = JSON.parse(dados); //convertendo os dados para json
				
				//colocando os dados nas caixas de texto
				$('#txtnome').text(json.nomePessoa);
				$('#txtemail').text(json.email);
				$('#txttelefone').text(json.telefone);
				$('#txtsexo').text(json.sexo);
				$('#txtassunto').text(json.assunto);
				$('#txtdesc').text(json.comentario);
			}
		});
	}
	
	$(document).ready(function(){
		exibirDados();
		$('.fechar').click(function(){
			$('.container_modal').fadeOut(400);
		});
	});
</script>

<div class="visualizar_container" data-id="<?php echo($id) ?>">
	<img class="fechar" src="../imagens/fechar.png">
	
	<div class="visualizar_detalhes">
		<div class="detalhe_item">
			<span class="detalhes_titulo">
				Nome:
			</span>
			
			<span id="txtnome">
				
			</span>
		</div>

		<div class="detalhe_item">
			<span class="detalhes_titulo">
				E-mail:
			</span>
			
			<span id="txtemail">
				
			</span>
		</div>
		
		<div class="detalhe_item">
			<span class="detalhes_titulo">
				Telefone:
			</span>
			
			<span id="txttelefone">
				
			</span>
		</div>
		
		<div class="detalhe_item">
			<span class="detalhes_titulo">
				Sexo:
			</span>
			
			<span id="txtsexo">
				
			</span>
		</div>
		
		<div class="detalhe_item">
			<span class="detalhes_titulo">
				Assunto:
			</span>
			
			<span id="txtassunto">
				
			</span>
		</div>
		
		<div class="descricao_container">
			<textarea class="visualizar_desc" id="txtdesc"></textarea>
		</div>
	</div>
</div>