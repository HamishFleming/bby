<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Testimonial_Slider extends Widget_Base {

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
		return 'jws_testimonial_slider';
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
		return esc_html__( 'Jws Testimonial Slider', 'ochahouse' );
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
		return 'eicon-testimonial';
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
			'content_section',
			[
				'label' => esc_html__( 'Menu List', 'ochahouse' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
				'slider_layouts',
				[
					'label'     => esc_html__( 'Layout', 'ochahouse' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'layout1',
					'options'   => [
						'layout1'   => esc_html__( 'layout 1', 'ochahouse' ),
						'layout2'   => esc_html__( 'layout 2', 'ochahouse' ),
                        'layout3'   => esc_html__( 'layout 3', 'ochahouse' ),
					],
				]
		);
        $this->add_control(
				'thumbnail_slider_position',
				[
					'label'     => esc_html__( 'Thumbnail Position', 'ochahouse' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'top',
					'options'   => [
						'top'   => esc_html__( 'Top', 'ochahouse' ),
						'bottom'   => esc_html__( 'Bottom', 'ochahouse' ),
					],
                    'condition' => [
						'slider_layouts' => 'layout1',
					],
				]
		);
		$repeater = new \Elementor\Repeater();
        $repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Avatar', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        $repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
			]
		);
        $repeater->add_control(
			'list_url',
			[
				'label' => esc_html__( 'Link', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ochahouse' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
				],
			]
		);


		$repeater->add_control(
			'list_name', [
				'label' => esc_html__( 'Name', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Name' , 'ochahouse' ),
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'list_job', [
				'label' => esc_html__( 'Job', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Job' , 'ochahouse' ),
				'label_block' => true,
			]
		);
        		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Title', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title' , 'ochahouse' ),
				'label_block' => true,
      
			]
               
		);
        $repeater->add_control(
			'list_description', [
				'label' => esc_html__( 'Description', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Default description', 'ochahouse' ),
				'placeholder' => esc_html__( 'Type your description here', 'ochahouse' ),
			]
		);
            $repeater->add_control(
			'list_date', [
				'label' => esc_html__( 'Date Post', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
   	            'default' => esc_html__( '25 May', 'ochahouse' ),
			]
		);
		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Menu List', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_name' => esc_html__( 'Name #1', 'ochahouse' ),
					],
				],
				'title_field' => '{{{ list_name }}}',
			]
		);

		$this->end_controls_section();
        	$this->start_controls_section(
			'section_slider_options',
			[
				'label'     => esc_html__( 'Slider Options', 'ochahouse' ),
				'type'      => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'     => esc_html__( 'Navigation', 'ochahouse' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'both',
				'options'   => [
                    'both' => esc_html__( 'Arrows And Dots', 'ochahouse' ),
					'arrows' => esc_html__( 'Arrows', 'ochahouse' ),
                    'dots' => esc_html__( 'Dots', 'ochahouse' ),
					'none'   => esc_html__( 'None', 'ochahouse' ),
				],
			]
		);
        
        $this->add_control(
			'navigation_style',
			[
				'label'     => esc_html__( 'Navigation Style', 'ochahouse' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
                    'default' => esc_html__( 'Default', 'ochahouse' ),
					'style2' => esc_html__( 'Style 2', 'ochahouse' ),
				],
			]
		);

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'          => esc_html__( 'posts to Show', 'ochahouse' ),
				'type'           => Controls_Manager::NUMBER,
				'default'        => 1,
			]
		);
        $this->add_responsive_control(
			'slides_to_show_thumbnail',
			[
				'label'          => esc_html__( 'posts to Show Thumbnail', 'ochahouse' ),
				'type'           => Controls_Manager::NUMBER,
				'default'        => 4,
				'tablet_default' => 1,
				'mobile_default' => 1,
                'condition' => [
					'slider_layouts'             => 'layout1',
				],
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label'          => esc_html__( 'posts to Scroll', 'ochahouse' ),
				'type'           => Controls_Manager::NUMBER,
				'default'        => 1,
				'tablet_default' => 1,
				'mobile_default' => 1,
			]
		);
        $this->add_control(
			'center_mode',
			[
				'label'        => esc_html__( 'Center Mode', 'ochahouse' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
        	$this->add_responsive_control(
			'center_padding',
			[
				'label'     => esc_html__( 'Center Padding', 'ochahouse' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'condition' => [
					'center_mode'             => 'yes',
				],
                'selectors' => [
					'{{WRAPPER}} .slider_layout_layout5 + .custom_navs button.nav_left' => 'left: {{VALUE}};',
                    '{{WRAPPER}} .slider_layout_layout5 + .custom_navs button.nav_right' => 'right: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label'        => esc_html__( 'Autoplay', 'ochahouse' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'ochahouse' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'selectors' => [
					'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
				],
				'condition' => [
					'autoplay'             => 'yes',
				],
			]
		);
		$this->add_control(
			'pause_on_hover',
			[
				'label'        => esc_html__( 'Pause on Hover', 'ochahouse' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'autoplay'             => 'yes',
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label'        => esc_html__( 'Infinite Loop', 'ochahouse' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'transition_speed',
			[
				'label'     => esc_html__( 'Transition Speed (ms)', 'ochahouse' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 500,
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
			'testimonials_slider_style',
			[
				'label' => esc_html__( 'Content', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
                $this->add_control(
		'align',
				[
					'label' 		=> esc_html__( 'Align', 'ochahouse' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'default' 		=> 'center',
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
							'{{WRAPPER}} .testimonials_slider .slider-content' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
       $this->add_responsive_control(
			'column_gap',
			[
				'label'     => esc_html__( 'Columns Gap', 'ochahouse' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .slick-slide' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
                    '{{WRAPPER}} .slider_layout_layout5 + .custom_navs button.nav_left' => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 + 25px );',
                    '{{WRAPPER}} .slider_layout_layout5 + .custom_navs button.nav_right' => 'margin-right: calc( {{SIZE}}{{UNIT}}/2 + 25px );',
				],
			]
		);
        $this->add_responsive_control(
			'width_slider',
			[
				'label'     => esc_html__( 'Width Slider', 'ochahouse' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 300,
						'max' => 1920,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testimonials_slider .slick-list' => 'max-width:{{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
					'box_bgcolor',
					[
						'label' 	=> esc_html__( 'Box Background Color', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .slider-content' => 'background: {{VALUE}} !important;',
						],
					]
		);
    $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testimonials_slider_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .jws_testimonials_slider_wrap .slider-content',
                	'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_box',
				'placeholder' => '1px',
				'selector' => '{{WRAPPER}} .jws_testimonials_slider_wrap .slider-content',
			
			]
		);
                $this->add_responsive_control(
					'testimonials_slider_box_border_radius',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Radius', 'ochahouse' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .slider-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_responsive_control(
					'testimonials_slider_margin',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Margin', 'ochahouse' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .slider-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        
        $this->add_responsive_control(
					'testimonials_slider_padding',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Padding', 'ochahouse' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
 $this->add_control(
			'testimonials_slider_title',
			[
				'label' => esc_html__( 'Title', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'testimonials_slider_title_color',
					[
						'label' 	=> esc_html__( 'Title Color', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '#333333',
						'selectors' => [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials_title' => 'color: {{VALUE}} !important;',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'testimonials_slider_title_typography',
				'label' => esc_html__( 'Typography', 'ochahouse'),
				'selector' => '{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials_title',
			]
		);
         $this->add_responsive_control(
					'title_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_control(
			'testimonials_slider_des',
			[
				'label' => esc_html__( 'Description', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'testimonials_slider_description_color',
					[
						'label' 	=> esc_html__( 'Description Color', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '#333333',
						'selectors' => [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials-description' => 'color: {{VALUE}} !important;',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'testimonials_slider_description_typography',
				'label' => esc_html__( 'Typography', 'ochahouse'),
				'selector' => '{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials-description',
			]
		);
         $this->add_responsive_control(
					'description_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_control(
			'testimonials_slider_name',
			[
				'label' => esc_html__( 'Name', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'testimonials_slider_name_color',
					[
						'label' 	=> esc_html__( 'Name Color', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '#333333',
						'selectors' => [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials-title' => 'color: {{VALUE}} !important;',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'testimonials_slider_name_typography',
				'label' => esc_html__( 'Typography', 'ochahouse'),
				'selector' => '{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials-title',
			]
		);
        $this->add_responsive_control(
					'name_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_control(
			'testimonials_slider_job',
			[
				'label' => esc_html__( 'job', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'testimonials_slider_job_color',
					[
						'label' 	=> esc_html__( 'job Color', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '#333333',
						'selectors' => [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials-job' => 'color: {{VALUE}} !important;',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'testimonials_slider_job_typography',
				'label' => esc_html__( 'Typography', 'ochahouse'),
				'selector' => '{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials-job',
			]
		);
        $this->add_responsive_control(
					'job_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials-job' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
         $this->add_control(
			'testimonials_slider_icon',
			[
				'label' => esc_html__( 'Icon', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'icon_color',
					[
						'label' 	=> esc_html__( 'Icon Color', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .testimonials_slider .testimonials-icon' => 'color: {{VALUE}};',
						],
					]
		);
         $this->add_control(
					'icon_bgcolor',
					[
						'label' 	=> esc_html__( 'Icon Background Color', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .testimonials_slider .testimonials-icon' => 'background: {{VALUE}} !important;',
						],
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
						'{{WRAPPER}} .testimonials_slider .testimonials-icon' => 'font-size: {{SIZE}}px;',
					],
				]
		);
        $this->add_responsive_control(
					'icon_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .testimonials_slider .testimonials-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_control(
			'testimonials_slider_avatar',
			[
				'label' => esc_html__( 'Avatar', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
					'testimonials_slider_avatar_box_radius',
					[
						'label' 		=> esc_html__( 'Border Radius', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testimonials_slider_avatar_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider img',
			]
		);

        $this->end_controls_section();
        $this->start_controls_section(
			'testimonials_slider_dot_style',
			[
				'label' => esc_html__( 'Dots', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
         $this->add_control(
					'dot_color',
					[
						'label' 	=> esc_html__( 'Color', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .custom_dots .slick-dots li:not(.slick-active) button::after' => 'border-color: {{VALUE}};',
						],
					]
		);
         $this->add_control(
					'dot_color_active',
					[
						'label' 	=> esc_html__( 'Color Active', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .custom_dots .slick-dots li.slick-active button::after' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .custom_dots .slick-dots li.slick-active button::after' => 'border-color: {{VALUE}};',						
                            ],
					]
		);
         $this->add_control(
					'dot_brcolor_active',
					[
						'label' 	=> esc_html__( 'Border Color Active', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .custom_dots .slick-dots li button .circle-go' => 'stroke: {{VALUE}};',
                            '{{WRAPPER}} .slick-dots li.slick-active button::before' => 'border: 1px solid {{VALUE}};',
						],
					]
		);
        $this->end_controls_section();
                $this->start_controls_section(
			'testimonials_slider_nav_style',
			[
				'label' => esc_html__( 'Navs', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
					'nav_color',
					[
						'label' 	=> esc_html__( 'Color', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .custom_navs .slick-arrow' => 'color: {{VALUE}};',
						],
					]
		);
         $this->add_control(
					'nav_color_active',
					[
						'label' 	=> esc_html__( 'Color Active', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .custom_navs .slick-arrow:hover' => 'color: {{VALUE}};',
						],
					]
		);
         $this->add_responsive_control(
			'nav_size',
			[
				'label'     => esc_html__( 'Nav Size', 'ochahouse' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws_testimonials_slider_wrap .custom_navs .slick-arrow' => 'font-size:{{SIZE}}px;',
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
		$settings = $this->get_settings();
            
            $classes = $settings['slider_layouts'];
            $classes .= isset($settings['thumbnail_slider_position']) ? ' thumbnail_position_'.$settings['thumbnail_slider_position'] : '';
            
            $dots = ($settings['navigation'] == 'dots' || $settings['navigation'] == 'both') ? 'true' : 'false';
            $arrows = ($settings['navigation'] == 'arrows' || $settings['navigation'] == 'both') ? 'true' : 'false';
            $center = ($settings['center_mode'] == 'yes') ? 'true' : 'false';
            $autoplay = ($settings['autoplay'] == 'yes') ? 'true' : 'false';
            $pause_on_hover = ($settings['pause_on_hover'] == 'yes') ? 'true' : 'false';
            $infinite = ($settings['infinite'] == 'yes') ? 'true' : 'false';
            $autoplay_speed = ($settings['autoplay_speed']) ? $settings['autoplay_speed'] : '0';
            
 $settings['slides_to_show'] = isset($settings['slides_to_show']) && !empty($settings['slides_to_show']) ? $settings['slides_to_show'] : '3';
                $settings['slides_to_show_tablet'] = isset($settings['slides_to_show_tablet']) && !empty($settings['slides_to_show_tablet']) ? $settings['slides_to_show_tablet'] : $settings['slides_to_show'];
                $settings['slides_to_show_mobile'] = isset($settings['slides_to_show_mobile']) && !empty($settings['slides_to_show_mobile']) ? $settings['slides_to_show_mobile'] : $settings['slides_to_show'];
                $settings['slides_to_scroll'] = isset($settings['slides_to_scroll']) && !empty($settings['slides_to_scroll']) ? $settings['slides_to_scroll'] : '1';
                $settings['slides_to_scroll_tablet'] = isset($settings['slides_to_scroll_tablet']) && !empty($settings['slides_to_scroll_tablet']) ? $settings['slides_to_scroll_tablet'] : $settings['slides_to_scroll'];
                $settings['slides_to_scroll_mobile'] = isset($settings['slides_to_scroll_mobile']) && !empty($settings['slides_to_scroll_mobile']) ? $settings['slides_to_scroll_mobile'] : $settings['slides_to_scroll']; 
 
            $center_padding = $center == 'true' ? $settings['center_padding'] : '0px';
    
            $settings['center_padding_tablet'] = isset($settings['center_padding_tablet']) ? $settings['center_padding_tablet'] : $center_padding;
            $settings['center_padding_mobile'] = isset($settings['center_padding_mobile']) ? $settings['center_padding_mobile'] : $center_padding;
            
    
            $data_slick = 'data-slick=\'{ "slidesToShow":'.$settings['slides_to_show'].' ,"slidesToScroll": '.$settings['slides_to_scroll'].', "autoplay": '.$autoplay.',"arrows": '.$arrows.', "dots":'.$dots.', "autoplaySpeed": '.$autoplay_speed.',"pauseOnHover":'.$pause_on_hover.',"infinite":'.$infinite.',
            "speed": '.$settings['transition_speed'].', "centerMode": '.$center.',"centerPadding": "'.$center_padding.'", "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": '.$settings['slides_to_show_tablet'].',"slidesToScroll": '.$settings['slides_to_scroll_tablet'].',"centerPadding": "'.$settings['center_padding_tablet'].'"}},
            {"breakpoint": 768,"settings":{"slidesToShow": '.$settings['slides_to_show_mobile'].',"slidesToScroll": '.$settings['slides_to_scroll_mobile'].',"centerPadding": "'.$settings['center_padding_mobile'].'"}}]}\''; 
		if ( $settings['list'] ) {
		     ?>
		      	<div class="jws_testimonials_slider_wrap <?php echo esc_attr($classes); ?>">
                   <?php 
                    if($settings['slider_layouts'] == 'layout1' && $settings['thumbnail_slider_position'] == 'top') {
                       $data_slick_thumbnail = 'data-slick=\'{ "slidesToShow":'.$settings['slides_to_show_thumbnail'] .' ,"slidesToScroll":1,"arrows": false, "dots":false,
                       "speed": '.$settings['transition_speed'].', "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow":3}},
                       {"breakpoint": 768,"settings":{"slidesToShow":2}}]}\'';    
                       ?>
                       <div class="testimonials_slider_thumbnail" <?php echo ''.$data_slick_thumbnail; ?>>  
                		  <?php foreach (  $settings['list'] as $item ) {
                              ?>
                				<div class="slick-slide">
                                    <?php if(!empty($item['image']['id'])) echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item );?>       
                                </div>
                		  <?php } ?>
                      </div>
                    <?php }
                   ?> 
                  <div class="testimonials_slider<?php echo ' slider_layout_'.$settings['slider_layouts'] .''; ?>" <?php echo ''.$data_slick; ?>>  
            		  <?php foreach (  $settings['list'] as $item ) {
            		      $url = $item['list_url']['url'];
                          $target = $item['list_url']['is_external'] ? ' target="_blank"' : '';
                          $nofollow = $item['list_url']['nofollow'] ? ' rel="nofollow"' : ''; 
                          ?>
            				<div class="slick-slide">
                                    <?php  include( 'layout/'.$settings['slider_layouts'].'.php' ); ?>   
                            </div>
            		  <?php } ?>
                  </div>

                  <?php if($arrows == 'true') : ?>
                 <nav class="jws-banner-nav">
                       <span class="prev-item jws-carousel-btn"><span class="jws-icon-arrow_carrot-left"></span></span>
                        <span class="next-item jws-carousel-btn"><span class="jws-icon-arrow_carrot-right"></span></span>
                  </nav>
                  <?php endif; ?>
                  <?php if($settings['navigation'] == 'dots' || $settings['navigation'] == 'both') : ?><div class="custom_dots"></div><?php endif; ?>
                </div>
		    <?php }  
		
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