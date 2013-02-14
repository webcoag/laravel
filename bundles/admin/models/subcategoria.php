<?php 
	class Subcategoria extends Eloquent {
		// define a tabela do modelo
		public static $table = 'subcategorias';
		// desabilitando registro de created_at and updated_at
		public static $timestamps = false;
		// definindo a relação
		public function categoria()
		{
			return $this->belongs_to('Categoria');
		}
	}
?>