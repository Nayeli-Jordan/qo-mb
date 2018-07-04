var $=jQuery.noConflict();
 
(function($){
	"use strict";
	$(function(){
 
		/*------------------------------------*\
			#GLOBAL
		\*------------------------------------*/

		$(document).ready(function() {
			// Activa button collapse nav mobile
  			new WOW().init(); 
			//$('.sidenav').sidenav();
			$( ".mb-nav .clearfix" ).append( "</br>" );
		});
 
		$(window).on('resize', function(){
			
		});
 
		$(document).scroll(function() {

		});

		//Scroll menú
		$(" a.item-scroll").click(function() {
			//buttonMenuScroll();
			var idOption = $(this).attr('id'); //Opción del menú
			// console.log(idOption);
			var idSection = "#section-" + idOption; //Sección a la que se dirigirá
			// console.log(idSection); 
			$('html, body').animate({		
				scrollTop: $(idSection).offset().top - 20
			}, 1500);
		});

		$("#link-mail").click(function() {
			$(this).attr('href', 'mailto:mundo.bolita@altoempleo.com.mx');
		});

		$(".bg-icon-buscador").click(function() {
			$( ".aws-search-field" ).keypress();
			console.log('enter');
		});

	});
})(jQuery);
