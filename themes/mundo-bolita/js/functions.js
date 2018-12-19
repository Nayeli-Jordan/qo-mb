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

			/* Si es una nueva orden */
			if(window.location.href.indexOf("#orden_creada") > -1) {
				$('#orden_creada').modal('open');
			}
			/* Si es una orden actualizada */
			if(window.location.href.indexOf("#orden_actualizada") > -1) {
				$('#orden_actualizada').modal('open');
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

		/* Evitar cruce de modals */
		/*$(".open-modal-status").click(function() {
			var openEstatus = $('#modificar-estatus').modal('open');
			openEstatus.delay(50000).fadeOut(10000).delay("fast").fadeIn(10000);
			//$('#modificar-estatus').modal('open');
		});*/
	});
})(jQuery);
