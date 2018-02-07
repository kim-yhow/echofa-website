<?php
/**
     * news prime widget Class.
     *
     */
class News_Prime_Style2_Widget extends WP_Widget {
	
	function __construct() {

		parent::__construct(

			'news_prime_Style2_Widget',               // Base ID

			__('News Prime Style 2 Widget','news-prime'),    // Title Name

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
			
		$news_style2_title = isset($instance['news_style2_title'])?$instance['news_style2_title']:'';
		$news_style2_catid = isset($instance['news_style2_select_category'])?$instance['news_style2_select_category']:'';
		$news_style2_post = isset($instance['news_style2_post'])?$instance['news_style2_post']:'';
		if($news_style2_post=='')
		{
			$news_style2_post='-1';
		}
	
		$args_style2 = array(
		
				'posts_per_page'   => absint($news_style2_post),
				'offset'           => 0,
				'category_name'         =>esc_html($news_style2_catid),
				'orderby'          => 'date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				'suppress_filters' => true 
				
		);
		
		$posts_array = get_posts( $args_style2 );	
		
			?>
			<div class="<?php echo absint($widget_id);?> news_prime_style2_head">
			
				<div class="<?php echo absint($widget_id);?> news_prime_style2">
					<h3 class="<?php echo absint($widget_id);?> new_headline"><?php echo esc_html($news_style2_title); ?></h3>
				</div>
				
				<div class="<?php echo absint($widget_id);?> news_prime_style2_post_top">
				
				<?php
				
				$category_names = get_category_by_slug($news_style2_catid );
							/* 	print_r($category_names);
								die(); */
							
				if ( $category_names instanceof WP_Term ) {

					$category_name= esc_html($category_names->name);
				}else{
					$category_name= esc_html('All Categories');
				}
				
				
				foreach($posts_array as $key=>$post_data)
				{
					if($key=='0')
					{
						$post_id = absint($post_data->ID);
						$post_attached_image = wp_get_attachment_url( $post_id );
						?>
						<div class="<?php echo absint($widget_id);?> new_post_head_cls">
							<div class="imgs"><a href="<?php the_permalink($post_id); ?>"><?php  echo get_the_post_thumbnail( $post_id, 'thumbnail' ); ?></a></div>
							<span class="<?php echo absint($widget_id);?> new_post_headline">
								<?php
								if($news_style2_catid=='')
								{
									$category = get_the_category($post_id); 
									echo esc_html($category[$key]->cat_name);
								}else{
									echo $category_name;
								}
								?>
							</span>
							<h3 class="<?php echo absint($widget_id);?> new_post_headline"><a href="<?php the_permalink($post_id); ?>"><?php echo esc_html($post_data->post_title); ?></a></h3>
						</div>
						<?php
					}
					
				}
				?>
				
				</div>
				
				<div class="<?php echo absint($widget_id);?> news_prime_style2_post_bot">
				
					<?php
					foreach($posts_array as $key=>$post_data)
					{
						
						if($key!='0')
						{
						
							$post_id = absint($post_data->ID);
							$post_attached_image = wp_get_attachment_url( $post_id );
							?>
							<div class="<?php echo absint($widget_id);?> new_post_head_cls">
								<div class="imgs"><a href="<?php the_permalink($post_id); ?>"><?php  echo get_the_post_thumbnail( $post_id, 'thumbnail' ); ?></a></div>
								<div class="news_prime_style2_sec">
									<span class="<?php echo absint($widget_id);?> new_post_headline">
										<?php
										if($news_style2_catid=='')
										{
											$category = get_the_category($post_id); 
											echo esc_html($category[0]->cat_name);
										}else{
											echo esc_html($category_name);
										}
										?>
									</span>
									<h3 class="<?php echo absint($widget_id);?> new_post_headline"><a href="<?php the_permalink($post_id); ?>"><?php echo esc_html($post_data->post_title); ?></a></h3>
								</div>
							</div>
							<?php
						}
						
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
		
		$news_args_style2 = array(
			'type'                     => 'post',
			'child_of'     	           => 0,
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'category',
			'pad_counts'               => false
		);
		
		$prod_cat_args_news_data = get_terms($news_args_style2);
			
		?>
			<table class="form-table">
				
				<tbody>	
		
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Title','news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input type="text"  name="<?php echo esc_attr($this->get_field_name('news_style2_title')); ?>" value="<?php if (isset($instance['news_style2_title'])!='') {echo esc_attr($instance['news_style2_title']);} ?>">
							
						</td>
						
					</tr>
					
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Selected Category','news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<?php $selected_cat=isset($instance['news_style2_select_category']) ? $instance['news_style2_select_category']:''; ?>
						
							<select name="<?php echo esc_attr($this->get_field_name('news_style2_select_category')); ?>">
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
						
							<input  min="0"   name="<?php echo esc_attr($this->get_field_name( 'news_style2_post' )); ?>" 	type="number" value="<?php if (isset($instance['news_style2_post'])!='') {echo esc_attr($instance['news_style2_post']);} ?>">
						
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

		$instance['news_style2_title']=sanitize_text_field($new_instance['news_style2_title']); 
		$instance['news_style2_select_category']=strip_tags($new_instance['news_style2_select_category']);
		$instance['news_style2_post']=absint($new_instance['news_style2_post']);
		
		return $instance;
	}
	
//end of class	

}

/**
	 * Register Widget class
     * Load widgets.
     */
	 
function news_prime_register_widget_style2() 
{

    register_widget( 'news_prime_Style2_Widget' );
}
add_action( 'widgets_init', 'news_prime_register_widget_style2' ); 