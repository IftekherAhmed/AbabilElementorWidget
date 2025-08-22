<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Ababil Content Box Widget for Elementor
 */
class Ababil_Content_Box_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ababil-content-box';
    }

    public function get_title() {
        return __( 'Content Box', 'ababil' );
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_categories() {
        return [ 'ababil' ];
    }

    public function get_keywords() {
        return [ 'info box', 'feature', 'icon box', 'content', 'ababil' ];
    }

    public function get_style_depends() {
        return [ 'ababil-content-box' ];
    }

    public function get_script_depends() {
        return [ 'ababil-content-box' ];
    }

    /**
     * Register widget controls
     */
    protected function register_controls() {

        //======================================================================================
        // I. CONTENT TAB
        //======================================================================================
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // -- Control: Choose between Icon and Image
        $this->add_control(
            'graphic_element',
            [
                'label'   => esc_html__( 'Graphic Element', 'ababil' ),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'none'  => [ 'title' => esc_html__( 'None', 'ababil' ),  'icon' => 'eicon-ban' ],
                    'icon'  => [ 'title' => esc_html__( 'Icon', 'ababil' ),  'icon' => 'eicon-star' ],
                    'image' => [ 'title' => esc_html__( 'Image', 'ababil' ), 'icon' => 'eicon-image-bold' ],
                    'text'  => [ 'title' => esc_html__( 'Text', 'ababil' ), 'icon' => 'eicon-t-letter-bold' ],
                ],
                'default' => 'icon',
            ]
        );

        // -- Control: Icon
        $this->add_control(
            'icon',
            [
                'label'     => __( 'Icon', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::ICONS,
                'default'   => [
                    'value'    => 'fas fa-star',
                    'library'  => 'fa-solid',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                ],
            ]
        );

        // -- Control: Image
        $this->add_control(
            'image',
            [
                'label'     => __( 'Choose Image', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'graphic_element' => 'image',
                ],
            ]
        );

        // Add new control for the text graphic
        $this->add_control(
            'graphic_text',
            [
                'label'     => __( 'Text', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => '01',
                'condition' => [
                    'graphic_element' => 'text',
                ],
            ]
        );

        // -- Control: Badge
        $this->add_control(
            'badge_text',
            [
                'label'       => __( 'Badge', 'ababil' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'e.g. New', 'ababil' ),
                'separator'   => 'before',
            ]
        );

        // -- Control: Styled Heading (Repeater)
        $repeater = new \Elementor\Repeater();

        $repeater->start_controls_tabs( 'heading_part_tabs' );

        // Tab: Content
        $repeater->start_controls_tab( 'tab_content', [ 'label' => esc_html__( 'Content', 'ababil' ) ] );
        $repeater->add_control(
            'heading_part',
            [
                'label'       => esc_html__( 'Text', 'ababil' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Styled Text', 'ababil' ),
                'label_block' => true,
                'dynamic'     => [ 'active' => true ],
            ]
        );
        $repeater->end_controls_tab();

        // Tab: Style
        $repeater->start_controls_tab( 'tab_style', [ 'label' => esc_html__( 'Style', 'ababil' ) ] );
        $repeater->add_control(
            'part_color',
            [
                'label'     => esc_html__( 'Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .ababil-content-box-heading {{CURRENT_ITEM}}' => 'color: {{VALUE}}' ],
            ]
        );
        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'part_typography',
                'selector' => '{{WRAPPER}} .ababil-content-box-heading {{CURRENT_ITEM}}',
            ]
        );
        $repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'part_background',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ababil-content-box-heading {{CURRENT_ITEM}}',
                'separator'=> 'before',
            ]
        );
        $repeater->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'part_border',
                'selector' => '{{WRAPPER}} .ababil-content-box-heading {{CURRENT_ITEM}}',
            ]
        );
        $repeater->add_responsive_control(
            'part_padding',
            [
                'label'      => esc_html__( 'Padding', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [ '{{WRAPPER}} .ababil-content-box-heading {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );
        $repeater->add_responsive_control(
            'part_margin',
            [
                'label'      => esc_html__( 'Margin', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [ '{{WRAPPER}} .ababil-content-box-heading {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );
        $repeater->add_responsive_control(
            'part_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [ '{{WRAPPER}} .ababil-content-box-heading {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );
        $repeater->add_control(
            'part_display',
            [
                'label'     => esc_html__( 'Display', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    ''            => esc_html__( 'Default', 'ababil' ),
                    'inline-block'=> esc_html__( 'Inline-Block', 'ababil' ),
                    'block'       => esc_html__( 'Block', 'ababil' ),
                ],
                'default'   => 'inline-block',
                'selectors' => [ '{{WRAPPER}} .ababil-content-box-heading {{CURRENT_ITEM}}' => 'display: {{VALUE}}' ],
            ]
        );
        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $this->add_control(
            'heading_parts',
            [
                'label'       => __( 'Heading', 'ababil' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [ 'heading_part' => esc_html__( 'Flexible', 'ababil' ), 'part_typography_font_weight' => 'bold' ],
                    [ 'heading_part' => esc_html__( ' Content Box', 'ababil' ) ],
                ],
                'title_field' => '{{{ heading_part }}}',
                'separator'   => 'before',
            ]
        );

        // -- Heading Tag
        $this->add_control(
            'heading_tag',
            [
                'label'   => esc_html__( 'Heading HTML Tag', 'ababil' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ],
                'default' => 'h3',
            ]
        );

        // -- Sub Heading
        $this->add_control(
            'sub_heading',
            [
                'label'       => __( 'Sub Heading', 'ababil' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __( 'This is a subheading for the content box.', 'ababil' ),
                'placeholder' => __( 'Enter your sub heading', 'ababil' ),
                'separator'   => 'before',
            ]
        );
        // Add sub heading tag selector
        $this->add_control(
            'sub_heading_tag',
            [
                'label'   => esc_html__( 'Sub Heading HTML Tag', 'ababil' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ],
                'default' => 'div',
                'condition' => [ 'sub_heading!' => '' ],
            ]
        );

        // -- Description
        $this->add_control(
            'description',
            [
                'label'       => __( 'Description', 'ababil' ),
                'type'        => \Elementor\Controls_Manager::WYSIWYG,
                'default'     => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ababil' ),
                'placeholder' => __( 'Enter your description', 'ababil' ),
            ]
        );

        // -- Button Controls
        $this->add_control(
            'button_text',
            [
                'label'       => __( 'Button Text', 'ababil' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'Learn More', 'ababil' ),
                'placeholder' => __( 'Read More', 'ababil' ),
                'separator'   => 'before',
            ]
        );
        $this->add_control(
            'button_link',
            [
                'label'         => __( 'Button Link', 'ababil' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => __( 'https://your-link.com', 'ababil' ),
                'show_external' => true,
                'dynamic'       => [ 'active' => true ],
                'default'       => [
                    'url'        => '#',
                    'is_external'=> false,
                    'nofollow'   => false,
                ],
            ]
        );
        $this->add_control(
            'button_icon',
            [
                'label' => __( 'Button Icon', 'ababil' ),
                'type'  => \Elementor\Controls_Manager::ICONS,
            ]
        );
        $this->add_control(
            'button_icon_position',
            [
                'label'     => __( 'Icon Position', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'right',
                'options'   => [
                    'left'  => __( 'Left', 'ababil' ),
                    'right' => __( 'Right', 'ababil' ),
                ],
                'condition' => [ 'button_icon[value]!' => '' ],
            ]
        );
        $this->end_controls_section();

        //======================================================================================
        // II. STYLE TAB
        //======================================================================================

        // -- Box Style
        $this->start_controls_section(
            'box_style_section',
            [
                'label' => __( 'Box', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'alignment',
            [
                'label'     => esc_html__( 'Alignment', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [ 'title' => esc_html__( 'Left', 'ababil' ),   'icon' => 'eicon-text-align-left' ],
                    'center' => [ 'title' => esc_html__( 'Center', 'ababil' ), 'icon' => 'eicon-text-align-center' ],
                    'right'  => [ 'title' => esc_html__( 'Right', 'ababil' ),  'icon' => 'eicon-text-align-right' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'box_background',
                'selector' => '{{WRAPPER}} .ababil-content-box',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'selector' => '{{WRAPPER}} .ababil-content-box',
            ]
        );
        $this->add_responsive_control(
            'box_border_radius',
            [
                'label'      => __( 'Border Radius', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-content-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'selector' => '{{WRAPPER}} .ababil-content-box',
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __( 'Box Padding', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-content-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => __( 'Content Padding', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-content-box-text-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // -- Icon & Image & Text Style
        $this->start_controls_section(
            'graphic_style_section',
            [
                'label'     => __( 'Icon, Image & Text', 'ababil' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'graphic_element!' => 'none' ],
            ]
        );
        $this->add_responsive_control(
            'graphic_spacing',
            [
                'label'     => esc_html__( 'Spacing', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-graphic' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_style_heading',
            [
                'label'     => esc_html__( 'Icon', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'graphic_element' => 'icon' ],
            ]
        );
        $this->add_control(
            'icon_view',
            [
                'label'     => esc_html__( 'View', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    'default' => esc_html__( 'Default', 'ababil' ),
                    'framed'  => esc_html__( 'Framed', 'ababil' ),
                ],
                'default'   => 'default',
                'prefix_class' => 'ababil-icon-view-',
                'condition' => [ 'graphic_element' => 'icon' ],
            ]
        );
        $this->start_controls_tabs(
            'icon_colors',
            [
                'condition' => [ 'graphic_element' => 'icon' ],
            ]
        );
        $this->start_controls_tab(
            'icon_colors_normal',
            [
                'label' => __( 'Normal', 'ababil' ),
                'condition' => [ 'graphic_element' => 'icon' ],
            ]
        );
        $this->add_control(
            'icon_primary_color',
            [
                'label'     => __( 'Primary Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-icon i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ababil-content-box-icon svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}}.ababil-icon-view-framed .ababil-content-box-icon'  => 'border-color: {{VALUE}};',
                ],
                'condition' => [ 'graphic_element' => 'icon' ],
            ]
        );
        $this->add_control(
            'icon_secondary_color',
            [
                'label'     => __( 'Secondary Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.ababil-icon-view-framed .ababil-content-box-icon' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                    'icon_view' => 'framed',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'icon_colors_hover',
            [
                'label' => __( 'Hover', 'ababil' ),
                'condition' => [ 'graphic_element' => 'icon' ],
            ]
        );
        $this->add_control(
            'icon_primary_color_hover',
            [
                'label'     => __( 'Primary Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-icon:hover i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ababil-content-box-icon:hover svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}}.ababil-icon-view-stacked .ababil-content-box-icon:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.ababil-icon-view-framed .ababil-content-box-icon:hover'  => 'border-color: {{VALUE}};',
                ],
                'condition' => [ 'graphic_element' => 'icon' ],
            ]
        );
        $this->add_control(
            'icon_secondary_color_hover',
            [
                'label'     => __( 'Secondary Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.ababil-icon-view-framed .ababil-content-box-icon:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'graphic_element' => 'icon',
                    'icon_view' => 'framed',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        // Add Text Style controls
        $this->add_control(
            'text_style_heading',
            [
                'label'     => esc_html__( 'Text', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'graphic_element' => 'text' ],
            ]
        );

        $this->add_control(
            'text_view',
            [
                'label'     => esc_html__( 'View', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    'default' => esc_html__( 'Default', 'ababil' ),
                    'framed'  => esc_html__( 'Framed', 'ababil' ),
                ],
                'default'   => 'default',
                'prefix_class' => 'ababil-text-view-',
                'condition' => [ 'graphic_element' => 'text' ],
            ]
        );

        $this->start_controls_tabs(
            'text_colors',
            [
                'condition' => [ 'graphic_element' => 'text' ],
            ]
        );

        $this->start_controls_tab(
            'text_colors_normal',
            [
                'label' => __( 'Normal', 'ababil' ),
                'condition' => [ 'graphic_element' => 'text' ],
            ]
        );

        $this->add_control(
            'text_primary_color',
            [
                'label'     => __( 'Primary Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.ababil-text-view-framed .ababil-content-box-text'  => 'border-color: {{VALUE}};',
                ],
                'condition' => [ 'graphic_element' => 'text' ],
            ]
        );

        $this->add_control(
            'text_secondary_color',
            [
                'label'     => __( 'Secondary Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.ababil-text-view-framed .ababil-content-box-text' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'graphic_element' => 'text',
                    'text_view' => 'framed',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'text_colors_hover',
            [
                'label' => __( 'Hover', 'ababil' ),
                'condition' => [ 'graphic_element' => 'text' ],
            ]
        );

        $this->add_control(
            'text_primary_color_hover',
            [
                'label'     => __( 'Primary Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-text:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.ababil-text-view-framed .ababil-content-box-text:hover'  => 'border-color: {{VALUE}};',
                ],
                'condition' => [ 'graphic_element' => 'text' ],
            ]
        );

        $this->add_control(
            'text_secondary_color_hover',
            [
                'label'     => __( 'Secondary Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.ababil-text-view-framed .ababil-content-box-text:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'graphic_element' => 'text',
                    'text_view' => 'framed',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'      => 'text_typography',
                'selector'  => '{{WRAPPER}} .ababil-content-box-text',
                'condition' => [ 'graphic_element' => 'text' ],
            ]
        );

        $this->add_responsive_control(
            'text_rotate',
            [
                'label'     => __( 'Rotate', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'deg', 'grad', 'rad', 'turn' ],
                'default'   => [ 'unit' => 'deg', 'size' => 0 ],
                'range'     => [
                    'deg' => [ 'min' => 0, 'max' => 360 ],
                    'grad' => [ 'min' => 0, 'max' => 400 ],
                    'rad' => [ 'min' => 0, 'max' => 6.2832 ],
                    'turn' => [ 'min' => 0, 'max' => 1 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-text' => 'transform: rotate({{SIZE}}{{UNIT}}); display: inline-block;',
                ],
                'condition' => [ 'graphic_element' => 'text' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'text_border',
                'selector'  => '{{WRAPPER}} .ababil-content-box-text',
                'condition' => [ 'graphic_element' => 'text' ],
            ]
        );

        $this->add_responsive_control(
            'text_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-content-box-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [ 'graphic_element' => 'text' ],
            ]
        );

        $this->add_responsive_control(
            'text_padding',
            [
                'label'      => esc_html__( 'Padding', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-content-box-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [ 'graphic_element' => 'text' ],
            ]
        );


        $this->add_responsive_control(
            'icon_box_size',
            [
                'label'     => __( 'Box Size', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 20, 'max' => 200 ] ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; display: inline-flex; align-items: center; justify-content: center;',
                ],
                'condition' => [ 'graphic_element' => 'icon' ],
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => __( 'Icon Size', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 6, 'max' => 300 ] ],
                'default'   => [ 'unit' => 'px', 'size' => 30 ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ababil-content-box-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'graphic_element' => 'icon' ],
            ]
        );
        $this->add_responsive_control(
            'icon_rotate',
            [
                'label'     => __( 'Rotate', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'deg', 'grad', 'rad', 'turn' ],
                'default'   => [ 'unit' => 'deg', 'size' => 0 ],
                'range'     => [
                    'deg' => [ 'min' => 0, 'max' => 360 ],
                    'grad' => [ 'min' => 0, 'max' => 400 ],
                    'rad' => [ 'min' => 0, 'max' => 6.2832 ],
                    'turn' => [ 'min' => 0, 'max' => 1 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-icon i, {{WRAPPER}} .ababil-content-box-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
                'condition' => [ 'graphic_element' => 'icon' ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border',
                'selector' => '{{WRAPPER}} .ababil-content-box-icon',
                'condition'=> [ 'graphic_element' => 'icon' ],
            ]
        );
        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-content-box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [ 'graphic_element' => 'icon' ],
            ]
        );
        $this->add_control(
            'image_style_heading',
            [
                'label'     => esc_html__( 'Image', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'graphic_element' => 'image' ],
            ]
        );
        $this->add_responsive_control(
            'image_width',
            [
                'label'     => __( 'Width', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units'=> [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'graphic_element' => 'image' ],
            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label'     => __( 'Height', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units'=> [ 'px', 'vh' ],
                'range'     => [
                    'px' => [ 'min' => 20, 'max' => 1000 ],
                    'vh' => [ 'min' => 1, 'max' => 100 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-image img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'graphic_element' => 'image' ],
            ]
        );
        $this->add_control(
            'image_object_fit',
            [
                'label'     => esc_html__( 'Object Fit', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    ''       => esc_html__( 'Default', 'ababil' ),
                    'fill'   => esc_html__( 'Fill', 'ababil' ),
                    'cover'  => esc_html__( 'Cover', 'ababil' ),
                    'contain'=> esc_html__( 'Contain', 'ababil' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-image img' => 'object-fit: {{VALUE}};',
                ],
                'condition' => [ 'graphic_element' => 'image' ],
            ]
        );
        $this->add_control(
            'image_object_position',
            [
                'label' => esc_html__( 'Object Position', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'center center' => esc_html__( 'Center Center', 'ababil' ),
                    'center top' => esc_html__( 'Center Top', 'ababil' ),
                    'center bottom' => esc_html__( 'Center Bottom', 'ababil' ),
                    'left top' => esc_html__( 'Left Top', 'ababil' ),
                    'left center' => esc_html__( 'Left Center', 'ababil' ),
                    'left bottom' => esc_html__( 'Left Bottom', 'ababil' ),
                    'right top' => esc_html__( 'Right Top', 'ababil' ),
                    'right center' => esc_html__( 'Right Center', 'ababil' ),
                    'right bottom' => esc_html__( 'Right Bottom', 'ababil' ),
                    'custom' => esc_html__( 'Custom', 'ababil' ),
                ],
                'default' => 'center center',
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-image img' => 'object-position: {{VALUE}};',
                ],
                'condition' => [ 'graphic_element' => 'image' ],
            ]
        );
        $this->add_responsive_control(
            'image_object_position_custom',
            [
                'label' => esc_html__( 'Custom Object Position', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [ 'min' => -100, 'max' => 100 ],
                    'px' => [ 'min' => -1000, 'max' => 1000 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-image img' => 'object-position: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'graphic_element' => 'image',
                    'image_object_position' => 'custom',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'image_border',
                'selector' => '{{WRAPPER}} .ababil-content-box-image img',
                'condition'=> [ 'graphic_element' => 'image' ],
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __( 'Border Radius', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-content-box-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [ 'graphic_element' => 'image' ],
            ]
        );
        $this->end_controls_section();

        // -- Style Tab: Badge
        $this->start_controls_section(
            'badge_style_section',
            [
                'label' => __( 'Badge', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'badge_text!' => '' ],
            ]
        );
        $this->add_control(
            'badge_width_type',
            [
                'label' => __( 'Badge Width', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => __( 'Default (auto)', 'ababil' ),
                    'fit-content' => __( 'Fit Content', 'ababil' ),
                    'full' => __( 'Full Width', 'ababil' ),
                    'inline' => __( 'Inline Auto', 'ababil' ),
                    'custom' => __( 'Custom', 'ababil' ),
                ],
                'default' => 'fit-content',
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-badge' => 'width: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'badge_width_custom',
            [
                'label' => __( 'Custom Width', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'vw' ],
                'range' => [
                    'px' => [ 'min' => 10, 'max' => 1000 ],
                    '%' => [ 'min' => 1, 'max' => 100 ],
                    'em' => [ 'min' => 1, 'max' => 50 ],
                    'vw' => [ 'min' => 1, 'max' => 100 ],
                ],
                'condition' => [
                    'badge_width_type' => 'custom',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-badge' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'badge_width_css_helper',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => '',
                'content_classes' => 'elementor-hidden',
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-badge' => 
                        '{{badge_width_type:fit-content}}width:fit-content;display:inline-block;{{/badge_width_type}}' .
                        '{{badge_width_type:full}}width:100%;display:block;{{/badge_width_type}}' .
                        '{{badge_width_type:inline}}width:auto;display:inline-block;{{/badge_width_type}}' .
                        '{{badge_width_type:custom}}display:inline-block;{{/badge_width_type}}',
                ],
            ]
        );
        $this->add_control(
            'badge_alignment_helper',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => '',
                'content_classes' => 'elementor-hidden',
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-badge' => 'text-align: inherit;',
                ],
                'condition' => [ 'badge_text!' => '' ],
            ]
        );
        $this->start_controls_tabs( 'badge_tabs' );
        $this->start_controls_tab(
            'badge_normal_tab',
            [
                'label' => __( 'Normal', 'ababil' ),
            ]
        );
        $this->add_control(
            'badge_color',
            [
                'label'     => __( 'Text Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-badge' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'badge_bg_color',
            [
                'label'     => __( 'Background Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'badge_typography',
                'selector' => '{{WRAPPER}} .ababil-content-box-badge',
            ]
        );
        $this->add_responsive_control(
            'badge_spacing',
            [
                'label'     => __( 'Spacing', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-badge' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'badge_margin',
            [
                'label'      => __( 'Margin', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-content-box-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'badge_padding',
            [
                'label'      => __( 'Padding', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-content-box-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'badge_border',
                'selector' => '{{WRAPPER}} .ababil-content-box-badge',
            ]
        );
        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label'      => __( 'Border Radius', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-content-box-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'badge_box_shadow',
                'selector' => '{{WRAPPER}} .ababil-content-box-badge',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'badge_hover_tab',
            [
                'label' => __( 'Hover', 'ababil' ),
            ]
        );
        $this->add_control(
            'badge_color_hover',
            [
                'label'     => __( 'Text Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-badge:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'badge_bg_color_hover',
            [
                'label'     => __( 'Background Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-badge:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'badge_border_color_hover',
            [
                'label'     => __( 'Border Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-badge:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'badge_box_shadow_hover',
                'selector' => '{{WRAPPER}} .ababil-content-box-badge:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // -- Style Tab: Heading
        $this->start_controls_section(
            'heading_style_section',
            [
                'label' => __( 'Heading', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'global_heading_color',
            [
                'label'     => __( 'Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-heading span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'global_heading_typography',
                'label'    => __( 'Typography', 'ababil' ),
                'selector' => '{{WRAPPER}} .ababil-content-box-heading span',
            ]
        );
        $this->add_responsive_control(
            'global_heading_margin',
            [
                'label'      => __( 'Margin', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-content-box-heading span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'global_heading_padding',
            [
                'label'      => __( 'Padding', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-content-box-heading span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'heading_spacing',
            [
                'label'     => __( 'Spacing', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // -- Style Tab: Sub Heading
        $this->start_controls_section(
            'sub_heading_style_section',
            [
                'label'     => __( 'Sub Heading', 'ababil' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'sub_heading!' => '' ],
            ]
        );
        $this->add_control(
            'sub_heading_color',
            [
                'label'     => __( 'Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-subheading' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'sub_heading_typography',
                'selector' => '{{WRAPPER}} .ababil-content-box-subheading',
            ]
        );
        $this->add_responsive_control(
            'sub_heading_spacing',
            [
                'label'     => __( 'Spacing', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-subheading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // -- Style Tab: Description
        $this->start_controls_section(
            'description_style_section',
            [
                'label'     => __( 'Description', 'ababil' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'description!' => '' ],
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label'     => __( 'Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .ababil-content-box-description',
            ]
        );
        $this->add_responsive_control(
            'description_spacing',
            [
                'label'     => __( 'Spacing', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // -- Style Tab: Button
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => __( 'Button', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'button_text!' => '' ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .ababil-content-box-button',
            ]
        );
        $this->start_controls_tabs( 'button_tabs' );
        $this->start_controls_tab( 'button_normal_tab', [ 'label' => __( 'Normal', 'ababil' ) ] );
        $this->add_control(
            'button_text_color',
            [
                'label'     => __( 'Text Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-button' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_bg_color',
            [
                'label'     => __( 'Background Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'button_hover_tab', [ 'label' => __( 'Hover', 'ababil' ) ] );
        $this->add_control(
            'button_text_color_hover',
            [
                'label'     => __( 'Text Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_bg_color_hover',
            [
                'label'     => __( 'Background Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_border_color_hover',
            [
                'label'     => __( 'Border Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .ababil-content-box-button',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'button_border_radius',
            [
                'label'      => __( 'Border Radius', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors'  => [
                    '{{WRAPPER}} .ababil-content-box-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; display: inline-flex; align-items: center;',
                    '{{WRAPPER}} .ababil-content-box-button .ababil-button-icon svg' => 'width: 1em; height: 1em;',
                ],
            ]
        );        
        $this->add_responsive_control(
            'button_icon_size',
            [
                'label' => __( 'Button Icon Size', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [ 'px' => [ 'min' => 6, 'max' => 300 ] ],
                'default' => [ 'unit' => 'px', 'size' => 20 ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-button .icon-left i, {{WRAPPER}} .ababil-content-box-button .icon-right i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ababil-content-box-button .icon-left svg, {{WRAPPER}} .ababil-content-box-button .icon-right svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'button_icon[value]!' => '' ],
            ]
        );
        $this->add_responsive_control(
            'button_icon_vertical_align',
            [
                'label' => __( 'Icon Vertical Offset', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [ 'min' => -30, 'max' => 30 ],
                    'em' => [ 'min' => -2, 'max' => 2, 'step' => 0.1 ],
                    '%' => [ 'min' => -20, 'max' => 20 ],
                ],
                'default' => [ 'size' => 0, 'unit' => 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-button .ababil-button-icon' => 'position: relative; top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'button_icon[value]!' => '' ],
            ]
        );
        // Left icon spacing
        $this->add_responsive_control(
            'button_icon_spacing_left',
            [
                'label' => __( 'Icon Spacing', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [ 'px' => [ 'max' => 50 ] ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-button .icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'button_icon[value]!' => '', 'button_icon_position' => 'left' ],
            ]
        );
        // Right icon spacing
        $this->add_responsive_control(
            'button_icon_spacing_right',
            [
                'label' => __( 'Icon Spacing', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [ 'px' => [ 'max' => 50 ] ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-button .icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'button_icon[value]!' => '', 'button_icon_position' => 'right' ],
            ]
        );
        $this->add_responsive_control(
            'button_icon_vertical_align',
            [
                'label' => __( 'Icon Vertical Offset', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [ 'min' => -30, 'max' => 30 ],
                    'em' => [ 'min' => -2, 'max' => 2, 'step' => 0.1 ],
                    '%' => [ 'min' => -20, 'max' => 20 ],
                ],
                'default' => [ 'size' => 0, 'unit' => 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-content-box-button .ababil-button-icon' => 'position: relative; top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'button_icon[value]!' => '' ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="ababil-content-box">
             <?php
            // -- 1. Render Graphic: Icon, Image or Text
            if ( 'none' !== $settings['graphic_element'] ) : ?>
                <div class="ababil-content-box-graphic">
                    <?php if ( 'icon' === $settings['graphic_element'] && ! empty( $settings['icon']['value'] ) ) : ?>
                        <span class="ababil-content-box-icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </span>
                    <?php elseif ( 'image' === $settings['graphic_element'] && ! empty( $settings['image']['url'] ) ) : ?>
                        <span class="ababil-content-box-image">
                            <?php printf( '<img src="%s" alt="">', esc_url( $settings['image']['url'] ) ); ?>
                        </span>
                    <?php elseif ( 'text' === $settings['graphic_element'] && ! empty( $settings['graphic_text'] ) ) : ?>
                        <span class="ababil-content-box-text" style="transform: rotate(<?php echo esc_attr($settings['text_rotate']['size'] . $settings['text_rotate']['unit']); ?>);">
                            <?php echo esc_html($settings['graphic_text']); ?>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="ababil-content-box-text-wrapper">
                <?php
                // -- 2. Render Badge
                if ( ! empty( $settings['badge_text'] ) ) {
                    printf( '<div class="ababil-content-box-badge">%s</div>', esc_html( $settings['badge_text'] ) );
                }

                // -- 3. Render Styled Heading
                if ( ! empty( $settings['heading_parts'] ) ) {
                    $heading_tag = \Elementor\Utils::validate_html_tag( $settings['heading_tag'] );
                    printf( '<%s class="ababil-content-box-heading">', esc_attr( $heading_tag ) );
                    foreach ( $settings['heading_parts'] as $item ) {
                        $repeater_key = 'heading_part_' . $item['_id'];
                        $this->add_render_attribute( $repeater_key, 'class', 'elementor-repeater-item-' . $item['_id'] );
                        printf( '<span %s>%s</span>', $this->get_render_attribute_string( $repeater_key ), esc_html( $item['heading_part'] ) );
                    }
                    printf( '</%s>', esc_attr( $heading_tag ) );
                }

                // -- 4. Render Sub Heading & Description
                if ( ! empty( $settings['sub_heading'] ) ) {
                    $sub_heading_tag = isset($settings['sub_heading_tag']) ? \Elementor\Utils::validate_html_tag($settings['sub_heading_tag']) : 'div';
                    printf( '<%1$s class="ababil-content-box-subheading">%2$s</%1$s>', esc_attr( $sub_heading_tag ), wp_kses_post( $settings['sub_heading'] ) );
                }
                if ( ! empty( $settings['description'] ) ) {
                    printf( '<div class="ababil-content-box-description">%s</div>', wp_kses_post( $settings['description'] ) );
                }

                // -- 6. Render Button
                if ( ! empty( $settings['button_text'] ) && ! empty( $settings['button_link']['url'] ) ) {
                    $this->add_link_attributes( 'button', $settings['button_link'] );
                    $this->add_render_attribute( 'button', 'class', 'ababil-content-box-button' );
                    ?>
                    <div class="ababil-content-box-button-wrapper">
                        <a <?php $this->print_render_attribute_string( 'button' ); ?>>
                            <?php if ( ! empty( $settings['button_icon']['value'] ) && 'left' === $settings['button_icon_position'] ) : ?>
                                <span class="ababil-button-icon icon-left">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                            <?php endif; ?>
                            <span class="ababil-button-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
                            <?php if ( ! empty( $settings['button_icon']['value'] ) && 'right' === $settings['button_icon_position'] ) : ?>
                                <span class="ababil-button-icon icon-right">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }

    /**
     * Render widget output in the editor (JS template)
     */
    protected function content_template() {
        ?>
        <#
        var headingTag = elementor.helpers.validateHTMLTag( settings.heading_tag || 'h3' );
        var subHeadingTag = elementor.helpers.validateHTMLTag( settings.sub_heading_tag || 'div' );
        #>
        <div class="ababil-content-box">
            <# if ( 'none' !== settings.graphic_element ) { #>
                <div class="ababil-content-box-graphic">
                    <# if ( 'icon' === settings.graphic_element && settings.icon.value ) { #>
                        <span class="ababil-content-box-icon">
                            <# var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' ); #>
                            {{{ iconHTML.value }}}
                        </span>
                    <# } else if ( 'image' === settings.graphic_element && settings.image.url ) { #>
                        <span class="ababil-content-box-image">
                            <img src="{{{ settings.image.url }}}" alt="">
                        </span>
                    <# } else if ( 'text' === settings.graphic_element && settings.graphic_text ) { #>
                        <span class="ababil-content-box-text">
                            {{{ settings.graphic_text }}}
                        </span>
                    <# } #>
                </div>
            <# } #>

            <div class="ababil-content-box-text-wrapper">
                <# if ( settings.badge_text ) { #>
                    <div class="ababil-content-box-badge">{{{ settings.badge_text }}}</div>
                <# } #>

                <# if ( settings.heading_parts.length ) { #>
                    <{{ headingTag }} class="ababil-content-box-heading">
                        <# _.each( settings.heading_parts, function( item ) { #>
                            <span class="elementor-repeater-item-{{ item._id }}">{{{ item.heading_part }}}</span>
                        <# } ); #>
                    </{{ headingTag }}>
                <# } #>

                <# if ( settings.sub_heading ) { #>
                    <{{ subHeadingTag }} class="ababil-content-box-subheading">{{{ settings.sub_heading }}}</{{ subHeadingTag }}>
                <# } #>

                <# if ( settings.description ) { #>
                    <div class="ababil-content-box-description">{{{ settings.description }}}</div>
                <# } #>

                <# if ( settings.button_text && settings.button_link.url ) { #>
                    <div class="ababil-content-box-button-wrapper">
                        <a href="{{ settings.button_link.url }}" class="ababil-content-box-button">
                            <# if ( settings.button_icon.value && 'left' === settings.button_icon_position ) { #>
                                <span class="ababil-button-icon icon-left">
                                    <# var buttonIconHTML = elementor.helpers.renderIcon( view, settings.button_icon, { 'aria-hidden': true }, 'i' , 'object' ); #>
                                    {{{ buttonIconHTML.value }}}
                                </span>
                            <# } #>
                            <span class="ababil-button-text">{{{ settings.button_text }}}</span>
                            <# if ( settings.button_icon.value && 'right' === settings.button_icon_position ) { #>
                                <span class="ababil-button-icon icon-right">
                                    <# var buttonIconHTML = elementor.helpers.renderIcon( view, settings.button_icon, { 'aria-hidden': true }, 'i' , 'object' ); #>
                                    {{{ buttonIconHTML.value }}}
                                </span>
                            <# } #>
                        </a>
                    </div>
                <# } #>
            </div>
        </div>
        <?php
    }
}