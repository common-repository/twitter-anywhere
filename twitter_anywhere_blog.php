<?php
/*
Part of the Twitter @Anywhere Plugin
*/

function twitany_include_js() {
	global $twitany_admin_options;
	
	if (!twitany_check()) return '';
	
	$appid = $twitany_admin_options['appid'];

	// Make sure jQuery is always loaded
	wp_enqueue_script("jquery");
	// include the anywhere script from Twitter
	wp_enqueue_script('twitter-anywhere', 'http://platform.twitter.com/anywhere.js?id='.$appid.'&v=1');	
}

function twitany_head() {
	echo twitany_generate_output();
}

?>