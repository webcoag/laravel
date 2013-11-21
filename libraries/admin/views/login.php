<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <title>[cliente] - Login</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <?php
  		Asset::add('bootstrap'				, 'css/bootstrap.min.css'					)->bundle('admin');
  		Asset::add('bootstrap-responsive'	, 'css/bootstrap-responsive.min.css'		)->bundle('admin');
		Asset::add('adminia-font-awesome'	, 'css/font-awesome.css'					)->bundle('admin');
		Asset::add('adminia'				, 'css/adminia.css'							)->bundle('admin');
		Asset::add('adminia-responsive'		, 'css/adminia-responsive.css'				)->bundle('admin');
		Asset::add('adminia-page-login'		, 'css/pages/login.css'						)->bundle('admin');
		// exibe os estilos
		echo Asset::styles();
    ?>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->	
  </head>

<body>
	
<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 				
			</a>
			
			<a class="brand" href="./">[cliente] - Login</a>
			
			<div class="nav-collapse">
			
				<ul class="nav pull-right">
					
					<li class="">
						
						<a href="javascript:;"><i class="icon-chevron-left"></i> Voltar para o Site</a>
					</li>
				</ul>
				
			</div> <!-- /nav-collapse -->
			
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->


<div id="login-container">
	
	<div id="login-header">
		<h3>Acessar o sistema</h3>
	</div> <!-- /login-header -->

	<div id="login-content" class="clearfix">

		<?php echo Form::open(); ?>
			<fieldset>
				<div class="control-group <?php ($errors->has('usuario')) ? print 'error' : false ; ?>">
					<label class="control-label" for="username">Usuário</label>
					<div class="controls">
						<input type="text" value="<?php echo Input::get('usuario'); ?>" id="username" name="usuario">
					</div>
				</div>
				<div class="control-group <?php ($errors->has('senha')) ? print 'error' : false ; ?>">
					<label class="control-label" for="password">Senha</label>
					<div class="controls">
						<input type="password" id="password" name="senha">
					</div>
				</div>
			</fieldset>

			<?php 
				if(Input::get('action') == '1'){
					if(count($errors->all())){
						echo Alert::error('<strong>Atenção:</strong> usuário e/ou senha inválidos.', false);
					} else {
						echo Alert::error('<strong>Atenção:</strong> usuário e/ou senha inexistentes.', false);
					}
				}
			?>
			
			<div class="pull-right">
				<input type="hidden" name="action" value="1">
				<button type="submit" class="btn btn-warning btn-large">
					Login
				</button>
			</div>
		<?php echo Form::close(); ?>
			
	</div> <!-- /login-content -->
	
</div> <!-- /login-wrapper -->

  </body>
</html>
