<?php 
	class Categoria extends Eloquent {
		// define a tabela do modelo
		public static $table = 'categorias';
		// desabilitando registro de created_at and updated_at
		public static $timestamps = false;
		// criando a relação com a tabela de subcategoria
		public function subcategoria()
		{
			return $this->has_many('Subcategoria');
		}
	}
?>