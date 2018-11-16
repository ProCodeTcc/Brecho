<script>
	
	//função que exibe os dados pra edição
	function exibirDados(id){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: '../router.php?controller=ClienteJuridico&modo=buscar',
			data: {id:id}, //dados enviados
			success: function(dados){
				//conversão dos dados pra JSON
				json = JSON.parse(dados);
				
				//resgatando os valores das caixas de texto
				$('#txtrazao').val(json.razao);
				$('#txtemail').val(json.email);
				$('#txtsenha').val(json.senha);
				$('#txttelefone').val(json.telefone);
				$('#txtcelular').val(json.celular);
				$('#txtcnpj').val(json.cnpj);
				$('#txtdata').val(json.dataNascimento);
				$('#txt_cep').val(json.cep);
				$('#txtbairro').val(json.bairro);
				$('#txtcidade').val(json.cidade);
				$('#txtestado').val(json.estado);
				$('#txtlogradouro').val(json.logradouro);
				$('#txtnumero').val(json.numero);
				$('#txtcomplemento').val(json.complemento);
				$('#frmAtualizar').data('idEndereco', json.idEndereco);
			}
		});
	}
	
	$(document).ready(function(){
		var id = $('#frmAtualizar').data('id');
		
		if(id != ""){
			exibirDados(id);
		}
		
		//função no momento em que o foco sai do campo do CEP
		$('#txt_cep').blur(function(){
			//resgatando valor do CEP
			var cep = $('#txt_cep').val();

			//loading enquanto faz a consulta
			$('#txtbairro').val('...');
			$('#txtlogradouro').val('...');
			$('#txtestado').val('...');
			$('#txtcidade').val('...');

			//consultando a API do viacep
			$.getJSON('https://viacep.com.br/ws/'+cep+'/json/', function(dados){
				//colocando os dados do CEP na caixa de texto
				$('#txtbairro').val(dados.bairro);
				$('#txtlogradouro').val(dados.logradouro);
				$('#txtestado').val(dados.uf);
				$('#txtcidade').val(dados.localidade);
			});

		});
		
		$('#frmAtualizar').submit(function(e){
			//desativando submit do botão
			e.preventDefault();
			
			//armazenando o ID do endereço em uma variável
			var idEndereco = $('#frmAtualizar').data('idEndereco');
			
			//armazenando o formulário em uma variável
			var formulario = new FormData($('#frmAtualizar')[0]);
			
			//acrescentando ao formulário o ID do cliente
			formulario.append('id', id);
			
			//acrescentando ao formulário o ID do endereço
			formulario.append('idEndereco', idEndereco);
			
			$.ajax({
				type: 'POST', //tipo de requisição
				url: '../router.php?controller=ClienteJuridico&modo=atualizar', //url onde será enviada requisição
				data: formulario, //dados envidos
				cache: false,
				contentType: false,
				processData: false,
				async: true,
				success: function(dados){
					//conversão dos dados para JSNO
					json = JSON.parse(dados);
                    
                    //verificando o status
                    if(json.status == 'atualizado'){
                        //mensagem de sucesso
                        mostrarSucesso('Dados atualizados com sucesso');
                    }else{
                        //mensagem de erro
                        mostrarErro('Ocorreu um erro ao atualizar os dados');
                    }
				}
			});
		});
	});
</script>

<div class="caixa_atualizar_dados">
	<div class="titulo_atualizar">
		Atualizar Informações da Conta 
	</div>

	<form method="POST" id="frmAtualizar" name="frmAtualizar" class="atualizar" data-id="<?php echo($id) ?>">
		<div class="informacao_conta">
			 <div class="titulo_cadastro_usuario">
				E-mail*
			</div>
			<div class="linha_cadastro_usuario">
				<input class="campo_cadastro_usuario" type="email" id="txtemail" name="txtemail">
			</div>

			 <div class="titulo_cadastro_usuario">
				Senha*
			</div>

			<div class="linha_cadastro_usuario">
				<input class="campo_cadastro_usuario" type="password" name="txtsenha" id="txtsenha">
			</div>
		</div>

		<div class="titulo_atualizar">
			Atualizar Informações Pessoais 
		</div>

		<div class="informacao_conta">
			<div class="titulo_cadastro_usuario">
				Razão Social*
			</div>
			<div class="linha_cadastro_usuario">
				<input class="campo_cadastro_usuario" type="text" name="txtrazao" id="txtrazao" required onkeypress="return validar(event,'number')">
			</div>

			 <div class="titulo_cadastro_usuario_meio">
				Telefone*
			</div>
			 <div class="titulo_cadastro_usuario_meio">
				Celular
			</div>

			<div class="linha_cadastro_usuario_meio">
				<input class="campo_cadastro_usuario_meio" type="text" name="txttelefone" id="txttelefone" required onkeypress="return validar(event,'caracter')">
			</div>

			<div class="linha_cadastro_usuario_meio">
				<input class="campo_cadastro_usuario_meio" type="text" name="txtcelular" id="txtcelular" required onkeypress="return validar(event,'caracter')">
			</div>



			<div class="titulo_cadastro_usuario_meio">
				cnpj*
			 </div>



			<div class="titulo_cadastro_usuario_meio">
				Data de Nascimento*
			 </div>

			<div class="linha_cadastro_usuario_meio">
				<label>
					<input id="txtcnpj" class="campo_cadastro_usuario_meio" type="text" name="txtcnpj"required onkeypress="return validar(event,'caracter')">
					<script type="text/javascript">$("#txtcnpj").mask("00.000.000/0000-00");</script>
				</label>      
			</div>


			<div class="linha_cadastro_usuario_meio">
				<input  class="campo_cadastro_usuario_meio" type="date" name="txtdata" id="txtdata">
			</div>

		</div>

		<div class="titulo_atualizar">
			Adicionar Cartão 
		</div>

		<div class="informacao_conta">
			 <div class="titulo_cadastro_usuario">
				Nome do Titular*
			</div>
			<div class="linha_cadastro_usuario">
				<input class="campo_cadastro_usuario" type="text" onkeypress="return validar(event,'number')">
			</div>

			<div class="titulo_cadastro_usuario">
				Numero do Cartão*
			</div>
			<div class="linha_cadastro_usuario">
				<input class="campo_cadastro_usuario" type="text" onkeypress="return validar(event,'caracter')">

			</div>
			<div class="titulo_cadastro_usuario_mini">
				Cód de Segurança*
			 </div>

			<div class="titulo_cadastro_usuario_mini">
				Vencimento*
			 </div>

			<div class="titulo_cadastro_usuario_mini">
				Bandeira*
			 </div>

			<div class="linha_cadastro_usuario_mini">
				<input class="campo_cadastro_usuario_mini" type="text" onkeypress="return validar(event,'caracter')" maxlength="4">
			</div>

			<div class="linha_cadastro_usuario_mini">

				<select  class="campo_cadastro_usuario_mini"> 
					<option>01/20</option>
				</select>
			</div>

			<div class="linha_cadastro_usuario_mini">
				 <select  class="campo_cadastro_usuario_mini" >
					 <option>Visa</option>
					 <option>Mastercard</option>
					 <option>Elo</option>
				</select>
			</div>
		</div>

		<div class="titulo_atualizar">
			Atualizar Informações de Endereço 
		</div>
		<div class="informacao_conta">
			<div class="titulo_cadastro_usuario_meio">
				CEP*
			</div>

			<div class="titulo_cadastro_usuario_meio">
				Bairro*
			</div>

			<div class="linha_cadastro_usuario_meio">
				<input id="txt_cep" class="campo_cadastro_usuario_meio" type="text" onkeypress="return validar(event,'caracter')" name="txtcep">
				<script type="text/javascript">$("#txt_cep").mask("00000-000");</script>

			</div>

			<div class="linha_cadastro_usuario_meio">
				<input type="text" class="campo_cadastro_usuario" id="txtbairro" name="txtbairro"onkeypress="return validar(event,'number')">
			</div>


			<div class="titulo_cadastro_usuario">
				Logradouro*
			</div>

			<div class="linha_cadastro_usuario">
				<input class="campo_cadastro_usuario" type="text" name="txtlogradouro" id="txtlogradouro" onkeypress="return validar(event,'number')">
			</div>

			<div class="titulo_cadastro_usuario_meio">
				Estado*
			 </div>

			<div class="titulo_cadastro_usuario_meio">
				Cidade*
			</div>

			<div class="linha_cadastro_usuario_meio">
				<input  class="campo_cadastro_usuario_meio" type="text" name="txtestado" id="txtestado"onkeypress="return validar(event,'number')">
			</div>

			<div class="linha_cadastro_usuario_meio">
				<input class="campo_cadastro_usuario_meio"  type="text" name="txtcidade" id="txtcidade" onkeypress="return validar(event,'number')">
			</div>

			<div class="titulo_cadastro_usuario_meio">
				Nº*
			</div>

			<div class="titulo_cadastro_usuario_meio">
				Complemento
			</div>

			<div class="linha_cadastro_usuario_meio">
				<input  class="campo_cadastro_usuario_meio" type="text" id="txtnumero" name="txtnumero" onkeypress="return validar(event,'caracter')">
			</div>

			<div class="linha_cadastro_usuario_meio">
				<input  class="campo_cadastro_usuario_meio" type="text" id="txtcomplemento" name="txtcomplemento">
			</div>
			<div class="linha_cadastro_usuario_botao">
				<input class="botao_cadastro" type="submit" value="Atualizar">
			</div>

		</div>
	</form>
</div>