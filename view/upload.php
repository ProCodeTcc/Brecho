<?php
	if(isset($_POST)){
		$cont = 1;
		foreach($_FILES['fleimagem']['name'] as $key=>$val){
			$nomearquivo = $_FILES['fleimagem']['name'][$key];
			$tamanhoarquivo = round(($_FILES['fleimagem']['size'][$key]/1024));

			$extensao = strrchr($nomearquivo, '.');

			$nome_foto = pathinfo($nomearquivo, PATHINFO_FILENAME);

			$nomearquivo = md5(uniqid(time())).$nome_foto.$extensao;

			$upload_dir = "../cms/view/arquivos/roupas/";

			$extensoes_permitidas = array('.png', '.jpg', '.jpeg', '.gif', '.svg');

			$caminho_imagem = $upload_dir.$nomearquivo;

		if(in_array($extensao, $extensoes_permitidas)){
			if($tamanhoarquivo <= 5120){
				$arquivo_tmp = $_FILES['fleimagem']['tmp_name'][$key];
				if(move_uploaded_file($arquivo_tmp, $caminho_imagem)){
					echo "<img id='img$cont' src='$caminho_imagem'>";

					echo "<script>frmRoupa.txtimagem$cont.value = '$caminho_imagem'</script>";
				}else{
					echo "<script>alert('erro ao enviar imagem')</script>";
				}
			}else{
				echo "o selecionado excede o limite máximo de 5MB";
			}
		}else{
			echo "extensão inválida";
		}
			$cont++;
		}
	}
?>