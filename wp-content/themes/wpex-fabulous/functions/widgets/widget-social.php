<?php
/**
 * Social Widget
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
*/


class wpex_social_widget extends WP_Widget {

	/** constructor */
	function wpex_social_widget() {
		parent::WP_Widget(false, $name =  WPEX_THEME_BRANDING . ' - '. __( 'Social Widget', 'wpex' ) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$style = $instance['style'];
		$target = $instance['target'];
		$social_services = $instance['social_services']; ?>
		<?php echo $before_widget; ?>
			<?php if ( $title )
				echo $before_title . $title . $after_title; ?>
					<ul class="clr">
						<?php foreach( $social_services as $key => $service ) {
							$link = !empty( $service['url'] ) ? $service['url'] : null;
							$name = $service['name'];
							$icon = $service['icon'];
							if ( $link ) {
								echo '<li>
										<a href="'. $link .'" title="'. $name .'" target="_'.$target.'">
											<i class="fa fa-'. $icon .'"></i>
										</a>
									</li>';
							} ?>
						<?php } ?>
					</ul>
		<?php echo $after_widget; ?>
		<?php
	}

	/** @see WP_Widget::update */
	function update( $new, $old ) {
		$instance = $old;
		$instance['title'] = !empty( $new['title'] ) ? strip_tags( $new['title'] ) : null;
		$instance['style'] = !empty( $new['style'] ) ? strip_tags( $new['style'] ) : 'color-square';
		$instance['target'] = !empty( $new['target'] ) ? strip_tags( $new['target'] ) : 'blank';
		$instance['social_services'] = $new['social_services'];
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		$defaults = array(
			'title'				=> __('Follow Us','wpex'),
			'style'				=> 'color-square',
			'target' 			=> 'blank',
			'size'				=> '30px',
			'social_services'	=> array(
					'dribbble'		=> array(
						'name'		=> 'Dribbble',
						'url'		=> '',
						'icon'		=> 'dribbble',
					),
					'facebook'		=> array(
						'name'		=> 'Facebook',
						'url'		=> '',
						'icon'		=> 'facebook',
					),
					'flickr'			=> array(
						'name'		=> 'Flickr',
						'url'		=> '',
						'icon'		=> 'flickr',
					),
					'github'		=> array(
						'name'		=> 'GitHub',
						'url'		=> '',
						'icon'		=> 'github',
					),
					'googleplus'	=> array(
						'name'		=> 'GooglePlus',
						'url'		=> '',
						'icon'		=> 'google-plus',
					),
					'instagram'		=> array(
						'name'		=> 'Instagram',
						'url'		=> '',
						'icon'		=> 'instagram',
					),
					'linkedin' 		=> array(
						'name'		=> 'LinkedIn',
						'url'		=> '',
						'icon'		=> 'linkedin',
					),
					'pinterest' 	=> array(
						'name'		=> 'Pinterest',
						'url'		=> '',
						'icon'		=> 'pinterest',
					),
					'rss' 			=> array(
						'name'		=> 'RSS',
						'url'		=> '',
						'icon'		=> 'rss',
					),
					'twitter' 		=> array(
						'name'		=> 'Twitter',
						'url'		=> '',
						'icon'		=> 'twitter',
					),
					'youtube' 		=> array(
						'name'		=> 'Youtube',
						'url'		=> '',
						'icon'		=> 'youtube',
					),
			),
		);
		
			$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','wpex'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('target'); ?>"><?php _e('Link Target:', 'wpex'); ?></label>
			<br />
			<select class='wpex-widget-select' name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>">
				<option value="blank" <?php if($instance['target'] == 'blank') { ?>selected="selected"<?php } ?>><?php _e( 'Blank', 'wpex' ); ?></option>
				<option value="self" <?php if($instance['target'] == 'self') { ?>selected="selected"<?php } ?>><?php _e( 'Self', 'wpex' ); ?></option>
			</select>
		</p>

		<h3 style="margin-top:20px;margin-bottom:0;"><?php _e('Social Links','wpex'); ?></h3>  
		<small style="display:block;margin-bottom:10px;"><?php _e('Enter the full URL to your social profile','wpex'); ?></small>
		<ul id="<?php echo $this->get_field_id( 'social_services' ); ?>" class="wpex-services-list">
			<input type="hidden" id="<?php echo $this->get_field_name( 'social_services' ); ?>" value="<?php echo $this->get_field_name( 'social_services' ); ?>">
			<input type="hidden" id="<?php echo wp_create_nonce('wpex_social_widget_nonce'); ?>">
			<?php
			$social_services = $instance['social_services'];
			$i=0;
			foreach( $social_services as $key => $service ) {
				$url=0;
				if(isset($service['url'])) $url = $service['url'];
				if(isset($service['name'])) $name = $service['name'];
				if(isset($service['icon'])) $icon = $service['icon'];
				$i++; ?>
				<li id="<?php echo $this->get_field_id( $service ); ?>_0<?php echo $i ?>">
					<p>
						<label for="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo $i ?>-name"><?php echo $name; ?>:</label>
						<input type="hidden" id="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo $i ?>-url" name="<?php echo $this->get_field_name( 'social_services' ).'['.$i.'][name]'; ?>" value="<?php echo $name; ?>">
						<input type="url" class="widefat" id="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo $i ?>-url" name="<?php echo $this->get_field_name( 'social_services' ).'['.$i.'][url]'; ?>" value="<?php echo $url; ?>" />
						<input type="icon" class="hidden" id="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo $i ?>-icon" name="<?php echo $this->get_field_name( 'social_services' ).'['.$i.'][icon]'; ?>" value="<?php echo $icon; ?>" />
					</p>
				</li>
			<?php } ?>
		</ul>
		
	<?php
	}

} // end class wpex_social_widget
add_action('widgets_init', create_function('', 'return register_widget("wpex_social_widget");'));




/* Widget Ajax Function
/*-----------------------------------------------------------------------------------*/
add_action('admin_init','load_wpex_social_widget_scripts');
function load_wpex_social_widget_scripts() {
	global $pagenow;
	if ( is_admin() && $pagenow == "widgets.php" ) {

		add_action('admin_head', 'add_new_wpex_social_style');
		add_action('admin_footer', 'add_new_wpex_social_ajax_trigger');
	
		function add_new_wpex_social_ajax_trigger() { ?>
		<script type="text/javascript" >
			jQuery(document).ready(function($) {
				jQuery(document).ajaxSuccess(function(e, xhr, settings) { //fires when widget saved
					var widget_id_base = 'wpex_social_widget';
					if(settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1) {
						wpexSortServices();
					}
				});
				function wpexSortServices() {
					jQuery('.wpex-services-list').each( function() {
						var id = jQuery(this).attr('id');
						$('#'+ id).sortable({
							placeholder: "placeholder",
							opacity: 0.6
						});
					});
				}
				wpexSortServices();
			});
		</script>
	<?php
	}
}
	
	function add_new_wpex_social_style() { ?>
		<style>	
		.wpex-services-list li {cursor:move;background:#fcfcfc;padding:10px;border:1px solid #e3e3e3;margin-bottom:10px;box-shadow: inset 0 1px 0 #fff;}.wpex-sw-container label{color: #666;font-weight:bold;}
		.wpex-services-list .placeholder {border:1px dashed #e3e3e3; }
		</style>
	<?php
	}
	
} //end check pagenow