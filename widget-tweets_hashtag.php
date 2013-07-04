<?php
class gabfire_tweets_hashtag extends WP_Widget {

	function gabfire_tweets_hashtag() {
		$widget_ops = array( 'classname' => 'gabfire_tweets_via_hashtag', 'description' => 'Display flickr photos on your site' );
		$control_ops = array( 'width' => 330, 'height' => 350, 'id_base' => 'gabfire_tweets_via_hashtag' );
		$this->WP_Widget( 'gabfire_tweets_via_hashtag', 'Gabfire: Latest Tweets - Hashtag', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title 			= apply_filters('widget_title', $instance['title'] );
		$hashtag 	= $instance['hashtag'];
		$tweet_nr 	= $instance['tweet_nr'];

		function gab_recent_tweets($hash_tag, $tweet_nr) {

			$url = 'http://search.twitter.com/search.atom?q='.urlencode($hash_tag) ;
			$ch = curl_init($url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$xml = curl_exec ($ch);
			curl_close ($ch);

			$affected = 0;
			$cnt=0;
			$twelement = new SimpleXMLElement($xml);
			echo "<ul>";
			foreach ($twelement->entry as $entry) {
				if($cnt == $tweet_nr ) {
					break;
				}    
					$text = trim($entry->title);
					$author = trim($entry->author->name);
					$time = strtotime($entry->published);
					$id = $entry->id;
					echo "<li>".$author.": ".$text." <em>Posted ".date('n/j/y g:i a',$time)."</em></li>";
				$cnt++;
			}
			return true ;
			echo "</ul>";
		}		

		echo $before_widget;

			if ( $title ) {
				echo $before_title . $title . $after_title;
			}

			gab_recent_tweets($hashtag, $tweet_nr );
			
		echo $after_widget; 
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 			= strip_tags( $new_instance['title'] );
		$instance['hashtag'] 	= $new_instance['hashtag'];
		$instance['tweet_nr'] 	= (int)$new_instance['tweet_nr'];

		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			'title' => 'On Twitter',
			'hashtag' => '#wordpress',
			'tweet_nr' => '6'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		
		<div class="controlpanel">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title','gabfire-widget-pack'); ?></label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'hashtag' ); ?>"><?php _e('Hashtag','gabfire-widget-pack'); ?></label>
				<input id="<?php echo $this->get_field_id( 'hashtag' ); ?>" name="<?php echo $this->get_field_name( 'hashtag' ); ?>" value="<?php echo esc_attr( $instance['hashtag'] ); ?>" class="widefat" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_name( 'tweet_nr' ); ?>"><?php _e('How many tweets to display','gabfire-widget-pack'); ?></label>
				<select id="<?php echo $this->get_field_id( 'tweet_nr' ); ?>" name="<?php echo $this->get_field_name( 'tweet_nr' ); ?>">			
				<?php
					for ( $i = 1; $i <= 10; ++$i )
					echo "<option value='$i' " . selected( $instance['tweet_nr'], $i, false ) . ">$i</option>";
				?>
				</select>
			</p>
		</div>
		
	<?php
	}
}

function register_gabfire_tweets_hashtag() {
	register_widget('gabfire_tweets_hashtag');
}

add_action('widgets_init', 'register_gabfire_tweets_hashtag');