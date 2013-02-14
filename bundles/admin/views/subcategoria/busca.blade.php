@layout('admin::layout.common')

@section('content')

	<h1 class="page-title">
		<i class="icon-asterisk"></i>
		Subcategorias
	</h1>

	<div class="widget">

		<div class="widget-header">
			<h3>Subcategorias</h3>
		</div> <!-- /widget-header -->
														
		<div class="widget-content">

			<div class="pull-right">
				<a href="<?php echo URL::to('admin/subcategoria/nova/') ?>" class="btn btn-small btn-success">Nova</a>
			</div>

			<br /><br />

			<table class="table table-striped table-bordered sort">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Categoria</th>
						<th>Ações</th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach($subcategorias as $subcategoria): ?>
						<tr >
							<td><?php echo $subcategoria->nome ?></td>
							<td><?php echo Subcategoria::find($subcategoria->id)->categoria->nome; ?></td>
							<td class="action-td">
								<a href="<?php echo URL::to('admin/subcategoria/editar/' . $subcategoria->id ) ?>" class="btn btn-small btn-warning">
									<i class="icon-edit"></i>								
								</a>					
								<a href="<?php echo URL::to('admin/subcategoria/excluir/' . $subcategoria->id ) ?>" class="btn btn-small">
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