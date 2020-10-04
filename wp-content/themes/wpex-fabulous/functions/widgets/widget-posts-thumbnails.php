<?php
/**
 * Recent Posts w/ Thumbnails
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
*/

class wpex_recent_posts_thumb extends WP_Widget {
	
	/** constructor */
	function wpex_recent_posts_thumb() {
		parent::WP_Widget(false, $name = WPEX_THEME_BRANDING . ' - '. __('Posts With Thumbnails','wpex'), array( 'description' => __( 'Shows a listing of your recent or random posts with their thumbnail.', 'wpex' ) ) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$number = $instance['number'];
		$order = $instance['order'];
		$date = isset($instance['date']) ? $instance['date'] : '';
			  echo $before_widget;
				  if ( $title )
						echo $before_title . $title . $after_title; ?>
							<ul class="wpex-widget-recent-posts">
							<?php
								global $post;
								$args = array(
									'post_type'		=> 'post',
									'numberposts'	=> $number,
									'orderby'		=> $order,
									'no_found_rows'	=> true,
									'meta_key'		=> '_thumbnail_id',
								);
								$myposts = get_posts( $args );
								foreach( $myposts as $post ) : setup_postdata($post); ?>
									<li class="clearfix wpex-widget-recent-posts-li">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="wpex-widget-recent-posts-thumbnail"><img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ), 65, 65, true ); ?>" alt="<?php the_title(); ?>" /></a>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="wpex-widget-recent-posts-title"><?php the_title(); ?></a>
										<?php if ( $date !== '1' ) { ?>
											<div class="wpex-widget-recent-posts-date"><?php echo get_the_date(); ?></div>
										<?php } ?>
									</li>
							<?php endforeach; wp_reset_postdata(); ?>
							</ul>
			<?php echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['number'] = strip_tags($new_instance['number']);
	$instance['order'] = strip_tags($new_instance['order']);
	$instance['date'] = strip_tags($new_instance['date']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {	
		$instance = wp_parse_args( (array) $instance, array(
			'title'		=> __('Recent Posts','wpex'),
			'number'	=> '5',
			'order'		=> 'ASC',
			'date'		=> '',
		));
		$title = esc_attr($instance['title']);
		$number = esc_attr($instance['number']);
		$order = esc_attr( $instance['order'] );
		$date = esc_attr( $instance['date'] ); ?>
		
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wpex'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title','wpex'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number to Show:', 'wpex'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Random or Recent?', 'wpex'); ?></label>
			<br />
			<select class='wpex-select' name="<?php echo $this->get_field_name('order'); ?>" id="<?php echo $this->get_field_id('order'); ?>">
			<option value="ASC" <?php if($order == 'ASC') { ?>selected="selected"<?php } ?>><?php _e('Recent', 'wpex'); ?></option>
			<option value="rand" <?php if($order == 'rand') { ?>selected="selected"<?php } ?>><?php _e('Random', 'wpex'); ?></option>
			</select>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('date'); ?>" name="<?php echo $this->get_field_name('date'); ?>" type="checkbox" value="1" <?php checked( '1', $date ); ?> />
			<label for="<?php echo $this->get_field_id('date'); ?>"><?php _e('Disable Date?', 'wpex'); ?></label>
		</p>

		<?php
	}


} // class wpex_recent_posts_thumb
// register Recent Posts widget
add_action('widgets_init', create_function('', 'return register_widget("wpex_recent_posts_thumb");')); ?>