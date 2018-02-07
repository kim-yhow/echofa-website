<?php
/**
* news prime widget Class.
*
*/
class News_Prime_Author_Widget extends WP_Widget {
	
	function __construct() {

		parent::__construct(

			'news_prime_author_Widget',               // Base ID

			__('News Prime Author Widget','news-prime'),    // Title Name

			array(

				'description' => __( 'text to your website.', 'news-prime' ), 

			),

			array(

				'width' => 600,

			)
		
		);
		
	}

	 /**
	 * Outputs the content for the current widget instance.
	 *
	 *Display arguments
	 */
	function widget( $args, $instance ) 
	{
	 	
		echo $args['before_widget']; 
		
		$widget_id = $args['widget_id'];
	
		global $wpdb,$post;
			
		$news_author_title = isset($instance['news_author_title'])?$instance['news_author_title']:'';
		$news_author_name = isset($instance['news_author_name'])?$instance['news_author_name']:'';
		$news_author_description = isset($instance['news_author_description'])?$instance['news_author_description']:'';
		$news_author_facebook_url = isset($instance['news_author_facebook_url'])?$instance['news_author_facebook_url']:'';
		$news_author_twitter_url = isset($instance['news_author_twitter_url'])?$instance['news_author_twitter_url']:'';
		$news_author_google_url = isset($instance['news_author_google_url'])?$instance['news_author_google_url']:'';	
		$news_author_image = isset($instance['news_author_image'])?$instance['news_author_image']:'';			
		?>
		<div class="<?php echo absint($widget_id);?> news_prime_author_head">
		
			<div class="<?php echo absint($widget_id);?> news_prime_style1">
				<h3 class="<?php echo absint($widget_id);?> new_headline"><?php echo esc_html($news_author_title); ?></h3>
			</div>
			
			<div class="<?php echo absint($widget_id);?> news_prime_author_img">
			
				<?php
				if($news_author_image!='') {
						
					?><img src="<?php  echo esc_attr($news_author_image);?>">

					<?php
				}	
				?>
			</div>
			
			<div class="<?php echo absint($widget_id);?> news_prime_author_details">
				
				<h3 class="<?php echo absint($widget_id);?> new_author_name"><?php echo esc_html($news_author_name); ?></h3>
				<p class="<?php echo absint($widget_id);?> new_author_description"><?php echo esc_html($news_author_description); ?></p>
				
				<ul class="<?php echo absint($widget_id);?> new_author_url">
					
					<?php
					if($news_author_facebook_url!='')
					{
						?>
						<li><a target="_blank" href="<?php echo esc_url_raw($news_author_facebook_url); ?>"><i class="fa fa-facebook"></i></a></li>
						<?php
					}
					if($news_author_twitter_url!='')
					{
						?>
						<li><a target="_blank" href="<?php echo esc_url_raw($news_author_twitter_url); ?>"><i class="fa fa-twitter"></i></a></li>
						<?php
					}
					if($news_author_google_url!='')
					{
						?>
					
						<li><a target="_blank" href="<?php echo esc_url_raw($news_author_google_url); ?>"><i class="fa fa-google-plus"></i></a></li>
						<?php
					}
				
					?>
				</ul>
				
			</div>
		
		</div>

		<?php	
				
			echo $args['after_widget']; 
	}
	
	/**
         * Sets up a new widget instance.
         * display content on backend
     */
	
	public function form( $instance ) {
			   
		global $wpdb,$post;
		
		?>
			<table class="form-table">
				
				<tbody>	
		
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Title','news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input type="text"  name="<?php echo esc_html($this->get_field_name('news_author_title')); ?>" value="<?php if (isset($instance['news_author_title'])!='') {echo esc_html($instance['news_author_title']);} ?>">
							
						</td>
						
						
					</tr>
					
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Name','news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input type="text"  name="<?php echo esc_html($this->get_field_name('news_author_name')); ?>" value="<?php if (isset($instance['news_author_name'])!='') {echo esc_html($instance['news_author_name']);} ?>">
						
						</td>
						
					</tr>
					
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Description'	,'news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input type="text"  name="<?php echo esc_html($this->get_field_name('news_author_description')); ?>" value="<?php if (isset($instance['news_author_description'])!='') {echo esc_html($instance['news_author_description'] );} ?>">
						
						</td>
						
					</tr>
					
					<tr>
					
						<th>
						
							<label><?php esc_html_e('Author Image','news-prime'); ?> </label>
							
						</th>
						
						<td colspan="2">
						<input class="phoen-image-url" id="phoen-image-url" type="text"  style="width: 333px;" name="<?php echo esc_html($this->get_field_name('news_author_image'));?>" value="<?php if(isset($instance['news_author_image'])){ echo esc_html($instance['news_author_image']); }?>"/>
						</td>
						<td>
						<input class="phoen-upload-button button" type="button" class="button" value="<?php esc_attr_e('Upload Image','news-prime');?>" />
						</td>
						
					</tr>
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Facebook URL','news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input type="text" placeholder="<?php echo esc_attr('https://www.facebook.com/');?>"  name="<?php echo esc_html($this->get_field_name('news_author_facebook_url')); ?>" value="<?php if (isset($instance['news_author_facebook_url'])!=''){ echo esc_url_raw($instance['news_author_facebook_url']); } ?>">
						
						</td>
						
					</tr>
					
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Twitter URL','news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input type="text" placeholder="<?php echo esc_attr('https://twitter.com/');?>" name="<?php echo esc_html($this->get_field_name('news_author_twitter_url')); ?>" value="<?php if (isset($instance['news_author_twitter_url'])!='') { echo esc_url_raw($instance['news_author_twitter_url']); } ?>">
						
						</td>
						
					</tr>
					
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Googleplus URL','news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input type="text" placeholder="<?php echo esc_attr('https://plus.google.com/');?>"  name="<?php echo esc_html($this->get_field_name('news_author_google_url')); ?>" value="<?php if (isset($instance['news_author_google_url'])!='') { echo esc_url_raw($instance['news_author_google_url']); } ?>">
						
						</td>
						
					</tr>
					
				</tbody>
					
			</table>	
	
		<script>
		
		jQuery(document).ready(function($){
			
		var mediaUploader;
		
		jQuery('.phoen-upload-button').click(function() {  //media Uploader front image
				  
			if (mediaUploader) {
				  
				mediaUploader.open();
				  
				return;
			  
			} 
				
			mediaUploader = wp.media.frames.file_frame = wp.media({
				
				title: 'Choose Image',
					  
				button: {
																					  
					text: 'Choose Image'
			  
				}, multiple: false 
				
				
			});

				// When a file is selected, grab the URL and set it as the text field's value
				
			mediaUploader.on('select', function() {
					
				attachment = mediaUploader.state().get('selection').first().toJSON();
				  
				jQuery('.phoen-image-url').val(attachment.url);
				 
			});
				
				// Open the uploader dialog
				
				mediaUploader.open();
				
		});
			  
			  
			  
			  //back images uploader
			  
		var mediaUploaders;
			  
		jQuery('.phoen-back-upload-button').click(function(){     //media Uploader back image
				  
		
			if (mediaUploaders) {
				  
				mediaUploaders.open();
				  
				return;
			  
			} 
				
			mediaUploaders = wp.media.frames.file_frame = wp.media({
				
				title: 'Choose Image',
					  
				button: {
																					  
					text: 'Choose Image'
			  
				}, multiple: false 
					
			});

				// When a file is selected, grab the URL and set it as the text field's value
				
			mediaUploaders.on('select', function() {
					
				attachment = mediaUploaders.state().get('selection').first().toJSON();
				  
				jQuery('.phoen-back-image-url').val(attachment.url);
				 
			});
				
				// Open the uploader dialog
				
			mediaUploaders.open();
				
		}); 

	});	
	</script>
	<?php
	}
	
 /**
     * Save data in database.
     *update instance
     */
	 
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
	
		$instance['news_author_title']=strip_tags($new_instance['news_author_title']); 
		$instance['news_author_name']=sanitize_text_field($new_instance['news_author_name']);
		$instance['news_author_description']=sanitize_text_field($new_instance['news_author_description']);
		$instance['news_author_image']=esc_url_raw($new_instance['news_author_image']);
		$instance['news_author_facebook_url']=esc_url_raw($new_instance['news_author_facebook_url']);
		$instance['news_author_twitter_url']=esc_url_raw($new_instance['news_author_twitter_url']);
		$instance['news_author_google_url']=esc_url_raw($new_instance['news_author_google_url']);
	
		return $instance;
	}

}

  /**
	 * Register Widget class
     * Load widgets.
     */
function news_theme_register_widget_author() 
{

    register_widget( 'news_prime_Author_Widget' );
}
add_action( 'widgets_init', 'news_theme_register_widget_author' ); 