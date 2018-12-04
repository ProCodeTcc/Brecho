<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = "";
	}
?>

<script>
	var url = '../../';
	
	//função para exibir os dados na div
	function exibirDados(id, idioma){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'/router.php', //url onde será enviada a requisição
			data: {id:id, idioma:idioma, modo: 'buscar', controller: 'sobre'}, //parâmetros enviados
			success: function(dados){
				json = JSON.parse(dados); 
				
				//preenchendo as caixas de texto
				$('#prev_titulo').text(json.titulo);
				$('#prev_imagem img').attr('src', '../arquivos/'+json.imagem);
				$('#prev_descricao').text(json.descricao);
			}
		});
	}
	
	$(document).ready(function(){
        //resgatando o ID
		var id = $('#preview_layout1').data('id');
        
        //exibindo os dados do layout
		exibirDados(id, 'pt');
	});
</script>
<div id="preview_layout1" data-id="<?php echo($id) ?>">
	<div class="preview_layout1_col1">
		<h1 id="prev_titulo"></h1>
	
		<div id="prev_descricao">

		</div>	
	</div>

	<div class="preview_layout1_col2">
		<div id="prev_imagem">
			<img src="#" alt="imagem do layout">
		</div>
	</div>
</div>