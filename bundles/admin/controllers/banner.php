<?php

class Admin_Banner_Controller extends Base_Controller {

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

		$view['banners'] = DB::table('banners')->order_by('created_at', 'DESC')->paginate(15);

		// chamada da view
		return View::make('admin::banner.busca', $view);
	}

	public function action_novo()
	{
		// controle do envio do form
		$data = Input::all();
		// array de retorno de dados para a view
		$view = array();

		if(isset($data['action'])){

			$rules = array(
				'descricao' => 'required',
				'banner' => 'required',
				'link' => 'url'
			);

			$validation = Validator::make($data, $rules);

			if($validation->fails()){
				$view['errors'] = $validation->errors;
			} else {

				// recuperando a extensão do arquivo
				$extensao = File::extension($data['banner']['name']);
				// gerando o nome do arquivo
				$nome = sha1(time() + rand(101,10001));
				// realiza o upload da imagem
				Input::upload('banner', path('public') . '/banners', $nome . '.' . $extensao);
				// foto final
				$foto_final = URL::to() . 'banners/' . $nome . '.' . $extensao;
				// 
				$foto_arquivo = $nome . '.' . $extensao;

				if(empty($data['link'])){
					$data['link'] = NULL;
				}

				$insere_banner = Banner::create(array(
					'descricao' => $data['descricao'] 	,
					'banner' => $foto_arquivo			,
					'link' => $data['link']
				));

				if($insere_banner != false){
					$view['cadastro']['sucesso'] = true;
					Input::clear();
				} else {
					$view['cadastro']['sucesso'] = false;
				}

			}

		}
		return View::make('admin::banner.novo', $view);
	}

	public function action_editar($id)
	{
		// controle do envio do form
		$data = Input::all();
		// array de retorno de dados para a view
		$view = array();

		$view['banner'] = Banner::find($id);

		if(isset($data['action'])){

			$rules = array(
				'descricao' => 'required',
				'link' => 'url'
			);

			$validation = Validator::make($data, $rules);

			if($validation->fails()){
				$view['errors'] = $validation->errors;
			} else {
				if($data['banner']['size'] != 0){
					// recuperando a extensão do arquivo
					$extensao = File::extension($data['banner']['name']);
					// gerando o nome do arquivo
					$nome = sha1(time() + rand(101,10001));
					// realiza o upload da imagem
					Input::upload('banner', path('public') . '/banners', $nome . '.' . $extensao);
					// foto final
					$foto_final = URL::to() . 'banners/' . $nome . '.' . $extensao;
					// 
					$foto_arquivo = $nome . '.' . $extensao;
					//
					$view['banner']->banner = $foto_arquivo;
				}
				$view['banner']->descricao = $data['descricao'];
				$view['banner']->save();
			}

		}
		return View::make('admin::banner.editar', $view);
	}

	public function action_excluir($id)
	{
		$usuario = Banner::find($id);
		$usuario->delete();
		return Redirect::to('admin/banner/');
	}

}