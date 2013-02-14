jQuery(function($){

	$(document).ready(function(){
		var tipo_pessoa = $("input.radio-tipo-pessoa[checked='checked']").val();
		if(tipo_pessoa != undefined){
			change_box_pessoa(tipo_pessoa);
		}

		// definindo as máscaras
		$('#cpf').mask('999.999.999-99');
		$("#data_nascimento").mask('99/99/9999');

		$('#telefone').mask('(00) 0000-0000',
			{onKeyPress: function(phone, e, currentField, options){
				var new_sp_phone = phone.match(/^(\(11\) 9(5[0-9]|6[0-9]|7[01234569]|8[0-9]|9[0-9])[0-9]{1})/g);
				new_sp_phone ? $(currentField).mask('(00) 00000-0000', options) : $(currentField).mask('(00) 0000-0000', options)
			}
		});

		$("#cep").mask('99999-999');
		$("#cnpj").mask('99.999.999/9999-99');
	});

	$(".radio-tipo-pessoa").click(function(){

		var tipo_pessoa = $(this).val();
		change_box_pessoa(tipo_pessoa);

	});

	function change_box_pessoa(tipo_pessoa)
	{
		if(tipo_pessoa == 'PF'){
			$("#box-pf").show();
			$("#box-pj").hide();
		} else {
			$("#box-pf").hide();
			$("#box-pj").show();
		}
	}

});