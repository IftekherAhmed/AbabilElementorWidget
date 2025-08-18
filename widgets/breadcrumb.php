<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Ababil Breadcrumb Widget for Elementor
 */
class Ababil_Breadcrumb_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ababil-breadcrumb';
    }

    public function get_title() {
        return __( 'Breadcrumb', 'ababil' );
    }

    public function get_icon() {
        return 'eicon-navigation-horizontal';
    }

    public function get_categories() {
        return [ 'ababil' ];
    }

    public function get_keywords() {
        return [ 'breadcrumb', 'navigation', 'path', 'trail', 'ababil' ];
    }

    public function get_style_depends() {
        return [ 'ababil-breadcrumb' ];
    }

    public function get_script_depends() {
        return [ 'ababil-breadcrumb' ];
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

        // Home Text
        $this->add_control(
            'home_text',
            [
                'label'       => __( 'Home Text', 'ababil' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'Home', 'ababil' ),
                'placeholder' => __( 'Enter home link text', 'ababil' ),
                'dynamic'     => [ 'active' => true ],
            ]
        );

        // Separator Type
        $this->add_control(
            'separator_type',
            [
                'label'   => __( 'Separator Type', 'ababil' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'text' => __( 'Text', 'ababil' ),
                    'icon' => __( 'Icon', 'ababil' ),
                ],
                'default' => 'text',
                'separator' => 'before',
            ]
        );

        // Separator Text
        $this->add_control(
            'separator_text',
            [
                'label'       => __( 'Separator Text', 'ababil' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '/',
                'placeholder' => __( 'Enter separator (e.g., /, >, »)', 'ababil' ),
                'condition'   => [ 'separator_type' => 'text' ],
            ]
        );

        // Separator Icon
        $this->add_control(
            'separator_icon',
            [
                'label'       => __( 'Separator Icon', 'ababil' ),
                'type'        => \Elementor\Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
                'condition'   => [ 'separator_type' => 'icon' ],
                'recommended' => [
                    'fa-solid' => [
                        'chevron-right',
                        'angle-right',
                        'arrow-right',
                        'caret-right',
                    ],
                ],
            ]
        );

        // HTML Tag for Container
        $this->add_control(
            'html_tag',
            [
                'label'   => __( 'HTML Tag', 'ababil' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'nav'  => 'nav',
                    'div'  => 'div',
                    'span' => 'span',
                ],
                'default' => 'nav',
                'description' => __( 'Select the HTML tag for the breadcrumb container.', 'ababil' ),
                'separator' => 'before',
            ]
        );

        // Show Home Link
        $this->add_control(
            'show_home',
            [
                'label'   => __( 'Show Home Link', 'ababil' ),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on'  => __( 'Yes', 'ababil' ),
                'label_off' => __( 'No', 'ababil' ),
            ]
        );

        // Show Current Page
        $this->add_control(
            'show_current',
            [
                'label'   => __( 'Show Current Page', 'ababil' ),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on'  => __( 'Yes', 'ababil' ),
                'label_off' => __( 'No', 'ababil' ),
            ]
        );

        // Show Categories for Single Posts
        $this->add_control(
            'show_categories',
            [
                'label'   => __( 'Show Categories for Posts', 'ababil' ),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on'  => __( 'Yes', 'ababil' ),
                'label_off' => __( 'No', 'ababil' ),
                'description' => __( 'Show categories in breadcrumb trail for single posts.', 'ababil' ),
            ]
        );

        $this->end_controls_section();

        // Style Tab: Container
        $this->start_controls_section(
            'container_style_section',
            [
                'label' => __( 'Container', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Alignment
        $this->add_responsive_control(
            'container_alignment',
            [
                'label'     => __( 'Alignment', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [ 'title' => __( 'Left', 'ababil' ),   'icon' => 'eicon-text-align-left' ],
                    'center'     => [ 'title' => __( 'Center', 'ababil' ), 'icon' => 'eicon-text-align-center' ],
                    'flex-end'   => [ 'title' => __( 'Right', 'ababil' ),  'icon' => 'eicon-text-align-right' ],
                ],
                'default'   => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .ababil-breadcrumb-container' => 'display: flex; justify-content: {{VALUE}};',
                ],
            ]
        );

        // Background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'container_background',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ababil-breadcrumb-container',
            ]
        );

        // Padding
        $this->add_responsive_control(
            'container_padding',
            [
                'label'      => __( 'Padding', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-breadcrumb-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'container_border',
                'selector' => '{{WRAPPER}} .ababil-breadcrumb-container',
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'container_border_radius',
            [
                'label'      => __( 'Border Radius', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-breadcrumb-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'container_box_shadow',
                'selector' => '{{WRAPPER}} .ababil-breadcrumb-container',
            ]
        );

        $this->end_controls_section();

        // Style Tab: Items
        $this->start_controls_section(
            'items_style_section',
            [
                'label' => __( 'Breadcrumb Items', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'item_typography',
                'label'    => __( 'Typography', 'ababil' ),
                'selector' => '{{WRAPPER}} .ababil-breadcrumb-item, {{WRAPPER}} .ababil-breadcrumb-item a',
            ]
        );

        // Item Spacing
        $this->add_responsive_control(
            'item_spacing',
            [
                'label'     => __( 'Item Spacing', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
                'default'   => [ 'size' => 10 ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-breadcrumb-item:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Tabs for Normal and Hover States
        $this->start_controls_tabs( 'item_style_tabs' );

        // Normal Tab
        $this->start_controls_tab(
            'item_normal_tab',
            [
                'label' => __( 'Normal', 'ababil' ),
            ]
        );

        $this->add_control(
            'item_color',
            [
                'label'     => __( 'Text Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-breadcrumb-item, {{WRAPPER}} .ababil-breadcrumb-item a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_bg_color',
            [
                'label'     => __( 'Background Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-breadcrumb-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'item_border',
                'selector' => '{{WRAPPER}} .ababil-breadcrumb-item',
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label'      => __( 'Border Radius', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-breadcrumb-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => __( 'Padding', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-breadcrumb-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab(
            'item_hover_tab',
            [
                'label' => __( 'Hover', 'ababil' ),
            ]
        );

        $this->add_control(
            'item_color_hover',
            [
                'label'     => __( 'Text Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-breadcrumb-item a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_bg_color_hover',
            [
                'label'     => __( 'Background Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-breadcrumb-item:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_border_color_hover',
            [
                'label'     => __( 'Border Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-breadcrumb-item:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Current Item Tab
        $this->start_controls_tab(
            'item_current_tab',
            [
                'label' => __( 'Current', 'ababil' ),
            ]
        );

        $this->add_control(
            'item_current_color',
            [
                'label'     => __( 'Text Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-breadcrumb-item.current' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_current_bg_color',
            [
                'label'     => __( 'Background Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-breadcrumb-item.current' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_current_border_color',
            [
                'label'     => __( 'Border Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-breadcrumb-item.current' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Style Tab: Separator
        $this->start_controls_section(
            'separator_style_section',
            [
                'label' => __( 'Separator', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Separator Typography (for text separator)
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'      => 'separator_typography',
                'label'     => __( 'Typography', 'ababil' ),
                'selector'  => '{{WRAPPER}} .ababil-breadcrumb-separator',
                'condition' => [ 'separator_type' => 'text' ],
            ]
        );

        // Separator Icon Size (for icon separator)
        $this->add_responsive_control(
            'separator_icon_size',
            [
                'label'     => __( 'Icon Size', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'     => [ 'px' => [ 'min' => 6, 'max' => 50 ] ],
                'default'   => [ 'unit' => 'px', 'size' => 12 ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-breadcrumb-separator i'   => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ababil-breadcrumb-separator svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'separator_type' => 'icon' ],
            ]
        );

        // Separator Color
        $this->add_control(
            'separator_color',
            [
                'label'     => __( 'Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-breadcrumb-separator' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ababil-breadcrumb-separator svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // Separator Spacing
        $this->add_responsive_control(
            'separator_spacing',
            [
                'label'     => __( 'Spacing', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
                'default'   => [ 'size' => 10 ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-breadcrumb-separator' => 'margin: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Separator Padding
        $this->add_responsive_control(
            'separator_padding',
            [
                'label'      => __( 'Padding', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-breadcrumb-separator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Generate breadcrumb items
     */
    private function get_breadcrumb_items() {
        $settings = $this->get_settings_for_display();
        $items = [];

        // Home Link
        if ( $settings['show_home'] === 'yes' ) {
            $items[] = [
                'text' => $settings['home_text'] ?: __( 'Home', 'ababil' ),
                'url'  => home_url( '/' ),
            ];
        }

        // Handle different page types
        if ( is_front_page() ) {
            // Only show home on front page
            return $items;
        } elseif ( is_singular() ) {
            $post = get_queried_object();
            $post_type = get_post_type();

            // Add post type archive if it exists
            if ( $post_type !== 'post' && get_post_type_archive_link( $post_type ) ) {
                $post_type_obj = get_post_type_object( $post_type );
                $items[] = [
                    'text' => $post_type_obj->labels->singular_name,
                    'url'  => get_post_type_archive_link( $post_type ),
                ];
            }

            // Add categories for single posts
            if ( is_single() && $settings['show_categories'] === 'yes' ) {
                $categories = get_the_category( $post->ID );
                if ( ! empty( $categories ) ) {
                    foreach ( $categories as $category ) {
                        $items[] = [
                            'text' => esc_html( $category->name ),
                            'url'  => get_category_link( $category->term_id ),
                        ];
                    }
                }
            }

            // Add parent pages
            if ( is_page() && $post->post_parent ) {
                $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
                foreach ( $ancestors as $ancestor_id ) {
                    $items[] = [
                        'text' => get_the_title( $ancestor_id ),
                        'url'  => get_permalink( $ancestor_id ),
                    ];
                }
            }

            // Add current page
            if ( $settings['show_current'] === 'yes' ) {
                $items[] = [
                    'text'   => get_the_title(),
                    'url'    => '',
                    'current' => true,
                ];
            }
        } elseif ( is_category() || is_tag() || is_tax() ) {
            $term = get_queried_object();
            $taxonomy = get_taxonomy( $term->taxonomy );

            // Add parent terms
            if ( $term->parent ) {
                $parent_terms = array_reverse( get_ancestors( $term->term_id, $term->taxonomy, 'taxonomy' ) );
                foreach ( $parent_terms as $parent_id ) {
                    $parent_term = get_term( $parent_id, $term->taxonomy );
                    $items[] = [
                        'text' => $parent_term->name,
                        'url'  => get_term_link( $parent_term ),
                    ];
                }
            }

            // Add current term
            if ( $settings['show_current'] === 'yes' ) {
                $items[] = [
                    'text'   => $term->name,
                    'url'    => '',
                    'current' => true,
                ];
            }
        } elseif ( is_post_type_archive() ) {
            $post_type = get_queried_object();
            if ( $settings['show_current'] === 'yes' ) {
                $items[] = [
                    'text'   => $post_type->labels->singular_name,
                    'url'    => '',
                    'current' => true,
                ];
            }
        } elseif ( is_archive() ) {
            if ( is_author() ) {
                $author = get_queried_object();
                $items[] = [
                    'text'   => $author->display_name,
                    'url'    => '',
                    'current' => true,
                ];
            } elseif ( is_date() ) {
                if ( is_year() ) {
                    $items[] = [
                        'text'   => get_the_date( 'Y' ),
                        'url'    => '',
                        'current' => true,
                    ];
                } elseif ( is_month() ) {
                    $items[] = [
                        'text'   => get_the_date( 'F Y' ),
                        'url'    => '',
                        'current' => true,
                    ];
                } elseif ( is_day() ) {
                    $items[] = [
                        'text'   => get_the_date(),
                        'url'    => '',
                        'current' => true,
                    ];
                }
            }
        } elseif ( is_404() ) {
            if ( $settings['show_current'] === 'yes' ) {
                $items[] = [
                    'text'   => __( '404 - Not Found', 'ababil' ),
                    'url'    => '',
                    'current' => true,
                ];
            }
        } elseif ( is_search() ) {
            if ( $settings['show_current'] === 'yes' ) {
                $items[] = [
                    'text'   => __( 'Search: ', 'ababil' ) . get_search_query(),
                    'url'    => '',
                    'current' => true,
                ];
            }
        }

        return $items;
    }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $items = $this->get_breadcrumb_items();

        if ( empty( $items ) ) {
            return;
        }

        $html_tag = \Elementor\Utils::validate_html_tag( $settings['html_tag'] );
        $this->add_render_attribute( 'container', [
            'class' => 'ababil-breadcrumb-container',
            'aria-label' => __( 'Breadcrumb', 'ababil' ),
        ] );

        echo '<' . esc_attr( $html_tag ) . ' ' . $this->get_render_attribute_string( 'container' ) . '>';

        $index = 0;
        $total_items = count( $items );

        foreach ( $items as $item ) {
            $is_current = ! empty( $item['current'] );
            $item_key = 'item_' . $index;

            $this->add_render_attribute( $item_key, [
                'class' => [
                    'ababil-breadcrumb-item',
                    $is_current ? 'current' : '',
                ],
            ] );

            echo '<span ' . $this->get_render_attribute_string( $item_key ) . '>';

            if ( ! $is_current && ! empty( $item['url'] ) ) {
                echo '<a href="' . esc_url( $item['url'] ) . '">' . esc_html( $item['text'] ) . '</a>';
            } else {
                echo esc_html( $item['text'] );
            }

            echo '</span>';

            // Render separator if not the last item
            if ( $index < $total_items - 1 ) {
                echo '<span class="ababil-breadcrumb-separator">';
                if ( $settings['separator_type'] === 'icon' && ! empty( $settings['separator_icon']['value'] ) ) {
                    \Elementor\Icons_Manager::render_icon( $settings['separator_icon'], [ 'aria-hidden' => 'true' ] );
                } else {
                    echo esc_html( $settings['separator_text'] );
                }
                echo '</span>';
            }

            $index++;
        }

        echo '</' . esc_attr( $html_tag ) . '>';
    }

    /**
     * Render widget output in the editor (JS template)
     */
    protected function content_template() {
        ?>
        <#
        var htmlTag = elementor.helpers.validateHTMLTag( settings.html_tag || 'nav' );
        var items = [
            { text: settings.home_text || 'Home', url: '#', current: false },
            { text: 'Category', url: '#', current: false },
            { text: 'Current Page', url: '', current: true }
        ];

        if ( ! settings.show_home ) {
            items.shift();
        }
        if ( ! settings.show_current ) {
            items.pop();
        }
        if ( ! settings.show_categories ) {
            items.splice(1, 1); // Remove category for preview if disabled
        }
        #>
        <{{ htmlTag }} class="ababil-breadcrumb-container" aria-label="Breadcrumb">
            <# _.each( items, function( item, index ) { 
                var itemKey = 'item_' + index;
                view.addRenderAttribute( itemKey, {
                    'class': [ 'ababil-breadcrumb-item', item.current ? 'current' : '' ]
                } );
            #>
                <span {{{ view.getRenderAttributeString( itemKey ) }}}>
                    <# if ( ! item.current && item.url ) { #>
                        <a href="{{ item.url }}">{{{ item.text }}}</a>
                    <# } else { #>
                        {{{ item.text }}}
                    <# } #>
                </span>
                <# if ( index < items.length - 1 ) { #>
                    <span class="ababil-breadcrumb-separator">
                        <# if ( settings.separator_type === 'icon' && settings.separator_icon.value ) { #>
                            <# var iconHTML = elementor.helpers.renderIcon( view, settings.separator_icon, { 'aria-hidden': true }, 'i', 'object' ); #>
                            {{{ iconHTML.value }}}
                        <# } else { #>
                            {{{ settings.separator_text || '/' }}}
                        <# } #>
                    </span>
                <# } #>
            <# } ); #>
        </{{ htmlTag }}>
        <?php
    }
}