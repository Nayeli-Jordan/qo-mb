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
			footerBottom();
		});
 
		$(document).scroll(function() {

		});
 
		// if( parseInt( isHome ) ){

		// } 

		// if( parseInt( isSingular ) ){

		// } 

	});
})(jQuery);
