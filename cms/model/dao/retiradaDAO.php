<?php
	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 18/10/2018
		Objetivo: Implementado listagem das unidades
	*/

	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 19/10/2018
		Objetivo: CRUD de retiradas
	*/

	class RetiradaDAO{
		public function __construct(){
			require('bdClass.php');
		}
		
		//função que insere uma retirada
		public function Insert(Retirada $retirada){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que insere os dados
			$stm = $PDO_conexao->prepare('INSERT INTO retirada(dataRetirada, idUnidade, idPedido) VALUES(?,?,?)');
			
			//parâmetros enviados
			$stm->bindParam(1, $retirada->getDtRetirada());
			$stm->bindParam(2, $retirada->getIdUnidade());
			$stm->bindParam(3, $retirada->getIdPedido());
			
			//execução do statement
			$stm->execute();
			
			//execução do statement
			if($stm->rowCount() != 0){
                //mensagem de sucesso
				$status = array('status' => 'marcado');
			}else{
                //mensagem de erro
				$status = array('status' => 'erro');
			}
            
            //retornando o status em JSON
            return json_encode($status);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que atualiza uma retirada
		public function Update(Retirada $retirada){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que atualiza os dados
			$stm = $PDO_conexao->prepare('UPDATE retirada SET dataRetirada = ?, idUnidade = ?, idPedido = ? WHERE idRetirada = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $retirada->getDtRetirada());
			$stm->bindParam(2, $retirada->getIdUnidade());
			$stm->bindParam(3, $retirada->getIdPedido());
			$stm->bindParam(4, $retirada->getIdRetirada());
			
            //execução do statement
			if($stm->execute()){
                //mensagem de sucesso
				$status = array('status' => 'atualizado');
			}else{
                //mensagem de erro
				$status = array('status' => 'erro');
			}
            
            //retornando o status em JSON
            return json_encode($status);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que consulta as retiradas marcadas
		public function selectAll(){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consula
			$sql = 'SELECT * FROM retirada';
			
			//armazenando o resultado em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsRetirada = $resultado->fetch(PDO::FETCH_OBJ)){
				//criado uma nova retirada
				$listRetirada[] = new Retirada;
				
				//setando os atributos
				$listRetirada[$cont]->setIdRetirada($rsRetirada->idRetirada);
				$listRetirada[$cont]->setDtRetirada($rsRetirada->dataRetirada);
				$listRetirada[$cont]->setIdPedido($rsRetirada->idPedido);
				
				//incrementando o contador
				$cont++;
			}
			
			if($cont != 0){
				//retornando os dados
				return $listRetirada;
			}else{
				require_once('../erro_tabela.php');
			}
			
			$conexao->fecharConexao();
		}
		
		public function SelectByID($id){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$stm = $PDO_conexao->prepare('SELECT * FROM retirada WHERE idRetirada = ?');
			
			//parâmetro enviado
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			//execução do statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$listRetirada = $stm->fetch(PDO::FETCH_OBJ);
			
			//retornando os dados em json
			return json_encode($listRetirada);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que deleta uma retirada
		public function Delete($id){
			//instância da classe de conexão com o banco
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que deleta os dados
			$stm = $PDO_conexao->prepare('DELETE FROM retirada WHERE idRetirada = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $id);
			
			//execução do statement
			$stm->execute();
			
			//verificando retorno das linhas
			if($stm->rowCount() != 0){
				//mensagem de sucesso
				echo('Retirada excluída com sucesso!!');
			}else{
				//mensagem de erro
				echo('Ocorreu um erro ao excluir a retirada');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}	
		
		//função que exibe as lojas
		public function selectLojas(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que faz a consulta
			$sql = 'SELECT * FROM nossaloja_unidade';
			
			//armazenando o resultado em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			$listLojas = $resultado->fetchAll(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listLojas);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que exibe os pedidos
		public function selectPedidos(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$sql = 'SELECT * FROM pedidovenda';
			
			//armazenando os dados em uma variavel
			$resultado = $PDO_conexao->query($sql);
			
			$listPedido = $resultado->fetchAll(PDO::FETCH_OBJ);
			
			//retornando os dados em JSON
			return json_encode($listPedido);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
        
        //função para pegar algumas informações do cliente
        public function selectCliente($idPedido){
            //instância da classe de conexão com o banco
            $conexao = new ConexaoMySQL();
            
            //chamada da função que conecta com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //query que busca os dados
            $stm = $PDO_conexao->prepare('SELECT cf.nome, cf.email FROM clientefisico as cf INNER JOIN clientefisico_pedidovenda AS cfp ON cf.idCliente = cfp.idClienteFisico INNER JOIN pedidovenda AS pv ON pv.idPedidoVenda = cfp.idPedidoVenda WHERE pv.idPedidoVenda = ? UNION SELECT cj.razao, cj.email FROM clientejuridico as cj INNER JOIN clientejuridico_pedidovenda AS cjp ON cjp.idClienteJuridico = cj.idCliente INNER JOIN pedidovenda AS pv ON pv.idPedidoVenda = cjp.idPedidoVenda WHERE cjp.idPedidoVenda = ?');
            
            //parâmetros enviados
            $stm->bindParam(1, $idPedido);
            $stm->bindParam(2, $idPedido);
            
            //execução do statement
            $stm->execute();
            
            //armazenando os dados em uma variável
            $listCliente = $stm->fetch(PDO::FETCH_OBJ);
            
            //retornando os dados em JSON
            return json_encode($listCliente);
            
            //fechando a conexão
            $conexao->fecharConexao();
        }
		
	}
?>