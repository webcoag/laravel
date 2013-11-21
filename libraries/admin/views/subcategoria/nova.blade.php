@layout('admin::layout.common')

@section('content')

	<h1 class="page-title">
		<i class="icon-asterisk"></i>
		Subcategorias
	</h1>

	<div class="widget">

		<div class="widget-header">
			<h3>Nova Subcategoria</h3>
		</div> <!-- /widget-header -->

		<div class="widget-content">

			<form id="edit-profile" class="form-horizontal" action="" method="POST">
				<fieldset>

					<?php 
						if(isset($cadastro)){
							if($cadastro['sucesso'] == true){
								echo Alert::success('<strong>Categoria cadastrada com sucesso</strong>', false);
							} else {
								echo Alert::error('<strong>Atenção:</strong> houve um erro ao cadastrar uma categoria. Por favor, tente novamente.', false);
							}
						}
					?>

					<div class="control-group <?php ($errors->has('categoria_id')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="categoria_id">Categoria</label>
						<div class="controls">
							<select id="categoria_id" name="categoria_id">
								<option value=""></option>
								<?php 
									foreach ($categorias as $categoria) {
										?>
											<option value="<?php echo $categoria->id ?>"><?php echo $categoria->nome; ?></option>
										<?php
									}
								?>
							</select>
							<span><a href="<?php echo URL::to('admin/categoria/nova/') ?>">(Nova Categoria)</a></span>
							<?php echo $errors->first('categoria_id', '<p class="help-block">Por favor, selecione a categoria.</p>'); ?>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="control-group <?php ($errors->has('nome')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="nome">Nome</label>
						<div class="controls">
							<input type="text" class="input-large" id="nome" name="nome" value="<?php echo Input::get('nome'); ?>">
							<?php echo $errors->first('nome', '<p class="help-block">:message</p>'); ?>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Salvar</button> 
						<input type="hidden" name="action" value="1" />
						<a href="<?php echo URL::to('admin/subcategoria/'); ?>" class="btn">Cancelar</a>
					</div> <!-- /form-actions -->
					
				</fieldset>
			</form>

		</div>

	</div>
		
@endsection