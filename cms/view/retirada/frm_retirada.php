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
	
	$(document).ready(function(){
		//exibindo as lojas
		exibirLoja();
		
		//exibindo os pedidos
		exibirPedido();
		
		$('.fechar').click(function(){
			$('.container_modal').fadeOut(400);
		});
		
		$('#frmRetirada').submit(function(e){
			e.preventDefault();
			var formulario = new FormData($('#frmRetirada')[0]);
			formulario.append('controller', 'retirada');
			formulario.append('modo', 'inserir');
			
			$.ajax({
				type: 'POST',
				url: url+'router.php',
				data: formulario,
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					alert(dados)
					listar();
					$('.container_modal').fadeOut(400);
				}
			});
		});
	});
</script>

<div class="form_container">
	<img class="fechar" src="../imagens/fechar.png">
	<form class="frmRetirada" data-id="<?php echo($id) ?>" id="frmRetirada" name="frmRetirada">
		<div class="form_linha">
			<label class="lbl_cadastro">
				Pedido:
			</label>
			
			<select class="cadastro_select" name="txtpedido" id="txtpedido">
	
			</select>
		</div>
		
		<div class="form_linha">
			<label class="lbl_cadastro">
				Produto:
			</label>
			
			<input type="text" name="txtproduto" class="cadastro_input" id="txtproduto" disabled>
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
			
			<select class="cadastro_select" name="txtunidade" id="txtunidade">
			</select>
		</div>
		
		<div class="form_linha">
			<label class="lbl_cadastro">
				Data:
			</label>
			
			<input type="date" name="dtretirada" class="cadastro_input" id="dtretirada">
		</div>
		
		<div class="form_linha" id="btn_linha">
			<input type="submit" class="sub_btn" value="CADASTRAR">
		</div>
	</form>
</div>