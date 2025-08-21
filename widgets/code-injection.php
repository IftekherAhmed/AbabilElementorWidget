<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Ababil Code Injection Widget for Elementor
 */
class Ababil_Code_Injection_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ababil-code-injection';
    }

    public function get_title() {
        return __( 'Code Injection', 'ababil' );
    }

    public function get_icon() {
        return 'eicon-code';
    }

    public function get_categories() {
        return [ 'ababil' ];
    }

    public function get_keywords() {
        return [ 'code', 'snippet', 'html', 'css', 'js', 'javascript', 'shortcode', 'injection', 'ababil' ];
    }

    /**
     * Register widget controls
     */
    protected function register_controls() {
        // Content Tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Code Snippets', 'ababil' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        // Code Type Selector
        $repeater->add_control(
            'code_type',
            [
                'label' => __( 'Code Type', 'ababil' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'html' => __( 'HTML', 'ababil' ),
                    'css' => __( 'CSS', 'ababil' ),
                    'js' => __( 'JavaScript', 'ababil' ),
                    'shortcode' => __( 'Shortcode', 'ababil' ),
                ],
                'default' => 'html',
            ]
        );

        // HTML Code
        $repeater->add_control(
            'html_code',
            [
                'label' => __( 'HTML Code', 'ababil' ),
                'type' => \Elementor\Controls_Manager::CODE,
                'language' => 'html',
                'rows' => 10,
                'condition' => [
                    'code_type' => 'html',
                ],
            ]
        );

        // CSS Code
        $repeater->add_control(
            'css_code',
            [
                'label' => __( 'CSS Code', 'ababil' ),
                'type' => \Elementor\Controls_Manager::CODE,
                'language' => 'css',
                'rows' => 10,
                'condition' => [
                    'code_type' => 'css',
                ],
            ]
        );

        // JavaScript Code
        $repeater->add_control(
            'js_code',
            [
                'label' => __( 'JavaScript Code', 'ababil' ),
                'type' => \Elementor\Controls_Manager::CODE,
                'language' => 'javascript',
                'rows' => 10,
                'condition' => [
                    'code_type' => 'js',
                ],
            ]
        );

        // Shortcode
        $repeater->add_control(
            'shortcode',
            [
                'label' => __( 'Shortcode', 'ababil' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 3,
                'placeholder' => __( '[your_shortcode]', 'ababil' ),
                'condition' => [
                    'code_type' => 'shortcode',
                ],
            ]
        );

        $this->add_control(
            'code_snippets',
            [
                'label' => __( 'Code Snippets', 'ababil' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'code_type' => 'html',
                        'html_code' => '', // Empty HTML code by default
                    ]
                ],
                'title_field' => '{{{ code_type.toUpperCase() }}}',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if ( empty( $settings['code_snippets'] ) ) {
            return;
        }
        
        // Use a wrapper to prevent layout issues
        echo '<div class="ababil-code-injection-wrapper">';
        
        // Process each code snippet
        foreach ( $settings['code_snippets'] as $snippet ) {
            switch ( $snippet['code_type'] ) {
                case 'html':
                    if ( ! empty( $snippet['html_code'] ) ) {
                        echo $this->sanitize_html( $snippet['html_code'] );
                    }
                    break;
                    
                case 'css':
                    if ( ! empty( $snippet['css_code'] ) ) {
                        echo '<style>' . wp_strip_all_tags( $snippet['css_code'] ) . '</style>';
                    }
                    break;
                    
                case 'js':
                    if ( ! empty( $snippet['js_code'] ) ) {
                        echo '<script>' . wp_strip_all_tags( $snippet['js_code'] ) . '</script>';
                    }
                    break;
                    
                case 'shortcode':
                    if ( ! empty( $snippet['shortcode'] ) ) {
                        echo do_shortcode( $snippet['shortcode'] );
                    }
                    break;
            }
        }
        
        echo '</div>'; // Close wrapper
    }
    
    /**
     * Sanitize HTML code
     */
    private function sanitize_html( $html ) {
        // Allow safe HTML - adjust allowed tags as needed
        $allowed_html = wp_kses_allowed_html( 'post' );
        
        // Add script and style tags if needed
        $allowed_html['script'] = [
            'type' => true,
            'src' => true,
            'async' => true,
            'defer' => true,
        ];
        
        $allowed_html['style'] = [
            'type' => true,
        ];
        
        // Add iframe for embedded content
        $allowed_html['iframe'] = [
            'src' => true,
            'width' => true,
            'height' => true,
            'frameborder' => true,
            'allowfullscreen' => true,
            'loading' => true,
        ];
        
        return wp_kses( $html, $allowed_html );
    }

    /**
     * Render widget output in the editor (JS template)
     */
    protected function content_template() {
        ?>
        <#
        var wrapperClass = 'ababil-code-injection-wrapper';
        #>
        <div class="{{{ wrapperClass }}}">
            <# if ( settings.code_snippets && settings.code_snippets.length ) { #>
                <# _.each( settings.code_snippets, function( snippet ) { #>
                    <# 
                    var previewHtml = '';
                    switch( snippet.code_type ) {
                        case 'html':
                            if ( snippet.html_code ) {
                                // Show actual HTML preview in editor
                                previewHtml = snippet.html_code;
                            }
                            break;
                    }
                    #>
                    {{{ previewHtml }}}
                <# } ); #>
            <# } else { #>
                <div class="ababil-empty-preview">
                    <p><?php echo __( 'Add code snippets using the repeater control.', 'ababil' ); ?></p>
                </div>
            <# } #>
        </div>
        <?php
    }
}