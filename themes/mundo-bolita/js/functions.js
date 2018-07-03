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
			$('.sidenav').sidenav();
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

		$('.col-product').hover(function(){
			$(this + 'bg-product').addClass('animated bounce');
		});

	});
})(jQuery);
