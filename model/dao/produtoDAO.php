<?php
	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 08/10/2018
		Objetivo: listagem de produtos e visualização
	*/

	/*
		Projeto: CMS do Brechó
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
			$sql = 'SELECT p.idProduto, p.nomeProduto as nome, p.preco, p.classificacao, c.nome as cor, m.nomeMarca as marca, t.tamanho, ct.nomeCategoria as categoria, f.caminhoImagem as imagem FROM produto as p INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE status = 1 GROUP BY p.idProduto';
			
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
			
			//retornando um produto
			return $listProduto;
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
        
        public function selectProdutoCategoria($id){
            //instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
            
            //query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.descricao ,p.preco,p.idCategoria , t.tamanho, f.caminhoImagem as imagem FROM produto as p INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE status = 1 AND p.idCategoria = ? GROUP BY p.idProduto');
            
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
			}else{
				echo('Não há produtos nessa categoria');
			}
			
			$conexao->fecharConexao();
			
        }
		
		//função que busca os produtos por classificacao
		public function SelectByClassificacao($classificacao){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que busca o produto
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.descricao ,p.preco,p.idCategoria , t.tamanho, f.caminhoImagem as imagem FROM produto as p INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE status = 1 AND p.classificacao = ? GROUP BY p.idProduto');
			
			//parâmetro enviado
			$stm->bindValue(1, $classificacao, PDO::PARAM_STR);
			
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
		
		public function SelectByTamanho($tamanho){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.descricao ,p.preco,p.idCategoria , t.tamanho, f.caminhoImagem as imagem FROM produto as p INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE status = 1 AND p.idTamanho = ? GROUP BY p.idProduto');
			
			//parâmetros enviados
			$stm->bindValue(1, $tamanho, PDO::PARAM_INT);
			
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
		
		public function selectRandom(){
			$conexao = new ConexaoMySQL();
			
			$PDO_conexao = $conexao->conectarBanco();
			
			$sql = 'SELECT p.idProduto, p.nomeProduto as nome, p.preco, p.classificacao, c.nome as cor, m.nomeMarca as marca, t.tamanho, ct.nomeCategoria as categoria, f.caminhoImagem as imagem FROM produto as p INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE status = 1 GROUP BY p.idProduto ORDER BY rand() limit 3';
			
			$resultado = $PDO_conexao->query($sql);
			
			$cont = 0;
			
			while($rsProdutos = $resultado->fetch(PDO::FETCH_OBJ)){
				$listProduto[] = new Produto();
				
				$listProduto[$cont]->setId($rsProdutos->idProduto);
				$listProduto[$cont]->setNome($rsProdutos->nome);
				$listProduto[$cont]->setPreco($rsProdutos->preco);
				$listProduto[$cont]->setImagem($rsProdutos->imagem);
				
				$cont++;
			}
			
			return $listProduto;
			
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
			$sql = 'SELECT p.idProduto, p.nomeProduto as nome, p.preco, p.classificacao, c.nome as cor, m.nomeMarca as marca, t.tamanho, ct.nomeCategoria as categoria, f.caminhoImagem as imagem FROM produto as p INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE status = 1 GROUP BY p.idProduto ORDER BY p.cliques DESC';

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

			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.nomeProduto as nome, p.preco, p.classificacao, c.nome as cor, m.nomeMarca as marca, t.tamanho, ct.nomeCategoria as categoria, f.caminhoImagem as imagem FROM produto as p INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE status = 1 and p.nomeProduto like ? GROUP BY p.idProduto');

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

			return $listProduto;

			$conexao->fecharConexao();
		}

		public function selectCartItens($ids){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			$in = str_repeat('?, ', count($ids) - 1) . '?';

			//query que faz a consulta no banco
			$stm = $PDO_conexao->prepare("SELECT p.idProduto, p.nomeProduto as nome, p.preco, p.classificacao, c.nome as cor, m.nomeMarca as marca, t.tamanho, ct.nomeCategoria as categoria, f.caminhoImagem as imagem FROM produto as p INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto WHERE status = 1 AND p.idProduto IN ($in) GROUP BY p.idProduto");
			
			// $stm->bindValue(1, $ids, PDO::PARAM_INT);
			
			$stm->execute($ids);

			$cont = 0;
			
			while($rsProdutos = $stm->fetch(PDO::FETCH_OBJ)){
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
		
	}
?>