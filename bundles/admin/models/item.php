<?php 
	class Item extends Eloquent {
		// define a tabela do modelo
		public static $table = 'orcamentos_itens';
		// desabilitando registro de created_at and updated_at
		public static $timestamps = false;

		public function orcamento()
		{
			return $this->belongs_to('Orcamento');
		}
	}
?>