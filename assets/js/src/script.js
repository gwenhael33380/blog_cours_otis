(function($) { // fonction anonyme qui déclare jQuery par un $

	// oblige la déclaration de variable
	"use strict";

	// va attendre que la page soit chargée pour executer les scripts qi'il contient
	$(document).ready(function() {  
		$(".to_connect").on('click', function() {
			$(this).next().slideToggle();
		});

		// popup del
		let spanLabel = $('.delete_label');
		$(".delete_article, .delete_comment").on('click', function(e) {
			e.preventDefault();
			let thisLink = $(this);
			let url = thisLink.attr('href');
			if(url.indexOf('comment') >= 0) {
				spanLabel.html('ce commentaire ?');
			}
			else {
				spanLabel.html('cet article ?');
			}
			thisLink.parents('main').addClass('delete_open').next().fadeIn();
			$(".delete_link").on('click', function(e) {
				e.preventDefault();
				window.location.href = url;
			})
			
		});

		// pour refermer la popup avec le bouton return
		$(".close_popup").on('click', function() {
			$(".pop_delete").fadeOut();
		});

		// pour refermer la popup si on clique à côté d'elle
		$(document).on('click', function(e) {
			// j'analyse le click et je vérifie qu'il ne correspond pas à la corbeille ni à la popup
			// Sinon il refermerait tout de suite la popup
			if(!$(e.target).closest('.pop_delete, .delete_article, .delete_comment').length) {
				if($('main').hasClass('delete_open')) {
					$('main').removeClass('delete_open');
					$(".close_popup").trigger('click');
				}
			}
		});
		

	});
})(jQuery);