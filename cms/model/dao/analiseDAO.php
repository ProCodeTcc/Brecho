<?php
	class AnaliseDAO{
		public function __construct(){
			require_once('bdClass.php');	
		}
		
		public function selectAll(){
			$conexao = new ConexaoMySQL();
			
			$PDO_conexao = $conexao->conectarBanco();
			
			$sql = 'SELECT idProdutoAvaliacao, nomeProduto, descricao, preco, classificacao FROM produtoavaliacao';
			
			$resultado = $PDO_conexao->query($sql);
			
			$cont = 0;
			
			while($rsProdutos = $resultado->fetchAll(PDO::FETCH_OBJ)){
				$listProdutos[] = new Produto();
				$listProdutos->setNome($rsProdutos->nomeProduto);
				$listProdutos->setDescricao($rsProdutos->descricao);
				$listProdutos->setPreco($rsProdutos->preco);
				$listProdutos->setClassificacao($rsProdutos->classificacao);
				$cont++;
			}
			
			return $listProdutos;
			
			$conexao->fecharConexao();
		}
		
	}
?>