<?php
/**
 * Plugin Name: Ababil Elementor Addons
 * Description: Custom Elementor widgets for Ababil
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL-2.0+
 */

if (!defined('ABSPATH')) {
    exit;
}

function ababil_elementor_addons() {
    // Load plugin file
    require_once plugin_dir_path(__FILE__) . 'widgets/slider.php';

    // Register widget
    add_action('elementor/widgets/register', function($widgets_manager) {
        $widgets_manager->register(new \Ababil_Slider_Widget());
    });

    // Register scripts and styles
    add_action('wp_enqueue_scripts', function() {
        wp_enqueue_style(
            'ababil-slider',
            plugin_dir_url(__FILE__) . 'assets/css/slider.css',
            [],
            '1.0.0'
        );

        wp_enqueue_script(
            'ababil-slider',
            plugin_dir_url(__FILE__) . 'assets/js/slider.js',
            ['jquery'],
            '1.0.0',
            true
        );
    });

    // Enqueue scripts and styles for Elementor editor
    add_action('elementor/frontend/after_enqueue_styles', function() {
        wp_enqueue_style(
            'ababil-slider',
            plugin_dir_url(__FILE__) . 'assets/css/slider.css',
            [],
            '1.0.0'
        );
    });

    add_action('elementor/frontend/after_register_scripts', function() {
        wp_enqueue_script(
            'ababil-slider',
            plugin_dir_url(__FILE__) . 'assets/js/slider.js',
            ['jquery'],
            '1.0.0',
            true
        );
    });
}

add_action('plugins_loaded', 'ababil_elementor_addons');
?>