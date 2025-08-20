<?php
/**
 * Plugin Name: Ababil Elementor Widgets
 * Description: Custom Elementor widgets for styled text, content boxes, ACF repeater accordions, breadcrumbs, and more.
 * Version: 1.0.3
 * Author: Khan Iftekher Ahmed
 * Author URI: https://about.me/iftekherahmed/
 * Text Domain: ababil
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 5.0 (minimum WP version)
 * Tested up to: 6.6 (latest WP version)
 * Requires PHP: 7.4
 */

defined( 'ABSPATH' ) || exit;

// Register custom widget category
add_action( 'elementor/elements/categories_registered', 'add_ababil_widget_category' );
function add_ababil_widget_category( $elements_manager ) {
    $elements_manager->add_category(
        'ababil',
        [
            'title' => __( 'Ababil Widgets', 'ababil' ),
            'icon'  => 'eicon-font',
        ]
    );
}

// Register the widgets
add_action( 'elementor/widgets/register', 'ababil_register_widgets' );
function ababil_register_widgets( $widgets_manager ) {
    require_once( __DIR__ . '/widgets/styled-text.php' );
    $widgets_manager->register( new \Ababil_Styled_Text_Widget() );

    require_once( __DIR__ . '/widgets/content-box.php' );
    $widgets_manager->register( new \Ababil_Content_Box_Widget() );
    
    require_once( __DIR__ . '/widgets/acf-repeater-accordion.php' );
    $widgets_manager->register( new \Ababil_ACF_Repeater_Accordion_Widget() );

    require_once( __DIR__ . '/widgets/breadcrumb.php' );
    $widgets_manager->register( new \Ababil_Breadcrumb_Widget() );

    require_once( __DIR__ . '/widgets/page-header.php' );
    $widgets_manager->register( new \Ababil_Page_Header_Widget() );
}

// Register assets (CSS)
add_action( 'elementor/frontend/after_register_styles', function() {
    wp_register_style(
        'ababil-styled-text',
        plugins_url( '/assets/css/styled-text.css', __FILE__ ),
        [],
        '1.0.0'
    );
    wp_register_style(
        'ababil-content-box',
        plugins_url( '/assets/css/content-box.css', __FILE__ ),
        [],
        '1.0.0'
    );
    wp_register_style(
        'ababil-acf-repeater-accordion',
        plugins_url( '/assets/css/acf-repeater-accordion.css', __FILE__ ),
        [],
        '1.0.0'
    );
    wp_register_style(
        'ababil-breadcrumb',
        plugins_url( '/assets/css/breadcrumb.css', __FILE__ ),
        [],
        '1.0.0'
    );
    wp_register_style(
        'ababil-page-header',
        plugins_url( '/assets/css/page-header.css', __FILE__ ),
        [],
        '1.0.0'
    );
} );

// Register assets (JS)
add_action( 'elementor/frontend/after_register_scripts', function() {
    wp_register_script(
        'ababil-styled-text',
        plugins_url( '/assets/js/styled-text.js', __FILE__ ),
        [ 'jquery' ],
        '1.0.0',
        true
    );
    wp_register_script(
        'ababil-content-box',
        plugins_url( '/assets/js/content-box.js', __FILE__ ),
        [ 'jquery' ],
        '1.0.0',
        true
    );
    wp_register_script(
        'ababil-acf-repeater-accordion',
        plugins_url( '/assets/js/acf-repeater-accordion.js', __FILE__ ),
        [ 'jquery' ],
        '1.0.0',
        true
    );
    wp_register_script(
        'ababil-breadcrumb',
        plugins_url( '/assets/js/breadcrumb.js', __FILE__ ),
        [ 'jquery' ],
        '1.0.0',
        true
    );
    wp_register_script(
        'ababil-page-header',
        plugins_url( '/assets/js/page-header.js', __FILE__ ),
        [ 'jquery' ],
        '1.0.0',
        true
    );
} );