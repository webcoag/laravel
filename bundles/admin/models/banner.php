<?php 
	class Banner extends Eloquent {
		// define a tabela do modelo
		public static $table = 'banners';
		// desabilitando registro de created_at and updated_at
		public static $timestamps = true;

	}
?>