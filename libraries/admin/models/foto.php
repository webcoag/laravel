<?php 
	class Foto extends Eloquent {
		// define a tabela do modelo
		public static $table = 'produtos_fotos';
		// desabilitando registro de created_at and updated_at
		public static $timestamps = true;
		// definindo a relação
		public function produto()
		{
			return $this->belongs_to('Produto');
		}
	}
?>