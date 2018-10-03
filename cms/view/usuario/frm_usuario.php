<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
    var url = '../../';
	
	//função para exibir os dados
	function exibirDados(idItem){
		$.ajax({
			type: 'POST',
			url: url+'/router.php',
			data: {modo: 'buscar', id:idItem, controller: 'usuario'},
			success: function(dados){
				//convertento os dados recebidos para o formato JSON
				json = JSON.parse(dados);

				//colocando esses valores na caixa de texto
				$('#frmImagem').data('id', json.idUsuario);
				$('#txtnome').val(json.nomeUsuario);
				$('#txtusuario').val(json.login);
				$('#txtnivel').val(json.idNivel);

				//checando se a imagem está vazia, se não, preencher a div de visualizar
				if(json.imagem != 0){
					$('#img').attr('src', json.imagem);
					$('#txtimagem').val(json.imagem)
				}
			}
		});
	}
	
    $(document).ready(function(){
		//resgatando o id do usuario
		var idUsuario = $('#frmUsuario').data('id');
		
		//se o id do usuario for diferente de nulo, significa que é para exibir os dados para edição
		if(idUsuario != ""){
			exibirDados(idUsuario);
		}
		   
        $('.fechar').click(function(){
            $('.container_modal').fadeOut(400);
        });

        $('#imagem').live('change', function(){
            $('#frmImagem').ajaxForm({
                target: '#visualizar'
            }).submit();
        });

        $('#frmUsuario').submit(function(event){
            //resgatando o data-atributo contendo o id do usuário
            var id = $('.frmImagem').data('id');

            //criando uma variavel e armazenando o formulário nela
            var formulario = new FormData($('#frmUsuario')[0]);

            //se a variável usuário for nula, o modo deverá ser de inserir, caso contrário, editar
            if(id == null){
                //acrescentando ao formulário o parâmetro modo;
                formulario.append('modo', 'inserir');
            }else{
                //acrescentando ao formulário o parâmetro modo;
                formulario.append('modo', 'editar');
                formulario.append('id', id);
            }

            event.preventDefault();
            
            //resgatando a imagem
            var imagem = $('#txtimagem').val();

            //acrescentando ao formulário o parâmetro controller
            formulario.append('controller', 'usuario');

            //acrescentando ao formulário o parâmetro txt imagem
            //contendo a imagem;
            formulario.append('txtimagem', imagem);
            
            $.ajax({
                type: 'post',
                url: url+'/router.php',
                data: formulario,
                cache: false,
                contentType: false,
                processData: false,
                async: true,
                success: function(dados){
					alert(dados);
					
					//listando os dados inseridos ou atualizados
					listar();
					
					//insere na tag img o conteúdo da variável imagem
					$('#img_perfil').attr('src', imagem);
					
					//fecha a modal
					$('.container_modal').fadeOut(400);
                }
            });
        });


    });
</script>

<div class="form_container">
    <img class="fechar" src="../imagens/fechar.png">
    <form class="frmImagem" action="upload.php" method="post" id="frmImagem" name="frmImagem" enctype="multipart/form-data">
        <div id="visualizar">
            <label for="imagem" title="clique aqui para selecionar uma imagem">
                <img id="img" src="../imagens/user.png">
            </label>

            <input type="file" id="imagem" name="fleimagem">
        </div>
    </form>

    <form class="frm_cadastro" data-id="<?php echo($id)?>" id="frmUsuario" method="post" name="frmUsuario" action="usuario_view.php">
        <div class="form_row">
            <label class="lbl_cadastro">Nome:</label>
            <input type="text" class="cadastro_input" id="txtnome" name="txtnome" required>
            <input type="hidden" name="txtimagem" id="txtimagem">
        </div>

        <div class="form_row">
            <label class="lbl_cadastro">Usuário:</label>
            <input type="text" class="cadastro_input" id="txtusuario" name="txtusuario" required>
        </div>

        <div class="form_row">
            <label class="lbl_cadastro">Nivel:</label>
            <select class="select_cadastro" id="txtnivel" name="txtnivel">
            
        <?php
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
            require_once($diretorio.'/controller/controllerUsuario.php');
            $listNiveis = new controllerUsuario();
            $rsNiveis = $listNiveis->listarNiveis();
            $cont = 0;
            while($cont < count($rsNiveis)){
        ?>
                <option value="<?php echo($rsNiveis[$cont]->getNivel())?>">
                    <?php echo($rsNiveis[$cont]->getNomeNivel())?>
                </option>
                
        <?php
            $cont++;
            }
        ?>
            </select>
        </div>

        <div class="form_row">
            <label class="lbl_cadastro">Senha:</label>
            <input type="password" class="cadastro_input" name="txtsenha" id="txtsenha" required>
        </div>

        <div class="form_row">
            <button class="page_btn" type="submit">CADASTRAR</button>
        </div>
    </form>
</div>