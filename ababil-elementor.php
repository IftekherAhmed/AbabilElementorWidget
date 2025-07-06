<?php
/**
 * Plugin Name: Ababil Elementor Widgets
 * Description: Custom Elementor widgets by Khan Iftekher Ahmed
 * Version: 1.0.0
 * Author: Khan Iftekher Ahmed
 * Text Domain: ababil
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
    
    // Add the new ACF Repeater Accordion widget
    require_once( __DIR__ . '/widgets/acf-repeater-accordion.php' );
    $widgets_manager->register( new \Ababil_ACF_Repeater_Accordion_Widget() );
}

// Register assets (CSS)
add_action( 'elementor/frontend/after_register_styles', function() {
    wp_register_style(
        'ababil-styled-text',
        plugins_url( '/assets/css/frontend.css', __FILE__ ),
        [],
        '1.0.0'
    );
} );

// Register assets (JS)
add_action( 'elementor/frontend/after_register_scripts', function() {
    wp_register_script(
        'ababil-styled-text',
        plugins_url( '/assets/js/frontend.js', __FILE__ ),
        [ 'jquery' ],
        '1.0.0',
        true
    );
} );