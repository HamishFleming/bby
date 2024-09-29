<?php

namespace Elementor;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class JWS_Timeline extends Widget_Base {

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
		return 'jws_timeline';
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
		return __( 'Jws Timeline', 'ochahouse' );
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
		return 'eicon-site-search';
	}
    /**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
    public function get_script_depends() {
		return [ 'appear' ];
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
	 * Register Woo post Grid controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_controls() {

        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Menu List', 'ochahouse' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
				'slider_layouts',
				[
					'label'     => __( 'Layout', 'ochahouse' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'layout1',
					'options'   => [
						'layout1'   => __( 'layout 1', 'ochahouse' ),
						'layout2'   => __( 'layout 2', 'ochahouse' ),
					],
				]
		);
		$repeater = new \Elementor\Repeater();
        $repeater->add_control(
			'active',
			[
				'label' => __( 'Active', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'ochahouse' ),
				'label_off' => __( 'Off', 'ochahouse' ),
				'return_value' => 'yes',
			]
		);
        $repeater->add_control(
			'list_year', [
				'label' => __( 'Year', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '1994' , 'ochahouse' ),
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'list_title', [
				'label' => __( 'Title', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title' , 'ochahouse' ),
				'label_block' => true,
			]
		);
    $repeater->add_control(
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
        $repeater->add_control(
			'list_content', [
				'label' => __( 'Content', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Content', 'ochahouse' ),
				'placeholder' => __( 'Type your content here', 'ochahouse' ),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'Menu List', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Title #1', 'ochahouse' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();
        
        $this->start_controls_section(
			'timeline_style',
			[
				'label' => __( 'Content', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
					'timeline_margin',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> __( 'Margin', 'ochahouse' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_timeline .jws_timeline_main .jws_days .jws_timeline_field .jws_timeline_content .jws_timeline_content_inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
            $this->add_control(
			'timeline_year',
			[
				'label' => __( 'Year', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'timeline_year_color',
					[
						'label' 	=> __( 'Year Color', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws_timeline .jws_timeline_main .jws_days .jws_timeline_field .jws_timeline_date_inner .jws_timeline_year' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'timeline_year_typography',
				'label' => __( 'Typography', 'ochahouse'),
				'selector' => '{{WRAPPER}} .jws_timeline .jws_timeline_main .jws_days .jws_timeline_field .jws_timeline_date_inner .jws_timeline_year',
			]
		);
        $this->add_control(
			'timeline_des',
			[
				'label' => __( 'Description', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'timeline_description_color',
					[
						'label' 	=> __( 'Description Color', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws_timeline .jws_timeline_content .jws_timeline_content_inner .jws_timeline_desc' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'timeline_description_typography',
				'label' => __( 'Typography', 'ochahouse'),
				'selector' => '{{WRAPPER}} .jws_timeline .jws_timeline_content .jws_timeline_content_inner .jws_timeline_desc',
			]
		);

        $this->add_control(
			'timeline_title',
			[
				'label' => __( 'Title', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'timeline_title_color',
					[
						'label' 	=> __( 'Title Color', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws_timeline .jws_timeline_main .jws_days .jws_timeline_field .jws_timeline_content .jws_timeline_title' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'timeline_title_typography',
				'label' => __( 'Typography', 'ochahouse'),
				'selector' => '{{WRAPPER}} .jws_timeline .jws_timeline_main .jws_days .jws_timeline_field .jws_timeline_content .jws_timeline_title',
			]
		);
         $this->add_control(
			'testimonials_slider_icon',
			[
				'label' => __( 'Icon', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'icon_color',
					[
						'label' 	=> __( 'Icon Color', 'ochahouse' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .jws_timeline .jws_timeline_main .jws_days .jws_timeline_field .jws_timeline_date .jws_timeline_date_inner .jws_timeline_icon' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_control(
				'icon_size',
				[
					'label' 		=> __( 'Icon Size', 'ochahouse' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 1,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .jws_timeline .jws_timeline_main .jws_days .jws_timeline_field .jws_timeline_date .jws_timeline_date_inner .jws_timeline_icon' => 'font-size: {{SIZE}}px;',
					],
				]
		);
        $this->add_control(
			'testimonials_slider_avatar',
			[
				'label' => __( 'Avatar', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
					'testimonials_slider_avatar_box_radius',
					[
						'label' 		=> __( 'Border Radius', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .timeline img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testimonials_slider_avatar_box_shadow',
				'label' => __( 'Box Shadow', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .jws_testimonials_slider_wrap .timeline img',
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
    ?>
        <div class="jws_timeline">
            <div class="jws_timeline_main">
                <div class="jws_days">
                    <?php $i = 1; foreach (  $settings['list'] as $item ) { $position = ($i%2 != 0) ? ' position_right' : ' position_left';
                        $active = ($item['active']) ? ' active' : '';
                     ?>
            				<div class="jws_timeline_field<?php echo esc_attr($position.$active); ?>">
                                 <div class="jws_timeline_circle"></div> 
                                 <div class="jws_timeline_content">
                                    <div class="jws_timeline_content_inner">
                                        <div class="jws_timeline_date_inner">
                                            <p class="jws_timeline_year">
                                                <?php echo esc_html($item['list_year']); ?>
                                            </p>
                                        </div>
                                        <h3 class="jws_timeline_title">
                                            <?php echo esc_html($item['list_title']); ?>
                                        </h3>
                                        <div class="jws_timeline_desc">
                                            <?php echo ''.$item['list_content']; ?>
                                        </div>
                                        <span class="jws_content_line"></span>
                                    </div>
                                 </div>
                                <div class="jws_timeline_date">
                                    <div class="jws_timeline_date_inner"> 
                                        <span class="jws_timeline_icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );  ?>  
                                        </span>
                                    </div>   
                                 </div>  
                            </div>
            		 <?php $i++; } ?>
                </div>
                <div class="jws_timeline_line"></div>
            </div>
        </div>    
	<?php }
    
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