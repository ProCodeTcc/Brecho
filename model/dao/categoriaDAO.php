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
			
			//verificando os dados
			if($cont != 0){
                //retornando os dados
				return $listProdutos;
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
        
        //função que busca os produtos por classificacao em inglês
		public function SelectByClassificacaoTranslate($idCategoria, $classificacao, $pesquisa){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que busca o produto
			$stm = $PDO_conexao->prepare('SELECT pt.nomeProduto as nome, t.tamanho, c.nome as cor, m.nomeMarca as marca, p.preco, p.descricao, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca WHERE p.status = 1 AND p.idCategoria = ? AND p.classificacao = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');
			
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
			
			//verificando os dados
			if($cont != 0){
                //retornando os dados
				return $listProdutos;
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
        //função que busca os produtos por tamanho
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
			
			//verificando os dados
			if($cont != 0){
                //retornando os dados
				return $listProdutos;
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
        
        //função que busca os produtos por tamanho em inglês
        public function SelectByTamanhoTranslate($idCategoria, $tamanho, $pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT pt.nomeProduto as nome, t.tamanho, c.nome as cor, m.nomeMarca as marca, p.preco, p.descricao, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca WHERE p.status = 1 AND p.idCategoria = ? AND p.idTamanho = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');
			
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
			
			//verificando os dados
			if($cont != 0){
                //retornando os dados
				return $listProdutos;
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
        
        //função que busca os produtos pela cor
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

			//verificando os dados
			if($cont != 0){
                //retornando os dados
				return $listProduto;
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}
        
        //função que busca os produtos por cor em inglês
        public function selectByCorTranslate($idCategoria, $cor, $pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT pt.nomeProduto, t.tamanho, c.nome as cor, m.nomeMarca as marca, p.preco, p.descricao, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca WHERE p.status = 1 AND p.idCategoria = ? AND p.idCor = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');

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

			//verificando os dados
			if($cont != 0){
                //retornando os dados
				return $listProduto;
			}

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

			//verificando os dados
			if($cont != 0){
                //retornando os dados
				return $listProdutos;
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}
        
        //função para filtrar o produto por marca em inglês
		public function selectByMarcaTranslate($idCategoria, $marca, $pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT pt.nomeProduto, t.tamanho, c.nome as cor, m.nomeMarca as marca, p.preco, p.descricao, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca WHERE p.status = 1 AND p.idCategoria = ? AND p.idMarca = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');

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

			//verificando os dados
			if($cont != 0){
                //retornando os dados
				return $listProdutos;
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}
        
         //função para selecionar o produto pelo preço e categoria
        public function selectByPreco($pesquisa, $min, $max, $idCategoria){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
			
            //chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

            //query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.preco, p.classificacao, c.nome as cor, m.nomeMarca as marca, t.tamanho, ct.nomeCategoria as categoria, f.caminhoImagem as imagem FROM produto as p INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE p.status = 1 and p.idCategoria = ? and p.nomeProduto LIKE ? and p.preco >= ? and p.preco <= ? GROUP BY p.idProduto');

            //parâmetros enviados
            $stm->bindParam(1, $idCategoria);
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
        
         //função para selecionar o produto pelo preço e categoria em inglês
        public function selectByPrecoTranslate($pesquisa, $min, $max, $idCategoria){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
			
            //chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

            //query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT pt.nomeProduto as nome, p.descricao, t.tamanho, c.nome as cor, m.nomeMarca as marca, p.preco, p.descricao, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca WHERE p.status = 1 and p.idCategoria = ? and p.nomeProduto LIKE ? and p.preco >= ? and p.preco <= ? GROUP BY p.idProduto');

            //parâmetros enviados
            $stm->bindParam(1, $idCategoria);
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
                $listProduto[$cont]->setDescricao($rsProduto->descricao);
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