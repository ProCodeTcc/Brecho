<?php
	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 09/11/2018
		Objetivo: adicionado pesquisa por nome junto com o filtro de produtos e categoria
	*/

    class CategoriaDAO{
        public function __construct(){
            require_once('bdClass.php');
        }

        public function selectCategorias(){
            //instancia da classe do banco de dados.
            $conexao = new ConexaoMySQL();
        
            //chamada da função que conecta com o banco.
            $PDO_conexao = $conexao->conectarBanco();
            
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
            //query  que realiza a busca de categorias.
            $sql ='select * from categoria';
            
            $resultado = $PDO_conexao->query($sql);
            
            $cont = 0;
            
            while($rsCategoria = $resultado->fetch(PDO::FETCH_OBJ)){
                
            //Criando lista de categoria
            $listCategoria[] = new Produto();
                            
            //Adicionando os dados da categoria
            $listCategoria[$cont]->setId($rsCategoria->idCategoria);
            $listCategoria[$cont]->setNome($rsCategoria->nomeCategoria);
                
                $cont++;
            }
            
            return $listCategoria;
        }

        //função que busca os produtos por classificacao
		public function SelectByClassificacao($idCategoria, $classificacao, $pesquisa){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que busca o produto
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.descricao ,p.preco,p.idCategoria , t.tamanho, f.caminhoImagem as imagem FROM produto as p INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE p.status = 1 AND p.idCategoria = ? AND p.classificacao = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');
			
            //parâmetro enviado
            $stm->bindValue(1, $idCategoria, PDO::PARAM_INT);
			$stm->bindValue(2, $classificacao, PDO::PARAM_STR);
			$stm->bindValue(3, $pesquisa, PDO::PARAM_STR);
			
			//execução do statement
			$stm->execute();
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsProdutos = $stm->fetch(PDO::FETCH_OBJ)){
				//criando um novo produto
				$listProdutos[] = new Produto();
				
				//setando os atributos
				$listProdutos[$cont]->setId($rsProdutos->idProduto);
				$listProdutos[$cont]->setImagem($rsProdutos->imagem);
				$listProdutos[$cont]->setNome($rsProdutos->nome);
				$listProdutos[$cont]->setDescricao($rsProdutos->descricao);
				$listProdutos[$cont]->setTamanho($rsProdutos->tamanho);
				$listProdutos[$cont]->setPreco($rsProdutos->preco);
				
				//incrementando o contador
				$cont++;
			}
			
			if($cont != 0){
				//retornando os dados
				return $listProdutos;
			}else{
				echo('nenhum produto encontrado');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		public function SelectByTamanho($idCategoria, $tamanho, $pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.descricao ,p.preco,p.idCategoria , t.tamanho, f.caminhoImagem as imagem FROM produto as p INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE p.status = 1 AND p.idCategoria = ? AND p.idTamanho = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');
			
			//parâmetros enviados
			$stm->bindValue(1, $idCategoria, PDO::PARAM_INT);
			$stm->bindValue(2, $tamanho, PDO::PARAM_INT);
			$stm->bindValue(3, $pesquisa, PDO::PARAM_STR);
			
			//execução do statement
			$stm->execute();
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsProdutos = $stm->fetch(PDO::FETCH_OBJ)){
				//criando um novo produto
				$listProdutos[] = new Produto();
				
				//setando os atributos
				$listProdutos[$cont]->setId($rsProdutos->idProduto);
				$listProdutos[$cont]->setNome($rsProdutos->nome);
				$listProdutos[$cont]->setDescricao($rsProdutos->descricao);
				$listProdutos[$cont]->setPreco($rsProdutos->preco);
				$listProdutos[$cont]->setTamanho($rsProdutos->tamanho);
				$listProdutos[$cont]->setImagem($rsProdutos->imagem);
				
				//incrementando o contador
				$cont++;
			}
			
			if($cont != 0){
				//retornando os dados
				return $listProdutos;
			}else{
				echo('nenhum produto encontrado');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		public function selectByCor($idCategoria, $cor, $pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto, p.preco, p.descricao, t.tamanho, p.preco, f.caminhoImagem as imagem FROM produto AS p INNER JOIN tamanho AS t ON 
			t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto AS pi ON pi.idProduto = p.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto 
			WHERE p.status = 1 AND p.idCategoria = ? AND p.idCor = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');

			//parâmetros enviados
			$stm->bindParam(1, $idCategoria);
			$stm->bindParam(2, $cor);
			$stm->bindParam(3, $pesquisa);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsProduto = $stm->fetch(PDO::FETCH_OBJ)){
				//criando um novo Produto
				$listProduto[] = new Produto();

				//setando os atributos
				$listProduto[$cont]->setId($rsProduto->idProduto);
				$listProduto[$cont]->setNome($rsProduto->nomeProduto);
				$listProduto[$cont]->setDescricao($rsProduto->descricao);
				$listProduto[$cont]->setImagem($rsProduto->imagem);
				$listProduto[$cont]->setTamanho($rsProduto->tamanho);
				$listProduto[$cont]->setPreco($rsProduto->preco);

				//incrementando o contador
				$cont++;
			}

			//retornando os dados
			return $listProduto;

			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para filtrar o produto por marca
		public function selectByMarca($idCategoria, $marca, $pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto, p.preco, p.descricao, t.tamanho, p.preco, f.caminhoImagem as imagem FROM produto AS p INNER JOIN tamanho AS t ON 
			t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto AS pi ON pi.idProduto = p.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto 
			WHERE p.status = 1 AND p.idCategoria = ? AND p.idMarca = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');

			//parâmetro enviado
			$stm->bindParam(1, $idCategoria);
			$stm->bindParam(2, $marca);
			$stm->bindParam(3, $pesquisa);
			
			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsProdutos = $stm->fetch(PDO::FETCH_OBJ)){
				//criando um novo produto
				$listProdutos[] = new Produto();

				//setando os atributos
				$listProdutos[$cont]->setId($rsProdutos->idProduto);
				$listProdutos[$cont]->setNome($rsProdutos->nomeProduto);
				$listProdutos[$cont]->setDescricao($rsProdutos->descricao);
				$listProdutos[$cont]->setPreco($rsProdutos->preco);
				$listProdutos[$cont]->setTamanho($rsProdutos->tamanho);
				$listProdutos[$cont]->setImagem($rsProdutos->imagem);

				//contador
				$cont++;
			}

			//retornando os dados
			return $listProdutos;

			//fechando a conexão
			$conexao->fecharConexao();
		}
    }
?>