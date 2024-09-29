<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Info_Box extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'jws_info_box';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Jws Info Box', 'ochahouse' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-info-box';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'jws-elements' ];
	}


	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
	    $this->start_controls_section(
			'setting_section',
			[
				'label' => esc_html__( 'Setting', 'ochahouse' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'info_layout',
			[
				'label' => esc_html__( 'Layout', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'layout1',
				'options' => [
					'layout1'  => esc_html__( 'Layout 1', 'ochahouse' ),
                    'layout2'  => esc_html__( 'Layout 2', 'ochahouse' ),
				],
			]
		);

        $this->end_controls_section();
        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'ochahouse' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
  $this->add_control(
			'sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'ochahouse' ),
				'placeholder' => esc_html__( 'Type your sub title here', 'ochahouse' ),
			]
		);
               
		$this->add_control(
			'tag',
			array(
				'label'       => esc_html__( 'HTML Tag', 'ochahouse' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'p'  => 'p',
				),
				'default'     => 'h2',
				'description' => esc_html__( 'Select the HTML Heading tag from H1 to H6 and P tag,too.', 'ochahouse' ),
			)
		);
        $this->add_control(
			'info_title',
			[
				'label' => esc_html__( 'Title', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'ochahouse' ),
				'placeholder' => esc_html__( 'Type your title here', 'ochahouse' ),

			]
		);

        $this->add_control(
			'info_content',
			[
				'label' => esc_html__( 'Content', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Default description', 'ochahouse' ),
				'placeholder' => esc_html__( 'Type your description here', 'ochahouse' ),
			]
		);
        $this->add_control(
				'jws_enable_button',
				[
					'type'         => Controls_Manager::SWITCHER,
					'label'        =>  esc_html__( 'Enable Button', 'ochahouse' ),
					'default'      => '',
					'label_on'     =>  esc_html__( 'Yes', 'ochahouse' ),
					'label_off'    =>  esc_html__( 'No', 'ochahouse' ),
					'return_value' => 'yes',
                    	'default' => 'no',
				]
			);
        $this->add_control(
				'jws_enable_icon',
				[
					'type'         => Controls_Manager::SWITCHER,
					'label'        =>  esc_html__( 'Enable Icon Button', 'ochahouse' ),
					'default'      => '',
					'label_on'     =>  esc_html__( 'Yes', 'ochahouse' ),
					'label_off'    =>  esc_html__( 'No', 'ochahouse' ),
					'return_value' => 'yes',
                    	'default' => 'no',
				]
			);
        $this->add_control(
			'info_readmore',
			[
				'label' => esc_html__( 'Button Text', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'READ MORE', 'ochahouse' ),
			
			]
		);
                $this->add_control(
			'box_url',
			[
				'label' => esc_html__( 'Link', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ochahouse' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
				],
                	'condition' => [
						'jws_enable_button' => 'yes',
					],
			]
		);
        $this->add_responsive_control(
				'align',
				[
					'label' 		=> esc_html__( 'Align', 'ochahouse' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'default' 		=> 'left',
					'options' 		=> [
						'left'    		=> [
							'title' 	=> esc_html__( 'Left', 'ochahouse' ),
							'icon' 		=> 'eicon-h-align-left',
						],
						'center' 		=> [
							'title' 	=> esc_html__( 'Center', 'ochahouse' ),
							'icon' 		=> 'eicon-h-align-center',
						],
						'right' 		=> [
							'title' 	=> esc_html__( 'Right', 'ochahouse' ),
							'icon' 		=> 'eicon-h-align-right',
						],
					],
                    'selectors' => [
							'{{WRAPPER}} .jws-info-box .jws-info-box-inner' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
                $this->add_responsive_control(
				'position',
				[
					'label' 		=> esc_html__( 'Icon Position', 'ochahouse' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'default' 		=> 'top',
					'options' 		=> [
						'left'    		=> [
							'title' 	=> esc_html__( 'Left', 'ochahouse' ),
							'icon' 		=> 'eicon-h-align-left',
						],
						'top' 		=> [
							'title' 	=> esc_html__( 'Center', 'ochahouse' ),
							'icon' 		=> 'eicon-v-align-top',
						],
						'right' 		=> [
							'title' 	=> esc_html__( 'Right', 'ochahouse' ),
							'icon' 		=> 'eicon-h-align-right',
						],
					],
                     'prefix_class' => 'elementor-position-',
					'frontend_available' => true,
				]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'icon_section',
			[
				'label' => esc_html__( 'Icon', 'ochahouse' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'ochahouse' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fab fa-wordpress',
                		'library' => 'fa-brands',
					],
				]
		);
                $this->add_control(
				'icon2',
				[
					'label' => esc_html__( 'Icon 2', 'ochahouse' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fab fa-wordpress',
                		'library' => 'fa-brands',
					],
                    'condition'=>[
                    'info_layout'=> 'layout2',
                    ],
				]
		);
                     $this->add_control(
			'icon_view',
			[
				'label' =>  esc_html__( 'View', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
                	'default' =>  esc_html__( 'Default', 'ochahouse' ),
					'stacked' =>  esc_html__( 'Stacked', 'ochahouse' ),
    	           'framed' =>  esc_html__( 'Framed', 'ochahouse' ),
                    
				],
				'default' => 'default',
                'prefix_class' => 'elementor-view-',
			]
	);
                 $this->add_control(
			'icon_shape',
			[
				'label' =>  esc_html__( 'Shape', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
                	'circle' =>  esc_html__( 'Circle', 'ochahouse' ),
					'square' =>  esc_html__( 'Square', 'ochahouse' ), 
				],
                'condition' => [
                'icon_view' => ['stacked', 'framed'],
                ],
				'default' => 'top',
                'prefix_class' => 'elementor-vertical-align-',
			]
	);
             $this->add_control(
			'icon_align',
			[
				'label' =>  esc_html__( 'Vertical Alignment', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
                	'top' =>  esc_html__( 'Top', 'ochahouse' ),
					'middle' =>  esc_html__( 'Middle', 'ochahouse' ),
    	           'bottom' =>  esc_html__( 'Bottom', 'ochahouse' ),
                    
				],
				'default' => 'top',
                'prefix_class' => 'elementor-vertical-align-',
			]
	);
 
		$this->end_controls_section();
        $this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'box_background',
			[
				'label' => esc_html__( 'Background', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box' => 'background: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
					'box_padding',
					[
						'label' 		=> esc_html__( 'Padding', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_responsive_control(
					'box_radius',
					[
						'label' 		=> esc_html__( 'Border Radius', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-info-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'placeholder' => '1px',
				'selector' => '{{WRAPPER}} .jws-info-box',
				'separator' => 'before',
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .jws-info-box',
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'label' => esc_html__( 'Box Shadow Hover', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .jws-info-box:hover',
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
			'box_number_style',
			[
				'label' => esc_html__( 'Number', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
						 'info_layout' => ['layout5','layout6'],
				],
			]
		);
        
        $this->add_control(
			'number_color',
			[
				'label' => esc_html__( 'Number Color', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .jws-info-box_inner .number-text' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'label' => esc_html__( 'Typography', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .jws-info-box .jws-info-box_inner .number-text',
			]
		);


        $this->end_controls_section();
        $this->start_controls_section(
			'box-content_title_style',
			[
				'label' => esc_html__( 'Content', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
                
        $this->add_control(
			'box-sub_title_style',
			[
				'label' => esc_html__( 'Sub Title', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
			'sub_title_color',
			[
				'label' => esc_html__( 'Sub Title Color', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .box-sub' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
				'label' => esc_html__( 'Typography', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .jws-info-box .box-sub',
			]
		);
        $this->add_control(
				'sub_title_spacing',
				[
					'label' 		=> esc_html__( 'Spacing', 'ochahouse' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 1,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .jws-info-box .box-sub' => 'margin-bottom: {{SIZE}}px;',
					],
				]
		);
 
        $this->add_control(
			'box-title_style',
			[
				'label' => esc_html__( 'Title', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .box-title' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .jws-info-box .box-title',
			]
		);
        $this->add_control(
				'title_spacing',
				[
					'label' 		=> esc_html__( 'Spacing', 'ochahouse' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 1,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .jws-info-box .box-title' => 'margin-bottom: {{SIZE}}px;',
					],
				]
		);
        $this->add_control(
			'box-content_style',
			[
				'label' => esc_html__( 'Content', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',

			]
		);
        
        $this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Content Color', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .box-content' => 'color: {{VALUE}}',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .jws-info-box .box-content',
			]
		);
        $this->add_control(
				'content_spacing',
				[
					'label' 		=> esc_html__( 'Spacing', 'ochahouse' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 1,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-content' => 'margin-bottom: {{SIZE}}px;',
					],
				]
		);
        $this->end_controls_section();
        
        $this->start_controls_section(
			'box-icon_style',
			[
				'label' => esc_html__( 'Icon', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .box-icon' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'              => 'icon_bgcolor',
				'types'             => [ 'classic', 'gradient' ],
				'selector'          => '{{WRAPPER}} .jws-info-box .box-icon',
			]
		);
 
        $this->add_control(
				'icon_size',
				[
					'label' 		=> esc_html__( 'Icon Size', 'ochahouse' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 1,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .jws-info-box .box-icon' => 'font-size: {{SIZE}}px;',
					],
				]
		);
 
  
        $this->add_responsive_control(
					'image_icon_padding',
					[
						'label' 		=> esc_html__( 'Padding', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-info-box .jws-info-box_inner .box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_responsive_control(
					'image_icon_marign',
					[
						'label' 		=> esc_html__( 'Margin', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-info-box .box-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'box_readmore_style',
			[
				'label' => esc_html__( 'Read More', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
    $this->add_control(
			'readmore_bg_color',
			[
				'label' => esc_html__( 'Readmore Background Color', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-more' => 'background: {{VALUE}}',
				],
			]
		);
    $this->add_control(
			'readmore_bg_color_hover',
			[
				'label' => esc_html__( 'Readmore Background Hover Color', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-more:hover' => 'background: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'readmore_color',
			[
				'label' => esc_html__( 'Readmore Color', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .jws-info-box-inner a.box-more' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'readmore_color_hover',
			[
				'label' => esc_html__( 'Readmore Color Hover', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-more a:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'readmore_typography',
				'label' => esc_html__( 'Typography', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-more',
			]
		);
            $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'readmore_border',
				'label' =>  esc_html__( 'Border', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-more',
			]
            	
		);
                $this->add_responsive_control(
					'readmore_padding',
					[
						'label' 		=> esc_html__( 'Padding', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

					'separator' => 'before',
					]
		);
        $this->add_responsive_control(
					'readmore_marign',
					[
						'label' 		=> esc_html__( 'Margin', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

					
					]
		);
        $this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
	   
		$settings = $this->get_settings_for_display();
        if($settings['box_url']){
        $url = $settings['box_url']['url'];
        $target = $settings['box_url']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['box_url']['nofollow'] ? ' rel="nofollow"' : '';  
        }
         ?>
            <div class="jws-info-box <?php echo esc_attr($settings['info_layout']); ?>">
                <div class="jws-info-box-inner">
                    <?php include( 'layout/'.$settings['info_layout'].'.php' ); ?>
                </div>
            </div>
        <?php

	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {}
}