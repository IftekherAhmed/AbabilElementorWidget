<?php
if (!defined('ABSPATH')) {
    exit;
}

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
        return ['ababil-slider'];
    }

    public function get_script_depends() {
        return ['ababil-slider'];
    }

    protected function register_controls() {
        // Content Tab
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
                    '{{WRAPPER}} {{CURRENT_ITEM}} .ababil-slide-background' => 'background-position: {{VALUE}};',
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
                    '{{WRAPPER}} {{CURRENT_ITEM}} .ababil-slide-background' => 'background-size: {{VALUE}};',
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
                    'slide' => __('Slide', 'ababil'),
                    'fade' => __('Fade', 'ababil'),
                    'cube' => __('Cube', 'ababil'),
                    'coverflow' => __('Coverflow', 'ababil'),
                    'flip' => __('Flip', 'ababil'),
                    'zoom' => __('Zoom', 'ababil'),
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
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                ],
            ]
        );

        $heading_repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'segment_typography',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
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
                    'fadeInUp' => __('Fade In Up', 'ababil'),
                    'fadeInDown' => __('Fade In Down', 'ababil'),
                    'fadeInLeft' => __('Fade In Left', 'ababil'),
                    'fadeInRight' => __('Fade In Right', 'ababil'),
                    'zoomIn' => __('Zoom In', 'ababil'),
                    'slideInUp' => __('Slide In Up', 'ababil'),
                    'slideInDown' => __('Slide In Down', 'ababil'),
                    'slideInLeft' => __('Slide In Left', 'ababil'),
                    'slideInRight' => __('Slide In Right', 'ababil'),
                    'bounceIn' => __('Bounce In', 'ababil'),
                    'rotateIn' => __('Rotate In', 'ababil'),
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
                'default' => 'fadeInUp',
                'options' => [
                    'none' => __('None', 'ababil'),
                    'fadeIn' => __('Fade In', 'ababil'),
                    'fadeInUp' => __('Fade In Up', 'ababil'),
                    'fadeInDown' => __('Fade In Down', 'ababil'),
                    'fadeInLeft' => __('Fade In Left', 'ababil'),
                    'fadeInRight' => __('Fade In Right', 'ababil'),
                    'zoomIn' => __('Zoom In', 'ababil'),
                    'slideInUp' => __('Slide In Up', 'ababil'),
                    'slideInDown' => __('Slide In Down', 'ababil'),
                    'slideInLeft' => __('Slide In Left', 'ababil'),
                    'slideInRight' => __('Slide In Right', 'ababil'),
                    'bounceIn' => __('Bounce In', 'ababil'),
                    'rotateIn' => __('Rotate In', 'ababil'),
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
                'default' => 'fadeInUp',
                'options' => [
                    'none' => __('None', 'ababil'),
                    'fadeIn' => __('Fade In', 'ababil'),
                    'fadeInUp' => __('Fade In Up', 'ababil'),
                    'fadeInDown' => __('Fade In Down', 'ababil'),
                    'fadeInLeft' => __('Fade In Left', 'ababil'),
                    'fadeInRight' => __('Fade In Right', 'ababil'),
                    'zoomIn' => __('Zoom In', 'ababil'),
                    'slideInUp' => __('Slide In Up', 'ababil'),
                    'slideInDown' => __('Slide In Down', 'ababil'),
                    'slideInLeft' => __('Slide In Left', 'ababil'),
                    'slideInRight' => __('Slide In Right', 'ababil'),
                    'bounceIn' => __('Bounce In', 'ababil'),
                    'rotateIn' => __('Rotate In', 'ababil'),
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
                'default' => 'fadeInUp',
                'options' => [
                    'none' => __('None', 'ababil'),
                    'fadeIn' => __('Fade In', 'ababil'),
                    'fadeInUp' => __('Fade In Up', 'ababil'),
                    'fadeInDown' => __('Fade In Down', 'ababil'),
                    'fadeInLeft' => __('Fade In Left', 'ababil'),
                    'fadeInRight' => __('Fade In Right', 'ababil'),
                    'zoomIn' => __('Zoom In', 'ababil'),
                    'slideInUp' => __('Slide In Up', 'ababil'),
                    'slideInDown' => __('Slide In Down', 'ababil'),
                    'slideInLeft' => __('Slide In Left', 'ababil'),
                    'slideInRight' => __('Slide In Right', 'ababil'),
                    'bounceIn' => __('Bounce In', 'ababil'),
                    'rotateIn' => __('Rotate In', 'ababil'),
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

        $this->add_control(
            'slides',
            [
                'label' => __('Slides', 'ababil'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_image' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
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

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', 'ababil'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before',
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
                'condition' => ['autoplay' => 'yes'],
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'ababil'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slider_height',
            [
                'label' => __('Slider Height', 'ababil'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'default' => [
                    'size' => 500,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => ['min' => 200, 'max' => 1000],
                    'vh' => ['min' => 20, 'max' => 100],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slider' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_width',
            [
                'label' => __('Content Width', 'ababil'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default' => [
                    'size' => 80,
                    'unit' => '%',
                ],
                'range' => [
                    'px' => ['min' => 200, 'max' => 1200],
                    '%' => ['min' => 20, 'max' => 100],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-content' => 'max-width: {{SIZE}}{{UNIT}}; width: 100%;',
                ],
            ]
        );

        $this->add_control(
            'content_horizontal_align',
            [
                'label' => __('Horizontal Alignment', 'ababil'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'ababil'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'ababil'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'ababil'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-content' => 'display: flex; flex-direction: column; align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_vertical_align',
            [
                'label' => __('Vertical Alignment', 'ababil'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Top', 'ababil'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __('Middle', 'ababil'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => __('Bottom', 'ababil'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-content' => 'justify-content: {{VALUE}}; height: 100%;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'slider_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .ababil-slider',
            ]
        );

        // Heading Style
        $this->add_control(
            'heading_style',
            [
                'label' => __('Heading', 'ababil'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .ababil-slide-heading',
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

        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => __('Margin', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Subheading Style
        $this->add_control(
            'subheading_style',
            [
                'label' => __('Subheading', 'ababil'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subheading_typography',
                'selector' => '{{WRAPPER}} .ababil-slide-subheading',
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

        $this->add_responsive_control(
            'subheading_margin',
            [
                'label' => __('Margin', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-subheading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Description Style
        $this->add_control(
            'description_style',
            [
                'label' => __('Description', 'ababil'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .ababil-slide-description',
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

        $this->add_responsive_control(
            'description_margin',
            [
                'label' => __('Margin', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Button Style
        $this->add_control(
            'button_style',
            [
                'label' => __('Button', 'ababil'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .ababil-slide-button',
            ]
        );

        $this->start_controls_tabs('button_tabs');

        $this->start_controls_tab('button_normal', ['label' => __('Normal', 'ababil')]);

        $this->add_control(
            'button_color',
            [
                'label' => __('Text Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .ababil-slide-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('button_hover', ['label' => __('Hover', 'ababil')]);

        $this->add_control(
            'button_hover_color',
            [
                'label' => __('Text Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button_hover_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .ababil-slide-button:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ababil-slide-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
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

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('slider', 'class', 'ababil-slider');
        $this->add_render_attribute('slider', 'data-autoplay', $settings['autoplay']);
        $this->add_render_attribute('slider', 'data-autoplay-speed', $settings['autoplay_speed']);
        ?>
        <div <?php $this->print_render_attribute_string('slider'); ?>>
            <?php foreach ($settings['slides'] as $index => $slide) : ?>
                <div class="ababil-slide elementor-repeater-item-<?php echo esc_attr($slide['_id']); ?> <?php echo $index === 0 ? 'active' : ''; ?>"
                     data-transition="<?php echo esc_attr($slide['slide_transition_effect']); ?>">
                    <div class="ababil-slide-background" style="background-image: url(<?php echo esc_url($slide['slide_image']['url']); ?>);"></div>
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
                            <a href="<?php echo esc_url($slide['button_link']['url']); ?>" class="ababil-slide-button"
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
        <?php
    }

    protected function content_template() {
        ?>
        <#
        view.addRenderAttribute('slider', 'class', 'ababil-slider');
        view.addRenderAttribute('slider', 'data-autoplay', settings.autoplay);
        view.addRenderAttribute('slider', 'data-autoplay-speed', settings.autoplay_speed);
        #>
        <div {{{ view.getRenderAttributeString('slider') }}}>
            <# _.each(settings.slides, function(slide, index) { #>
                <div class="ababil-slide elementor-repeater-item-{{ slide._id }} {{ index === 0 ? 'active' : '' }}"
                     data-transition="{{ slide.slide_transition_effect }}">
                    <div class="ababil-slide-background" style="background-image: url({{ slide.slide_image.url }});"></div>
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
                            <a href="{{ slide.button_link.url }}" class="ababil-slide-button"
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
        <?php
    }
}
?>