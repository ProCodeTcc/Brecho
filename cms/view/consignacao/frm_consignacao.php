<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$preco = $_POST['preco'];
	}
?>

<script>
	var url = '../../';

	//função que exibe os dados de uma consignação
	function exibirDados(id){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {id:id, controller: 'consignação', modo: 'buscar'}, //parâmetros enviados
			success: function(dados){
				//convertendo os dados para JSON
				json = JSON.parse(dados);
	
				//colocando os valores nas caixas de texto
				$('#percentualloja').val(json.percentual);
                $('#valor').val(json.valorConsignacao);
				$('#dtinicio').val(json.dataInicial);
				$('#dttermino').val(json.dataFinal);
			}
		});
	}

	$(document).ready(function(){
		mudarModal('400', '400');
		var id = $('#frmConsignacao').data('id');

		if(id != ""){
			exibirDados(id);
		}

		//função no submit do formulário
		$('#frmConsignacao').submit(function(e){
			//desativando o submit
			e.preventDefault();
			
			//armazenando o formulário em uma variável
			formulario = new FormData($('#frmConsignacao')[0]);
			
			//acrescentando ao formulário o parâmetro controller
			formulario.append('controller', 'consignação');
			
			//acrescentando ao formulário o parâmetro modo
			formulario.append('modo', 'editar');

			//acrescentando ao formulário o parâmetro ID
			formulario.append('id', id);

			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'router.php', //url onde será enviada a requisição
				data: formulario,
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					//conversão dos dados para JSON
                    json = JSON.parse(dados);
                    
                    //verificando o status
                    if(json.status == 'atualizado'){
                        //mensagem de sucesso
                        mostrarSucesso('Consignação atualizada com sucesso');
                        
                        //listagem dos dados atualizados
                        listar()
                    }else if(json.status == 'erro'){
                        //mensagem de erro
                        mostrarErro('Ocorreu um erro ao atualizar a consignação');
                    }
					
				}
			});
			
		});
	});
</script>

<div class="form_container">
	<img class="fechar" src="../imagens/fechar.png" onclick="fecharModal()">
	<form class="frmAvaliacao" method="POST" data-id="<?php echo($id) ?>" id="frmConsignacao" name="frmConsignacao">	
		<div class="form_linha">
			<label class="lbl_cadastro">
				Valor:
			</label>
			
			<input type="text" name="txtvalor" class="cadastro_input" id="valor">
		</div>
		
		<div class="form_linha">
			<label class="lbl_cadastro">
				Percentual da Loja:
			</label>
			
			<input type="text" name="txtpercentualloja" class="cadastro_input" id="percentualloja">
		</div>

		<div class="form_linha" id="lbl_data">
			<label class="lbl_cadastro">
				Início:
			</label>

			<label class="lbl_cadastro">
				Término:
			</label>
		</div>

		<div class="form_linha" id="input_data">
			<input type="date" class="cadastro_input" name="dtinicio" id="dtinicio">
			
			<input type="date" class="cadastro_input" name="dttermino" id="dttermino">
		</div>
		
		<div class="form_linha" id="btn_linha">
			<input type="submit" class="sub_btn" value="ENVIAR">
		</div>
	</form>
</div>