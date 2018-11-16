<script>
	var url = '../../';
	
	$(document).ready(function(){
		mudarModal('500', '400');

        //função no submit do form
		$('#frmEmail').submit(function(e){
			//desativando o submit do formulário
			e.preventDefault();

            //armazenando o formulario em uma variável
            var formulario = new FormData($('#frmEmail')[0]);
            
            //setando o modo
            formulario.set('modo', 'enviarEmail');
            
            //setando a controller
            formulario.set('controller', 'retirada');
    
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
                    if(json.status == 'enviado'){
                        //mensagem de sucesso
                        mostrarSucesso('E-mail enviado com sucesso');
                        
                        //listagem dos dados
                        listar();
                    }else if(json.status == 'erro'){
                        //mensagem de erro
                        mostrarErro('Não foi possível enviar o e-mail');
                    }
				}
			});
		});
	});
</script>

<div class="form_container">
	<img class="fechar" src="../imagens/fechar.png" onclick="fecharModal()">
	<form class="frmEmail" id="frmEmail" name="frmEmail">
		<div class="form_linha">
			<label class="lbl_cadastro">
				Assunto:
			</label>
			
			<input type="text" name="txtassunto" class="cadastro_input" id="txtcliente">
		</div>
		
		<div class="form_linha">
			<label class="lbl_cadastro">
				Email:
			</label>
			
			<input type="text" name="txtemail" class="cadastro_input" id="txtemail" readonly>
		</div>
        
        <div class="form_linha">
			<label class="lbl_cadastro">
				Email:
			</label>
			
			<textarea class="txtdesc" name="txtmsg" id="txtmsg"></textarea>
		</div>
		
		<div class="form_linha" id="btn_linha">
			<input type="submit" class="sub_btn" value="CADASTRAR">
		</div>
	</form>
</div>