<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = "";
	}
?>

<script>
	var url = '../../';
	
	//função que exibe os dados no formulário
	function exibirDados(id){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'router.php', //url onde será enviada a requisição
			data: {id:id, modo: 'buscar', controller: 'promoção'}, //parâmetros enviados
			success: function(dados){
				//conversão dos dados para json
				json = JSON.parse(dados);
				
				//colocandoos valores nas caixas de texto
				$('#txtpreco').val(json.preco);
				$('#txtdesconto').val(json.percentualDesconto);
				$('#dtinicio').val(json.dataInicial);
				$('#dttermino').val(json.dataFinal);
			}
		});
	}
	
	//função que calcula o novo valor, com o percentual de desconto
	function calcularDesconto(){
		var preco = $('#txtpreco').val();
		var percentual = $('#txtdesconto').val();
		
		if(percentual == 0){
			alert('insira um valor válido de desconto!!');
		}else{
			var desconto = (percentual/100)*preco;
			var total = preco-desconto;

			$('#novo').show();
			$('#novovalor').val(total);
			mudarModal('440', '400');
		}
	}
	
	$(document).ready(function(){
		mudarModal('370', '400');
		var id = $('#frmPromocao').data('id');
		
		exibirDados(id);
		
		$('.fechar').click(function(){
			$('.container_modal').fadeOut(400);
		});
		
		$('#frmPromocao').submit(function(e){
			e.preventDefault();
			var formulario = new FormData($('#frmPromocao')[0]);
			formulario.append('id', id);
			formulario.append('modo', 'inserir');
			formulario.append('controller', 'promoção');
			
			$.ajax({
				type: 'POST',
				url: url+'router.php',
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
                        mostrarSucesso('Promoção cadastrada com sucesso');
                    }else if(json.status == 'erro'){
                        //mensagem de erro
                        mostrarErro('Ocorreu um erro ao efetuar o cadastro');
                    }
				}
			});
		});
	});
</script>

<img class="fechar" src="../imagens/delete.png">
<div class="form_container">
	<form method="post" id="frmPromocao" data-id="<?php echo($id) ?>" class="frmPromocao" name="frmPromocao">
		<div class="form_linha">
			<label>
				Valor atual:
			</label>
			
			<input type="text" name="preco" class="cadastro_input" id="txtpreco" disabled>
		</div>
		
		<div class="form_linha">
			<label>
				% de desconto:
			</label>
			
			<input type="number" name="desconto" class="cadastro_input" id="txtdesconto" required>
		</div>
		
		<div class="form_linha" id="novo">
			<label>
				Novo valor:
			</label>
			
			<input type="text" class="cadastro_input" id="novovalor" disabled>
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
			<input type="date" class="cadastro_input" name="dtinicial" id="dtinicio">
			
			<input type="date" class="cadastro_input" name="dtfinal" id="dttermino">
        </div>
		
		<div class="form_linha">
			<input type="button" class="sub_btn" value="CALCULAR" onClick="calcularDesconto()">
			<input type="submit" class="sub_btn" value="ENVIAR">
        </div>
	</form>
</div>