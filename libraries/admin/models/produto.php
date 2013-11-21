<?php 
	class Produto extends Eloquent {
		// define a tabela do modelo
		public static $table = 'produtos';
		// desabilitando registro de created_at and updated_at
		public static $timestamps = true;

		public static $per_page = 1;

		public function categoria()
		{
			return $this->has_one('Categoria');
		}

		public function subcategoria()
		{
			return $this->has_one('Subcategoria');
		}

		public function foto()
		{
			return $this->has_many('Foto');
		}
	}
?>