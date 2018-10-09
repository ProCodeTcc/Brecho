<?php
	class Imagem{
		public function __constuct(){
			
		}	
		
		public function uploadImagem($nomearquivo){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
			$tamanhoarquivo = round(($_FILES['fleimagem']['size']/1024));

			$extensao = strrchr($nomearquivo, '.');

			$nome_foto = pathinfo($nomearquivo, PATHINFO_FILENAME);

			$nomearquivo = md5(uniqid(time())).$nome_foto.$extensao;

			$upload_dir = "view/arquivos/";

			$extensoes_permitidas = array('.png', '.jpg', '.jpeg', '.gif', '.svg');

			$caminho_imagem = $diretorio.$upload_dir.$nomearquivo;

			if(in_array($extensao, $extensoes_permitidas)){
				if($tamanhoarquivo <= 5120){
					$arquivo_tmp = $_FILES['fleimagem']['tmp_name'];

					if(move_uploaded_file($arquivo_tmp, $caminho_imagem)){
						return $nomearquivo;
					}else{
						echo "<script>alert('erro ao enviar imagem')</script>";
					}
				}else{
					echo "o selecionado excede o limite máximo de 5MB";
				}
			}else{
				echo "extensão inválida";
			}
		}
	}
?>