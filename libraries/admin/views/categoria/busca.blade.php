@layout('admin::layout.common')

@section('content')

	<h1 class="page-title">
		<i class="icon-asterisk"></i>
		Categorias
	</h1>

	<div class="widget">

		<div class="widget-header">
			<h3>Categorias</h3>
		</div> <!-- /widget-header -->
														
		<div class="widget-content">

			<div class="pull-right">
				<a href="<?php echo URL::to('admin/categoria/nova/') ?>" class="btn btn-small btn-success">Nova</a>
			</div>

			<br /><br />

			<table class="table table-striped table-bordered sort">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Ações</th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach($categorias as $categoria): ?>
						<tr >
							<td><?php echo $categoria->nome ?></td>
							<td class="action-td">
								<a href="<?php echo URL::to('admin/categoria/editar/' . $categoria->id ) ?>" class="btn btn-small btn-warning">
									<i class="icon-edit"></i>								
								</a>					
								<a href="<?php echo URL::to('admin/categoria/excluir/' . $categoria->id ) ?>" class="btn btn-small">
									<i class="icon-remove"></i>						
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

		</div>

	</div>
		
@endsection