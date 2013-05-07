<?php
class gabfire_about extends WP_Widget {

	function gabfire_about() {
		$widget_ops = array( 'classname' => 'gab_about_widget', 'description' => 'Display an "about" widget' );
		$control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'gab_about_widget' );
		$this->WP_Widget( 'gab_about_widget', 'Gabfire: About', $widget_ops, $control_ops);	
	}
	
	function widget($args, $instance) {
		extract( $args );
		$title	= $instance['title'];
		$avatar	= $instance['a_avatar'] ? '1' : '0';
		$text	= $instance['a_text'];
		$link 	= $instance['a_link'];
		$anchor	= $instance['a_anchor'];

		echo $before_widget;

			if ( $title ) {
				echo $before_title . $title . $after_title;
			}
			
			if($avatar) {
				echo '<div class="widget_avatar">' . get_avatar(get_bloginfo('admin_email'),'50') . '</div>';
			}	
			
			echo  wpautop($text) . '<div class="clear clearfix"></div>';
				
			if($link) {
				echo '<span class="about_more"><a href="' . get_permalink($link) . '">'. $anchor . '</a></span>';
			}
			
		echo $after_widget; 
	}
	
	function update($new_instance, $old_instance) {  
		$instance['title']		= strip_tags($new_instance['title']);
		$instance['a_avatar']	= $new_instance['a_avatar'] ? '1' : '0';
		$instance['a_text'] 	= strip_tags($new_instance['a_text']);
		$instance['a_link'] 	= strip_tags($new_instance['a_link']);
		$instance['a_anchor'] 	= strip_tags($new_instance['a_anchor']); 
		return $new_instance;
	}
 
	function form($instance) {
		$defaults	= array( 'title' => 'About', 'a_avatar' => '1', 'a_text' => '', 'a_link' => '', 'a_anchor' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); 
	?>

	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','gabfire-widget-pack'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
	</p>
		
	<p>
		<label for="<?php echo $this->get_field_id( 'a_avatar' ); ?>"><?php _e('Site Admin\'s Avatar','gabfire-widget-pack'); ?></label> 
		<select id="<?php echo $this->get_field_id( 'a_avatar' ); ?>" name="<?php echo $this->get_field_name( 'a_avatar' ); ?>">
			<option value="1" <?php selected( $instance['a_avatar'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['a_avatar'], '0' ) ; ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
	</p>	
		
	<p>
		<label for="<?php echo $this->get_field_id('a_text'); ?>"><?php _e('About Text','gabfire-widget-pack'); ?></label>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('a_text'); ?>" name="<?php echo $this->get_field_name('a_text'); ?>"><?php echo esc_attr($instance['a_text']); ?></textarea>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('a_link'); ?>"><?php _e('Post or Page ID for link','gabfire-widget-pack'); ?></label>
		<input id="<?php echo $this->get_field_id('a_link'); ?>" name="<?php echo $this->get_field_name('a_link'); ?>" type="text" value="<?php echo esc_attr( $instance['a_link'] ); ?>" />
	</p>
		
	<p>
		<label for="<?php echo $this->get_field_id('a_anchor'); ?>"><?php _e('Link label','gabfire-widget-pack'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('a_anchor'); ?>" name="<?php echo $this->get_field_name('a_anchor'); ?>" type="text" value="<?php echo esc_attr($instance['a_anchor']); ?>" />
	</p>
<?php
	}
}

function register_gabfire_about() {
	register_widget('gabfire_about');
}

add_action('widgets_init', 'register_gabfire_about');