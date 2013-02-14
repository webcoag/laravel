<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<?php
			Asset::add('bootstrap'				, 'css/bootstrap.min.css'					);
			// exibe os estilos
			echo Asset::styles();
			// renderiza dos arquivos JS
			Asset::add('jquery'					, 'js/jquery-1.7.2.min.js'					);
			Asset::add('bootstrap-js'			, 'js/bootstrap.min.js'						);
			// exibe os JS
			echo Asset::scripts();
		?> 
	</head>

	<body>
	
		@yield('content')
	
	</body>	
</html>