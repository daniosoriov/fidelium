(function($) { "use strict";
jQuery(document).ready(function($) {
	console.log(one_page);
	$('.header-wrapper').onePageNav({
		currentClass:'current_page_item',
		navItems: '.menu-item > a',
		easing: one_page.easing,
		scrollSpeed: parseInt(one_page.scrollSpeed),
		scrollOffset: parseInt(one_page.scrollOffset),
		changeHash: false
	});

	var windowWidth = $(window).width();
	if(windowWidth >= 992 && windowWidth <= 1199){
		$('.header-v4 .cshero-dropdown .sub-menu li a').on('click',function(){
			$(this).parent().parent('.sub-menu').css({
				opacity: '0',
				visibility: 'hidden'
			});
		});
		$('.header-v4 .cshero-dropdown > li > a').on('click',function(){
			$(this).parent().children('.sub-menu').css({
				opacity: '1',
				visibility: 'visible'
			});
		});
	}
});
})(jQuery);
