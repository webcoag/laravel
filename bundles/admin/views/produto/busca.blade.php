@layout('admin::layout.common')

@section('content')

	<h1 class="page-title">
		<i class="icon-asterisk"></i>
		Produtos
	</h1>

	<div class="widget">

		<div class="widget-header">
			<h3>Produtos</h3>

		</div> <!-- /widget-header -->

		<div class="widget-content">

			<div class="pull-right">
				<?php 
					if(count($produtos->results) > 0){
						?>
							<a href="javascript:void(0);" id="field-search" class="btn btn-small btn-primary"><i class="icon-search icon-white"></i> Buscar</a>
						<?php
					}
				?>
				<a href="<?php echo URL::to('admin/produto/novo/') ?>" class="btn btn-small btn-success">Novo</a>
			</div>

			<br /><br />

			<form action="<?php echo URL::to('admin/produto/') ?>" class="form-horizontal form-busca-produtos" method="POST">
				<!-- <legend><a href="javascript:void(0);" id="field-search">Filtros de Busca</a></legend> -->

				<div class="well" id="box-field-search" style="display:none;">

					<div class="control-group">											
						<label class="control-label" for="categoria">Categoria</label>
						<div class="controls">
							<select id="categoria" name="categoria_id">
								<option value=""></option>
								<?php
									foreach($categorias as $categoria){

										if(isset($busca_params)){
											if($busca_params['categoria_id'] == $categoria->id){
												$selected = "selected='selected'";
											} else {
												$selected = "";
											}
										} else {
											$selected = "";
										}

										?>
											<option value="<?php echo $categoria->id ?>" <?php echo $selected; ?>><?php echo $categoria->nome ?></option>
										<?php
									}
								?>
							</select>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="control-group">											
						<label class="control-label" for="subcategoria_id">Subcategoria</label>
						<div class="controls">
							<select id="subcategoria_id" name="subcategoria_id">
								<option value=""></option>
								<?php 
									if(isset($busca_params)){

										foreach($subcategorias as $subcategoria){

											if($busca_params['subcategoria_id'] == $subcategoria->id){
												$selected = "selected='selected'";
											} else {
												$selected = "";
											}

											?>
												<option value="<?php echo $subcategoria->id; ?>" <?php echo $selected; ?>><?php echo $subcategoria->nome; ?></option>
											<?php
										}
									} else {
										$selected = "";
									}
								?>
							</select>
							<i class="icon-repeat" id="ajax-loading-subcategorias" style="display:none;"></i>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="control-group">											
						<label class="control-label" for="produto">Produto</label>
						<div class="controls">
							<input type="text" class="input-large" id="produto" name="nome" value="<?php (isset($busca_params['nome'])) ? print $busca_params['nome'] : false ; ?>">
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="control-group">											
						<label class="control-label" for="codigo">Código</label>
						<div class="controls">
							<input type="text" class="input-large" id="codigo" name="codigo_int" value="<?php (isset($busca_params['codigo_int'])) ? print $busca_params['codigo_int'] : false ; ?>">
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->

					<div class="form-actions">
						<button type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i> Buscar</button> 
						<?php 
							if(Session::has('search_produtos')){
								?>
									<a href="<?php echo URL::to('admin/produto/limpa_busca/'); ?>" class="btn btn-small">Limpar Busca</a>
								<?php
							}
						?>
						<input type="hidden" name="action" value="1" />
					</div> <!-- /form-actions -->

				</div>
			</form>

			<?php 
				if(count($produtos->results) > 0){
					?>
						<table class="table table-striped table-bordered sort">
							<thead>
								<tr>
									<th>Nome</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach($produtos->results as $produto){
										?>
											<tr>
												<td><?php echo $produto->nome; ?></td>
												<td class="action-td">
													<a href="<?php echo URL::to('admin/produto/editar/' . $produto->id ) ?>" class="btn btn-small btn-warning">
														<i class="icon-edit"></i>								
													</a>					
													<a href="<?php echo URL::to('admin/produto/excluir/' . $produto->id ) ?>" class="btn btn-small">
														<i class="icon-remove"></i>						
													</a>
												</td>
											</tr>
										<?php
									}
								?>
							</tbody>
						</table>
						<?php echo $produtos->links(); ?>
					<?php
				} else {
					?>
					    <div class="alert">
					    	Desculpe, não encontramos nenhum produto com essas especificações.
					    </div>
					<?php
				}
			?>
			
		</div>

	</div>

@endsection