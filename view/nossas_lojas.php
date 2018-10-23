<?php
	require_once('arquivos/check_login.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/funcoes.js"></script>
		<script src="js/OpenLayers.js"></script>
		<script>
			//função para listar os estados
			function mostrarEstados(){
				//consultando a API do IBGE
				$.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados', function(dados){
					//percorrendo os dados
					for(var i = 0; i < dados.length; i++){
						//colocando os dados no select
						$('#txtestado').append(new Option(dados[i].sigla, dados[i].sigla));
					}
				});
			}
			
			//função para mostrar as cidades de um estado
			function mostrarCidade(){
				var estado = $('#txtestado').val();
				
				$.ajax({
					type: 'POST', //tipo de requisição
					url: '../router.php?controller=NossasLojas&modo=buscarCidade', //url onde será enviada a requisição
					data: {estado:estado}, //dados enviados
					success: function(dados){
						//verifica se há alguma cidade
						if(dados == 'false'){
							//se não houver, limpa o select
							$('#txtcidade').empty();
							
							//mostra mensagem de erro
							$('#txtcidade').append(new Option("nenhuma loja disponível", 'a'));
						}else{
							//se houver, converte os dados para JSON
							json = JSON.parse(dados);
							
							//limpa o select
							$('#txtcidade').empty();
							
							//mostra a cidade
							$('#txtcidade').append(new Option(json.cidade));
							
							//mostra as lojas
							mostrarLojas();
						}
					}
				});
			}
			
			//função para mostrar as lojas
			function mostrarLojas(){
				//pegando a cidade selecionada
				var cidade = $('#txtcidade option:selected').val();
				
				$.ajax({
					type: 'POST', //tipo de requisição
					url: '../router.php?controller=NossasLojas&modo=buscarLoja', //url onde será enviada a requisição
					data: {cidade: cidade}, //dados enviados
					success: function(dados){
						//conversão dos dados para JSON
						json = JSON.parse(dados);
						
						//iniciando a variável
						var lojas = "";
						
						//percorrendo os dados
						for(var i = 0; i < json.length; i++){
							//criando o conteúdo a ser exibido
							lojas += '<div class="linha_loja">';
							lojas += json[i].logradouro+', '+json[i].numero+' - '+json[i].bairro+', '+json[i].cidade+' - '+json[i].estado+', '+json[i].cep+'<img src=icones/pesquisa.png class=pesquisa onClick=mostrarMapa('+json[i].latitude+','+json[i].longitude+')>';
							lojas += '</div>';
							
							//exibindo as lojas na div
							$('.resultado_loja').html(lojas);
							
						}
					}
				});
			}
			
			function mostrarMapa(longitude, latitude){
				$('#mapa').empty();
				map = new OpenLayers.Map("mapa");
				var mapnik         = new OpenLayers.Layer.OSM();
				var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
				var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
				var position       = new OpenLayers.LonLat(longitude, latitude).transform( fromProjection, toProjection);
				var zoom           = 15; 

				map.addLayer(mapnik);
				map.setCenter(position, zoom );
			}
			
			
			$(document).ready(function(){
				checarLogin(<?php echo($login) ?>);
				
				//mostra os estados
				mostrarEstados();
				
				//mostra mapa genérico ao abrir a página
				mostrarMapa('-46.6333094','-23.5505199');
			});
		</script>
		
		<?php
			if(isset($_SESSION['sexo'])){
				require_once('tema.php');
			}
		?>
    </head>
    <body>
        <header>
            <?php
				require_once('arquivos/header.php');
			?>
        </header>
        <main>
            <div class="linha">
                Nossas Lojas
            </div>
            <div class="nossas_lojas">
                <div class="pesquisa_loja">
                    <div class="titulo_loja">
                        Encontre as lojas mais próximas
                    </div>
                    <div class="campos_loja">
                        <select class="select_uf_lojas" id="txtestado" onChange="mostrarCidade()">
                            
                        </select>
                        <select class="select_cidade_lojas" id="txtcidade">
                            <option>selecione um estado</option>
                        </select>
                    </div>
                    <div class="resultado_loja">
<!--
                        <div class="linha_loja" id="lojas">
                            Rua Elton Silva, 905 - Centro, Jandira - SP, 06600-025
                        </div>
-->
                    </div>
                </div>
                <div class="mapa_loja" id="mapa">
                    
                </div>
            </div>
        </main>
        <footer>
            <div class="footer_centro">
                <div class="caixa_rodape">
                    <div class="rodape_titulo">
                        Mais Informações
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="fale_conosco.php"> Fale Conosco</a>
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="nossas_lojas.php"> Nossas Lojas</a>
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="sobre.php"> Sobre</a>
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="perfil.php"> Minha Conta</a>
                    </div>
                </div>
                <div class="caixa_rodape">
                    <div class="rodape_titulo">
                        Sobre o Brechó
                    </div>
                    <div class="linha_rodape">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.
                    </div>
                </div>
                <div class="caixa_rodape">
                    <div class="rodape_titulo">
                        Contatos
                    </div>
                    <div class="linha_rodape">
                        Endereço: Rua Lauro Linhares, 2123 – 202A
Florianópolis, SC, Brasil
                    </div>
                    <div class="linha_rodape">
                        Fone: (11)4002.8922 / Whatsapp: (11)99999.9999
                    </div>
                    <div class="linha_rodape">
                        E-mail: admin@brecho.com.br
                    </div>
                </div>
                <div class="rodape_final">
                    BERNADET Brechó Online. Todos os Direitos Reservados.
                </div>
            </div>
        </footer>
    </body>
</html>
