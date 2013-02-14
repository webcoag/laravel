<?php

class Admin_Login_Controller extends Base_Controller {

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
		// controle do envio do form
		$data = Input::all();
		// array de retorno de dados para a view
		$view = array();
		// verifica se o form foi realmente enviado
		if(isset($data['action'])){
			// validação do form
			$rules = array(
				'usuario' => 'required:alpha',
				'senha'	  => 'required'
			);
			// aplica a validação
			$validation = Validator::make($data, $rules);
			// retorna a validação
			if($validation->fails()){
				$view['errors'] = $validation->errors;
			} else {

				$usuario = Input::get('usuario');
				$senha	 = Input::get('senha');

				$check = DB::query("SELECT * FROM usuarios WHERE usuario = '".$usuario."' AND senha = '".sha1($senha)."' AND ativo = 'S'");

				if(count($check) > 0){

					Session::put('usuario_logado', $check[0]->id);
					Session::put('nome', $check[0]->nome);
					Session::put('email', $check[0]->email);
					Session::put('usuario', $check[0]->usuario);

					return Redirect::to('admin/home');

				} else {
					$view['errors'] = $validation->errors;
				}

			}

		}
		// chamada da view
		return View::make('admin::login', $view);
	}

	public function action_logout()
	{
		Session::flush();
		return Redirect::to('admin/login/');
	}

}