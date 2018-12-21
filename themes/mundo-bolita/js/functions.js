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
			/* Si se guardo información del pedido a fábrica */
			if(window.location.href.indexOf("#orden_pedidoFabrica") > -1) {
				$('#orden_pedidoFabrica').modal('open');
			}
		});
 
		
		/* Btn fixed orden compra */
		/* Head table fixed orden compra */
		if ($('.head-orden-fixed').length > 0) {
			var widthPage 	= $('.box-info-products').outerWidth();
			$('.head-orden-fixed').css('width', widthPage);

			var headOrden 	= $('.head-orden').offset();
			var btnOrden 	= $('#btn-ordenCompra').offset();
			$(document).scroll(function() {
				var topWindow 	= $(window).scrollTop();
				if(topWindow >= headOrden.top){
				    $('.head-orden-fixed').removeClass('hide');
				} else {
				    $('.head-orden-fixed').addClass('hide');
				}
				if(topWindow >= btnOrden.top){
				    $('#btn-ordenCompra').addClass('btn-fixed');
				} else {
				    $('#btn-ordenCompra').removeClass('btn-fixed');
				}				
			});
		}
		

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

		if ($('#orden_compra_origen').length > 0) {
			$('#orden_compra_origen').on('change', function() {
				if ($('#orden_compra_origen option:selected').val() == 'Apartada de stock de tienda' ){
					console.log('Tienda');
					$('.content_orden_compra_modeloTienda').removeClass('hide');
					$('.content_orden_compra_modeloFabrica').addClass('hide');
				} else if ($('#orden_compra_origen option:selected').val() == 'Pedido de fábrica' ) {
					console.log('Fábrica');
					$('.content_orden_compra_modeloTienda').addClass('hide');
					$('.content_orden_compra_modeloFabrica').removeClass('hide');
				}	
			});
		}
	});
})(jQuery);