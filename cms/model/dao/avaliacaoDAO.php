<?php

	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 05/10/2018
		Objetivo: Implementado função que transfere os dados do produto em caso de aprovação
	*/

	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 08/11/2018
		Objetivo: Implementado função que pesquisa os produtos em avaliação
	*/

	class AvaliacaoDAO{
		public function __construct(){
            require_once('bdClass.php');	
		}
		
		//função que lista os produtos
		public function selectAllCF(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$sql = 'SELECT cp.idClienteFisico, p.*, f.caminhoImagem as imagem FROM clientefisico_produtoavaliacao AS cp INNER JOIN produtoavaliacao as p 
			ON p.idprodutoavaliacao = cp.idprodutoavaliacao INNER JOIN produtoavaliacao_fotoproduto as pf ON p.idprodutoavaliacao = pf.idprodutoavaliacao 
			INNER JOIN fotoproduto as f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN clientefisico as cf on cp.idClienteFisico = cf.idCliente GROUP BY p.idprodutoavaliacao';
			
			//armazenando o resultado em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsProdutos = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando um novo produto
				$listProdutos[] = new Avaliacao();

				//setando os atributos
				$listProdutos[$cont]->setIdCliente($rsProdutos->idClienteFisico);
				$listProdutos[$cont]->setId($rsProdutos->idprodutoavaliacao);
				$listProdutos[$cont]->setNome($rsProdutos->nomeProduto);
				$listProdutos[$cont]->setDescricao($rsProdutos->descricao);
				$listProdutos[$cont]->setPreco($rsProdutos->preco);
				$listProdutos[$cont]->setClassificacao($rsProdutos->classificacao);
				$listProdutos[$cont]->setImagem($rsProdutos->imagem);

				//incrementando o contador
				$cont++;
			}

			if($cont != 0){
				//retornando a lista com os produtos
				return $listProdutos;
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função que lista os produtos
		public function selectAllCJ(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$sql = 'SELECT cp.idClienteJuridico, p.*, f.caminhoImagem as imagem FROM clientejuridico_produtoavaliacao AS cp INNER JOIN produtoavaliacao as p 
			ON p.idprodutoavaliacao = cp.idprodutoavaliacao INNER JOIN produtoavaliacao_fotoproduto as pf ON p.idprodutoavaliacao = pf.idprodutoavaliacao 
			INNER JOIN fotoproduto as f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN clientejuridico as cj on cp.idClienteJuridico = cj.idCliente GROUP BY p.idprodutoavaliacao';
			
			//armazenando o resultado em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsProdutos = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando um novo produto
				$listProdutos[] = new Avaliacao();

				//setando os atributos
				$listProdutos[$cont]->setIdCliente($rsProdutos->idClienteJuridico);
				$listProdutos[$cont]->setId($rsProdutos->idprodutoavaliacao);
				$listProdutos[$cont]->setNome($rsProdutos->nomeProduto);
				$listProdutos[$cont]->setDescricao($rsProdutos->descricao);
				$listProdutos[$cont]->setPreco($rsProdutos->preco);
				$listProdutos[$cont]->setClassificacao($rsProdutos->classificacao);
				$listProdutos[$cont]->setImagem($rsProdutos->imagem);

				//incrementando o contador
				$cont++;
			}

			if($cont != 0){
				//retornando a lista com os produtos
				return $listProdutos;
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que busca um produto através do ID
		public function selectByID($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que busca um produto e seus detalhes que envolvem outras tabelas
			$stm = $PDO_conexao->prepare('SELECT p.idprodutoavaliacao, p.nomeProduto, p.descricao, p.preco, p.classificacao, m.nomeMarca as marca, ct.nomeCategoria as categoria, c.nome, t.tamanho FROM produtoavaliacao as p INNER JOIN marca as m ON m.idMarca = p.idMarca INNER JOIN categoria as ct ON ct.idCategoria = p.idCategoria INNER JOIN corroupa as c ON c.idCor = p.idCor INNER JOIN tamanho as t ON t.idTamanho = p.idTamanho WHERE idprodutoavaliacao = ?');
			
			//parâmetro enviado
			$stm->bindParam(1, $id);
			
			//executando o statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listProduto = $stm->fetch(PDO::FETCH_OBJ);
			
			//retornando os dados em json
			return json_encode($listProduto);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que insere um produto, baseado num select na tabela de produtos avaliação
		public function Insert($id){
			//instância da classe de conexão com banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que insere os dados
			$stm = $PDO_conexao->prepare('INSERT INTO produto(nomeProduto, descricao, preco, classificacao, idMarca, idCategoria, idSubcategoria, idCor, idTamanho, naturezaProduto) 
			SELECT pa.nomeProduto, pa.descricao, pa.preco, pa.classificacao, pa.idMarca, pa.idCategoria, pa.idSubcategoria, pa.idCor, pa.idTamanho, pa.naturezaProduto FROM produtoavaliacao as pa WHERE pa.idprodutoavaliacao = ?');
			
			//parâmetro enviado
			$stm->bindParam(1, $id);
			
			//verificando se foi executado com sucesso
			if($stm->execute()){
				//e então armazena o id do produto em uma variável
				$idProduto = $PDO_conexao->lastInsertId();
				
				//e retorna o ID
				return $idProduto;
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que pega as imagens de um produto em avaliação
		public function selectImages($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT f.* FROM fotoproduto as f INNER JOIN produtoavaliacao_fotoproduto as pa ON f.idImagemProduto = pa.idImagemProduto and pa.idprodutoavaliacao = ?');
			
			//parâmetro enviado
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			//execução do statement
			$stm->execute();
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsImagens = $stm->fetch(PDO::FETCH_OBJ)){
				$listImagens[] = new Avaliacao();
				
				$listImagens[$cont]->setId($rsImagens->idImagemProduto);
				$listImagens[$cont]->setImagem($rsImagens->caminhoImagem);
				
				$cont++;
			}
			
			//retornando a lista com as imagens
			return $listImagens;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que insere as imagens
		public function insertImages($caminhoImagem){
			//armazenando os caminhos das imagens numa array
			$caminhoImagem = array($caminhoImagem);
			
			//instância da classe de conexão com  o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//percorrendo as imagens
			foreach($caminhoImagem as $imagens){
				//query que insere as imagens
				$stm = $PDO_conexao->prepare('INSERT INTO fotoproduto(caminhoImagem) values(?)');
				
				//parâmetros enviados
				$stm->bindParam(1, $imagens);
				
				//executando o statement
				$stm->execute();
				
				//armazenando o ID da imagem em uma variável
				$idImagem = $PDO_conexao->lastInsertId();
			}
			
			//retornando as imagens
			return $idImagem;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que insere o ID do produto e da imagem na tabela de relacionamento
		public function insertProdutoImage($idProduto, $idImagem){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//percorrendo o ID das imagens
			foreach($idImagem as $imagens){
				//query que insere os dados
				$stm = $PDO_conexao->prepare('INSERT INTO produto_fotoproduto(idProduto, idImagemProduto) VALUES(?, ?)');
				
				//parâmetros enviados
				$stm->bindParam(1, $idProduto);
				$stm->bindParam(2, $imagens);
				
				//execução do statement
				$stm->execute();
			}
			
			//verificando se o número de linhas retornadas é diferente de 0
			if($stm->rowCount() != 0){
				//se for, retorna verdadeiro
				return true;
			}else{
				//ou falso se for 0
				return false;
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que exclui o produto da tabela de avaliação
		public function Delete($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que deleta o produto da tabela, assim como suas imagens
			$stm = $PDO_conexao->prepare('DELETE pa.*, pf.*, f.* FROM produtoavaliacao as pa INNER JOIN produtoavaliacao_fotoproduto as pf ON pf.idprodutoavaliacao = pa.idprodutoavaliacao INNER JOIN fotoproduto as f ON f.idImagemProduto = pf.idImagemProduto WHERE pa.idprodutoavaliacao = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $id);
			
			//executando o statement
			$stm->execute();
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função para pesquisar o produto do cliente físico
		public function searchProdutoCF($pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca o produto
			$stm = $PDO_conexao->prepare("SELECT cp.idClienteFisico, p.*, f.caminhoImagem as imagem FROM clientefisico_produtoavaliacao AS cp INNER JOIN produtoavaliacao as p 
			ON p.idprodutoavaliacao = cp.idprodutoavaliacao INNER JOIN produtoavaliacao_fotoproduto as pf ON p.idprodutoavaliacao = pf.idprodutoavaliacao 
			INNER JOIN fotoproduto as f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN clientefisico as cf on cp.idClienteFisico = cf.idCliente 
			WHERE p.nomeProduto LIKE ?");

			//parâmetros enviados
			$stm->bindParam(1, $pesquisa);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsProdutos = $stm->fetch(PDO::FETCH_OBJ)){
				//instância da classe Avaliacao
				$listProdutos[] = new Avaliacao();

				//setando os atributos
				$listProdutos[$cont]->setIdCliente($rsProdutos->idClienteFisico);
				$listProdutos[$cont]->setId($rsProdutos->idprodutoavaliacao);
				$listProdutos[$cont]->setNome($rsProdutos->nomeProduto);
				$listProdutos[$cont]->setDescricao($rsProdutos->descricao);
				$listProdutos[$cont]->setPreco($rsProdutos->preco);
				$listProdutos[$cont]->setClassificacao($rsProdutos->classificacao);
				$listProdutos[$cont]->setImagem($rsProdutos->imagem);

				//contador
				$cont++;
			}

			//verificando se há resultados
			if($cont != 0){
				//retornando os dados
				return $listProdutos;
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para pesquisar os produtos em avaliação do cliente juridico
		public function searchProdutoCJ($pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare("SELECT cp.idClienteJuridico, p.*, f.caminhoImagem as imagem FROM clientejuridico_produtoavaliacao AS cp INNER JOIN produtoavaliacao as p 
			ON p.idprodutoavaliacao = cp.idprodutoavaliacao INNER JOIN produtoavaliacao_fotoproduto as pf ON p.idprodutoavaliacao = pf.idprodutoavaliacao 
			INNER JOIN fotoproduto as f ON f.idImagemProduto = pf.idImagemProduto INNER JOIN clientejuridico as cj on cp.idClienteJuridico = cj.idCliente 
			WHERE p.nomeProduto LIKE ?");

			//parâmetro enviado
			$stm->bindParam(1, $pesquisa);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsProdutos = $stm->fetch(PDO::FETCH_OBJ)){
				//instância da classe Avaliacao
				$listProdutos[] = new Avaliacao();

				//setando os atributos
				$listProdutos[$cont]->setIdCliente($rsProdutos->idClienteJuridico);
				$listProdutos[$cont]->setId($rsProdutos->idprodutoavaliacao);
				$listProdutos[$cont]->setNome($rsProdutos->nomeProduto);
				$listProdutos[$cont]->setDescricao($rsProdutos->descricao);
				$listProdutos[$cont]->setPreco($rsProdutos->preco);
				$listProdutos[$cont]->setClassificacao($rsProdutos->classificacao);
				$listProdutos[$cont]->setImagem($rsProdutos->imagem);

				//incrementando o contador
				$cont++;
			}

			//verificando se há resultados
			if($cont != 0){
				//se houver, retorna a lista com os produtos
				return $listProdutos;
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}
	}
?>