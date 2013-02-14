@layout('admin::layout.common')

@section('content')

	<h1 class="page-title">
		<i class="icon-asterisk"></i>
		Usuários
	</h1>

	<div class="widget">

		<div class="widget-header">
			<h3>Usuários</h3>
		</div> <!-- /widget-header -->
														
		<div class="widget-content">

			<div class="pull-right">
				<a href="<?php echo URL::to('admin/usuario/novo/') ?>" class="btn btn-small btn-success">Novo</a>
			</div>

			<br /><br />

			<table class="table table-striped table-bordered sort">
				<thead>
					<tr>
						<th>Nome</th>
						<th>E-mail</th>
						<th>Usuário</th>
						<th>Ações</th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach($usuarios as $usuario): ?>
						<tr >
							<td><?php ($usuario->ativo == 'N') ? print '<span class="label label-important">Inativo</span>' : false ; ?> <?php echo $usuario->nome ?></td>
							<td><?php echo $usuario->email ?></td>
							<td><?php echo $usuario->usuario ?></td>
							<td class="action-td">
								<a href="<?php echo URL::to('admin/usuario/editar/' . $usuario->id ) ?>" class="btn btn-small btn-warning">
									<i class="icon-edit"></i>								
								</a>					
								<a href="<?php echo URL::to('admin/usuario/excluir/' . $usuario->id ) ?>" class="btn btn-small">
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