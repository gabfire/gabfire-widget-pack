<?php
/*
	Plugin Name: Gabfire Widget Pack
	Plugin URI: http://www.gabfirethemes.com
	Description: This plugin adds a bundle of most commonly used widgets to your site.
	Author: Gabfire Themes
	Version: 1.0
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

define( 'GABFIRE_WIDGETS_VERSION', '0.1');
define( 'SMART_WIDGETS_DIR', dirname(__FILE__) );
define( 'SMART_WIDGETS_URL', plugins_url().'/gabfire-widget-pack' );

// Load JS and CSS files
if (!is_admin()) add_action( 'wp_print_styles', 'gabfire_starterpack_css' );

if (!function_exists('gabfire_starterpack_css')) {
	function gabfire_starterpack_css() {
		wp_enqueue_style('smartwidgetscss', SMART_WIDGETS_URL .'/style.css');
	}
}

require_once( SMART_WIDGETS_DIR .  '/admin/options.php' );
$options = get_option('gab_options');

if ($options['about_widget'] == 1) 	{	require_once(SMART_WIDGETS_DIR . '/widget-about.php');			}
if ($options['archive_widget'] == 1){	require_once(SMART_WIDGETS_DIR . '/widget-archive.php');		}
if ($options['ajaxtabs'] == 1) 		{	require_once(SMART_WIDGETS_DIR . '/widget-ajaxtabs.php');	}
if ($options['authorbadge'] == 1) 	{	require_once(SMART_WIDGETS_DIR . '/widget-authorbadge.php');	}
if ($options['feedburner'] == 1) 	{	require_once(SMART_WIDGETS_DIR . '/widget-feedburner.php');		}
if ($options['flickrrss'] == 1) 	{	require_once(SMART_WIDGETS_DIR . '/widget-flickr.php');			}
if ($options['relatedposts'] == 1) 	{	require_once(SMART_WIDGETS_DIR . '/widget-relatedposts.php');	}
if ($options['search'] == 1) 	 	{	require_once(SMART_WIDGETS_DIR . '/widget-search.php');			}
if ($options['share'] == 1) 		{	require_once(SMART_WIDGETS_DIR . '/widget-shareitems.php');		}
if ($options['social'] == 1) 		{	require_once(SMART_WIDGETS_DIR . '/widget-social.php');			}
if ($options['text_widget'] == 1) 	{	require_once(SMART_WIDGETS_DIR . '/widget-text.php');			}
if ($options['popular_random'] == 1) 	{	require_once(SMART_WIDGETS_DIR . '/widget-popular_random_recent.php');			}
