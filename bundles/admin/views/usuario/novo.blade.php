@layout('admin::layout.common')

@section('content')

	<h1 class="page-title">
		<i class="icon-asterisk"></i>
		Usuários
	</h1>

	<div class="widget">

		<div class="widget-header">
			<h3>Novo Usuário</h3>
		</div> <!-- /widget-header -->

		<div class="widget-content">

			<form id="edit-profile" class="form-horizontal" action="" method="POST">
				<fieldset>

					<?php 
						if(isset($cadastro)){
							if($cadastro['sucesso'] == true){
								echo Alert::success('<strong>Usuário cadastrado com sucesso:</strong>.', false);
							} else {
								echo Alert::error('<strong>Atenção:</strong> houve um erro ao cadastrar um usuário. Por favor, tente novamente.', false);
							}
						}
					?>
					<div class="control-group <?php ($errors->has('usuario')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="username">Usuário</label>
						<div class="controls">
							<input type="text" class="input-large" id="username" name="usuario" value="<?php echo Input::get('usuario'); ?>">
							<?php echo $errors->first('usuario', '<p class="help-block">:message</p>'); ?>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					
					<div class="control-group <?php ($errors->has('nome')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="firstname">Nome</label>
						<div class="controls">
							<input type="text" class="input-large" id="firstname" name="nome" value="<?php echo Input::get('nome'); ?>">
							<?php echo $errors->first('nome', '<p class="help-block">:message</p>'); ?>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					
					<div class="control-group <?php ($errors->has('email')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="email">Email</label>
						<div class="controls">
							<input type="text" class="input-large" id="email" name="email" value="<?php echo Input::get('email'); ?>">
							<?php echo $errors->first('email', '<p class="help-block">:message</p>'); ?>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					
					<hr />
					
					<div class="control-group <?php ($errors->has('senha')) ? print 'error' : false ; ?>">											
						<label class="control-label" for="password1">Senha</label>
						<div class="controls">
							<input type="password" class="input-large" id="password1" name="senha" value="">
							<?php echo $errors->first('senha', '<p class="help-block">:message</p>'); ?>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					
					<div class="control-group">											
						<label class="control-label" for="password2">Confirmar Senha</label>
						<div class="controls">
							<input type="password" class="input-large" id="password2" name="confirma_senha" value="">
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
						
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Salvar</button> 
						<input type="hidden" name="action" value="1" />
						<a href="<?php echo URL::to('admin/usuario/'); ?>" class="btn">Cancelar</a>
					</div> <!-- /form-actions -->
				</fieldset>
			</form>

		</div>

	</div>
		
@endsection