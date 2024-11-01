=== Twitter @Anywhere ===
Contributors: bradvin
Donate link: http://www.google.com/profiles/bradvin
Tags: twitter
Requires at least: 2.9.2
Tested up to: 2.9.2
Stable tag: trunk

Add the Twitter @Anywhere functionality to your blog. Automatically linkify Twitter usernames, add hovercards, followbuttons and tweet boxes.

== Description ==

Add the Twitter @Anywhere functionality to your wordpress blog. Read more info about @Anywhere here : http://dev.twitter.com/anywhere/begin

The plugins supports the following @Anywhere features:

*   Either "Linkify" or "Hovercard" Twitter usernames in your blog.
*   Override the selector used to linkify
*   Override the CSS class name used for auto-linkification.
*   Ability to add a follow button with a shortcode.
*   Ability to add a tweet box with a shortcode. You can specify %title% and %url% as default content to automatically pre-populate the tweet box with your post information. If %url% is used, then Bit.ly is used to shorten the post's url.

PLEASE NOTE : You need to create a Twitter Application in order to use this plugin. Create an application at http://dev.twitter.com/anywhere/apps/new

== Installation ==

1. Create a Twitter Application if needed (http://dev.twitter.com/anywhere/apps/new)
2. Upload the plugin folder 'twitter-anywhere' to your `/wp-content/plugins/` folder
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Insert your Twitter Application API key in the settings and save changes

== Frequently Asked Questions ==

= Do I need a Twitter Application to use this plugin? =

YES! create one here : http://dev.twitter.com/anywhere/apps/new

= What dependancies does this plugin have (Other than a Twitter Application)? =

1. It depends on jQuery
2. Your theme requires a  call to wp_head() in order to insert the neccessary javascript

== Screenshots ==

1. What you get with Twitter @Anywhere
2. Options Page
3. Options Page - Shortcodes
4. Example tweetbox

== Changelog ==

= 0.1 =
* Initial Relase. First version with linkify, hovercards & follow buttons

= 0.2 =
* Added shortcodes for followbuttons and tweet boxes

== Upgrade Notice ==

You cannot upgrade yet as this is the first release!