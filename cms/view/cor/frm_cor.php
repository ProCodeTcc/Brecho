<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
	url = '../../';
	
	//função que exibe os dados no formulário
	function exibirDados(id){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {id:id, modo: 'buscar', controller: 'cor'}, //parâmetros enviados
			success: function(dados){
				//convertendo os dados para json
				json = JSON.parse(dados);
				
				//colocando os valores nas caixas de texto
				$('#txtnome').val(json.nome);
				$('#txtcor').val(json.cor);
			}
		});
	}
	
	$(document).ready(function(){
		mudarModal('400','400');
		var id = $('#frmCor').data('id');
		
		if(id != ""){
			exibirDados(id);
		}
		
		$('#frmCor').submit(function(e){
			e.preventDefault();
			var formulario = new FormData($('#frmCor')[0]);
			formulario.append('controller', 'cor');
			
			if(id == ""){
				formulario.append('modo', 'inserir');
			}else{
				formulario.append('modo', 'editar');
				formulario.append('id', id);
			}
			
			$.ajax({
				type: 'POST',
				url: url+'/router.php',
				data: formulario,
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					//conversão dos dados para JSON
                    json = JSON.parse(dados);
                    
                    //verificando o status
                    if(json.status == 'sucesso'){
                        //mensagem de sucesso
                        mostrarSucesso('Cor inserida com sucesso');
                    }else if(json.status == 'existe'){
                        //menasgem de informação
                        mostrarInfo('Essa cor já existe no sistema');
                    }else if(json.status == 'atualizado'){
                        //mensagem de sucesso
                        mostrarSucesso('Cor atualizada com sucesso');
                    }else if(json.status == 'erro'){
                        //mensagem de erro
                        mostrarErro('Ocorreu um erro ao realizar a operação');
                    }
				}
			});
		});
	});
</script>

<img class="fechar" src="../imagens/delete.png" onclick="fecharModal()">
<div class="form_container">
	<form class="frm_cor" data-id="<?php echo($id) ?>" id="frmCor" name="frm_cor">
		<div class="form_linha">
			<label class="lbl_cadastro">
				Nome:
			</label>
			
			<input type="text" class="cadastro_input" name="txtnome" id="txtnome">
		</div>
		
		<div class="form_linha">
			<label class="lbl_cadastro" id="lbl_cor">
				Cor:
			</label>
			
			<input type="color" name="txtcor" class="cadastro_cor" id="txtcor">
		</div>
		
		<div class="form_linha" id="btn_linha">
			<input type="submit" class="sub_btn" value="CADASTRAR">
		</div>
	</form>
</div>