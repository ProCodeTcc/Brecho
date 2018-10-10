<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = "";
	}
?>

<script>
	var url = '../../';
	
	//função para realizar uma busca para trazer o tamanho através da medida
	function buscarMedida(tamanho){
		//limpando as options
		$('#txttamanho').find('option').remove();
		
		$('#txttamanho').show();
		
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {tamanho: tamanho, controller: 'produto', modo: 'buscarMedida'}, //parâmetros enviados
			success: function(dados){
				json = JSON.parse(dados); //conversão dos dados para json
				
				//percorrendo os tamanhos
				for(var i = 0; i < json.length; i++){
					//criando uma nova option, de acordo com a quantidade de tamanhos
					$('#txttamanho').append(new Option(json[i].tamanho, json[i].idTamanho));
				}
			}
		});
	}
	
	//função para realizar uma busca para trazer o tamanho através do número
	function buscarNumero(tamanho){
		//limpando o select
		$('#txttamanho').find('option').remove();
		
		$('#txttamanho').show();
		
		$.ajax({
			type: 'POST', //tipo de requisiçao
			url: url+'router.php', //url onde será enviada a requisição
			data: {tamanho: tamanho, controller: 'produto', modo: 'buscarMedida'}, //parâmetros enviados
			success: function(dados){
				json = JSON.parse(dados); //conversão dos dados para json
				
				//percorrendo os dados
				for(var i = 0; i < json.length; i++){
					//criando uma nova option, de acordo com a quantidade de tamanhos
					$('#txttamanho').append(new Option(json[i].tamanho, json[i].idTamanho));
				}
			}
		});
	}
	
	//função para lisar as cores disponíveis
	function listarCor(){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {controller: 'produto', modo: 'buscarCor'}, //parâmetros enviados
			success: function(dados){
				//convertendo os dados para json
				json = JSON.parse(dados);
				
				//percorrendo os dados
				for(var i = 0; i < json.length; i++){
					//criando uma nova option, de acordo com a quantidade de cores
					$('#txtcor').append(new Option(json[i].nome, json[i].idCor));
				}
			}
		});
	}
	
	//função para listar as marcas
	function listarMarca(){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {controller: 'produto', modo: 'buscarMarca'}, //parâmetros enviados
			success: function(dados){
				//conversão dos dados para json
				json = JSON.parse(dados);
				
				//percorrendo os dados
				for(var i = 0; i < json.length; i++){
					//criando uma nova option, de acordo com o número de marcas
					$('#txtmarca').append(new Option(json[i].nomeMarca, json[i].idMarca));
				}
			}
		});
	}
	
	//função para listar as categorias
	function listarCategoria(){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {controller: 'produto', modo: 'buscarCategoria'}, //parâmetros enviados
			success: function(dados){
				//conversão dos dados para json
				json = JSON.parse(dados);
				
				for(var i = 0; i < json.length; i++){
					$('#txtcategoria').append(new Option(json[i].nomeCategoria, json[i].idCategoria));
				}
			}
		});
	}
	
	//função para buscar o produto
	function buscarProduto(id){
		$('#frmImagem').hide();
		$('#txttamanho').show();
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'/router.php', //url onde será enviada a requisição
			data: {id:id, controller: 'produto', modo: 'buscar'}, //parâmetros enviados
			success: function(dados){
				//conversão dos dados para json
				json = JSON.parse(dados);
				
				//colocando os valores nas caixas de texto
				$('#txtnome').val(json.nomeProduto);
				$('#txtdesc').val(json.descricao);
				$('#txtcor').val(json.idCor);
				$('#txtmarca').val(json.idMarca);
				$('#txtcategoria').val(json.idCategoria);
				$('#txtpreco').val(json.preco);
			}
		});
	}
	
	$(document).ready(function(){
		var id = $('#frmRoupa').data('id');
		listarCategoria();
		listarMarca();
		listarCor();
		
		if(id != ""){
			buscarProduto(id);
		}
		
		$('#imagem').live('change', function(){
			$('#frmImagem').ajaxForm({
				target: '#visualizar_roupa',
				beforeSubmit: function(dados){
					console.log(dados);
					
					//$('#imagem').attr('src', '../imagens/catloading.gif');
					
					if(dados.length > 3){
						alert('O número máximo de imagens que podem ser escolhidas é 3!!');
						return false;
					}
					
				}
			}).submit();
		});
		
		$('#frmRoupa').submit(function(e){
			e.preventDefault();
			
			var formulario = new FormData($('#frmRoupa')[0]);
			formulario.append('controller', 'produto');
			
			if(id == ""){
				formulario.append('modo', 'inserir');
			}else{
				formulario.append('modo', 'editar');
				formulario.append('id', id);
			}
			
			$.ajax({
				type: 'POST',
				url: url+'router.php',
				data: formulario,
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					alert(dados);
					listar();
					$('.container_modal').fadeOut(400);
				}
			});
		});
		
		$('.fechar').click(function(){
			$('.container_modal').fadeOut(400);
		});
		
		$('#txtnumero').click(function(){
			//exibindo os tamanhos
			buscarNumero(2);
		});
		
		$('#txtmedida').click(function(){
			//exibindo os tamanhos
			buscarMedida(1);
		});
	});
</script>

<div class="form_container" id="form_container_roupa">
	<img class="fechar" src="../imagens/fechar.png">
    
	<form method="post" class="frm_imagem" id="frmImagem" name="frmImagem" enctype="multipart/form-data" action="upload.php">
		<div id="visualizar_roupa">
			<label for="imagem">
				<img src="../imagens/image.png">
			</label>
			
			<input type="file" name="fleimagem[]" id="imagem" multiple>
		</div>
	</form>
	
	<form class="frm_roupa" id="frmRoupa" data-id="<?php echo($id) ?>" method="post" name="frmRoupa" enctype="multipart/form-data" name="frmImagem" action="usuario_view.php">
		<div id="roupas_form">
			<div id="roupas_col1">
				<input type="hidden" name="txtimagem1">
				<input type="hidden" name="txtimagem2">
				<input type="hidden" name="txtimagem3">
				<div class="form_linha">
					<label class="lbl_cadastro">Nome: </label>
					<input type="text" class="cadastro_input" name="txtnome" id="txtnome">
				</div>

				<div class="form_linha">
					<label class="lbl_cadastro">Descrição: </label>
					<textarea name="txtdescricao" class="cadastro_text" id="txtdesc"></textarea>
				</div>

				<div class="form_linha" id="radio_linha">
					<label class="lbl_cadastro">Tipo: </label>

					<div class="radio">
						<label for="txtmedida">Medida</label>
						<input type="radio" id="txtmedida" name="txttipo" value="medida" onClick="buscarMedida">

						<label for="txtnumero">Número</label>
						<input type="radio" id="txtnumero" name="txttipo" value="numero" onClick="buscarNumero">
					</div>
				</div>

				<div class="form_linha">
					<select name="txttamanho" class="cadastro_select" id="txttamanho">
					
					</select>
				</div>

				<div class="form_linha">
					<label class="lbl_cadastro">Categoria: </label>
					<select name="txtcategoria" class="cadastro_select" id="txtcategoria">

					</select>
				</div>
			</div>

			<div id="roupas_col2">
				<div class="form_linha">
					<label class="lbl_cadastro">Marca: </label>
					<select name="txtmarca" class="cadastro_select" id="txtmarca">
					</select>
				</div>

				<div class="form_linha">
					<label class="lbl_cadastro">Cor: </label>
					<select name="txtcor" class="cadastro_select" id="txtcor">
				
					</select>
				</div>

				<div class="form_linha">
					<label class="lbl_cadastro">Classificação: </label>
					<select name="txtclassificacao" class="cadastro_select" id="txtclassificacao">
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="B">C</option>
					</select>
				</div>

				<div class="form_linha">
					<label class="lbl_cadastro">Valor: </label>
					<input type="number" class="cadastro_input" name="txtpreco" id="txtpreco">
				</div>
			</div>
		</div>
		
		<div style="margin-top: 15px;">
			<input type="submit" class="sub_btn" value="ENVIAR">
		</div>
    </form>
</div>