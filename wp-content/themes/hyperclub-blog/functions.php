<?php
/**
 * hyperclub-blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hyperclub-blog
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.11');
}


function hyperclub_blog_setup()
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	register_nav_menus(
		array(

			'header-nav' => esc_html__('header-nav', 'hyperclub-blog'),
			'footer-1' => esc_html__('footer-nav', 'hyperclub-blog'),
			
			'language-switcher' => esc_html__('language-switcher', 'hyperclub-blog'),
		)
	);
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

}
add_action('after_setup_theme', 'hyperclub_blog_setup');

/**
 * Enqueue scripts and styles.
 */
function hyperclub_blog_scripts()
{
	wp_enqueue_style('hyperclub-blog-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_style('hyperclub-blog-main', get_template_directory_uri() . '/dist/main.css', array(), _S_VERSION);


	wp_enqueue_script("jquery");
	wp_enqueue_script('hyperclub-blog-main-js', get_template_directory_uri() . '/dist/main.js', array(), _S_VERSION);
	

}
add_action('wp_enqueue_scripts', 'hyperclub_blog_scripts');

// Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

	global $wp_version;
	if ($wp_version !== '4.7.1') {
		return $data;
	}

	$filetype = wp_check_filetype($filename, $mimes);

	return [
		'ext' => $filetype['ext'],
		'type' => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];

}, 10, 4);

function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
	echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
}
add_action('admin_head', 'fix_svg');

// Function for counting post views
function set_post_views($post_id) {
    $count_key = 'post_views';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}

// Count views when loading a post
function track_post_views($post_id) {
    if (!is_single()) return;
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    set_post_views($post_id);
}
add_action('wp_head', 'track_post_views');

// Function for counting post likes
function set_post_likes($post_id) {
    $count_key = 'post_likes';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}






