
<script>
	$(document).ready(function(){
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
		<div class="dados_imagens_container">
			<img src="../imagens/picture.png">
			
			<div class="acoes">
				<span>
					<img src="../imagens/edit-image.png">
				</span>
				
				<span>
					<img src="../imagens/delete16.png">
				</span>
			</div>
		</div>

		<div class="dados_imagens_container">
			<img src="../imagens/picture.png">
		</div>

		<div class="dados_imagens_container">
			<img src="../imagens/picture.png">
		</div>
	</div>
</div>