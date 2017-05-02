<?php
/*
Plugin Name: Expander
Version: 1.0.0
Description: Minimalistic accordion plugin. Text expander plugin. Just like popcorn. Click and pop.
Author: ThemeIsle
Author URI: http://themeisle.com
*/

/*
 * Usage: [wpex class="wpex-link" more="Read more" less="Read less"]hidden text[/wpex]
 */

// define('WPEX_PLUGIN_URL', WP_PLUGIN_URL . '/' . dirname(plugin_basename(__FILE__)));
// define('WPEX_PLUGIN_PATH', WP_PLUGIN_DIR . '/' . dirname(plugin_basename(__FILE__)));
include dirname( __FILE__ )  . '/includes/tinymce-button.php';

function wpex_register_shortcodes() {
	add_shortcode('wpex', 'wpex_main');
}

function wpex_main($atts, $content = null) {
	extract(shortcode_atts(array(
		'more' => 'Read more',
		'less' => 'Read less',
        'class' => 'wpex-link',
	), $atts));

	mt_srand((double)microtime() * 1000000);
	$rnum = mt_rand();

	$new_string = '<a onclick="wpex_toggle(' . $rnum . ', \'' . addslashes($more) . '\', \'' . addslashes($less) . '\'); return false;" class="' . addslashes($class) . '" id="wpexlink' . $rnum . '" href="#">' . addslashes($more) . '</a><div class="wpex_div" id="wpex' . $rnum . '" style="display: none;">' . do_shortcode($content) . '</div>';

	return $new_string;
}

function wpex_javascript() {
    echo '<script>function expand(e){e.style.display="none"==e.style.display?"block":"none"}function wpex_toggle(e,n,l){el=document.getElementById("wpexlink"+e),el.innerHTML=el.innerHTML==n?l:n,expand(document.getElementById("wpex"+e))}</script>';
}

add_action('wp_footer', 'wpex_javascript');
add_action('init', 'wpex_register_shortcodes');
add_filter('widget_text', 'do_shortcode', 10);
?>
