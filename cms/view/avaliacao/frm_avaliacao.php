<?php
	if(isset($_POST['id'])){
        //resgatando o ID do produto
		$idProduto = $_POST['id'];
        
        //resgatando o ID do cliente
		$idCliente = $_POST['idCliente'];
        
        //resgatando o preço
		$preco = $_POST['preco'];
        
        //resgatando o tipo do cliente
		$tipoCliente = $_POST['tipoCliente'];
	}
?>

<script>
	var url = '../../';

	$(document).ready(function(){
        //mudando o tamanho da modal
        mudarModal('350', '500');
        
        //função na troca de opção do radio
		$('.txttipo').change(function(){
            //resgatando o tipo de negócio
			var tipo = $('input[name=txttipo]:checked').val();

            //verificando o tipo de negócio
			if(tipo == 'consignado'){
                //ajustando o tamanho da janela
                mudarModal('460', '500');
                
                //mostra as opções de consignação
				$('#consignacao').show();
			}else{
                //esconde as opções
				$('#consignacao').hide();
			}
		});

        //ação no submit do formulário
		$('#frmAvaliacao').submit(function(e){
            //previnindo o submit do form
			e.preventDefault();

            //resgatando os dados
			var tipoCliente = $('#frmAvaliacao').data('tipocliente');
			var idProduto = $('#frmAvaliacao').data('idproduto');
			var idCliente = $('#frmAvaliacao').data('idcliente');
			var negocio = $('input[name=txttipo]:checked').val()
			var formulario = new FormData($('#frmAvaliacao')[0]);

            //acrescentando o parâmetro controller ao form
			formulario.append('controller', 'avaliação');
            
            //acrescentando o tipo do cliente
			formulario.append('tipoCliente', tipoCliente);
            
            //acrescentando o id do produto
			formulario.append('idProduto', idProduto);
            
            //acrescentando o ID do cliente
			formulario.append('idCliente', idCliente);
			
            //verificando o tipo do negócio
			if(negocio == 'consignado'){
                //atribuindo o modo como consignado
				formulario.append('modo', 'consignado');
			}else{
                //atribuindo o modo como compra
				formulario.append('modo', 'compra');
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
                    
                    //verificando qual o tipo de negócio
                    if(negocio == 'consignado'){
                        //verificando se deu certo
                        if(json.status == 'sucesso'){
                            //mensagem de sucesso
                            mostrarSucesso('Produto enviado para consignação');
                            listar();
                        }else{
                            //mensagem de erro
                            mostrarErro('Ocorreu um erro ao realizar essa operação')
                        }
                    }else{
                        if(json.status == 'sucesso'){
                            //mensagem de sucesso
                            mostrarSucesso('Operação realizada com sucesso');
                            listar();
                        }else if(json.status == 'erro'){
                            //mensagem de erro
                            mostrarErro('Ocorreu um erro ao realizar essa operação');
                        }
                    }
				}
			});
			
		});
	});
</script>

<div class="form_container">
	<img class="fechar" src="../imagens/fechar.png" onclick="fecharModal()">
	<form class="frmAvaliacao" method="POST" data-idProduto="<?php echo($idProduto) ?>" data-idCliente="<?php echo($idCliente) ?>" data-tipoCliente="<?php echo($tipoCliente) ?>" id="frmAvaliacao" name="frmAvaliacao">	
		<div class="form_linha">
			<label class="lbl_cadastro">
				Valor:
			</label>
			
			<input type="text" name="txtvalor" class="cadastro_input" id="valor" value="<?php echo($preco) ?>" readonly>
		</div>
		
		<div class="form_linha">
			<label class="lbl_cadastro">
				Tipo de Negócio:
			</label>
			
			<div class="radio">
				<label for="masculino">Consignação</label>
				<input type="radio" class="txttipo" name="txttipo" id="masculino" value="consignado">
				
				<label for="feminino">Compra</label>
				<input type="radio" class="txttipo" name="txttipo" id="feminino" value="compra">
			</div>
		</div>
		
		<div id="consignacao">
			<div class="form_linha">
				<label class="lbl_cadastro">
					Percentual da Loja:
				</label>
				
				<input type="text" name="txtpercentualloja" class="cadastro_input" id="percentualloja" value="50" onBlur="calcularPercentual()">
			</div>
			
			<div class="form_linha" style="display: none;">
				<label class="lbl_cadastro">
					Percentual do Cliente:
				</label>
				
				<input type="text" name="txtpercentualcliente" class="cadastro_input" id="percentualcliente" readonly>
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
		</div>
		
		<div class="form_linha" id="btn_linha">
			<input type="submit" class="sub_btn" value="ENVIAR">
		</div>
	</form>
</div>