<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Schemes;

/**
 * Elementor icon list widget.
 *
 * Elementor widget that displays a bullet list with any chosen icons and texts.
 *
 * @since 1.0.0
 */
class Menu_list extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve icon list widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'menu_list';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve icon list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Jws Menu list', 'ochahouse' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve icon list widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-bullet-list';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'icon list', 'icon', 'list' ];
	}

	/**
	 * Register icon list widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon List', 'ochahouse' ),
			]
		);
        $this->add_control(
				'hover_skin',
				[
					'label'     => esc_html__( 'Hover Skin', 'ochahouse' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'default',
					'options'   => [
						'default'   => esc_html__( 'Default', 'ochahouse' ),
						'line_pd'   => esc_html__( 'Line And Padding', 'ochahouse' ),
                        'line_sm'   => esc_html__( 'Line small', 'ochahouse' ),
					],
                    
				]
		);
		$this->add_control(
			'view',
			[
				'label' => esc_html__( 'Layout', 'ochahouse' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'traditional',
				'options' => [
					'traditional' => [
						'title' => esc_html__( 'Default', 'ochahouse' ),
						'icon' => 'eicon-editor-list-ul',
					],
					'inline' => [
						'title' => esc_html__( 'Inline', 'ochahouse' ),
						'icon' => 'eicon-ellipsis-h',
					],
				],
				'render_type' => 'template',
				'classes' => 'elementor-control-start-end',
				'style_transfer' => true,
				'prefix_class' => 'elementor-icon-list--layout-',
			]
		);
        $this->add_control(
    			'use_tooltip',
    			[
    				'label' => esc_html__( 'Enable Tooltip', 'ochahouse' ),
    				'type' => \Elementor\Controls_Manager::SWITCHER,
    				'label_on' => esc_html__( 'On', 'ochahouse' ),
    				'label_off' => esc_html__( 'Off', 'ochahouse' ),
    				'return_value' => 'yes',
    			]
    	);
        $this->add_control(
    			'toggle_mobile',
    			[
    				'label' => esc_html__( 'Enable Toggle Show/Hide On Mobile', 'ochahouse' ),
    				'type' => \Elementor\Controls_Manager::SWITCHER,
    				'label_on' => esc_html__( 'On', 'ochahouse' ),
    				'label_off' => esc_html__( 'Off', 'ochahouse' ),
    				'return_value' => 'true',
    			]
    	);
     $this->add_control(
    			'enable_date',
    			[
    				'label' => esc_html__( 'Enable Date Text', 'ochahouse' ),
    				'type' => \Elementor\Controls_Manager::SWITCHER,
    				'label_on' => esc_html__( 'On', 'ochahouse' ),
    				'label_off' => esc_html__( 'Off', 'ochahouse' ),
    				'return_value' => 'yes',
    			]
    		);
        $this->add_control(
			'title_menu',
			[
				'label' => esc_html__( 'Title', 'ochahouse' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'ochahouse' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'List Item', 'ochahouse' ),
				'default' => esc_html__( 'List Item', 'ochahouse' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'text_date',
			[
				'label' => esc_html__( 'Date', 'ochahouse' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Monday', 'ochahouse' ),
				'default' => esc_html__( 'Monday', 'ochahouse' ),
		
			]
		);
        
		$repeater->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'ochahouse' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'fa4compatibility' => 'icon',
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'ochahouse' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'ochahouse' ),
			]
		);

		$this->add_control(
			'icon_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => esc_html__( 'List Item #1', 'ochahouse' ),
						'selected_icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
					],
					[
						'text' => esc_html__( 'List Item #2', 'ochahouse' ),
						'selected_icon' => [
							'value' => 'fas fa-times',
							'library' => 'fa-solid',
						],
					],
					[
						'text' => esc_html__( 'List Item #3', 'ochahouse' ),
						'selected_icon' => [
							'value' => 'fas fa-dot-circle',
							'library' => 'fa-solid',
						],
					],
				],
				'title_field' => '{{{ elementor.helpers.renderIcon( this, selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'section_box',
			[
				'label' => esc_html__( 'Box style', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        		$this->add_control(
				'content_align',
				[
					'label' 		=> esc_html__( 'justify content', 'ochahouse' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'options' 		=> [
						'space-around'    		=> [
							'title' 	=> esc_html__( 'Space around', 'ochahouse' ),
							'icon' 		=> 'eicon-justify-space-around-h',
						],
						'space-between' 		=> [
							'title' 	=> esc_html__( 'Space between', 'ochahouse' ),
							'icon' 		=> 'eicon-justify-space-between-h',
						],
						'space-evenly' 		=> [
							'title' 	=> esc_html__( 'Space evenly', 'ochahouse' ),
							'icon' 		=> 'eicon-justify-space-evenly-h',
						],
					],
                    'selectors' => [
							'{{WRAPPER}} .elementor-icon-list-item' => 'justify-content: {{VALUE}};',

					],
                  
					'frontend_available' => true,
				]
		);
                $this->add_control(
					'enable_border',
					[
						'label' => esc_html__( 'Enable Box border', 'ochahouse' ),
						'type' => Controls_Manager::SWITCHER,
						'label_on' => esc_html__( 'Yes', 'ochahouse' ),
						'label_off' => esc_html__( 'No', 'ochahouse' ),
						'return_value' => 'yes',
					]
				);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__( 'Border Box', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .jws-menu-list',
			]
		);
                
         $this->add_responsive_control(
			'box_padding',
			[
				'label' =>  esc_html__( 'Padding', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-menu-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );


        $this->end_controls_section();
                
        $this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'label' => esc_html__( 'Border', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .jws-menu-list h3',
			]
		);
           
        $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .jws-menu-list h3' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .jws-menu-list h3',
				'scheme' => Schemes\Typography::TYPOGRAPHY_3,
			]
		);
    $this->add_responsive_control(
			'title_padding',
			[
				'label' 		=> esc_html__( 'Padding', 'ochahouse' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-menu-list h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                	'separator' => 'before',

			]
		);
        $this->add_responsive_control(
			'title_margin',
			[
				'label' 		=> esc_html__( 'Margin', 'ochahouse' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			]
		);
        $this->end_controls_section();
        
		$this->start_controls_section(
			'section_icon_list',
			[
				'label' => esc_html__( 'List', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label' => esc_html__( 'Space Between', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body.rtl {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body:not(.rtl) {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'right: calc(-{{SIZE}}{{UNIT}}/2)',
				],
			]
		);

		$this->add_responsive_control(
			'icon_align',
			[
				'label' => esc_html__( 'Alignment', 'ochahouse' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'ochahouse' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ochahouse' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'ochahouse' ),
						'icon' => 'eicon-h-align-right',
					],
                    'selectors_dictionary' => [
    					'left' => 'flex-start',
    					'right' => 'flex-end',
    				],
				],
				'prefix_class' => 'elementor%s-align-',
                'selectors_dictionary' => [
					'left' => 'flex-start',
					'right' => 'flex-end',
				],
   	            'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'divider',
			[
				'label' => esc_html__( 'Divider', 'ochahouse' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Off', 'ochahouse' ),
				'label_on' => esc_html__( 'On', 'ochahouse' ),
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'content: ""',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'divider_style',
			[
				'label' => esc_html__( 'Style', 'ochahouse' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => esc_html__( 'Solid', 'ochahouse' ),
					'double' => esc_html__( 'Double', 'ochahouse' ),
					'dotted' => esc_html__( 'Dotted', 'ochahouse' ),
					'dashed' => esc_html__( 'Dashed', 'ochahouse' ),
				],
				'default' => 'solid',
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child):after' => 'border-top-style: {{VALUE}}',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:not(:last-child):after' => 'border-left-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_weight',
			[
				'label' => esc_html__( 'Weight', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .elementor-inline-items .elementor-icon-list-item:not(:last-child):after' => 'border-left-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_width',
			[
				'label' => esc_html__( 'Width', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'condition' => [
					'divider' => 'yes',
					'view!' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_height',
			[
				'label' => esc_html__( 'Height', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'divider' => 'yes',
					'view' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' => esc_html__( 'Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ddd',
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'border-color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'line_color',
			[
				'label' => esc_html__( 'Background', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-menu-list .line_sm li a .elementor-icon-list-text' => 'background-image: linear-gradient(transparent calc(100% - 1.5px),{{VALUE}} 1.5px);',
				],
				'condition' => [
					'hover_skin' => 'line_sm',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-list-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'icon_bgcolor',
			[
				'label' => esc_html__( 'Background Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon' => 'background: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__( 'Hover', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'icon_bgcolor_hover',
			[
				'label' => esc_html__( 'Background Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 14,
				],
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon' => 'font-size: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'icon_self_align',
			[
				'label' => esc_html__( 'Alignment', 'ochahouse' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'ochahouse' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ochahouse' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'ochahouse' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon' => 'text-align: {{VALUE}};',
				],
			]
		);
        $this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
					'icon_self_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-menu-list .elementor-icon-list-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[
				'label' => esc_html__( 'Text', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-text' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_2,
				],
			]
		);
		$this->add_control(
			'last_text_color',
			[
				'label' => esc_html__( 'Last Text Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:last-child .elementor-icon-list-text' => 'color: {{VALUE}};',
				],
		
			]
		);
		$this->add_control(
			'text_color_hover',
			[
				'label' => esc_html__( 'Hover', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-text , {{WRAPPER}} .elementor-icon-list-item.active .elementor-icon-list-text' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list-icon_border',
				'label' => esc_html__( 'Border', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .jws-menu-list  li .elementor-icon-list-text',
			]
		);
        $this->add_control(
			'list-icon_border_hover',
			[
				'label' => esc_html__( 'Border Hover Color', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-menu-list  li:hover .elementor-icon-list-text' => 'border-color: {{VALUE}}',
				],
			]
	   );
		$this->add_control(
			'text_indent',
			[
				'label' => esc_html__( 'Text Indent', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-text' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-list-item',
				'scheme' => Schemes\Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
        
        		$this->start_controls_section(
			'section_date_style',
			[
				'label' => esc_html__( 'Date', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_date'=> 'yes',
                    ],
			]
		);
		$this->add_control(
			'date_color',
			[
				'label' => esc_html__( 'Text Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-menu-list .elementor-icon-list-icon .date' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_2,
				],
			]
		);

		$this->add_control(
			'date_color_hover',
			[
				'label' => esc_html__( 'Hover', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-menu-list .elementor-icon-list-icon .date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'selector' => '{{WRAPPER}} .jws-menu-list .elementor-icon-list-icon .date',
				'scheme' => Schemes\Typography::TYPOGRAPHY_3,
			]
		);
        		$this->add_control(
			'date_indent',
			[
				'label' => esc_html__( 'Text Indent', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-menu-list .elementor-icon-list-icon .date' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render icon list widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$fallback_defaults = [
			'fa fa-check',
			'fa fa-times',
			'fa fa-dot-circle-o',
		];
        
        
        $this->add_render_attribute( 'main_list', 'class', 'jws-menu-list ' );
        if($settings['enable_border']=='yes'){
          $this->add_render_attribute( 'main_list', 'class', 'jws-menu-list box-border' );  
        }
        if ($settings['toggle_mobile']) { 
           $this->add_render_attribute( 'main_list', 'class', 'toggle-mobile' ); 
        }
        
        
		$this->add_render_attribute( 'icon_list', 'class', 'elementor-icon-list-items ' );
        
        if($settings['use_tooltip'] == 'yes') {
          $this->add_render_attribute( 'icon_list', 'class', 'elementor-use-tooltip' );  
        }	   

		if ( 'inline' === $settings['view'] ) {
			$this->add_render_attribute( 'icon_list', 'class', 'elementor-inline-items' );
			$this->add_render_attribute( 'list_item', 'class', 'elementor-inline-item' );
		}
        $this->add_render_attribute( 'icon_list', 'class', $settings['hover_skin'] );

      
        
		?>
        <div <?php echo ''.$this->get_render_attribute_string( 'main_list' ); ?>>
            <?php if(!empty($settings['title_menu'])) : ?>
                <h3><?php echo esc_html($settings['title_menu']); ?></h3>
            <?php endif; ?>
    		<ul <?php echo ''.$this->get_render_attribute_string( 'icon_list' ); ?>>
    			<?php
                $actual_link = (function_exists('check_url')) ? check_url() : '';
    			foreach ( $settings['icon_list'] as $index => $item ) :
    				$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'icon_list', $index );
    
    				$this->add_render_attribute( $repeater_setting_key, 'class', 'elementor-icon-list-text' );
    
    				$this->add_inline_editing_attributes( $repeater_setting_key );
    				$migration_allowed = Icons_Manager::is_migration_allowed();
                    $item_key = 'item_' . $index;
                    if ( ! empty( $item['link']['url'] ) ) {
                        if ( $actual_link == $item['link']['url'] ) {
                          $this->add_render_attribute( $item_key, 'class', 'active' );          
                        }
                    }
                    $this->add_render_attribute($item_key, 'class', 'elementor-icon-list-item' );
    				?>
    				<li <?php echo ''.$this->get_render_attribute_string( $item_key ); ?>>
    					<?php
                       
    					if ( ! empty( $item['link']['url'] ) ) {
    						$link_key = 'link_' . $index;
    						$this->add_link_attributes( $link_key, $item['link'] );
    
    						echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
    					}
    
    					// add old default
    					if ( ! isset( $item['icon'] ) && ! $migration_allowed ) {
    						$item['icon'] = isset( $fallback_defaults[ $index ] ) ? $fallback_defaults[ $index ] : 'fa fa-check';
    					}
    
    					$migrated = isset( $item['__fa4_migrated']['selected_icon'] );
    					$is_new = ! isset( $item['icon'] ) && $migration_allowed;
    					if ( ! empty( $item['icon'] ) || ( ! empty( $item['selected_icon']['value'] ) && $is_new ) ) :
    						?>
    						<span class="elementor-icon-list-icon">
    							<?php
    							if ( $is_new || $migrated ) {
    								Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
    							} else { ?>
    									<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
    							<?php } ?>
                                 
    						</span>
    					<?php endif; ?>
                         <?php if($settings['enable_date']=='yes'){ 
                        	 echo '	<span class="elementor-icon-list-icon">';
                                 echo '<span class="date">'.$item['text_date'].'</span>
                                 </span>';
                                 }?>
    						
    					<span <?php echo ''.$this->get_render_attribute_string( $repeater_setting_key ); ?>>
                        <?php 
                           if($settings['hover_skin'] == 'line_pd') {
                                echo '<span>'.$item['text'].'</span>';
                           }else {
                                echo esc_html($item['text']);
                           }
                        ?>
                        </span>
    					<?php if ( ! empty( $item['link']['url'] ) ) : ?>
    						</a>
    					<?php endif; ?>
    				</li>
    				<?php
    			endforeach;
    			?>
    		</ul>
        </div>
		<?php
	}

	/**
	 * Render icon list widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {

	}

	public function on_import( $element ) {
		return Icons_Manager::on_import_migration( $element, 'icon', 'selected_icon', true );
	}
}
