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
			/* Modal sistema */
			$('.modal').modal();
			$('select').formSelect();
			// Validation form
			$('form.validation').parsley();

			/* Si se un nuevo apartado */
			if(window.location.href.indexOf("#apartado_creado") > -1) {
				$('#apartado_creado').modal('open');
			}
		});
 
		$(window).on('load', function(){
			/* If is singular orden_compra */
			if ($('#orden_compra').length > 0) {
				$('html, body').animate({		
					scrollTop: $('#orden_compra').offset().top - 50
				}, 1500);
			}			
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
			$(this).attr('href', 'mailto:ventas@mundobolita.com');
		});

		$(".bg-icon-buscador").click(function() {
			$( ".aws-search-field" ).keypress();
			console.log('enter');
		});

		/* Botón imprimir*/
		$("#print-page").click(function() {
			window.print();
		});

	});
})(jQuery);
