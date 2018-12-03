<?php
	/*
        Projeto: Brechó
        Autor: Lucas Eduardo
        Data: 15/10/2018
        Objetivo: manipular os dados da página de promoções

    */

	class PromocaoDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		//realiza uma consulta em busca dos produtos em promoção
		public function selectAll(){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$sql = 'SELECT * FROM Visualizar_Promocao';
			
			//armazenando o resultado da consulta em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//contador
			$cont = 0;
			
			//percorrendo os dados
			while($rsPromocao = $resultado->fetch(PDO::FETCH_OBJ)){
				//criando uma nova promoção
				$listPromocao[] = new Promocao();
				
				//setando os atributos
				$listPromocao[$cont]->setIdProduto($rsPromocao->idProduto);
				$listPromocao[$cont]->setNome($rsPromocao->nomeProduto);
				$listPromocao[$cont]->setPreco($rsPromocao->preco);
				$listPromocao[$cont]->setDesconto($rsPromocao->percentual);
				$listPromocao[$cont]->setTotalDesconto($rsPromocao->total);
				$listPromocao[$cont]->setImagem($rsPromocao->imagem);
				
				$cont++;
			}
			
			//retornando a lista com a promoção
			return $listPromocao;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//selecionando um produto a partir do id
		public function SelectTranslate($id){
			//instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta
			$stm = $PDO_conexao->prepare('SELECT p.idProduto AS idProduto, pt.nomeProduto AS nomeProduto, pt.descricao AS descricao, p.preco AS preco, pr.percentualDesconto AS percentual, c.nome AS cor,
            m.nomeMarca AS marca,ct.nomeCategoria AS categoria, t.tamanho AS tamanho, (p.preco - ((pr.percentualDesconto / 100) * p.preco)) AS total FROM produto p JOIN promocao pr ON p.idProduto = pr.idProduto
            JOIN corroupa c ON c.idCor = p.idCor JOIN marca m ON m.idMarca = p.idMarca JOIN categoria ct ON ct.idCategoria = p.idCategoria JOIN tamanho t ON t.idTamanho = p.idTamanho
            JOIN produto_traducao pt ON pt.idProduto = p.idProduto WHERE idProduto = ?');
			
			//parâmetro enviado
			$stm->bindValue(1, $id, PDO::PARAM_INT);
            			
			//executando o statement
			$stm->execute();
			
			//armazenando os dados em uma variável
			$rsProdutos = $stm->fetch(PDO::FETCH_OBJ);
			
			//criando uma nova promoção
			$listPromocao = new Promocao();
			
			//setando os atributos
			$listPromocao->setId($rsProdutos->idProduto);
			$listPromocao->setNome($rsProdutos->nomeProduto);
			$listPromocao->setDescricao($rsProdutos->descricao);
			$listPromocao->setPreco($rsProdutos->total);
			$listPromocao->setCor($rsProdutos->cor);
			$listPromocao->setMarca($rsProdutos->marca);
			$listPromocao->setCategoria($rsProdutos->categoria);
			$listPromocao->setTamanho($rsProdutos->tamanho);
			
			//retornando a lista com os produtos
			return $listPromocao;
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
	}
?>