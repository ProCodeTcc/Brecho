<script>
	$('.txt_cep').blur(function(){
			var cep = $('.txt_cep').val();
			$('.txtlogradouro').val('...');
			$('.txtbairro').val('...');
			$('.txtestado').val('...');
			$('.txtcidade').val('...');

			$.getJSON("https://viacep.com.br/ws/"+cep+"/json/", function(dados){
				$('.txtlogradouro').val(dados.logradouro);
				$('.txtbairro').val(dados.bairro);
				$('.txtestado').val(dados.uf);
				$('.txtcidade').val(dados.localidade);
			});
		});
</script>

<div id="erro_campo"></div>
<form method="POST" action="../router.php?controller=ClienteFisico&modo=cadastrar" id="fisico">
	<div class="titulo_cadastro_usuario_meio">
		Nome*
	</div>
	<div class="titulo_cadastro_usuario_meio">
		Sobrenome*
	 </div>

	<div class="linha_cadastro_usuario_meio">
		<input class="campo_cadastro_usuario_meio" type="text" name="txtNome" required onkeypress="return validar(event,'number')">
	</div>

	<div class="linha_cadastro_usuario_meio">
		<input class="campo_cadastro_usuario_meio" type="text" name="txtSobrenome" required onkeypress="return validar(event,'number')">
	</div>

	<div class="titulo_cadastro_usuario">
		E-mail*
	</div>
	<div class="linha_cadastro_usuario">
		<input class="campo_cadastro_usuario" type="email" name="txtEmail" onBlur="checkDados('ClienteFisico', 'Email', this)" required>
	</div>

	<div class="titulo_cadastro_usuario_meio">
		Usuario*
	</div>
	<div class="titulo_cadastro_usuario_meio">
		Senha*
	</div>

	<div class="linha_cadastro_usuario_meio">
		<input class="campo_cadastro_usuario_meio" type="text" name="txtUsuario" onBlur="checkDados('ClienteFisico', 'Usuario', this)" required>
	</div>

	<div class="linha_cadastro_usuario_meio">
		<input class="campo_cadastro_usuario_meio" type="password" name="txtSenha" required>
	</div>
	<div class="titulo_cadastro_usuario_meio">
		Data de Nascimento*
	</div>

	<div class="titulo_cadastro_usuario_meio">
		CPF*
	</div>

	<div class="linha_cadastro_usuario_meio">
		<input class="campo_cadastro_usuario_meio" type="date" name="txtDataNasc" required>
	</div>
	<div class="linha_cadastro_usuario_meio">
		<input id="txt_cpf" class="campo_cadastro_usuario_meio" type="text" name="txtCpf"required onBlur="checkDados('ClienteFisico', 'Cpf', this)" onkeypress="return validar(event,'caracter')">
		<script type="text/javascript">$("#txt_cpf").mask("000.000.000-00");</script>
	</div>


	<div class="titulo_cadastro_usuario_meio">
		Telefone*
	</div>
	 <div class="titulo_cadastro_usuario_meio">
		Celular
	</div>

	<div class="linha_cadastro_usuario_meio">
		<input id="txt_telefone" class="campo_cadastro_usuario_meio" type="text" name="txtTelefone"required onkeypress="return validar(event,'caracter')">
		<script type="text/javascript">$("#txt_telefone").mask("(00) 0000-0000");</script>
	</div>

	<div class="linha_cadastro_usuario_meio">
		<input id="txt_celular" class="campo_cadastro_usuario_meio" type="text" name="txtCelular"onkeypress="return validar(event,'caracter')">
		<script type="text/javascript">$("#txt_celular").mask("(00) 00000-0000");</script>
	</div>

	<div class="titulo_cadastro_usuario_meio">
		Sexo*
	 </div>


	<div class="linha_cadastro_usuario">
		<label>
			<input type="radio" class="radio_sexo" name="rb_sexo" checked value="M"> Masculino
		</label>

		<label>
			<input type="radio" class="radio_sexo" name="rb_sexo" value="F"> Feminino
		</label>

	</div>


	<div class="titulo_cadastro_usuario_meio">
		CEP*
	</div>

	<div class="titulo_cadastro_usuario_meio">
		Bairro*
	</div>

	<div class="linha_cadastro_usuario_meio">
		<input class="campo_cadastro_usuario_meio txt_cep" type="text" onkeypress="return validar(event,'caracter')" name="txtCep">
		<script type="text/javascript">$(".txt_cep").mask("00000-000");</script>
	</div>

	<div class="linha_cadastro_usuario_meio">
		<input type="text" class="campo_cadastro_usuario txtbairro" id="txtbairro" name="txtbairro">
	</div>


	<div class="titulo_cadastro_usuario">
		Logradouro*
	</div>

	<div class="linha_cadastro_usuario">
		<input class="campo_cadastro_usuario txtlogradouro" id="txtlogradouro" type="text" name="txtLogradouro">
	</div>

	<div class="titulo_cadastro_usuario_meio">
		Estado*
	 </div>

	<div class="titulo_cadastro_usuario_meio">
		Cidade*
	</div>

	<div class="linha_cadastro_usuario_meio">
		<input  class="campo_cadastro_usuario_meio txtestado" type="text" id="txtestado" name="txtEstado">
	</div>

	<div class="linha_cadastro_usuario_meio">
		<input class="campo_cadastro_usuario_meio txtestado"  type="text" id="txtcidade" name="txtCidade">
	</div>

	<div class="titulo_cadastro_usuario_meio">
		Nº*
	</div>

	<div class="titulo_cadastro_usuario_meio">
		Complemento
	</div>

	<div class="linha_cadastro_usuario_meio">
		<input  class="campo_cadastro_usuario_meio" type="text" name="txtNumero">
	</div>

	<div class="linha_cadastro_usuario_meio">
		<input  class="campo_cadastro_usuario_meio" type="text" name="txtComplemento">
	</div>

	<div class="linha_cadastro_usuario_botao">
			<input class="botao_cadastro" type="submit" value="Cadastrar">
	</div>
</form>