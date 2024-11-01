<?php
/*
Plugin Name: Twitter @Anywhere
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Add the Twitter @Anywhere functionality to your wordpress blog. Read more at http://dev.twitter.com/anywhere/begin
Version: 0.1
Author: Brad Vincent
Author URI: http://themergency.com
License: GPL2
*/

include_once(dirname(__FILE__).'/twitter_anywhere_shortcodes.php');
include_once(dirname(__FILE__).'/twitter_anywhere_output.php');

//function to check if we have an API key in the settings
function twitany_check() {
	global $twitany_admin_options;
	
	if (!count($twitany_admin_options)) {
		$twitany_admin_options = (array)get_option('twitany_settings');
		unset($twitany_admin_options[0]);
	}	
	
	$appid = $twitany_admin_options['appid'];
	
	if (strlen($appid) == 0 || 
		$appid == 'YOUR_API_HERE' ||
		$twitany_admin_options['selected'] == 'disabled') return false;
		
	return true;
}



if (!is_admin()) {
	//hook up some shortcode handlers
	add_shortcode("followbutton", "followbutton_handler");
	add_shortcode("tweetbox", "tweetbox_handler");

	include_once(dirname(__FILE__).'/twitter_anywhere_blog.php');
	
	//hook up some actions
	add_action('init', 'twitany_include_js');
	add_action('wp_head', 'twitany_head');
	
} else {

	include_once(dirname(__FILE__).'/twitter_anywhere_admin.php');

	//init the plugin
	add_action('admin_menu', 'twitany_admin_init', -1000);
	//add settings link
	add_filter( 'plugin_action_links_'.plugin_basename(__FILE__), 'twitany_plugin_actions', -10);
	//setup the menus
	add_action('admin_menu', 'twitany_admin_actions');
}

?>