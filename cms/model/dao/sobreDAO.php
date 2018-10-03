<?php
	class SobreDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
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
		
		public function SelectAllLayout1(){
			$conexao = new ConexaoMySQL();
			
			$PDO_conexao = $conexao->conectarBanco();
			
			$PDO_conexao->exec('SET CHARACTER SET UTF8');
			
			$sql = 'SELECT * FROM sobrelayout1';
			
			$resultado = $PDO_conexao->query($sql);
			
			$cont = 0;
			
			while($rsSobre = $resultado->fetch(PDO::FETCH_OBJ)){
				$listSobre[] = new Sobre();
				$listSobre[$cont]->setId($rsSobre->idLayout1);
				$listSobre[$cont]->setTitulo($rsSobre->titulo);
				$listSobre[$cont]->setDescricao($rsSobre->descricao);
				$listSobre[$cont]->setImagem($rsSobre->imagem);
				
				$cont++;
			}
			
			return $listSobre;
			
			$conexao->fecharConexao();
		}
	}
?>