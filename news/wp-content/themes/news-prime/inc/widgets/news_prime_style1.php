<?php
 /**
     * news prime widget Class.
     *
     */
class News_Prime_Style1_Widget extends WP_Widget {
	
	function __construct() {

		parent::__construct(

			'news_prime_style1_widget',               // Base ID

			__('News Prime Style 1 Widget','news-prime'),    // Title Name

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
		
		$news_style1_title = isset($instance['news_style1_title'])?$instance['news_style1_title']:'';
		$news_style1_catid = isset($instance['news_style1_select_category'])?$instance['news_style1_select_category']:'';
		$news_style1_post = isset($instance['news_style1_post'])?$instance['news_style1_post']:'';
		$news_style1_number_of_words = isset($instance['news_style1_number_of_words'])?$instance['news_style1_number_of_words']:'';
		
		if($news_style1_number_of_words=='')
		{
			$news_style1_number_of_words='10';
		}
		
		if($news_style1_post=='')
		{
			$news_style1_post='-1';
		}
		
		$category_name = get_category_by_slug($news_style1_catid );
		
		
		if ( $category_name instanceof WP_Term ) {
			
			$category_name = esc_html($category_name->name);
		}else{
			$category_name =esc_html('All Categories');
		}
		
		//$category_name = esc_html(get_cat_name($news_style1_catid ));
			
		$news_style_args = array(
				'posts_per_page'   => absint($news_style1_post),
				'offset'           => 0,
				'category_name'  =>esc_html($news_style1_catid),
				'orderby'          => 'date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				'suppress_filters' => true 
		);
		
		$posts_array = get_posts( $news_style_args );	
		
			?>
			<div class="<?php echo absint($widget_id);?> news_prime_style1_head">
			
				<div class="<?php echo absint($widget_id);?> news_prime_style1">
					<h3 class="<?php echo absint($widget_id);?> new_headline"><?php echo esc_html($news_style1_title); ?></h3>
				</div>
				
				<div class="<?php echo absint($widget_id);?> news_prime_style1_post">
					<?php
					foreach($posts_array as $key=>$post_data)
					{
						
						$post_id = absint($post_data->ID);
						$post_attached_image = wp_get_attachment_url( $post_id );
						$post_content = $post_data->post_content;
						$news_prime_post_content = wp_trim_words( $post_content, $num_words = $news_style1_number_of_words);
						
						?>
						<div class="<?php echo absint($widget_id);?> new_post_head_style">
							<div><a href="<?php the_permalink($post_id); ?>"><?php  echo get_the_post_thumbnail( $post_id, 'thumbnail' ); ?></a></div>
							<span class="<?php echo absint($widget_id);?> new_post_cat"><?php echo esc_html($category_name);?></span>
							<h3 class="<?php echo absint($widget_id);?> new_post_headline"><a href="<?php the_permalink($post_id); ?>"><?php echo esc_html($post_data->post_title); ?></a></h3>
							<p class="<?php echo absint($widget_id);?> new_post_description"><?php echo  esc_html($news_prime_post_content); ?></p>
							<a class="read_more" href="<?php the_permalink($post_id); ?>"><?php esc_html_e('Read More','news-prime'); ?></a>
						</div>
						<?php
						
					}
					?>
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
		
		$news_args = array(
	
			'type'                     => 'post',
			'child_of'     	           => 0,
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'category',
			'pad_counts'               => false
		);
		
		$prod_cat_args_news_data = get_terms($news_args);
			
		?>
			<table class="form-table">
				
				<tbody>	
		
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Title','news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input type="text"  name="<?php echo esc_attr($this->get_field_name('news_style1_title')); ?>" value="<?php if (isset($instance['news_style1_title'])!='') {echo esc_attr($instance['news_style1_title']);} ?>">
							
						</td>
						
					</tr>
					
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Selected Category','news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<?php $selected_cat=isset($instance['news_style1_select_category']) ? $instance['news_style1_select_category']:''; ?>
						
							<select name="<?php echo esc_attr($this->get_field_name('news_style1_select_category')); ?>">
								<option value=""><?php esc_html_e('All Categories','news-prime'); ?></option>
								<?php
								foreach($prod_cat_args_news_data as $keys =>$all_pro_val)
								{
									
									$reword_pro_id = esc_html($all_pro_val->slug);
								
									 $reword_pro_name = esc_html($all_pro_val->name);
									?>
									<option value="<?php echo esc_attr($reword_pro_id); ?>" <?php if ($selected_cat==$reword_pro_id){ echo 'selected';} ?> ><?php echo esc_html($reword_pro_name); ?></option>
									<?php
								}
								?>
							</select>
						
						</td>
						
					</tr>
					
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Number of Posts'	,'news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input  min="0"  name="<?php echo esc_attr($this->get_field_name( 'news_style1_post' )); ?>" 	type="number" value="<?php if (isset($instance['news_style1_post'])!='') {echo esc_attr($instance['news_style1_post']);} ?>">
						
						</td>
						
					</tr>
					
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Number of Words','news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input  min="0"  name="<?php echo esc_attr($this->get_field_name( 'news_style1_number_of_words' )); ?>" 	type="number" value="<?php if (isset($instance['news_style1_number_of_words'])!='') {echo esc_attr($instance['news_style1_number_of_words']);} ?>">
						
						</td>
						
					</tr>
					
				</tbody>
					
			</table>		
		<?php
		
		
				
	}
	
/**
     * Save data in database.
     *update instance
     */

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
	
		$instance['news_style1_title']=sanitize_text_field($new_instance['news_style1_title']);
		$instance['news_style1_select_category']=strip_tags($new_instance['news_style1_select_category']);
		$instance['news_style1_post']=absint($new_instance['news_style1_post']);
		$instance['news_style1_number_of_words']=absint($new_instance['news_style1_number_of_words']);
	
		return $instance;
	}
	
//end of class	

}

 /**
	 * Register Widget class
     * Load widgets.
     */
function news_prime_register_widget_style1() 
{

    register_widget( 'news_prime_Style1_Widget' );
}
add_action( 'widgets_init', 'news_prime_register_widget_style1' ); 	