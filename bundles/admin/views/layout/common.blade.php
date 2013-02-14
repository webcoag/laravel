<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>[cliente] - Sistema</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <script type="text/javascript">var base_ajax_url = '<?php echo URL::to("admin") ?>';</script>
    <?php
    	// inclusão dos arquivos CSS
  		Asset::add('bootstrap'				, 'css/bootstrap.min.css'					)->bundle('admin');
  		Asset::add('bootstrap-responsive'	, 'css/bootstrap-responsive.min.css'		)->bundle('admin');
		Asset::add('adminia-font-awesome'	, 'css/font-awesome.css'					)->bundle('admin');
		Asset::add('adminia'				, 'css/adminia.css'							)->bundle('admin');
		Asset::add('adminia-responsive'		, 'css/adminia-responsive.css'				)->bundle('admin');
		Asset::add('adminia-page-login'		, 'css/pages/dashboard.css'					)->bundle('admin');
		Asset::add('adminia-page-custom'	, 'css/custom.css'							)->bundle('admin');
		// exibe os estilos
		echo Asset::styles();
		// renderiza dos arquivos JS
		Asset::add('jquery'					, 'js/jquery-1.7.2.min.js'					)->bundle('admin');
		Asset::add('bootstrap-js'			, 'js/bootstrap.js'							)->bundle('admin');
		Asset::add('general-js'				, 'js/general.js'							)->bundle('admin');
		// renderiza os js
		echo Asset::scripts();
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
			
			<a class="brand" href="./">[cliente]</a>
			
			<div class="nav-collapse">
			
				<ul class="nav pull-right">
					
					<li class="divider-vertical"></li>
					<li>
						<a href="<?php echo URL::to('admin/login/logout/') ?>"><i class="icon-off"></i> Sair</a>
					</li>
				</ul>
				
			</div> <!-- /nav-collapse -->
			
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->

<div id="content">
	
	<div class="container">
		<div class="row">
			
			<div class="span3">
				
				<div class="account-container">
				
					<div class="account-details">
						<span class="account-name"><?php echo Session::get('usuario'); ?></span>
						<span class="account-role">Administrador</span>
					</div> <!-- /account-details -->
				
				</div> <!-- /account-container -->

				<hr />
				
				<ul id="main-nav" class="nav nav-tabs nav-stacked">
					<!-- Painel -->
					<li <?php (Request::route()->controller == 'home') ? print 'class="active"' : false ; ?>>
						<a href="<?php echo URL::to('admin/home/'); ?>">
							<i class="icon-home"></i>
							Painel
						</a>
					</li>

					<!-- Banners -->
					<li <?php (Request::route()->controller == 'banner') ? print 'class="active"' : false ; ?>>
						<a href="<?php echo URL::to('admin/banner/'); ?>">
							<i class="icon-bookmark"></i>
							Administrar Banners
						</a>
					</li>

					<li <?php (Request::route()->controller == 'categoria') ? print 'class="active"' : false ; ?>>
						<a href="<?php echo URL::to('admin/categoria/'); ?>">
							<i class="icon-tag"></i>
							Categorias
						</a>
					</li>

					<li <?php (Request::route()->controller == 'subcategoria') ? print 'class="active"' : false ; ?>>
						<a href="<?php echo URL::to('admin/subcategoria/'); ?>">
							<i class="icon-tags"></i>
							Subcategorias
						</a>
					</li>

					<li <?php (Request::route()->controller == 'produto') ? print 'class="active"' : false ; ?>>
						<a href="<?php echo URL::to('admin/produto/'); ?>">
							<i class="icon-tint"></i>
							Produtos
						</a>
					</li>

					<!-- Usuários -->
					<li <?php (Request::route()->controller == 'usuario') ? print 'class="active"' : false ; ?>>
						<a href="<?php echo URL::to('admin/usuario/'); ?>">
							<i class="icon-asterisk"></i>
							Usuários
						</a>
					</li>
				</ul>
				
				<br />
		
			</div> <!-- /span3 -->

			<div class="span9">
				@yield('content')
			</div>

		</div>
		
	</div> <!-- /container -->
	
</div> <!-- /content -->
	
<div id="footer">
	
	<!-- <div class="container">				
		<hr>
		<p>&copy; <?php echo date("Y") ?></p>
	</div> --> <!-- /container -->
	
</div> <!-- /footer -->

  </body>
</html>