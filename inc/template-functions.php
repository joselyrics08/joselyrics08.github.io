<?php

/**
 * Add `loading="lazy"` attribute to images output by the_post_thumbnail().
 *
 * @param  string $html	The post thumbnail HTML.
 * @param  int $post_id	The post ID.
 * @param  string $post_thumbnail_id	The post thumbnail ID.
 * @param  string|array $size	The post thumbnail size. Image size or array of width and height values (in that order). Default 'post-thumbnail'.
 * @param  string $attr	Query string of attributes.
 * 
 * @return string	The modified post thumbnail HTML.
 */
function wpdd_modify_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr)
{
	return str_replace('<img', '<img loading="lazy"', $html);
}
add_filter('post_thumbnail_html', 'wpdd_modify_post_thumbnail_html', 10, 5);


/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Earnifgy WP Lite 1.0
 *
 * @param string $template front-page.php.
 * @return string The template to be used: blank if is_home() is true (defaults to index.php),
 *                otherwise $template.
 */
function ewpl_front_page_template($template)
{
	return is_home() ? '' : $template;
}
add_filter('frontpage_template', 'ewpl_front_page_template');


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function ewpl_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'ewpl_pingback_header');


/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Earnifgy WP Lite 1.0
 */
function ewpl_javascript_detection()
{
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action('wp_head', 'ewpl_javascript_detection', 0);

/**
 * Add preconnect for Google Fonts.
 *
 * @since Earnifgy WP Lite 1.0
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function ewpl_resource_hints($urls, $relation_type)
{
	if (wp_style_is('ewpl-fonts', 'queue') && 'preconnect' === $relation_type) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter('wp_resource_hints', 'ewpl_resource_hints', 10, 2);


/**
 * Insert Post Ads
 *
 * Insert InArticle Ad in N post-content paragraph
 * 
 * @param  mixed $content
 * @return void
 */
function insert_post_ads($content)
{
	$ad_code = ewpl_resolve_ads('ad_post_inarticle');
	$closing_p = '</p>';
	$paragraphs = explode($closing_p, $content);
	$par = get_theme_mod('inarticle_paragraph') ? intval(get_theme_mod('inarticle_paragraph')) : 1;

	foreach ($paragraphs as $index => $paragraph) {
		if (trim($paragraph)) {
			$paragraphs[$index] .= $closing_p;
		}
		if ($index + 1 == $par) {
			$paragraphs[$index] .= $ad_code;
		}
	}
	return implode('', $paragraphs);
}

add_filter('the_content', 'insert_post_ads');



/**
 * MIT Thumbnail Upscale
 *
 * If featured image is smaller than thumbnail, this solves the problem
 * 
 * @param  mixed $default
 * @param  mixed $orig_w
 * @param  mixed $orig_h
 * @param  mixed $new_w
 * @param  mixed $new_h
 * @param  mixed $crop
 * @return void
 */

function mit_thumbnail_upscale($default, $orig_w, $orig_h, $new_w, $new_h, $crop)
{
	if (!$crop) return null; // let the wordpress default function handle this

	$aspect_ratio = $orig_w / $orig_h;
	$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

	$crop_w = round($new_w / $size_ratio);
	$crop_h = round($new_h / $size_ratio);

	$s_x = floor(($orig_w - $crop_w) / 2);
	$s_y = floor(($orig_h - $crop_h) / 2);

	return array(0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h);
}
add_filter('image_resize_dimensions', 'mit_thumbnail_upscale', 10, 6);


/**
 * my_add_next_page_button
 *
 * @param  mixed $buttons
 * @param  mixed $id
 * @return void
 */
function my_add_next_page_button( $buttons, $id ){
	if ( 'content' != $id )
		return $buttons;
	array_splice( $buttons, 13, 0, 'wp_page' );
	return $buttons;
}
add_filter( 'mce_buttons', 'my_add_next_page_button', 1, 2 ); 

/**
 * Delete fullsize image
 * 
 * Delete original image and keeps thumbnail
 * 
 * @param  mixed $metadata
 * @return void
 */
// function delete_fullsize_image($metadata)
// {
// 	$upload_dir = wp_upload_dir();
// 	$full_image_path = trailingslashit($upload_dir['basedir']) . $metadata['file'];
// 	$deleted = unlink($full_image_path);

// 	return $metadata;
// }
// add_filter('wp_generate_attachment_metadata', 'delete_fullsize_image');
