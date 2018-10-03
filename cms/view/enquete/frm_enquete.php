<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
    var url = '../../';
	
	//função que exibe os dados
	function exibirDados(id){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'/router.php', //url para onde será enviada a requisição
			data: {id:id, modo: 'buscar', controller: 'enquete'}, //dados a serem enviados
			success: function(dados){
				//conversão dos dados para JSON
				json = JSON.parse(dados);

				//atribuindo os valores para as caixas de texto
				$('#frm_enquete').data('id', json.idEnquete);
				$('#txtpergunta').val(json.pergunta);
				$('#txttema').val(json.idNivel);
				$('#alternativa_a').val(json.alternativaA);
				$('#alternativa_b').val(json.alternativaB);
				$('#alternativa_c').val(json.alternativaC);
				$('#alternativa_d').val(json.alternativaD);
				$('#dtinicio').val(json.dataInicial);
				$('#dttermino').val(json.dataFinal);
			}
		});
	}
	
    function validarData(){
		var dtInicio = $('#dtinicio').val();
		var dtTermino = $('#dttermino').val();

		if(dtInicio > dtTermino){
			alert("A DATA DE INÍCIO NÃO PODE SER MAIOR QUE A DE TÉRMINO!!");
			$('#dttermino').css('border', '1px solid red');
			return false;
		}
    }
	
    $(document).ready(function(){
		//resgatando o id do formulário e armazenando em uma variável
        var id = $('#frm_enquete').data('id');
		
		if(id != ""){
			exibirDados(id);
		}
		
        $('.fechar').click(function(){
            $('.container_modal').fadeOut(400);
        });

        $('#frm_enquete').submit(function(event){
            //desativando o submit do botão
            event.preventDefault();

            //armazenando os dados do formulário em uma variável
            var formulario = new FormData($('#frm_enquete')[0]);
            
            //atribuindo o id ao formulário
            formulario.append('id', id);
            
            //verificando se o ID é nulo, se sim, atribui á variável modo o parâmetro de inserir
            //caso contráriom atribui o parâmetro de editar
            if(id == ""){
                formulario.append('modo', 'inserir');
            }else{
                formulario.append('modo', 'editar');
            }
            
            //atribuindo a variável controller com o parâmetro enquete
            formulario.append('controller', 'enquete');

            $.ajax({
                type: 'POST', //tipo de requisição
                url: url+'/router.php', //url onde será feita a requisição
                data: formulario, //dados a serem enviados
                cache: false,
                contentType: false,
                processData: false,
                async: true,
                success: function(dados){
                    if(validarData() != false){
                        listar();
                        $('.container_modal').fadeOut(400);
                    }
                }
            });
        });
    });
</script>

<div class="form_container">
    <img class="fechar" src="../imagens/fechar.png">
    <form class="frm_cadastro" data-id="<?php echo($id) ?>" method="post" name="frmEnquete" id="frm_enquete" action="enquete_view.php">
        <div class="form_row">
            <label class="lbl_cadastro">
                Pergunta:
            </label>

            <input type="text" class="cadastro_input" name="txtpergunta" id="txtpergunta">
        </div>

        <div class="form_row">
            <label class="lbl_cadastro">
                Tema:
            </label>

            <select class='select_cadastro' name="txttema" id="txttema">

                <?php
                    $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms';
                    require_once($diretorio.'/controller/controllerEnquete.php');
                    $listTemas = new controllerEnquete();
                    $rsTemas = $listTemas->listarTemas();
                    $cont = 0;
                    while($cont < count($rsTemas)){
                ?>
            
                <option value="<?php echo($rsTemas[$cont]->getIdTema())?>">
                    <?php echo($rsTemas[$cont]->getTema())?>
                </option>

                <?php
                    $cont++;
                    }
                ?>

            </select>
        </div>

        <div class="form_row">
                <label class="lbl_cadastro">
                    Alternativa A:
                </label>

                <input type="text" class="cadastro_input" name="txtalta" id="alternativa_a">

                <label class="lbl_cadastro">
                    Alternativa B:
                </label>

                <input type="text" class="cadastro_input" name="txtaltb" id="alternativa_b">

                <label class="lbl_cadastro">
                    Alternativa C:
                </label>

                <input type="text" class="cadastro_input" name="txtaltc" id="alternativa_c">

                <label class="lbl_cadastro">
                    Alternativa D:
                </label>

                <input type="text" class="cadastro_input" name="txtaltd" id="alternativa_d">
        </div>

        <div class="form_row">
            <label class="lbl_cadastro">
                Data de Início:
            </label>

            <input type="date" class="cadastro_input" name="dtinicio" id="dtinicio">
        </div>

        <div class="form_row">
            <label class="lbl_cadastro">
                Data de Término:
            </label>

            <input type="date" class="cadastro_input" name="dttermino" id="dttermino">
        </div>

        <div class="form_row">
            <input type="submit" class="page_btn" value="CADASTRAR">
        <div> 
    </form>
</div>