<?php
    class SubcategoriaDAO{
        public function __construct(){
            require_once('bdClass.php');
        }

        //função para listar as subcategorias de uma categoria
        public function selectAll($idCategoria){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();

            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();

            //query que busca os dados
            $stm = $PDO_conexao->prepare('SELECT * FROM subcategoria WHERE idCategoria = ?');

            //parâmetros enviados
            $stm->bindParam(1, $idCategoria);

            //execução do statement
            $stm->execute();

            //contador
            $cont = 0;

            //percorrendo os dados
            while($rsSubcategoria = $stm->fetch(PDO::FETCH_OBJ)){
                //instância da classe Subcategoria
                $listSubcategoria[] = new Subcategoria();

                //setando os atributos
                $listSubcategoria[$cont]->setId($rsSubcategoria->idSubcategoria);
                $listSubcategoria[$cont]->setNome($rsSubcategoria->nome);

                //contador
                $cont++;
            }

            //verificando se há resultados
            if($cont != 0){
                //retornando os dados
                return $listSubcategoria;
            }

            //fechando a conexão
            $conexao->fecharConexao();
        }

        //função que busca os produtos por classificacao
		public function SelectByClassificacao($idSubcategoria, $classificacao, $pesquisa){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que busca o produto
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.descricao ,p.preco,p.idCategoria , t.tamanho, f.caminhoImagem as imagem FROM produto as p INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE p.status = 1 AND p.idSubcategoria = ? AND p.classificacao = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');
			
            //parâmetro enviado
            $stm->bindValue(1, $idSubcategoria, PDO::PARAM_INT);
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
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		public function SelectByTamanho($idSubcategoria, $tamanho, $pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.descricao ,p.preco,p.idCategoria , t.tamanho, f.caminhoImagem as imagem FROM produto as p INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE p.status = 1 AND p.idSubcategoria = ? AND p.idTamanho = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');
			
			//parâmetros enviados
			$stm->bindValue(1, $idSubcategoria, PDO::PARAM_INT);
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
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		public function selectByCor($idSubcategoria, $cor, $pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto, p.preco, p.descricao, t.tamanho, p.preco, f.caminhoImagem as imagem FROM produto AS p INNER JOIN tamanho AS t ON 
			t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto AS pi ON pi.idProduto = p.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto 
			WHERE p.status = 1 AND p.idSubcategoria = ? AND p.idCor = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');

			//parâmetros enviados
			$stm->bindParam(1, $idSubcategoria);
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

			if($cont != 0){
				//retornando os dados
				return $listProduto;
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para filtrar o produto por marca
		public function selectByMarca($idSubcategoria, $marca, $pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto, p.preco, p.descricao, t.tamanho, p.preco, f.caminhoImagem as imagem FROM produto AS p INNER JOIN tamanho AS t ON 
			t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto AS pi ON pi.idProduto = p.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto 
			WHERE p.status = 1 AND p.idSubcategoria = ? AND p.idMarca = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');

			//parâmetro enviado
			$stm->bindParam(1, $idSubcategoria);
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

			if($cont != 0){
				//retornando os dados
				return $listProdutos;
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}
        
        //função para selecionar o produto pelo preço e subcategoria
        public function selectByPreco($pesquisa, $min, $max, $idSubcategoria){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
			
            //chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

            //query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.preco, p.classificacao, c.nome as cor, m.nomeMarca as marca, t.tamanho, ct.nomeCategoria as categoria, f.caminhoImagem as imagem FROM produto as p INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE p.status = 1 and p.idCategoria = ? and p.nomeProduto LIKE ? and p.preco >= ? and p.preco <= ? GROUP BY p.idProduto');

            //parâmetros enviados
            $stm->bindParam(1, $idSubcategoria);
            $stm->bindParam(2, $pesquisa);
			$stm->bindValue(3, $min);
            $stm->bindValue(4, $max);

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
				$listProduto[$cont]->setImagem($rsProduto->imagem);
				$listProduto[$cont]->setNome($rsProduto->nome);
				$listProduto[$cont]->setPreco($rsProduto->preco);
				$listProduto[$cont]->setTamanho($rsProduto->tamanho);

                //incrementando o contador
				$cont++;
			}

            //verificando os dados
			if($cont != 0){
                //retornando os dados
				return $listProduto;
			}

            //fechando a conexão
			$conexao->fecharConexao();
        }
    }
?>