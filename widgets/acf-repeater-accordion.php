<?php
/**
 * Ababil ACF Repeater Accordion Widget for Elementor
 */
class Ababil_ACF_Repeater_Accordion_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ababil-acf-repeater-accordion';
    }

    public function get_title() {
        return __( 'ACF Repeater Accordion', 'ababil' );
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return [ 'ababil' ];
    }

    public function get_keywords() {
        return [ 'accordion', 'repeater', 'acf', 'faq', 'toggle', 'ababil' ];
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

        // ACF Repeater Field Selector
        $this->add_control(
            'acf_repeater_field',
            [
                'label' => __( 'Repeater Field', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_all_acf_repeater_fields(),
                'description' => __( 'Select the ACF repeater field', 'ababil' ),
            ]
        );

        // Title Subfield (Text input for reliability)
        $this->add_control(
            'title_subfield',
            [
                'label' => __( 'Title Subfield', 'ababil' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'Enter the subfield name (from the selected repeater) to use as the accordion title. Example: "question"', 'ababil' ),
                'condition' => [
                    'acf_repeater_field!' => '',
                ],
            ]
        );

        // Content Subfield (Text input for reliability)
        $this->add_control(
            'content_subfield',
            [
                'label' => __( 'Content Subfield', 'ababil' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'Enter the subfield name (from the selected repeater) to use as the accordion content. Example: "answer"', 'ababil' ),
                'condition' => [
                    'acf_repeater_field!' => '',
                ],
            ]
        );

        // Post ID selector (for flexibility)
        $this->add_control(
            'post_id',
            [
                'label' => __( 'Post ID', 'ababil' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'Leave empty to use current post. Use "options" for options page.', 'ababil' ),
                'default' => '',
            ]
        );

        // Title HTML Tag
        $this->add_control(
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
                ],
                'default' => 'h4',
                'separator' => 'before',
            ]
        );

        // Accordion Behavior
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

        // Default State
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

        // Icon Controls
        $this->add_control(
            'selected_icon',
            [
                'label' => __( 'Icon', 'ababil' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'separator' => 'before',
                'default' => [
                    'value' => 'fas fa-plus',
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
            'selected_active_icon',
            [
                'label' => __( 'Active Icon', 'ababil' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-minus',
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
                    'selected_icon[value]!' => '',
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
                    'selected_icon[value]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab: Item
        $this->start_controls_section(
            'section_item_style',
            [
                'label' => __( 'Item', 'ababil' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label' => __( 'Border Width', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-item' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => __( 'Border Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-item' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-item' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_spacing',
            [
                'label' => __( 'Item Spacing', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .ababil-acf-accordion-item',
            ]
        );

        $this->end_controls_section();

        // Style Tab: Title
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'Title', 'ababil' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'title_colors' );

        $this->start_controls_tab(
            'title_colors_normal',
            [
                'label' => __( 'Normal', 'ababil' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_background_color',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-title' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_colors_active',
            [
                'label' => __( 'Active', 'ababil' ),
            ]
        );

        $this->add_control(
            'title_active_color',
            [
                'label' => __( 'Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-title.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_active_background_color',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-title.active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .ababil-acf-accordion-title',
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => __( 'Icon Spacing', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-icon-left .ababil-acf-accordion-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ababil-acf-accordion-icon-right .ababil-acf-accordion-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'selected_icon[value]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab: Content
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __( 'Content', 'ababil' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => __( 'Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_background_color',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .ababil-acf-accordion-content',
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab: Icon
        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => __( 'Icon', 'ababil' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'selected_icon[value]!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_box_size',
            [
                'label' => __( 'Icon Size', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range' => [
                    'px' => [ 'min' => 6, 'max' => 100 ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    // Only set SVG width, not height or font-size
                    '{{WRAPPER}} .ababil-acf-accordion-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'icon_colors' );

        $this->start_controls_tab(
            'icon_color_normal',
            [ 'label' => __( 'Normal', 'ababil' ) ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-icon-normal' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ababil-acf-accordion-icon-normal svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_bg_color',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-icon-normal' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_color_active',
            [ 'label' => __( 'Active', 'ababil' ) ]
        );
        $this->add_control(
            'icon_active_color',
            [
                'label' => __( 'Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-title.active .ababil-acf-accordion-icon-active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ababil-acf-accordion-title.active .ababil-acf-accordion-icon-active svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_active_bg_color',
            [
                'label' => __( 'Background Color', 'ababil' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-title.active .ababil-acf-accordion-icon-active' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => __( 'Padding', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => __( 'Margin', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .ababil-acf-accordion-icon',
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label' => __( 'Border Radius', 'ababil' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ababil-acf-accordion-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .ababil-acf-accordion-icon',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Get all ACF repeater fields as options
     */
    private function get_all_acf_repeater_fields() {
        $options = [ '' => __( 'Select Repeater Field', 'ababil' ) ];
        
        if (!function_exists('acf_get_field_groups')) {
            return $options;
        }
        
        $field_groups = acf_get_field_groups();
        
        foreach ($field_groups as $group) {
            $fields = acf_get_fields($group['key']);
            if ($fields) {
                foreach ($fields as $field) {
                    if ($field['type'] === 'repeater') {
                        $options[$field['key']] = $group['title'] . ' - ' . ($field['label'] ? $field['label'] : $field['name']);
                    }
                }
            }
        }
        
        return $options;
    }
    
    /**
     * Get ACF subfields as options
     */
    private function get_acf_subfields_options($repeater_key) {
        $options = [ '' => __( 'Select Subfield', 'ababil' ) ];
        
        if (!function_exists('acf_get_field')) {
            return $options;
        }
        
        $repeater_field = acf_get_field($repeater_key);
        
        if ($repeater_field && isset($repeater_field['sub_fields'])) {
            foreach ($repeater_field['sub_fields'] as $subfield) {
                $options[$subfield['name']] = $subfield['label'] ? $subfield['label'] : $subfield['name'];
            }
        }
        
        return $options;
    }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Check if ACF is active
        if (!function_exists('have_rows')) {
            echo '<div class="elementor-alert elementor-alert-danger">';
            _e('Advanced Custom Fields plugin is required for this widget to work.', 'ababil');
            echo '</div>';
            return;
        }
        
        // Validate required fields
        if (empty($settings['acf_repeater_field']) || 
            empty($settings['title_subfield']) || empty($settings['content_subfield'])) {
            echo '<div class="elementor-alert elementor-alert-warning">';
            _e('Please configure the ACF field settings for this widget.', 'ababil');
            echo '</div>';
            return;
        }
        
        // Get the post ID
        $post_id = $settings['post_id'] ? $settings['post_id'] : get_the_ID();
        
        // Setup the accordion ID
        $accordion_id = 'ababil-accordion-' . $this->get_id();
        
        // Get repeater field key
        $repeater_field = $settings['acf_repeater_field'];
        
        // Check if we have rows
        if (!have_rows($repeater_field, $post_id)) {
            echo '<div class="elementor-alert elementor-alert-info">';
            _e('No repeater rows found for the selected field.', 'ababil');
            echo '</div>';
            return;
        }
        
        // Accordion classes
        $accordion_classes = ['ababil-acf-accordion'];
        if ($settings['icon_position'] === 'left') {
            $accordion_classes[] = 'ababil-acf-accordion-icon-left';
        } else {
            $accordion_classes[] = 'ababil-acf-accordion-icon-right';
        }
        
        // Determine default state
        $default_state = $settings['default_state'];
        $is_first = true;
        ?>
        
        <div class="<?php echo implode(' ', $accordion_classes); ?>" id="<?php echo esc_attr($accordion_id); ?>">
            <?php while (have_rows($repeater_field, $post_id)) : the_row(); 
                // Get the title and content from subfields
                $title = get_sub_field($settings['title_subfield']);
                $content = get_sub_field($settings['content_subfield']);
                
                if (empty($title) && empty($content)) {
                    continue;
                }
                
                // Determine if this item should be open by default
                $is_active = false;
                if ($default_state === 'first_open' && $is_first) {
                    $is_active = true;
                    $is_first = false;
                } elseif ($default_state === 'all_open') {
                    $is_active = true;
                }
                
                // Item classes
                $item_classes = ['ababil-acf-accordion-item'];
                if ($is_active) {
                    $item_classes[] = 'active';
                }
                
                // Icon HTML
                $icon_html = '';
                $active_icon_html = '';
                $migration_allowed = \Elementor\Icons_Manager::is_migration_allowed();
                
                if (!empty($settings['selected_icon']['value'])) {
                    ob_start();
                    \Elementor\Icons_Manager::render_icon($settings['selected_icon'], [
                        'aria-hidden' => 'true',
                        'class' => 'ababil-acf-accordion-icon ababil-acf-accordion-icon-normal'
                    ]);
                    $icon_html = ob_get_clean();
                }
                
                if (!empty($settings['selected_active_icon']['value'])) {
                    ob_start();
                    \Elementor\Icons_Manager::render_icon($settings['selected_active_icon'], [
                        'aria-hidden' => 'true',
                        'class' => 'ababil-acf-accordion-icon ababil-acf-accordion-icon-active'
                    ]);
                    $active_icon_html = ob_get_clean();
                }
                ?>
                
                <div class="<?php echo implode(' ', $item_classes); ?>">
                    <<?php echo esc_attr($settings['title_html_tag']); ?> class="ababil-acf-accordion-title <?php echo $is_active ? 'active' : ''; ?>">
                        <?php if ($settings['icon_position'] === 'left') {
                            if ($icon_html) echo '<span class="ababil-acf-accordion-icon-wrapper">' . $icon_html . '</span>';
                            if ($active_icon_html) echo '<span class="ababil-acf-accordion-icon-wrapper">' . $active_icon_html . '</span>';
                        } ?>
                        
                        <span class="ababil-acf-accordion-title-text"><?php echo esc_html($title); ?></span>
                        
                        <?php if ($settings['icon_position'] === 'right') {
                            if ($icon_html) echo '<span class="ababil-acf-accordion-icon-wrapper">' . $icon_html . '</span>';
                            if ($active_icon_html) echo '<span class="ababil-acf-accordion-icon-wrapper">' . $active_icon_html . '</span>';
                        } ?>
                    </<?php echo esc_attr($settings['title_html_tag']); ?>>
                    
                    <div class="ababil-acf-accordion-content" <?php echo $is_active ? '' : 'style="display: none;"'; ?>>
                        <?php echo wpautop($content); ?>
                    </div>
                </div>
                
            <?php endwhile; ?>
        </div>
        
        <script>
        jQuery(document).ready(function($) {
            var accordionID = '<?php echo $accordion_id; ?>';
            var behavior = '<?php echo $settings['accordion_behavior']; ?>';
            
            $('#' + accordionID + ' .ababil-acf-accordion-title').on('click', function() {
                var $title = $(this);
                var $item = $title.closest('.ababil-acf-accordion-item');
                var $content = $item.find('.ababil-acf-accordion-content');
                var $iconNormal = $item.find('.ababil-acf-accordion-icon-normal');
                var $iconActive = $item.find('.ababil-acf-accordion-icon-active');
                
                if (behavior === 'accordion') {
                    // Close all other items
                    $('#' + accordionID + ' .ababil-acf-accordion-item').not($item).removeClass('active');
                    $('#' + accordionID + ' .ababil-acf-accordion-content').not($content).slideUp();
                    $('#' + accordionID + ' .ababil-acf-accordion-title').not($title).removeClass('active');
                    
                    // Show normal icons for all other items
                    $('#' + accordionID + ' .ababil-acf-accordion-icon-normal').not($iconNormal).css('display', 'inline-flex');
                    $('#' + accordionID + ' .ababil-acf-accordion-icon-active').not($iconActive).css('display', 'none');
                }
                
                // Toggle current item
                $item.toggleClass('active');
                $content.slideToggle();
                $title.toggleClass('active');
                
                // Toggle icons for current item
                if ($item.hasClass('active')) {
                    $iconNormal.css('display', 'none');
                    $iconActive.css('display', 'inline-flex');
                } else {
                    $iconNormal.css('display', 'inline-flex');
                    $iconActive.css('display', 'none');
                }
            });
        });
        </script>
        <?php
    }

    /**
     * Render widget output in the editor (JS template)
     */
    protected function content_template() {
        ?>
        <#
        // For the editor, we'll show a preview since we can't get real ACF data
        var accordionID = 'ababil-accordion-' + view.getID();
        var iconHTML = elementor.helpers.renderIcon(view, settings.selected_icon, { 'aria-hidden': true }, 'i', 'object' );
        var activeIconHTML = elementor.helpers.renderIcon(view, settings.selected_active_icon, { 'aria-hidden': true }, 'i', 'object' );
        var iconPosition = settings.icon_position || 'right';
        var defaultState = settings.default_state || 'all_closed';
        #>
        
        <div class="ababil-acf-accordion ababil-acf-accordion-icon-{{ iconPosition }}" id="{{ accordionID }}">
            <# for (var i = 0; i < 3; i++) { 
                var isActive = false;
                if (defaultState === 'first_open' && i === 0) {
                    isActive = true;
                } else if (defaultState === 'all_open') {
                    isActive = true;
                }
            #>
                <div class="ababil-acf-accordion-item {{ isActive ? 'active' : '' }}">
                    <{{ settings.title_html_tag }} class="ababil-acf-accordion-title {{ isActive ? 'active' : '' }}">
                        <# if (iconPosition === 'left' && iconHTML.value) { #>
                            <span class="ababil-acf-accordion-icon-wrapper">
                                <span class="ababil-acf-accordion-icon ababil-acf-accordion-icon-normal">{{{ iconHTML.value }}}</span>
                                <span class="ababil-acf-accordion-icon ababil-acf-accordion-icon-active">{{{ activeIconHTML.value }}}</span>
                            </span>
                        <# } #>
                        
                        <span class="ababil-acf-accordion-title-text">
                            <# print( elementor.translate('Accordion Title') + ' ' + (i + 1) ); #>
                        </span>
                        
                        <# if (iconPosition === 'right' && iconHTML.value) { #>
                            <span class="ababil-acf-accordion-icon-wrapper">
                                <span class="ababil-acf-accordion-icon ababil-acf-accordion-icon-normal">{{{ iconHTML.value }}}</span>
                                <span class="ababil-acf-accordion-icon ababil-acf-accordion-icon-active">{{{ activeIconHTML.value }}}</span>
                            </span>
                        <# } #>
                    </{{ settings.title_html_tag }}>
                    
                    <div class="ababil-acf-accordion-content" style="{{ isActive ? '' : 'display: none;' }}">
                        <p>{{{ elementor.translate('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.') }}}</p>
                    </div>
                </div>
            <# } #>
        </div>
        <?php
    }
}