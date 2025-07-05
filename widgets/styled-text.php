<?php

/**
 * Ababil Styled Text Widget for Elementor
 */
class Ababil_Styled_Text_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ababil-styled-text';
    }

    public function get_title() {
        return __( 'Styled Text', 'ababil' );
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }

    public function get_categories() {
        return [ 'ababil' ];
    }

    public function get_style_depends() {
        return [ 'ababil-styled-text' ];
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

        // HTML Tag selection control for SEO
        $this->add_control(
            'html_tag',
            [
                'label'       => __( 'HTML Tag', 'ababil' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'p'    => 'p',
                ],
                'default'     => 'div',
                'description' => __( 'Select the HTML tag for the container. Use H1-H6 for headings.', 'ababil' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        // Text Content
        $repeater->add_control(
            'text_part',
            [
                'label'       => __( 'Text Part', 'ababil' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => '',
                'label_block' => true,
                'dynamic'     => [ 'active' => true ],
            ]
        );

        // URL Link
        $repeater->add_control(
            'link',
            [
                'label'         => __( 'Link', 'ababil' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => __( 'https://your-link.com', 'ababil' ),
                'show_external' => true,
                'dynamic'       => [ 'active' => true ],
                'render_type'   => 'ui',
                'default'       => [
                    'url'        => '',
                    'is_external'=> false,
                    'nofollow'   => false,
                ],
            ]
        );

        // Custom Class
        $repeater->add_control(
            'css_class',
            [
                'label'   => __( 'Custom CSS Class', 'ababil' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'title'   => __( 'Add your custom class WITHOUT the dot. e.g: my-class', 'ababil' ),
            ]
        );

        // Text Color
        $repeater->add_control(
            'text_color',
            [
                'label'     => __( 'Text Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Background
        $repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'background',
                'label'    => __( 'Background', 'ababil' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        // Typography
        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        // Text Shadow
        $repeater->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_shadow',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        // Margin
        $repeater->add_responsive_control(
            'margin',
            [
                'label'      => __( 'Margin', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $repeater->add_responsive_control(
            'padding',
            [
                'label'      => __( 'Padding', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border
        $repeater->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'border',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        // Border Radius
        $repeater->add_responsive_control(
            'border_radius',
            [
                'label'      => __( 'Border Radius', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Box Shadow
        $repeater->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        $this->add_control(
            'text_parts',
            [
                'label'       => __( 'Text Parts', 'ababil' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [ 'text_part' => 'This is Bangladesh, ' ],
                    [ 'text_part' => 'a leading country', 'typography' => [ 'font_weight' => 'bold' ] ],
                    [ 'text_part' => ' in apparel market, ' ],
                    [ 'text_part' => 'get it now', 'text_color' => '#ff0000', 'typography' => [ 'font_weight' => 'bold' ], 'link' => [ 'url' => '#' ] ],
                ],
                'title_field' => '{{{ text_part }}}',
            ]
        );

        $this->end_controls_section();

        // Container Style
        $this->start_controls_section(
            'container_style',
            [
                'label' => __( 'Container', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'     => __( 'Alignment', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [ 'title' => __( 'Left', 'ababil' ),   'icon' => 'eicon-text-align-left' ],
                    'center' => [ 'title' => __( 'Center', 'ababil' ), 'icon' => 'eicon-text-align-center' ],
                    'right'  => [ 'title' => __( 'Right', 'ababil' ),  'icon' => 'eicon-text-align-right' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-styled-text-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Get the selected HTML tag and sanitize it
        $allowed_tags = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'div' ];
        $html_tag = isset( $settings['html_tag'] ) ? $settings['html_tag'] : 'div';
        if ( ! in_array( $html_tag, $allowed_tags ) ) {
            $html_tag = 'div'; // Fallback to 'div' if the tag is not allowed
        }

        $this->add_render_attribute( 'container', 'class', 'ababil-styled-text-container' );

        // Use the dynamic HTML tag for the container
        echo '<' . $html_tag . ' ' . $this->get_render_attribute_string( 'container' ) . '>';

        if ( ! empty( $settings['text_parts'] ) ) {
            foreach ( $settings['text_parts'] as $index => $item ) {
                // Using a unique key for each repeater item's render attribute
                $segment_key = 'segment_' . $item['_id'];

                $this->add_render_attribute( $segment_key, [
                    'class' => [
                        'ababil-text-segment',
                        'elementor-repeater-item-' . $item['_id'],
                    ],
                ] );

                if ( ! empty( $item['css_class'] ) ) {
                    $this->add_render_attribute( $segment_key, 'class', $item['css_class'] );
                }

                // Add link attributes if URL exists
                if ( ! empty( $item['link']['url'] ) ) {
                    $this->add_link_attributes( $segment_key, $item['link'] );
                    echo '<a ' . $this->get_render_attribute_string( $segment_key ) . '>';
                    echo wp_kses_post( $item['text_part'] );
                    echo '</a>';
                } else {
                    echo '<span ' . $this->get_render_attribute_string( $segment_key ) . '>';
                    echo wp_kses_post( $item['text_part'] );
                    echo '</span>';
                }
            }
        }

        // Close the dynamic HTML tag
        echo '</' . $html_tag . '>';
    }

    /**
     * Render widget output in the editor (JS template)
     */
    protected function content_template() {
        ?>
        <#
        var html_tag = settings.html_tag || 'div';
        #>
        <{{ html_tag }} class="ababil-styled-text-container">
            <# _.each( settings.text_parts, function( item, index ) {
                var segment_key = 'segment_' + item._id;
                var segmentClasses = 'ababil-text-segment elementor-repeater-item-' + item._id;

                if ( item.css_class ) {
                    segmentClasses += ' ' + item.css_class;
                }

                view.addRenderAttribute( segment_key, {
                    'class': segmentClasses
                } );

                if ( item.link && item.link.url ) {
                    view.addRenderAttribute( segment_key, 'href', item.link.url );
                    if ( item.link.is_external ) {
                        view.addRenderAttribute( segment_key, 'target', '_blank' );
                    }
                    if ( item.link.nofollow ) {
                        view.addRenderAttribute( segment_key, 'rel', 'nofollow' );
                    }
                    #>
                    <a {{{ view.getRenderAttributeString( segment_key ) }}}>
                        {{{ item.text_part }}}
                    </a>
                    <#
                } else {
                    #>
                    <span {{{ view.getRenderAttributeString( segment_key ) }}}>
                        {{{ item.text_part }}}
                    </span>
                    <#
                }
            } ); #>
        </{{ html_tag }}>
        <?php
    }
}