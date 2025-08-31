<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Ababil Slider Widget for Elementor
 */
class Ababil_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ababil-slider';
    }

    public function get_title() {
        return __('Slider', 'ababil');
    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return ['ababil'];
    }

    public function get_keywords() {
        return ['slider', 'carousel', 'slides', 'banner', 'ababil'];
    }

    public function get_style_depends() {
        wp_register_style('ababil-slider', plugins_url('slider.css', __FILE__));
        return ['ababil-slider'];
    }

    public function get_script_depends() {
        wp_register_script('ababil-slider', plugins_url('slider.js', __FILE__), ['jquery'], '1.0.0', true);
        return ['jquery', 'ababil-slider'];
    }

    protected function register_controls() {
        // Content Tab: Slides
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Slides', 'ababil'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        // Background Image
        $repeater->add_control(
            'slide_image',
            [
                'label' => __('Background Image', 'ababil'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'background_position',
            [
                'label' => __('Background Position', 'ababil'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'top left' => __('Top Left', 'ababil'),
                    'top center' => __('Top Center', 'ababil'),
                    'top right' => __('Top Right', 'ababil'),
                    'center left' => __('Center Left', 'ababil'),
                    'center center' => __('Center Center', 'ababil'),
                    'center right' => __('Center Right', 'ababil'),
                    'bottom left' => __('Bottom Left', 'ababil'),
                    'bottom center' => __('Bottom Center', 'ababil'),
                    'bottom right' => __('Bottom Right', 'ababil'),
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .ababil-slide-background' => 'background-position: {{VALUE}} !important;',
                ],
            ]
        );

        $repeater->add_control(
            'background_size',
            [
                'label' => __('Background Size', 'ababil'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'auto' => __('Auto', 'ababil'),
                    'cover' => __('Cover', 'ababil'),
                    'contain' => __('Contain', 'ababil'),
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .ababil-slide-background' => 'background-size: {{VALUE}} !important;',
                ],
            ]
        );

        // Overlay Control
        $repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_overlay',
                'label' => __('Background Overlay', 'ababil'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .ababil-slide-overlay',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => 'rgba(0, 0, 0, 0.5)',
                    ],
                ],
            ]
        );

        // Slide Transition Effect
        $repeater->add_control(
            'slide_transition_effect',
            [
                'label' => __('Transition Effect', 'ababil'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slideup' => __('Slide Up', 'ababil'),
                    'slidedown' => __('Slide Down', 'ababil'),
                    'slideright' => __('Slide Right', 'ababil'),
                    'slideleft' => __('Slide Left', 'ababil'),
                    'slidehorizontal' => __('Slide Horizontal', 'ababil'),
                    'slidevertical' => __('Slide Vertical', 'ababil'),
                    'boxslide' => __('Box Slide', 'ababil'),
                    'slotslide-horizontal' => __('Slot Slide Horizontal', 'ababil'),
                    'slotslide-vertical' => __('Slot Slide Vertical', 'ababil'),
                    'boxfade' => __('Box Fade', 'ababil'),
                    'slotfade-horizontal' => __('Slot Fade Horizontal', 'ababil'),
                    'slotfade-vertical' => __('Slot Fade Vertical', 'ababil'),
                    'fadefromright' => __('Fade From Right', 'ababil'),
                    'fadefromleft' => __('Fade From Left', 'ababil'),
                    'fadefromtop' => __('Fade From Top', 'ababil'),
                    'fadefrombottom' => __('Fade From Bottom', 'ababil'),
                    'fadetoleftfadefromright' => __('Fade To Left, From Right', 'ababil'),
                    'fadetorightfadefromleft' => __('Fade To Right, From Left', 'ababil'),
                    'fadetotopfadefrombottom' => __('Fade To Top, From Bottom', 'ababil'),
                    'fadetobottomfadefromtop' => __('Fade To Bottom, From Top', 'ababil'),
                    'parallaxtoright' => __('Parallax To Right', 'ababil'),
                    'parallaxtoleft' => __('Parallax To Left', 'ababil'),
                    'parallaxtotop' => __('Parallax To Top', 'ababil'),
                    'parallaxtobottom' => __('Parallax To Bottom', 'ababil'),
                    'scaledownfromright' => __('Zoom Out From Right', 'ababil'),
                    'scaledownfromleft' => __('Zoom Out From Left', 'ababil'),
                    'scaledownfromtop' => __('Zoom Out From Top', 'ababil'),
                    'scaledownfrombottom' => __('Zoom Out From Bottom', 'ababil'),
                    'zoomout' => __('Zoom Out', 'ababil'),
                    'zoomin' => __('Zoom In', 'ababil'),
                    'slotzoom-horizontal' => __('Zoom Slots Horizontal', 'ababil'),
                    'slotzoom-vertical' => __('Zoom Slots Vertical', 'ababil'),
                    'fade' => __('Fade', 'ababil'),
                    'random-static' => __('Random Static', 'ababil'),
                    'random' => __('Random', 'ababil'),
                ],
            ]
        );

        // Heading Segments
        $heading_repeater = new \Elementor\Repeater();
        $heading_repeater->add_control(
            'heading_segment',
            [
                'label' => __('Heading Segment', 'ababil'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Heading Segment', 'ababil'),
                'label_block' => true,
            ]
        );

        $heading_repeater->add_control(
            'segment_color',
            [
                'label' => __('Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $heading_repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'segment_typography',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => [
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                        ],
                    ],
                    'font_weight' => [
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'font-weight: {{VALUE}} !important;',
                        ],
                    ],
                ],
            ]
        );

        $heading_repeater->add_control(
            'segment_animation',
            [
                'label' => __('Animation', 'ababil'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'fadeIn',
                'options' => [
                    'none' => __('None', 'ababil'),
                    'fadeIn' => __('Fade In', 'ababil'),
                    'slideInTop' => __('Slide In Top', 'ababil'),
                    'slideInBottom' => __('Slide In Bottom', 'ababil'),
                    'slideInLeft' => __('Slide In Left', 'ababil'),
                    'slideInRight' => __('Slide In Right', 'ababil'),
                    'zoomIn' => __('Zoom In', 'ababil'),
                    'bounceIn' => __('Bounce In', 'ababil'),
                    'flipInX' => __('Flip In X', 'ababil'),
                    'flipInY' => __('Flip In Y', 'ababil'),
                    'rotateIn' => __('Rotate In', 'ababil'),
                    'expand' => __('Expand', 'ababil'),
                    'pulse' => __('Pulse', 'ababil'),
                    'bounce' => __('Bounce', 'ababil'),
                    'shake' => __('Shake', 'ababil'),
                    'swing' => __('Swing', 'ababil'),
                    'wobble' => __('Wobble', 'ababil'),
                    'tada' => __('Tada', 'ababil'),
                    'typewriter' => __('Typewriter', 'ababil'),
                    'wordSlideIn' => __('Word Slide In', 'ababil'),
                    'letterFadeIn' => __('Letter Fade In', 'ababil'),
                    'wave' => __('Wave', 'ababil'),
                    'scramble' => __('Scramble', 'ababil'),
                    'staggeredFadeIn' => __('Staggered Fade In', 'ababil'),
                    'masonryLoad' => __('Masonry Load', 'ababil'),
                    'cascadeSlideIn' => __('Cascade Slide In', 'ababil'),
                    'hoverGrow' => __('Hover Grow', 'ababil'),
                    'hoverLift' => __('Hover Lift', 'ababil'),
                    'hoverRotate' => __('Hover Rotate', 'ababil'),
                    'ripple' => __('Ripple', 'ababil'),
                    'pressShrink' => __('Press Shrink', 'ababil'),
                ],
            ]
        );

        $heading_repeater->add_control(
            'segment_animation_duration',
            [
                'label' => __('Animation Duration (ms)', 'ababil'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1000,
                'min' => 0,
                'step' => 100,
            ]
        );

        $heading_repeater->add_control(
            'segment_animation_delay',
            [
                'label' => __('Animation Delay (ms)', 'ababil'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0,
                'min' => 0,
                'step' => 100,
            ]
        );

        $repeater->add_control(
            'heading_segments',
            [
                'label' => __('Heading Segments', 'ababil'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $heading_repeater->get_controls(),
                'default' => [
                    ['heading_segment' => __('Welcome to', 'ababil')],
                    ['heading_segment' => __('Our Slider', 'ababil')],
                ],
                'title_field' => '{{{ heading_segment }}}',
            ]
        );

        // Subheading
        $repeater->add_control(
            'subheading',
            [
                'label' => __('Subheading', 'ababil'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('This is a subheading', 'ababil'),
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'subheading_animation',
            [
                'label' => __('Subheading Animation', 'ababil'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'fadeIn',
                'options' => [
                    'none' => __('None', 'ababil'),
                    'fadeIn' => __('Fade In', 'ababil'),
                    'slideInTop' => __('Slide In Top', 'ababil'),
                    'slideInBottom' => __('Slide In Bottom', 'ababil'),
                    'slideInLeft' => __('Slide In Left', 'ababil'),
                    'slideInRight' => __('Slide In Right', 'ababil'),
                    'zoomIn' => __('Zoom In', 'ababil'),
                    'bounceIn' => __('Bounce In', 'ababil'),
                    'flipInX' => __('Flip In X', 'ababil'),
                    'flipInY' => __('Flip In Y', 'ababil'),
                    'rotateIn' => __('Rotate In', 'ababil'),
                    'expand' => __('Expand', 'ababil'),
                    'pulse' => __('Pulse', 'ababil'),
                    'bounce' => __('Bounce', 'ababil'),
                    'shake' => __('Shake', 'ababil'),
                    'swing' => __('Swing', 'ababil'),
                    'wobble' => __('Wobble', 'ababil'),
                    'tada' => __('Tada', 'ababil'),
                    'typewriter' => __('Typewriter', 'ababil'),
                    'wordSlideIn' => __('Word Slide In', 'ababil'),
                    'letterFadeIn' => __('Letter Fade In', 'ababil'),
                    'wave' => __('Wave', 'ababil'),
                    'scramble' => __('Scramble', 'ababil'),
                    'staggeredFadeIn' => __('Staggered Fade In', 'ababil'),
                    'masonryLoad' => __('Masonry Load', 'ababil'),
                    'cascadeSlideIn' => __('Cascade Slide In', 'ababil'),
                    'hoverGrow' => __('Hover Grow', 'ababil'),
                    'hoverLift' => __('Hover Lift', 'ababil'),
                    'hoverRotate' => __('Hover Rotate', 'ababil'),
                    'ripple' => __('Ripple', 'ababil'),
                    'pressShrink' => __('Press Shrink', 'ababil'),
                ],
            ]
        );

        $repeater->add_control(
            'subheading_animation_duration',
            [
                'label' => __('Animation Duration (ms)', 'ababil'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1000,
                'min' => 0,
                'step' => 100,
            ]
        );

        $repeater->add_control(
            'subheading_animation_delay',
            [
                'label' => __('Animation Delay (ms)', 'ababil'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 200,
                'min' => 0,
                'step' => 100,
            ]
        );

        // Description
        $repeater->add_control(
            'description',
            [
                'label' => __('Description', 'ababil'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('This is a slide description.', 'ababil'),
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'description_animation',
            [
                'label' => __('Description Animation', 'ababil'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'fadeIn',
                'options' => [
                    'none' => __('None', 'ababil'),
                    'fadeIn' => __('Fade In', 'ababil'),
                    'slideInTop' => __('Slide In Top', 'ababil'),
                    'slideInBottom' => __('Slide In Bottom', 'ababil'),
                    'slideInLeft' => __('Slide In Left', 'ababil'),
                    'slideInRight' => __('Slide In Right', 'ababil'),
                    'zoomIn' => __('Zoom In', 'ababil'),
                    'bounceIn' => __('Bounce In', 'ababil'),
                    'flipInX' => __('Flip In X', 'ababil'),
                    'flipInY' => __('Flip In Y', 'ababil'),
                    'rotateIn' => __('Rotate In', 'ababil'),
                    'expand' => __('Expand', 'ababil'),
                    'pulse' => __('Pulse', 'ababil'),
                    'bounce' => __('Bounce', 'ababil'),
                    'shake' => __('Shake', 'ababil'),
                    'swing' => __('Swing', 'ababil'),
                    'wobble' => __('Wobble', 'ababil'),
                    'tada' => __('Tada', 'ababil'),
                    'typewriter' => __('Typewriter', 'ababil'),
                    'wordSlideIn' => __('Word Slide In', 'ababil'),
                    'letterFadeIn' => __('Letter Fade In', 'ababil'),
                    'wave' => __('Wave', 'ababil'),
                    'scramble' => __('Scramble', 'ababil'),
                    'staggeredFadeIn' => __('Staggered Fade In', 'ababil'),
                    'masonryLoad' => __('Masonry Load', 'ababil'),
                    'cascadeSlideIn' => __('Cascade Slide In', 'ababil'),
                    'hoverGrow' => __('Hover Grow', 'ababil'),
                    'hoverLift' => __('Hover Lift', 'ababil'),
                    'hoverRotate' => __('Hover Rotate', 'ababil'),
                    'ripple' => __('Ripple', 'ababil'),
                    'pressShrink' => __('Press Shrink', 'ababil'),
                ],
            ]
        );

        $repeater->add_control(
            'description_animation_duration',
            [
                'label' => __('Animation Duration (ms)', 'ababil'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1000,
                'min' => 0,
                'step' => 100,
            ]
        );

        $repeater->add_control(
            'description_animation_delay',
            [
                'label' => __('Animation Delay (ms)', 'ababil'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 400,
                'min' => 0,
                'step' => 100,
            ]
        );

        // Button
        $repeater->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'ababil'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Learn More', 'ababil'),
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => __('Button Link', 'ababil'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $repeater->add_control(
            'button_animation',
            [
                'label' => __('Button Animation', 'ababil'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'fadeIn',
                'options' => [
                    'none' => __('None', 'ababil'),
                    'fadeIn' => __('Fade In', 'ababil'),
                    'slideInTop' => __('Slide In Top', 'ababil'),
                    'slideInBottom' => __('Slide In Bottom', 'ababil'),
                    'slideInLeft' => __('Slide In Left', 'ababil'),
                    'slideInRight' => __('Slide In Right', 'ababil'),
                    'zoomIn' => __('Zoom In', 'ababil'),
                    'bounceIn' => __('Bounce In', 'ababil'),
                    'flipInX' => __('Flip In X', 'ababil'),
                    'flipInY' => __('Flip In Y', 'ababil'),
                    'rotateIn' => __('Rotate In', 'ababil'),
                    'expand' => __('Expand', 'ababil'),
                    'pulse' => __('Pulse', 'ababil'),
                    'bounce' => __('Bounce', 'ababil'),
                    'shake' => __('Shake', 'ababil'),
                    'swing' => __('Swing', 'ababil'),
                    'wobble' => __('Wobble', 'ababil'),
                    'tada' => __('Tada', 'ababil'),
                    'typewriter' => __('Typewriter', 'ababil'),
                    'wordSlideIn' => __('Word Slide In', 'ababil'),
                    'letterFadeIn' => __('Letter Fade In', 'ababil'),
                    'wave' => __('Wave', 'ababil'),
                    'scramble' => __('Scramble', 'ababil'),
                    'staggeredFadeIn' => __('Staggered Fade In', 'ababil'),
                    'masonryLoad' => __('Masonry Load', 'ababil'),
                    'cascadeSlideIn' => __('Cascade Slide In', 'ababil'),
                    'hoverGrow' => __('Hover Grow', 'ababil'),
                    'hoverLift' => __('Hover Lift', 'ababil'),
                    'hoverRotate' => __('Hover Rotate', 'ababil'),
                    'ripple' => __('Ripple', 'ababil'),
                    'pressShrink' => __('Press Shrink', 'ababil'),
                ],
            ]
        );

        $repeater->add_control(
            'button_animation_duration',
            [
                'label' => __('Animation Duration (ms)', 'ababil'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1000,
                'min' => 0,
                'step' => 100,
            ]
        );

        $repeater->add_control(
            'button_animation_delay',
            [
                'label' => __('Animation Delay (ms)', 'ababil'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 600,
                'min' => 0,
                'step' => 100,
            ]
        );

        // Button Custom Styling
        $repeater->add_control(
            'button_custom_style',
            [
                'label' => __('Custom Button Style', 'ababil'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ababil'),
                'label_off' => __('No', 'ababil'),
                'default' => 'no',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'button_text_color',
            [
                'label' => __('Text Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'button_custom_style' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'button_background_color',
            [
                'label' => __('Background Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'button_custom_style' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'button_border_color',
            [
                'label' => __('Border Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'button_custom_style' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'button_border_width',
            [
                'label' => __('Border Width', 'ababil'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-width: {{SIZE}}{{UNIT}} !important; border-style: solid;',
                ],
                'condition' => [
                    'button_custom_style' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'button_custom_style' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'button_padding',
            [
                'label' => __('Padding', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => 12,
                    'right' => 24,
                    'bottom' => 12,
                    'left' => 24,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'button_custom_style' => 'yes',
                ],
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => [
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                        ],
                    ],
                    'font_weight' => [
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'font-weight: {{VALUE}} !important;',
                        ],
                    ],
                ],
                'condition' => [
                    'button_custom_style' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => __('Slides', 'ababil'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                        'heading_segments' => [
                            ['heading_segment' => __('Welcome to', 'ababil')],
                            ['heading_segment' => __('Our Slider', 'ababil')],
                        ],
                        'subheading' => __('This is a subheading', 'ababil'),
                        'description' => __('This is a slide description.', 'ababil'),
                        'button_text' => __('Learn More', 'ababil'),
                        'button_link' => ['url' => '#'],
                    ],
                ],
                'title_field' => '{{{ heading_segments[0].heading_segment }}}',
            ]
        );

        $this->end_controls_section();

        // Content Tab: Slider Settings
        $this->start_controls_section(
            'slider_settings',
            [
                'label' => __('Slider Settings', 'ababil'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', 'ababil'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ababil'),
                'label_off' => __('No', 'ababil'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __('Autoplay Speed (ms)', 'ababil'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5000,
                'min' => 1000,
                'step' => 100,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __('Loop', 'ababil'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ababil'),
                'label_off' => __('No', 'ababil'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => __('Pause on Hover', 'ababil'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ababil'),
                'label_off' => __('No', 'ababil'),
                'default' => 'yes',
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'transition_speed',
            [
                'label' => __('Transition Speed (ms)', 'ababil'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1000,
                'min' => 100,
                'step' => 100,
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination', 'ababil'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ababil'),
                'label_off' => __('No', 'ababil'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_navigation',
            [
                'label' => __('Show Navigation', 'ababil'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ababil'),
                'label_off' => __('No', 'ababil'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'lazy_load_images',
            [
                'label' => __('Lazy Load Images', 'ababil'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ababil'),
                'label_off' => __('No', 'ababil'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'touch_swipe',
            [
                'label' => __('Enable Touch Swipe', 'ababil'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ababil'),
                'label_off' => __('No', 'ababil'),
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Style Tab: General
        $this->start_controls_section(
            'general_style',
            [
                'label' => __('General', 'ababil'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'slider_height',
            [
                'label' => __('Slider Height', 'ababil'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 600,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slider' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab: Content
        $this->start_controls_section(
            'content_style',
            [
                'label' => __('Content', 'ababil'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => 50,
                    'right' => 50,
                    'bottom' => 50,
                    'left' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_align',
            [
                'label' => __('Content Alignment', 'ababil'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'ababil'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'ababil'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'ababil'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-content' => 'align-items: {{VALUE}}; text-align: {{VALUE}};',
                ],
            ]
        );

        // Heading Styles
        $this->add_control(
            'heading_heading',
            [
                'label' => __('Heading', 'ababil'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __('Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .ababil-slide-heading',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'heading_text_shadow',
                'selector' => '{{WRAPPER}} .ababil-slide-heading',
            ]
        );

        $this->add_control(
            'heading_background_color',
            [
                'label' => __('Background Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-heading' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_padding',
            [
                'label' => __('Padding', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_margin',
            [
                'label' => __('Margin', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 20,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Subheading Styles
        $this->add_control(
            'subheading_heading',
            [
                'label' => __('Subheading', 'ababil'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'subheading_color',
            [
                'label' => __('Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-subheading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subheading_typography',
                'selector' => '{{WRAPPER}} .ababil-slide-subheading',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'subheading_text_shadow',
                'selector' => '{{WRAPPER}} .ababil-slide-subheading',
            ]
        );

        $this->add_control(
            'subheading_background_color',
            [
                'label' => __('Background Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-subheading' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subheading_padding',
            [
                'label' => __('Padding', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-subheading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subheading_margin',
            [
                'label' => __('Margin', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 20,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-subheading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Description Styles
        $this->add_control(
            'description_heading',
            [
                'label' => __('Description', 'ababil'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .ababil-slide-description',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'description_text_shadow',
                'selector' => '{{WRAPPER}} .ababil-slide-description',
            ]
        );

        $this->add_control(
            'description_background_color',
            [
                'label' => __('Background Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-description' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_padding',
            [
                'label' => __('Padding', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_margin',
            [
                'label' => __('Margin', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 20,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Button Styles
        $this->add_control(
            'button_heading',
            [
                'label' => __('Button', 'ababil'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Text Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __('Background Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => __('Border Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-button' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_width',
            [
                'label' => __('Border Width', 'ababil'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-button' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;',
                ],
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => __('Padding', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => 12,
                    'right' => 24,
                    'bottom' => 12,
                    'left' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .ababil-slide-button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .ababil-slide-button',
            ]
        );

        $this->add_control(
            'button_margin',
            [
                'label' => __('Margin', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab: Pagination
        $this->start_controls_section(
            'pagination_style',
            [
                'label' => __('Pagination', 'ababil'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_pagination' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pagination_position',
            [
                'label' => __('Position', 'ababil'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'bottom',
                'options' => [
                    'top' => __('Top', 'ababil'),
                    'bottom' => __('Bottom', 'ababil'),
                    'custom' => __('Custom', 'ababil'),
                ],
                'prefix_class' => 'ababil-pagination-position-',
            ]
        );

        $this->add_responsive_control(
            'pagination_offset',
            [
                'label' => __('Offset', 'ababil'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}}.ababil-pagination-position-top .ababil-slider-pagination' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
                    '{{WRAPPER}}.ababil-pagination-position-bottom .ababil-slider-pagination' => 'bottom: {{SIZE}}{{UNIT}}; top: auto;',
                    '{{WRAPPER}}.ababil-pagination-position-custom .ababil-slider-pagination' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
                ],
                'condition' => [
                    'pagination_position' => ['top', 'bottom', 'custom'],
                ],
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label' => __('Dot Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-pagination-dot' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_active_color',
            [
                'label' => __('Active Dot Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-pagination-dot.active' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_size',
            [
                'label' => __('Dot Size', 'ababil'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 8,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-pagination-dot' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_spacing',
            [
                'label' => __('Spacing Between Dots', 'ababil'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 2,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-pagination-dot' => 'margin: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab: Navigation
        $this->start_controls_section(
            'navigation_style',
            [
                'label' => __('Navigation', 'ababil'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_navigation' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'nav_position',
            [
                'label' => __('Position', 'ababil'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'middle',
                'options' => [
                    'top' => __('Top', 'ababil'),
                    'middle' => __('Middle', 'ababil'),
                    'bottom' => __('Bottom', 'ababil'),
                    'custom' => __('Custom', 'ababil'),
                ],
                'prefix_class' => 'ababil-nav-position-',
            ]
        );

        $this->add_responsive_control(
            'nav_vertical_offset',
            [
                'label' => __('Vertical Offset', 'ababil'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => -50,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}}.ababil-nav-position-custom .ababil-slider-nav' => 'top: {{SIZE}}{{UNIT}}; transform: none;',
                ],
                'condition' => [
                    'nav_position' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'nav_color',
            [
                'label' => __('Icon Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-nav-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'nav_background_color',
            [
                'label' => __('Background Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-nav-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'nav_hover_color',
            [
                'label' => __('Hover Icon Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-nav-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'nav_hover_background_color',
            [
                'label' => __('Hover Background Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-nav-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_size',
            [
                'label' => __('Button Size', 'ababil'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                    ],
                ],
                'default' => [
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-nav-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_icon_size',
            [
                'label' => __('Icon Size', 'ababil'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 30,
                    ],
                ],
                'default' => [
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-nav-button' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'nav_border_radius',
            [
                'label' => __('Border Radius', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ababil-nav-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('slider', 'class', 'ababil-slider');
        $this->add_render_attribute('slider', 'data-autoplay', $settings['autoplay']);
        $this->add_render_attribute('slider', 'data-autoplay-speed', $settings['autoplay_speed']);
        $this->add_render_attribute('slider', 'data-loop', $settings['loop']);
        $this->add_render_attribute('slider', 'data-pause-on-hover', $settings['pause_on_hover']);
        $this->add_render_attribute('slider', 'data-transition-speed', $settings['transition_speed']);
        $this->add_render_attribute('slider', 'data-lazy-load', $settings['lazy_load_images']);
        $this->add_render_attribute('slider', 'data-touch-swipe', $settings['touch_swipe']);
        ?>
        <div <?php $this->print_render_attribute_string('slider'); ?>>
            <div class="ababil-slider-wrapper">
                <?php foreach ($settings['slides'] as $index => $slide) : ?>
                    <div class="ababil-slide elementor-repeater-item-<?php echo esc_attr($slide['_id']); ?> <?php echo $index === 0 ? 'active' : ''; ?>"
                         data-transition="<?php echo esc_attr($slide['slide_transition_effect']); ?>">
                        <div class="ababil-slide-background"
                             <?php if ($settings['lazy_load_images'] === 'yes' && $index !== 0) : ?>
                                 data-src="<?php echo esc_url($slide['slide_image']['url']); ?>"
                             <?php else : ?>
                                 style="background-image: url(<?php echo esc_url($slide['slide_image']['url']); ?>);"
                             <?php endif; ?>></div>
                        <div class="ababil-slide-overlay"></div>
                        <div class="ababil-slide-content">
                            <?php if (!empty($slide['heading_segments'])) : ?>
                                <h2 class="ababil-slide-heading">
                                    <?php foreach ($slide['heading_segments'] as $segment) : ?>
                                        <span class="ababil-heading-segment elementor-repeater-item-<?php echo esc_attr($segment['_id']); ?>"
                                              data-animation="<?php echo esc_attr($segment['segment_animation']); ?>"
                                              data-duration="<?php echo esc_attr($segment['segment_animation_duration']); ?>"
                                              data-delay="<?php echo esc_attr($segment['segment_animation_delay']); ?>">
                                            <?php echo wp_kses_post($segment['heading_segment']); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </h2>
                            <?php endif; ?>

                            <?php if (!empty($slide['subheading'])) : ?>
                                <div class="ababil-slide-subheading"
                                     data-animation="<?php echo esc_attr($slide['subheading_animation']); ?>"
                                     data-duration="<?php echo esc_attr($slide['subheading_animation_duration']); ?>"
                                     data-delay="<?php echo esc_attr($slide['subheading_animation_delay']); ?>">
                                    <?php echo wp_kses_post($slide['subheading']); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($slide['description'])) : ?>
                                <div class="ababil-slide-description"
                                     data-animation="<?php echo esc_attr($slide['description_animation']); ?>"
                                     data-duration="<?php echo esc_attr($slide['description_animation_duration']); ?>"
                                     data-delay="<?php echo esc_attr($slide['description_animation_delay']); ?>">
                                    <?php echo wp_kses_post($slide['description']); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($slide['button_text']) && !empty($slide['button_link']['url'])) : ?>
                                <a href="<?php echo esc_url($slide['button_link']['url']); ?>" 
                                   class="ababil-slide-button elementor-repeater-item-<?php echo esc_attr($slide['_id']); ?>"
                                   data-animation="<?php echo esc_attr($slide['button_animation']); ?>"
                                   data-duration="<?php echo esc_attr($slide['button_animation_duration']); ?>"
                                   data-delay="<?php echo esc_attr($slide['button_animation_delay']); ?>">
                                    <?php echo esc_html($slide['button_text']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if ($settings['show_pagination'] === 'yes') : ?>
                <div class="ababil-slider-pagination">
                    <?php foreach ($settings['slides'] as $index => $slide) : ?>
                        <span class="ababil-pagination-dot <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>"></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if ($settings['show_navigation'] === 'yes') : ?>
                <div class="ababil-slider-nav">
                    <button class="ababil-nav-button ababil-nav-prev"><i class="eicon-chevron-left"></i></button>
                    <button class="ababil-nav-button ababil-nav-next"><i class="eicon-chevron-right"></i></button>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <#
        view.addRenderAttribute('slider', 'class', 'ababil-slider');
        view.addRenderAttribute('slider', 'data-autoplay', settings.autoplay);
        view.addRenderAttribute('slider', 'data-autoplay-speed', settings.autoplay_speed);
        view.addRenderAttribute('slider', 'data-loop', settings.loop);
        view.addRenderAttribute('slider', 'data-pause-on-hover', settings.pause_on_hover);
        view.addRenderAttribute('slider', 'data-transition-speed', settings.transition_speed);
        view.addRenderAttribute('slider', 'data-lazy-load', settings.lazy_load_images);
        view.addRenderAttribute('slider', 'data-touch-swipe', settings.touch_swipe);
        #>
        <div {{{ view.getRenderAttributeString('slider') }}}>
            <div class="ababil-slider-wrapper">
                <# _.each(settings.slides, function(slide, index) { #>
                    <div class="ababil-slide elementor-repeater-item-{{ slide._id }} {{ index === 0 ? 'active' : '' }}"
                         data-transition="{{ slide.slide_transition_effect }}">
                        <div class="ababil-slide-background"
                             {{{ settings.lazy_load_images === 'yes' && index !== 0 ? 'data-src="' + slide.slide_image.url + '"' : 'style="background-image: url(' + slide.slide_image.url + ');"' }}}></div>
                        <div class="ababil-slide-overlay"></div>
                        <div class="ababil-slide-content">
                            <# if (slide.heading_segments.length) { #>
                                <h2 class="ababil-slide-heading">
                                    <# _.each(slide.heading_segments, function(segment) { #>
                                        <span class="ababil-heading-segment elementor-repeater-item-{{ segment._id }}"
                                              data-animation="{{ segment.segment_animation }}"
                                              data-duration="{{ segment.segment_animation_duration }}"
                                              data-delay="{{ segment.segment_animation_delay }}">
                                            {{{ segment.heading_segment }}}
                                        </span>
                                    <# }); #>
                                </h2>
                            <# } #>

                            <# if (slide.subheading) { #>
                                <div class="ababil-slide-subheading"
                                     data-animation="{{ slide.subheading_animation }}"
                                     data-duration="{{ slide.subheading_animation_duration }}"
                                     data-delay="{{ slide.subheading_animation_delay }}">
                                    {{{ slide.subheading }}}
                                </div>
                            <# } #>

                            <# if (slide.description) { #>
                                <div class="ababil-slide-description"
                                     data-animation="{{ slide.description_animation }}"
                                     data-duration="{{ slide.description_animation_duration }}"
                                     data-delay="{{ slide.description_animation_delay }}">
                                    {{{ slide.description }}}
                                </div>
                            <# } #>

                            <# if (slide.button_text && slide.button_link.url) { #>
                                <a href="{{ slide.button_link.url }}" 
                                   class="ababil-slide-button elementor-repeater-item-{{ slide._id }}"
                                   data-animation="{{ slide.button_animation }}"
                                   data-duration="{{ slide.button_animation_duration }}"
                                   data-delay="{{ slide.button_animation_delay }}">
                                    {{{ slide.button_text }}}
                                </a>
                            <# } #>
                        </div>
                    </div>
                <# }); #>
            </div>
            <# if (settings.show_pagination === 'yes') { #>
                <div class="ababil-slider-pagination">
                    <# _.each(settings.slides, function(slide, index) { #>
                        <span class="ababil-pagination-dot {{ index === 0 ? 'active' : '' }}" data-index="{{ index }}"></span>
                    <# }); #>
                </div>
            <# } #>
            <# if (settings.show_navigation === 'yes') { #>
                <div class="ababil-slider-nav">
                    <button class="ababil-nav-button ababil-nav-prev"><i class="eicon-chevron-left"></i></button>
                    <button class="ababil-nav-button ababil-nav-next"><i class="eicon-chevron-right"></i></button>
                </div>
            <# } #>
        </div>
        <?php
    }
}
?>