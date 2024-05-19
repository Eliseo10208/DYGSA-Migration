/*!
  * modalOpen v2.0.0
  * Copyright 2019-2020 (instagram.com/treckkdesign0)
*/

;(function($){
    $.modalOpen = function(options) {
    	var object = this;
    	var config = $.extend({
            url: undefined,
            data: {},
            width: '500',
            addClass: ''
        }, options);

    	if(config.url !== undefined){
    		$('.modal').remove();
    		var modalOpen = this;
    		config.data.object = this;
    		var modal = config.addClass == '' ? "modal" : "modal "+config.addClass;

			$.ajax({
				cache: false,
				type: 'post',
				url: config.url,
				data: config.data,
				success: function(m){
					$('body').css({'overflow-y': 'hidden'});
					$('body').append(`<div class="${modal}"><div class="modal-content"><button class="modal-close"><span aria-hidden="true">×</span></button>${m}</div></div>`);
					$(`.modal`).find('.modal-content').css({'max-width': config.width+'px', 'margin-top': '-'+($(`.modal`).find('.modal-content').height() * 2)+'px'});
					$('.modal-close').click(function(){close();});
				},
				complete: function(){
					$('.modal').animate({'opacity': 1}, 250, function(){$('.modal .modal-content').animate({'margin-top': '39px'}, 250, "linear");});
				}
			});
			$(document).on('mousedown', function(e){
				const modal = $('.modal').find('.modal-content');
				if(!modal.is(e.target) && modal.has(e.target).length === 0){close();}
			});

			close = function(){
				$('.modal .modal-content').animate({'margin-top': '-'+$('.modal .modal-content').height()+'px'}, 150, "linear", function(){
					$('.modal').animate({'opacity': 0}, 300, function(){
						$(this).remove();
						$('body').css({'overflow-y': 'visible'});
					});
				});
			}
		}
		else
		{
			console.log('ModalOpen: Error en la url');
		}
	}
})(window.jQuery);