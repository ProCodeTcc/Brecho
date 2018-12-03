<script>
	function adicionarLayout1(){
		$.ajax({
			type: 'POST',
			url: 'frm_layout1.php',
			success: function(dados){
				$('.modal').show();
				$('.modal').html(dados);
				$('.form').attr('data-modo', 'inserirLayout');
			}
		});
	}
	
	function adicionarLayout2(){
		$.ajax({
			type: 'POST',
			url: 'frm_layout2.php',
			success: function(dados){
				$('.modal').show();
				$('.modal').html(dados);
				$('.form').attr('data-modo', 'inserirLayout');
			}
		});
	}
	
	$(document).ready(function(){
		$('#layout_1').click(function(){
			$('.modal').hide();
		});
		
		$('#layout_2').click(function(){
			$('.modal').hide();
		});
	});
</script>

<div class="layouts_container">
	<div id="layout_1">
		<img src="../imagens/layout1.jpg" onClick="adicionarLayout1();" alt="imagem do layout 1">
	</div>
	
	<div id="layout_2">
		<img src="../imagens/layout2.jpg" onClick="adicionarLayout2();" alt="imagem do layout 2">
	</div>
</div>