<?php
/**
     * news prime widget Class.
     *
     */
class News_Prime_sidebar_Tab_Widget extends WP_Widget {
	
	function __construct() {

		parent::__construct(

			'News_Prime_sidebar_Tab_Widget',               // Base ID

			__('News Prime Sidebar Tab Widget','news-prime'),    // Title Name

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
			
		$news_prime_popular_sidebar_post = isset($instance['news_prime_popular_sidebar_post'])?$instance['news_prime_popular_sidebar_post']:'';
		$news_popular_sidebar_enable_descdd = isset($instance['news_populars_sidebar_enable_desc'])?$instance['news_populars_sidebar_enable_desc']:'';
		$news_prime_popular_sidebar_recent_post = isset($instance['news_prime_popular_sidebar_recent_post'])?$instance['news_prime_popular_sidebar_recent_post']:'';
		$news_prime_popular_sidebar_comments = isset($instance['news_prime_popular_sidebar_comments'])?$instance['news_prime_popular_sidebar_comments']:'';
		$news_tab_number_of_words_popular = isset($instance['news_tab_number_of_words'])?$instance['news_tab_number_of_words']:'';
		$news_tab_rec_number_of_words_recent = isset($instance['news_tab_rec_number_of_words'])?$instance['news_tab_rec_number_of_words']:'';
		if($news_tab_number_of_words_popular=='')
		{
			$news_tab_number_of_words_popular='500';
		}
		
		if($news_tab_rec_number_of_words_recent=='')
		{
			$news_tab_rec_number_of_words_recent='500';
		}
		
		if($news_prime_popular_sidebar_post=='')
		{
			$news_prime_popular_sidebar_post='-1';
		}
		
		if($news_prime_popular_sidebar_recent_post=='')
		{
			$news_prime_popular_sidebar_recent_post='-1';
		}
		
		if($news_prime_popular_sidebar_comments=='')
		{
			$news_prime_popular_sidebar_comments='-1';
		}
		
		$args_popular_post = array(
			
			'posts_per_page'   =>$news_prime_popular_sidebar_post,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'post',
			'post_status'      => 'publish',
			'suppress_filters' => true 
			
		);
		
		$args_popular_post_data = get_posts( $args_popular_post ); 
		
		
		$args_recent_post = array(
			
			'posts_per_page'   =>absint($news_prime_popular_sidebar_recent_post),
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'post',
			'post_status'      => 'publish',
			'suppress_filters' => true 
			
		);
		$args_recent_post_data = get_posts( $args_recent_post ); 
		
		$post_comments_args = array(
		
				'posts_per_page'   =>absint($news_prime_popular_sidebar_comments),
				'order' => 'DESC',
				'orderby'  => 'date',
				'post_type' => 'post',
				'status' => 'all',
				'count' => false,

		);
		
	$news_prime_post_comments = get_comments( $post_comments_args );

		
	?>
	<div class="<?php echo absint($widget_id);?> news_prime_tab_head">
		
		<div class="<?php echo absint($widget_id);?> news_tab">
		
			<ul class="<?php echo absint($widget_id);?> news_prime_tab">
				
				<li class="news_popular active"><?php esc_html_e('Popular','news-prime'); ?></li>
				<li class="news_recent"><?php esc_html_e('Recent','news-prime'); ?></li>
				<li class="news_comments"><?php esc_html_e('Comments','news-prime'); ?></li>
			
			</ul>
		
		</div>
		
		<div class="<?php echo absint($widget_id);?> news_prime_popular_show">
		
			<?php
			foreach($args_popular_post_data as $key=>$args_popular_post_val)
			{
				$args_popular_post_id = absint($args_popular_post_val->ID);
				
				$ccomment_count = absint($args_popular_post_val->comment_count);
				
				if($ccomment_count>'0')
				{
				
					?>
					<div class="<?php echo absint($widget_id);?> new_popular_child">
						<div class="<?php echo absint($widget_id);?> new_popular_post_img"><a href="<?php the_permalink($args_popular_post_id); ?>"><?php  echo get_the_post_thumbnail( $args_popular_post_id, 'thumbnail' ); ?></a></div>
							<?php
								$post_date_pop = $args_popular_post_val->post_date ;
								$yrdatssa= strtotime($post_date_pop);
								$post_datestrip_pop =  date('d-M-Y', $yrdatssa);
								?>
								
						<div class="popular_main_ryt">
							<span class="<?php echo absint($widget_id);?> new_popular_post_date"><?php echo esc_html($post_datestrip_pop); ?></span>
							<h3 class="<?php echo absint($widget_id);?> new_popular_post_headline"><a href="<?php the_permalink($args_popular_post_id); ?>"><?php echo esc_html($args_popular_post_val->post_title); ?></a></h3>
							
							<?php
							if($news_popular_sidebar_enable_descdd=='1')
							{
								$post_content =  $args_popular_post_val->post_content;
								$news_prime_post_content = wp_trim_words( $post_content, $num_words = $news_tab_number_of_words_popular);
								?>
								<p class="<?php echo absint($widget_id);?> new_popular_post_description"><?php echo esc_html($news_prime_post_content); ?></p>
								
								<?php
							}
							
							?>
						</div>
					</div>
					<?php
				}
				
			}
	
			?>
		
		</div>
		
		<div class="<?php echo absint($widget_id);?> news_prime_recent_show" style="display:none">
			
			<?php
			$news_recent_sidebar_enable_descdd = isset($instance['news_recents_sidebar_enable_desc'])?$instance['news_recents_sidebar_enable_desc']:'';
			
			foreach($args_recent_post_data as $keys=>$args_recent_post_datas)
			{
				$args_recent_post_id = $args_recent_post_datas->ID;
				
				?>
				<div class="<?php echo absint($widget_id);?> new_recent_child">
				
					<div class="<?php echo absint($widget_id);?> new_recent_post_img"><a href="<?php the_permalink($args_recent_post_id); ?>"><?php  echo get_the_post_thumbnail( $args_recent_post_id, 'thumbnail' ); ?></a></div>
						<?php
							$post_date_rec = $args_recent_post_datas->post_date ;
						
							$yrdata= strtotime($post_date_rec);
							$post_datestrip_rec =  date('d-M-Y', $yrdata);
						?>
					<div class="news_tab_main_ryt">
						<span class="<?php echo absint($widget_id);?> new_recent_post_date"><?php echo esc_html($post_datestrip_rec);?></span>
						
						<h3 class="<?php echo absint($widget_id);?> new_recent_post_headline"><a href="<?php the_permalink($args_recent_post_id); ?>"><?php echo esc_html($args_recent_post_datas->post_title); ?></a></h3>
							<?php
							if($news_recent_sidebar_enable_descdd=='1')
							{
								$post_contents =  $args_recent_post_datas->post_content;
								$news_prime_post_contents = wp_trim_words( $post_contents, $num_words = $news_tab_rec_number_of_words_recent);
								?>
								<p class="<?php echo absint($widget_id);?> new_recent_post_description"><?php echo esc_html($news_prime_post_contents); ?></p>
						
								<?php
							}
						?>
					</div>
				</div>
				<?php
			}
			
			?>
		
		</div>
		
		<div class="<?php echo absint($widget_id);?> news_prime_comments_show" style="display:none">
			
			<?php
			foreach($news_prime_post_comments as $keys=>$news_prime_post_comments_data)
			{
				$news_prime_post_comments_id = absint($news_prime_post_comments_data->comment_ID);
				$news_prime_post_comments_userid= absint($news_prime_post_comments_data->user_id);
				?>
				<div class="news_recent_cmnt_main">
					<div class="<?php echo absint($widget_id);?> new_recent_comment_img"><?php  echo get_avatar( $news_prime_post_comments_userid, 100 ); ; ?></div>
					
						<?php
							$post_date_comm = $news_prime_post_comments_data->comment_date ;
							$yrdatsa= strtotime($post_date_comm);
							$post_datestrip_comm =  date('d-M-Y', $yrdatsa);
						?>
					<div class="news_prime_comnt_ryt">
						<span class="<?php echo absint($widget_id);?> new_recent_comment_date"><?php echo esc_html($post_datestrip_comm); ?></span>
						<h3 class="<?php echo absint($widget_id);?> new_recent_comment_author"><?php echo esc_html($news_prime_post_comments_data->comment_author); ?></h3>
						<p class="<?php echo absint($widget_id);?> new_recent_comment_description"><?php echo esc_html($news_prime_post_comments_data->comment_content); ?></p>
					</div>
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
		
		?>
		<h3><?php esc_html_e('Popular Tab'	,'news-prime'); ?></h3>
		
			<table class="form-table">
				
				<tbody>	
		
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Number of Posts'	,'news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input  min="0"  name="<?php echo esc_html($this->get_field_name( 'news_prime_popular_sidebar_post' )); ?>" 	type="number" value="<?php if (isset($instance['news_prime_popular_sidebar_post'])!='') {echo esc_html($instance['news_prime_popular_sidebar_post'] );} ?>">
						
						</td>
						
					</tr>
					
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Number of Words','news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input  min="0"   name="<?php echo esc_html($this->get_field_name( 'news_tab_number_of_words' )); ?>" 	type="number" value="<?php if (isset($instance['news_tab_number_of_words'])!='') {echo esc_html($instance['news_tab_number_of_words']);} ?>">
						
						</td>
						
					</tr>
					
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Enable Description','news-prime'); ?> </label>
							
						</th>
						
						<td>
							<?php 
							
							$news_popular_sidebar_enable_descs = isset($instance['news_populars_sidebar_enable_desc'])?$instance['news_populars_sidebar_enable_desc']:''; 
							$news_enables='1';
							?>
							
							<input  type="checkbox" name="<?php echo esc_html($this->get_field_name( 'news_populars_sidebar_enable_desc' )); ?>" <?php if ($news_popular_sidebar_enable_descs=='1'){ echo 'checked';} ?>  value="<?php echo esc_html($news_enables) ?>">
						
						</td>
						
					</tr>
					
				</tbody>
					
			</table>
			
			<h3><?php esc_html_e('Recent Tab','news-prime'); ?></h3>
			
			<table class="form-table">
				
				<tbody>	
		
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Number of Posts'	,'news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input  min="0"   name="<?php echo esc_html($this->get_field_name( 'news_prime_popular_sidebar_recent_post' )); ?>" 	type="number" value="<?php if (isset($instance['news_prime_popular_sidebar_recent_post'])!='') {echo esc_html($instance['news_prime_popular_sidebar_recent_post']);} ?>">
						
						</td>
						
					</tr>
					
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Number of Words','news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input  min="0"   name="<?php echo esc_html($this->get_field_name( 'news_tab_rec_number_of_words' )); ?>" 	type="number" value="<?php if (isset($instance['news_tab_rec_number_of_words'])!='') {echo esc_html($instance['news_tab_rec_number_of_words']);} ?>">
						
						</td>
						
						
					</tr>
					
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Enable Description','news-prime'); ?> </label>
							
						</th>
						
						<td>
							<?php 
							$news_recent_sidebar_enable_descs = isset($instance['news_recents_sidebar_enable_desc'])?$instance['news_recents_sidebar_enable_desc']:''; 
							$news_enable='1';
							?>
							<input  type="checkbox" name="<?php echo esc_html($this->get_field_name( 'news_recents_sidebar_enable_desc' )); ?>" <?php if ($news_recent_sidebar_enable_descs=='1'){ echo 'checked';} ?>  value="<?php echo esc_html($news_enable) ;?>">
						
						</td>
						
					</tr>
					
				</tbody>
					
			</table>	

			<h3><?php esc_html_e('Comments Tab','news-prime'); ?></h3>
			<table class="form-table">
				
				<tbody>	
		
					<tr>
				
						<th>
						
							<label><?php esc_html_e('Number of Comments'	,'news-prime'); ?> </label>
							
						</th>
						
						<td>
						
							<input  min="0"   name="<?php echo esc_html($this->get_field_name( 'news_prime_popular_sidebar_comments' )); ?>" 	type="number" value="<?php if (isset($instance['news_prime_popular_sidebar_comments'])!='') {echo esc_html($instance['news_prime_popular_sidebar_comments']);} ?>">
						
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
	
		$instance['news_prime_popular_sidebar_post']=absint($new_instance['news_prime_popular_sidebar_post']); 
		$instance['news_tab_number_of_words']=absint($new_instance['news_tab_number_of_words']);
		$instance['news_prime_popular_sidebar_recent_post']=absint($new_instance['news_prime_popular_sidebar_recent_post']);
		$instance['news_tab_rec_number_of_words']=absint($new_instance['news_tab_rec_number_of_words']);
		$instance['news_prime_popular_sidebar_comments']=absint($new_instance['news_prime_popular_sidebar_comments']);
		
		return $instance;
	}	
}

 /**
 * Register Widget class
 * Load widgets.
 */
function news_prime_sidebar_tab_register_widget() 
{

    register_widget( 'News_Prime_sidebar_Tab_Widget' );
}
add_action( 'widgets_init', 'news_prime_sidebar_tab_register_widget' ); 