<?php
/**
 * @package MediaElement.js Skin
 * @version 2.9.1
 */
 
/*
Plugin Name: MediaElement.js Skin
Plugin URI: http://www.onedesigns.com/freebies/custom-mediaelement-js-skin
Description: A custom skin for MediaElement.js created by Premium Pixels and coded by One Designs
Author: One Designs
Version: 1.0
Author URI: http://www.onedesigns.com/
License: GNU General Public License
*/

function mejskin_activate() {
	if( ! is_plugin_active( 'media-element-html5-video-and-audio-player/mediaelement-js-wp.php' ) ) {
		deactivate_plugins(__FILE__);
		die( 'Please install and activate <a href="http://wordpress.org/extend/plugins/media-element-html5-video-and-audio-player/">MediaElement.js - HTML5 Video & Audio Player Plugin</a> first to use this plugin.' );
	}
	update_option( 'mep_video_skin', 'mejskin' );
}

register_activation_hook( __FILE__, 'mejskin_activate' );

function mejskin_deactivate() {
	update_option( 'mep_video_skin', '' );
}

register_deactivation_hook( __FILE__, 'mejskin_deactivate' );

function mejskin_replace_options_page() {
	remove_submenu_page( 'options-general.php', 'media-element-html5-video-and-audio-player/mediaelement-js-wp.php' );
	add_options_page( 'MediaElement.js', 'MediaElement.js', 'administrator', __FILE__, 'mejskin_options_page' );
}

add_action( 'admin_menu', 'mejskin_replace_options_page', 11 );

function mejskin_register_settings() {
	register_setting( 'mep_settings', 'mep_video_skin' );
	register_setting( 'mep_settings', 'mep_script_on_demand' );
	register_setting( 'mep_settings', 'mep_default_video_height' );
	register_setting( 'mep_settings', 'mep_default_video_width' );
	register_setting( 'mep_settings', 'mep_default_video_type' );
	register_setting( 'mep_settings', 'mep_default_audio_height' );
	register_setting( 'mep_settings', 'mep_default_audio_width' );
	register_setting( 'mep_settings', 'mep_default_audio_type' );
}

add_action( 'admin_init', 'mejskin_register_settings' );

// Adapted from MediaElement.js - HTML5 Audio and Video http://mediaelementjs.com/
function mejskin_options_page() { ?>
	<div class="wrap">
	<h2>MediaElement.js HTML5 Player Options</h2>
	
	<p>See <a href="http://mediaelementjs.com/">MediaElementjs.com</a> for more details on how the HTML5 player and Flash fallbacks work.</p>
	
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>
	
		<h3 class="title"><span>General Settings</span></h3>
	
		<table  class="form-table">
			<tr valign="top">
				<th scope="row">
					<label for="mep_script_on_demand">Load Script on Demand (requires WP 3.3)</label>
				</th>
				<td >
					<input name="mep_script_on_demand" type="checkbox" id="mep_script_on_demand" <?php echo (get_option('mep_script_on_demand') == true ? "checked" : "")  ?> />
				</td>
			</tr>
		</table>
	
		<h3 class="title"><span>Video Settings</span></h3>
			
		<table  class="form-table">
			<tr valign="top">
				<th scope="row">
					<label for="mep_default_video_width">Default Width</label>
				</th>
				<td >
					<input name="mep_default_video_width" type="text" id="mep_default_video_width" value="<?php echo get_option('mep_default_video_width'); ?>" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="mep_default_video_height">Default Height</label>
				</th>
				<td >
					<input name="mep_default_video_height" type="text" id="mep_default_video_height" value="<?php echo get_option('mep_default_video_height'); ?>" />
				</td>
			</tr>	
			<tr valign="top">
				<th scope="row">
					<label for="mep_default_video_type">Default Type</label>
				</th>
				<td >
					<input name="mep_default_video_type" type="text" id="mep_default_video_type" value="<?php echo get_option('mep_default_video_type'); ?>" /> <span class="description">such as "video/mp4"</span>
				</td>
			</tr>	
			<tr valign="top">
				<th scope="row">
					<label for="mep_video_skin">Video Skin</label>
				</th>
				<td >
					<select name="mep_video_skin" id="mep_video_skin">
						<option value="" <?php echo (get_option('mep_video_skin') == '') ? ' selected' : ''; ?>>Default</option>
						<option value="wmp" <?php echo (get_option('mep_video_skin') == 'wmp') ? ' selected' : ''; ?>>WMP</option>
						<option value="ted" <?php echo (get_option('mep_video_skin') == 'ted') ? ' selected' : ''; ?>>TED</option>
						<option value="mejskin" <?php echo (get_option('mep_video_skin') == 'mejskin') ? ' selected' : ''; ?>>Custom</option>
					</select>
				</td>
			</tr>				
		</table>
	
		<h3 class="title"><span>Audio Settings</span></h3>
		
	
		<table  class="form-table">
			<tr valign="top">
			<tr valign="top">
				<th scope="row">
					<label for="mep_default_audio_width">Default Width</label>
				</th>
				<td >
					<input name="mep_default_audio_width" type="text" id="mep_default_audio_width" value="<?php echo get_option('mep_default_audio_width'); ?>" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="mep_default_audio_height">Default Height</label>
				</th>
				<td >
					<input name="mep_default_audio_height" type="text" id="mep_default_audio_height" value="<?php echo get_option('mep_default_audio_height'); ?>" />
				</td>
			</tr>			
				<th scope="row">
					<label for="mep_default_audio_type">Default Type</label>
				</th>
				<td >
					<input name="mep_default_audio_type" type="text" id="mep_default_audio_type" value="<?php echo get_option('mep_default_audio_type'); ?>" /> <span class="description">such as "audio/mp3"</span>
				</td>
			</tr>			
		</table>
	
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="mep_default_video_width,mep_default_video_height,mep_default_video_type,mep_default_audio_type,mep_default_audio_width,mep_default_audio_height,mep_video_skin,mep_script_on_demand" />
	
		<p>
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	
	</div>
	
	
	
	</form>
	</div>
<?php
}

function mejskin_enqueue_styles() {
	wp_enqueue_style( 'mejskin', plugin_dir_url(__FILE__) . 'skin/mediaelementplayer.css', false, null );
}

add_action('wp_print_styles', 'mejskin_enqueue_styles', 11 );