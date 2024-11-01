<?php
/*
Part of the Twitter @Anywhere Plugin
*/

global $followbuttoncount, $tweetboxcount;

//shorten URL with bit.ly
function twitany_bitly_shorten_url($url, $login="themergency", $apikey="R_41856f5e2ccbf6fef3a56992b246642f") {
	$encoded = urlencode($url);
	
	if(!class_exists('WP_Http'))
		include_once(ABSPATH . WPINC . '/class-http.php');
	$request = new WP_Http;
	$request_url = "http://api.bit.ly/v3/shorten?login={$login}&apiKey={$apikey}&uri={$encoded}&format=txt";
	$result = $request->request($request_url);
	if (gettype($result) == "object" && get_class($result) == "WP_Error")
		return $url;
			
	$shorturl = trim($result["body"]);
	if (strpos($shorturl,'http://') === false)
		return $url;
	else
		return $shorturl;
}

function twitany_generate_tweetbox_text($text) {
	//check if we must do anything
	if (strpos($text, "%title%") === false && strpos($text, "%url%") === false)
		return $text;
	
	//get title and url
	global $wp_query;
	if ($wp_query->in_the_loop || is_singular()) {
		global $post;
		$title = $post->post_title;
		$url = twitany_bitly_shorten_url(get_permalink($post_id));
	} else {
		$title = get_bloginfo("title");
		$url = twitany_bitly_shorten_url(get_bloginfo("home"));
	}
	
	//build replacement array
	$arr = array(
		"%title%" => $title,
		"%url%" => $url
	);
	
	//do replacement
	return str_replace(array_keys($arr), array_values($arr), $text);
}

//outputs the js script used in the head
function twitany_generate_output() {
	global $twitany_admin_options;
	
	if (!twitany_check()) return '';
	
	$linkifyselector = $twitany_admin_options['linkifyselector'];
	if (strlen($linkifyselector) > 0) { 
		$obj = 'T("'.$linkifyselector.'").';
	} else {
		$obj = 'T.';
	}
	
	if ($twitany_admin_options['selected'] == 'linkify') {
		$func = 'linkifyUsers(';

		$class = $twitany_admin_options['linkifycss'];
		if (strlen($class) > 0) { 
			$options = '{ className: "'.$class.'" }';
		} else {
			$options = '';
		}		
		
	} else {
		$func = 'hovercards(';
	}
	
	return '<script type="text/javascript">
	twttr.anywhere(function(T) {
		'.$obj.$func.$options.');
	});
</script>';
}

//outputs the html needed for the follow buttons
function twitany_generate_followbutton($username = null) {
	global $followbuttoncount;
	$followbuttoncount = (isset($followbuttoncount) ? $followbuttoncount+1 : 0);
	
	//generate an id for the folow button
	$id = "follow-{$username}-{$followbuttoncount}";
	
	if (isset($username)) {
		return "<span id=\"{$id}\"></span>
  <script type=\"text/javascript\">
    twttr.anywhere(function (T) {
      T(\"#{$id}\").followButton(\"{$username}\");
    });
  </script>";
	}
}

//outputs the html needed for the tweetboxes
function twitany_generate_tweetbox($counter, $width, $height, $label, $defaultContent) {
	global $tweetboxcount;
	$tweetboxcount = (isset($tweetboxcount) ? $tweetboxcount+1 : 0);
	
	//generate an id for the tweetbox
	$id = "tweetbox-{$tweetboxcount}";
	
	$tweet = twitany_generate_tweetbox_text($defaultContent);

	return "<div id=\"{$id}\"></div>
  <script type=\"text/javascript\">
    twttr.anywhere(function (T) {
      T(\"#{$id}\").tweetBox({
		counter: {$counter},
		height: {$height},
		width: {$width},
		label: \"{$label}\",
		defaultContent: \"{$tweet}\"
	  });
    });
  </script>";
}



?>