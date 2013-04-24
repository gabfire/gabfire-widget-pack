<?php
function gabfire_widgetpack_loc() {
	load_plugin_textdomain('gabfire-widget-pack', false, dirname(plugin_basename(__FILE__)) . '/lang/');
}
add_action('after_setup_theme', 'gabfire_widgetpack_loc');

// ------------------------------------------------------------------------
// REGISTER HOOKS & CALLBACK FUNCTIONS:
// ------------------------------------------------------------------------
// Set-up Action and Filter Hooks
register_activation_hook(__FILE__, 'gab_add_defaults');
register_uninstall_hook(__FILE__, 'gab_delete_plugin_options');
add_action('admin_init', 'gab_init' );
add_action('admin_menu', 'gab_add_options_page');

// --------------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: register_uninstall_hook(__FILE__, 'gab_delete_plugin_options')
// --------------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE USER DEACTIVATES AND DELETES THE PLUGIN. IT SIMPLY DELETES
// THE PLUGIN OPTIONS DB ENTRY (WHICH IS AN ARRAY STORING ALL THE PLUGIN OPTIONS).
// --------------------------------------------------------------------------------------

// Delete options table entries ONLY when plugin deactivated AND deleted
function gab_delete_plugin_options() {
	delete_option('gab_options');
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: register_activation_hook(__FILE__, 'gab_add_defaults')
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE PLUGIN IS ACTIVATED. IF THERE ARE NO THEME OPTIONS
// CURRENTLY SET, OR THE USER HAS SELECTED THE CHECKBOX TO RESET OPTIONS TO THEIR
// DEFAULTS THEN THE OPTIONS ARE SET/RESET.
//
// OTHERWISE, THE PLUGIN OPTIONS REMAIN UNCHANGED.
// ------------------------------------------------------------------------------

// Define default option settings
function gab_add_defaults() {
		delete_option('gab_options');
		$arr = array(	"about_widget" => "1",
						"social" => "1",
						"share" => "1",
						"search" => "1",
						"relatedposts" => "1",
						"text_widget" => "1",
						"text_widget2" => "1",
						"tweet_widget" => "1",
						"ajaxtabs" => "1",
						"archive_widget" => "1",
						"authorbadge" => "1",
						"feedburner" => "1",
						"flickrrss" => "1"
		);
		update_option('gab_options', $arr);
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: add_action('admin_init', 'gab_init' )
// ------------------------------------------------------------------------------

// Init plugin options to white list our options
function gab_init(){
	register_setting( 'gab_plugin_options', 'gab_options', 'gab_validate_options' );
	wp_register_style( 'gabfire_widgets_admincss', plugins_url('options.css', __FILE__) );
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: add_action('admin_menu', 'gab_add_options_page');
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE 'admin_menu' HOOK FIRES, AND ADDS A NEW OPTIONS
// PAGE FOR YOUR PLUGIN TO THE SETTINGS MENU.
// ------------------------------------------------------------------------------

// Add menu page
function gab_add_options_page() {
	/* Add our plugin submenu and administration screen */
	$hook = add_submenu_page( 'themes.php', // The parent page of this submenu
							  __( 'Gabfire Widget Pack', 'gabfire-widget-pack' ), // The submenu title
							  __( 'Gabfire Widget Pack', 'gabfire-widget-pack' ), // The screen title
			  'manage_options', // The capability required for access to this submenu
			  'gab-widget-pack-options', // The slug to use in the URL of the screen
							  'gab_render_form' // The function to call to display the screen
						   );

	add_action('admin_print_scripts-' . $hook, 'gab_smart_widgets_css');
}

function gab_smart_widgets_css() {
	/* Link already registered script to the settings page */
	wp_enqueue_style( 'gabfire_widgets_admincss' );
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION SPECIFIED IN: add_options_page()
// ------------------------------------------------------------------------------
// THIS FUNCTION IS SPECIFIED IN add_options_page() AS THE CALLBACK FUNCTION THAT
// ACTUALLY RENDER THE PLUGIN OPTIONS FORM AS A SUB-MENU UNDER THE EXISTING
// SETTINGS ADMIN MENU.
// ------------------------------------------------------------------------------

// Render the Plugin options form
function gab_render_form() {
	?>
	<script type="text/javascript">
		$(document).ready(function() {		
			$('#textbox1').val($(this).is(':checked'));
			
			$('#checkbox1').change(function() {
				$('.mycheck').val($(this).is(':checked'));
			});
		});	
	</script>
	<div class="wrap">
	
		<div id="panelheader">
			<div id="branding">
				<a href="http://www.gabfirethemes.com/" />
					<img src="<?php echo plugins_url('gabfire-widget-pack/images/logo.png'); ?>" alt="" />
				</a>
			</div>
			<div class="header-info">
				Gabfire Widget Pack <?php echo constant( 'GABFIRE_WIDGETS_VERSION' ); ?>
			</div>
		</div>	

		<!-- Beginning of the Plugin Options Form -->
		<form method="post" action="options.php">
			<?php settings_fields('gab_plugin_options'); ?>
			<?php $options = get_option('gab_options'); ?>

			<div id="settings-metabox">			
				<div class="gabfire_options_submit marginbottom">
					<p class="activate_widgets_notice"><?php _e('Activate the widgets you wish to enable and click <strong>Save Changes</strong>','gabfire-widget-pack'); ?></p>
					<input type="submit" class="button-primary" value="<?php _e('Save Changes', 'gabfire-widget-pack') ?>" />
				</div>			
				
				<?php if($options['about_widget'] == 1) { $state = "active"; } else { $state = "deactive"; } ?>
				<div class="gab_option_box gab_left <?php echo $state; ?>">
				
					<h3><?php _e('About Us','gabfire-widget-pack'); ?></h3>
					<label class="widget_trigger">
						<input  type="checkbox" name="gab_options[about_widget]" value="1" <?php if (isset($options['about_widget'])) { checked('1', $options['about_widget']); } ?> />
						<span class="gab_switcher">
							<span class="gab_switcheron"><?php _e('ON','gabfire-widget-pack'); ?></span>
							<span class="gab_switcheroff"><?php _e('OFF','gabfire-widget-pack'); ?></span>
							<span class="gab_switcherblock"></span>
						</span>
					</label>
					<p><?php _e('Using this Widget display a short text about a person, company or organization. The widget also can link display a link to any page or post.','gabfire-widget-pack'); ?></p>
				</div>
				
				<?php if($options['ajaxtabs'] == 1) { $state = "active"; } else { $state = "deactive"; } ?>
				<div class="gab_option_box gab_right <?php echo $state; ?>">
					<h3><?php _e('Posts Tabs Widget','gabfire-widget-pack'); ?></h3>
					
					<label class="widget_trigger">
						<input  type="checkbox" name="gab_options[ajaxtabs]" value="1" <?php if (isset($options['ajaxtabs'])) { checked('1', $options['ajaxtabs']); } ?> />
						<span class="gab_switcher">
							<span class="gab_switcheron"><?php _e('ON','gabfire-widget-pack'); ?></span>
							<span class="gab_switcheroff"><?php _e('OFF','gabfire-widget-pack'); ?></span>
							<span class="gab_switcherblock"></span>
						</span>
					</label>
					<p><?php _e('Display recent, recently commented and popular posts with Ajax Tabs support. This widget will not support any Media/Video option unless you are on a Gabfire Theme.','gabfire-widget-pack'); ?></p>
				</div>
				
				<div class="clearfix"></div>
				
				<?php if($options['archive_widget'] == 1) { $state = "active"; } else { $state = "deactive"; } ?>
				<div class="gab_option_box gab_left <?php echo $state; ?>">
					<h3><?php _e('Archive Search','gabfire-widget-pack'); ?></h3>
					
					<label class="widget_trigger">
						<input  type="checkbox" name="gab_options[archive_widget]" value="1" <?php if (isset($options['archive_widget'])) { checked('1', $options['archive_widget']); } ?> />
						<span class="gab_switcher">
							<span class="gab_switcheron"><?php _e('ON','gabfire-widget-pack'); ?></span>
							<span class="gab_switcheroff"><?php _e('OFF','gabfire-widget-pack'); ?></span>
							<span class="gab_switcherblock"></span>
						</span>
					</label>
					<p><?php _e('A quick option for your visitors to search in archive of your website.','gabfire-widget-pack'); ?></p>
				</div>
								
				<?php if($options['authorbadge'] == 1) { $state = "active"; } else { $state = "deactive"; } ?>
				<div class="gab_option_box gab_right <?php echo $state; ?>">					
					<h3><?php _e('Author Badge','gabfire-widget-pack'); ?></h3>
					
					<label class="widget_trigger">
						<input  type="checkbox" name="gab_options[authorbadge]" value="1" <?php if (isset($options['authorbadge'])) { checked('1', $options['authorbadge']); } ?> />
						<span class="gab_switcher">
							<span class="gab_switcheron"><?php _e('ON','gabfire-widget-pack'); ?></span>
							<span class="gab_switcheroff"><?php _e('OFF','gabfire-widget-pack'); ?></span>
							<span class="gab_switcherblock"></span>
						</span>
					</label>
					<p><?php _e('This widget will display only at Author and Single Post pages and if post author has any bio information entered into his/her profile','gabfire-widget-pack'); ?></p>
				</div>
				
				<div class="clearfix"></div>
				
				<?php if($options['text_widget'] == 1) { $state = "active"; } else { $state = "deactive"; } ?>
				<div class="gab_option_box gab_right <?php echo $state; ?>">					
					<h3><?php _e('Gabfire Text+ Widget','gabfire-widget-pack'); ?></h3>
					
					<label class="widget_trigger">
						<input  type="checkbox" name="gab_options[text_widget]" value="1" <?php if (isset($options['text_widget'])) { checked('1', $options['text_widget']); } ?> />
						<span class="gab_switcher">
							<span class="gab_switcheron"><?php _e('ON','gabfire-widget-pack'); ?></span>
							<span class="gab_switcheroff"><?php _e('OFF','gabfire-widget-pack'); ?></span>
							<span class="gab_switcherblock"></span>
						</span>
					</label>
					<p><?php _e('Gabfire Text Widget: Display a regular text in a nicely designed form.','gabfire-widget-pack'); ?></p>
				</div>
				
				<?php if($options['feedburner'] == 1) { $state = "active"; } else { $state = "deactive"; } ?>
				<div class="gab_option_box gab_right <?php echo $state; ?>">					
					<h3><?php _e('Feedburner Email Subscribe','gabfire-widget-pack'); ?></h3>
					
					<label class="widget_trigger">
						<input  type="checkbox" name="gab_options[feedburner]" value="1" <?php if (isset($options['feedburner'])) { checked('1', $options['feedburner']); } ?> />
						<span class="gab_switcher">
							<span class="gab_switcheron"><?php _e('ON','gabfire-widget-pack'); ?></span>
							<span class="gab_switcheroff"><?php _e('OFF','gabfire-widget-pack'); ?></span>
							<span class="gab_switcherblock"></span>
						</span>
					</label>
					<p><?php _e('Display an input field where your visitors could easily signup to Feedburner Email subscription list.','gabfire-widget-pack'); ?></p>
				</div>
				
				<div class="clearfix"></div>
				
				<?php if($options['flickrrss'] == 1) { $state = "active"; } else { $state = "deactive"; } ?>
				<div class="gab_option_box gab_left <?php echo $state; ?>">					
					<h3><?php _e('Flickr Images','gabfire-widget-pack'); ?></h3>
					
					<label class="widget_trigger">
						<input  type="checkbox" name="gab_options[flickrrss]" value="1" <?php if (isset($options['flickrrss'])) { checked('1', $options['flickrrss']); } ?> />
						<span class="gab_switcher">
							<span class="gab_switcheron"><?php _e('ON','gabfire-widget-pack'); ?></span>
							<span class="gab_switcheroff"><?php _e('OFF','gabfire-widget-pack'); ?></span>
							<span class="gab_switcherblock"></span>
						</span>
					</label>
					<p><?php _e('Choose the criteria and display Flickr photos on your site.','gabfire-widget-pack'); ?></p>
				</div>
				
				<?php if($options['relatedposts'] == 1) { $state = "active"; } else { $state = "deactive"; } ?>
				<div class="gab_option_box gab_right <?php echo $state; ?>">					
					<h3><?php _e('Related Posts','gabfire-widget-pack'); ?></h3>
					
					<label class="widget_trigger">
						<input  type="checkbox" name="gab_options[relatedposts]" value="1" <?php if (isset($options['relatedposts'])) { checked('1', $options['relatedposts']); } ?> />
						<span class="gab_switcher">
							<span class="gab_switcheron"><?php _e('ON','gabfire-widget-pack'); ?></span>
							<span class="gab_switcheroff"><?php _e('OFF','gabfire-widget-pack'); ?></span>
							<span class="gab_switcherblock"></span>
						</span>
					</label>
					<p><?php _e('Display related posts based on similar tags between posts.','gabfire-widget-pack'); ?></p>
				</div>
				
				<div class="clearfix"></div>
				
				<?php if($options['search'] == 1) { $state = "active"; } else { $state = "deactive"; } ?>
				<div class="gab_option_box gab_left <?php echo $state; ?>">					
					<h3><?php _e('Search','gabfire-widget-pack'); ?></h3>
					
					<label class="widget_trigger">
						<input  type="checkbox" name="gab_options[search]" value="1" <?php if (isset($options['search'])) { checked('1', $options['search']); } ?> />
						<span class="gab_switcher">
							<span class="gab_switcheron"><?php _e('ON','gabfire-widget-pack'); ?></span>
							<span class="gab_switcheroff"><?php _e('OFF','gabfire-widget-pack'); ?></span>
							<span class="gab_switcherblock"></span>
						</span>
					</label>
					<p><?php _e('Replace default WordPress search form with nicely designed Gabfire Search Forms ','gabfire-widget-pack'); ?></p>
				</div>
								
				<?php if($options['share'] == 1) { $state = "active"; } else { $state = "deactive"; } ?>
				<div class="gab_option_box gab_right <?php echo $state; ?>">					
					<h3><?php _e('Share Posts','gabfire-widget-pack'); ?></h3>
					
					<label class="widget_trigger">
						<input  type="checkbox" name="gab_options[share]" value="1" <?php if (isset($options['share'])) { checked('1', $options['share']); } ?> />
						<span class="gab_switcher">
							<span class="gab_switcheron"><?php _e('ON','gabfire-widget-pack'); ?></span>
							<span class="gab_switcheroff"><?php _e('OFF','gabfire-widget-pack'); ?></span>
							<span class="gab_switcherblock"></span>
						</span>
					</label>
					<p><?php _e('Get Social and let your visitors to share your entries on social platforms','gabfire-widget-pack'); ?></p>
				</div>
				
				<div class="clearfix"></div>
				
				<?php if($options['social'] == 1) { $state = "active"; } else { $state = "deactive"; } ?>
				<div class="gab_option_box gab_left <?php echo $state; ?>">					
					<h3><?php _e('Social Icons','gabfire-widget-pack'); ?></h3>
					
					<label class="widget_trigger">
						<input  type="checkbox" name="gab_options[social]" value="1" <?php if (isset($options['social'])) { checked('1', $options['social']); } ?> />
						<span class="gab_switcher">
							<span class="gab_switcheron"><?php _e('ON','gabfire-widget-pack'); ?></span>
							<span class="gab_switcheroff"><?php _e('OFF','gabfire-widget-pack'); ?></span>
							<span class="gab_switcherblock"></span>
						</span>
					</label>
					<p><?php _e('Get connected with your visitors and let them know where they could find you on social platforms','gabfire-widget-pack'); ?></p>
				</div>
												
				<div class="clearfix"></div>
				<div class="gabfire_options_submit">
					<p class="activate_widgets_notice"><?php _e('Activate the widgets you wish to enable and click <strong>Save Changes</strong>','gabfire-widget-pack'); ?></p>
					<input type="submit" class="button-primary" value="<?php _e('Save Changes', 'gabfire-widget-pack') ?>" />
				</div>
					
			</div><!-- Settings Metabox -->				
		</form>

	</div>
	<?php	
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function gab_validate_options($input) {
	 // strip html from textboxes
	$input['textarea_one'] =  wp_filter_nohtml_kses($input['textarea_one']); // Sanitize textarea input (strip html tags, and escape characters)
	$input['txt_one'] =  wp_filter_nohtml_kses($input['txt_one']); // Sanitize textbox input (strip html tags, and escape characters)
	return $input;
}


add_action( 'admin_enqueue_scripts', 'gabfire_wpack_pointers_header' );

function gabfire_wpack_pointers_header() {
	if ( gabfire_wpack_pointers_check() ) {
		add_action( 'admin_print_footer_scripts', 'gabfire_admin_pointers_footer' );
		wp_enqueue_script( 'wp-pointer' );
		wp_enqueue_style( 'wp-pointer' );
	}
}

function gabfire_wpack_pointers_check() {
	$admin_pointers = gabfire_admin_pointers();
	foreach ( $admin_pointers as $pointer => $array ) {
		if ( $array['active'] )
			return true;
	}
}

function gabfire_admin_pointers_footer() {
   $admin_pointers = gabfire_admin_pointers();
   ?>
<script type="text/javascript">
/* <![CDATA[ */
( function($) {
   <?php
   foreach ( $admin_pointers as $pointer => $array ) {
      if ( $array['active'] ) {
         ?>
         $( '<?php echo $array['anchor_id']; ?>' ).pointer( {
            content: '<?php echo $array['content']; ?>',
            position: {
            edge: '<?php echo $array['edge']; ?>',
            align: '<?php echo $array['align']; ?>'
         },
            close: function() {
               $.post( ajaxurl, {
                  pointer: '<?php echo $pointer; ?>',
                  action: 'dismiss-wp-pointer'
               } );
            }
         } ).pointer( 'open' );
         <?php
      }
   }
   ?>
} )(jQuery);
/* ]]> */
</script>
   <?php
}

function gabfire_admin_pointers() {
   $dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
   $version = '1_0'; // replace all periods in 1.0 with an underscore
   $prefix = 'gabfire_admin_pointers' . $version . '_';

   $new_pointer_content = '<h3>' . __( 'Gabfire Widget Pack | Notice', 'gabfire-widget-pack' ) . '</h3>';
   $new_pointer_content .= '<p>' . __( 'Click here and select Gabfire Widget Pack to activate the widgets that you wish to enable for your site', 'gabfire-widget-pack' ). '</p>';

   return array(
      $prefix . 'new_items' => array(
         'content' => $new_pointer_content,
         'anchor_id' => '#menu-appearance',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . 'new_items', $dismissed ) )
      ),
   );
}