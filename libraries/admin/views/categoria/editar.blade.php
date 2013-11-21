@layout('admin::layout.common')

@section('content')

	<h1 class="page-title">
		<i class="icon-asterisk"></i>
		Categorias
	</h1>

	<div class="widget">

		<div class="widget-header">
			<h3>Editar Categoria</h3>
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

					<div class="control-group <?php ($errors->has('nome')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="nome">Nome</label>
						<div class="controls">
							<input type="text" class="input-large" id="nome" name="nome" value="<?php echo $categoria->nome; ?>">
							<?php echo $errors->first('nome', '<p class="help-block">:message</p>'); ?>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Salvar</button> 
						<input type="hidden" name="action" value="1" />
						<a href="<?php echo URL::to('admin/categoria/'); ?>" class="btn">Cancelar</a>
					</div> <!-- /form-actions -->
					
				</fieldset>
			</form>

		</div>

	</div>
		
@endsection