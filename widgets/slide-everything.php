<?php
/**
 * Ababil Slide Everything Widget for Elementor
 */
class Ababil_Slide_Everything_Widget extends \Elementor\Widget_Base {

    public function __construct( $data = [], $args = null ) {
        parent::__construct( $data, $args );

        wp_register_script(
            'ababil-slide-everything',
            plugins_url( '/assets/js/slide-everything.js', __DIR__ ),
            [ 'jquery', 'swiper' ],
            '1.0.1',
            true
        );

        wp_register_style(
            'ababil-slide-everything',
            plugins_url( '/assets/css/slide-everything.css', __DIR__ ),
            [ 'swiper' ],
            '1.0.1'
        );
    }

    public function get_name() {
        return 'ababil-slide-everything';
    }

    public function get_title() {
        return __( 'Slide Everything', 'ababil' );
    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return [ 'ababil' ];
    }

    public function get_keywords() {
        return [ 'slider', 'carousel', 'slide everything', 'post slider', 'ababil' ];
    }

    public function get_script_depends() {
        if ( version_compare( ELEMENTOR_VERSION, '3.26.3', '>=' ) ) {
            return [ 'swiper', 'ababil-slide-everything' ];
        } else {
            wp_register_script(
                'swiper',
                ELEMENTOR_ASSETS_URL . '/lib/swiper/v8/swiper.min.js',
                [ 'jquery' ],
                false,
                true
            );
            return [ 'swiper', 'ababil-slide-everything' ];
        }
    }

    public function get_style_depends() {
        return [ 'swiper', 'ababil-slide-everything' ];
    }

    protected function register_controls() {
        // Content Tab: Settings
        $this->start_controls_section(
            'content_settings',
            [
                'label' => __( 'Slider Settings', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'parent_id',
            [
                'label' => esc_html__( 'Target Container ID', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'description' => 'Enter the ID of the container whose children will be turned into slides.'
            ]
        );

        $this->add_control(
            'slides_per_view',
            [
                'label'   => __( 'Slides Per View (Desktop)', 'ababil' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 10,
                'step'    => 1,
                'default' => 3,
            ]
        );

        $this->add_control(
            'slides_per_view_tablet',
            [
                'label'   => __( 'Slides Per View (Tablet)', 'ababil' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 10,
                'step'    => 1,
                'default' => 2,
            ]
        );

        $this->add_control(
            'slides_per_view_phone',
            [
                'label'   => __( 'Slides Per View (Phone)', 'ababil' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 10,
                'step'    => 1,
                'default' => 1,
            ]
        );

        $this->add_control(
            'space_between',
            [
                'label'   => __( 'Space Between Slides', 'ababil' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 0,
                'max'     => 100,
                'step'    => 1,
                'default' => 20,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label'        => __( 'Loop Slider', 'ababil' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'ababil' ),
                'label_off'    => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'        => __( 'Autoplay', 'ababil' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'ababil' ),
                'label_off'    => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_delay',
            [
                'label'      => __( 'Autoplay Delay (ms)', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min'  => 100,
                        'max'  => 10000,
                        'step' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 3000,
                ],
                'condition' => [ 'autoplay' => 'yes' ],
            ]
        );

        $this->add_control(
            'autoplay_reverse',
            [
                'label'        => __( 'Autoplay Reverse', 'ababil' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'ababil' ),
                'label_off'    => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition'    => [ 'autoplay' => 'yes' ],
            ]
        );

        $this->add_control(
            'center_slides',
            [
                'label'        => __( 'Center Slides', 'ababil' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'ababil' ),
                'label_off'    => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label'        => __( 'Show Pagination', 'ababil' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'ababil' ),
                'label_off'    => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'arrows',
            [
                'label'        => __( 'Show Arrows', 'ababil' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'ababil' ),
                'label_off'    => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'mousewheel',
            [
                'label'        => __( 'Mouse Wheel Control', 'ababil' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'ababil' ),
                'label_off'    => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'free_mode',
            [
                'label'        => __( 'Free Mode', 'ababil' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'ababil' ),
                'label_off'    => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        // $this->add_control(
        //     'note',
        //     [
        //         'type' => \Elementor\Controls_Manager::RAW_HTML,
        //         'raw'  => __( 'Note: Ensure a container with class ".post_list" contains ".post" elements to slide. Slides are visible in preview or published page.', 'ababil' ),
        //         'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
        //         'separator' => 'before',
        //     ]
        // );

        $this->end_controls_section();

        // Style Tab: Arrows
        $this->start_controls_section(
            'style_arrows',
            [
                'label' => __( 'Arrows', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'arrows' => 'yes' ],
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label'     => __( 'Arrow Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-prev svg path, {{WRAPPER}} .swiper-button-next svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label'     => __( 'Arrow Background Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => 'rgba(0,0,0,0.1)',
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_size',
            [
                'label'      => __( 'Arrow Size', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min'  => 20,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_border_radius',
            [
                'label'      => __( 'Arrow Border Radius', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'absolute_arrows',
            [
                'label'        => __( 'Position Arrows Absolutely', 'ababil' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'ababil' ),
                'label_off'    => __( 'No', 'ababil' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'arrow_position_left',
            [
                'label'      => __( 'Left Arrow Position', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'condition'  => [ 'absolute_arrows' => 'yes' ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper-button-prev' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '50%',
                    'left' => '10px',
                    'right' => '',
                    'bottom' => '',
                    'unit' => 'px',
                ],
            ]
        );

        $this->add_control(
            'arrow_position_right',
            [
                'label'      => __( 'Right Arrow Position', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'condition'  => [ 'absolute_arrows' => 'yes' ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper-button-next' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '50%',
                    'right' => '10px',
                    'left' => '',
                    'bottom' => '',
                    'unit' => 'px',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab: Pagination
        $this->start_controls_section(
            'style_pagination',
            [
                'label'     => __( 'Pagination', 'ababil' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'pagination' => 'yes' ],
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label'     => __( 'Dot Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_active_color',
            [
                'label'     => __( 'Active Dot Color', 'ababil' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#007aff',
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_position',
            [
                'label'      => __( 'Pagination Position (Bottom)', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_padding',
            [
                'label'      => __( 'Pagination Padding', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_size',
            [
                'label'      => __( 'Dot Size', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min'  => 5,
                        'max'  => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab: Container
        $this->start_controls_section(
            'style_container',
            [
                'label' => __( 'Container', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'container_background',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ababil-slide-everything-container',
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label'      => __( 'Padding', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-slide-everything-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'container_border',
                'selector' => '{{WRAPPER}} .ababil-slide-everything-container',
            ]
        );

        $this->add_responsive_control(
            'container_border_radius',
            [
                'label'      => __( 'Border Radius', 'ababil' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ababil-slide-everything-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'container_box_shadow',
                'selector' => '{{WRAPPER}} .ababil-slide-everything-container',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $container_id     = $settings['parent_id'];
        $slides_per_view  = $settings['spv'] ?? 3;
        $spvp             = $settings['spvp'] ?? 1;
        $spvt             = $settings['spvt'] ?? 2;
        $space_between    = $settings['spacebetween'] ?? 20;
        $loop             = $settings['loop'] === 'yes' ? 'true' : 'false';
        $autoplay         = $settings['autoplay'] === 'yes' ? 'true' : 'false';
        $autoplay_delay   = $settings['autoplay_delay'] ?? 3000;
        $autoplay_reverse = $settings['autoplay_reverse'] === 'yes' ? 'true' : 'false';
        $center_slides    = $settings['center_slides'] === 'yes' ? 'true' : 'false';
        $pagination       = $settings['pagination'] === 'yes' ? 'true' : 'false';
        $arrows           = $settings['arrows'] === 'yes' ? 'true' : 'false';
        $mousewheel       = $settings['mousewheel'] === 'yes' ? 'true' : 'false';
        $freemode         = $settings['freemode'] === 'yes' ? 'true' : 'false';

        // Render slide container — this container will NOT be the swiper itself,
        // but will control the Swiper behavior on the container ID provided
        ?>
        <div class="ababil-slide-everything-container"
            data-parent-id="<?php echo esc_attr( $container_id ); ?>"
            data-spv="<?php echo esc_attr( $slides_per_view ); ?>"
            data-spvp="<?php echo esc_attr( $spvp ); ?>"
            data-spvt="<?php echo esc_attr( $spvt ); ?>"
            data-spacebetween="<?php echo esc_attr( $space_between ); ?>"
            data-loop="<?php echo $loop; ?>"
            data-autoplay="<?php echo $autoplay; ?>"
            data-autoplay-delay="<?php echo esc_attr( $autoplay_delay ); ?>"
            data-autoplay-reverse="<?php echo $autoplay_reverse; ?>"
            data-center-slides="<?php echo $center_slides; ?>"
            data-pagination="<?php echo $pagination; ?>"
            data-arrows="<?php echo $arrows; ?>"
            data-mousewheel="<?php echo $mousewheel; ?>"
            data-freemode="<?php echo $freemode; ?>"
        >
            <?php if ( $arrows === 'true' ) : ?>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            <?php endif; ?>

            <?php if ( $pagination === 'true' ) : ?>
                <div class="swiper-pagination"></div>
            <?php endif; ?>
        </div>
        <?php
    }


    protected function content_template() {
        ?>
        <#
        var sliderId = settings.slider_id || 'ababil-slide-everything-' + view.getID();
        var postListSelector = settings.post_list_selector || '.post_list';
        var loop = settings.loop === 'yes' ? 1 : 0;
        var autoplay = settings.autoplay === 'yes' ? 1 : 0;
        var autoplay_reverse = settings.autoplay_reverse === 'yes' ? 1 : 0;
        var center_slides = settings.center_slides === 'yes' ? 1 : 0;
        var pagination = settings.pagination === 'yes' ? 1 : 0;
        var arrows = settings.arrows === 'yes' ? 1 : 0;
        var mousewheel = settings.mousewheel === 'yes' ? 1 : 0;
        var free_mode = settings.free_mode === 'yes' ? 1 : 0;
        var autoplay_delay = settings.autoplay_delay ? settings.autoplay_delay.size : 3000;

        view.addRenderAttribute( 'container', {
            'class': [ 'ababil-slide-everything-container', 'swiper-container' ],
            'id': sliderId,
            'data-post-list-selector': postListSelector,
            'data-spv': settings.slides_per_view,
            'data-spvt': settings.slides_per_view_tablet,
            'data-spvp': settings.slides_per_view_phone,
            'data-spacebetween': settings.space_between,
            'data-loop': loop,
            'data-autoplay': autoplay,
            'data-autoplay-reverse': autoplay_reverse,
            'data-autoplay-delay': autoplay_delay,
            'data-center-slides': center_slides,
            'data-pagination': pagination,
            'data-arrows': arrows,
            'data-mousewheel': mousewheel,
            'data-freemode': free_mode,
            'data-latest-swiper': '<?php echo \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 1 : 0; ?>'
        } );
        #>
        <div {{{ view.getRenderAttributeString( 'container' ) }}}>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div style="text-align: center; padding: 20px;">
                        <strong><?php esc_html_e( 'Ababil Slide Everything', 'ababil' ); ?></strong><br>
                        <?php // esc_html_e( 'Ensure a container with class ".post_list" contains ".post" elements to slide.', 'ababil' ); ?>
                        <# if ( settings.post_list_selector ) { #>
                            <?php esc_html_e( 'Selector: ', 'ababil' ); ?><strong>{{{ settings.post_list_selector }}}</strong>
                        <# } #>
                    </div>
                </div>
            </div>
            <# if ( settings.pagination === 'yes' ) { #>
                <div class="swiper-pagination"></div>
            <# } #>
            <# if ( settings.arrows === 'yes' ) { #>
                <div class="swiper-button-prev">
                    <svg viewBox="0 0 24 24" width="24" height="24">
                        <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                    </svg>
                </div>
                <div class="swiper-button-next">
                    <svg viewBox="0 0 24 24" width="24" height="24">
                        <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                    </svg>
                </div>
            <# } #>
        </div>
        <?php
    }
}