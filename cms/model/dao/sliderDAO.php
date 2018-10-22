<?php
	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 19/10/2018
		Objetivo: CRUD de sliders
	*/

	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 22/10/2018
		Objetivo: Implementao a função que limita a exclusão de um conteúdo da pág sobre se houver apenas um
	*/

	class SliderDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		//função que insere um slider
		public function Insert(Slider $slider){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que insere os dados
			$stm = $PDO_conexao->prepare('INSERT INTO slider(caminhoImagem) VALUES(?)');
			
			//parâmetro enviado
			$stm->bindParam(1, $slider->getImagem());
			
			//execução do statement
			$stm->execute();
			
			//verificando o retorno das linha
			if($stm->rowCount() != 0){
				//se for diferente de 0, mostra uma mensagem de sucesso
				echo('Slider inserido com sucesso!!');
			}else{
				//se não, mostra uma mensagem de erro
				echo('Ocorreu um erro ao inserir o slider');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que atualiza um slider
		public function Update(Slider $slider){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que atualiza os dados
			$stm = $PDO_conexao->prepare('UPDATE slider SET caminhoImagem = ? WHERE idSlider = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $slider->getImagem());
			$stm->bindParam(2, $slider->getId());
			
			
			if($stm->execute()){
				echo('Slider atualizado com sucesso!!');
			}else{
				echo('Ocorreu um erro ao atualizar o slider');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
			
		}
		
		//função que busca um slider através do ID
		public function SelectByID($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que busca os dados
			$stm = $PDO_conexao->prepare('SELECT * FROM slider WHERE idSlider = ?');
			
			//parâmetros enviados
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			//execução do statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listSlider = $stm->fetch(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listSlider);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que realiza uma consulta no banco
		public function selectAll(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$sql = 'SELECT * FROM slider';
			
			//armazenando os dados em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsSlider = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando um novo slider
				$listSlider[] = new Slider();
				
				//setando os atributos
				$listSlider[$cont]->setId($rsSlider->idSlider);
				$listSlider[$cont]->setImagem($rsSlider->caminhoImagem);
				$listSlider[$cont]->setStatus($rsSlider->status);
				
				//incrementando o contador
				$cont++;
			}
			
			if($cont != 0){
				//retornando os dados
				return $listSlider;
			}else{
				require_once('../erro_tabela.php');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função para excluri um slider do banco
		public function Delete($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que exclui os dados
			$stm = $PDO_conexao->prepare('DELETE FROM slider WHERE idSlider = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $id);
			
			//execução do statement
			$stm->execute();
			
			//verificando retorno das linhas
			if($stm->rowCount() != 0){
				//mensagem de sucesso
				echo('Slider excluído com sucesso!!');
			}else{
				//mensagem de erro
				echo('Ocorreu um erro ao excluir o slider');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que retorna a quantidade de sliders ativos no banco
		public function checkStatus(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a contagem
			$stm = $PDO_conexao->prepare('SELECT count(status) as status FROM slider WHERE status = 1');
			
			//execução do statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listStatus = $stm->fetch(PDO::FETCH_OBJ);
			
			//retornando os dados
			return $listStatus;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que atualiza o status
		public function updateStatus($status, $id){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//verifica se o status é 1
			if($status == 1){
				$stm = $PDO_conexao->prepare('UPDATE slider SET status = 0 WHERE idSlider = ?');
			}else{
				$stm = $PDO_conexao->prepare('UPDATE slider SET status = 1 WHERE idSlider = ?');
			}
			
			//parâmetro enviado
			$stm->bindParam(1, $id);
			
			//execução do statement
			$stm->execute();
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que verifica o total de conteúdo cadastrado
		public function checkSlider(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT idSlider FROM slider');
			
			//execução do statement
			$stm->execute();
			
			//armazenando o retorno
			$linhas = $stm->rowCount();
			
			//retornando os dados
			return $linhas;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
	}
?>