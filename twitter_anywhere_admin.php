<?php
/*
Part of the Twitter @Anywhere Plugin
*/

global $twitany_admin_options;

function twitany_admin_actions() {
	add_options_page("Twitter @Anywhere", "Twitter @Anywhere", 1, "twitany_admin", "twitany_admin");  
}

function twitany_admin() {
	include_once(dirname(__FILE__).'/twitter_anywhere_options.php');
}

// Read plugin options or set default values
function twitany_admin_init() {
	global $twitany_admin_options;
	
	if (isset($_POST['twitany_options']) && ($_POST['twitany_options'] == 1) )
		twitany_processform();
	
	$defaults = twitany_defaults();
	
	if (!count($twitany_admin_options)) {
		$twitany_admin_options = (array)get_option('twitany_settings');
		unset($twitany_admin_options[0]);
	}
	
	$twitany_admin_options = array_merge($defaults, $twitany_admin_options);
}

// Set defaults
function twitany_defaults() {
	return array(
		'appid' => 'YOUR_API_HERE',
		'selected' => 'hovercards',
		'linkifyselector' => '',
		'linkifycss' => ''
	);
}

function twitany_debug_test_output() {
	echo htmlspecialchars(twitany_generate_output());
}

// Process $_POST
function twitany_processform() {

	global $twitany_admin_options;
	
	check_admin_referer('twitany-options');
	
	// Debug:
	//echo "<pre>";echo htmlentities(print_r($_POST,true));echo "</pre>";
	//echo print_r((array)get_option('twitany_settings'),true);
	
	
	switch ($_POST['action']) {
	case 'update':
	
		$defaults = twitany_defaults();
		
		foreach ($_POST as $k=>$v) {
			$k = str_replace('twitany_','',$k);
			if (array_key_exists($k, $defaults)) {
				$options[$k] = attribute_escape($v);
			}
		}
		
		if (!update_option('twitany_settings', $options))
			add_option('twitany_settings', $options);
			
		$twitany_admin_options = array_merge( (array)$twitany_admin_options, $options );
		
		$msg = __('saved', 'twitany');
		break;

	case 'reset':
		delete_option('twitany_settings');
		$msg = __('reset', 'twitany');
		break;
	}

	$message  = '<div id="message" class="updated fade">';
	$message .= '<p>'.sprintf(__('Twitter @Anywhere settings <strong>%s</strong>'), $msg)."</p>\n";
	$message .= "</div>\n";

	add_action('admin_notices', create_function( '', "echo '$message';" ) );
	
	//twitany_debug_test_output();
}

// Add the 'Settings' link to the plugin page
function twitany_plugin_actions($links) {
	$links[] = "<a href='options-general.php?page=twitany_admin'><b>Settings</b></a>";
	return $links;
}


?>