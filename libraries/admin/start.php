<?php 
	Autoloader::map(array(
	    'Login' 			=> Bundle::path('admin').'models/login' 		. EXT 	,
	    'Usuario'			=> Bundle::path('admin').'models/usuario' 		. EXT 	,
	    'Categoria'			=> Bundle::path('admin').'models/categoria' 	. EXT 	,
	    'Subcategoria'		=> Bundle::path('admin').'models/subcategoria' 	. EXT 	,
	    'Produto'			=> Bundle::path('admin').'models/produto' 		. EXT 	,
	    'Banner'			=> Bundle::path('admin').'models/banner' 		. EXT 	,
	));
?>