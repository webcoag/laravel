@layout('admin::layout.common')

@section('content')

	<h1 class="page-title">
		<i class="icon-bookmark"></i>
		Administrar Banners
	</h1>

	<div class="widget">

		<div class="widget-header">
			<h3>Banners</h3>
		</div> <!-- /widget-header -->
														
		<div class="widget-content">

			<div class="pull-right">
				<a href="<?php echo URL::to('admin/banner/novo/') ?>" class="btn btn-small btn-success">Novo</a>
			</div>

			<br /><br />

			<?php 
				if(count($banners->results) > 0){
					?>
						<table class="table table-striped table-bordered sort">
							<thead>
								<tr>
									<th>Banner</th>
									<th>Exibições</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($banners->results as $banner): ?>
									<tr>
										<td><?php echo $banner->descricao ?></td>
										<td class="action-td"><?php echo $banner->views; ?></td>
										<td class="action-td" style="width:100px;">
											<a href="<?php echo URL::to('admin/banner/editar/' . $banner->id ) ?>" class="btn btn-small btn-warning">
												<i class="icon-edit"></i>								
											</a>					
											<a href="<?php echo URL::to('admin/banner/excluir/' . $banner->id ) ?>" class="btn btn-small">
												<i class="icon-remove"></i>						
											</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<?php echo $banners->links(); ?>
					<?php
				} else {
					echo Alert::info('Nenhum banner cadastrado até o momento');
				}
			?>

		</div>

	</div>
		
@endsection