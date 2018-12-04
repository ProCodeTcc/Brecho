<?php
    //iniciando a sessão
    session_start();

    //verificando se existe o tipo do filtro
	if(isset($_POST['tipoFiltro'])){
        //armazenando o tipo do filtro
		$tipoFiltro = $_POST['tipoFiltro'];
		
        //verificando o filtro
        if(isset($_POST{'filtro'})){
            //armazenando o filtro numa variável
            $filtro = $_POST['filtro'];
        }
        
        //resgatando o ID
        $id = $_POST['id'];

        //verificando se existe o termo
        if(!empty($_POST['termo'])){
            //armazena o termo numa variável
            $pesquisa = $_POST['termo'];
        }else{
            $pesquisa = '';
        }
	}
    
    if(isset($_GET['mobile'])){
        $mobile = $_GET['mobile'];
    }else{
        $mobile = 'false';
    }

	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
    require_once($diretorio.'controller/controllerProduto.php');
    require_once($diretorio.'controller/controllerCategoria.php');
?>


<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/funcoes.js"></script>
<script>
    $(document).ready(function(){
       if($(window).width() == '980'){
            filtroResponsivo();
        }
        
        verificarProdutos();
    });
</script>

<div class="caixa_categoria">
	<div class="categoria_pesquisa">
        <div class="categoria_pesquisa_centro">
            <form name="search" method="POST" action="pesquisa.php?mobile=<?php echo($mobile) ?>">
                <input type="search" name="txtpesquisa" class="campo_pesquisa_categoria"> 
                <input type="submit" class="botao_pesquisa_categoria" value="Pesquisar">
            </form>
        </div>
    </div>
    
    <?php
        if(isset($_GET['mobile'])){
            $mobile = $_GET['mobile'];

            //verificando se o acesso é mobile
            if($mobile == 'true'){
                //inclusão do filtro responsivo
                require_once('filtro_responsivo_subcategoria.php');
            }
        }
    ?>
    
    <div class="categoria">
        <div class="titulo_categoria_primeiro">
            Classificação
        </div>

        <div class="categoria_linha filtrar" onClick="filtrarClassificacao('A', <?php echo($id) ?>)">
            A
        </div>
        <div class="categoria_linha filtrar" onClick="filtrarClassificacao('B', <?php echo($id) ?>)">
            B
        </div>
        <div class="categoria_linha filtrar" onClick="filtrarClassificacao('C', <?php echo($id) ?>)">
            C
        </div>

        <div class="titulo_categoria">
            Preço
        </div>

        <div class="preco_container" id="preco">
            <input class="preco_min min" type="number" name="txtmin" placeholder="min">
            <input class="preco_max max" type="number" name="txtmax" placeholder="max" onblur="filtrarPreco(<?php echo($id) ?>)">
        </div>

        <div class="titulo_categoria">
            Medidas
        </div>

        <div class="categoria_tamanhos container_tamanho">
            <?php
                //instância da controller
                $listMedidas = new controllerProduto();
             
                //armazenando as medidas numa variável
                $rsMedidas = $listMedidas->listarMedidas();
             
                //contador
                $cont = 0;
             
                //percorrendo os dados
                while($cont < count($rsMedidas)){
            ?>

            <div class="tamanhos" onClick="filtrarTamanho(<?php echo($rsMedidas[$cont]->getId()) ?>, <?php echo($id) ?>)">
                <?php echo($rsMedidas[$cont]->getTamanho()) ?>
            </div>
        <?php 
            //incrementando o contador
            $cont++;
        } ?>
        </div>

        <div class="titulo_categoria">
            Números
        </div>
        <div class="categoria_tamanhos container_tamanho">
            <?php
                //instância da controller
                $listNumeros = new controllerProduto();
            
                //armazenando os números numa variável
                $rsNumeros = $listNumeros->listarNumeros();
            
                //contador
                $cont = 0;
            
                //pecorrendo os dados
                while($cont < count($rsNumeros)){
            ?>

            <div class="tamanhos" onClick="filtrarTamanho(<?php echo($rsNumeros[$cont]->getId()) ?>, <?php echo($id) ?>)">
                <?php echo($rsNumeros[$cont]->getTamanho()) ?>
            </div>
        <?php 
                //incrementando o contador
                $cont++;
            } ?>
        </div>

        <div class="titulo_categoria">
            Cores
        </div>
        <div class="container_cor">
        <?php
            //instância da controller
            $listCor =  new controllerProduto();
            
            //armazenando as cores numa variável
            $rsCor = $listCor->listarCores();
            
            //contador
            $cont = 0;
            
            //percorrendo o contador
            while($cont < count($rsCor)){
        ?>
            <div class="cores" style="background-color: <?php echo($rsCor[$cont]->getCor()) ?>;" onclick="filtrarCor(<?php echo($rsCor[$cont]->getId()) ?>, <?php echo($id) ?>)">
                <span class="nome_cor">
                    <?php echo($rsCor[$cont]->getNome()) ?>
                </span>
            </div>                       

        <?php
        //incrementando o contador
        $cont++;
            }
        ?>         
        </div>

        <div class="titulo_categoria">
            Marcas
        </div>

    <?php
        //instância da controller
        $listMarca = new controllerProduto();
        
        //armazenando as marcas numa variável
        $rsMarca = $listMarca->listarMarca();
        
        //contador
        $cont = 0;
        
        //percorrendo o contador
        while($cont < count($rsMarca)){
    ?>
        <div class="categoria_linha filtrar" onClick="filtrarMarca(<?php echo($rsMarca[$cont]->getId()) ?>, <?php echo($id) ?>)">
            <?php
                echo($rsMarca[$cont]->getMarca());
            ?>
        </div>
    <?php
        //incrementando o contador
        $cont++;
    }?>
    </div>

    <div class="filtro_categoria">
        <?php
            //instância da controller
            $listSubcategoria = new controllerCategoria();
        
            //verificando o tipo do filtro
            if($tipoFiltro == 'classificacao'){
                $rsFiltro = $listSubcategoria->listarSubcategoriaClassificacao($id, $filtro, $pesquisa, $_SESSION['idioma']);
            }else if($tipoFiltro == 'tamanho'){
                $rsFiltro = $listSubcategoria->listarSubcategoriaTamanho($id, $filtro, $pesquisa, $_SESSION['idioma']);
            }else if($tipoFiltro == 'cor'){
                $rsFiltro = $listSubcategoria->listarSubcategoriaCor($id, $filtro, $pesquisa, $_SESSION['idioma']);
            }else if($tipoFiltro == 'marca'){
                $rsFiltro = $listSubcategoria->listarSubcategoriaMarca($id, $filtro, $pesquisa, $_SESSION['idioma']);
            }else if($tipoFiltro == 'preco'){
                $min = $_POST['min'];
                $max = $_POST['max'];
                
                $rsFiltro = $listSubcategoria->listarSubcategoriaPreco($pesquisa, $min, $max, $id, $_SESSION['idioma']);
            }

            //contador
            $cont = 0;

            //percorrendo os dados
            while($cont < count($rsFiltro)){
        ?>

        <a href="visualizar_produto.php?id=<?php echo($rsFiltro[$cont]->getId())?>&pagina=categoria">
            <div class="produto">
                <div class="imagem_produto">
                    <img  alt="#" src="../cms/view/arquivos/<?php echo($rsFiltro[$cont]->getImagem())?>" alt="#">
                </div>
                <div class="descritivo_produto">
                    <div class="titulo_produto">
                        <?php echo($rsFiltro[$cont]->getNome())?>
                    </div>
                    <div class="descricao">
                        <?php echo($rsFiltro[$cont]->getDescricao())?>
                    </div>
                    <div class="tamanho">
                       <?php echo($rsFiltro[$cont]->getTamanho())?>
                    </div>
                    <div class="preco">
                        R$ <?php echo($rsFiltro[$cont]->getPreco())?>
                    </div>
                    <div class="opcoes">
                        <div class="comprar_produto">
                            Conferir
                        </div>
                        <div class="carrinho_produto">
                            <img  alt="#" src="icones/carrinho.png">
                        </div>
                    </div>
                </div>
            </div>

            <?php
                //incrementando o contador
                $cont++;
                }

            ?>
        </a>
	 </div>

    <div class="nenhum_produto">
        <strong>NENHUM RESULTADO ENCONTRADO</strong>
        <p>Encontramos 0 resultado para sua busca</p>

        <strong>Dicas para melhorar sua busca</strong>
        <p>Verifique se não houve erro de digitação.</p>
        <p>Procure por um termo similar ou sinônimo.</p>
        <p>Tente procurar termos mais gerais e filtrar o resultado da busca.</p>
    </div>

  </div>