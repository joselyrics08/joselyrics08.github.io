<?php

/**
 * Customizer Ads Section
 *
 * @param  mixed $wp_customize
 * @return void
 */
function customizer_ads_section($wp_customize)
{
	$ads = array(
		'ad_header' => array('title' => 'Ad Header', 'type' => 'textarea'),
		'ad_top' => array('title' => 'Ad Top', 'type' => 'textarea'),
		'ad_post_top' => array('title' => 'Ad Post Top', 'type' => 'textarea'),
		'ad_post_inarticle' => array('title' => 'Ad InArticle', 'type' => 'textarea'),
		'inarticle_paragraph' => array('title' => 'InArticle Paragraph', 'type' => 'text'),
		'ad_post_bottom' => array('title' => 'Ad Post Bottom', 'type' => 'textarea'),
		'ad_bottom' => array('title' => 'Ad Bottom', 'type' => 'textarea'),
		'ad_sidebar' => array('title' => 'Ad Sidebar', 'type' => 'textarea')
	);

	$wp_customize->add_section('ads_section', array(
		'title' => __('Ads Section', 'ewpl'),
		'description' => __('Puedes agregar anuncios en esta sección', 'ewpl'),
	));

	$wp_customize->add_setting('show_ads', array(
		'capability' => 'edit_theme_options',
		'default' => false,
	));

	$wp_customize->add_control('show_ads', array(
		'type' => 'checkbox',
		'section' => 'ads_section',
		'label' => __('Show Ads'),
	));

	foreach ($ads as $index => $ad) {
		$wp_customize->add_setting($index, array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
		));

		$wp_customize->add_control($index, array(
			'id' => $index,
			'type' => $ad['type'],
			'section' => 'ads_section',
			'label' => __($ad['title'], 'ewpl'),
		));
	}
}
add_action('customize_register', 'customizer_ads_section');


/**
 * Customizer Analytics Section
 *
 * @param  mixed $wp_customize
 * @return void
 */
function customizer_analytics_section($wp_customize)
{

	$wp_customize->add_section('analytics_section', array(
		'title' => __('Analytics Section', 'ewpl'),
		'description' => __('Puedes agregar anuncios en esta sección', 'ewpl'),
	));

	$wp_customize->add_setting('show_analytics', array(
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control('show_analytics', array(
		'id' => 'show_analytics',
		'type' => 'textarea',
		'section' => 'analytics_section',
		'label' => __('Analytics', 'ewpl'),
	));
}
add_action('customize_register', 'customizer_analytics_section');


function customizer_theme_settings_section($wp_customize)
{

	$wp_customize->add_section('theme_settings_section', array(
		'title' => __('Theme Settings Section', 'ewpl'),
		'description' => __('Puedes modificar aspectos del tema en esta sección', 'ewpl'),
	));

	$wp_customize->add_setting('show_nextbutton', array(
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control('show_nextbutton', array(
		'id' => 'show_nextbutton',
		'type' => 'checkbox',
		'section' => 'theme_settings_section',
		'label' => __('Show Next Button'),
		'std'        => '1'
	));
}
add_action('customize_register', 'customizer_theme_settings_section');