<?php
/**
 * Ferus Core Theme Customizer
 *
 * @package Ferus_Core
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ferus_core_customize_register($wp_customize)
{
    // Remove Sections
    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('header_image');
    $wp_customize->remove_section('background_image');
    //$wp_customize->remove_section('custom_css');

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    /* START: Theme Header Layout */
    // Add section
    $wp_customize->add_section( 'custom_header_layout', array(
        'title' => __( 'Header Layout' ),
        'description' => __( 'Change the layout of the header' ),
        //'panel' => '', // Not typically needed.
        'priority' => 10,
        'capability' => 'edit_theme_options',
        //'theme_supports' => '', // Rarely needed.
    ) );
    // add setting
    $wp_customize->add_setting('theme_header_layout', array(
        'default' => 'default',
    ) );
    // Add a controler
    $wp_customize->add_control('theme_header_layout',
        array(
        'label' => 'Header Layout',
        'section' => 'custom_header_layout',
        'settings' => 'theme_header_layout',
        'type' => 'radio',
        'choices'  => array(
            'default' => 'Default',
            'center'  => 'Logo Center',
            'bar'  => 'Logo + Bar Menu',
        ),
    ) );
    /* END: Theme Header Layout */
    /* START: Theme Asset Manager */
    // Add section
    $wp_customize->add_section( 'custom_asset_manager', array(
        'title' => __( 'Theme Assets' ),
        'description' => __( 'Choose which scripts and styles get loaded in.' ),
        'priority' => 11,
        'capability' => 'edit_theme_options',
    ) );
    // add settings
    $wp_customize->add_setting( 'theme_asset_lightbox', array('default' => 1,) );
    $wp_customize->add_setting( 'theme_asset_masonry', array('default' => 1,) );
    // Add a controlers
    $wp_customize->add_control('theme_asset_lightbox',
        array(
        'label' => 'Lightbox',
        'section' => 'custom_asset_manager',
        'settings' => 'theme_asset_lightbox',
        'type' => 'checkbox',
    ) );
    $wp_customize->add_control('theme_asset_masonry',
        array(
        'label' => 'Masonry (Script & Gallery)',
        'section' => 'custom_asset_manager',
        'settings' => 'theme_asset_masonry',
        'type' => 'checkbox',
        'std' => '1',
    ) );
    /* END: Theme Asset Manager */
}

add_action('customize_register', 'ferus_core_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ferus_core_customize_preview_js()
{
    wp_enqueue_script('ferus_core_customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20151215', true);
}

add_action('customize_preview_init', 'ferus_core_customize_preview_js');
