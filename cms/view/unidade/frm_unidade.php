<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
	var url = '../../';
	
	//função que exibe os dados nas caixas de texto
	function exibirDados(id){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data:{id:id, controller: 'unidade', modo: 'buscar'}, //parâmetros enviados
			success: function(dados){
				//conversão dos dados para JSON
				json = JSON.parse(dados);
				
				//colocando os valores nas caixas de texto
				$('#txtnome').val(json.nomeUnidade);
				$('#txtcep').val(json.cep);
				$('#txtbairro').val(json.bairro);
				$('#txtcidade').val(json.cidade);
				$('#txtestado').val(json.estado);
				$('#txtnumero').val(json.numero);
				$('#txtlogradouro').val(json.logradouro);
				$('#txtlat').val(json.latitude);
				$('#txtlong').val(json.longitude);
				
				//armazenando o ID do endereço num data-atributo do formulário
				$('#frmUnidade').data('idEndereco', json.idEndereco);
			}
		});
	}
	
	$(document).ready(function(){
		mudarModal('500', '600');
		var id = $('#frmUnidade').data('id');
		
		if(id != ""){
			exibirDados(id);
		}
		
		//função no momento em que o campo de CEP sair do foco
		$('#txtcep').blur(function(){
			//resgatando o cep inserido
			var cep = $('#txtcep').val();
			
			//aguardando a consulta
			$('#txtlogradouro').val('...');
			$('#txtbairro').val('...');
			$('#txtcidade').val('...');
			$('#txtestado').val('...');
			
			//acessando a API
			$.getJSON('https://viacep.com.br/ws/'+cep+'/json/', function(dados){
				//colocando os dados do CEP
				$('#txtlogradouro').val(dados.logradouro);
				$('#txtbairro').val(dados.bairro);
				$('#txtcidade').val(dados.localidade);
				$('#txtestado').val(dados.uf);
				
				getLatLon(dados.logradouro);
			});
		});
		
		$('#frmUnidade').submit(function(e){
			//desabilitando o submit do form
			e.preventDefault();
			
			//armazenando o formulário em uma variável
			var formulario = new FormData($('#frmUnidade')[0]);
			
			//acrescentando ao formulário o parâmetro controller
			formulario.append('controller', 'unidade');
			
			//verificando se o ID é nulo
			if(id == ""){
				//se for, atribui ao modo o parâmetro inserir
				formulario.append('modo', 'inserir');				
			}else{
				//se for vazio, resgata o ID do endereço
				var idEndereco = $('#frmUnidade').data('idEndereco');
				
				//atribui ao modo o parâmetro editar
				formulario.append('modo', 'editar');
				
				//acrescenta o ID da unidade
				formulario.append('id', id);
				
				//acrescenta o ID do endereço
				formulario.append('idEndereco', idEndereco);
			}
			
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'router.php', //url onde será enviada a requisição
				data: formulario, //dados enviados
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					//conversão dos dados para JSON.
                    json = JSON.parse(dados);
                    
                    if(id == ''){
                        if(json.status == 'sucesso'){
                            //mensagem de sucesso
                            mostrarSucesso('Unidade inserida com sucesso');
                            //listagem dos dados
                           listar();
                        }else if(json.status == 'erro'){
                            //mensagem de erro
                            mostrarErro('Ocorreu um erro ao inserir a unidade');
                        }
                    }else{
                        if(json.status == 'atualizado'){
                            //mensagem de sucesso
                            mostrarSucesso('Unidade atualizada com sucesso');
                        }else if(json.status == 'erro'){
                            mostrarErro('Ocorreu um erro ao atualizar a unidade');
                        }
                    }
				}
			});
		});
	});
</script>

<div class="form_container">
	<img class="fechar" src="../imagens/delete.png" onclick="fecharModal()">
	<form method="post" id="frmUnidade" data-id="<?php echo($id) ?>" class="frmUnidade" name="frmUnidade">
		<div class="unidades_container">
				<div class="unidade_col1">
					<div class="form_linha">
						<label>
							Nome:
						</label>

						<input type="text" name="txtnome" class="cadastro_input" id="txtnome">
					</div>

					<div class="form_linha">
						<label>
							CEP:
						</label>

						<input class="cadastro_input" type="text" name="txtcep" id="txtcep">
					</div>

					<div class="form_linha">
						<label>
							Bairro:
						</label>

						<input type="text" class="cadastro_input" name="txtbairro" id="txtbairro">
					</div>

					<div class="form_linha">
						<label>
							Estado:
						</label>

						<input type="text" class="cadastro_input" name="txtestado" id="txtestado">
					</div>
					
					<div class="form_linha">
						<label>
							Latitude:
						</label>
						
						<input type="text" class="cadastro_input" name="txtlat" id="txtlat" readonly="readonly">
					</div>
				</div>

				<div class="unidade_col2">
					<div class="form_linha">
						<label>
							Loja:
						</label>

						<select name="txtloja" class="cadastro_select" id="txtloja">
							<?php
								$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
								require_once($diretorio.'controller/controllerUnidade.php');
								$listLoja = new controllerUnidade();
								$rsLojas = $listLoja->listarLojas();
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

					<div class="form_linha">
						<label>
							Logradouro:
						</label>

						<input class="cadastro_input" type="text" name="txtlogradouro" id="txtlogradouro">
					</div>

					<div class="form_linha">
						<label>
							Cidade:
						</label>

						<input type="text" class="cadastro_input" name="txtcidade" id="txtcidade">
					</div>

					<div class="form_linha">
						<label>
							Número:
						</label>

						<input type="number" class="cadastro_input" name="txtnumero" id="txtnumero">
					</div>
					
					<div class="form_linha">
						<label>
							Longitude:
						</label>
						
						<input type="text" class="cadastro_input" name="txtlong" id="txtlong" readonly="readonly">
					</div>
				</div>
		</div>
		
		<div class="form_linha">
			<input type="submit" class="sub_btn" value="ENVIAR">
		</div>
	</form>
</div>