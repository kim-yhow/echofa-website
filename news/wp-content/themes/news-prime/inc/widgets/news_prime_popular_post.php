<?php
/**
     * news prime widget Class.
     *
     */
class News_Prime_Style2_Theme_Widget extends WP_Widget {
	
	function __construct() {

		parent::__construct(

			'news_prime_Style2_Theme_Widget',               // Base ID

			__('News Prime Popular Post Widget','news-prime'),    // Title Name

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
		
		$news_style1_title_popular = isset($instance['news_style2_title_populat'])?$instance['news_style2_title_populat']:'';
		
		$news_style1_catid_popular = isset($instance['news_style2_select_category_popular'])?$instance['news_style2_select_category_popular']:'';
		
		$news_style1_post_popular = isset($instance['news_style2_post_popular'])?$instance['news_style2_post_popular']:'';
		
		
		$news_tab_number_of_popular_words = isset($instance['news_tab_number_of_popular_words'])?$instance['news_tab_number_of_popular_words']:'';
	
		if($news_tab_number_of_popular_words=='')
		{
			$news_tab_number_of_popular_words='500';
		}
		
		if($news_style1_post_popular=='')
		{
			$news_style1_post_popular='-1';
		}
		
		
		$category_names = get_category_by_slug($news_style1_catid_popular );
						
			if ( $category_names instanceof WP_Term ) {

				$category_name= esc_html($category_names->name);
			}else{
				$category_name= esc_html('All Categories');
			}
		
			
		$args_popular = array(
			'posts_per_page'   => absint($news_style1_post_popular),
			'offset'           => 0,
			'category_name'    => esc_html($news_style1_catid_popular),
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'post',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		
		$posts_array_popular = get_posts( $args_popular );	
		
			?>
			<div class="<?php echo absint($widget_id);?> news_prime_style1_head">
			
				<div class="<?php echo absint($widget_id);?> news_prime_style1">
				
					<h3 class="<?php echo absint($widget_id);?> new_headline"><?php echo esc_html($news_style1_title_popular); ?></h3>
				
				</div>
				
				<div class="<?php echo absint($widget_id);?>news_prime_style1_post">
				
					<?php
					foreach($posts_array_popular as $key=>$post_data)
					{
						
						$post_id = absint($post_data->ID);
						
						$post_attached_image = wp_get_attachment_url( $post_id );
						
						$post_counts = absint($post_data->comment_count);
						
						if($post_counts>'0')
						{
							
							?>
							<div class="<?php echo absint($widget_id);?> new_popular_post">
								<div class="popular_img"><a href="<?php the_permalink($post_id); ?>"><?php  echo get_the_post_thumbnail( $post_id, 'thumbnail' ); ?></a></div>
								<div class="news_prime_pop_ryt">
									<span class="<?php echo absint($widget_id);?> new_post_headline"><?php echo esc_html($category_name);?></span>
									
									<?php
										$post_date = $post_data->post_date ;
									
										$yrdatssa= strtotime($post_date);
										$post_datestrip =  date('d-M-Y', $yrdatssa);
										?>
									<span class="<?php echo absint($widget_id);?> new_post_date"><?php echo $post_datestrip ;?></span>
									<h3 class="<?php echo absint($widget_id);?> new_post_headline"><a href="<?php the_permalink($post_id); ?>"><?php echo esc_html($post_data->post_title); ?></a></h3>
									<p class="<?php echo absint($widget_id);?> new_post_description">
										<?php
										$post_content =  $post_data->post_content;
										$news_prime_post_popular_content = wp_trim_words( $post_content, $num_words = $news_tab_number_of_popular_words);
										echo $news_prime_post_popular_content;
										?>
									</p>
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
		
			$news_args_popular = array(
		
					'type'                     => 'post',
					'child_of'     	           => 0,
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
					'hierarchical'             => 1,
					'taxonomy'                 => 'category',
					'pad_counts'               => false
			);
			
			$prod_cat_args_news_data = get_terms($news_args_popular);
			
		
		?>
			<table class="form-table">
				
				<tbody>	
		
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Title','news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input type="text"  name="<?php echo esc_attr($this->get_field_name('news_style2_title_populat')); ?>" value="<?php if (isset($instance['news_style2_title_populat'])!='') { echo esc_attr($instance['news_style2_title_populat']);} ?>">
							
						</td>
						
						
					</tr>
					
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Selected Category','news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<?php $selected_cat=isset($instance['news_style2_select_category_popular']) ? $instance['news_style2_select_category_popular']:''; ?>
						
							<select name="<?php echo esc_attr($this->get_field_name('news_style2_select_category_popular')); ?>">
							
								<option value=""><?php esc_html_e('All Categories','news-prime'); ?></option>
								<?php
								foreach($prod_cat_args_news_data as $keys =>$all_pro_val)
								{
									$reword_pro_id = $all_pro_val->slug;
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
						
							<input  min="0"  name="<?php echo esc_attr($this->get_field_name( 'news_style2_post_popular' )); ?>" 	type="number" value="<?php if (isset($instance['news_style2_post_popular'])!='') {echo esc_attr($instance['news_style2_post_popular']);} ?>">
						
						</td>
						
					</tr>
					
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Number of Words','news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input  min="0"  name="<?php echo esc_attr($this->get_field_name( 'news_tab_number_of_popular_words' )); ?>" 	type="number" value="<?php if (isset($instance['news_tab_number_of_popular_words'])!='') {echo esc_attr($instance['news_tab_number_of_popular_words']);} ?>">
						
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
		$instance['news_style2_title_populat']=sanitize_text_field($new_instance['news_style2_title_populat']); 
		$instance['news_style2_select_category_popular']=strip_tags($new_instance['news_style2_select_category_popular']);
		$instance['news_tab_number_of_popular_words']=absint($new_instance['news_tab_number_of_popular_words']);
		$instance['news_style2_post_popular']=absint($new_instance['news_style2_post_popular']);
	
		return $instance;
	}
	
//end of class	

}

 /**
	 * Register Widget class
     * Load widgets.
     */
function news_theme_register_widget_style2() 
{

    register_widget( 'news_prime_Style2_Theme_Widget' );
}
add_action( 'widgets_init', 'news_theme_register_widget_style2' ); 