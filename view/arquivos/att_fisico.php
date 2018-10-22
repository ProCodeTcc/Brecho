<script>
	//função que exibe os dados para edição
	function exibirDados(id){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: '../router.php?controller=ClienteFisico&modo=buscar', //parâmetros enviados
			data: {id:id}, //dados enviados
			success: function(dados){
				//conversão dos dados para JSON
				json = JSON.parse(dados);

				//colocando os valores nas caixas de texto
				$("#txtemail").val(json.email);
				$('#txtsenha').val(json.senha);
				$('#txtnome').val(json.nome);
				$('#txtsobrenome').val(json.sobrenome);
				$('#txttelefone').val(json.telefone);
				$('#txtcelular').val(json.celular);
				$('#txtdata').val(json.dataNascimento);
				$('#txt_cep').val(json.cep);
				$('.rbsexo[value='+json.sexo+']').attr('checked', true);
				$('#txtbairro').val(json.bairro);
				$('#txtlogradouro').val(json.logradouro);
				$('#txtestado').val(json.estado);
				$('#txtcidade').val(json.cidade);
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
		$('#txtcep').blur(function(){
			//resgatando valor do CEP
			var cep = $('#txtcep').val();

			//loading enquanto faz a consulta
			$('#txtbairro').val('...');
			$('#txtlogradouro').val('...');
			$('#txtestado').val('...');
			$('#txtcidade').val('...');
			$('#txtnumero').val('...');
			$('#txtcomplemento').val('...');

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
			//desativanto o submit do formulário
			e.preventDefault();

			//resgatando o ID do endereço
			var idEndereco = $('#frmAtualizar').data('idEndereco');

			//armazenando o formulário em uma variável
			var formulario = new FormData($('#frmAtualizar')[0]);

			//armazenando o ID do cliente
			formulario.append('id', id);

			//armazenando o ID do endereço
			formulario.append('idEndereco', idEndereco);

			$.ajax({
				type: 'POST', //tipo de requisição
				url: '../router.php?controller=ClienteFisico&modo=atualizar', //url onde será enviada a requisição
				data: formulario, //dados enviados
				cache: false,
				contentType: false,
				processData: false,
				async: true,
				success: function(dados){
					//mensagem
					alert(dados);
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

			 <div class="titulo_cadastro_usuario_meio">
				Senha*
			</div>
			<div class="titulo_cadastro_usuario_meio">
				Confirme Senha*
			</div>

			<div class="linha_cadastro_usuario_meio">
				<input class="campo_cadastro_usuario_meio" type="password" name="txtsenha" id="txtsenha">
			</div>

			<div class="linha_cadastro_usuario_meio">
				<input class="campo_cadastro_usuario_meio" type="password">
			</div>
		</div>

		<div class="titulo_atualizar">
			Atualizar Informações Pessoais 
		</div>

		<div class="informacao_conta">
			 <div class="titulo_cadastro_usuario_meio">
				Nome*
			</div>
			<div class="titulo_cadastro_usuario_meio">
				Sobrenome*
			 </div>

			<div class="linha_cadastro_usuario_meio">
				<input class="campo_cadastro_usuario_meio" type="text" name="txtnome" id="txtnome" required onkeypress="return validar(event,'number')">
			</div>

			<div class="linha_cadastro_usuario_meio">
				<input class="campo_cadastro_usuario_meio" type="text" name="txtsobrenome" id="txtsobrenome" required onkeypress="return validar(event,'number')">
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
				Sexo*
			 </div>

			<div class="titulo_cadastro_usuario_meio">
				Data de Nascimento*
			 </div>

			<div class="linha_cadastro_usuario_meio">
				<label>
					<input type="radio" class="radio_sexo rbsexo" value="M" name="rb_sexo"> Masculino
				</label>    

				<label>
					<input type="radio" class="radio_sexo rbsexo" value="F" name="rb_sexo"> Feminino
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
				<input class="campo_cadastro_usuario" type="text" required onkeypress="return validar(event,'number')">
			</div>

			<div class="titulo_cadastro_usuario">
				Numero do Cartão*
			</div>
			<div class="linha_cadastro_usuario">
				<input class="campo_cadastro_usuario" type="text"required onkeypress="return validar(event,'caracter')">

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
				<input class="campo_cadastro_usuario_mini" type="text" required onkeypress="return validar(event,'caracter')" maxlength="4">
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
			<div class="linha_atualizar_dados_botao">
				<input class="botao_cadastro" type="submit" value="Atualizar">
                <a href="../view/perfil.php">
                    <input class="botao_voltar" type="button" value="Voltar">
                </a>
			</div>

		</div>
	</form>
</div>