<?php
    //inclusão do arquivo que verifica o login
	require_once('arquivos/check_login.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/funcoes.js"></script>
		
		<script>
			$(document).ready(function(){
				checarLogin(<?php echo($login) ?>);
			});
		</script>
		
		<?php
			if(isset($_SESSION['sexo'])){
				require_once('tema.php');
			}
		?>
    </head>
    <body>
        <header>
            <?php
				require_once('arquivos/header.php');
			?>
        </header>
        <main>
            <div class="linha">
                Eventos
            </div>
            <div class="eventos">
                
				<?php
                    //armazenandoo diretório numa variável
					$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
                
                    //inclusão da controller
					require_once($diretorio.'controller/controllerEvento.php');
                    
                    //instânciando a controller
					$listEvento = new controllerEvento();
                
                    //armaenando o evento numa variável
					$rsEvento = $listEvento->listarEvento();
                
                    //contador
					$cont = 0;
                
                    //percorrendo os dados
					while($cont < count($rsEvento)){
				?>
				<div class="linha_evento">
                    <div class="imagem_evento">
                     <img alt="#"  src="../cms/view/arquivos/<?php echo($rsEvento[$cont]->getImagemEvento()) ?>">
                    </div>
                    <div class="descricao_evento">
                        <div class="titulo_evento">
                            <?php echo($rsEvento[$cont]->getNomeEvento()) ?>
                        </div>
                        <div class="item_linha_evento">
                            Data Inicio: <?php echo($rsEvento[$cont]->getDataInicio()) ?>
                        </div>
                        <div class="item_linha_evento">
                            Data Fim: <?php echo($rsEvento[$cont]->getDataTermino()) ?>
                        </div>
                        <div class="descricao_linha_evento">
                            <?php echo($rsEvento[$cont]->getDescricaoEvento()) ?>
                        </div>
                        
                    </div>
                </div>
				<?php
                //incrementando o contador
				$cont++;
					}
				?>				
				
            </div>
        </main>
        <?php require_once('arquivos/footer.html') ?>
    </body>
</html>