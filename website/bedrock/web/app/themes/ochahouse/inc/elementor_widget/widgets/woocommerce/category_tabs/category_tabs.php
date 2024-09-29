<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

/**
 * jwsProductAdvanced
 *
 * @author jwsSoft <hello.jwssoft@gmail.com>
 * @package jws
 */
if (class_exists('WooCommerce')):
    final class JwsCategoryList extends Widget_Base
    {
        /**
         * @return string
         */
        function get_name()
        {
            return 'jws-category-list';
        }

        /**
         * @return string
         */
        function get_title()
        {
            return esc_html__('jws Category List', 'ochahouse');
        }

        /**
         * @return string
         */
        function get_icon()
        {
            return 'cs-font jws-icon-cart-3';
        }
        /**
         * @return array
         */
        public function get_categories()
        {
            return ['jws-elements'];
        }
        /**
         * Register controls
         */
        protected function register_controls()
        {
            
           
            $this->start_controls_section(
                'section_options', [
                'label' => esc_html__('Options', 'ochahouse')
            ]);
            $this->add_control(
				'layouts',
				[
					'label'     => esc_html__( 'Layout', 'ochahouse' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'layout1',
					'options'   => [
						'layout1'   => esc_html__( 'Layout1 With (Category Images 2)', 'ochahouse' ),
						'layout2'   => esc_html__( 'Layout2', 'ochahouse' ),
                        'layout3'   => esc_html__( 'Layout3', 'ochahouse' ),
					],
                    
				]
			);
            $this->add_control(
    			'image_size',
    			[
    				'label' => esc_html__( 'Image Size', 'ochahouse' ),
    				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
    				'default' => [
    					'width' => '',
    					'height' => '',
    				],
                    'condition'	=> [
						'layouts!' => 'layout1',
				    ],
    			]
    		  );

            // Grid
            $this->add_responsive_control('display', [
                'label' => esc_html__('Display', 'ochahouse'),
                'description' => esc_html__('', 'ochahouse'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid', 'ochahouse'),
                    'slider' => esc_html__('Slider', 'ochahouse'),
                ],

            ]);
            //Cate
            $this->add_control('filter_categories', [
                'label' => esc_html__('Categories', 'ochahouse'),
                'description' => esc_html__('', 'ochahouse'),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => true,
                'options' => $this->get_categories_for_jws('product_cat', 2),
              
            ]);
            $this->add_control('default_category', [
                'label' => esc_html__('Default categories', 'ochahouse'),
                'description' => esc_html__('', 'ochahouse'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => $this->get_categories_for_jws('product_cat'),
              
            ]);
            
            $this->add_control('title', [
                'label' => esc_html__('Title Default Category All', 'ochahouse'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Top categories', 'ochahouse'),
                'condition' => [
                    'default_category' => ['all'],
                ],
            ]);
            
            $this->add_control('filter_categories_for_asset', [
                'label' => esc_html__('Categories Default Category Alll', 'ochahouse'),
                'description' => esc_html__('', 'ochahouse'),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => true,
                'options' => $this->get_categories_for_jws('product_cat', 2),
                'condition' => [
                    'default_category' => ['all'],
                ],
              
            ]);

            $this->add_control('orderby', [
                'label' => esc_html__('Order by', 'ochahouse'),
                'description' => esc_html__('', 'ochahouse'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => $this->get_woo_order_by_for_jws(),
            ]);
            $this->add_control('order', [
                'label' => esc_html__('Order', 'ochahouse'),
                'description' => esc_html__('', 'ochahouse'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => $this->get_woo_order_for_jws(),
            ]);
            
            // Grid
            $this->add_responsive_control('columns', [
                'label' => esc_html__('Columns for row', 'ochahouse'),
                'description' => esc_html__('', 'ochahouse'),
                'type' => Controls_Manager::SELECT,
                'default' => '20',
                'options' => [
                    '1' => esc_html__('12', 'ochahouse'),
                    '2' => esc_html__('6', 'ochahouse'),
                    '3' => esc_html__('4', 'ochahouse'),
                    '4' => esc_html__('3', 'ochahouse'),
                    '6' => esc_html__('2', 'ochahouse'),
                    '12' => esc_html__('1', 'ochahouse'),
                    '20' => esc_html__('5', 'ochahouse'),
                    '2' => esc_html__('6', 'ochahouse'),
                ],

            ]);
            $this->end_controls_section();
            
            $this->start_controls_section(
                'normal_style_settings', [
                'label' => esc_html__('Style', 'ochahouse'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);
            
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
    					'{{WRAPPER}} .category-tab-item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
    					'{{WRAPPER}} .category-content.row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
    				],
    			]
    		);
    
    		$this->add_responsive_control(
    			'row_gap',
    			[
    				'label'     => esc_html__( 'Rows Gap', 'ochahouse' ),
    				'type'      => Controls_Manager::SLIDER,
    				'range'     => [
    					'px' => [
    						'min' => 0,
    						'max' => 100,
    					],
    				],
    				'selectors' => [
    					'{{WRAPPER}} .category-tab-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
							'{{WRAPPER}} .category-tab-item a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		  );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label'     => esc_html__( 'Font Name Category', 'ochahouse' ),
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .category-tab-item a h4',
                ]
            );    
       $this->end_controls_section();
       $this->start_controls_section(
			'setting_navigation',
			[
				'label' => esc_html__( 'Setting Navigation', 'ochahouse' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
    				'enable_nav',
    				[
    					'label'        => esc_html__( 'Enable Nav', 'ochahouse' ),
    					'type'         => Controls_Manager::SWITCHER,
    					'label_on'     => esc_html__( 'Yes', 'ochahouse' ),
    					'label_off'    => esc_html__( 'No', 'ochahouse' ),
    					'return_value' => 'yes',
    					'default'      => 'yes',
    					'description'  => esc_html__( 'Enable nav arrow.', 'ochahouse' ),
    				]
    	);
        $this->add_control(
    				'enable_dots',
    				[
    					'label'        => esc_html__( 'Enable Dots', 'ochahouse' ),
    					'type'         => Controls_Manager::SWITCHER,
    					'label_on'     => esc_html__( 'Yes', 'ochahouse' ),
    					'label_off'    => esc_html__( 'No', 'ochahouse' ),
    					'return_value' => 'yes',
    					'default'      => 'yes',
    					'description'  => esc_html__( 'Enable dot.', 'ochahouse' ),
    				]
    	);

        $this->add_control(
			'dots_color',
			[
				'label' => esc_html__( 'Color', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_slider_element .jws_slider .flickity-page-dots li.is-selected' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .jws_slider_element .jws_slider .flickity-page-dots li:before' => 'background: {{VALUE}}',
				],
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


		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'          => esc_html__( 'posts to Show', 'ochahouse' ),
				'type'           => Controls_Manager::NUMBER,
		
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label'          => esc_html__( 'posts to Scroll', 'ochahouse' ),
				'type'           => Controls_Manager::NUMBER,
			
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
			'center',
			[
				'label'        => esc_html__( 'Cener Mode', 'ochahouse' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
        
       
        $this->add_control(
			'variablewidth',
			[
				'label'        => esc_html__( 'variable Width', 'ochahouse' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
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
 
        }

        /**
         * Load style
         */
        public function get_style_depends()
        {
            return ['jws-style'];
        }

        /**
         * Retrieve the list of scripts the image carousel widget depended on.
         *
         * Used to set scripts dependencies required to run the widget.
         *
         * @since 1.3.0
         * @access public
         *
         * @return array Widget scripts dependencies.
         */
        public function get_script_depends()
        {
            return ['jws-script'];
        }
        protected function get_categories_for_jws($taxonomy, $select = 1)
        {
            $data = array();
    
            $query = new \WP_Term_Query(array(
                'hide_empty' => false,
                'taxonomy'   => $taxonomy,
            ));
            if ($select == 1) {
                $data['all'] = 'All';
            }
    
            if (! empty($query->terms)) {
                foreach ($query->terms as $cat) {
                    $data[ $cat->slug ] = $cat->name;
                }
            }
    
            return $data;
        }

        protected function get_list_posts($post_type = 'post')
        {
            $args = array(
                'post_type'        => $post_type,
                'suppress_filters' => true,
                'posts_per_page'   => 300,
                'no_found_rows'    => true,
            );
    
            $the_query = new \WP_Query($args);
            $results   = [];
    
            if (is_array($the_query->posts) && count($the_query->posts)) {
                foreach ($the_query->posts as $post) {
                    $results[ $post->ID ] = sanitize_text_field($post->post_title);
                }
            }
    
            return $results;
        }
            /**
     * Get oder by
     *
     * @return array oder_by
     */
    protected function get_woo_order_by_for_jws()
    {
        $order_by = array(
            'date'       => esc_html__('Date', 'ochahouse'),
            'menu_order' => esc_html__('Menu order', 'ochahouse'),
            'title'      => esc_html__('Title', 'ochahouse'),
            'rand'       => esc_html__('Random', 'ochahouse'),
        );

        return $order_by;
    }

    /**
     * Get oder
     *
     * @return array order
     */
    protected function get_woo_order_for_jws()
    {
        $order = array(
            'desc' => esc_html__('DESC', 'ochahouse'),
            'asc'  => esc_html__('ASC', 'ochahouse'),
        );

        return $order;
    }
        /**
         * Render
         */
        protected function render()
        {
            // default settings
            $settings = array_merge([
                'title' => '',
                'tabs_filter' => 'cate',
                'filter_categories' => '',
                'default_category' => '',
                'asset_type' => 'all',
                'filter_assets' => '',
                'default_asset' => '',
                'product_ids' => '',
                'orderby' => 'date',
                'order' => 'desc',
                'posts_per_page' => 6,
                'columns' => '',
                'pagination' => '',
                'slides_to_show' => 4,
                'speed' => 5000,
                'scroll' => 1,
                'autoplay' => 'true',
                'show_pag' => 'true',
                'show_nav' => 'true',
                'nav_position' => 'middle-nav',
               

            ], $this->get_settings_for_display());

            $this->add_inline_editing_attributes('title');

            $this->add_render_attribute('title', 'class', 'jws-title');

            include 'content.php';
       
        }
    }
endif;