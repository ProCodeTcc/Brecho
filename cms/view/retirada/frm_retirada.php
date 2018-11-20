<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
	var url = '../../';
	
	//função para exibir as lojas no formulário
	function exibirLoja(){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php',
			data: {controller: 'retirada', modo: 'listarLojas'}, //parâmetros enviados
			success: function(dados){
				//conversão dos dados pra JSON
				json = JSON.parse(dados);
				
				//percorrendo os dados
				for(var i = 0; i < json.length; i++){
					//criando options com os dados
					$('#txtunidade').append(new Option(json[i].nomeUnidade, json[i].idUnidade));
				}
				
			}
		});
	}
	
	//função para exibir os pedidos no formulário
	function exibirPedido(){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {controller: 'retirada', modo: 'listarPedidos'}, //parâmetros enviados
			success: function(dados){
				//conversão dos dados para JSON
				json = JSON.parse(dados);
				
				//percorrendo os dados
				for(var i = 0; i < json.length; i++){
					//criando options com os dados
					$('#txtpedido').append(new Option('Pedido Nº ' + json[i].idPedidoVenda, json[i].idPedidoVenda))
				}
				
			}
		});
	}
	
	//função para exibir os dados no formulário para edição
	function exibirDados(id){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {id:id, controller: 'retirada', modo: 'buscar'}, //parâmetros enviados
			success: function(dados){
				//conversão dos dados para json
				json = JSON.parse(dados);
                $('.sub_btn').val('ATUALIZAR');
				
				//resgatando os valores das caixas de texto
				$('#txtpedido').val(json.idPedido);
				$('#txtunidade').val(json.idUnidade);
				$('#dtretirada').val(json.dataRetirada);
			}
		});
	}
    
    //função para pegar os dados do cliente
    function selecionarPedido(){
        //resgatando o valor do pedido
        var pedido = $('#txtpedido').val();
        
        $.ajax({
           type: 'POST', //tipo de requisição
            url: url+'router.php', //url onde será enviada a requisição
            data: {controller: 'retirada', modo: 'listarCliente', pedido:pedido}, //dados enviados
            success: function(dados){
                //conversão dos dados para JSON
                json = JSON.parse(dados);
                
                //preenchendo as caixas de texto
               $('#txtcliente').val(json.nome);
               $('#frmRetirada').attr('data-email', json.email);
            }
        });
    }
    
    //função para abrir o form de email
    function enviarEmail(){
        //resgatando o email do cliente
        var email = $('#frmRetirada').attr('data-email');
        
        //limpando a modal
        $('.modal').empty();
        
        $.ajax({
           type: 'POST', //tipo de requisição
            url: 'frm_email.php', //url onde será enviada a requisição
            data: {email:email}, //parâmetros enviados
            success: function(dados){
                //jogando os dados na modal
                $('.modal').html(dados);
                
                //colocando o email no input
                $('#txtemail').val(email);
            }
        });
    }
	
	$(document).ready(function(){
		mudarModal('500', '400');
		//resgatando o ID
		var id = $('#frmRetirada').data('id');
		
		//exibindo as lojas
		exibirLoja();
		
		//exibindo os pedidos
		exibirPedido();
		
		//verificando se o ID é diferente de nulo
		if(id != ""){
			//exibindo os dados
			exibirDados(id);
		}
		
		$('#frmRetirada').submit(function(e){
			//desativando o submit do formulário
			e.preventDefault();
			
			//armazenando o formulário em uma variável
			var formulario = new FormData($('#frmRetirada')[0]);
			
			//acrescentando ao formulário o parâmetro retirada
			formulario.append('controller', 'retirada');
			
			//verificando se o id é nulo
			if(id == ""){
				//se for, acrescenta ao formulário o modo inserir
				formulario.append('modo', 'inserir');
			}else{
				//caso contrário, acrescenta o modo editar
				formulario.append('modo', 'editar');
				
				//acrescentando o ID ao formulário
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
                    if(json.status == 'marcado' || json.status == 'atualizado'){
                        //abrindo form do email
                        enviarEmail();
                    }else if(json.status == 'erro'){
                        //mensagem de erro
                        mostrarErro('Ocorreu um erro ao marcar a retirada');
                    }
				}
			});
		});
	});
</script>

<img class="fechar" src="../imagens/fechar.png" onclick="fecharModal()">
<div class="form_container">
	<form class="frmRetirada" data-id="<?php echo($id) ?>" id="frmRetirada" name="frmRetirada">
		<div class="form_linha">
			<label class="lbl_cadastro">
				Pedido:
			</label>
			
			<select class="cadastro_select" name="txtpedido" id="txtpedido" required onchange="selecionarPedido()">
			</select>
		</div>
		
		<div class="form_linha">
			<label class="lbl_cadastro">
				Cliente:
			</label>
			
			<input type="text" name="txtcliente" class="cadastro_input" id="txtcliente" disabled>
		</div>
		
		<div class="form_linha">
			<label class="lbl_cadastro">
				Loja:
			</label>
			
			<select class="cadastro_select" name="txtunidade" id="txtunidade" required>
			</select>
		</div>
		
		<div class="form_linha">
			<label class="lbl_cadastro">
				Data:
			</label>
			
			<input type="date" name="dtretirada" class="cadastro_input" id="dtretirada" onBlur="validarData('#dtretirada')" required>
		</div>
		
		<div class="form_linha" id="btn_linha">
			<input type="submit" class="sub_btn" value="MARCAR">
		</div>
	</form>
</div>