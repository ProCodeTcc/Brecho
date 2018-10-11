<?php
	/*
        Projeto: Brechó
        Autor: Lucas Eduardo
        Data: 10/10/2018
        Objetivo: popular os selects com o que está no banco

    */

	/*
        Projeto: Brechó
        Autor: Lucas Eduardo
        Data: 10/10/2018
        Objetivo: inserção do produto e da imagem

    */

	class AvaliacaoDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		public function insertProduto(Avaliacao $produto){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			$stm = $PDO_conexao->prepare('INSERT INTO produtoavaliacao(nomeProduto, descricao, preco, classificacao, idMarca, idCategoria, idCor, idTamanho) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
			
			$stm->bindParam(1, $produto->getNome());
			$stm->bindParam(2, $produto->getDescricao());
			$stm->bindParam(3, $produto->getPreco());
			$stm->bindParam(4, $produto->getClassificacao());
			$stm->bindParam(5, $produto->getMarca());
			$stm->bindParam(6, $produto->getCategoria());
			$stm->bindParam(7, $produto->getCor());
			$stm->bindParam(8, $produto->getTamanho());
			
			if($stm->execute()){
				$idProduto = $PDO_conexao->lastInsertId();
				return $idProduto;
			}else{
				echo('erro ao inserir os dados do produto');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function insertImagem($imagem){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			foreach($imagem as $img){
				$stm = $PDO_conexao->prepare('INSERT INTO fotoproduto(caminhoImagem) VALUES(?)');
				$stm->bindParam(1, $img);
				
				if($stm->execute()){
					$idImagem[] = $PDO_conexao->lastInsertId();	
				}else{
					echo('Ocorreu um erro ao inserir a imagem');
				}
			}
			
			return $idImagem;
			
			$conexao->fecharConexao();
		}
		
		public function insertProdutoImagem($idProduto, $idImagem){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			foreach($idImagem as $imagens){
				$stm = $PDO_conexao->prepare('INSERT INTO produtoavaliacao_fotoproduto(idProdutoAvaliacao, idImagemProduto) VALUES(?, ?)');
				$stm->bindParam(1, $idProduto);
				$stm->bindParam(2, $imagens);
				$stm->execute();
			}
			
			$conexao->fecharConexao();
		}
		
		
		
		public function selectCor(){
			//intância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT * FROM corroupa');
			
			//executando o statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listCor = $stm->fetchAll(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listCor);
		}
		
		public function selectMarca(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT * FROM marca');
			
			//executando o statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listMarca = $stm->fetchAll(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listMarca);
		}
		
		public function selectCategoria(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT * FROM categoria');
			
			//executando o statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listCategoria = $stm->fetchAll(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listCategoria);
		}
		
		public function selectTamanho($tipoTamanho){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT * FROM tamanho WHERE idTipoTamanho = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $tipoTamanho);
			
			//executando o statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listTamanho = $stm->fetchAll(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listTamanho);
		}
	}
?>