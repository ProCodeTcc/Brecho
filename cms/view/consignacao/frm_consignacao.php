<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$preco = $_POST['preco'];
	}
?>

<script>
	var url = '../../';

	$(document).ready(function(){
		// $('#frmAvaliacao').submit(function(e){
		// 	e.preventDefault();

		// 	var tipoCliente = $('#frmAvaliacao').data('tipocliente');
		// 	var idProduto = $('#frmAvaliacao').data('idproduto');
		// 	var idCliente = $('#frmAvaliacao').data('idcliente');
		// 	var negocio = $('input[name=txttipo]:checked').val()
		// 	var formulario = new FormData($('#frmAvaliacao')[0]);

		// 	formulario.append('controller', 'avaliação');
		// 	formulario.append('tipoCliente', tipoCliente);
		// 	formulario.append('idProduto', idProduto);
		// 	formulario.append('idCliente', idCliente);
			
		// 	if(negocio == 'consignado'){
		// 		formulario.append('modo', 'consignado');
		// 	}else{
		// 		formulario.append('modo', 'compra');
		// 	}

		// 	$.ajax({
		// 		type: 'POST',
		// 		url: url+'router.php',
		// 		data: formulario,
		// 		cache: false,
        //         contentType: false,
        //         processData: false,
        //         async: true,
		// 		success: function(dados){
		// 			alert(dados);
		// 		}
		// 	});
			
		// });
	});
</script>

<div class="form_container">
	<img class="fechar" src="../imagens/fechar.png">
	<form class="frmAvaliacao" method="POST" data-id="<?php echo($id) ?>" id="frmAvaliacao" name="frmAvaliacao">	
		<div class="form_linha">
			<label class="lbl_cadastro">
				Valor:
			</label>
			
			<input type="text" name="txtvalor" class="cadastro_input" id="valor" value="<?php echo($preco) ?>" readonly>
		</div>
		
		<div class="form_linha">
			<label class="lbl_cadastro">
				Percentual da Loja:
			</label>
			
			<input type="text" name="txtpercentualloja" class="cadastro_input" id="percentualloja" value="50" onBlur="calcularPercentual()">
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