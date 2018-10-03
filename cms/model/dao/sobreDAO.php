<?php
	class SobreDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		//função que insere o layout 1 no banco de dados
		public function Insert(Sobre $sobre){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
				
			//query para inserir os dados
			$stm = $PDO_conexao->prepare('INSERT INTO sobrelayout1(titulo, descricao, imagem) VALUES(?,?,?)');
			
			//parâmetros enviados
			$stm->bindParam(1, $sobre->getTitulo());
			$stm->bindParam(2, $sobre->getDescricao());
			$stm->bindParam(3, $sobre->getImagem());
			
			//executando o statement
			$stm->execute();
			
			//verificando o retorno
			if($stm->rowCount() != 0){
				echo('Layout inserido com sucesso!!');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que busca no banco todos os dados na tabela de layout
		public function SelectAllLayout1(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			//query que busca os dados no banco
			$sql = 'SELECT * FROM sobrelayout1';
			
			//armazenando o retorno em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//variável de contagem
			$cont = 0;
			
			//percorrendo os dados
			while($rsSobre = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando um novo layout
				$listSobre[] = new Sobre();
				
				//adicionando os dados no layout
				$listSobre[$cont]->setId($rsSobre->idLayout1);
				$listSobre[$cont]->setTitulo($rsSobre->titulo);
				$listSobre[$cont]->setDescricao($rsSobre->descricao);
				$listSobre[$cont]->setImagem($rsSobre->imagem);
				
				$cont++;
			}
			
			return $listSobre;
			
			$conexao->fecharConexao();
		}
		
		public function SelectLayoutByID($id){
			$conexao = new ConexaoMySQL();
			
			$PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET UF8');
			
			$stm = $PDO_conexao->prepare('SELECT * FROM sobrelayout1 WHERE idLayout1 = ?');
			
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			$stm->execute();
			
			$listLayout = $stm->fetch(PDO::FETCH_OBJ);
			
			return json_encode($listLayout);
			
			$conexao->fecharConexao();
		}
		
		public function UpdateLayout(Sobre $layout){
			$conexao = new ConexaoMySQL();
			
			$PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			$stm = $PDO_conexao->prepare('UPDATE sobrelayout1 SET titulo = ?, descricao = ?, imagem = ? WHERE idLayout1 = ?');
			
			$stm->bindParam(1, $layout->getTitulo());
			$stm->bindParam(2, $layout->getDescricao());
			$stm->bindParam(3, $layout->getImagem());
			$stm->bindParam(4, $layout->getId());
			
			$stm->execute();
			
			if($stm->rowCount() != 0){
				echo('Layout atualizado com sucesso!!');
			}
			
			$conexao->fecharConexao();
		}
		
		
		public function InsertLayoutSite(){
			
		}
		
		/*************************************** LAYOUT 2 ***************************************************/
		
		public function InsertLayout2(Sobre $layout2){
			$conexao = new ConexaoMySQL();
			
			$PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			$stm = $PDO_conexao->prepare('INSERT INTO sobrelayout2(titulo, descricao1, descricao2, imagem) VALUES(?,?,?,?)');
			
			$stm->bindParam(1, $layout2->getTitulo());
			$stm->bindParam(2, $layout2->getDescricao());
			$stm->bindParam(3, $layout2->getDescricao2());
			$stm->bindParam(4, $layout2->getImagem());
			
			$stm->execute();
			
			if($stm->rowCount() != 0){
				echo('Layout inserido com sucesso!!');
			}
			
			$cont = 0;
		}
		
		//função que busca no banco todos os dados na tabela de layout
		public function SelectAllLayout2(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			//query que busca os dados no banco
			$sql = 'SELECT * FROM sobrelayout2';
			
			//armazenando o retorno em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//variável de contagem
			$cont = 0;
			
			//percorrendo os dados
			while($rsLayout2 = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando um novo layout
				$listLayout2[] = new Sobre();
				
				//adicionando os dados no layout
				$listLayout2[$cont]->setId($rsLayout2->idLayout2);
				$listLayout2[$cont]->setTitulo($rsLayout2->titulo);
				$listLayout2[$cont]->setDescricao($rsLayout2->descricao1);
				$listLayout2[$cont]->setDescricao($rsLayout2->descricao2);
				$listLayout2[$cont]->setImagem($rsLayout2->imagem);
				
				$cont++;
			}
			
			return $listLayout2;
		}
	}
?>