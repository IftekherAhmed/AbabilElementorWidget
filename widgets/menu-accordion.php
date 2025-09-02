<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Ababil Menu Accordion Widget for Elementor
 */
class Ababil_Menu_Accordion_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ababil-menu-accordion';
    }

    public function get_title() {
        return __( 'Menu Accordion', 'ababil' );
    }

    public function get_icon() {
        return 'eicon-navigation-vertical';
    }

    public function get_categories() {
        return [ 'ababil' ];
    }

    public function get_keywords() {
        return [ 'menu', 'accordion', 'navigation', 'dropdown', 'ababil' ];
    }

    public function get_style_depends() {
        return [ 'ababil-menu-accordion' ];
    }

    public function get_script_depends() {
        return [ 'ababil-menu-accordion' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Menu Settings', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $menus = wp_get_nav_menus();
        $menu_options = [];
        
        foreach ( $menus as $menu ) {
            $menu_options[$menu->slug] = $menu->name;
        }

        $this->add_control(
            'menu',
            [
                'label' => __( 'Select Menu', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $menu_options,
                'default' => !empty($menu_options) ? array_key_first($menu_options) : '',
            ]
        );

        $this->add_control(
            'show_indicators',
            [
                'label' => __( 'Show Indicators', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'ababil' ),
                'label_off' => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'indicator_type',
            [
                'label' => __( 'Indicator Type', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'numbers' => __( 'Numbers', 'ababil' ),
                    'roman' => __( 'Roman Numerals', 'ababil' ),
                    'alphabetic' => __( 'Alphabetic', 'ababil' ),
                    'icon' => __( 'Icon', 'ababil' ),
                ],
                'default' => 'numbers',
                'condition' => [
                    'show_indicators' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'indicator_icon',
            [
                'label' => __( 'Indicator Icon', 'ababil' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_indicators' => 'yes',
                    'indicator_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'indicator_display',
            [
                'label' => __( 'Show Indicators For', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'both' => __( 'Both Parent and Child', 'ababil' ),
                    'parent' => __( 'Parent Only', 'ababil' ),
                    'child' => __( 'Child Only', 'ababil' ),
                ],
                'default' => 'both',
                'condition' => [
                    'show_indicators' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'accordion_behavior',
            [
                'label' => __( 'Behavior', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'accordion' => __( 'Accordion (only one open at a time)', 'ababil' ),
                    'toggle' => __( 'Toggle (multiple can be open)', 'ababil' ),
                ],
                'default' => 'accordion',
            ]
        );

        $this->add_control(
            'default_state',
            [
                'label' => __( 'Default State', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'all_closed' => __( 'All items closed', 'ababil' ),
                    'first_open' => __( 'First item open', 'ababil' ),
                    'all_open' => __( 'All items open', 'ababil' ),
                ],
                'default' => 'all_closed',
            ]
        );

        $this->add_control(
            'open_submenu_on_active',
            [
                'label' => __( 'Open Submenu on Active', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'ababil' ),
                'label_off' => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => __( 'Automatically open submenu when a submenu item is active.', 'ababil' ),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Toggle Icon', 'ababil' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-down',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'chevron-down',
                        'angle-down',
                        'angle-double-down',
                        'caret-down',
                        'caret-square-down',
                    ],
                    'fa-regular' => [
                        'caret-square-down',
                    ],
                ],
            ]
        );

        $this->add_control(
            'active_icon',
            [
                'label' => __( 'Active Toggle Icon', 'ababil' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-up',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'chevron-up',
                        'angle-up',
                        'angle-double-up',
                        'caret-up',
                        'caret-square-up',
                    ],
                    'fa-regular' => [
                        'caret-square-up',
                    ],
                ],
                'condition' => [
                    'icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label' => __( 'Icon Position', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'left' => __( 'Left', 'ababil' ),
                    'right' => __( 'Right', 'ababil' ),
                ],
                'default' => 'right',
                'condition' => [
                    'icon[value]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'container_style',
            [
                'label' => __( 'Container', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ababil-menu-accordion',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion',
            ]
        );

        $this->add_control(
            'container_border_radius',
            [
                'label' => __( 'Border Radius', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'menu_item_style',
            [
                'label' => __( 'Menu Items', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'menu_item_typography',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-header a',
            ]
        );

        $this->start_controls_tabs( 'menu_item_tabs' );

        $this->start_controls_tab( 'menu_item_normal', [ 'label' => __( 'Normal', 'ababil' ) ] );

        $this->add_control(
            'menu_item_color',
            [
                'label' => __( 'Text Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-header a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'menu_item_background',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-header' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'menu_item_border',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-header',
            ]
        );

        $this->add_control(
            'menu_item_border_radius',
            [
                'label' => __( 'Border Radius', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_item_padding',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_item_margin',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'menu_item_box_shadow',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-header',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'menu_item_hover', [ 'label' => __( 'Hover', 'ababil' ) ] );

        $this->add_control(
            'menu_item_hover_color',
            [
                'label' => __( 'Text Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-header:hover a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'menu_item_hover_background',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-header:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'menu_item_border_hover',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-header:hover',
            ]
        );

        $this->add_control(
            'menu_item_border_radius_hover',
            [
                'label' => __( 'Border Radius', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-header:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_item_padding_hover',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-header:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_item_margin_hover',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-header:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'menu_item_box_shadow_hover',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-header:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'menu_item_active', [ 'label' => __( 'Active', 'ababil' ) ] );

        $this->add_control(
            'menu_item_active_color',
            [
                'label' => __( 'Text Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-item.active .ababil-menu-accordion-header a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'menu_item_active_background',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-item.active .ababil-menu-accordion-header' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'menu_item_border_active',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-item.active .ababil-menu-accordion-header',
            ]
        );

        $this->add_control(
            'menu_item_border_radius_active',
            [
                'label' => __( 'Border Radius', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-item.active .ababil-menu-accordion-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_item_padding_active',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-item.active .ababil-menu-accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_item_margin_active',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-item.active .ababil-menu-accordion-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'menu_item_box_shadow_active',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-item.active .ababil-menu-accordion-header',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'submenu_style',
            [
                'label' => __( 'Submenu Container', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'submenu_tabs' );

        $this->start_controls_tab( 'submenu_normal', [ 'label' => __( 'Normal', 'ababil' ) ] );

        $this->add_control(
            'submenu_background',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'submenu_border',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-submenu',
            ]
        );

        $this->add_control(
            'submenu_border_radius',
            [
                'label' => __( 'Border Radius', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_padding',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_margin',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submenu_box_shadow',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-submenu',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'submenu_hover', [ 'label' => __( 'Hover', 'ababil' ) ] );

        $this->add_control(
            'submenu_hover_background',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'submenu_border_hover',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-submenu:hover',
            ]
        );

        $this->add_control(
            'submenu_border_radius_hover',
            [
                'label' => __( 'Border Radius', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_padding_hover',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_margin_hover',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submenu_box_shadow_hover',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-submenu:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'submenu_indent',
            [
                'label' => __( 'Indent', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 100 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-list' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // NEW: Add a section for submenu items styling
        $this->start_controls_section(
            'submenu_items_style',
            [
                'label' => __( 'Submenu Items', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'submenu_item_typography',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-header a',
            ]
        );

        $this->start_controls_tabs( 'submenu_item_tabs' );

        $this->start_controls_tab( 'submenu_item_normal', [ 'label' => __( 'Normal', 'ababil' ) ] );

        $this->add_control(
            'submenu_item_color',
            [
                'label' => __( 'Text Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-header a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submenu_item_background',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-header' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'submenu_item_border',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-header',
            ]
        );

        $this->add_control(
            'submenu_item_border_radius',
            [
                'label' => __( 'Border Radius', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_item_padding',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_item_margin',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submenu_item_box_shadow',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-header',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'submenu_item_hover', [ 'label' => __( 'Hover', 'ababil' ) ] );

        $this->add_control(
            'submenu_item_hover_color',
            [
                'label' => __( 'Text Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-header:hover a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submenu_item_hover_background',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-header:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'submenu_item_border_hover',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-header:hover',
            ]
        );

        $this->add_control(
            'submenu_item_border_radius_hover',
            [
                'label' => __( 'Border Radius', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-header:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_item_padding_hover',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-header:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_item_margin_hover',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-header:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submenu_item_box_shadow_hover',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-header:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'submenu_item_active', [ 'label' => __( 'Active', 'ababil' ) ] );

        $this->add_control(
            'submenu_item_active_color',
            [
                'label' => __( 'Text Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-item.active .ababil-menu-accordion-header a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submenu_item_active_background',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-item.active .ababil-menu-accordion-header' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'submenu_item_border_active',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-item.active .ababil-menu-accordion-header',
            ]
        );

        $this->add_control(
            'submenu_item_border_radius_active',
            [
                'label' => __( 'Border Radius', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-item.active .ababil-menu-accordion-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_item_padding_active',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-item.active .ababil-menu-accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_item_margin_active',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-item.active .ababil-menu-accordion-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submenu_item_box_shadow_active',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-submenu .ababil-menu-accordion-item.active .ababil-menu-accordion-header',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        

        $this->start_controls_section(
            'toggle_icon_style',
            [
                'label' => __( 'Toggle Icon', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'toggle_icon_size',
            [
                'label' => __( 'Size', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-toggle i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ababil-menu-accordion-toggle svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_icon_vertical_align',
            [
                'label' => __( 'Vertical Alignment', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [ 'min' => -50, 'max' => 50 ],
                    '%' => [ 'min' => -100, 'max' => 100 ],
                    'em' => [ 'min' => -5, 'max' => 5 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-toggle' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'toggle_icon_tabs' );

        $this->start_controls_tab( 'toggle_icon_normal', [ 'label' => __( 'Normal', 'ababil' ) ] );

        $this->add_control(
            'toggle_icon_color',
            [
                'label' => __( 'Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-toggle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_icon_background',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-toggle' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'toggle_icon_border',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-toggle',
            ]
        );

        $this->add_control(
            'toggle_icon_border_radius',
            [
                'label' => __( 'Border Radius', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_icon_padding',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_icon_margin',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-toggle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'toggle_icon_box_shadow',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-toggle',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'toggle_icon_hover', [ 'label' => __( 'Hover', 'ababil' ) ] );

        $this->add_control(
            'toggle_icon_hover_color',
            [
                'label' => __( 'Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-toggle:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_icon_hover_background',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-toggle:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'toggle_icon_border_hover',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-toggle:hover',
            ]
        );

        $this->add_control(
            'toggle_icon_border_radius_hover',
            [
                'label' => __( 'Border Radius', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-toggle:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_icon_padding_hover',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-toggle:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_icon_margin_hover',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-toggle:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'toggle_icon_box_shadow_hover',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-toggle:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'toggle_icon_active', [ 'label' => __( 'Active', 'ababil' ) ] );

        $this->add_control(
            'toggle_icon_active_color',
            [
                'label' => __( 'Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-item.active .ababil-menu-accordion-toggle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_icon_active_background',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-item.active .ababil-menu-accordion-toggle' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'toggle_icon_border_active',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-item.active .ababil-menu-accordion-toggle',
            ]
        );

        $this->add_control(
            'toggle_icon_border_radius_active',
            [
                'label' => __( 'Border Radius', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-item.active .ababil-menu-accordion-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_icon_padding_active',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-item.active .ababil-menu-accordion-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_icon_margin_active',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-accordion-item.active .ababil-menu-accordion-toggle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'toggle_icon_box_shadow_active',
                'selector' => '{{WRAPPER}} .ababil-menu-accordion-item.active .ababil-menu-accordion-toggle',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'indicator_style',
            [
                'label' => __( 'Indicator', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_indicators' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'indicator_typography',
                'selector' => '{{WRAPPER}} .ababil-menu-indicator',
                'condition' => [
                    'indicator_type!' => 'icon',
                ],
            ]
        );

        $this->add_responsive_control(
            'indicator_icon_size',
            [
                'label' => __( 'Icon Size', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-indicator i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ababil-menu-indicator svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'indicator_type' => 'icon',
                ],
            ]
        );

        $this->add_responsive_control(
            'indicator_vertical_align',
            [
                'label' => __( 'Vertical Alignment', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [ 'min' => -50, 'max' => 50 ],
                    '%' => [ 'min' => -100, 'max' => 100 ],
                    'em' => [ 'min' => -5, 'max' => 5 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-indicator' => 'top: {{SIZE}}{{UNIT}}; position: relative;',
                ],
                'condition' => [
                    'indicator_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'indicator_color',
            [
                'label' => __( 'Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-indicator' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'indicator_padding',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-indicator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'indicator_margin',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-menu-indicator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $menu_slug = $settings['menu'];

        if ( empty( $menu_slug ) ) {
            echo '<p>' . __( 'Please select a menu.', 'ababil' ) . '</p>';
            return;
        }

        $args = [
            'menu' => $menu_slug,
            'container' => false,
            'menu_class' => 'ababil-menu-accordion-list',
            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
            'walker' => new Ababil_Menu_Accordion_Walker( $settings ),
            'echo' => false,
        ];

        $menu_html = wp_nav_menu( $args );

        if ( empty( $menu_html ) ) {
            return;
        }

        $accordion_id = 'ababil-menu-accordion-' . $this->get_id();

        ?>
        <div class="ababil-menu-accordion" id="<?php echo esc_attr( $accordion_id ); ?>" 
             data-behavior="<?php echo esc_attr( $settings['accordion_behavior'] ); ?>" 
             data-default-state="<?php echo esc_attr( $settings['default_state'] ); ?>" 
             data-icon-position="<?php echo esc_attr( $settings['icon_position'] ); ?>" 
             data-open-submenu-on-active="<?php echo esc_attr( $settings['open_submenu_on_active'] ); ?>">
            <?php echo $menu_html; ?>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <#
        var menu = settings.menu;
        var iconPosition = settings.icon_position || 'right';
        var behavior = settings.accordion_behavior || 'accordion';
        var defaultState = settings.default_state || 'all_closed';
        var openSubmenuOnActive = settings.open_submenu_on_active === 'yes';
        var accordionID = 'ababil-menu-accordion-' + view.getID();
        var iconHTML = elementor.helpers.renderIcon(view, settings.icon, { 'aria-hidden': true }, 'i', 'object' );
        var activeIconHTML = elementor.helpers.renderIcon(view, settings.active_icon, { 'aria-hidden': true }, 'i', 'object' );
        var indicatorType = settings.indicator_type || 'numbers';
        var showIndicators = settings.show_indicators === 'yes';
        var indicatorDisplay = settings.indicator_display || 'both';
        #>
        
        <div class="ababil-menu-accordion" id="{{ accordionID }}" 
             data-behavior="{{ behavior }}" 
             data-default-state="{{ defaultState }}" 
             data-icon-position="{{ iconPosition }}" 
             data-open-submenu-on-active="{{ openSubmenuOnActive }}">
            <# if ( menu ) { #>
                <ul class="ababil-menu-accordion-list">
                    <# var isActive = (defaultState === 'all_open' || defaultState === 'first_open'); #>
                    <li class="ababil-menu-accordion-item menu-item-has-children {{ isActive ? 'active' : '' }}">
                        <div class="ababil-menu-accordion-header">
                            <# if ( iconPosition === 'left' ) { #>
                                <span class="ababil-menu-accordion-toggle">
                                    <span class="ababil-menu-accordion-icon-normal">{{{ iconHTML.value }}}</span>
                                    <span class="ababil-menu-accordion-icon-active">{{{ activeIconHTML.value }}}</span>
                                </span>
                            <# } #>
                            <a href="#">
                                <# if ( showIndicators && (indicatorDisplay === 'both' || indicatorDisplay === 'parent') ) { #>
                                    <span class="ababil-menu-indicator">
                                        <# if ( indicatorType === 'icon' && settings.indicator_icon.value ) { #>
                                            {{{ elementor.helpers.renderIcon(view, settings.indicator_icon, { 'aria-hidden': true }, 'i', 'object').value }}}
                                        <# } else if ( indicatorType === 'roman' ) { #>
                                            I.
                                        <# } else if ( indicatorType === 'alphabetic' ) { #>
                                            A.
                                        <# } else { #>
                                            01.
                                        <# } #>
                                    </span>
                                <# } #>
                                <span class="ababil-menu-accordion-title-text">Parent Menu Item</span>
                            </a>
                            <# if ( iconPosition === 'right' ) { #>
                                <span class="ababil-menu-accordion-toggle">
                                    <span class="ababil-menu-accordion-icon-normal">{{{ iconHTML.value }}}</span>
                                    <span class="ababil-menu-accordion-icon-active">{{{ activeIconHTML.value }}}</span>
                                </span>
                            <# } #>
                        </div>
                        <div class="ababil-menu-accordion-submenu">
                            <ul class="ababil-menu-accordion-list">
                                <li class="ababil-menu-accordion-item">
                                    <div class="ababil-menu-accordion-header">
                                        <a href="#">
                                            <# if ( showIndicators && (indicatorDisplay === 'both' || indicatorDisplay === 'child') ) { #>
                                                <span class="ababil-menu-indicator">
                                                    <# if ( indicatorType === 'icon' && settings.indicator_icon.value ) { #>
                                                        {{{ elementor.helpers.renderIcon(view, settings.indicator_icon, { 'aria-hidden': true }, 'i', 'object').value }}}
                                                    <# } else if ( indicatorType === 'roman' ) { #>
                                                        I.i.
                                                    <# } else if ( indicatorType === 'alphabetic' ) { #>
                                                        A.a.
                                                    <# } else { #>
                                                        01.01.
                                                    <# } #>
                                                </span>
                                            <# } #>
                                            <span class="ababil-menu-accordion-title-text">Child Menu Item</span>
                                        </a>
                                    </div>
                                </li>
                                <li class="ababil-menu-accordion-item menu-item-has-children">
                                    <div class="ababil-menu-accordion-header">
                                        <# if ( iconPosition === 'left' ) { #>
                                            <span class="ababil-menu-accordion-toggle">
                                                <span class="ababil-menu-accordion-icon-normal">{{{ iconHTML.value }}}</span>
                                                <span class="ababil-menu-accordion-icon-active">{{{ activeIconHTML.value }}}</span>
                                            </span>
                                        <# } #>
                                        <a href="#">
                                            <# if ( showIndicators && (indicatorDisplay === 'both' || indicatorDisplay === 'child') ) { #>
                                                <span class="ababil-menu-indicator">
                                                    <# if ( indicatorType === 'icon' && settings.indicator_icon.value ) { #>
                                                        {{{ elementor.helpers.renderIcon(view, settings.indicator_icon, { 'aria-hidden': true }, 'i', 'object').value }}}
                                                    <# } else if ( indicatorType === 'roman' ) { #>
                                                        I.ii.
                                                    <# } else if ( indicatorType === 'alphabetic' ) { #>
                                                        A.b.
                                                    <# } else { #>
                                                        01.02.
                                                    <# } #>
                                                </span>
                                            <# } #>
                                            <span class="ababil-menu-accordion-title-text">Child With Submenu</span>
                                        </a>
                                        <# if ( iconPosition === 'right' ) { #>
                                            <span class="ababil-menu-accordion-toggle">
                                                <span class="ababil-menu-accordion-icon-normal">{{{ iconHTML.value }}}</span>
                                                <span class="ababil-menu-accordion-icon-active">{{{ activeIconHTML.value }}}</span>
                                            </span>
                                        <# } #>
                                    </div>
                                    <div class="ababil-menu-accordion-submenu">
                                        <ul class="ababil-menu-accordion-list">
                                            <li class="ababil-menu-accordion-item">
                                                <div class="ababil-menu-accordion-header">
                                                    <a href="#">
                                                        <span class="ababil-menu-accordion-title-text">Grandchild Menu Item</span>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="ababil-menu-accordion-item">
                        <div class="ababil-menu-accordion-header">
                            <a href="#">
                                <# if ( showIndicators && (indicatorDisplay === 'both' || indicatorDisplay === 'parent') ) { #>
                                    <span class="ababil-menu-indicator">
                                        <# if ( indicatorType === 'icon' && settings.indicator_icon.value ) { #>
                                            {{{ elementor.helpers.renderIcon(view, settings.indicator_icon, { 'aria-hidden': true }, 'i', 'object').value }}}
                                        <# } else if ( indicatorType === 'roman' ) { #>
                                            II.
                                        <# } else if ( indicatorType === 'alphabetic' ) { #>
                                            B.
                                        <# } else { #>
                                            02.
                                        <# } #>
                                    </span>
                                <# } #>
                                <span class="ababil-menu-accordion-title-text">Simple Menu Item</span>
                            </a>
                        </div>
                    </li>
                </ul>
            <# } else { #>
                <p>Please select a menu from the widget settings.</p>
            <# } #>
        </div>
        <?php
    }
}

class Ababil_Menu_Accordion_Walker extends Walker_Nav_Menu {

    private $settings;
    private $counters = [];

    public function __construct( $settings ) {
        $this->settings = $settings;
    }

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<div class="ababil-menu-accordion-submenu"><ul class="ababil-menu-accordion-list">';
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul></div>';
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? [] : (array) $item->classes;
        $classes[] = 'ababil-menu-accordion-item';
        if ( $args->walker->has_children ) {
            $classes[] = 'menu-item-has-children';
        }

        // Add current class for active menu item
        if ( in_array( 'current-menu-item', $item->classes ) || in_array( 'current-menu-ancestor', $item->classes ) ) {
            $classes[] = 'active';
        }

        $class_names = implode( ' ', apply_filters( 'nav_menu_item_classes', array_filter( $classes ), $item, $args, $depth ) );

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $is_active = false;
        if ( $args->walker->has_children ) {
            if ( $this->settings['default_state'] === 'all_open' ) {
                $is_active = true;
            } elseif ( $this->settings['default_state'] === 'first_open' && $depth === 0 && $this->get_counter( $depth ) === 1 ) {
                $is_active = true;
            } elseif ( $this->settings['open_submenu_on_active'] === 'yes' && in_array( 'current-menu-ancestor', $item->classes ) ) {
                $is_active = true;
            }
        }

        $class_names .= $is_active ? ' active' : '';

        $output .= '<li' . $id . ' class="' . esc_attr( $class_names ) . '">';

        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';

        $show_indicator = $this->settings['show_indicators'] === 'yes';
        if ( $show_indicator ) {
            $indicator_display = $this->settings['indicator_display'];
            $show_indicator = ( $depth === 0 && ( $indicator_display === 'both' || $indicator_display === 'parent' ) ) ||
                            ( $depth > 0 && ( $indicator_display === 'both' || $indicator_display === 'child' ) );
        }
        $indicator = $show_indicator ? $this->get_indicator( $item, $depth, $args ) : '';

        $has_children = $args->walker->has_children;
        $icon_position = $this->settings['icon_position'];

        $icon_html_normal = '';
        $icon_html_active = '';

        if ( $has_children && ! empty( $this->settings['icon']['value'] ) ) {
            ob_start();
            \Elementor\Icons_Manager::render_icon( $this->settings['icon'], [ 'aria-hidden' => 'true' ] );
            $icon_html_normal = ob_get_clean();
        }

        if ( $has_children && ! empty( $this->settings['active_icon']['value'] ) ) {
            ob_start();
            \Elementor\Icons_Manager::render_icon( $this->settings['active_icon'], [ 'aria-hidden' => 'true' ] );
            $icon_html_active = ob_get_clean();
        }

        $output .= '<div class="ababil-menu-accordion-header">';

        // Toggler icon (not a link)
        if ( $has_children && $icon_position === 'left' ) {
            $output .= '<span class="ababil-menu-accordion-toggle">';
            if ( $icon_html_normal ) $output .= '<span class="ababil-menu-accordion-icon-normal">' . $icon_html_normal . '</span>';
            if ( $icon_html_active ) $output .= '<span class="ababil-menu-accordion-icon-active">' . $icon_html_active . '</span>';
            $output .= '</span>';
        }

        // Only the menu title is a link
        $output .= '<a' . $attributes . '>';
        if ( $show_indicator ) {
            $output .= '<span class="ababil-menu-indicator">' . $indicator . '</span>';
        }
        $output .= '<span class="ababil-menu-accordion-title-text">' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>';
        $output .= '</a>';

        // Toggler icon (not a link)
        if ( $has_children && $icon_position === 'right' ) {
            $output .= '<span class="ababil-menu-accordion-toggle">';
            if ( $icon_html_normal ) $output .= '<span class="ababil-menu-accordion-icon-normal">' . $icon_html_normal . '</span>';
            if ( $icon_html_active ) $output .= '<span class="ababil-menu-accordion-icon-active">' . $icon_html_active . '</span>';
            $output .= '</span>';
        }

        $output .= '</div>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }

    private function get_counter( $depth ) {
        if ( ! isset( $this->counters[ $depth ] ) ) {
            $this->counters[ $depth ] = 0;
        }
        $this->counters[ $depth ]++;
        return $this->counters[ $depth ];
    }

    private function get_indicator( $item, $depth, $args ) {
        $type = $this->settings['indicator_type'];
        $number = $this->get_counter( $depth );
        $parent_indicator = '';

        if ( $depth > 0 ) {
            $parent_indicator = $this->get_parent_indicator( $depth - 1 );
        }

        if ( $type === 'icon' && ! empty( $this->settings['indicator_icon']['value'] ) ) {
            ob_start();
            \Elementor\Icons_Manager::render_icon( $this->settings['indicator_icon'], [ 'aria-hidden' => 'true' ] );
            return ob_get_clean();
        }

        $formatted = '';
        switch ( $type ) {
            case 'roman':
                $formatted = $this->number_to_roman( $number );
                break;
            case 'alphabetic':
                $formatted = chr( 64 + $number );
                break;
            default:
                $formatted = sprintf( '%02d', $number );
                break;
        }

        if ( $parent_indicator ) {
            $formatted = $parent_indicator . '.' . $formatted;
        } else {
            $formatted .= '.';
        }

        return $formatted;
    }

    private function get_parent_indicator( $depth ) {
        if ( $depth < 0 ) return '';

        $type = $this->settings['indicator_type'];
        $number = $this->counters[ $depth ] ?? 1;
        $formatted = '';

        $parent = $this->get_parent_indicator( $depth - 1 );
        if ( $parent ) $formatted = $parent . '.';

        switch ( $type ) {
            case 'roman':
                $formatted .= $this->number_to_roman( $number );
                break;
            case 'alphabetic':
                $formatted .= chr( 64 + $number );
                break;
            default:
                $formatted .= sprintf( '%02d', $number );
                break;
        }

        return $formatted;
    }

    private function number_to_roman( $number ) {
        $map = [
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
        ];

        $returnValue = '';
        while ( $number > 0 ) {
            foreach ( $map as $roman => $int ) {
                if ( $number >= $int ) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}