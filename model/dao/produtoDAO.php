<?php
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
		
		public function selectByID($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			$stm = $PDO_conexao->prepare('SELECT p.idProduto, p.descricao, p.nomeProduto as nome, p.preco, p.classificacao, c.nome as cor, m.nomeMarca as marca, t.tamanho, ct.nomeCategoria as categoria  FROM produto as p INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN marca as m ON m.idMarca = p.idMarca INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria WHERE idProduto = ? GROUP BY p.idProduto');
			
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			$stm->execute();
			
			$rsProduto = $stm->fetch(PDO::FETCH_OBJ);
			
			$listProduto = new Produto();
			
			$listProduto->setNome($rsProduto->nome);
			$listProduto->setPreco($rsProduto->preco);
			$listProduto->setCor($rsProduto->cor);
			$listProduto->setTamanho($rsProduto->tamanho);
			$listProduto->setDescricao($rsProduto->descricao);
			
			return $listProduto;
		}
	}
?>