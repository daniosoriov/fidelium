if(meny_config.hidden_sidebar_position=='top'){
    (function($) { "use strict"; 
	var meny = Meny.create({
		menuElement: document.querySelector( '.meny-sidebar' ),
		contentsElement: document.querySelector( '#wrapper' ),
		position: Meny.getQuery().p || meny_config.hidden_sidebar_position,
		height: meny_config.hidden_sidebar_height,
		width: meny_config.hidden_sidebar_width,
		threshold: 40,
		mouse: meny_config.enable_hidden_hover,
		touch: false
	});
	jQuery(".cs_open").click(function(){
			meny.open();
		});
	jQuery(".cs_close,.cs-overlay").click(function(){
			meny.close();
		});
	if( Meny.getQuery().u && Meny.getQuery().u.match( /^http/gi ) ) {
		var contents = document.querySelector( '.contents' );
		contents.style.padding = '0px';
		contents.innerHTML = '<div class="cover"></div><iframe src="'+ Meny.getQuery().u +'" style="width: 100%; height: 100%; border: 0; position: absolute;"></iframe>';
	}
	jQuery(document).ready(function(){
		/*split width*/
		var width,padding;
		width = 100/(jQuery(".meny-sidebar > div").length - 1);
		padding="";
		if(width==100){
			jQuery(".meny-sidebar > div").css({"padding":0})
		}
		jQuery(".meny-sidebar > div").css({
			"width":width+"%"
		});
	});
    })(jQuery);
}else{
    (function($) { "use strict";
	var current_scroll;
	
	function initSideMenu(){
		jQuery('.cs_open,.cs_close').click(function(e){  
			e.preventDefault();
			if(!jQuery('.cs_open').hasClass('opened')){
				jQuery('.meny-sidebar').css({'visibility':'visible','opacity':'1'});
				jQuery('.meny-sidebar').addClass(meny_config.hidden_sidebar_position);
				jQuery(this).addClass('opened');
				jQuery('body').addClass(meny_config.hidden_sidebar_position+'_sidebar_opened');
				current_scroll = jQuery(window).scrollTop();
				
				jQuery(window).scroll(function() {
					var scroll = jQuery(window).scrollTop();
					if(Math.abs(scroll - current_scroll) > 400){
						var hide_side_menu = setTimeout(function(){
							jQuery('.meny-sidebar').css({'visibility':'hidden','opacity':'0'});
							jQuery('.meny-sidebar').removeClass(meny_config.hidden_sidebar_position);
							jQuery('.cs_open').removeClass('opened');
							jQuery('body').removeClass(meny_config.hidden_sidebar_position+'_sidebar_opened');
							clearTimeout(hide_side_menu);
						},400);
					}
				});
			}else{
				var hide_side_menu = setTimeout(function(){
					jQuery('.meny-sidebar').css({'visibility':'hidden','opacity':'0'});
					jQuery('.meny-sidebar').removeClass(meny_config.hidden_sidebar_position);
					jQuery('.cs_open').removeClass('opened');
					jQuery('body').removeClass(meny_config.hidden_sidebar_position+'_sidebar_opened');
					clearTimeout(hide_side_menu);
				},400);
			}
		});
	}
	initSideMenu();
    })(jQuery);
}