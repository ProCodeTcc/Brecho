<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Erro</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
			
		<script>
			function redirecionar(){
				window.location.href="../index.php";
			}
		</script>
	</head>

	<body>
		<div class="container_erro">
			<h1 class="erro_titulo">404</h1>
			
			<span class="erro_tipo">PÁGINA NÃO ENCONTRADA</span>
			<span>pedimos desculpa pelo inconveniente</span>
			
			<img src="imagens/error.png">
			
			<input class="btn_erro" id="btnerro" onClick="redirecionar()" value="VOLTAR PARA PÁGINA INICIAL">
		</div>
	</body>

</html>