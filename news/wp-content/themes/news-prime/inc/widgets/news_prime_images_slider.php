<?php
/**
 * news prime widget Class.
 *
 */
 
class News_Prime_Image_Slider_Widget extends WP_Widget {
	
	function __construct() {

		parent::__construct(

			'News_Prime_Image_Slider_Widget',               // Base ID

			__('News Prime Images Slider Widget','news-prime'),    // Title Name

			array(

				'description' => __( 'text to your website.', 'news-prime' ), 

			),

			array(

				'width' => 600,

			)
			
		);
		
		add_action('wp_enqueue_scripts', array(&$this, 'news_prime_js'));
				
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
			
		$news_prime_slider_cat_data = isset($instance['news_prime_slider_cat_multiple'])?$instance['news_prime_slider_cat_multiple']:'';
		
		$news_prime_max_no_post_data = isset($instance['news_prime_max_no_post'])?$instance['news_prime_max_no_post']:'';
		
		$news_prime_slider_enable_desc = isset($instance['news_prime_slider_enable_desc'])?$instance['news_prime_slider_enable_desc']:'';
		
		$news_images_slider_title = isset($instance['news_images_slider_title'])?$instance['news_images_slider_title']:'';
		
		$category_name = get_category_by_slug($news_prime_slider_cat_data );
		
		if ( $category_name instanceof WP_Term ) {
			
			$category_name = esc_html($category_name->name);
		}else{
			$category_name =esc_html('All Categories');
		}
		
		$news_prime_img_slider_post = array(
		
			'posts_per_page'   => absint($news_prime_max_no_post_data),
			'offset'           => 0,
			'category_name'    =>esc_html($news_prime_slider_cat_data),
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'post',
			'post_status'      => 'publish',
			'suppress_filters' => true 
			
		);
		
		$news_prime_img_slider_post_data = get_posts( $news_prime_img_slider_post ); 
		
		?>
	<div>
		<h3 class="<?php echo absint($widget_id);?> new_headline">
			<?php echo esc_html($news_images_slider_title); ?>
		</h3>
	</div>
	<div id="news_prime_slider">
        <!-- Loading Screen -->
        <div data-u="loading" class="news_slider"></div>
        <div data-u="slides" class="news_slider2">
			<?php
		foreach($news_prime_img_slider_post_data as $key=>$news_prime_img_slider_post_val)
		{
			$news_prime_img_id = absint($news_prime_img_slider_post_val->ID);

			$image_url = wp_get_attachment_url( get_post_thumbnail_id(absint($news_prime_img_id) ));
					 
				   ?>
					<div>
					
						<a href="<?php the_permalink($news_prime_img_id); ?>"><img data-u="image" src="<?php echo esc_attr($image_url); ?>" /></a>
						
						<div data-u="thumb">
							<h3 class="<?php echo absint($widget_id);?> new_post_headline"><a href="<?php the_permalink($news_prime_img_id); ?>"><?php echo esc_html( $news_prime_img_slider_post_val->post_title); ?></a></h3>
						
							<?php
							if($news_prime_slider_enable_desc=='1')
							{
								?>
								<p class="<?php echo absint($widget_id);?> new_post_description"><?php echo esc_html($news_prime_img_slider_post_val->post_content) ; ?></p>
								<?php
							}
							?>
						</div>
						
				
					</div>
				 
				   <?php
			}
			?>
		
        </div>
		
		<div u="thumbnavigator" class="news_thumbnavigator">
            <div u="slides">
                <div u="prototype" class="news_prototype">
                    <div u="thumbnailtemplate" class="news_thumbnailtemplate"></div>
                </div>
            </div>
        </div>
        <!-- Arrow Navigator -->
		<div data-u="arrowleft" class="news_prime_next new_next" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewbox="0 0 16000 16000" class="news_styles">
              <path class="a" d="M11949,1919L5964.9,7771.7c-127.9,125.5-127.9,329.1,0,454.9L11949,14079"></path>
            </svg>
        </div>
        <div data-u="arrowright" class="news_prime_next news_prev" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewbox="0 0 16000 16000" class="news_styles2">
				<path class="a" d="M5869,1919l5984.1,5852.7c127.9,125.5,127.9,329.1,0,454.9L5869,14079"></path>
            </svg>
        </div>
    </div>
		<?php
			
			echo $args['after_widget']; 
	}
	
	public function news_prime_js(){
		if ( is_active_widget(false, false, $this->id_base, true) && !is_search() ) {
		   // enqueue slider scripts;
			wp_enqueue_script( 'jssor-slider-js', get_template_directory_uri(). '/js/jssor.slider.min.js' );
			wp_enqueue_script( 'news-prime-slider-js', get_template_directory_uri(). '/js/news-prime-custom-slider.js' );
		} 
	}
	/**
         * Sets up a new widget instance.
         * display content on backend
     */

	public function form( $instance ) {
		
		global $wpdb,$post;
		
		$news_prime_slider_cat = array(
				'type'                     => 'post',
				'child_of'     	           => 0,
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'hierarchical'             => 1,
				'taxonomy'                 => 'category',
				'pad_counts'               => false
		);
		
		$news_prime_slider_cat_data = get_terms($news_prime_slider_cat);
		
		?>
		
		<table class="form-table">
				
			<tbody>

				<tr>
			
					<th>
					
						<label><?php esc_html_e('Title','news-prime'); ?> </label>
						
					</th>
					
					<td>
					
						<input type="text"  name="<?php echo esc_attr($this->get_field_name('news_images_slider_title')); ?>" value="<?php if (isset($instance['news_images_slider_title'])!='') {echo esc_attr($instance['news_images_slider_title']);} ?>">
						
					</td>
					
				</tr>
	
				<tr>
			
					<th>
					
						<label><?php esc_html_e('Category','news-prime'); ?> </label>
						
					</th>
					
					<td>
					
						<?php $news_prime_slider_post_multiple_cat_data=isset($instance['news_prime_slider_cat_multiple']) ? $instance['news_prime_slider_cat_multiple']:''; ?>
					
						<select name="<?php echo esc_attr($this->get_field_name('news_prime_slider_cat_multiple')); ?>">
						
							<option value=""><?php esc_html_e('All Categories','news-prime'); ?></option>
							<?php
							
							foreach($news_prime_slider_cat_data as $key=>$news_prime_slider_cat_val)
							{
								$news_prime_cat_slug = isset($news_prime_slider_cat_val->slug)?$news_prime_slider_cat_val->slug:'';
								$news_prime_cat_name = isset($news_prime_slider_cat_val->name)?$news_prime_slider_cat_val->name:'';
								
								?>
									<option value="<?php echo esc_attr($news_prime_cat_slug); ?>" <?php if ($news_prime_slider_post_multiple_cat_data==$news_prime_cat_slug){ echo 'selected';} ?> ><?php echo esc_html($news_prime_cat_name); ?></option>
									
								<?php	
							}
							?>
							
						</select>
						
					</td>
					
				</tr>
				
				<tr>
			
					<th>
					
						<label><?php esc_html_e('Max. Number of post','news-prime'); ?> </label>
						
					</th>
					
					<td>
					
						<input  min="0"  name="<?php echo esc_attr($this->get_field_name( 'news_prime_max_no_post' )); ?>" 	type="number" value="<?php if (isset($instance['news_prime_max_no_post'])!='') { echo esc_attr($instance['news_prime_max_no_post']);} ?>">
					
					</td>
					
					
				</tr>
				
				<tr>
			
					<th>
					
						<label><?php esc_html_e('Enable Description','news-prime'); ?> </label>
						
					</th>
					
					<td>
						<?php $news_prime_slider_enable_desc = isset($instance['news_prime_slider_enable_desc'])?$instance['news_prime_slider_enable_desc']:''; ?>
						
						<input  type="checkbox" name="<?php echo esc_attr($this->get_field_name( 'news_prime_slider_enable_desc' )); ?>" <?php if ($news_prime_slider_enable_desc=='1'){ echo 'checked';} ?>  value="<?php echo esc_attr('1');?>">
					
					</td>
					
				</tr>
				
			</tbody>	
					
		</table>			
		<?php
		
	
		
		global $wpdb,$post;
	}
	
/**
 * Save data in database.
 *update instance
 */

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
	
		
		
		$instance['news_prime_max_no_post']=absint($new_instance['news_prime_max_no_post']);
		
		$instance['news_prime_slider_cat_multiple']=  strip_tags( $new_instance['news_prime_slider_cat_multiple']); 
		
		$instance['news_images_slider_title']=sanitize_text_field($new_instance['news_images_slider_title']);
		
		$instance['news_prime_slider_enable_desc']=absint($new_instance['news_prime_slider_enable_desc']);
	
		
		return $instance;
	}

}

  /**
	 * Register Widget class
     * Load widgets.
     */

function news_prime_images_slider_register_widget() 
{

    register_widget( 'News_Prime_Image_Slider_Widget' );
}
add_action( 'widgets_init', 'news_prime_images_slider_register_widget' ); 