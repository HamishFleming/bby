<?php
namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Jws_Price_Table extends Widget_Base {

	public function get_name() {
		return 'jws-price-table';
	}

	public function get_title() {
		return esc_html__( 'Jws Price Table', 'ochahouse' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_keywords() {
		return [ 'pricing', 'table', 'product', 'image', 'plan', 'button' ];
	}
    public function get_categories() {
		return [ 'jws-elements' ];
	}

	protected function register_controls() {
	   
       $this->start_controls_section(
			'section_setting',
			[
				'label' => esc_html__( 'Setting', 'ochahouse' ),
			]
		);

        
        $this->end_controls_section();
       
       
		$this->start_controls_section(
			'section_header',
			[
				'label' => esc_html__( 'Header', 'ochahouse' ),
			]
		);

		$this->add_control(
			'heading',
			[
				'label' => esc_html__( 'Title', 'ochahouse' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter your title', 'ochahouse' ),
			]
		);

		$this->add_control(
			'sub_heading',
			[
				'label' => esc_html__( 'Description', 'ochahouse' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter your description', 'ochahouse' ),
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_pricing',
			[
				'label' => esc_html__( 'Pricing', 'ochahouse' ),
			]
		);

		$this->add_control(
			'price',
			[
				'label' => esc_html__( 'Price', 'ochahouse' ),
				'type' => Controls_Manager::TEXT,
				'default' => '$25',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'period',
			[
				'label' => esc_html__( 'Period', 'ochahouse' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Monthly', 'ochahouse' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_features',
			[
				'label' => esc_html__( 'Features', 'ochahouse' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_text',
			[
				'label' => esc_html__( 'Text', 'ochahouse' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'List Item', 'ochahouse' ),
			]
		);

		$default_icon = [
			'value' => 'far fa-check-circle',
			'library' => 'fa-regular',
		];

		$repeater->add_control(
			'selected_item_icon',
			[
				'label' => esc_html__( 'Icon', 'ochahouse' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'item_icon',
				'default' => $default_icon,
			]
		);

		$repeater->add_control(
			'list_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table  .jws-price-table__features-list {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .jws-price-table .jws-price-table__features-list {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'features_list',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'item_text' => esc_html__( 'List Item #1', 'ochahouse' ),
						'selected_item_icon' => $default_icon,
					],
					[
						'item_text' => esc_html__( 'List Item #2', 'ochahouse' ),
						'selected_item_icon' => $default_icon,
					],
					[
						'item_text' => esc_html__( 'List Item #3', 'ochahouse' ),
						'selected_item_icon' => $default_icon,
					],
				],
				'title_field' => '{{{ item_text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_footer',
			[
				'label' => esc_html__( 'Footer', 'ochahouse' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'ochahouse' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Click Here', 'ochahouse' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'ochahouse' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ochahouse' ),
				'default' => [
					'url' => '#',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'footer_detail',
			[
				'label' => esc_html__( 'View Detail', 'ochahouse' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'This is text element', 'ochahouse' ),
			]
		);
        
        $this->add_control(
			'link_detail',
			[
				'label' => esc_html__( 'Link', 'ochahouse' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ochahouse' ),
				'default' => [
					'url' => '#',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
        
		$this->end_controls_section();
        	
		$this->start_controls_section(
			'section_ribbon',
			[
				'label' => esc_html__( 'Ribbon', 'ochahouse' ),
			]
		);
    $this->add_control(
    			'show_ribbon',
    			[
    				'label' => esc_html__( 'Show Ribbon', 'ochahouse' ),
    				'type' => Controls_Manager::SWITCHER,
    				'label_on' => esc_html__( 'On', 'ochahouse' ),
    				'label_off' => esc_html__( 'Off', 'ochahouse' ),
    				'return_value' => 'yes',
    			]
    		);

		$this->add_control(
			'ribbon_text',
			[
				'label' => esc_html__( 'Title', 'ochahouse' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Popular', 'ochahouse' ),
			]
		);

		
		$this->end_controls_section();
        $this->start_controls_section(
			'section_box_style',
			[
				'label' => esc_html__( 'Table', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
        
        $this->add_responsive_control(
			'table_padding',
			[
				'label' => esc_html__( 'Padding', 'ochahouse' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
			'table_radius',
			[
				'label' => esc_html__( 'Border Radius', 'ochahouse' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'table_border',
                'label' => esc_html__( 'Border box color', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .jws-price-table',
			]
		);
    $this->add_control(
			'table_outline_color',
			[
				'label' 	=> esc_html__( 'Outline color', 'ochahouse' ),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .jws-price-table' => 'outline-color: {{VALUE}};',
				],
			]
		);

         $this->add_control(
			'table_border_hover',
			[
				'label' 	=> esc_html__( 'Border box hover', 'ochahouse' ),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .jws-price-table:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'table_shadow',
				'selector' => '{{WRAPPER}} .jws-price-table',
			]
		);
        $this->end_controls_section();
        
		$this->start_controls_section(
			'section_header_style',
			[
				'label' => esc_html__( 'Header', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
        
		$this->add_control(
			'header_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__header' => 'background-color: {{VALUE}}',
				],
			]
		);
        
		$this->add_responsive_control(
			'header_padding',
			[
				'label' => esc_html__( 'Padding', 'ochahouse' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'top_heading_color',
			[
				'label' => esc_html__( 'Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__top_heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'top_heading_typography',
				'selector' => '{{WRAPPER}} .jws-price-table__top_heading',
			]
		);

		$this->add_control(
			'heading_heading_style',
			[
				'label' => esc_html__( 'Title', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => esc_html__( 'Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .jws-price-table__heading',
			]
		);

		$this->add_control(
			'heading_sub_heading_style',
			[
				'label' => esc_html__( 'Sub Title', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sub_heading_color',
			[
				'label' => esc_html__( 'Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__subheading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_heading_typography',
				'selector' => '{{WRAPPER}} .jws-price-table__subheading',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pricing_element_style',
			[
				'label' => esc_html__( 'Pricing', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'pricing_element_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__price' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'pricing_element_padding',
			[
				'label' => esc_html__( 'Padding', 'ochahouse' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => esc_html__( 'Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table .jws-price-table__price' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .jws-price-table .jws-price-table__price',
				'condition' => [
					'period!' => '',
				],
			]
		);
        
		$this->add_control(
			'heading_period_style',
			[
				'label' => esc_html__( 'Period', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'period!' => '',
				],
			]
		);

		$this->add_control(
			'period_color',
			[
				'label' => esc_html__( 'Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table .jws-price-table__price .jws-price-table__period' => 'color: {{VALUE}}',
				],
				'condition' => [
					'period!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'period_typography',
				'selector' => '{{WRAPPER}} .jws-price-table .jws-price-table__price .jws-price-table__period',
				'condition' => [
					'period!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_features_list_style',
			[
				'label' => esc_html__( 'Features', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'features_list_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__features-list' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'features_list_padding',
			[
				'label' => esc_html__( 'Padding', 'ochahouse' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__features-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'item_border',
				'selector' => '{{WRAPPER}} .jws-price-table .jws-price-table__features-list',
			]
		);
		$this->add_control(
			'features_list_color',
			[
				'label' => esc_html__( 'Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__features-list' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'features_list_typography',
				'selector' => '{{WRAPPER}} .jws-price-table__features-list li',
			]
		);

		$this->add_control(
			'features_list_alignment',
			[
				'label' => esc_html__( 'Alignment', 'ochahouse' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'ochahouse' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ochahouse' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'ochahouse' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__features-list' => 'text-align: {{VALUE}}',
				],
			]
		);

        		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon size', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__features-list li .jws-price-table__feature-inner i' => 'font-size: {{SIZE}}px',
			],
            ]
		);
        		$this->add_responsive_control(
			'space_between',
			[
				'label' => esc_html__( 'Space Between', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__features-list li:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}}.jws-price-table__features-list li:not(:first-child)' => 'padding-top: calc({{SIZE}}{{UNIT}}/2)',
                    	'{{WRAPPER}} .jws-price-table__features-list li' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}}.jws-price-table__features-list li' => 'padding-top: calc({{SIZE}}{{UNIT}}/2)',
				],
			]
		);
	
		$this->add_control(
			'divider_gap',
			[
				'label' => esc_html__( 'Gap', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'condition' => [
					'list_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table .jws-price-table__features-list li' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_footer_style',
			[
				'label' => esc_html__( 'Footer', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'footer_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__footer' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'footer_list_alignment',
			[
				'label' => esc_html__( 'Alignment', 'ochahouse' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'ochahouse' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ochahouse' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'ochahouse' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__footer' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'footer_padding',
			[
				'label' => esc_html__( 'Padding', 'ochahouse' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_footer_button',
			[
				'label' => esc_html__( 'Button', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'button_text!' => '',
				],
			]
		);


		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'ochahouse' ),
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__button' => 'color: {{VALUE}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .jws-price-table__button',
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__button' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .jws-price-table__button',
				'condition' => [
					'button_text!' => '',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'ochahouse' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_text_padding',
			[
				'label' => esc_html__( 'Text Padding', 'ochahouse' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'ochahouse' ),
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__button:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__button:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_hover_animation',
			[
				'label' => esc_html__( 'Animation', 'ochahouse' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'heading_detail',
			[
				'label' => esc_html__( 'View Detail', 'ochahouse' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'footer_detail!' => '',
				],
			]
		);

		$this->add_control(
			'detail_color',
			[
				'label' => esc_html__( 'Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table .jws-price-table__footer .jws-price-footer_detail' => 'color: {{VALUE}}',
				],
				'condition' => [
					'footer_detail!' => '',
				],
			]
		);
        $this->add_control(
			'detail_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table .jws-price-table__footer .jws-price-footer_detail:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'footer_detail!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'detail_typography',
				'selector' => '{{WRAPPER}} .jws-price-table .jws-price-table__footer .jws-price-footer_detail',
				'condition' => [
					'footer_detail!' => '',
				],
			]
		);

		$this->add_control(
			'detail__margin',
			[
				'label' => esc_html__( 'Margin', 'ochahouse' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table .jws-price-table__footer .jws-price-footer_detail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition' => [
					'footer_detail!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ribbon_style',
			[
				'label' => esc_html__( 'Ribbon', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => [
					'show_ribbon' => 'yes',
				],
			]
		);

		$this->add_control(
			'ribbon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__ribbon-inner' => 'background-color: {{VALUE}}',
				],
			]
		);

		$ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';

		$this->add_responsive_control(
			'ribbon_distance',
			[
				'label' => esc_html__( 'Distance', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__ribbon-inner' => 'margin-top: {{SIZE}}{{UNIT}}; transform: ' . $ribbon_distance_transform,
				],
			]
		);

		$this->add_control(
			'ribbon_text_color',
			[
				'label' => esc_html__( 'Text Color', 'ochahouse' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__ribbon-inner' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ribbon_typography',
				'selector' => '{{WRAPPER}} .jws-price-table__ribbon-inner',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .jws-price-table__ribbon-inner',
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();


		$this->add_render_attribute( 'button_text', 'class', [
			'jws-price-table__button w-100',
		] );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'button_text', 'href', $settings['link']['url'] );

			if ( ! empty( $settings['link']['is_external'] ) ) {
				$this->add_render_attribute( 'button_text', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'button_text', 'rel', 'nofollow' );
			}
		}
        
        if ( ! empty( $settings['link_detail']['url'] ) ) {
			$this->add_render_attribute( 'footer_detail', 'href', $settings['link_detail']['url'] );

			if ( ! empty( $settings['link_detail']['is_external'] ) ) {
				$this->add_render_attribute( 'footer_detail', 'target', '_blank' );
			}

			if ( $settings['link_detail']['nofollow'] ) {
				$this->add_render_attribute( 'footer_detail', 'rel', 'nofollow' );
			}
		}
            
		if ( ! empty( $settings['button_hover_animation'] ) ) {
			$this->add_render_attribute( 'button_text', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
		}
        
		$this->add_render_attribute( 'heading', 'class', 'jws-price-table__heading' );
		$this->add_render_attribute( 'sub_heading', 'class', 'jws-price-table__subheading' );
		$this->add_render_attribute( 'period', 'class', [ 'jws-price-table__period', 'elementor-typo-excluded' ] );
		$this->add_render_attribute( 'footer_detail', 'class', 'jws-price-footer_detail' );

		$this->add_inline_editing_attributes( 'heading', 'none' );
		$this->add_inline_editing_attributes( 'sub_heading', 'none' );
		$this->add_inline_editing_attributes( 'period', 'none' );
		$this->add_inline_editing_attributes( 'footer_detail' );
		$this->add_inline_editing_attributes( 'button_text' );

		$period_element = '<span ' . $this->get_render_attribute_string( 'period' ) . '>/&nbsp;' . $settings['period'] . '</span>';


		$migration_allowed = Icons_Manager::is_migration_allowed();
		?>

		<div class="jws-price-table layout1">
            <?php
                 include( 'layout/layout1.php' );    
             ?>
		</div>

		<?php
	}

	protected function content_template() {}
}
