<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
	var url = '../../';
	
	function exibirDados(id){
		$.ajax({
			type: 'POST',
			url: url+'router.php',
			data: {id:id, controller: 'tema', modo: 'buscar'},
			success: function(dados){
				json = JSON.parse(dados);
				
				$('#txtnome').val(json.nomeTema);
				$('#txtcor').val(json.corTema);
			}
		});
	}
	
	$(document).ready(function(){
		mudarModal('350','400');
		var id = $('#frmTema').data('id');
		
		if(id != ""){
			exibirDados(id);
		}
		
        //função no submit do form
		$('#frmTema').submit(function(e){
            //desativando o submit
			e.preventDefault();
			
            //armazenando o formulario em uma variável
			var formulario = new FormData($('#frmTema')[0]);
            
            //armazenando a controller 
			formulario.append('controller', 'tema');
			
            //verificando se existe o ID
			if(id == ""){
                //armazenando o modo inserir
				formulario.append('modo', 'inserir');
			}else{
                //armazenando o modo editar
				formulario.append('modo', 'editar');
                
                //armazenando o ID ao form
				formulario.append('id', id);
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
                    //conversão dos dados para JSON
					json = JSON.parse(dados);
                    
                    //verificando o status
                    if(json.status == 'sucesso'){
                        //mensagem de sucesso
                        mostrarSucesso('Tema inserido com sucesso');
                        //listagem dos dados
                        listar();
                    }else if(json.status == 'atualizado'){
                        //mensagem de sucesso
                        mostrarSucesso('Tema atualizado com sucesso');
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
	<form class="frm_tema" data-id="<?php echo($id) ?>" id="frmTema" name="frm_tema">
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
		
		<div class="form_linha">
			<label class="lbl_cadastro">
				Gênero
			</label>
			
			<div class="radio">
				<label for="masculino">Masculino</label>
				<input type="radio" name="txtgenero" id="masculino" value="M">
				
				<label for="feminino">Feminino</label>
				<input type="radio" name="txtgenero" id="feminino" value="F">
			</div>
			
		</div>
		
		<div class="form_linha" id="btn_linha">
			<input type="submit" class="sub_btn" value="CADASTRAR">
		</div>
	</form>
</div>