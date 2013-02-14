jQuery(function($){

	$(".addcart").click(function(){

		var produto_id = $(this).attr('data-id');

		$.ajax({
			url: base_ajax_url + 'carrinho/add_to_cart/',
			type: 'POST',
			dataType: 'html',
			data: {
				produto_id : produto_id
			},
			beforeSend: function(){
				
			},
			success: function(data) {
				document.location.href = base_ajax_url + 'carrinho/';
			}
		});

	});

});