<?php

/**
 * Gets unique ID.
 *
 * This is a PHP implementation of Underscore's uniqueId method. A static variable
 * contains an integer that is incremented with each call. This number is returned
 * with the optional prefix. As such the returned value is not universally unique,
 * but it is unique across the life of the PHP process.
 *
 * @since Earnifgy WP Lite 2.0
 *
 * @see wp_unique_id() Themes requiring WordPress 5.0.3 and greater should use this instead.
 *
 * @param string $prefix Prefix for the returned ID.
 * @return string Unique ID.
 */
function ewpl_unique_id($prefix = '')
{
	static $id_counter = 0;
	if (function_exists('wp_unique_id')) {
		return wp_unique_id($prefix);
	}
	return $prefix . (string) ++$id_counter;
}

/**
 * EWPL RESOLVE ADS
 *
 * Simple helper to call ads on content
 * 
 * @param  mixed $ad
 * @return void
 */
function ewpl_resolve_ads($ad)
{
	$ads = '';
	if (get_theme_mod('show_ads')) {
		$ads = '<div class="ewpl_ads">' . "\n";
		$ads .= get_theme_mod($ad) . "\n";;
		$ads .= '</div>' . "\n";
	}
	return $ads;
}
