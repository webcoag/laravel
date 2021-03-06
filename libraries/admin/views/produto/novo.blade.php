@layout('admin::layout.common')

@section('content')

	<h1 class="page-title">
		<i class="icon-asterisk"></i>
		Produtos
	</h1>

	<div class="widget">

		<div class="widget-header">
			<h3>Novo Produto</h3>
		</div> <!-- /widget-header -->

		<div class="widget-content">

			<form id="edit-profile" class="form-horizontal" action="" method="POST">
				<fieldset>

					<?php 
						if(isset($cadastro)){
							if($cadastro['sucesso'] == true){
								echo Alert::success('<strong>Produto cadastrado com sucesso</strong>', false);
							} else {
								echo Alert::error('<strong>Atenção:</strong> houve um erro ao cadastrar o Produto. Por favor, tente novamente.', false);
							}
						}
					?>

					<div class="control-group <?php ($errors->has('categoria_id')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="categoria">Categoria</label>
						<div class="controls">
							<select id="categoria" name="categoria_id">
								<option value=""></option>
								<?php 
									$_categoria_id = Input::get('categoria_id');

									foreach ($categorias as $categoria) {
										?>
											<option value="<?php echo $categoria->id ?>" <?php ($_categoria_id == $categoria->id) ? print 'selected="selected"' : false; ?>><?php echo $categoria->nome; ?></option>
										<?php
									}
								?>
							</select>
							<?php echo $errors->first('categoria_id', '<p class="help-block">Selecione uma categoria</p>'); ?>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="control-group <?php ($errors->has('subcategoria_id')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="subcategoria_id">Subcategoria</label>
						<div class="controls">
							<select id="subcategoria_id" name="subcategoria_id">
								<option value=""></option>
								<?php 
									if(count($subcategorias) > 0){
										$_subcategoria_id = Input::get('subcategoria_id');

										foreach ($subcategorias as $subcategoria) {
											?>
												<option value="<?php echo $subcategoria->id ?>" <?php ($_subcategoria_id == $subcategoria->id) ? print 'selected="selected"' : false ; ?>><?php echo $subcategoria->nome; ?></option>
											<?php
										}
									}
								?>
							</select>
							<i class="icon-repeat" id="ajax-loading-subcategorias" style="display:none;"></i>
							<?php echo $errors->first('subcategoria_id', '<p class="help-block">Selecione uma subcategoria</p>'); ?>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="control-group <?php ($errors->has('nome')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="nome">Produto</label>
						<div class="controls">
							<input type="text" class="input-large" id="nome" name="nome" value="<?php echo Input::get('nome'); ?>">
							<?php echo $errors->first('nome', '<p class="help-block">:message</p>'); ?>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="control-group <?php ($errors->has('codigo_int')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="codigo_int">Código Interno</label>
						<div class="controls">
							<input type="text" class="input-large" id="codigo_int" name="codigo_int" value="<?php echo Input::get('codigo_int'); ?>">
							<?php echo $errors->first('codigo_int', '<p class="help-block">Digite o código do produto</p>'); ?>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="control-group <?php ($errors->has('descricao')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="descricao">Compatibilidade</label>
						<div class="controls">
							<textarea id="descricao" name="descricao" rows="8" class="input-xxlarge"><?php echo Input::get('descricao'); ?></textarea>
							<?php echo $errors->first('descricao', '<p class="help-block">:message</p>'); ?>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="control-group <?php ($errors->has('preco')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="preco">Preço</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on">R$</span><input type="text" class="input-large" id="preco" name="preco" value="<?php echo Input::get('preco'); ?>">
								<?php echo $errors->first('preco', '<p class="help-block">Digite o valor como no exemplo R$ 1.500,00</p>'); ?>
							</div>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="control-group <?php ($errors->has('preco_promo')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="preco_promo">Promoção</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on">R$</span><input type="text" class="input-large" id="preco_promo" name="preco_promo" value="<?php echo Input::get('preco_promo'); ?>">
								<?php echo $errors->first('preco_promo', '<p class="help-block">:message</p>'); ?>
							</div>
						</div> <!-- /controls -->
					</div> <!-- /control-group -->

					<div class="control-group <?php ($errors->has('novidade')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="novidade">Novidade?</label>
						<div class="controls">
							<?php $_novidade = Input::get('novidade'); ?>
							<input type="checkbox" id="novidade" name="novidade" value="S" <?php ($_novidade == 'S') ? print 'checked="checked"' : false ; ?>>
							<?php echo $errors->first('novidade', '<p class="help-block">:message</p>'); ?>
						</div> <!-- /controls -->
					</div> <!-- /control-group -->

					<div class="control-group <?php ($errors->has('destaque')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="destaque">Destaque?</label>
						<div class="controls">
							<?php $_destaque = Input::get('destaque'); ?>
							<input type="checkbox" id="destaque" name="destaque" value="S" <?php ($_destaque == 'S') ? print 'checked="checked"' : false ; ?>>
							<?php echo $errors->first('destaque', '<p class="help-block">:message</p>'); ?>
						</div> <!-- /controls -->
					</div> <!-- /control-group -->

					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Salvar</button> 
						<input type="hidden" name="action" value="1" />
						<a href="<?php echo URL::to('admin/produto/'); ?>" class="btn">Cancelar</a>
					</div> <!-- /form-actions -->
					
				</fieldset>
			</form>

		</div>

	</div>

@endsection