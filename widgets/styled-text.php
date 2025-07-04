<?php
class Ababil_Styled_Text_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ababil-styled-text';
    }

    public function get_title() {
        return __('Styled Text', 'ababil');
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }

    public function get_categories() {
        return ['ababil'];
    }

    public function get_style_depends() {
        return ['ababil-styled-text'];
    }

    protected function register_controls() {
        // Content Tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'ababil'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        // Text Content (No defaults)
        $repeater->add_control(
            'text_part',
            [
                'label' => __('Text Part', 'ababil'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        // Text Color (No defaults)
        $repeater->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Background (No defaults)
        $repeater->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'ababil'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        // Typography (No defaults)
        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        // Text Shadow (No defaults)
        $repeater->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        // Margin (No defaults)
        $repeater->add_responsive_control(
            'margin',
            [
                'label' => __('Margin', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding (No defaults)
        $repeater->add_responsive_control(
            'padding',
            [
                'label' => __('Padding', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border (No defaults)
        $repeater->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        // Border Radius (No defaults)
        $repeater->add_responsive_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'ababil'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'text_parts',
            [
                'label' => __('Text Parts', 'ababil'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ text_part }}}',
            ]
        );

        $this->end_controls_section();

        // Container Style (No defaults)
        $this->start_controls_section(
            'container_style',
            [
                'label' => __('Container', 'ababil'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label' => __('Alignment', 'ababil'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => __('Left', 'ababil'), 'icon' => 'eicon-text-align-left'],
                    'center' => ['title' => __('Center', 'ababil'), 'icon' => 'eicon-text-align-center'],
                    'right' => ['title' => __('Right', 'ababil'), 'icon' => 'eicon-text-align-right'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-styled-text-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $this->add_render_attribute('container', 'class', 'ababil-styled-text-container');
        
        echo '<div ' . $this->get_render_attribute_string('container') . '>';
        
        foreach ($settings['text_parts'] as $index => $item) {
            $this->add_render_attribute('segment_' . $index, [
                'class' => [
                    'ababil-text-segment',
                    'elementor-repeater-item-' . $item['_id']
                ],
            ]);
            
            echo '<span ' . $this->get_render_attribute_string('segment_' . $index) . '>';
            echo esc_html($item['text_part']);
            echo '</span>';
        }
        
        echo '</div>';
    }
}