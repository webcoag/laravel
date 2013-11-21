<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<?php
			Asset::add('bootstrap'				, 'css/bootstrap.min.css'					);
			// exibe os estilos
			echo Asset::styles();
		?> 
	</head>

	<body>
	
		@yield('content')
	
	</body>	

	<?php 
		// renderiza dos arquivos JS
		Asset::add('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
		// exibe os JS
		echo Asset::scripts();
	?>
	@yield('scripts')
</html>