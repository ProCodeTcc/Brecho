<?php
	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 05/10/2018
		Objetivo: Implementado inserção de protudos
	*/

	/*
		Projeto: CMS do Brechó - Atualização
		Autor: Lucas Eduardo
		Data: 06/10/2018
		Objetivo: Implementado exclusão e listagem dos produtos
	*/

	/*
		Projeto: CMS do Brechó - Atualização
		Autor: Lucas Eduardo
		Data: 07/10/2018
		Objetivo: Implementado atualização de imagens
	*/

	/*
        Projeto: CMS do Brechó - Atualização
        Autor: Lucas Eduardo
        Data: 22/10/2018
        Objetivo: Implementao a função que limita a exclusão de um produto se houver apenas um

	*/
	
	/*
        Projeto: CMS do Brechó - Atualização
        Autor: Lucas Eduardo
        Data: 07/11/2018
        Objetivo: Implementao a função que traduz um produto

	*/ 
	
	/*
        Projeto: CMS do Brechó - Atualização
        Autor: Lucas Eduardo
        Data: 08/11/2018
        Objetivo: Implementao a função que pesquisa os produtos
    */ 

	class produtoDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		//função que insere um produto no banco
		public function Insert(Produto $produto){
			
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que insere dados no banco
			$stm = $PDO_conexao->prepare('INSERT INTO produto(nomeProduto, descricao, preco, classificacao, idMarca, idCategoria, idCor, idTamanho, naturezaProduto) VALUES(?,?,?,?,?,?,?,?,1)');
			
			//parâmetros enviados
			$stm->bindParam(1, $produto->getNome());
			$stm->bindParam(2, $produto->getDescricao());
			$stm->bindParam(3, $produto->getPreco());
			$stm->bindParam(4, $produto->getClassificacao());
			$stm->bindParam(5, $produto->getMarca());
			$stm->bindParam(6, $produto->getCategoria());
			$stm->bindParam(7, $produto->getCor());
			$stm->bindParam(8, $produto->getTamanho());
			
			//execução do statement
			$stm->execute();
			
			if($stm->rowCount() != 0){
				//armazenando o ID do produto em uma variável
				$idProduto = $PDO_conexao->lastInsertId();

				return $idProduto;
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que insere as imagens no banco
		public function insertImagem($imagens){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			//percorrendo as imagens
			foreach($imagens as $img){
				//query que insere as imagens no banco
				$stm = $PDO_conexao->prepare('INSERT INTO fotoproduto(caminhoImagem) VALUES(?)');
				
				//parâmetro enviado
				$stm->bindParam(1, $img);
				
				//executando o statement
				$stm->execute();
				
				//armazenando o ID das imagens em uma variável
				$idImagem[] = $PDO_conexao->lastInsertId();
			}
			
			if($stm->rowCount() != 0){
				//retornando os IDs
				return $idImagem;
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		
		public function InsertProdutoImagem($idProduto, $idImagem){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//laço para percorrer o ID das imagens
			foreach($idImagem as $imagens){
				//query que insere os dados
				$stm = $PDO_conexao->prepare('INSERT INTO produto_fotoproduto(idProduto, idImagemProduto) VALUES(?,?)');
				
				//parâmetros enviados
				$stm->bindParam(1, $idProduto);
				$stm->bindParam(2, $imagens);
				
				//executando o statement
				$stm->execute();
			}
			
			if($stm->rowCount() != 0){
				$status = array('status' => 'inserido', 'id' => $idProduto);
			}

			return json_encode($status);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para inserir a tradução do produto
		public function insertTranslate($produto, $idProduto, $idioma){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que insere os dados
			$stm = $PDO_conexao->prepare('INSERT INTO produto_traducao(nomeProduto, descricao, idProduto, codigo_idioma) VALUES(?,?,?,?)');

			//parâmetros enviados
			$stm->bindParam(1, $produto->getNome());
			$stm->bindParam(2, $produto->getDescricao());
			$stm->bindParam(3, $idProduto);
			$stm->bindParam(4, $idioma);

			//execução do statement
			$stm->execute();

			//verificando o retorno
			if($stm->rowCount() != 0){
				//mensagem de sucesso
				$status = array('status'=> 'traduzido');
			}else{
				///mensagem de erro
				$status = array('status' => 'erro');
			}

			//retornando o status me json
			return json_encode($status);

			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function selectImages($idProduto){
			$conexao = new ConexaoMySQL;
			
			$PDO_conexao = $conexao->conectarBanco();
			
			$stm = $PDO_conexao->prepare('SELECT f.* from fotoproduto as f INNER JOIN produto_fotoproduto as pi ON f.idImagemProduto = pi.idImagemProduto INNER JOIN produto as p ON p.idProduto = pi.idProduto WHERE p.idProduto = ?');
			
			$stm->bindValue(1, $idProduto, PDo::PARAM_INT);
			
			$stm->execute();
			
			$cont = 0;
			
			while($rsProdutos = $stm->fetch(PDO::FETCH_OBJ)){
				$listImagens[] = new Produto();
				$listImagens[$cont]->setId($rsProdutos->idImagemProduto);
				$listImagens[$cont]->setImagem($rsProdutos->caminhoImagem);
				
				$cont++;
			}
			
			return $listImagens;
		}
		
		public function Update(Produto $produto){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que atualiza os dados
			$stm = $PDO_conexao->prepare('UPDATE produto SET nomeProduto = ?, descricao = ?, preco = ?, classificacao = ?, idMarca = ?, idCor = ?, idCategoria =?, idTamanho = ? WHERE idProduto = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $produto->getNome());
			$stm->bindParam(2, $produto->getDescricao());
			$stm->bindParam(3, $produto->getPreco());
			$stm->bindParam(4, $produto->getClassificacao());
			$stm->bindParam(5, $produto->getMarca());
			$stm->bindParam(6, $produto->getCor());
			$stm->bindParam(7, $produto->getCategoria());
			$stm->bindParam(8, $produto->getTamanho());
			$stm->bindParam(9, $produto->getId());
			
			//verifica se executou
			if($stm->execute()){
				//armazenando a mensagem de sucesso e uma variável
				$status = array('status' => 'atualizado');
			}else{
				//armazenando a mensagem de erro em uma variável
				$status = array('status' => 'erro');
			}

			//retornando os status em JSON
			return json_encode($status);
				
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para atualizar a tradução
		public function updateTranslate(Produto $produto){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que atualiza os dados
			$stm = $PDO_conexao->prepare('UPDATE produto_traducao SET nomeProduto = ?, descricao = ? WHERE idProduto = ?');

			//parâmetros enviados
			$stm->bindParam(1, $produto->getNome());
			$stm->bindParam(2, $produto->getDescricao());
			$stm->bindParam(3, $produto->getId());

			//verifica se executou
			if($stm->execute()){
				//armazenando a mensagem de sucesso e uma variável
				$status = array('status' => 'atualizado');
			}else{
				//armazenando a mensagem de erro em uma variável
				$status = array('status' => 'erro');
			}

			//retornando os status em JSON
			return json_encode($status);

			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function Delete($id){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a exclusão de todos os dados de um produto, inclusive as imagens
			$stm = $PDO_conexao->prepare('DELETE produto.*, f.*, pi.* from produto INNER JOIN fotoproduto as f INNER JOIN produto_fotoproduto as pi ON produto.idProduto = pi.idProduto and f.idImagemProduto = pi.idImagemProduto WHERE produto.idProduto = ?');
			
			//excluir um produto do banco
			$stm->bindParam(1, $id);
			
			$stm->execute();
			
			//verificando o número de linhas afetadas
			if($stm->rowCount() != 0){
				echo('Produto excluído com sucesso!!');
			}else{
				echo ('erro');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
			
		}
		
		//query que pega todos os produtos do banco
		public function selectAll(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$sql = 'SELECT DISTINCT produto.*, f.caminhoImagem as imagem from produto INNER JOIN fotoproduto as f INNER JOIN produto_fotoproduto as pi ON produto.idProduto = pi.idProduto and pi.idImagemProduto = f.idImagemProduto GROUP BY idProduto';
			
			//armazenando o retorno dos dados em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			$cont = 0;
			
			while($rsProdutos = $resultado->fetch(PDO::FETCH_OBJ)){
				$listProduto[] = new Produto();
				$listProduto[$cont]->setId($rsProdutos->idProduto);
				$listProduto[$cont]->setNome($rsProdutos->nomeProduto);
				$listProduto[$cont]->setDescricao($rsProdutos->descricao);
				$listProduto[$cont]->setPreco($rsProdutos->preco);
				$listProduto[$cont]->setClassificacao($rsProdutos->classificacao);
				$listProduto[$cont]->setMarca($rsProdutos->idMarca);
				$listProduto[$cont]->setCategoria($rsProdutos->idCategoria);
				$listProduto[$cont]->setCor($rsProdutos->idCor);
				$listProduto[$cont]->setTamanho($rsProdutos->idTamanho);
				$listProduto[$cont]->setImagem($rsProdutos->imagem);
				$listProduto[$cont]->setStatus($rsProdutos->status);
				
				$cont++;
			}
			
			if($cont != 0){
				//retornando o id do produto
				return $listProduto;
			}else{
				require_once('../erro_tabela.php');
			}
			
			$conexao->fecharConexao();
		}
		
		//função para selecionar um produto pelo id
		public function selectByID($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT * FROM produto WHERE idProduto = ?');
			
			//parâmetro enviado
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			//executando o statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listProduto = $stm->fetch(PDO::FETCH_OBJ);
			
			//retornando os dados em json
			return json_encode($listProduto);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que busca uma tradução
		public function selectTranslate($id){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca produto
			$stm = $PDO_conexao->prepare('SELECT * FROM produto_traducao WHERE idProduto = ?');

			//parâmetro enviado
			$stm->bindValue(1, $id, PDO::PARAM_INT);

			//execução do statement
			$stm->execute();

			//armazenando os dados
			$listProduto = $stm->fetch(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listProduto);

			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função para atualizar a imagem
		public function updateImagem($imagem, $id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conectacom o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que atualiza as imagens
			$stm = $PDO_conexao->prepare('UPDATE fotoproduto SET caminhoImagem = ? WHERE idImagemProduto = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $imagem);		
			$stm->bindParam(2, $id);
	
			//executando o statement
			if($stm->execute()){
				echo('Imagem atualizada com sucesso!!');
			}else{
				echo('Ocorreu um erro ao atualizar a imagem!!');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function deleteImagem($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que deleta a imagem
			$stm = $PDO_conexao->prepare('UPDATE fotoproduto SET caminhoImagem = "" WHERE idImagemProduto = ?');
			
			//parâmetro enviado
			$stm->bindParam(1, $id);
			
			//executando o statement
			if($stm->execute()){
				echo('Imagem excluida com sucesso!!');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function insertPromocao($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
				
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que deleta a imagem
			$stm = $PDO_conexao->prepare('INSERT INTO promocao(idProduto) SELECT ? from dual WHERE NOT EXISTS(SELECT * FROM promocao WHERE idProduto = ?);');
			
			//parâmetro enviado
			$stm->bindParam(1, $id);
			$stm->bindParam(2, $id);
			
			//executando o statement
			$stm->execute();
			
			//verificando o número de linhas afetadas
			if($stm->rowCount() != 0){
				//se for diferente de 0, signifia que é um novo produto, então mostra uma mensagem de sucesso
				echo('Esse produto foi adicionado á lista de promoções!!');
			}else{
				//se for 0, siginfica que o produto já existe, então mostra uma mensagem de erro
				echo('Esse produto já se encontra em promoção');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function selectTamanho($tamanho){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que consulta os dados
			$stm = $PDO_conexao->prepare('SELECT * FROM tamanho WHERE idTipoTamanho = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $tamanho);
			
			$stm->execute();
			
			$listTamanho = $stm->fetchAll(PDO::FETCH_OBJ);
			
			return json_encode($listTamanho);
			
			$conexao->fecharConexao();
		}
		
		public function selectCores(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta no banco
			$stm = $PDO_conexao->prepare('SELECT * FROM corroupa');
			
			//executando o statement
			$stm->execute();
			
			//armazenando os dados retornados em uma variável
			$listCor = $stm->fetchAll(PDO::FETCH_OBJ);
			
			//retornando os dados em json
			return json_encode($listCor);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function selectMarcas(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta no banco
			$stm = $PDO_conexao->prepare('SELECT * FROM marca');
			
			//executando o statement
			$stm->execute();
			
			//armazenando os dados retornados em uma variável
			$listMarca = $stm->fetchAll(PDO::FETCH_OBJ);
			
			//retornando os dados em json
			return json_encode($listMarca);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function selectCategorias(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			//query que realiza a consulta no banco
			$stm = $PDO_conexao->prepare('SELECT * FROM categoria');
			
			//executando o statement
			$stm->execute();
			
			//armazenando os dados retornados em uma variável
			$listCategoria = $stm->fetchAll(PDO::FETCH_OBJ);
			
			//retornando os dados em json
			return json_encode($listCategoria);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		public function selectSubcategorias($idCategoria){
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

			//armazenando os dados em uma variável
			$listSubcategoria = $stm->fetchAll(PDO::FETCH_OBJ);

			//retornando os dados em JSON
			return json_encode($listSubcategoria);

			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function updateStatus($status, $id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			if($status == 1){
				$stm = $PDO_conexao->prepare('UPDATE produto SET status = 0 WHERE idProduto = ?');
			}else{
				$stm = $PDO_conexao->prepare('UPDATE produto SET status = 1 WHERE idProduto = ?');
			}
			
			//parâmetro enviado
			$stm->bindParam(1, $id);
			
			//executando o statement
			$stm->execute();
			
			//fechando a conexão
			$conexao->fecharConexao();
			
		}
		
		//verifica o total de produtos cadastrados
		public function checkProduto(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT idProduto from produto');
			
			//execução do statement
			$stm->execute();
			
			//armazenando o total de linhas
			$linhas = $stm->rowCount();
			
			//retornando as linhas
			return $linhas;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}

		//função para pesquisar os produtos
		public function searchProduto($pesquisa){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();

			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();

			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT DISTINCT produto.*, f.caminhoImagem as imagem from produto INNER JOIN fotoproduto as f INNER JOIN produto_fotoproduto as pi ON produto.idProduto = pi.idProduto and pi.idImagemProduto = f.idImagemProduto WHERE produto.nomeProduto LIKE ? GROUP BY idProduto');

			//parâmetro enviado
			$stm->bindParam(1, $pesquisa);

			//execução do statement
			$stm->execute();

			//contador
			$cont = 0;

			//percorrendo os dados
			while($rsProdutos = $stm->fetch(PDO::FETCH_OBJ)){
				//criando um novo produto
				$listProduto[] = new Produto();

				//setando os atributos
				$listProduto[$cont]->setId($rsProdutos->idProduto);
				$listProduto[$cont]->setNome($rsProdutos->nomeProduto);
				$listProduto[$cont]->setPreco($rsProdutos->preco);
				$listProduto[$cont]->setImagem($rsProdutos->imagem);
				$listProduto[$cont]->setStatus($rsProdutos->status);

				//incrementando o contador
				$cont++;
			}

			//verificando se há resultados
			if($cont != 0){
				//se houver, retorna o produto
				return $listProduto;
			}

			//fechando a conexão
			$conexao->fecharConexao();
		}
		
	}
?>