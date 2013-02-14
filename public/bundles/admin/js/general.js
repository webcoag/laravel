jQuery(function($){

	$("#main-nav li a.submenu").click(function(){

		$(this).parent().next().slideToggle();
		$(this).parent().find('li a').removeClass('active');
		$(this).parent().addClass('active');

	});

});