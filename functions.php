<?php

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
require get_parent_theme_file_path('/inc/init-functions.php');

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path('/inc/template-functions.php');

/**
 * Helpers.
 */
require get_parent_theme_file_path('/inc/helpers.php');

/**
 * Customizer additions.
 */
require get_parent_theme_file_path('/inc/customizer.php');

/**
 * License Functions
 */
/*require get_parent_theme_file_path('/inc/license-functions.php');
if ( is_admin() ) {
    $license_manager = new Wp_License_Manager_Client(
        'earnifywp-lite',
        'Earnify WP Theme',
        'ewpl',
        'https://license-manager.earnify.me/api'
    );
}*/

/**
 * Widgets
 */
require get_parent_theme_file_path('/inc/widgets/latest-posts.php');

