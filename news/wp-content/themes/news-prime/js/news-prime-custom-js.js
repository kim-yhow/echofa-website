jQuery( document ).ready( function( $ ) {
	
	
	// for header search
	$(".news-prime-search-icon").click(function(){
		$(".news-prime-search-form").slideDown();
		$(".news-prime-search-overlay").addClass('active');
	});
	
	$(".news-prime-search-close-icon").click(function(){
		$(".news-prime-search-form").hide();
		$(".news-prime-search-overlay").removeClass('active');
	});

		// for sidebar toggle on shop page js
	if(jQuery(window).width()<767){ 
		
		jQuery("#sidebar1").hide();
		
		jQuery(".filter-area").click(function(){
			
			jQuery("#sidebar1").slideToggle();
		
		});

	}
	
	// for submenu dropdown on tab and mobile
		if(jQuery(window).width()<=1024){ 
			
			$( ".main-navigation ul li.menu-item-has-children" ).prepend( '<span class="fa fa-plus"></span>' );
			
			$('.main-navigation ul li.menu-item-has-children .fa.fa-plus').click(function(){
				
				$(this).next().next().slideToggle();
				
				$(this).toggleClass('fa-plus fa-minus');
				
			});

		}
	
	
});