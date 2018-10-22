<?php
	/*
		Projeto: CMS do Brechó
		Autor: Lucas Eduardo
		Data: 18/10/2018
		Objetivo: controlar as ações da página de sliders
	*/

	class controllerSlider{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			require_once($diretorio.'model/sliderClass.php');
			require_once($diretorio.'model/dao/sliderDAO.php');
			require_once($diretorio.'model/imagemClass.php');
		}
		
		//função que insere um slider
		public function inserirSlider(){
			//verificando se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//verificando se o input de arquivos está vazio
				if(!empty($_FILES['fleimagem'])){
					//criando uma nova imagem
					$imagemClass = new Imagem();
					
					//armazenando o caminho da imagem em uma variável
					$imagem = $imagemClass->uploadImagem();
				}
				
				//criando um novo slider
				$sliderClass = new Slider();
				
				//setando a imagem
				$sliderClass->setImagem($imagem);
				
				//instância da classe sliderDAO
				$sliderDAO = new SliderDAO();
				
				//chamada do método que insere um slider
				$sliderDAO->Insert($sliderClass);
			}
		}
		
		public function atualizarSlider(){
			//verificando se o método é POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//verificando se o input de arquivos está vazio
				$id = $_POST['id'];
				if($_FILES['fleimagem']['size'] == 0){
					$imagem = $_POST['imagem'];
				}else{
					$imagemClass = new Imagem();
					$imagem = $imagemClass->uploadImagem();
				}
				
				//criando um novo slider
				$sliderClass = new Slider();
				
				//setando o atributo
				$sliderClass->setImagem($imagem);
				$sliderClass->setId($id);
				
				//instância da classe sliderDAO
				$sliderDAO = new SliderDAO();
				
				//chamada do método que insere um slider
				$sliderDAO->Update($sliderClass);
			}
		}
		
		//função que busca um slider
		public function buscarSlider($id){
			//instância da classe SliderDAO
			$sliderDAO = new SliderDAO();
			
			//armazenando os dados em uma variável
			$listSlider = $sliderDAO->SelectByID($id);
			
			//retornando os dados
			echo($listSlider);
		}
		
		//função que lista os sliders
		public function listarSlider(){
			//instância da classe sliderDAO
			$sliderDAO = new SliderDAO();
			
			//armazenando os dados em uma variável
			$listSlider = $sliderDAO->selectAll();
			
			//retornando os dados
			return $listSlider;
		}
		
		//função que exclui um slider
		public function excluirSlider($id){
			//instância da classe SliderDAO
			$sliderDAO = new SliderDAO();
			
			//armazenando o total de sliders
			$slidersAtivos = $sliderDAO->checkSlider();
			
			//verificando o total
			if($slidersAtivos == 1){
				//se for igual a 1, limita a exclusão
				echo('limite');
			}else{
				//chamada da função que deleta o slider
				$sliderDAO->Delete($id);
			}
		}
		
		//função para atualizar o status
		public function atualizarStatus($status, $id){
			//criando um novo Slider
			$sliderDAO = new SliderDAO();
			
			//armazenando a quantidade de sliders ativos
			$statusAtivos = $sliderDAO->checkStatus();
			
			//verifica se é pra ativar 
			if($status == 0){
				//verificando se a qtd de sliders ativos é diferente de 3
				if($statusAtivos->status != 3){
					//se for, atualiza o status
					$sliderDAO->updateStatus($status, $id);
				}else{
					//se for igual a 3, mensagem de erro
					echo 'limite';
				}
			}else{
				$sliderDAO->updateStatus($status, $id);
			}
		}
	}
?>