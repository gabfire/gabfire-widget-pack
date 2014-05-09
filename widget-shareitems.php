<?php
class gab_share extends WP_Widget {

	function gab_share() {
		$widget_ops = array( 'classname' => 'gabfire_share_widget', 'description' => 'Display share icons for entries' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'gabfire_share_widget' );
		$this->WP_Widget( 'gabfire_share_widget', 'Gabfire: Share Items', $widget_ops, $control_ops);	
	}
	function widget($args, $instance) {
		extract( $args );
		$title	= $instance['title'];
		$boxtweet	= $instance['boxtweet'] ? '1' : '0';
		$boxg1	= $instance['boxg1'] ? '1' : '0';
		$boxlike	= $instance['boxlike'] ? '1' : '0';
		$boxpinterest	= $instance['boxpinterest'] ? '1' : '0';
		$boxlinkedin	= $instance['boxlinkedin'] ? '1' : '0';
		$box_or_button	= $instance['box_or_button'] ? '1' : '0';
		$fbook	= $instance['fbook'] ? '1' : '0';
		$tweet	= $instance['tweet'] ? '1' : '0';
		$plus1	= $instance['plus1'] ? '1' : '0';
		$email 	= $instance['email'] ? '1' : '0';
		$blogger	= $instance['blogger'] ? '1' : '0';
		$dlc	= $instance['dlc'] ? '1' : '0';
		$digg	= $instance['digg'] ? '1' : '0';
		$google	= $instance['google'] ? '1' : '0';
		$myspace	= $instance['myspace'] ? '1' : '0';
		$supon	= $instance['supon'] ? '1' : '0';
		$yahoo	= $instance['yahoo'] ? '1' : '0';
		$reddit	= $instance['reddit'] ? '1' : '0';
		$tech	= $instance['tech'] ? '1' : '0';
		$rss	= $instance['rss'] ? '1' : '0';

		echo $before_widget;
			global $post, $page;
			if (has_post_thumbnail( $post->ID )) { $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); }
			
			if ( $title ) {
				echo $before_title . $title . $after_title;	
			}
			if(($boxtweet == 1) or ($boxg1 == 1) or ($boxlike == 1) or ($boxpinterest == 1) or ($boxlinkedin == 1)) {
				if($box_or_button == 0) {
					echo '<div class="gab_share_buttons">';
				} else {
					echo '<div class="gab_share_boxes">';
				}
			}
				if($box_or_button == 0) {
					if($boxg1) {
						echo '<div class="google-share-button"><div class="g-plus" data-action="share" data-annotation="bubble"></div></div>';
						add_action("wp_footer", "gabfire_share_google");
					}		
				
					if($boxtweet) {
						echo '<div class="twitter-share-button"><a href="https://twitter.com/share" class="twitter-share-button" data-url="'.get_permalink().'" data-text="'. get_the_title() .'" data-lang="'. substr(get_bloginfo ( 'language' ), 0, 2) .'"></a></div>';
						add_action("wp_footer", "gabfire_share_twitter"); 
					}
					if($boxlike) {
						echo '<div class="facebook-share-button"><div class="fb-like" data-href="'.get_permalink().'" data-send="false" data-layout="button_count" data-width="80" data-show-faces="true"></div></div>';
						add_action("wp_footer", "gabfire_share_facebook"); 
					}
					
					if($boxpinterest) { 
						echo '<div class="pinterest-share-button"><a href="http://pinterest.com/pin/create/button/?url='. urlencode(get_permalink()) .'&media='. urlencode($image[0]) .'&description='. get_the_excerpt() .'" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="';_e('Pin It','gabfire-widget-pack'); echo'" /></a></div>';
						add_action("wp_footer", "gabfire_share_pinterest");
					}							
					
					if($boxlinkedin) { 
						echo '<div class="linkedin-share-button"><script type="IN/Share" data-url="'.get_permalink().'" data-counter="right"></script></div>';
						add_action("wp_footer", "gabfire_share_linkedin");
					}
									
						
				} else {
					if($boxg1) {
						echo '<div class="google-share-box"><div class="g-plusone" data-size="tall"></div></div>';
						add_action("wp_footer", "gabfire_share_google");
					}		
				
					if($boxlike) {
						echo '<div class="facebook-share-box"><div class="fb-like" data-href="'.get_permalink().'" data-send="false" data-layout="box_count" data-width="65" data-show-faces="false"></div>
						</div>';
						add_action("wp_footer", "gabfire_share_facebook");
					}				
				
					if($boxtweet) {
						echo '<div class="twitter-share-box"><a href="https://twitter.com/share" class="twitter-share-button" data-url="'. get_permalink() .'" data-counturl="'.get_permalink().'" data-text="'. get_the_title() .'" data-lang="'. substr(get_bloginfo ( 'language' ), 0, 2) .'" data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a></div>';
						add_action("wp_footer", "gabfire_share_twitter"); 
					}

					if($boxlinkedin) { 
						echo '<div class="linkedin-share-box"><script type="IN/Share" data-url="'.get_permalink().'" data-counter="top"></script></div>';
						add_action("wp_footer", "gabfire_share_linkedin");
					}						
					
					if($boxpinterest) { 
						echo '<div class="pinterest-share-box"><a href="http://pinterest.com/pin/create/button/?url='. urlencode(get_permalink()) .'&media='. urlencode($image[0]) .'&description='. get_the_excerpt() .'" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="';_e('Pin It','gabfire-widget-pack'); echo'" /></a></div>';
						add_action("wp_footer", "gabfire_share_pinterest");
					}
					
				}			
				
			if(($boxtweet == 1) or ($boxg1 == 1) or ($boxlike == 1) or ($boxpinterest == 1)) {
				echo '</div><div class="clearfix"></div>';
			}
			if($fbook) {
				echo '<a target="_blank" rel="nofollow" class="facebook" href="http://www.facebook.com/share.php?u='.get_permalink().'&t=';the_title(); echo '" title="'; _e('Share on Facebook' , 'gabfire-widget-pack'); echo' ">Facebook</a>';			
			}
			if($tweet) {
				echo '<a target="_blank" rel="nofollow" class="twitter" href="http://twitter.com/home?status='.get_the_title() .' '.get_permalink().'" title="'; _e('Share on Twitter' , 'gabfire-widget-pack'); echo' ">Twitter</a>';
			}
			if($plus1) {
				echo '<a target="_blank" rel="nofollow" class="plus1" href="https://plusone.google.com/_/+1/confirm?hl=en&url='.get_permalink().'" title="'; _e('Share on Google1' , 'gabfire-widget-pack'); echo' ">Google1</a>';
			}	
			if($email) {
				$text 		= __( 'Email a Friend', 'gabfire-widget-pack' );
				$recommend	= __( 'I recommend this page:', 'gabfire-widget-pack' );
				$readon		= __( 'You can read it on:', 'gabfire-widget-pack' );
				
				$title = htmlspecialchars($post->post_title);
				$subject = htmlspecialchars(get_bloginfo('name')).' : '.$title;
				$body = $recommend . ' ' .$title. '.' . "\n" .$readon. ' ' .get_permalink($post->ID);
				echo '<a target="_blank" rel="nofollow" class="email" href="mailto:?subject='.rawurlencode($subject).'&amp;body='.rawurlencode($body).'" title="'.$text.' : '.$title.'">Email</a>';
			}
			if($dlc) {
				echo '<a target="_blank" rel="nofollow" class="delicious" href="http://del.icio.us/post?url='.get_permalink().'&title=';the_title(); echo '" title="'; _e('Share on Delicious' , 'gabfire-widget-pack'); echo' ">Delicious</a>';
			}
			if($digg) {
				echo '<a target="_blank" rel="nofollow" class="digg" href="http://digg.com/submit?url='.get_permalink().'&title=';the_title(); echo '" title="'; _e('Share on Digg' , 'gabfire-widget-pack'); echo' ">Digg</a>';
			}
			if($google) {
				echo '<a target="_blank" rel="nofollow" class="google2" href="http://www.google.com/bookmarks/mark?op=add&bkmk='.get_permalink().'&title=';the_title(); echo '" title="'; _e('Share on Google' , 'gabfire-widget-pack'); echo' ">Google</a>';
			}
			if($supon) {
				echo '<a target="_blank" rel="nofollow" class="stumbleupon" href="http://www.stumbleupon.com/submit?url='.get_permalink().'&title=';the_title(); echo '" title="'; _e('Share on StumbleUpon' , 'gabfire-widget-pack'); echo' ">Stumbleupon</a>';
			}
			if($reddit) {
				echo '<a target="_blank" rel="nofollow" class="reddit" href="http://reddit.com/submit?url='.get_permalink().'&title=';the_title(); echo '" title="'; _e('Share on Reddit' , 'gabfire-widget-pack'); echo' ">Reddit</a>';
			}
			if($tech) {
				echo '<a target="_blank" rel="nofollow" class="technorati" href="http://technorati.com/faves?sub=favthis&add='.get_permalink().'" title="'; _e('Share on Technorati' , 'gabfire-widget-pack'); echo' ">Technorati</a>';
			}
			if($yahoo) {
				echo '<a target="_blank" rel="nofollow" class="yahoo" href="http://buzz.yahoo.com/buzz?targetUrl='.get_permalink().'&headline=';the_title(); echo '" title="'; _e('Share on Yahoo' , 'gabfire-widget-pack'); echo' ">Yahoo</a>';
			}
			if($blogger) {
				echo '<a target="_blank" rel="nofollow" class="blogger" href="http://www.blogger.com/blog_this.pyra?t&u='.get_permalink().'&n=';the_title(); echo '&pli=1" title="'; _e('Share on Blogger' , 'gabfire-widget-pack'); echo' ">Blogger</a>';
			}
			if($myspace) {
				echo '<a target="_blank" rel="nofollow" class="myspace" href="http://www.myspace.com/Modules/PostTo/Pages/?u='.get_permalink().'&t=';the_title(); echo '&c='.get_permalink().'" title="'; _e('Share on Myspace' , 'gabfire-widget-pack'); echo' ">Myspace</a>';
			}
			if($rss) {
				echo '<a target="_blank" rel="nofollow" class="rss" href="'.get_post_comments_feed_link($post->ID) .'" title="'; _e('RSS Feed' , 'gabfire-widget-pack'); echo' ">RSS</a>';
			}
			echo '<div class="clear clearfix"></div>';
			
		echo $after_widget; 
	}
	
	function update($new_instance, $old_instance) { 
		$instance['title'] 		= strip_tags($new_instance['title']);
		$instance['boxtweet']	= $new_instance['boxtweet'];
		$instance['boxg1']	= $new_instance['boxg1'];
		$instance['boxlike']	= $new_instance['boxlike'];
		$instance['boxpinterest']	= $new_instance['boxpinterest'];
		$instance['boxlinkedin']	= $new_instance['boxlinkedin'];
		$instance['box_or_button']	= $new_instance['box_or_button'];
		$instance['plus1']	= $new_instance['plus1'];
		$instance['fbook'] = $new_instance['fbook'] ? '1' : '0';
		$instance['tweet'] = $new_instance['tweet'] ? '1' : '0';
		$instance['email'] = $new_instance['email'] ? '1' : '0';
		$instance['blogger']  = $new_instance['blogger'] ? '1' : '0';
		$instance['dlc'] = $new_instance['dlc'] ? '1' : '0';
		$instance['digg'] = $new_instance['digg'] ? '1' : '0';
		$instance['google'] = $new_instance['google'] ? '1' : '0';
		$instance['myspace'] = $new_instance['myspace'] ? '1' : '0';
		$instance['supon'] = $new_instance['supon'] ? '1' : '0';
		$instance['yahoo'] = $new_instance['yahoo'] ? '1' : '0';
		$instance['reddit'] = $new_instance['reddit'] ? '1' : '0';
		$instance['tech'] = $new_instance['tech'] ? '1' : '0';
		$instance['rss'] = $new_instance['rss'] ? '1' : '0';
		return $new_instance;
	}
 
	function form($instance) {
		$defaults	= array(
			'title' => 'Share This Post',
			'boxtweet' => '1',
			'box_or_button' => '1',
			'boxg1' => '1',
			'boxlike' => '1',
			'boxpinterest' => '1',
			'boxlinkedin' => '1',
			'plus1' => '0',
			'fbook' => '0',
			'tweet' => '0',
			'email' => '0',
			'blogger' => '0',
			'dlc' => '0',
			'digg' => '0',
			'google' => '0',
			'myspace' => '0',
			'supon' => '0',
			'yahoo' => '0',
			'reddit' => '0',
			'tech' => '0',
			'rss' => '0'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
	?>

	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','gabfire-widget-pack'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
	</p>
	
	<p>
		<select id="<?php echo $this->get_field_id( 'boxtweet' ); ?>" name="<?php echo $this->get_field_name( 'boxtweet' ); ?>">
			<option value="1" <?php if ( '1' == $instance['boxtweet'] ) echo 'selected="selected"'; ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php if ( '0' == $instance['boxtweet'] ) echo 'selected="selected"'; ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'boxtweet' ); ?>"><?php _e('Twitter Box/Button','gabfire-widget-pack'); ?></label> 
	</p>	
	
	<p>
		<select id="<?php echo $this->get_field_id( 'boxg1' ); ?>" name="<?php echo $this->get_field_name( 'boxg1' ); ?>">
			<option value="1" <?php selected( $instance['boxg1'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['boxg1'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'boxg1' ); ?>"><?php _e('Google +1 Box/Button','gabfire-widget-pack'); ?></label> 
	</p>	
	
	<p>
		<select id="<?php echo $this->get_field_id( 'boxlike' ); ?>" name="<?php echo $this->get_field_name( 'boxlike' ); ?>">
			<option value="1" <?php selected( $instance['boxlike'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['boxlike'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'boxlike' ); ?>"><?php _e('Facebook Like Box/Button','gabfire-widget-pack'); ?></label> 
	</p>	
	
	<p>
		<select id="<?php echo $this->get_field_id( 'boxpinterest' ); ?>" name="<?php echo $this->get_field_name( 'boxpinterest' ); ?>">
			<option value="1" <?php selected( $instance['boxpinterest'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['boxpinterest'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'boxpinterest' ); ?>"><?php _e('Pinterest Pin It Box/Button','gabfire-widget-pack'); ?></label> 
	</p>	
	
	<p>
		<select id="<?php echo $this->get_field_id( 'boxlinkedin' ); ?>" name="<?php echo $this->get_field_name( 'boxlinkedin' ); ?>">
			<option value="1" <?php selected( $instance['boxlinkedin'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['boxlinkedin'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'boxlinkedin' ); ?>"><?php _e('LinkedIn Box/Button','gabfire-widget-pack'); ?></label> 
	</p>		
	
	<p>
		<select id="<?php echo $this->get_field_id( 'box_or_button' ); ?>" name="<?php echo $this->get_field_name( 'box_or_button' ); ?>">
			<option value="0" <?php if ( '0' == $instance['box_or_button'] ) echo 'selected="selected"'; ?>><?php _e('Button style share items','gabfire-widget-pack'); ?></option>	
			<option value="1" <?php if ( '1' == $instance['box_or_button'] ) echo 'selected="selected"'; ?>><?php _e('Box style share items','gabfire-widget-pack'); ?></option>
		</select><br />
		<label for="<?php echo $this->get_field_id( 'box_or_button' ); ?>"><?php _e('Select whether Box or Button style for social platform dynamic share items','gabfire-widget-pack'); ?></label> 
	</p>		
	
	<p>
		<select id="<?php echo $this->get_field_id( 'fbook' ); ?>" name="<?php echo $this->get_field_name( 'fbook' ); ?>">
			<option value="1" <?php selected( $instance['fbook'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['fbook'], '0' );  ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'fbook' ); ?>"><?php _e('Share on Facebook','gabfire-widget-pack'); ?></label> 
	</p>		
	
	<p>
		<select id="<?php echo $this->get_field_id( 'tweet' ); ?>" name="<?php echo $this->get_field_name( 'tweet' ); ?>">
			<option value="1" <?php selected( $instance['tweet'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['tweet'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'tweet' ); ?>"><?php _e('Share on Twitter','gabfire-widget-pack'); ?></label> 
	</p>	
	
	<p>
		<select id="<?php echo $this->get_field_id( 'plus1' ); ?>" name="<?php echo $this->get_field_name( 'plus1' ); ?>">
			<option value="1" <?php selected( $instance['plus1'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['plus1'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'plus1' ); ?>"><?php _e('Share on Google1','gabfire-widget-pack'); ?></label> 
	</p>	
	
	<p>
		<select id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>">
			<option value="1" <?php selected( $instance['email'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['email'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Send as Email','gabfire-widget-pack'); ?></label> 
	</p>	
	
	<p>
		<select id="<?php echo $this->get_field_id( 'dlc' ); ?>" name="<?php echo $this->get_field_name( 'dlc' ); ?>">
			<option value="1" <?php selected( $instance['dlc'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['dlc'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'dlc' ); ?>"><?php _e('Bookmark on Delicious','gabfire-widget-pack'); ?></label> 
	</p>	
	
	<p>
		<select id="<?php echo $this->get_field_id( 'digg' ); ?>" name="<?php echo $this->get_field_name( 'digg' ); ?>">
			<option value="1" <?php selected( $instance['digg'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['digg'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'digg' ); ?>"><?php _e('Share on Digg','gabfire-widget-pack'); ?></label> 
	</p>	
	
	<p>
		<select id="<?php echo $this->get_field_id( 'google' ); ?>" name="<?php echo $this->get_field_name( 'google' ); ?>">
			<option value="1" <?php selected( $instance['google'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['google'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'google' ); ?>"><?php _e('Share on Google','gabfire-widget-pack'); ?></label> 
	</p>	
	
	<p>
		<select id="<?php echo $this->get_field_id( 'supon' ); ?>" name="<?php echo $this->get_field_name( 'supon' ); ?>">
			<option value="1" <?php selected( $instance['supon'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['supon'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'supon' ); ?>"><?php _e('Share on Stumbleupon','gabfire-widget-pack'); ?></label> 
	</p>

	<p>
		<select id="<?php echo $this->get_field_id( 'reddit' ); ?>" name="<?php echo $this->get_field_name( 'reddit' ); ?>">
			<option value="1" <?php selected( $instance['reddit'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['reddit'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'reddit' ); ?>"><?php _e('Share on Reddit','gabfire-widget-pack'); ?></label> 
	</p>

	<p>
		<select id="<?php echo $this->get_field_id( 'tech' ); ?>" name="<?php echo $this->get_field_name( 'tech' ); ?>">
			<option value="1" <?php selected( $instance['tech'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['tech'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'tech' ); ?>"><?php _e('Share on Technorati','gabfire-widget-pack'); ?></label> 
	</p>
	
	<p>
		<select id="<?php echo $this->get_field_id( 'yahoo' ); ?>" name="<?php echo $this->get_field_name( 'yahoo' ); ?>">
			<option value="1" <?php selected( $instance['yahoo'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['yahoo'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'yahoo' ); ?>"><?php _e('Share on Yahoo','gabfire-widget-pack'); ?></label> 
	</p>
	
	<p>
		<select id="<?php echo $this->get_field_id( 'blogger' ); ?>" name="<?php echo $this->get_field_name( 'blogger' ); ?>">
			<option value="1" <?php selected( $instance['blogger'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['blogger'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'blogger' ); ?>"><?php _e('Share on Blogger','gabfire-widget-pack'); ?></label> 
	</p>		
	
	<p>
		<select id="<?php echo $this->get_field_id( 'myspace' ); ?>" name="<?php echo $this->get_field_name( 'myspace' ); ?>">
			<option value="1" <?php selected( $instance['myspace'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['myspace'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'myspace' ); ?>"><?php _e('Share on MySpace','gabfire-widget-pack'); ?></label> 
	</p>
	<p>
		<select id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>">
			<option value="1" <?php selected( $instance['rss'], '1' ); ?>><?php _e('Enable','gabfire-widget-pack'); ?></option>
			<option value="0" <?php selected( $instance['rss'], '0' ); ?>><?php _e('Disable','gabfire-widget-pack'); ?></option>	
		</select>
		<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e('Display Comments RSS','gabfire-widget-pack'); ?></label> 
	</p>
	
<?php
	}
}

// Social Scripts
if(!function_exists('gabfire_share_facebook')) {
	function gabfire_share_facebook() { ?>
		<?php
		$language = get_bloginfo('language'); 
		$language = str_replace("-", "_", $language); 
		?>

		<div id="fb-root"></div>
		<script type='text/javascript'>
		<!--
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/<?php echo $language; ?>/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		// -->
		</script>
	<?php }
}

if(!function_exists('gabfire_share_twitter')) {
	function gabfire_share_twitter() { ?>
		<script type='text/javascript'>
		<!--
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
		// -->
		</script>
	<?php }
}

if(!function_exists('gabfire_share_google')) {
	function gabfire_share_google() { ?>	
		<script type="text/javascript">
			<!--
		  (function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		  // -->
		</script>
	<?php }
}

if(!function_exists('gabfire_share_pinterest')) {
	function gabfire_share_pinterest() { ?>
		<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
		<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js">
		<!--
			document.body.innerHTML = document.body.innerHTML.replace(/&amp;;/g, "a");
		// -->
		</script>
	<?php }
} 

if(!function_exists('gabfire_share_linkedin')) {
	function gabfire_share_linkedin() { ?>
		<script src="//platform.linkedin.com/in.js" type="text/javascript">
		<?php 
		$language = get_bloginfo('language'); 
		$language = str_replace("-", "_", $language);		
		echo "lang: $language"; ?>
		</script>
	<?php }
} 



function register_gab_share() {
	register_widget('gab_share');
}

add_action('widgets_init', 'register_gab_share');