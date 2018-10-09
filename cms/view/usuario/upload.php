<?php
	if(isset($_POST)){
		$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/view/';
		$nomearquivo = $_FILES['fleimagem']['name'];
		$tamanhoarquivo = round(($_FILES['fleimagem']['size']/1024));

		$extensao = strrchr($nomearquivo, '.');

		$nome_foto = pathinfo($nomearquivo, PATHINFO_FILENAME);

		$nomearquivo = md5(uniqid(time())).$nome_foto.$extensao;

		$upload_dir = "arquivos/";

		$extensoes_permitidas = array('.png', '.jpg', '.jpeg', '.gif', '.svg');

		$caminho_imagem = $upload_dir.$nomearquivo;

		if(in_array($extensao, $extensoes_permitidas)){
			if($tamanhoarquivo <= 5120){
				$arquivo_tmp = $_FILES['fleimagem']['tmp_name'];

				if(move_uploaded_file($arquivo_tmp, $diretorio.$caminho_imagem)){
					echo "<img src='../$caminho_imagem'>";
//					session_start();
//					$_SESSION['imagem'] = $caminho_imagem;

					echo "<script>frmUsuario.txtimagem.value = '$caminho_imagem'</script>";
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
?>