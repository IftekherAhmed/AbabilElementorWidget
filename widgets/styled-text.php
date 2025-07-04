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
        return ['ababil']; // Our custom category
    }

    public function get_style_depends() {
        return ['ababil-styled-text'];
    }

    public function get_script_depends() {
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

        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
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
                        'text_color' => '#000000',
                        'typography' => ['font_weight' => 'bold'],
                    ],
                    [
                        'text_part' => ' in apparel market, ',
                    ],
                    [
                        'text_part' => 'get it now',
                        'text_color' => '#ff0000',
                        'typography' => ['font_weight' => 'bold'],
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
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .ababil-styled-text-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        echo '<div class="ababil-styled-text-container">';
        
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

    protected function content_template() {
        ?>
        <div class="ababil-styled-text-container">
            <# _.each(settings.text_parts, function(item, index) { #>
                <span class="ababil-text-segment elementor-repeater-item-{{ item._id }}">
                    {{{ item.text_part }}}
                </span>
            <# }); #>
        </div>
        <?php
    }
}