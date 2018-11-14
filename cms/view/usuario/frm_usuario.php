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
				$('#txtnome').val(json.nomeUsuario);
				$('#txtusuario').val(json.login);
				$('#txtnivel').val(json.idNivel);

				//checando se a imagem não está nula, então preenche a div de visualizar
				if(json.imagem != null){
					$('#img').attr('src', '../arquivos/'+json.imagem);
					$('#frmUsuario').data('imagem', json.imagem);
				}
			}
		});
	}
	
	//função que mostra a prévia da imagem
	function mostrarPrevia(input){
		if(input.files && input.files[0]){
			//criando um novo leitor de arquivos
			var leitor = new FileReader();
			
			//função no momento em que algum arquivo for carregado
			leitor.onload = function(event){
				//colocando a imagem
				$('#img').attr('src', event.target.result);
			}
			
			leitor.readAsDataURL(input.files[0]);
		}
	}
	
	$('#imagem').live('change', function(){
		mostrarPrevia(this);
	});
	
    $(document).ready(function(){
        mudarModal('500', '400');
        
		//resgatando o id do usuario
		var idUsuario = $('#frmUsuario').data('id');
		
		//se o id do usuario for diferente de nulo, significa que é para exibir os dados para edição
		if(idUsuario != ""){
			exibirDados(idUsuario);
		}
		   
        $('#frmUsuario').submit(function(event){
            //criando uma variavel e armazenando o formulário nela
            var formulario = new FormData($('#frmUsuario')[0]);

            //verificando se a imagem está vazia
            if(verificarImagem() == 1){
                //se estiver, mostra uma mensagem
                mostrarInfo('Selecione a imagem');

                //para a execução
                return false;
            }

            //se a variável usuário for nula, o modo deverá ser de inserir, caso contrário, editar
            if(idUsuario == ""){
                //acrescentando ao formulário o parâmetro modo;
                formulario.append('modo', 'inserir');
            }else{
				var imagem = $('#frmUsuario').data('imagem');
                //acrescentando ao formulário o parâmetro modo;
                formulario.append('modo', 'editar');
				
				//acrescentando ao formulário o parâmetro id
                formulario.append('id', idUsuario);
				
				//acrescentando ao formulário o parâmetro imagem, que irá conter a imagem
				//que já estava, caso não seja alterada
				formulario.append('imagem', imagem);
            }

            event.preventDefault();

            //acrescentando ao formulário o parâmetro controller
            formulario.append('controller', 'usuario');
            
            $.ajax({
                type: 'post',
                url: url+'/router.php',
                data: formulario,
                cache: false,
                contentType: false,
                processData: false,
                async: true,
                success: function(dados){
                    json = JSON.parse(dados);
                    
                    if(json.status == 'sucesso'){
                        mostrarSucesso('Usuario inserido com sucesso!!');

                        //listando os dados inseridos ou atualizados
                        listar();
                        
                        //insere na tag img o conteúdo da variável imagem
                        $('#img_perfil').attr('src', imagem);					
                    }else{
                        mostrarErro('Ocorreu um erro ao inserir o usuário');
                    }

                    if(json.status == 'atualizado'){
                        mostrarSucesso('Usuario atualizado com sucesso!!');

                        //listando os dados inseridos ou atualizados
                        listar();
                        
                        //insere na tag img o conteúdo da variável imagem
                        $('#img_perfil').attr('src', imagem);
                    }else{
                        mostrarErro('Ocorreu um erro ao atualizar o usuário');
                    }
                }
            });
        });


    });
</script>

<div class="form_container">
    <img class="fechar" src="../imagens/fechar.png" onclick="fecharModal()">
    <form class="frm_usuario" data-id="<?php echo($id)?>" id="frmUsuario" method="post" enctype="multipart/form-data" name="frmUsuario" action="usuario_view.php">
		<div id="visualizar">
            <label for="imagem" title="clique aqui para selecionar uma imagem">
                <img id="img" src="../imagens/user.png">
            </label>

            <input type="file" id="imagem" name="fleimagem">
        </div>
		
		<div class="form_linha">
            <label class="lbl_cadastro">Nome:</label>
            <input type="text" class="cadastro_input" id="txtnome" name="txtnome" placeholder="Insira um nome" required>
            <input type="hidden" name="txtimagem" id="txtimagem">
        </div>

        <div class="form_linha">
            <label class="lbl_cadastro">Usuário:</label>
            <input type="text" class="cadastro_input" id="txtusuario" name="txtusuario" placeholder="Insira um usuário" required>
        </div>

        <div class="form_linha">
            <label class="lbl_cadastro">Nivel:</label>
            <select class="cadastro_select" id="txtnivel" name="txtnivel">
            
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

        <div class="form_linha">
            <label class="lbl_cadastro">Senha:</label>
            <input type="password" class="cadastro_input" name="txtsenha" id="txtsenha" placeholder="Insira uma senha" required>
        </div>

        <div class="form_linha" id="btn_linha">
            <button class="sub_btn" type="submit">CADASTRAR</button>
        </div>
    </form>
</div>