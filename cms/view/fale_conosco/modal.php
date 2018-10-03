<?php
	$id = $_POST['id'];
?>

<script>
	url = '../../';
	
	//função que exibe os dados no formulário
	function exibirDados(){
		//resgatando o id
		var id = $('.fale_conosco').data('id');
		
		//chamando o ajax
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {id:id, controller: 'FaleConosco', modo: 'buscar'}, //parâmetros enviados
			success: function(dados){
				json = JSON.parse(dados); //convertendo os dados para json
				
				//colocando os dados nas caixas de texto
				$('#nome').text(json.nomePessoa);
				$('#email').text(json.email);
				$('#telefone').text(json.telefone);
				$('#sexo').text(json.sexo);
				$('#assunto').text(json.assunto);
				$('#comentario').text(json.comentario);
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

<img class="fechar" src="../imagens/fechar.png">

<div class="fale_conosco" data-id=<?php echo($id) ?>>
	<div class="fale_conosco_linha">
		<span>
			Nome:
		</span>
		
		<div id="nome"></div>
	</div>
	
	<div class="fale_conosco_linha">
		<span>
			E-mail:
		</span>
		
		<div id="email"></div>
	</div>
	
	<div class="fale_conosco_linha">
		<span>
			Telefone:
		</span>
		
		<div id="telefone"></div>
	</div>
	
	<div class="fale_conosco_linha">
		<span>
			Sexo:
		</span>
		
		<div id="sexo"></div>
	</div>
	
	<div class="fale_conosco_linha">
		<span>
			Assunto:
		</span>
		
		<div id="assunto"></div>
	</div>
	
	<div class="fale_conosco_linha">
		<span>
			Comentário:
		</span>
		
		<textarea id="comentario" disabled></textarea>
	</div>
</div>