<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
	var url = '../../'
	
	//função que mostra a prévia da imagem
	function mostrarPrevia(input){
		if(input.files && input.files[0]){
			//criando um novo File Reader
			var leitor = new FileReader();
			
			leitor.onload = function(event){
				//colocando a imagem no local da prévia
				$('#img').attr('src', event.target.result);
			}
			
			leitor.readAsDataURL(input.files[0]);
		}
	}
	
	//função que exibe os dados no formulário
	function exibirDados(id){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {id:id, controller: 'evento', modo: 'buscar'}, //parâmetros enviados
			success: function(dados){
				//conversão dos dados para JSON
				json = JSON.parse(dados);
				
				//resgatando os valores das caixas de texto
				$('#txtnome').val(json.nomeEvento);
				$('#txtdesc').val(json.descricaoEvento);
				$('#dtinicio').val(json.dataInicio);
				$('#dttermino').val(json.dataFim);
				
				//verificando se a imagem é nula
				if(json.imagemEvento != null){
					//mostrando a imagem do banco
					$('#img').attr('src', '../arquivos/'+json.imagemEvento);
					
					//colocando o caminho no data-atributo
					$('#frmEvento').data('imagem', json.imagemEvento);
				}
			}
		});
	}
	
	$(document).ready(function(){
		var id = $('#frmEvento').data('id');
		
		if(id != ""){
			exibirDados(id);
		}
		
		$('.fechar').click(function(){
			$('.container_modal').fadeOut(400);
		});
		
		$('#imagem').live('change', function(){
			mostrarPrevia(this);
		});
		
		//função no submit do formulário
		$('#frmEvento').submit(function(e){
			//desativando o evento de submit
			e.preventDefault();
			
			//armazenando os dados do formulário em uma variável
			var formulario = new FormData($('#frmEvento')[0]);
			
			//atribuindo ao formulário o parâmetro controller
			formulario.append('controller', 'evento');
			
			//verificando se o ID está nulo
			if(id == ""){
				//se estiver, atribui ao formulário o modo de inserir
				formulario.append('modo', 'inserir');
			}else{
				//resgatando o caminho da imagem do data-atributo
				var imagem = $('#frmEvento').data('imagem');
				
				//atribuindo ao formulário o parâmetro de editar
				formulario.append('modo', 'editar');
				
				//atribuindo ao formulário o parâmetro ID
				formulario.append('id', id);
				
				//atribuindo ao formulário o parâmetro imagem
				formulario.append('imagem', imagem);
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
	});
</script>

<div class="form_container">
	<img class="fechar" src="../imagens/delete.png">
	<form method="post" id="frmEvento" data-id="<?php echo($id) ?>" class="frmEvento" name="frmEvento">
		<div class="form_linha">
			<div id="visualizar_evento">
				<label for="imagem">
					<img id="img" src="../imagens/image.png">
				</label>
				
				<input type="file" id="imagem" name="fleimagem">
			</div>
		</div>
		
		<div class="form_linha">
			<label>
				Nome:
			</label>
			
			<input type="text" class="cadastro_input" name="txtnome" id="txtnome">
		</div>
		
		<div class="form_linha">
			<label>
				Descrição:
			</label>
			
			<textarea class="cadastro_text" name="txtdesc" id="txtdesc"></textarea>
		</div>
		
		<div class="form_linha">
			<label>
				Loja
			</label>
			
			<select class="cadastro_select" name="txtloja">
			
				<?php
					$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
		  			require_once($diretorio.'controller/controllerEvento.php');
		  			$listLojas = new controllerEvento();
		  			$rsLojas = $listLojas->listarLojas();
		  			$cont = 0;
		  			while($cont < count($rsLojas)){
				?>
				
				<option value="<?php echo($rsLojas[$cont]->getIdLoja()) ?>">
					<?php echo($rsLojas[$cont]->getLoja()) ?>
				</option>
				
				<?php
				$cont++;
		  			}
				?>
			</select>
		</div>
		
		<div class="form_linha container_data" id="lbl_data">
            <label class="lbl_cadastro">
                Início:
            </label>

             <label class="lbl_cadastro">
                Término:
            </label>
        </div>

        <div class="form_linha container_data" id="input_data">
			<input type="date" class="cadastro_input" name="dtinicio" id="dtinicio">
			
			<input type="date" class="cadastro_input" name="dttermino" id="dttermino">
        </div>
		
		<div class="form_linha">
			<input type="submit" class="sub_btn" value="ENVIAR">
		</div>
	</form>
</div>