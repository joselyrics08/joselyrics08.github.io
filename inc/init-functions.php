<?php

/**
 * EWPL Setup
 * 
 * Intial Setup
 *
 * @return void
 */
function ewpl_setup()
{

    load_theme_textdomain('ewpl');

    /**
     * Thumbnail Sizes
     */
    add_image_size('ewpl-featured-image', 768, 432, true);


    /**
     * Nav Menus
     */
    register_nav_menus(
        array(
            'top'    => __('Top Menu', 'ewpl'),
            'social' => __('Social Links Menu', 'ewpl'),
        )
    );

    /**
     * Theme Support
     */
    add_theme_support( 'title-tag' );
    add_theme_support('responsive-embeds');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'width'      => 175,
        'height'     => 55,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_filter('embed_oembed_html', 'responsive_embed', 10, 3);
}
add_action('after_setup_theme', 'ewpl_setup');


/**
 * EWPL Assets
 *
 * Add assets to the template
 * 
 * @return void
 */
function ewpl_assets()
{
    wp_enqueue_style('style', get_stylesheet_uri(), array(), '20201208');
    wp_enqueue_style('ewpl-style', get_template_directory_uri() . '/assets/css/app.css', array(), '20190105');
    wp_enqueue_script('ewpl-script', get_template_directory_uri() . '/assets/js/app.js', array(), '20190105');
}
add_action('wp_enqueue_scripts', 'ewpl_assets');


/**
 * EWPL WIDGETS
 *
 * Add custom widgets to the template
 * 
 * @return void
 */
function ewpl_widgets_init()
{
    register_sidebar(
        array(
            'name'          => __('Blog Sidebar', 'ewpl'),
            'id'            => 'sidebar-1',
            'description'   => __('Add widgets here to appear in your sidebar on blog posts and archive pages.', 'ewpl'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => __('404 Widget', 'ewpl'),
            'id'            => '404-1',
            'description'   => __('Add widgets here to appear 404 page.', 'ewpl'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'ewpl_widgets_init');


/**
 * Responsive embed
 *
 * @param  mixed $html
 * @param  mixed $url
 * @param  mixed $attr
 * @return void
 */
function responsive_embed($html, $url, $attr) {
    return $html!=='' ? '<div class="embed-container">'.$html.'</div>' : '';
}


function add_opengraph_doctype( $output ) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');


/**
 * Insert FB OG meta in head
 *
 * @return void
 */
function insert_fb_in_head() {
    global $post;
    if ( !is_singular()) //if it is not a post or a page
        return;
        //echo '<meta property="fb:app_id" content="Your Facebook App ID" />';
        echo '<meta property="og:title" content="' . get_the_title() . '"/>'."\n";
        echo '<meta property="og:type" content="article"/>'."\n";
        echo '<meta property="og:url" content="' . get_permalink() . '"/>'."\n";
        echo '<meta property="og:site_name" content="'.  get_bloginfo('name') . '"/>'."\n";
        echo '<meta property="og:description" content="'.  esc_attr(strip_tags( get_the_excerpt())) . '" />'."\n";
    if(!has_post_thumbnail( $post->ID )) {
        //$default_image="http://example.com/image.jpg";
        //echo '<meta property="og:image" content="' . $default_image . '"/>';
    }
    else{
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'ewpl-featured-image' );
        echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>'."\n";
    }
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );