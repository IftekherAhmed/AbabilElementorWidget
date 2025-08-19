<?php
/**
 * Plugin Name: Ababil Elementor Widgets
 * Description: Custom Elementor widgets for styled text, content boxes, ACF repeater accordions, breadcrumbs, and more.
 * Version: 1.0.0
 * Author: Khan Iftekher Ahmed
 * Author URI: https://about.me/iftekherahmed/
 * Text Domain: ababil
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 5.0
 * Tested up to: 6.3
 * Requires PHP: 7.4
 *
 * @package Ababil_Elementor_Widgets
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main Ababil Elementor Widgets Class
 * 
 * @since 1.0.0
 */
final class Ababil_Elementor_Widgets {

    /**
     * Instance
     * 
     * @since 1.0.0
     * @access private
     * @static
     * @var Ababil_Elementor_Widgets The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     * 
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     * @access public
     * @static
     * @return Ababil_Elementor_Widgets An instance of the class.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     * 
     * @since 1.0.0
     * @access public
     */
    public function __construct() {
        $this->define_constants();
        $this->init_hooks();
    }

    /**
     * Define Constants
     * 
     * @since 1.0.0
     * @access private
     */
    private function define_constants() {
        define( 'ABABIL_VERSION', '1.0.0' );
        define( 'ABABIL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
        define( 'ABABIL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    }

    /**
     * Initialize Hooks
     * 
     * @since 1.0.0
     * @access private
     */
    private function init_hooks() {
        // Check for Elementor
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    /**
     * Initialize the plugin
     * 
     * @since 1.0.0
     * @access public
     */
    public function init() {
        // Check if Elementor is installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_elementor' ] );
            return;
        }

        // Add Plugin actions
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_widget_category' ] );
        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
        add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_styles' ] );
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_scripts' ] );
    }

    /**
     * Admin notice for missing Elementor
     * 
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_missing_elementor() {
        $message = sprintf(
            esc_html__( 'Ababil Elementor Widgets requires %1$s to be installed and activated. %2$s', 'ababil' ),
            '<strong>Elementor</strong>',
            '<a href="' . esc_url( admin_url( 'plugin-install.php?s=Elementor&tab=search&type=term' ) ) . '">Install Elementor</a>'
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
    }

    // Define plugin constants
if ( ! defined( 'ABABIL_VERSION' ) ) {
    define( 'ABABIL_VERSION', '1.0.0' );
}
if ( ! defined( 'ABABIL_PLUGIN_DIR' ) ) {
    define( 'ABABIL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'ABABIL_PLUGIN_URL' ) ) {
    define( 'ABABIL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * Display admin notice for Elementor dependency
 */
function ababil_elementor_dependency_notice() {
    $message = sprintf(
        esc_html__( 'Ababil Elementor Widgets requires %1$s to be installed and activated. %2$s', 'ababil' ),
        '<strong>Elementor</strong>',
        '<a href="' . esc_url( admin_url( 'plugin-install.php?s=Elementor&tab=search&type=term' ) ) . '">Install Elementor</a>'
    );
    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
}

/**
 * Initialize the plugin
 */
function ababil_init() {
    if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', 'ababil_elementor_dependency_notice' );
        return;
    }
    
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
} );