(function($) {
	"use strict";
	$(document).ready(function() {

		$('.toggleTitle').click(function(){
			$(this).next().slideToggle(200).parent().toggleClass('active');
			return false;
			
		});

	});
})(jQuery);