<?php
	/*
		Projeto: Brechó
		Autor: Lucas Eduardo
		Data: 18/10/2018
		Objetivo: listar o slider na index
	*/

	class controllerSlider{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
			require_once($diretorio.'model/sliderClass.php');
			require_once($diretorio.'model/dao/sliderDAO.php');
		}
		
		//função que lista o slider
		public function listarSlider(){
			//instância da classe SliderDAO
			$sliderDAO = new SliderDAO();
			
			//armazenando os dados em uma variável
			$listSlider = $sliderDAO->selectAll();
			
			//retornando os dados
			return $listSlider;
		}
	}
?>