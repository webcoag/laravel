@layout('admin::layout.common')

@section('content')

	<h1 class="page-title">
		<i class="icon-bookmark"></i>
		Administrar Banners
	</h1>

	<div class="widget">

		<div class="widget-header">
			<h3>Novo Banner</h3>
		</div> <!-- /widget-header -->

		<div class="widget-content">

			<form id="edit-profile" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
				<fieldset>

					<?php 
						if(isset($cadastro)){
							if($cadastro['sucesso'] == true){
								echo Alert::success('<strong>Banner alterado com sucesso</strong>', false);
							} else {
								echo Alert::error('<strong>Atenção:</strong> houve um erro ao alterar o banner. Por favor, tente novamente.', false);
							}
						}
					?>

					<div class="control-group <?php ($errors->has('descricao')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="descricao">Breve descrição</label>
						<div class="controls">
							<input type="text" class="input-large" id="descricao" name="descricao" value="<?php echo $banner->descricao; ?>">
							<?php echo $errors->first('descricao', '<p class="help-block">:message</p>'); ?>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<!-- <div class="control-group <?php ($errors->has('link')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="link">Link</label>
						<div class="controls">
							<input type="text" class="input-large" id="link" name="link" value="<?php echo Input::get('link'); ?>">
							<span class="help-inline">(para não inserir um link, deixe em branco)</span>
							<?php echo $errors->first('link', '<p class="help-block">:message</p>'); ?>
						</div>
					</div> -->

					<div class="control-group <?php ($errors->has('banner')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="banner">Banner</label>
						<div class="controls">
							<input type="file" class="input-large" id="banner" name="banner">
							<a href="<?php echo URL::to() . 'banners/' . $banner->banner ?>" target="_blank" class="btn btn-small btn-info">Ver banner</a>
							<?php echo $errors->first('banner', '<p class="help-block">:message</p>'); ?>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Salvar</button> 
						<input type="hidden" name="action" value="1" />
						<a href="<?php echo URL::to('admin/banner/'); ?>" class="btn">Cancelar</a>
					</div> <!-- /form-actions -->
					
				</fieldset>
			</form>

		</div>

	</div>
		
@endsection