<?php
/**
 * JWS Particles Module.
 *
 * @package JWS
 */

namespace Elementor;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Module.
 */
class Row_Sticky {
    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;
    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.2.0
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    	/**
	 * Constructor.
	 */
	public function __construct() {
        $this->add_actions();
	}
	/**
	 * Add actions and set scripts dependencies required to run the widget.
	 *
	 * @since 1.12.0
	 * @access protected
	 */
	protected function add_actions() {
            add_action('elementor/element/section/section_effects/after_section_end', [$this, '_addStickyEffect']);
            add_action('elementor/element/common/section_effects/after_section_end', [$this, '_addStickyEffect']);
            add_action('elementor/frontend/section/before_render', [$this, '_startStickyContainer']);
            add_action('elementor/frontend/section/after_render', [$this, '_endStickyContainer']);

	}

    
    	/**
	 * Register shade Animation Backgrounds controls.
	 *
	 * @since 1.12.0
	 * @access public
	 * @param object $element for current element.
	 * @param object $section_id for section ID.
	 * @param array  $args for section args.
	 */
        /**
     * Maybe start sticky container
     */

	public function _addStickyEffect( $el ) {
        		$el->start_controls_section(
			'section_sticky_effect',
			[
				'label' => __( 'Row Sticky', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

        $el->add_control(
            'enable_sticky_effect',
            [
                'label' => __('Enable Sticky', 'ochahouse'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ochahouse'),
                'label_off' => __('No', 'ochahouse'),
                'default' => '',
                'return_value' => 'sticky',
                'prefix_class' => 'cafe-row-',
                'separator'   => 'after',
            ]
        );
        $el->add_control(
            'enable_fixed_bottom',
            [
                'label' => __('Fixed to Bottom', 'ochahouse'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'ochahouse' ),
                'label_off' => __( 'Hide', 'ochahouse' ),
                'return_value' => 'menu',
                'default' => '',
                'prefix_class' => 'bottom-nav-',
                'condition' => [
                    'enable_sticky_effect' => ''
                ],
                'selectors' => [
                    'body:not(.elementor-editor-active)  {{WRAPPER}}.bottom-nav-menu' => 'position: fixed;bottom: 0;z-index: 999;left: 0; width: 100%;'
                ]
            ]
        );
        $el->add_control(
            'enable_desktop_sticky_effect',
            [
                'label' => __('Enable Desktop Sticky', 'ochahouse'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ochahouse'),
                'label_off' => __('No', 'ochahouse'),
                'default' => '',
                'return_value' => 'sticky',
                'prefix_class' => 'desktop-',
                'condition' => [
                    'enable_sticky_effect!' => ''
                ]
            ]
        );
        $el->add_control(
            'enable_tablet_sticky_effect',
            [
                'label' => __('Enable Tablet Sticky', 'ochahouse'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ochahouse'),
                'label_off' => __('No', 'ochahouse'),
                'default' => '',
                'return_value' => 'sticky',
                'prefix_class' => 'tablet-',
                'condition' => [
                    'enable_sticky_effect!' => ''
                ]
            ]
        );
        $el->add_control(
            'enable_mobile_sticky_effect',
            [
                'label' => __('Enable Mobile Sticky', 'ochahouse'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ochahouse'),
                'label_off' => __('No', 'ochahouse'),
                'default' => '',
                'return_value' => 'sticky',
                'prefix_class' => 'mobile-',
                'separator'   => 'after',
                'condition' => [
                    'enable_sticky_effect!' => ''
                ]
            ]
        );
        $el->add_control(
            'enable_scroll_up_sticky',
            [
                'label' => __('Enable Scroll Up Sticky', 'ochahouse'),
                'description' => __('Header sticky only when scroll up', 'ochahouse'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ochahouse'),
                'label_off' => __('No', 'ochahouse'),
                'default' => '',
                'return_value' => 'sticky',
                'prefix_class' => 'cafe-scroll-up-',
                'condition' => [
                    'enable_sticky_effect!' => ''
                ],
            ]
        );
        $el->add_responsive_control(
            'sticky_effect_offset_top',
            [
                'label' => __('Sticky Offset Top', 'ochahouse'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}}.is-sticky' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_sticky_effect!' => ''
                ],
            ]
        );
        $el->add_responsive_control(
            'sticky_transparent',
            [
                'label' => __('Sticky Transparent', 'ochahouse'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ochahouse'),
                'label_off' => __('No', 'ochahouse'),
                'default' => '',
                'return_value' => 'transparent',
                'prefix_class' => 'cafe-scroll-up-',
                'condition' => [
                    'enable_sticky_effect!' => ''
                ],

            'separator'   => 'after',
            ]
        );

        $el->add_control(
            'sticky_effect_color',
            [
                'label' => __('Sticky Color', 'ochahouse'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'description' => __('For Clever Header&#8217;s Widgets only.', 'ochahouse'),
                'selectors' => [
                    '{{WRAPPER}}.elementor-element.cafe-row-sticky.is-sticky *' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'enable_sticky_effect!' => ''
                ],
            ]
        );
        $el->add_control(
            'sticky_effect_color_hover',
            [
                'label' => __('Sticky Color Hover', 'ochahouse'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'description' => __('For Clever Header&#8217;s Widgets only.', 'ochahouse'),
                'selectors' => [
                    '{{WRAPPER}}.elementor-element.cafe-row-sticky.is-sticky * a:hover, {{WRAPPER}}.elementor-element.cafe-row-sticky.is-sticky * a:hover *' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'enable_sticky_effect!' => ''
                ],
            ]
        );
        $el->add_control(
            'sticky_effect_bg_color',
            [
                'label' => __('Sticky Background Color', 'ochahouse'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.is-sticky' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'enable_sticky_effect!' => ''
                ],
            ]
        );

		$el->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'sticky_effect_border',
				'selector' => '{{WRAPPER}}.is-sticky',
                'condition' => [
                    'enable_sticky_effect!' => ''
                ]
			]
		);

        $el->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label' => esc_html__('Sticky Box Shadow', 'ochahouse'),
                'name'          => 'sticky_effect_shadow',
                'selector'      => '{{WRAPPER}}.is-sticky',
                'condition' => [
                    'enable_sticky_effect!' => ''
                ]
            ]
        );
        
         $el->add_responsive_control(
					'sticky_padding',
					[
						'label' 		=> esc_html__( 'Padding', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}}.is-sticky' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);



        if ($el instanceof Widget_Base) {
            $el->add_control(
                'sticky_parent_container',
                [
                    'label' => __('Stay In Column', 'ochahouse'),
                    'type' => Controls_Manager::SWITCHER,
                    'condition' => [
                        'enable_sticky_effect!' => '',
                    ],
                    'render_type' => 'none',
                    'frontend_available' => true,
                ]
            );
        }

        $el->end_controls_section();
	}
    
    function _startStickyContainer($el)
    {
        $settings = $el->get_settings();
        $style = '';
        if(isset($settings['sticky_transparent']) && $settings['sticky_transparent']){
            $style = 'style=" position: absolute;top: 0;left: 0;z-index: 1;width:100%;"';
        }
        if (isset($settings['enable_sticky_effect']) && 'sticky' === $settings['enable_sticky_effect']) {
            echo '<div class="cafe-sticky-row-container" '.$style.'>';
        }
    }

    /**
     * Maybe end sticky container
     */
    function _endStickyContainer($el)
    {
        $settings = $el->get_settings();

        if (isset($settings['enable_sticky_effect']) && 'sticky' === $settings['enable_sticky_effect']) {
            echo '</div>';
        }
    } 
     
        
}
// Instantiate Plugin Class
Row_Sticky::instance();
