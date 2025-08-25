<!-- page-header.php -->
<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Ababil Page Header Widget for Elementor
 */
class Ababil_Page_Header_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ababil-page-header';
    }

    public function get_title() {
        return __( 'Page Header', 'ababil' );
    }

    public function get_icon() {
        return 'eicon-header';
    }

    public function get_categories() {
        return [ 'ababil' ];
    }

    public function get_keywords() {
        return [ 'header', 'page header', 'hero', 'breadcrumb', 'title', 'ababil' ];
    }

    public function get_style_depends() {
        // Add Elementor's core preview style for reliability
        return [ 'ababil-page-header', 'elementor-frontend' ];
    }

    public function get_script_depends() {
        return [ 'ababil-page-header' ];
    }

    /**
     * Register widget controls
     */
    protected function register_controls() {
        // Content Tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Image Source
        $this->add_control(
            'image_source',
            [
                'label' => __( 'Image Source', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'featured' => __( 'Featured Image', 'ababil' ),
                    'custom' => __( 'Custom Image', 'ababil' ),
                ],
                'default' => 'featured',
            ]
        );

        // Custom Image
        $this->add_control(
            'custom_image',
            [
                'label' => __( 'Custom Image', 'ababil' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'image_source' => 'custom',
                ],
            ]
        );

        // Default Image
        $this->add_control(
            'default_image',
            [
                'label' => __( 'Default Fallback Image', 'ababil' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Image Position Controls
        $this->add_control(
            'image_position_heading',
            [
                'label' => __( 'Image Position', 'ababil' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_position',
            [
                'label' => __( 'Position', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'top left' => __( 'Top Left', 'ababil' ),
                    'top center' => __( 'Top Center', 'ababil' ),
                    'top right' => __( 'Top Right', 'ababil' ),
                    'center left' => __( 'Center Left', 'ababil' ),
                    'center center' => __( 'Center Center', 'ababil' ),
                    'center right' => __( 'Center Right', 'ababil' ),
                    'bottom left' => __( 'Bottom Left', 'ababil' ),
                    'bottom center' => __( 'Bottom Center', 'ababil' ),
                    'bottom right' => __( 'Bottom Right', 'ababil' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header' => 'background-position: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label' => __( 'Size', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'auto' => __( 'Auto', 'ababil' ),
                    'cover' => __( 'Cover', 'ababil' ),
                    'contain' => __( 'Contain', 'ababil' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header' => 'background-size: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'image_repeat',
            [
                'label' => __( 'Repeat', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'no-repeat',
                'options' => [
                    'no-repeat' => __( 'No Repeat', 'ababil' ),
                    'repeat' => __( 'Repeat', 'ababil' ),
                    'repeat-x' => __( 'Repeat X', 'ababil' ),
                    'repeat-y' => __( 'Repeat Y', 'ababil' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header' => 'background-repeat: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'image_attachment',
            [
                'label' => __( 'Attachment', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'scroll',
                'options' => [
                    'scroll' => __( 'Scroll', 'ababil' ),
                    'fixed' => __( 'Fixed', 'ababil' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header' => 'background-attachment: {{VALUE}};',
                ],
            ]
        );

        // NEW: Content Order Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'content_type',
            [
                'label' => __( 'Content Type', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'breadcrumb' => __( 'Breadcrumb', 'ababil' ),
                    'title' => __( 'Title', 'ababil' ),
                    'description' => __( 'Description', 'ababil' ),
                    'divider' => __( 'Divider', 'ababil' ),
                ],
                'default' => 'title',
            ]
        );        

        // Title Source
        $repeater->add_control(
            'title_source',
            [
                'label' => __( 'Title Source', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'default' => __( 'Default Page Title', 'ababil' ),
                    'custom' => __( 'Custom Text', 'ababil' ),
                    'dynamic' => __( 'Dynamic Tag', 'ababil' ),
                ],
                'default' => 'default',
                'condition' => [
                    'content_type' => 'title',
                ],
            ]
        );

        // Custom Title
        $repeater->add_control(
            'custom_title',
            [
                'label' => __( 'Custom Title', 'ababil' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'condition' => [
                    'content_type' => 'title',
                    'title_source' => 'custom',
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        // Dynamic Tag
        $repeater->add_control(
            'dynamic_tag',
            [
                'label' => __( 'Dynamic Tag', 'ababil' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'description' => __( 'Enter dynamic tags (ACF, shortcodes, etc.) e.g., [acf_field], {{post_title}}', 'ababil' ),
                'condition' => [
                    'content_type' => 'title',
                    'title_source' => 'dynamic',
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        // Title HTML Tag
        $repeater->add_control(
            'title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h1',
                'condition' => [
                    'content_type' => 'title',
                ],
            ]
        );

        // Description Type
        $repeater->add_control(
            'description_type',
            [
                'label' => __( 'Description Source', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'excerpt' => __( 'Page Excerpt', 'ababil' ),
                    'custom' => __( 'Custom Text', 'ababil' ),
                ],
                'default' => 'excerpt',
                'condition' => [
                    'content_type' => 'description',
                ],
            ]
        );

        // Excerpt Fallback Text
        $repeater->add_control(
            'excerpt_fallback',
            [
                'label' => __( 'Excerpt Fallback Text', 'ababil' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'No excerpt available', 'ababil' ),
                'condition' => [
                    'content_type' => 'description',
                    'description_type' => 'excerpt',
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        // Custom Description
        $repeater->add_control(
            'custom_description',
            [
                'label' => __( 'Custom Description', 'ababil' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'condition' => [
                    'content_type' => 'description',
                    'description_type' => 'custom',
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        // Breadcrumb Separator Type
        $repeater->add_control(
            'breadcrumb_separator_type',
            [
                'label' => __( 'Breadcrumb Separator', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'text' => __( 'Text', 'ababil' ),
                    'icon' => __( 'Icon', 'ababil' ),
                ],
                'default' => 'text',
                'condition' => [
                    'content_type' => 'breadcrumb',
                ],
            ]
        );

        // Breadcrumb Separator Text
        $repeater->add_control(
            'breadcrumb_separator_text',
            [
                'label' => __( 'Separator Text', 'ababil' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '/',
                'condition' => [
                    'content_type' => 'breadcrumb',
                    'breadcrumb_separator_type' => 'text',
                ],
            ]
        );

        // Breadcrumb Separator Icon
        $repeater->add_control(
            'breadcrumb_separator_icon',
            [
                'label' => __( 'Separator Icon', 'ababil' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'content_type' => 'breadcrumb',
                    'breadcrumb_separator_type' => 'icon',
                ],
            ]
        );

        // NEW: Divider Type
        $repeater->add_control(
            'divider_type',
            [
                'label' => __( 'Divider Type', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'line' => __( 'Line', 'ababil' ),
                    'icon' => __( 'Icon', 'ababil' ),
                    'image' => __( 'Image', 'ababil' ),
                    'text' => __( 'Text', 'ababil' ),
                ],
                'default' => 'line',
                'condition' => [
                    'content_type' => 'divider',
                ],
            ]
        );

        // NEW: Divider Line Options
        $repeater->add_control(
            'divider_line_color',
            [
                'label' => __( 'Line Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider-line' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'content_type' => 'divider',
                    'divider_type' => 'line',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'divider_line_height',
            [
                'label' => __( 'Line Height', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'size' => 2,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider-line' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'content_type' => 'divider',
                    'divider_type' => 'line',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'divider_line_width',
            [
                'label' => __( 'Line Width', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider-line' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'content_type' => 'divider',
                    'divider_type' => 'line',
                ],
            ]
        );

        // NEW: Divider Icon Options
        $repeater->add_control(
            'divider_icon',
            [
                'label' => __( 'Icon', 'ababil' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'content_type' => 'divider',
                    'divider_type' => 'icon',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'divider_icon_size',
            [
                'label' => __( 'Icon Size', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 24,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ababil-page-header-divider-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'content_type' => 'divider',
                    'divider_type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'divider_icon_color',
            [
                'label' => __( 'Icon Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ababil-page-header-divider-icon svg' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'content_type' => 'divider',
                    'divider_type' => 'icon',
                ],
            ]
        );

        // NEW: Divider Image Options
        $repeater->add_control(
            'divider_image',
            [
                'label' => __( 'Image', 'ababil' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'content_type' => 'divider',
                    'divider_type' => 'image',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'divider_image_width',
            [
                'label' => __( 'Image Width', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 100,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'content_type' => 'divider',
                    'divider_type' => 'image',
                ],
            ]
        );

        // NEW: Divider Text Options
        $repeater->add_control(
            'divider_text',
            [
                'label' => __( 'Text', 'ababil' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '* * *', 'ababil' ),
                'condition' => [
                    'content_type' => 'divider',
                    'divider_type' => 'text',
                ],
            ]
        );

        $repeater->add_control(
            'divider_text_color',
            [
                'label' => __( 'Text Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider-text' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'content_type' => 'divider',
                    'divider_type' => 'text',
                ],
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'divider_text_typography',
                'selector' => '{{WRAPPER}} .ababil-page-header-divider-text',
                'condition' => [
                    'content_type' => 'divider',
                    'divider_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'content_order',
            [
                'label' => __( 'Content Order', 'ababil' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'content_type' => 'breadcrumb',
                    ],
                    [
                        'content_type' => 'title',
                        'title_source' => 'default',
                    ],
                    [
                        'content_type' => 'divider',
                        'divider_type' => 'line',
                        'divider_line_color' => '#ffffff',
                        'divider_line_height' => [
                            'size' => 2,
                            'unit' => 'px',
                        ],
                        'divider_line_width' => [
                            'size' => 60,
                            'unit' => 'px',
                        ],
                    ],
                    [
                        'content_type' => 'description',
                    ],
                ],
                'title_field' => '{{{ content_type.charAt(0).toUpperCase() + content_type.slice(1) }}}',
            ]
        );

        $this->add_control(
            'content_width_heading',
            [
                'label' => __( 'Content Width', 'ababil' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'content_max_width',
            [
                'label' => __( 'Content Max Width', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-content-inner' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_horizontal_alignment',
            [
                'label' => __( 'Horizontal Alignment', 'ababil' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', 'ababil' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'ababil' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'ababil' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-content' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        // NEW: Visibility Conditions
        $this->add_control(
            'visibility_heading',
            [
                'label' => __( 'Visibility Conditions', 'ababil' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_on_post_types',
            [
                'label' => __( 'Show On Post Types', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_post_types(),
                'multiple' => true,
                'label_block' => true,
                'description' => __( 'Show this widget on specific post types. Leave empty to show on all.', 'ababil' ),
            ]
        );

        $this->add_control(
            'hide_on_post_types',
            [
                'label' => __( 'Hide On Post Types', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_post_types(),
                'multiple' => true,
                'label_block' => true,
                'description' => __( 'Hide this widget on specific post types.', 'ababil' ),
            ]
        );

        $this->add_control(
            'show_on_pages',
            [
                'label' => __( 'Show On Specific Pages', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_pages_list(),
                'multiple' => true,
                'label_block' => true,
                'description' => __( 'Show this widget on specific pages. Leave empty to show on all.', 'ababil' ),
            ]
        );

        $this->add_control(
            'hide_on_pages',
            [
                'label' => __( 'Hide On Specific Pages', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_pages_list(),
                'multiple' => true,
                'label_block' => true,
                'description' => __( 'Hide this widget on specific pages.', 'ababil' ),
            ]
        );

        $this->add_control(
            'show_on_front_page',
            [
                'label' => __( 'Show on Front Page', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'ababil' ),
                'label_off' => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_on_blog_page',
            [
                'label' => __( 'Show on Blog Page', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'ababil' ),
                'label_off' => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_on_archive_pages',
            [
                'label' => __( 'Show on Archive Pages', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'ababil' ),
                'label_off' => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_on_search_page',
            [
                'label' => __( 'Show on Search Page', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'ababil' ),
                'label_off' => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_on_404_page',
            [
                'label' => __( 'Show on 404 Page', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'ababil' ),
                'label_off' => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Style Tab: Header
        $this->start_controls_section(
            'header_style_section',
            [
                'label' => __( 'Header', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Background Overlay
        $this->add_control(
            'overlay_heading',
            [
                'label' => __( 'Background Overlay', 'ababil' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => __( 'Overlay Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-overlay' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'overlay_opacity',
            [
                'label' => __( 'Overlay Opacity', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0.5,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-overlay' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        // Header Height - Modified range and default
        $this->add_responsive_control(
            'header_height',
            [
                'label' => __( 'Height', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 400,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Header Padding
        $this->add_responsive_control(
            'header_padding',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Header Margin
        $this->add_responsive_control(
            'header_margin',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Content Alignment
        $this->add_responsive_control(
            'content_alignment',
            [
                'label' => __( 'Content Alignment', 'ababil' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'ababil' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'ababil' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'ababil' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Content Vertical Alignment
        $this->add_responsive_control(
            'content_vertical_alignment',
            [
                'label' => __( 'Vertical Alignment', 'ababil' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Top', 'ababil' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __( 'Middle', 'ababil' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => __( 'Bottom', 'ababil' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header' => 'display: flex; flex-direction: column;',
                    '{{WRAPPER}} .ababil-page-header-content' => 'flex: 1; display: flex; flex-direction: column; justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab: Title
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => __( 'Title', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .ababil-page-header-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab: Description
        $this->start_controls_section(
            'description_style_section',
            [
                'label' => __( 'Description', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Text Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .ababil-page-header-description',
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Spacing', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab: Breadcrumb
        $this->start_controls_section(
            'breadcrumb_style_section',
            [
                'label' => __( 'Breadcrumb', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // NEW: Breadcrumb Container Alignment
        $this->add_responsive_control(
            'breadcrumb_container_alignment',
            [
                'label' => __( 'Breadcrumb Alignment', 'ababil' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', 'ababil' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'ababil' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'ababil' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-breadcrumb' => 'display: flex; justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'breadcrumb_color',
            [
                'label' => __( 'Text Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-breadcrumb' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'breadcrumb_link_color',
            [
                'label' => __( 'Link Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-breadcrumb a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'breadcrumb_link_hover_color',
            [
                'label' => __( 'Link Hover Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-breadcrumb a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'breadcrumb_typography',
                'selector' => '{{WRAPPER}} .ababil-page-header-breadcrumb',
            ]
        );

        $this->add_responsive_control(
            'breadcrumb_margin',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-breadcrumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // NEW: Style Tab: Divider (General)
        $this->start_controls_section(
            'divider_general_style_section',
            [
                'label' => __( 'Divider', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'divider_alignment',
            [
                'label' => __( 'Alignment', 'ababil' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', 'ababil' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'ababil' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'ababil' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider' => 'display: flex; justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_margin',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'divider_padding',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'divider_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ababil-page-header-divider > div',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'divider_border',
                'selector' => '{{WRAPPER}} .ababil-page-header-divider > div',
            ]
        );

        $this->add_responsive_control(
            'divider_border_radius',
            [
                'label' => __( 'Border Radius', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'divider_box_shadow',
                'selector' => '{{WRAPPER}} .ababil-page-header-divider > div',
            ]
        );

        $this->add_responsive_control(
            'divider_rotate',
            [
                'label' => __( 'Rotate', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'deg' ],
                'range' => [
                    'deg' => [
                        'min' => -360,
                        'max' => 360,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider > div' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->end_controls_section();

        // NEW: Style Tab: Divider Hover
        $this->start_controls_section(
            'divider_hover_style_section',
            [
                'label' => __( 'Divider Hover', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'divider_hover_color',
            [
                'label' => __( 'Hover Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider > div:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ababil-page-header-divider > div:hover svg' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .ababil-page-header-divider-line:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'divider_hover_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ababil-page-header-divider > div:hover',
            ]
        );

        $this->add_control(
            'divider_hover_border_color',
            [
                'label' => __( 'Border Hover Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider > div:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_hover_rotate',
            [
                'label' => __( 'Hover Rotate', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'deg' ],
                'range' => [
                    'deg' => [
                        'min' => -360,
                        'max' => 360,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider > div:hover' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'divider_hover_box_shadow',
                'selector' => '{{WRAPPER}} .ababil-page-header-divider > div:hover',
            ]
        );

        $this->add_control(
            'divider_hover_transition',
            [
                'label' => __( 'Transition Duration', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 's', 'ms' ],
                'range' => [
                    's' => [
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                    'ms' => [
                        'min' => 0,
                        'max' => 3000,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 0.3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-page-header-divider > div' => 'transition: all {{SIZE}}{{UNIT}} ease;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Get available post types
     */
    private function get_post_types() {
        $post_types = get_post_types([
            'public' => true,
        ], 'objects');

        $options = [];
        foreach ($post_types as $post_type) {
            $options[$post_type->name] = $post_type->label;
        }

        return $options;
    }

    /**
     * Get pages list for select control
     */
    private function get_pages_list() {
        $pages = get_pages();
        $options = [];

        if (!empty($pages)) {
            foreach ($pages as $page) {
                $options[$page->ID] = $page->post_title;
            }
        }

        return $options;
    }

    /**
     * Check if widget should be visible based on conditions
     */
    private function is_widget_visible() {
        $settings = $this->get_settings_for_display();

        // Check post type conditions
        $current_post_type = get_post_type();
        
        // Hide on specific post types
        if (!empty($settings['hide_on_post_types']) && in_array($current_post_type, $settings['hide_on_post_types'])) {
            return false;
        }
        
        // Show only on specific post types
        if (!empty($settings['show_on_post_types']) && !in_array($current_post_type, $settings['show_on_post_types'])) {
            return false;
        }

        // Check page conditions
        $current_page_id = get_the_ID();
        
        // Hide on specific pages
        if (!empty($settings['hide_on_pages']) && in_array($current_page_id, $settings['hide_on_pages'])) {
            return false;
        }
        
        // Show only on specific pages
        if (!empty($settings['show_on_pages']) && !in_array($current_page_id, $settings['show_on_pages'])) {
            return false;
        }

        // Check special page conditions
        if (is_front_page() && $settings['show_on_front_page'] !== 'yes') {
            return false;
        }

        if (is_home() && $settings['show_on_blog_page'] !== 'yes') {
            return false;
        }

        if (is_archive() && $settings['show_on_archive_pages'] !== 'yes') {
            return false;
        }

        if (is_search() && $settings['show_on_search_page'] !== 'yes') {
            return false;
        }

        if (is_404() && $settings['show_on_404_page'] !== 'yes') {
            return false;
        }

        return true;
    }

    
    /**
     * Get the header image URL based on settings
     */
    private function get_header_image() {
        $settings = $this->get_settings_for_display();
        $image_url = '';
        
        // Try to get featured image first if selected and we're on a singular page
        if ($settings['image_source'] === 'featured' && is_singular() && has_post_thumbnail()) {
            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
        } 
        
        // If custom image is selected or no featured image found
        if (empty($image_url)) {
            if ($settings['image_source'] === 'custom' && !empty($settings['custom_image']['url'])) {
                $image_url = $settings['custom_image']['url'];
            } elseif (!empty($settings['default_image']['url'])) {
                $image_url = $settings['default_image']['url'];
            } else {
                // Fallback to placeholder
                $image_url = \Elementor\Utils::get_placeholder_image_src();
            }
        }
        
        return $image_url;
    }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        // Check visibility conditions
        if (!$this->is_widget_visible()) {
            return;
        }

        $settings = $this->get_settings_for_display();
        $image_url = $this->get_header_image();
        
        $this->add_render_attribute('header', 'class', 'ababil-page-header');
        $this->add_render_attribute('content', 'class', 'ababil-page-header-content');
        $this->add_render_attribute('content_inner', 'class', 'ababil-page-header-content-inner');
        $this->add_render_attribute('overlay', 'class', 'ababil-page-header-overlay');
        
        if ($image_url) {
            $background_style = sprintf(
                'background-image: url(%s);',
                esc_url($image_url)
            );
            $this->add_render_attribute('header', 'style', $background_style);
        }

        ?>
        
        <div <?php echo $this->get_render_attribute_string('header'); ?>>
            <div <?php echo $this->get_render_attribute_string('overlay'); ?>></div>
            
            <div <?php echo $this->get_render_attribute_string('content'); ?>>
                <div <?php echo $this->get_render_attribute_string('content_inner'); ?>>
                    <?php 
                    if (!empty($settings['content_order'])) {
                        foreach ($settings['content_order'] as $index => $item) {
                            switch ($item['content_type']) {
                                case 'breadcrumb':
                                    $this->render_breadcrumb($item);
                                    break;
                                    
                                case 'title':
                                    $this->render_title($item);
                                    break;
                                    
                                case 'description':
                                    $this->render_description($item);
                                    break;
                                    
                                case 'divider':
                                    $this->render_divider($item);
                                    break;
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <?php
    }

    /**
     * Render breadcrumb navigation
     */
    private function render_breadcrumb($settings = []) {
        $defaults = [
            'breadcrumb_separator_type' => 'text',
            'breadcrumb_separator_text' => '/',
        ];
        
        $settings = wp_parse_args($settings, $defaults);
        
        echo '<div class="ababil-page-header-breadcrumb">';
        echo '<div class="ababil-page-header-breadcrumb-inner">';
        
        // Standalone breadcrumb implementation
        echo '<span class="ababil-breadcrumb-item"><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'ababil') . '</a></span>';
        
        if (is_category() || is_single() || is_page()) {
            // Render separator
            echo '<span class="ababil-breadcrumb-separator">';
            if ($settings['breadcrumb_separator_type'] === 'icon' && !empty($settings['breadcrumb_separator_icon']['value'])) {
                \Elementor\Icons_Manager::render_icon($settings['breadcrumb_separator_icon'], ['aria-hidden' => 'true']);
            } else {
                echo esc_html($settings['breadcrumb_separator_text'] ?: '/');
            }
            echo '</span>';
            
            if (is_category()) {
                echo '<span class="ababil-breadcrumb-item">' . single_cat_title('', false) . '</span>';
            } elseif (is_single() || is_page()) {
                echo '<span class="ababil-breadcrumb-item">' . get_the_title() . '</span>';
            }
        } elseif (is_search()) {
            echo '<span class="ababil-breadcrumb-separator">';
            if ($settings['breadcrumb_separator_type'] === 'icon' && !empty($settings['breadcrumb_separator_icon']['value'])) {
                \Elementor\Icons_Manager::render_icon($settings['breadcrumb_separator_icon'], ['aria-hidden' => 'true']);
            } else {
                echo esc_html($settings['breadcrumb_separator_text'] ?: '/');
            }
            echo '</span>';
            echo '<span class="ababil-breadcrumb-item">' . esc_html__('Search Results', 'ababil') . '</span>';
        } elseif (is_archive()) {
            echo '<span class="ababil-breadcrumb-separator">';
            if ($settings['breadcrumb_separator_type'] === 'icon' && !empty($settings['breadcrumb_separator_icon']['value'])) {
                \Elementor\Icons_Manager::render_icon($settings['breadcrumb_separator_icon'], ['aria-hidden' => 'true']);
            } else {
                echo esc_html($settings['breadcrumb_separator_text'] ?: '/');
            }
            echo '</span>';
            echo '<span class="ababil-breadcrumb-item">' . get_the_archive_title() . '</span>';
        }
        
        echo '</div>';
        echo '</div>';
    }

    /**
     * Render title
     */
    private function render_title($settings = []) {
        $defaults = [
            'title_source' => 'default',
            'custom_title' => '',
            'dynamic_tag' => '',
            'title_html_tag' => 'h1',
        ];
        
        $settings = wp_parse_args($settings, $defaults);
        $title_tag = \Elementor\Utils::validate_html_tag($settings['title_html_tag']);
        $title_content = '';
        
        // Determine title content based on source
        switch ($settings['title_source']) {
            case 'custom':
                $title_content = $settings['custom_title'];
                // If custom title is empty, fall back to default
                if (empty($title_content)) {
                    $title_content = $this->get_default_title();
                }
                break;
                
            case 'dynamic':
                $title_content = $settings['dynamic_tag'];
                // Process shortcodes and dynamic tags
                $title_content = do_shortcode($title_content);
                // If dynamic content is empty, fall back to default
                if (empty($title_content)) {
                    $title_content = $this->get_default_title();
                }
                break;
                
            case 'default':
            default:
                $title_content = $this->get_default_title();
                break;
        }
        
        // Output the title only if we have content
        if (!empty($title_content)) {
            echo '<' . $title_tag . ' class="ababil-page-header-title">';
            echo wp_kses_post($title_content);
            echo '</' . $title_tag . '>';
        }
    }

    /**
     * Get default title based on context
     */
    private function get_default_title() {
        if (is_singular()) {
            return get_the_title();
        } else if (is_archive()) {
            return get_the_archive_title();
        } else if (is_search()) {
            return sprintf(esc_html__('Search Results for: %s', 'ababil'), get_search_query());
        } else if (is_404()) {
            return esc_html__('Page Not Found', 'ababil');
        } else {
            return get_bloginfo('name');
        }
    }

    /**
     * Render description
     */
    private function render_description($settings = []) {
        $defaults = [
            'description_type' => 'excerpt',
            'excerpt_fallback' => __( 'No excerpt available', 'ababil' ),
            'custom_description' => '',
        ];
        
        $settings = wp_parse_args($settings, $defaults);
        $description = '';
        
        if ($settings['description_type'] === 'excerpt') {
            $description = $this->get_page_excerpt($settings['excerpt_fallback']);
        } elseif ($settings['description_type'] === 'custom') {
            $description = $settings['custom_description'];
            // If custom description is empty, fall back to excerpt
            if (empty($description)) {
                $description = $this->get_page_excerpt($settings['excerpt_fallback']);
            }
        }
        
        if (!empty($description)) {
            echo '<div class="ababil-page-header-description">';
            echo wp_kses_post($description);
            echo '</div>';
        }
    }

    /**
     * Get page excerpt with fallback
     */
    private function get_page_excerpt($fallback = '') {
        if (is_singular()) {
            $excerpt = get_the_excerpt();
            if (!empty($excerpt)) {
                return $excerpt;
            }
        }
        
        // Return fallback text if no excerpt found
        return !empty($fallback) ? $fallback : '';
    }

    /**
     * Render divider based on settings
     */
    private function render_divider($settings = []) {
        $defaults = [
            'divider_type' => 'line',
        ];
        
        $settings = wp_parse_args($settings, $defaults);
        
        echo '<div class="ababil-page-header-divider">';
        
        switch ($settings['divider_type']) {
            case 'line':
                echo '<div class="ababil-page-header-divider-line"></div>';
                break;
                
            case 'icon':
                if (!empty($settings['divider_icon']['value'])) {
                    echo '<div class="ababil-page-header-divider-icon">';
                    \Elementor\Icons_Manager::render_icon($settings['divider_icon'], ['aria-hidden' => 'true']);
                    echo '</div>';
                }
                break;
                
            case 'image':
                if (!empty($settings['divider_image']['url'])) {
                    echo '<div class="ababil-page-header-divider-image">';
                    echo '<img src="' . esc_url($settings['divider_image']['url']) . '" alt="">';
                    echo '</div>';
                }
                break;
                
            case 'text':
                if (!empty($settings['divider_text'])) {
                    echo '<div class="ababil-page-header-divider-text">';
                    echo esc_html($settings['divider_text']);
                    echo '</div>';
                }
                break;
        }
        
        echo '</div>';
    }

    /**
     * Render widget output in the editor (JS template)
     */
    protected function content_template() {
        ?>
        <#
        var image_url = '';
        if (settings.image_source === 'custom' && settings.custom_image && settings.custom_image.url) {
            image_url = settings.custom_image.url;
        } else if (settings.default_image && settings.default_image.url) {
            image_url = settings.default_image.url;
        } else {
            image_url = '<?php echo \Elementor\Utils::get_placeholder_image_src(); ?>';
        }

        var background_style = '';
        var image_position = settings.image_position || 'center center';
        if (image_url) {
            background_style = 'background-image: url(' + image_url + '); background-position: ' + image_position + ';';
        }
        #>
        
        <div class="ababil-page-header" style="{{ background_style }} min-height: {{ settings.header_height.size }}{{ settings.header_height.unit }};">
            <div class="ababil-page-header-overlay"></div>
            <div class="ababil-page-header-content" style="text-align: {{ settings.content_alignment }}; padding: {{ settings.header_padding.top }}{{ settings.header_padding.unit }} {{ settings.header_padding.right }}{{ settings.header_padding.unit }} {{ settings.header_padding.bottom }}{{ settings.header_padding.unit }} {{ settings.header_padding.left }}{{ settings.header_padding.unit }}; align-items: {{ settings.content_horizontal_alignment }};">
                <div class="ababil-page-header-content-inner" style="max-width: {{ settings.content_max_width.size }}{{ settings.content_max_width.unit }};">
                    <# if (settings.content_order && settings.content_order.length) { #>
                        <# _.each(settings.content_order, function(item, index) { #>
                            <# switch(item.content_type) { 
                                case 'breadcrumb': #>
                                    <div class="ababil-page-header-breadcrumb" style="margin: {{ settings.breadcrumb_margin.top }}{{ settings.breadcrumb_margin.unit }} {{ settings.breadcrumb_margin.right }}{{ settings.breadcrumb_margin.unit }} {{ settings.breadcrumb_margin.bottom }}{{ settings.breadcrumb_margin.unit }} {{ settings.breadcrumb_margin.left }}{{ settings.breadcrumb_margin.unit }}; justify-content: {{ settings.breadcrumb_container_alignment }};">
                                        <div class="ababil-page-header-breadcrumb-inner">
                                            <span class="ababil-breadcrumb-item"><a href="#" style="color: {{ settings.breadcrumb_link_color }};"><?php echo esc_html__('Home', 'ababil'); ?></a></span>
                                            <span class="ababil-breadcrumb-separator">
                                                <# if (item.breadcrumb_separator_type === 'icon' && item.breadcrumb_separator_icon.value) { #>
                                                    <# var separatorIconHTML = elementor.helpers.renderIcon(view, item.breadcrumb_separator_icon, { 'aria-hidden': true }, 'i', 'object'); #>
                                                    {{{ separatorIconHTML.value }}}
                                                <# } else { #>
                                                    {{ item.breadcrumb_separator_text || '/' }}
                                                <# } #>
                                            </span>
                                            <span class="ababil-breadcrumb-item" style="color: {{ settings.breadcrumb_color }};"><?php echo esc_html__('Current Page', 'ababil'); ?></span>
                                        </div>
                                    </div>
                                    <# break;
                                    
                                case 'title': #>
                                    <# var title_tag = elementor.helpers.validateHTMLTag(item.title_html_tag) || 'h1'; #>
                                    <# var title_content = ''; #>
                                    <# if (item.title_source === 'custom' && item.custom_title) { #>
                                        <# title_content = item.custom_title; #>
                                    <# } else if (item.title_source === 'dynamic' && item.dynamic_tag) { #>
                                        <# title_content = item.dynamic_tag; #>
                                    <# } else { #>
                                        <# title_content = '<?php echo esc_html__('Page Title', 'ababil'); ?>'; #>
                                    <# } #>
                                    
                                    <# if (title_content) { #>
                                        <{{ title_tag }} class="ababil-page-header-title" style="color: {{ settings.title_color }}; margin: {{ settings.title_margin.top }}{{ settings.title_margin.unit }} {{ settings.title_margin.right }}{{ settings.title_margin.unit }} {{ settings.title_margin.bottom }}{{ settings.title_margin.unit }} {{ settings.title_margin.left }}{{ settings.title_margin.unit }};">
                                            {{{ title_content }}}
                                        </{{ title_tag }}>
                                    <# } #>
                                    <# break;
                                    
                                case 'description': #>
                                    <div class="ababil-page-header-description" style="color: {{ settings.description_color }}; margin-bottom: {{ settings.description_spacing.size }}{{ settings.description_spacing.unit }};">
                                        <# if (item.description_type === 'custom' && item.custom_description) { #>
                                            {{{ item.custom_description }}}
                                        <# } else { #>
                                            <?php echo esc_html__('This is a sample page description that would be dynamically pulled from the page content.', 'ababil'); ?>
                                        <# } #>
                                    </div>
                                    <# break;
                                    
                                case 'divider': #>
                                    <div class="ababil-page-header-divider" style="margin: {{ settings.divider_margin.top }}{{ settings.divider_margin.unit }} {{ settings.divider_margin.right }}{{ settings.divider_margin.unit }} {{ settings.divider_margin.bottom }}{{ settings.divider_margin.unit }} {{ settings.divider_margin.left }}{{ settings.divider_margin.unit }}; justify-content: {{ settings.divider_alignment }};">
                                        <# switch(item.divider_type) {
                                            case 'line': #>
                                                <div class="ababil-page-header-divider-line" style="background-color: {{ item.divider_line_color }}; height: {{ item.divider_line_height.size }}{{ item.divider_line_height.unit }}; width: {{ item.divider_line_width.size }}{{ item.divider_line_width.unit }};"></div>
                                                <# break;
                                                
                                            case 'icon': #>
                                                <# if (item.divider_icon && item.divider_icon.value) { #>
                                                    <div class="ababil-page-header-divider-icon" style="color: {{ item.divider_icon_color }};">
                                                        <# var dividerIconHTML = elementor.helpers.renderIcon(view, item.divider_icon, { 'aria-hidden': true }, 'i', 'object'); #>
                                                        {{{ dividerIconHTML.value }}}
                                                    </div>
                                                <# } #>
                                                <# break;
                                                
                                            case 'image': #>
                                                <# if (item.divider_image && item.divider_image.url) { #>
                                                    <div class="ababil-page-header-divider-image">
                                                        <img src="{{ item.divider_image.url }}" alt="" style="width: {{ item.divider_image_width.size }}{{ item.divider_image_width.unit }};">
                                                    </div>
                                                <# } #>
                                                <# break;
                                                
                                            case 'text': #>
                                                <# if (item.divider_text) { #>
                                                    <div class="ababil-page-header-divider-text" style="color: {{ item.divider_text_color }};">
                                                        {{{ item.divider_text }}}
                                                    </div>
                                                <# } #>
                                                <# break;
                                        } #>
                                    </div>
                                    <# break;
                            } #>
                        <# }); #>
                    <# } #>
                </div>
            </div>
        </div>
        <?php
    }
}