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
                $('.sub_btn').val('ATUALIZAR');
				
				//colocando os valores nas caixas de texto
				$('#txtnome').val(json.nome);
				$('#txtcor').val(json.cor);
			}
		});
	}
	
	$(document).ready(function(){
        //ajustando a modal
		mudarModal('400','400');
        
        //armazenando o ID
		var id = $('#frmCor').data('id');
		
		if(id != ""){
            //exibindo os dados
			exibirDados(id);
		}
		
        //função no submit do form
		$('#frmCor').submit(function(e){
            //previnindo o submit
			e.preventDefault();
            
            //armazenando o formulário numa variável
			var formulario = new FormData($('#frmCor')[0]);
            
            //atribuindo a controller ao form
			formulario.append('controller', 'cor');
			
            //verificando se existe o ID
			if(id == ""){
                //atribuindo o modo de inserir
				formulario.append('modo', 'inserir');
			}else{
                //atribuindo o modo de edição
				formulario.append('modo', 'editar');
                
                //acrescentando o ID
				formulario.append('id', id);
			}
			
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'/router.php', //url onde será enviada a requisição
				data: formulario, //dados enviados
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