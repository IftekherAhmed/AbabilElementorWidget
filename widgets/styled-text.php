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

        // Text Content
        $repeater->add_control(
            'text_part',
            [
                'label' => __('Text Part', 'ababil'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '',
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        // URL Link
        $repeater->add_control(
            'link',
            [
                'label' => __('Link', 'ababil'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'ababil'),
                'show_external' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'render_type' => 'ui', // Ensures the dynamic tag icon appears beside the input
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        // Custom Class
        $repeater->add_control(
            'css_class',
            [
                'label' => __('Custom CSS Class', 'ababil'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'title' => __('Add your custom class WITHOUT the dot. e.g: my-class', 'ababil'),
            ]
        );

        // Text Color
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

        // Background
        $repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __('Background', 'ababil'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        // Typography
        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        // Text Shadow
        $repeater->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        // Margin
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

        // Padding
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

        // Border
        $repeater->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        // Border Radius
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

        // Box Shadow
        $repeater->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        $this->add_control(
            'text_parts',
            [
                'label' => __('Text Parts', 'ababil'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'text_part' => 'This is Bangladesh, ',
                    ],
                    [
                        'text_part' => 'a leading country',
                        'typography' => ['font_weight' => 'bold']
                    ],
                    [
                        'text_part' => ' in apparel market, ',
                    ],
                    [
                        'text_part' => 'get it now',
                        'text_color' => '#ff0000',
                        'typography' => ['font_weight' => 'bold'],
                        'link' => ['url' => '#']
                    ],
                ],
                'title_field' => '{{{ text_part }}}',
            ]
        );

        $this->end_controls_section();

        // Container Style
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
                    'elementor-repeater-item-' . $item['_id'],
                    $item['css_class']
                ],
            ]);
            
            // Add link attributes if URL exists
            if (!empty($item['link']['url'])) {
                $this->add_render_attribute('segment_' . $index, 'href', $item['link']['url']);
                
                if ($item['link']['is_external']) {
                    $this->add_render_attribute('segment_' . $index, 'target', '_blank');
                }
                
                if ($item['link']['nofollow']) {
                    $this->add_render_attribute('segment_' . $index, 'rel', 'nofollow');
                }
                
                echo '<a ' . $this->get_render_attribute_string('segment_' . $index) . '>';
                echo esc_html($item['text_part']);
                echo '</a>';
            } else {
                echo '<span ' . $this->get_render_attribute_string('segment_' . $index) . '>';
                echo esc_html($item['text_part']);
                echo '</span>';
            }
        }
        
        echo '</div>';
    }

    protected function content_template() {
        ?>
        <div class="ababil-styled-text-container">
            <# _.each(settings.text_parts, function(item, index) { #>
                <#
                var segmentClasses = 'ababil-text-segment elementor-repeater-item-' + item._id;
                if (item.css_class) {
                    segmentClasses += ' ' + item.css_class;
                }
                
                view.addRenderAttribute('segment_' + index, {
                    'class': segmentClasses
                });
                
                if (item.link && item.link.url) {
                    view.addRenderAttribute('segment_' + index, 'href', item.link.url);
                    
                    if (item.link.is_external) {
                        view.addRenderAttribute('segment_' + index, 'target', '_blank');
                    }
                    
                    if (item.link.nofollow) {
                        view.addRenderAttribute('segment_' + index, 'rel', 'nofollow');
                    }
                    #>
                    <a {{{ view.getRenderAttributeString('segment_' + index) }}}>
                        {{{ item.text_part }}}
                    </a>
                    <#
                } else {
                    #>
                    <span {{{ view.getRenderAttributeString('segment_' + index) }}}>
                        {{{ item.text_part }}}
                    </span>
                    <#
                }
                #>
            <# }); #>
        </div>
        <?php
    }
}