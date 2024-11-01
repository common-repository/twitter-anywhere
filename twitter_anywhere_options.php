<?php
/*
Part of the Twitter @Anywhere Plugin
*/

global $twitany_admin_options;

//add a checkbox to the form
function generate_checkbox($chk, $desc) {
	global $twitany_admin_options;
	$checked = ($twitany_admin_options[$chk] == 1) ? 'checked="checked"' : '' ;
	$desc_trans = __($desc, 'twitany');
	echo <<<CHK
<input type="hidden" value="0" name="twitany_$chk" /><label><input type="checkbox" id="twitany_check_$chk" $checked name="twitany_$chk" value="1"> $desc_trans</label>
CHK;
}

//add a radio button to the form
function generate_radio($rad, $value, $desc) {
	global $twitany_admin_options;
	$selected = ($twitany_admin_options[$rad] == $value) ? 'checked="checked"' : '' ;
	$desc_trans = __($desc, 'twitany');
	echo <<<CHK
<label><input type="radio" id="twitany_radio_$rad" $selected name="twitany_$rad" value="$value"> $desc_trans</label>
CHK;
}

?>

<div class="wrap">
	<div class="icon32" id="icon-options-general"><br/></div><h2><?php _e( 'Twitter @Anywhere Options', 'twitany' ); ?></h2>
	<?php _e("Add the Twitter @Anywhere functionality to your wordpress blog. Read more info here : ", "twitany") ?><a href="http://dev.twitter.com/anywhere/begin" target="_blank">http://dev.twitter.com/anywhere/begin</a>
    <form method="post" action="">
		<?php wp_nonce_field('twitany-options'); ?>
		
		<input type="hidden" name="twitany_options" value="1"/>
		<input type="hidden" name="action" value="update">
		
		<h3><?php _e( 'General Settings', 'twitany' ); ?></h3>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?php _e('API key', 'twitany' ); ?></th>
					<td>
						<input type="text" name="twitany_appid" value="<?php echo $twitany_admin_options['appid']; ?>" size="35" /><br/>
						<?php _e("You need to have a registered client application with Twitter to get started.", "twitany" ); ?><br />
						<?php _e("Twitter recommends creating a new application for @Anywhere.", "twitany" ); ?><br />
						<a href="http://dev.twitter.com/anywhere/apps/new" target="_blank"><?php _e("Create a new @Anywhere application &raquo", "twitany" ); ?></a>
					</td>
				</tr>
				<tr>
					<th rowspan="3" scope="row"><?php _e('Enable Features', 'twitany' ); ?></th>
					<td>
						<?php generate_radio('selected', 'disabled', 'Disabled (default)'); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php generate_radio('selected', 'linkify', 'Enable auto-linkification in your blog'); ?><br />
						<?php _e('This will attempt to auto-link Twitter screen names on the page. A Twitter screen name starts with an "@" symbol.', 'twitany' ); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php generate_radio('selected', 'hovercards', 'Enable Hovercards in your blog'); ?><br />
						<?php _e('A hovercard is a small context-aware tooltip that provides single-click access to data about a particular Twitter user.', 'twitany' ); ?><br />
						<?php _e('Hovercards also allow the visitor to take action on a Twitter user e.g. follow, unfollow, retweet etc.', 'twitany' ); ?>
					</td>
				</tr>
					
			</tbody>
		</table>
		<h3><?php _e( 'Linkify Overrides', 'twitany' ); ?></h3>
		<table class="form-table">
			<tbody>		
				<tr>
					<th scope="row"><?php _e('Override Linkify Selector', 'twitany' ); ?></th>
					<td>
						<input type="text" name="twitany_linkifyselector" value="<?php echo $twitany_admin_options['linkifyselector']; ?>" size="35" /><br/>
						<?php _e("By default the whole page is linkified. If you only want to linkify a certain area, you can specify a CSS selector.", "twitany" ); ?><br />
						<?php _e("Twitter @Anywhere uses <a href=\"http://wiki.github.com/jeresig/sizzle/\">Sizzle</a> for selectors. Refer to the <a href=\"http://wiki.github.com/jeresig/sizzle/\">Sizzle documentation</a> for more information.", "twitany" ); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Override CSS class', 'twitany' ); ?></th>
					<td>
						<input type="text" name="twitany_linkifycss" value="<?php echo $twitany_admin_options['linkifycss']; ?>" size="35" /><br/>
						<?php _e("You can specify an alternate CSS class for the links that are generated.", "twitany" ); ?><br />
						<?php _e("***This does not apply to Hovercards***", "twitany" ); ?>
					</td>
				</tr>
			</tbody>
		</table>

	
		<p class="submit">
		<input name="submit" class="button-primary" value="<?php echo _e('Save Changes', 'twitany');?>" type="submit" />
		</p>		
		
	</form>
	
	<form method="post" action="">
		<?php wp_nonce_field('twitany-options'); ?>
		<input type="hidden" name="twitany_options" value="1"/>
		<input type="hidden" name="action" value="reset">
		<p class="submit" style="border-top:0px;padding:0;"><input style="color:red" name="submit" value="<?php _e('Reset Settings', 'twitany');?>" onclick="return(confirm('<?php echo js_escape(__('Are you sure? There is no undo!', 'twitany'));?>'))" type="submit" /></p>
	</form><br /><br />
<?php
	
	$script = twitany_generate_output();
	
	if (strlen($script) > 0) { ?>
	<h3><?php _e( 'Preview of the output script', 'twitany' ); ?></h3>
	<textarea style="width:700px; height:120px"><?php echo $script; ?></textarea>
	<br /><br />
	<?php } ?>
	<h3><?php _e( 'Follow Button Shortcodes', 'twitany' ); ?></h3>
	<?php _e("Use a shortcode to add a follow button to your posts. The shortcode looks like this:", "twitany" ); ?><br /><br />
	<code>[followbutton username="twitter"]</code><br /><br />
	<style>
		.attr-table { border:solid 1px #ddd; border-collapse:collapse; }
		.attr-table tr th { font-wieght:bold; text-align:left; background:#ddd; padding:3px 10px 3px 3px; }
		.attr-table tr td { border:solid 1px #ddd; text-align:left; padding:3px; }
	</style>
	<table class="attr-table" cellpadding="0" cellspacing="0">
		<tr style="text-align:left; background:#ddd">
			<th>Option</th>
			<th>Description</th>
			<th>Default</th>
			<th>Example</th>
		</tr>
		<tr>
			<td>username</td>
			<td>The Twitter username</td>
			<td>twitter</td>
			<td>bradvin</td>
		</tr>
	</table>
	<br /><br />
	<h3><?php _e( 'Tweet Box Shortcodes', 'twitany' ); ?></h3>
	<?php _e("Use a shortcode to add a tweetbox to your posts. The shortcode looks like this:", "twitany" ); ?><br /><br />
	<code>[tweetbox counter="true" width="200" height="100" label="TWEET HERE!" default="BLAH BLAH"]</code><br /><br />
	<table class="attr-table" cellpadding="0" cellspacing="0">
		<tr style="text-align:left; background:#ddd">
			<th>Option</th>
			<th>Description</th>
			<th>Default</th>
			<th>Example</th>
		</tr>
		<tr>
			<td>counter</td>
			<td>Display a counter in the Tweet Box for counting characters</td>
			<td>true</td>
			<td>false</td>
		</tr>
		<tr>
			<td>height</td>
			<td>The height of the Tweet Box in pixels</td>
			<td>515</td>
			<td>200</td>
		</tr>
		<tr>
			<td>width</td>
			<td>The width of the Tweet Box in pixels</td>
			<td>65</td>
			<td>200</td>
		</tr>
		<tr>
			<td>label</td>
			<td>The text above the Tweet Box, a call to action.</td>
			<td>"What's happening?"</td>
			<td>false</td>
		</tr>
		<tr>
			<td>default</td>
			<td>Pre-populated text in the Tweet Box.<br>Useful for an @mention, a #hashtag, a link, etc.<br>
			Use %title% and %url% to insert the current post title and url.</td>
			<td><i>none</i></td>
			<td>Just read %title% - %url% (via @bradvin)</td>
		</tr>		
	</table>	
</div>	