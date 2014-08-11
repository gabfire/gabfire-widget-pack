<?php
/*
	Plugin Name: Gabfire Widget Pack
	Plugin URI: http://www.gabfirethemes.com
	Description: This plugin adds a bundle of the most commonly used widgets to your site.
	Author: Gabfire Themes
	Version: 1.3.9
	Author URI: http://www.gabfirethemes.com

    Copyright 2013 Gabfire Themes (email : info@gabfire.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/

define( 'GABFIRE_WIDGETS_VERSION', '1.3.9');
define( 'GABFIRE_WIDGETS_DIR', dirname(__FILE__) );
define( 'GABFIRE_WIDGETS_URL', plugins_url().'/gabfire-widget-pack' );

// Load JS and CSS files
if (!is_admin()) add_action( 'wp_print_styles', 'gabfire_starterpack_css' );

if (!function_exists('gabfire_starterpack_css')) {
	function gabfire_starterpack_css() {
		wp_enqueue_style('smartwidgetscss', GABFIRE_WIDGETS_URL .'/style.css');
	}
}

add_action('init', 'gabfire_widget_pack_load_plugin_textdomain');

function gabfire_widget_pack_load_plugin_textdomain() {
	load_plugin_textdomain('gabfire-widget-pack', false, basename( dirname( __FILE__ ) ) . '/lang');
}

require_once( GABFIRE_WIDGETS_DIR .  '/admin/options.php' );
$gabfire_options = get_option('gab_options');

/*
 * Edited by Kyle benk kylebenkapps.com kjbenk@gmail.com on 1/27/14
 */

/*
 * Check to see if there is an option if not set to default option
 */

$gabfire_default_option = array(
	'about_widget' 		=> 0,
	'contact_info' 		=> 0,
	'archive_widget' 	=> 0,
	'ajaxtabs' 			=> 0,
	'authorbadge' 		=> 0,
	'feedburner' 		=> 0,
	'flickrrss' 		=> 0,
	'search' 			=> 0,
	'share' 			=> 0,
	'social' 			=> 0,
	'text_widget' 		=> 0,
	'popular_random' 	=> 0,
	'recent_tweets' 	=> 0
);

if (false === $gabfire_options) {
	$gabfire_options = $gabfire_default_option;
}


/*
 * Also make sure each index exists before comparing it
 */

if (isset($gabfire_options['about_widget']) && $gabfire_options['about_widget'] == 1) 	{	require_once(GABFIRE_WIDGETS_DIR . '/widget-about.php');			}
if (isset($gabfire_options['contact_info']) && $gabfire_options['contact_info'] == 1) 	{	require_once(GABFIRE_WIDGETS_DIR . '/widget-address.php');		}
if (isset($gabfire_options['archive_widget']) && $gabfire_options['archive_widget'] == 1){	require_once(GABFIRE_WIDGETS_DIR . '/widget-archive.php');		}
if (isset($gabfire_options['ajaxtabs']) && $gabfire_options['ajaxtabs'] == 1) 		{	require_once(GABFIRE_WIDGETS_DIR . '/widget-ajaxtabs.php');		}
if (isset($gabfire_options['authorbadge']) && $gabfire_options['authorbadge'] == 1) 	{	require_once(GABFIRE_WIDGETS_DIR . '/widget-authorbadge.php');	}
if (isset($gabfire_options['feedburner']) && $gabfire_options['feedburner'] == 1) 	{	require_once(GABFIRE_WIDGETS_DIR . '/widget-feedburner.php');		}
if (isset($gabfire_options['flickrrss']) && $gabfire_options['flickrrss'] == 1) 	{	require_once(GABFIRE_WIDGETS_DIR . '/widget-flickr.php');			}
if (isset($gabfire_options['relatedposts']) && $gabfire_options['relatedposts'] == 1) 	{	require_once(GABFIRE_WIDGETS_DIR . '/widget-relatedposts.php');	}
if (isset($gabfire_options['search']) && $gabfire_options['search'] == 1) 	 	{	require_once(GABFIRE_WIDGETS_DIR . '/widget-search.php');			}
if (isset($gabfire_options['share']) && $gabfire_options['share'] == 1) 		{	require_once(GABFIRE_WIDGETS_DIR . '/widget-shareitems.php');		}
if (isset($gabfire_options['social']) && $gabfire_options['social'] == 1) 		{	require_once(GABFIRE_WIDGETS_DIR . '/widget-social.php');			}
if (isset($gabfire_options['text_widget']) && $gabfire_options['text_widget'] == 1) 	{	require_once(GABFIRE_WIDGETS_DIR . '/widget-text.php');			}
if (isset($gabfire_options['popular_random']) && $gabfire_options['popular_random'] == 1){	require_once(GABFIRE_WIDGETS_DIR . '/widget-pop-rand-rcnt.php');	}
if (isset($gabfire_options['recent_tweets']) && $gabfire_options['recent_tweets'] == 1)	{	require_once(GABFIRE_WIDGETS_DIR . '/widget-recent-tweets.php');	}