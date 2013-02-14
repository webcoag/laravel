jQuery(function($) {

	new AjaxUpload( $("#upload-photo"), {
		// Arquivo que fará o upload
		action: base_ajax_url + "/produto/upload_foto/" + $("#produto-id").val(),
		//Nome da caixa de entrada do arquivo
		name: 'foto',
		// função que chama assim que enviar
		onSubmit: function(file, ext){
			// valida a extensão do envio
			 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
			 	// exibe o erro de extensão caso exista
			 	$("#upload-msg-error").show();
			 	// sai da função
				return false;
			}
			// ativa a barra e progresso
			$("#progress-bar div").attr('style', 'width: 34%');
			// exibe a barra de progresso
			$("#progress-bar").slideDown();
		},
		// chama assim que terminar a requisição
		onComplete: function(file, response){
			// esconde as possiveis mensagens de erros de envios anteriores
			$("#upload-msg-error").hide();
			// exibe o div principal de fotos
			$("#grupo-fotos").slideDown();
			// avança a barra de progresso
			$("#progress-bar div").attr('style', 'width: 100%');
			// insere a nova foto na UL
			$("#exibe-fotos .thumbnails").prepend(response);
			// esconde a barra de progresso
			$("#progress-bar").slideUp('slow');
		} // end of onComplete function
	}); // end of ajax upload

	$(".delete-foto").live('click', function(){

		if(confirm("Deseja realmente excluir esta foto?")){

			var foto_id = $(this).attr('data');
			var element = $(this);

			$.ajax({
				url: base_ajax_url + "/produto/deleta_foto/" + foto_id,
				type: 'POST',
				dataType: 'html',
				data: {
					foto_id: foto_id
				},
				beforeSend: function(){
					element.parent().parent().fadeOut();
				},
				success: function(data) {
					if(data == 'success'){
						element.parent().parent().destroy();
					}
				}
			});

		}

	});

});