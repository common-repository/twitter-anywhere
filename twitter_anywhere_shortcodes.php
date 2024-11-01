<?php
/*
Part of the Twitter @Anywhere Plugin
*/

//handles when a followbutton shortcode is used
function followbutton_handler($atts, $content = null) {
	
	//check if we have an API key
	if (!twitany_check()) return '';
	
	//extract shortcode attributes and set some defaults if needed
	extract( shortcode_atts( array(
		'username' => 'twitter',
		), $atts ) );
		
	//call the generate method that outputs the html needed for the followbutton
	return twitany_generate_followbutton( esc_attr($username) );
}

//handles when a tweetbox shortcode is used
function tweetbox_handler($atts, $content = null) {

	//check if we have an API key
	if (!twitany_check()) return '';
	
	//extract shortcode attributes and set some defaults if needed
	extract( shortcode_atts( array(
		'counter' => 'true',
		'width' => '515',
		'height' => '65',
		'label' => 'What\'s Happening?',
		'default' => 'tweet here',
		), $atts ) );
		
	//call the generate method that outputs the html needed for the tweetbox
	return twitany_generate_tweetbox( esc_attr($counter) , esc_attr($width) , esc_attr($height) , 
		esc_attr($label) , $default);
}

?>