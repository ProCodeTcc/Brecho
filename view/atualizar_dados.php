<?php
    //inclusão do arquivo de login
    require_once('arquivos/check_login.php');
	
    //verificando se existe o ID do cliente
	if(isset($_SESSION['idCliente'])){
        //armazenando o ID do cliente em uma variável
		$id = $_SESSION['idCliente'];
        
        //armazenando o tipo do ciente em uma variável
		$tipoCliente = $_SESSION['tipoCliente'];
	}else{
		$id = null;
	}

    //armazenando o diretório em uma variável
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';

    //inclusão da controller do cliente físico
	require_once($diretorio.'controller/controllerClienteFisico.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/jquery.mask.js"></script>
		<script src="js/funcoes.js"></script>
		
		<script>
			$(document).ready(function(){
				checarLogin(<?php echo($login) ?>);
			});
            
            function validar (caracter,blockType){
                if(window.event){
                    var letra = caracter.charCode;
                }else{
                    var letra = caracter.which;
                }
                
                if (blockType == 'caracter'){
                    if(letra<48 || letra>57){
                        if(letra !=8 && letra!=32){
                            alert('Você não pode digitar letras neste campo');
                            return false;
                        }
                    }
                }else if(blockType == 'number'){
                    if(letra >=48 && letra<=57){
                        alert('Você não pode digitar numeros neste campo');
                        return false;
                    }
                }
            }
		</script>
		
		<?php
			if(isset($_SESSION['sexo'])){
				require_once('tema.php');
			}
		?>
    </head>
    <body>
        <div class="mensagens">
            <div class="mensagem-sucesso" id="sucesso">
                <div class="msg">
                    
                </div>
    
                <div class="close" onclick="fecharMensagem()">
                    x
                </div>          
            </div>

            <div class="mensagem-erro" id="erro">
                <div class="msg">
                    
                </div>

                <div class="close" onclick="fecharMensagem()">
                    x
                </div>
            </div>

            <div class="mensagem-info" id="info">
                <div class="msg">

                </div>

                <div class="close" onclick="fecharMensagem()">
                    x
                </div>
            </div>
        </div>
        <header>
            <?php
				require_once('arquivos/header.php');
			?>
        </header>
        <main>
                <div class="linha">
                    Atualizar Dados
                </div>
                
				<?php
                    //verificando o tipo do cliente
					if($tipoCliente == 'F'){
                        //incluindo o formulário do cliente físico
						require_once('arquivos/att_fisico.php');
					}else{
                        //incluindo o formulário do cliente jurídico
						require_once('arquivos/att_juridico.php');
					}
				?>
                
        </main>
        <?php require_once('arquivos/footer.html') ?>
    </body>
</html>