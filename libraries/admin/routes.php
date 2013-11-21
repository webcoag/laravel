<?php 
// rotas do admin
Route::controller(Controller::detect('admin'));
// configurando permissões de acesso ao admin
Route::get('admin', array('name' => 'login', function()
{
	
	$uri 			= Request::route()->uri;
	$uri_array 		= explode('/', $uri);

    if(Session::has('usuario_logado') == false){
    	if(!in_array('login', $uri_array)){
			// caso não esteja logado redireciona ele para o login
			return Redirect::to('admin/login');
    	}
	} else {
		return Redirect::to('admin/home');
	}
}));
// configurando permissões de acesso ao admin
Route::filter('pattern: admin/*', array('name' => 'login', function()
{
	
	$uri 			= Request::route()->uri;
	$uri_array 		= explode('/', $uri);

    if(Session::has('usuario_logado') == false){
    	if(!in_array('login', $uri_array)){
			// caso não esteja logado redireciona ele para o login
			return Redirect::to('admin/login');
    	}
	}
}));
// configurando rotas para noticias de categoria
Route::get('admin/noticia-categoria', 'admin::noticia_categoria@index');
?>