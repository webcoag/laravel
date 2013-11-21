<?php 
	class Usuario extends Eloquent {
		// define a tabela do modelo
		public static $table = 'usuarios';
		// desabilitando registro de created_at and updated_at
		public static $timestamps = false;
	}
?>