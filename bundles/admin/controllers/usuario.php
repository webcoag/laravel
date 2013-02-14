<?php

class Admin_Usuario_Controller extends Base_Controller {

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
		$view['usuarios'] = Usuario::all();
		// chamada da view
		return View::make('admin::usuario.busca', $view);
	}

	public function action_novo()
	{
		// controle do envio do form
		$data = Input::all();
		// array de retorno de dados para a view
		$view = array();
		// verifica se o form foi realmente enviado
		if(isset($data['action'])){

			$rules = array(
				'usuario' 	=> 'required:alpha|unique:rcw_usuarios'			,
				'nome' 		=> 'required:alpha'								,
				'email' 	=> 'required|email|unique:rcw_usuarios'			,
				'senha' 	=> 'required|same:confirma_senha|alpha_num'
			);

			$validation = Validator::make($data, $rules);

			if($validation->fails()){
				$view['errors'] = $validation->errors;
			} else {
				$insere_usuario = Usuario::create(array(
					'usuario' => $data['usuario'],
					'nome' => $data['nome'],
					'email' => $data['email'],
					'senha' => $data['senha'],
					'ativo' => 'S'
				));

				if($insere_usuario != false){
					$view['cadastro']['sucesso'] = true;
					Input::clear();
				} else {
					$view['cadastro']['sucesso'] = false;
				}
			}

		}
		// chamada da view
		return View::make('admin::usuario.novo', $view);
	}

	public function action_editar($id)
	{
		$view = array();
		// resgata os dados do usuário
		$view['usuario'] = Usuario::find($id);
		// controle do envio do form
		$data = Input::all();
		// verifica se o form foi realmente enviado
		if(isset($data['action'])){

			$rules = array(
				'nome' 		=> 'required:alpha'					,
				'email' 	=> 'required|email'					,
				'senha' 	=> 'same:confirma_senha|alpha_num'
			);

			$validation = Validator::make($data, $rules);

			if($validation->fails()){
				$view['errors'] = $validation->errors;
			} else {
				
				$view['usuario']->nome = $data['nome'];
				$view['usuario']->email = $data['email'];
				$view['usuario']->ativo = $data['ativo'];

				if(!empty($data['senha'])){
					$view['usuario']->senha = $data['senha'];
				}

				if($view['usuario']->save()){
					$view['cadastro']['sucesso'] = true;
				}
			}

		}

		return View::make('admin::usuario.editar', $view);
	}

	public function action_excluir($id)
	{
		$usuario = Usuario::find($id);
		$usuario->delete();
		return Redirect::to('admin/usuario/');
	}

}