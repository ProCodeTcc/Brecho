<?php
	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 08/10/2018
		Objetivo: listagem de produtos e visualização
	*/

	/*
		Projeto:Brechó
		Autor: Felipe Monteiro
		Data: 18/10/2018
		Objetivo: listagem de produtos e visualização por categoria
	*/

	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 20/10/2018
		Objetivo: filtro de produtos e sugestão de produtos
	*/

	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 09/11/2018
		Objetivo: adicionado pesquisa por nome junto com o filtro de produtos
	*/

	class ProdutoDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		//função que lista todos os produtos do banco
		public function selectAll(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta no banco
			$sql = 'SELECT p.idProduto, p.nomeProduto as nome, p.preco, p.classificacao, c.nome as cor, m.nomeMarca as marca, t.tamanho, ct.nomeCategoria as categoria, f.caminhoImagem as imagem FROM produto as p INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE p.status = 1 GROUP BY p.idProduto';
			
			//armazenando os dados em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			$cont = 0;
			
			while($rsProdutos = $resultado->fetch(PDO::FETCH_OBJ)){
				$listProduto[] = new Produto();
				
				$listProduto[$cont]->setId($rsProdutos->idProduto);
				$listProduto[$cont]->setNome($rsProdutos->nome);
				$listProduto[$cont]->setPreco($rsProdutos->preco);
				$listProduto[$cont]->setClassificacao($rsProdutos->classificacao);
				$listProduto[$cont]->setCor($rsProdutos->cor);
				$listProduto[$cont]->setMarca($rsProdutos->marca);
				$listProduto[$cont]->setCategoria($rsProdutos->categoria);
				$listProduto[$cont]->setTamanho($rsProdutos->tamanho);
				$listProduto[$cont]->setImagem($rsProdutos->imagem);
				
				$cont++;
			}
			
			return $listProduto;
		}
		
		//função que seleciona um produto a partir do ID
		public function selectByID($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.descricao, p.nomeProduto as nome, p.preco, p.classificacao, c.nome as cor, m.nomeMarca as marca, t.tamanho, ct.nomeCategoria as categoria  FROM produto as p INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria WHERE idProduto = ? GROUP BY p.idProduto');
			
			//parâmetros enviados
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			//executando o statement
			$stm->execute();
			
			//armazenando o retorno dos dados em uma variável
			$rsProduto = $stm->fetch(PDO::FETCH_OBJ);
			
			//criando um novo produto
			$listProduto = new Produto();
			
			//adicionando os dados do produto
			$listProduto->setId($rsProduto->idProduto);
			$listProduto->setNome($rsProduto->nome);
			$listProduto->setPreco($rsProduto->preco);
			$listProduto->setCor($rsProduto->cor);
			$listProduto->setTamanho($rsProduto->tamanho);
			$listProduto->setDescricao($rsProduto->descricao);
            $listProduto->setMarca($rsProduto->marca);
			
			//retornando um produto
			return $listProduto;
		}
		
        //função para selecionar todos os produtos em inglês
        public function selectTranslate(){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que faz a consulta
            $sql = 'SELECT pt.nomeProduto as nome, t.tamanho, p.preco, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto WHERE p.status = 1 GROUP BY p.idProduto';
            
            //armazenando o resultado em uma variável
            $resultado = $PDO_conexao->query($sql);
            
            //contador
            $cont = 0;
            
            //percorrendo os dados
            while($rsProduto = $resultado->fetch(PDO::FETCH_OBJ)){
                //criando um novo produto
                $listProduto[] = new Produto();

                //setando os atributos
                $listProduto[$cont]->setId($rsProduto->idProduto);
                $listProduto[$cont]->setNome($rsProduto->nome);
                $listProduto[$cont]->setTamanho($rsProduto->tamanho);
                $listProduto[$cont]->setPreco($rsProduto->preco);
                $listProduto[$cont]->setImagem($rsProduto->imagem);
                
                //incrementando o contador
                $cont++;
            }
            
            //retornando os dados
            return $listProduto;
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para pegar um produto em inglês
        public function selectByTranslate($id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que faz a consulta
            $stm = $PDO_conexao->prepare('SELECT pt.nomeProduto as nome, t.tamanho, c.nome as cor, m.nomeMarca as marca, p.preco, pt.descricao, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca WHERE p.status = 1 AND pt.idProduto = ? GROUP BY p.idProduto');
            
            //parâmetros enviados
            $stm->bindParam(1, $id);
            
            //execução do statement
            $stm->execute();
            
            //armazenando os dados em uma variável
            $rsProduto = $stm->fetch(PDO::FETCH_OBJ);
            
            //criando um novo produto
            $listProduto = new Produto();
            
            //setando os atributos
            $listProduto->setId($rsProduto->idProduto);
            $listProduto->setNome($rsProduto->nome);
            $listProduto->setPreco($rsProduto->preco);
            $listProduto->setTamanho($rsProduto->tamanho);
            $listProduto->setCor($rsProduto->cor);
            $listProduto->setMarca($rsProduto->marca);
            $listProduto->setDescricao($rsProduto->descricao);
            
            //retornando os dados
            return $listProduto;
        
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
		//função que trás as imagens do produto
		public function selectImages($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT f.caminhoImagem as imagem FROM fotoproduto as f INNER JOIN produto_fotoproduto as pi ON f.idImagemProduto = pi.idImagemProduto INNER JOIN produto as p on p.idProduto = pi.idProduto WHERE p.idProduto = ?');
			
			
			//parâmetros enviados
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			//execução do statement
			$stm->execute();
			
			//contador
			$cont = 0;
			
			//percorrendo os dados das imagens
			while($rsImagens = $stm->fetch(PDO::FETCH_OBJ)){
				//criando um novo produto
				$listImagens[] = new Produto();
				
				//armazenando as imagens no produto
				$listImagens[$cont]->setImagem($rsImagens->imagem);
				
				//incrementando o contador
				$cont++;
			}
			
			//retornando as imagens
			return $listImagens;
		}
        
        public function selectProdutoCategoria($id){
            //instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
            
            //query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.descricao ,p.preco,p.idCategoria , t.tamanho, f.caminhoImagem as imagem FROM produto as p INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE p.status = 1 AND p.idCategoria = ? GROUP BY p.idProduto');
            
            //parâmetros enviados
			$stm->bindValue(1, $id, PDO::PARAM_INT);
            
            //executando o statement
			$stm->execute();
            
            $cont=0;
            
            while($rsProdutoCategoria = $stm->fetch(PDO::FETCH_OBJ)){
            
                //criando um novo produto
                $listProdutoCategoria[] = new Produto();

                //adicionando os dados do produto
                $listProdutoCategoria[$cont]->setImagem($rsProdutoCategoria->imagem);
                $listProdutoCategoria[$cont]->setId($rsProdutoCategoria->idProduto);
                $listProdutoCategoria[$cont]->setNome($rsProdutoCategoria->nome);
                $listProdutoCategoria[$cont]->setDescricao($rsProdutoCategoria->descricao);
                $listProdutoCategoria[$cont]->setTamanho($rsProdutoCategoria->tamanho);
                $listProdutoCategoria[$cont]->setPreco($rsProdutoCategoria->preco);

             $cont++;   
            }
            
			if($cont != 0){
				//retornando um produto
                return $listProdutoCategoria;
			}
			
			$conexao->fecharConexao();
			
		}
        
        public function selectProdutoCategoriaTranslate($id){
            //instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
            
            //query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT pt.nomeProduto as nome, t.tamanho, c.nome as cor, m.nomeMarca as marca, p.preco, pt.descricao, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca WHERE p.status = 1 AND p.idCategoria = ? GROUP BY p.idProduto');
            
            //parâmetros enviados
			$stm->bindValue(1, $id, PDO::PARAM_INT);
            
            //executando o statement
			$stm->execute();
            
            $cont=0;
            
            while($rsProdutoCategoria = $stm->fetch(PDO::FETCH_OBJ)){
            
                //criando um novo produto
                $listProdutoCategoria[] = new Produto();

                //adicionando os dados do produto
                $listProdutoCategoria[$cont]->setImagem($rsProdutoCategoria->imagem);
                $listProdutoCategoria[$cont]->setId($rsProdutoCategoria->idProduto);
                $listProdutoCategoria[$cont]->setNome($rsProdutoCategoria->nome);
                $listProdutoCategoria[$cont]->setDescricao($rsProdutoCategoria->descricao);
                $listProdutoCategoria[$cont]->setTamanho($rsProdutoCategoria->tamanho);
                $listProdutoCategoria[$cont]->setPreco($rsProdutoCategoria->preco);

             $cont++;   
            }
            
			if($cont != 0){
				//retornando um produto
                return $listProdutoCategoria;
			}
			
			$conexao->fecharConexao();
			
		}
		
		//função para listar os produtos de uma subcategoria
		public function selectProdutoSubcategoria($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.descricao ,p.preco,p.idCategoria , t.tamanho, f.caminhoImagem as imagem FROM produto as p INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE p.status = 1 AND p.idSubcategoria = ? GROUP BY p.idProduto');

			//parâmetros enviados
			$stm->bindParam(1, $id);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsProdutoCategoria = $stm->fetch(PDO::FETCH_OBJ)){
            
                //criando um novo produto
                $listProdutoCategoria[] = new Produto();

                //adicionando os dados do produto
                $listProdutoCategoria[$cont]->setImagem($rsProdutoCategoria->imagem);
                $listProdutoCategoria[$cont]->setId($rsProdutoCategoria->idProduto);
                $listProdutoCategoria[$cont]->setNome($rsProdutoCategoria->nome);
                $listProdutoCategoria[$cont]->setDescricao($rsProdutoCategoria->descricao);
                $listProdutoCategoria[$cont]->setTamanho($rsProdutoCategoria->tamanho);
                $listProdutoCategoria[$cont]->setPreco($rsProdutoCategoria->preco);

				//incrementando o contador
             	$cont++;   
			}
			
			//verificando o resultado
			if($cont != 0){
				//retornando os dados
				return $listProdutoCategoria;
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}
        
        //função para listar os produtos de uma subcategoria em inglês
		public function selectProdutoSubcategoriaTranslate($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT pt.nomeProduto as nome, t.tamanho, c.nome as cor, m.nomeMarca as marca, p.preco, pt.descricao, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca WHERE p.status = 1 AND p.idSubcategoria = ? GROUP BY p.idProduto');

			//parâmetros enviados
			$stm->bindParam(1, $id);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsProdutoCategoria = $stm->fetch(PDO::FETCH_OBJ)){
            
                //criando um novo produto
                $listProdutoCategoria[] = new Produto();

                //adicionando os dados do produto
                $listProdutoCategoria[$cont]->setImagem($rsProdutoCategoria->imagem);
                $listProdutoCategoria[$cont]->setId($rsProdutoCategoria->idProduto);
                $listProdutoCategoria[$cont]->setNome($rsProdutoCategoria->nome);
                $listProdutoCategoria[$cont]->setDescricao($rsProdutoCategoria->descricao);
                $listProdutoCategoria[$cont]->setTamanho($rsProdutoCategoria->tamanho);
                $listProdutoCategoria[$cont]->setPreco($rsProdutoCategoria->preco);

				//incrementando o contador
             	$cont++;   
			}
			
			//verificando o resultado
			if($cont != 0){
				//retornando os dados
				return $listProdutoCategoria;
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que busca os produtos por classificacao
		public function SelectByClassificacao($classificacao, $pesquisa){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que busca o produto
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.descricao ,p.preco,p.idCategoria , t.tamanho, f.caminhoImagem as imagem FROM produto as p INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE p.status = 1 AND p.classificacao = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');
			
			//parâmetro enviado
			$stm->bindValue(1, $classificacao, PDO::PARAM_STR);
			$stm->bindValue(2, $pesquisa, PDO::PARAM_STR);
			
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
        
        //função que busca os produtos por classificacao em inglês
		public function SelectByClassificacaoTranslate($classificacao, $pesquisa){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que busca o produto
			$stm = $PDO_conexao->prepare('SELECT pt.nomeProduto as nome, t.tamanho, c.nome as cor, m.nomeMarca as marca, p.preco, pt.descricao, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca WHERE p.status = 1 AND p.classificacao = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');
			
			//parâmetro enviado
			$stm->bindValue(1, $classificacao, PDO::PARAM_STR);
			$stm->bindValue(2, $pesquisa, PDO::PARAM_STR);
			
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
		
		//função para listar as medidas
		public function selectMedida(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$sql = 'SELECT * FROM tamanho WHERE idTipoTamanho = 1';
			
			//armazenando o resultado em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsMedida = $resultado->fetch(PDO::FETCH_OBJ)){
				$listMedida[] = new Produto();
				
				//setando os atributos
				$listMedida[$cont]->setId($rsMedida->idTamanho);
				$listMedida[$cont]->setTamanho($rsMedida->tamanho);
				
				//incrementando o contador
				$cont++;
			}
			
			//retornando os dados
			return $listMedida;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que lista os números
		public function selectNumero(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$sql = 'SELECT * FROM tamanho WHERE idTipoTamanho = 2';
			
			//armazenando o resultado em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsNumero = $resultado->fetch(PDO::FETCH_OBJ)){
				$listNumero[] = new Produto();
				
				//setando os atributos
				$listNumero[$cont]->setId($rsNumero->idTamanho);
				$listNumero[$cont]->setTamanho($rsNumero->tamanho);
				
				//incrementando o contador
				$cont++;
			}
			
			//retornando os dados
			return $listNumero;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para listar as cores
		public function selectCor(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT * FROM corroupa');

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsCor = $stm->fetch(PDO::FETCH_OBJ)){
				//criando uma nova cor
				$listCor[] = new Cor();

				//setando os atributos
				$listCor[$cont]->setId($rsCor->idCor);
				$listCor[$cont]->setNome($rsCor->nome);
				$listCor[$cont]->setCor($rsCor->cor);

				//incrementando o contador
				$cont++;
			}

			//retornando os dados
			return $listCor;

			//fechando a conexão
			$conexao->fecharConexao();
		}

		public function selectByCor($cor, $pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto, p.preco, p.descricao, t.tamanho, p.preco, f.caminhoImagem as imagem FROM produto AS p INNER JOIN tamanho AS t ON 
			t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto AS pi ON pi.idProduto = p.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto 
			WHERE p.status = 1 AND p.idCor = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');

			//parâmetros enviados
			$stm->bindParam(1, $cor);
			$stm->bindParam(2, $pesquisa);

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
        
        public function selectByCorTranslate($cor, $pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto, p.preco, pt.descricao, t.tamanho, p.preco, f.caminhoImagem as imagem FROM produto AS p INNER JOIN tamanho AS t ON 
			t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto AS pi ON pi.idProduto = p.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto 
			WHERE p.status = 1 AND p.idCor = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');

			//parâmetros enviados
			$stm->bindParam(1, $cor);
			$stm->bindParam(2, $pesquisa);

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
		
		//função para listar as marcas
		public function selectMarca(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT * FROM marca');

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsMarca = $stm->fetch(PDO::FETCH_OBJ)){
				//criando um novo Produto
				$listMarca[] = new Produto;
				
				//setando os atributos
				$listMarca[$cont]->setId($rsMarca->idMarca);
				$listMarca[$cont]->setMarca($rsMarca->nomeMarca);

				//incrementando o contador
				$cont++;
			}

			//retornando os dados
			return $listMarca;

			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para filtrar o produto por marca
		public function selectByMarca($marca, $pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto, p.preco, p.descricao, t.tamanho, p.preco, f.caminhoImagem as imagem FROM produto AS p INNER JOIN tamanho AS t ON 
			t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto AS pi ON pi.idProduto = p.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto 
			WHERE p.status = 1 AND p.idMarca = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');

			//parâmetro enviado
			$stm->bindParam(1, $marca);
			$stm->bindParam(2, $pesquisa);
			
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
        
        //função para filtrar o produto por marca
		public function selectByMarcaTranslate($marca, $pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT pt.nomeProduto, t.tamanho, c.nome as cor, m.nomeMarca as marca, p.preco, p.descricao, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca WHERE p.status = 1 AND p.idMarca = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');

			//parâmetro enviado
			$stm->bindParam(1, $marca);
			$stm->bindParam(2, $pesquisa);
			
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
		
		public function SelectByTamanho($tamanho, $pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.descricao ,p.preco,p.idCategoria , t.tamanho, f.caminhoImagem as imagem FROM produto as p INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE p.status = 1 AND p.idTamanho = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');
			
			//parâmetros enviados
			$stm->bindValue(1, $tamanho, PDO::PARAM_INT);
			$stm->bindValue(2, $pesquisa, PDO::PARAM_STR);
			
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
        
        public function SelectByTamanhoTranslate($tamanho, $pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT pt.nomeProduto as nome, t.tamanho, c.nome as cor, m.nomeMarca as marca, p.preco, p.descricao, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca WHERE p.status = 1 AND p.idTamanho = ? AND p.nomeProduto LIKE ? GROUP BY p.idProduto');
			
			//parâmetros enviados
			$stm->bindValue(1, $tamanho, PDO::PARAM_INT);
			$stm->bindValue(2, $pesquisa, PDO::PARAM_STR);
			
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
		
		//função para listar os produtos aleatóriamente
		public function selectRandom(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//quey que faz a consulta
			$sql = 'SELECT p.idProduto, p.nomeProduto as nome, p.preco, p.classificacao, c.nome as cor, m.nomeMarca as marca, t.tamanho, ct.nomeCategoria as categoria, f.caminhoImagem as imagem FROM produto as p INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE p.status = 1 GROUP BY p.idProduto ORDER BY rand() limit 3';
			
			//armazenando o resultado em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsProdutos = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando um novo produto
				$listProduto[] = new Produto();
				
				//setando os atributos
				$listProduto[$cont]->setId($rsProdutos->idProduto);
				$listProduto[$cont]->setNome($rsProdutos->nome);
				$listProduto[$cont]->setPreco($rsProdutos->preco);
				$listProduto[$cont]->setImagem($rsProdutos->imagem);
				
				//incrementando o contador
				$cont++;
			}
			
			//retornando os dados
			return $listProduto;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
        
        //função para listar os produtos aleatóriamente em inglês
		public function selectRandomTranslate(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//quey que faz a consulta
			$sql = 'SELECT pt.nomeProduto as nome, t.tamanho, p.preco, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto WHERE p.status = 1 GROUP BY pt.idProduto ORDER BY rand() limit 3';
			
			//armazenando o resultado em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsProdutos = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando um novo produto
				$listProduto[] = new Produto();
				
				//setando os atributos
				$listProduto[$cont]->setId($rsProdutos->idProduto);
				$listProduto[$cont]->setNome($rsProdutos->nome);
				$listProduto[$cont]->setPreco($rsProdutos->preco);
				$listProduto[$cont]->setImagem($rsProdutos->imagem);
				
				//incrementando o contador
				$cont++;
			}
			
			//retornando os dados
			return $listProduto;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função que atualiza a qtd de cliques de um produto
		public function updateClick($id){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que atualiza os cliques
			$stm = $PDO_conexao->prepare('UPDATE produto SET cliques = cliques+1 WHERE idProduto = ?');

			//parâmetros enviados
			$stm->bindParam(1, $id);

			//execução do statement
			$stm->execute();

			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para selecionar os produtos mais clicados
		public function selectByClick(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que faz a consulta
			$sql = 'SELECT p.idProduto, p.nomeProduto as nome, p.preco, p.classificacao, c.nome as cor, m.nomeMarca as marca, t.tamanho, ct.nomeCategoria as categoria, f.caminhoImagem as imagem FROM produto as p INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE p.status = 1 GROUP BY p.idProduto ORDER BY p.cliques DESC';

			//armazenando os dados em uma variável
			$resultado = $PDO_conexao->query($sql);

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsProduto = $resultado->fetch(PDO::FETCH_OBJ)){
				//instância da classe Produto
				$listProduto[] = new Produto();
				
				//setando os atributos
				$listProduto[$cont]->setId($rsProduto->idProduto);
				$listProduto[$cont]->setImagem($rsProduto->imagem);
				$listProduto[$cont]->setNome($rsProduto->nome);
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
        
        //função para selecionar os produtos mais clicados em inglês
		public function selectByClickTranslate(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que faz a consulta
			$sql = 'SELECT pt.nomeProduto as nome, t.tamanho, p.preco, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto WHERE p.status = 1 GROUP BY p.idProduto ORDER BY p.cliques DESC';

			//armazenando os dados em uma variável
			$resultado = $PDO_conexao->query($sql);

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsProduto = $resultado->fetch(PDO::FETCH_OBJ)){
				//instância da classe Produto
				$listProduto[] = new Produto();
				
				//setando os atributos
				$listProduto[$cont]->setId($rsProduto->idProduto);
				$listProduto[$cont]->setImagem($rsProduto->imagem);
				$listProduto[$cont]->setNome($rsProduto->nome);
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

		public function searchByName($pequisa){
			$conexao = new ConexaoMySQL();
			
			$PDO_conexao = $conexao->conectarBanco();

			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.preco, p.classificacao, c.nome as cor, m.nomeMarca as marca, t.tamanho, ct.nomeCategoria as categoria, f.caminhoImagem as imagem FROM produto as p INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE p.status = 1 and p.nomeProduto like ? GROUP BY p.idProduto');

			$stm->bindParam(1, $pequisa);

			$stm->execute();

			$cont = 0;

			while($rsProduto = $stm->fetch(PDO::FETCH_OBJ)){
				$listProduto[] = new Produto();

				$listProduto[$cont]->setId($rsProduto->idProduto);
				$listProduto[$cont]->setImagem($rsProduto->imagem);
				$listProduto[$cont]->setNome($rsProduto->nome);
				$listProduto[$cont]->setPreco($rsProduto->preco);
				$listProduto[$cont]->setTamanho($rsProduto->tamanho);

				$cont++;
			}

			if($cont != 0){
				return $listProduto;
			}

			$conexao->fecharConexao();
		}
        
        public function searchByNameTranslate($pequisa){
			$conexao = new ConexaoMySQL();
			
			$PDO_conexao = $conexao->conectarBanco();

			$stm = $PDO_conexao->prepare('SELECT pt.nomeProduto as nome, t.tamanho, c.nome as cor, m.nomeMarca as marca, p.preco, p.descricao, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca WHERE p.status = 1 and pt.nomeProduto like ? GROUP BY p.idProduto');

			$stm->bindParam(1, $pequisa);

			$stm->execute();

			$cont = 0;

			while($rsProduto = $stm->fetch(PDO::FETCH_OBJ)){
				$listProduto[] = new Produto();

				$listProduto[$cont]->setId($rsProduto->idProduto);
				$listProduto[$cont]->setImagem($rsProduto->imagem);
				$listProduto[$cont]->setNome($rsProduto->nome);
				$listProduto[$cont]->setPreco($rsProduto->preco);
				$listProduto[$cont]->setTamanho($rsProduto->tamanho);

				$cont++;
			}

			if($cont != 0){
				return $listProduto;
			}

			$conexao->fecharConexao();
		}
        
        //função para verificar se um produto está em promoção
        public function checkPromocao($id){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que busca os dados
            $stm = $PDO_conexao->prepare('SELECT idProduto FROM promocao WHERE idProduto = ?');
            
            //parâmetros enviados
            $stm->bindParam(1, $id);
            
            //execução do statement
            $stm->execute();
            
            //verificando o retorno
            if($stm->rowCount() != 0){
                //retornando verdadeiro
                return true;
            }else{
                //retornando false
                return false;
            }
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
        
        //função para selecionar o produto pelo preço
        public function selectByPreco($pesquisa, $min, $max){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
			
            //chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

            //query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.preco, p.classificacao, c.nome as cor, m.nomeMarca as marca, t.tamanho, ct.nomeCategoria as categoria, f.caminhoImagem as imagem FROM produto as p INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE p.status = 1 and p.nomeProduto LIKE ? and p.preco >= ? and p.preco <= ? GROUP BY p.idProduto');

            //parâmetros enviados
            $stm->bindParam(1, $pesquisa);
			$stm->bindValue(2, $min);
            $stm->bindValue(3, $max);

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
			}else{
				echo('nenhum produto encontrado...');
			}

            //fechando a conexão
			$conexao->fecharConexao();
        }
        
        //função para selecionar o produto pelo preço
        public function selectByPrecoTranslate($pesquisa, $min, $max){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
			
            //chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

            //query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT pt.nomeProduto as nome, t.tamanho, c.nome as cor, m.nomeMarca as marca, p.preco, p.descricao, p.idProduto, f.caminhoImagem as imagem FROM produto_traducao as pt INNER JOIN produto as p ON pt.idProduto = p.idProduto INNER JOIN tamanho AS t ON t.idTamanho = p.idTamanho INNER JOIN produto_fotoproduto as pf ON p.idProduto = pf.idProduto INNER JOIN fotoproduto AS f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca WHERE p.status = 1 and p.nomeProduto LIKE ? and p.preco >= ? and p.preco <= ? GROUP BY p.idProduto');

            //parâmetros enviados
            $stm->bindParam(1, $pesquisa);
			$stm->bindValue(2, $min);
            $stm->bindValue(3, $max);

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
			}else{
				echo('nenhum produto encontrado...');
			}

            //fechando a conexão
			$conexao->fecharConexao();
        }
        
        //função para atualizar o status do produto
        public function updateStatus($idProduto){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query para atualizar os dados
            $stm = $PDO_conexao->prepare('UPDATE produto SET status = 0 WHERE idProduto = ?');
            
            //parâmetro enviado
            $stm->bindParam(1, $idProduto);
            
            //execução do statement
            $stm->execute();
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
		
	}
?>