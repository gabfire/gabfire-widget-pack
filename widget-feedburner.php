<?php
class gabfire_feedburner extends WP_Widget {

	function gabfire_feedburner() {
		$widget_ops = array( 'classname' => 'gabfire_feedburner_widget', 'description' => 'Feedburner Email Subscribe');
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'gabfire_feedburner_widget' );
		$this->WP_Widget( 'gabfire_feedburner_widget', 'Gabfire: Feedburner Email Subscribe', $widget_ops, $control_ops);
	}	
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$user	= $instance['user'];
		$text	= $instance['text'];
		$bgcol	= $instance['bgcol'];
		$bordercol	= $instance['bordercol'];
		$textcol	= $instance['textcol'];

		echo $before_widget;

			if ( $title ) {
				echo $before_title . $title . $after_title;
			}
			?>
			
			<form class="gabfire_f_widget" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr( $user ); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
				<fieldset <?php if ( $bgcol ) { echo 'style="background:' . esc_attr( $bgcol ) .';border:1px solid ' . esc_attr( $bordercol ) .';"'; } ?>>
					<input type="mailinput" style="width:80%;color:<?php echo esc_attr( $textcol ); ?>;<?php if ( $bgcol ) { echo 'background:' . esc_attr( $bgcol ); } ?>" class="text" name="email" value="<?php echo esc_attr( $text ); ?>" onfocus="if (this.value == '<?php echo esc_attr( $text ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo esc_attr( $text ); ?>';}" />
					<input type="hidden" value="<?php echo esc_attr( $user ); ?>" name="uri" />
					<input type="hidden" name="loc" value="<?php bloginfo('language'); ?>"/>
					<input type="image" class="feedburner_submit" src="<?php echo get_template_directory_uri(); ?>/framework/images/add.png" alt="Subscribe" />
				</fieldset>
			</form>
			<?php 
		echo $after_widget; 
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['user'] = strip_tags($new_instance['user']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['bgcol'] = strip_tags($new_instance['bgcol']);
		$instance['bordercol'] = strip_tags($new_instance['bordercol']);
		$instance['textcol'] = strip_tags($new_instance['textcol']);
		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			'title' => 'Subscribe by Email',
			'user' => '',
			'text' => 'Enter your email',
			'bordercol' => '#cccccc',
			'bgcol' => '#efefef',
			'textcol' => '#555555'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','gabfire-widget-pack'); ?></label>
			<input class="widefat"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('Feedburner ID','gabfire-widget-pack'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo esc_attr($instance['user']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('bgcol'); ?>"><?php _e('Input field background color','gabfire-widget-pack'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('bgcol'); ?>" name="<?php echo $this->get_field_name('bgcol'); ?>" type="text" value="<?php echo esc_attr($instance['bgcol']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('bordercol'); ?>"><?php _e('Input field border color','gabfire-widget-pack'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('bordercol'); ?>" name="<?php echo $this->get_field_name('bordercol'); ?>" type="text" value="<?php echo esc_attr($instance['bordercol']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('textcol'); ?>"><?php _e('Input field text color','gabfire-widget-pack'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('textcol'); ?>" name="<?php echo $this->get_field_name('textcol'); ?>" type="text" value="<?php echo esc_attr($instance['textcol']); ?>" />
		</p>
			
		<p>
			<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text','gabfire-widget-pack'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo esc_attr($instance['text']); ?>" />
		</p>
		
	<?php
	}
}

function register_gabfire_feedburner() {
	register_widget('gabfire_feedburner');
}

add_action('widgets_init', 'register_gabfire_feedburner');