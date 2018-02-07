jQuery(document).ready(function($){
	
	jQuery(".news_popular").on("click",function()
		{
		
			jQuery(".news_prime_popular_show").show();
			
			jQuery(".news_prime_recent_show").hide();
			
			jQuery(".news_prime_comments_show").hide();
			
			jQuery(".news_popular").addClass("active");
			jQuery(".news_recent").removeClass("active");
			jQuery(".news_comments").removeClass("active");
		
		});
		
		jQuery(".news_recent").on("click",function()
		{
			jQuery(".news_prime_recent_show").show();
			
			jQuery(".news_prime_popular_show").hide();
			
			jQuery(".news_prime_comments_show").hide();
			
			jQuery(".news_recent").addClass("active");
			jQuery(".news_popular").removeClass("active");
			jQuery(".news_comments").removeClass("active");
			
		});
		
		jQuery(".news_comments").on("click",function()
		{
			jQuery(".news_prime_recent_show").hide();
			
			jQuery(".news_prime_popular_show").hide();
			
			jQuery(".news_prime_comments_show").show();
			
			jQuery(".news_comments").addClass("active");
			jQuery(".news_popular").removeClass("active");
			jQuery(".news_recent").removeClass("active");
			
		});
		 
});		