<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}
?>

<script>
	var url = '../../';
	
	//função para exibir os dados
	function exibirDados(id, idioma){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {id:id, idioma:idioma, modo: 'buscar', controller: 'sobre'}, //parâmetros que serão enviados
			success: function(dados){
				json = JSON.parse(dados);
				
				//colocando os valores nas divs
				$('#prev_titulo').text(json.titulo);
				$('#prev_descricao').text(json.descricao);
				$('#prev_imagem img').attr('src', '../arquivos/'+json.imagem);
				$('#prev_descricao2').text(json.descricao2);
			}
		});
	}
	
	var id = $('#preview_layout2').data('id');
	exibirDados(id, 'pt');
</script>

<div id="preview_layout2" data-id="<?php echo($id) ?>">
	<div class="preview_layout2_col1">
		<h1 id="prev_titulo">
		
		</h1>
		
		<div id="prev_descricao">
		
		</div>
	</div>
	
	<div class="preview_layout2_col2">
		<div id="prev_imagem">
			<img src="#">
		</div>
	</div>
	
	<div class="preview_layout2_col3">
		<div id="prev_descricao2">
		
		</div>
	</div>
</div>