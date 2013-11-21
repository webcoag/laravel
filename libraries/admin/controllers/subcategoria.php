<?php

class Admin_Subcategoria_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public function action_index()
	{
		// array de retorno de dados para a view
		$view = array();
		// chama todos os usuários
		$view['subcategorias'] = Subcategoria::order_by('nome', 'asc')->get();
		// chamada da view
		return View::make('admin::subcategoria.busca', $view);
	}

	public function action_nova()
	{
		// controle do envio do form
		$data = Input::all();
		// array de retorno de dados para a view
		$view = array();
		// resgatando as categorias para mostrar no select
		$view['categorias'] = Categoria::order_by('nome', 'asc')->get();
		// verifica se o form foi realmente enviado
		if(isset($data['action'])){

			$rules = array(
				'categoria_id' 	=> 'required',
				'nome' 			=> 'required:alpha'
			);

			$validation = Validator::make($data, $rules);

			if($validation->fails()){
				$view['errors'] = $validation->errors;
			} else {
				$insere_usuario = Subcategoria::create(array(
					'categoria_id' => $data['categoria_id'],
					'nome' => $data['nome']
				));

				if($insere_usuario != false){
					$view['cadastro']['sucesso'] = true;
					Input::clear();
				} else {
					$view['cadastro']['sucesso'] = false;
				}
			}

		}

		return View::make('admin::subcategoria.nova', $view);
	}

	public function action_editar($id)
	{
		// array de retorno de dados para a view
		$view = array();
		// resgata os dados da subcategoria
		$view['subcategoria'] = Subcategoria::find($id);
		// resgatando as categorias para mostrar no select
		$view['categorias'] = Categoria::order_by('nome', 'asc')->get();
		// controle do envio do form
		$data = Input::all();
		// verifica se o form foi realmente enviado
		if(isset($data['action'])){

			$rules = array(
				'categoria_id' 	=> 'required' 		,
				'nome' 			=> 'required:alpha'
			);

			$validation = Validator::make($data, $rules);

			if($validation->fails()){
				$view['errors'] = $validation->errors;
			} else {
				$view['subcategoria']->categoria_id = $data['categoria_id'];
				$view['subcategoria']->nome = $data['nome'];

				if($view['subcategoria']->save()){
					$view['cadastro']['sucesso'] = true;
				}
			}

		}

		return View::make('admin::subcategoria.editar', $view);
	}

	public function action_excluir($id)
	{
		$usuario = Subcategoria::find($id);
		$usuario->delete();
		return Redirect::to('admin/subcategoria/');
	}

}