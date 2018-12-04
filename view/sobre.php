<?php
	require_once('arquivos/check_login.php');
    require_once('arquivos/idioma.php');
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
                Sobre Nós
            </div>
            <div class="sobre">
                
                <div class="primeiro_padrao">
					<?php
                        //armazenando o diretório numa variável
						$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
                    
                        //inclusão da controller
						require_once($diretorio.'controller/controllerSobre.php');
                    
                        //instância da controller
						$listSobre = new controllerSobre();
                    
                        //armazenando os dados numa variável
						$rsLayout = $listSobre->listarLayout($_SESSION['idioma']);
                    
                        //armazenando os dados numa variável
						$rsLayout2 = $listSobre->listarLayout2($_SESSION['idioma']);
					?>
                    <div class="texto_sobre">
                        <h2> <?php echo($rsLayout->getTitulo()) ?> </h2>
                        
						<?php echo($rsLayout->getDescricao()) ?>

                    </div>
                    <div class="imagem_sobre">
                        <img  alt="#" src="../cms/view/arquivos/<?php echo($rsLayout->getImagem()) ?>">
                    </div>
                </div>
                
                <div class="primeiro_padrao">
                    <div class="texto_sobre_esquerdo">
                        <h2> <?php echo($rsLayout2->getTitulo()) ?> </h2>
                        
						<?php echo($rsLayout2->getDescricao()) ?>

                    </div>
                    <div class="imagem_sobre_centro">
                        <img  alt="#" src="../cms/view/arquivos/<?php echo($rsLayout2->getImagem()) ?>">
                    </div>
                    <div class="texto_sobre_diteiro">
                        
						<?php echo($rsLayout2->getDescricao2()) ?>

                    </div>
                </div>
            </div>
        </main>
        <?php require_once('arquivos/footer.html') ?>
    </body>
</html>