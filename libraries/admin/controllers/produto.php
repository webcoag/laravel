<?php

class Admin_Produto_Controller extends Base_Controller {

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
		// no inicio, nao libera o controle de filtro
		$do_search = false;
		// array de retorno de dados para a view
		$view = array();
		// controle do envio do form
		if(isset($_POST['action'])){
			// caso tenha sido efetuada uma busca resgata os dados do form
			$data = Input::all();
			// libera o controle de filtros pra funcionar
			$do_search = true;
			// salva a busca do usuário na sessão
			Session::put('search_produtos', $data);
		} else {
			// verifica se há uma busca já realizada
			if(Session::has('search_produtos')){
				// em caso positivo resgata os dados da sessão
				$data = Session::get('search_produtos');
				// libera o controle de busca
				$do_search = true;
				// e salva a sessão com o controle atual
				Session::put('search_produtos', $data);
			}
		}
		// inicia a query de pesquisa
		$produtos = DB::table('produtos');
		// verifica se foi realizada alguma busca
		if($do_search == true){
			// remove o índice de controle 'action' da busca
			unset($data['action']);
			// percorre todos os filtros para montar a query
			foreach($data as $filtro => $valor){
				// verifica se existe algum valor no filtro
				if($valor != ''){
					// filtro especifico para o campo nome
					if($filtro == 'nome'){
						// seta a busca
						$produtos = $produtos->where($filtro, 'LIKE', '%' . $valor . '%');

					// filtro especifico para o campo codigo
					} elseif($filtro == 'codigo_int'){
						// seta a busca
						$produtos = $produtos->where($filtro, 'LIKE', '%' . $valor . '%');

					// filtro de busca genérico
					} else {
						// seta a busca
						$produtos = $produtos->where($filtro, '=', $valor);
					}
				} // eof if valor
			} // eof foreach data
		}
		// executa a busca com os dados
		$produtos = $produtos->paginate(10);
		// passando a busca para a view
		$view['produtos'] = $produtos;
		// resgata as categorias
		$view['categorias'] 		= Categoria::order_by('nome', 'asc')->get();
		//
		$view['busca_params']		= Session::get('search_produtos');
		//
		if(isset($view['busca_params']['categoria_id']) && !empty($view['busca_params']['categoria_id'])){
			$view['subcategorias'] = Categoria::find($view['busca_params']['categoria_id'])->subcategoria()->order_by('nome', 'asc')->get();
		}
		/**
		 *
		 *
		 *
		 * Carregando os scripts para a View
		 */
		Asset::add('js-produto-busca', 'js/usuario/busca.js', 'jquery')->bundle('admin');
		// chamada da view
		return View::make('admin::produto.busca', $view);
	}

	public function action_novo()
	{
		// controle do envio do form
		$data = Input::all();
		// array de retorno de dados para a view
		$view = array();
		// resgata as categorias
		$view['categorias'] 		= Categoria::order_by('nome', 'asc')->get();
		// resgata as subs, caso haja
		$_subcategoria_id = Input::get('categoria_id');
		if(isset($_subcategoria_id)){
			$view['subcategorias'] = Categoria::find(Input::get('categoria_id'))->subcategoria()->order_by('nome', 'asc')->get();
		} else {
			$view['subcategorias'] = array();
		}

		// verifica se o form foi realmente enviado
		if(isset($data['action'])){

			$rules = array(
				'categoria_id' => 'required',
				'subcategoria_id' => 'required',
				'nome' 		=> 'required:alpha|unique:produtos',
				'codigo_int'	=> 'required:alpha|unique:produtos',
				'preco' => 'required|money',
				'preco_promo' => 'money'
			);

			$validation = Validator::make($data, $rules);

			if($validation->fails()){
				$view['errors'] = $validation->errors;
			} else {

				$data['preco']		 = str_replace(",", ".", str_replace(".", "", $data['preco']));
				$data['preco_promo'] = str_replace(",", ".", str_replace(".", "", $data['preco_promo']));

				if(empty($data['preco_promo']) || $data['preco_promo'] == '0,00'){
					$data['preco_promo'] = null;
				}
				if(empty($data['novidade'])){
					$data['novidade'] = null;
				}
				if(empty($data['destaque'])){
					$data['destaque'] = null;
				}

				$insere_produto = Produto::create(array(
					'categoria_id' 		=> $data['categoria_id'],
					'subcategoria_id' 	=> $data['subcategoria_id'],
					'nome' 				=> $data['nome'],
					'codigo_int'		=> $data['codigo_int'],
					'descricao'			=> $data['descricao'],
					'preco' 			=> $data['preco'],
					'preco_promo' 		=> $data['preco_promo'],
					'novidade' 			=> $data['novidade'],
					'destaque'			=> $data['destaque']
				));

				if($insere_produto != false){
					return Redirect::to('admin/produto/editar/' . $insere_produto->id);
				} else {
					$view['cadastro']['sucesso'] = false;
				}
			}

		}

		Asset::add('js-maskMoney', 'js/jquery/maskMoney.js', 'jquery')->bundle('admin');
		Asset::add('js-produto-novo', 'js/usuario/general.js', 'jquery')->bundle('admin');

		return View::make('admin::produto.novo', $view);
	}

	public function action_editar($id)
	{
		// array de retorno de dados para a view
		$view = array();
		// resgata os dados do produto
		$view['produto'] = Produto::find($id);
		// formatando o valor do produto
		$view['produto']->preco = str_replace(".", ",", str_replace(",", "", $view['produto']->preco));
		// formatando o valor promocional do produto
		if(!empty($view['produto']->preco_promo)){
			$view['produto']->preco_promo = str_replace(".", ",", str_replace(",", "", $view['produto']->preco_promo));
		}
		// controle do envio do form
		$data = Input::all();

		// chama as categorias
		$view['categorias'] 		= Categoria::order_by('nome', 'asc')->get();
		// chamando as subcategorias de acordo com a categoria relacionada
		$view['subcategorias'] 		= Categoria::find($view['produto']->categoria_id)->subcategoria()->order_by('nome', 'asc')->get();
		// chamada das fotos dos produtos
		$view['fotos']				= Produto::find($id)->foto()->order_by('id', 'desc')->get();

		// js de mascaras
		Asset::add('js-maskMoney', 'js/jquery/maskMoney.js', 'jquery')->bundle('admin');
		// plugin de upload assincrono
		Asset::add('jq-ajaxupload', 'js/jquery/ajax-upload-3.5.js', 'jquery')->bundle('admin');
		// javascript general do usuario
		Asset::add('js-produto-general', 'js/usuario/general.js', 'jquery')->bundle('admin');
		// javascript específico da edição de usuários
		Asset::add('js-produto-novo', 'js/usuario/editar.js', 'jquery')->bundle('admin');
		// retorna a monta a view com o template
		return View::make('admin::produto.editar', $view);
	}

	public function action_excluir($id)
	{
		$usuario = Produto::find($id);
		$usuario->delete();
		return Redirect::to('admin/produto/');
	}

	public function action_upload_foto($id)
	{
		// resgatando os dados
		$data = Input::all();
		// recuperando a extensão do arquivo
		$extensao = File::extension($data['foto']['name']);
		// gerando o nome do arquivo
		$nome = sha1(time() + rand(101,10001));
		// realiza o upload da imagem
		Input::upload('foto', path('public') . '/uploads', $nome . '.' . $extensao);
		// foto final
		$foto_final = URL::to() . 'uploads/' . $nome . '.' . $extensao;
		$foto_arquivo = $nome . '.' . $extensao;
		// grava a foto no banco
		$insere_foto = Foto::create(array(
			'produto_id' => $id,
			'foto' => $foto_arquivo
		));
		// retorna o caminho do arquivo
		?>
            <li>
	            <a href="<?php echo $foto_final; ?>" target="_blank" class="thumbnail">
	            	<img src="<?php echo $foto_final; ?>" style="width: 100px; height:100px;">
	            </a> 
	            <div class="caption">
	            	<a href="javascript:void(0);" class="btn btn-danger btn-small delete-foto" data="<?php echo $insere_foto->id; ?>">
	            		<i class="icon-trash"></i>
	            		Excluir
	            	</a>
	        	</div>
            </li>
		<?php
	}

	public function action_deleta_foto($id)
	{
		// seleciona o arquivo do banco
		$arquivo = Foto::find($id);
		// apaga o arquivo
		File::delete( path('public') . '/uploads/' . $arquivo->foto );
		// apaga o registro
		$arquivo->delete();
	}

	public function action_limpa_busca()
	{
		if(Session::has('search_produtos')){
			Session::forget('search_produtos');
		}
		return Redirect::to('admin/produto/');
	}

}
