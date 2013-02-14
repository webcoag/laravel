jQuery(function($){

	$("#categoria").change(function(){

		var categoria_id = $(this).val();

		$.ajax({
			url: base_ajax_url + '/categoria/ajax_get/',
			type: 'POST',
			dataType: 'html',
			data: {
				categoria_id : categoria_id
			},
			beforeSend: function(){
				$("#ajax-loading-subcategorias").show();
			},
			success: function(data) {
				$("#ajax-loading-subcategorias").hide();
				$("#subcategoria_id").html(data);
			}
		});

	});

	$("#field-search").click(function(){
		$("#box-field-search").slideToggle();
	});

});