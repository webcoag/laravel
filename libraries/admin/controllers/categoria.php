<?php

class Admin_Categoria_Controller extends Base_Controller {

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
		// resgata o tipo e passa pra view
		$view['tipo'] = Input::get('tipo');
		// chama todos os usuários
		$view['categorias'] = Categoria::order_by('nome', 'asc')->get();
		// chamada da view
		return View::make('admin::categoria.busca', $view);
	}

	public function action_nova($tipo)
	{
		// controle do envio do form
		$data = Input::all();
		// array de retorno de dados para a view
		$view = array();
		//
		$view['tipo'] = $tipo;
		// verifica se o form foi realmente enviado
		if(isset($data['action'])){

			$rules = array(
				'nome' 		=> 'required:alpha|unique:categorias'
			);

			$validation = Validator::make($data, $rules);

			if($validation->fails()){
				$view['errors'] = $validation->errors;
			} else {
				$insere_usuario = Categoria::create(array(
					'nome' => $data['nome'],
					'tipo' => $tipo
				));

				if($insere_usuario != false){
					$view['cadastro']['sucesso'] = true;
					Input::clear();
				} else {
					$view['cadastro']['sucesso'] = false;
				}
			}

		}

		return View::make('admin::categoria.nova', $view);
	}

	public function action_editar($id, $tipo)
	{
		// array de retorno de dados para a view
		$view = array();
		//
		$view['tipo'] = $tipo;
		// resgata os dados da categoria
		$view['categoria'] = Categoria::find($id);
		// controle do envio do form
		$data = Input::all();
		// verifica se o form foi realmente enviado
		if(isset($data['action'])){

			$rules = array(
				'nome' 		=> 'required:alpha'
			);

			$validation = Validator::make($data, $rules);

			if($validation->fails()){
				$view['errors'] = $validation->errors;
			} else {
				$view['categoria']->nome = $data['nome'];

				if($view['categoria']->save()){
					$view['cadastro']['sucesso'] = true;
				}
			}

		}

		return View::make('admin::categoria.editar', $view);
	}

	public function action_excluir($id)
	{
		$usuario = Categoria::find($id);
		$usuario->delete();
		return Redirect::to('admin/categoria/');
	}

	public function action_ajax_get()
	{
		$categoria_id = Input::get('categoria_id');

		$subcategorias = Categoria::find($categoria_id)->subcategoria()->order_by('nome', 'asc')->get();

		?> <option value=""></option> <?php
		foreach ($subcategorias as $subcategoria) {
			?>
				<option value="<?php echo $subcategoria->id ?>"><?php echo $subcategoria->nome; ?></option>
			<?php
		}
		exit;
	}

}