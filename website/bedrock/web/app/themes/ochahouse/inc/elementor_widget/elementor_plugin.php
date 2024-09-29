<?php
// direct load is not allowed
if ( ! defined( 'ABSPATH' ) ) {
	die();
}
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0
 */
class Plugin {
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
    public function enqueue_editor_scripts() {
        wp_register_script('jws-query-control', JWS_URI_PATH . '/inc/elementor_widget/control/js/query.js', array(), '', true);
    }
    public function enqueue_frontend_scripts() {
    	
    }
    public function get_scripts($name_js_ccs) {
        wp_enqueue_script($name_js_ccs);
    }
    /**
     * Include Control files
     *
     * Load controls files
     *
     * @since 1.2.0
     * @access private
     */
    private function include_control_files() {
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/control/query.php');

    }
    public function register_controls($controls_manager) {
        // Its is now safe to include Control files
        $this->include_control_files();

        $controls_manager->register( new JwsElementor\Control\Query());
      
    }
    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.2.0
     * @access public
     */
    public function register_widgets() {
        
        // Its is now safe to include Widgets files
        

        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/title/title.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/woocommerce/category_tabs/category_tabs.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/chart/chart.php');

        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/timeline/timeline.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/account/account.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/menu_nav/menu_nav.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/video_popup/video_popup.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/info_box/info_box.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/testimonial_slider/testimonial_slider.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/blog/blog.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/team/team.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/breadcrumbs/breadcrumbs.php');

        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/tab/tab.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/pricing_table/pricing_table.php');


        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/contact_form7/contact_form7.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/map/map.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/search/search.php');



        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/dropdown_text/dropdown_text.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/off_canvas/off_canvas.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/login_form/login_form.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/banner/banner.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/iframe/iframe.php');
 
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/logo/logo.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/button/button.php');

        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/jws_gallery/jws_gallery.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/menu_list/menu_list.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/demo_filter/demo_filter.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/tooltip/tooltip.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/instagram/instagram.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/slider/slider.php');
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/countdown/countdown.php');
    


        
        if (class_exists( 'YITH_WCWL' ) ) {
            require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/woocommerce/wishlist/wishlist.php');	   
        }
        
        /**
         * Register Widgets Woocommerce
         */
        if (class_exists('Woocommerce')) {  
            require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/product_group/product_group.php');
            require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/product_tabs/product_tab.php');
            require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/woocommerce/mini-cart/mini-cart.php');
        }

        /**
         * Register Widgets Wordpress
         */
        		
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/wordpress/category/category.php');  
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/wordpress/tag/tag.php');
        
         
        
        
        
        // Register Widgets
        if (class_exists('Woocommerce')) {  
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\JwsProductAdvanced()); 
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Menu_Cart());
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\JwsCategoryList());
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Product_Group());
        }
        
        \Elementor\Plugin::instance()->widgets_manager->register(new Category());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Tag());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Heading_Elementor_Widget());

        \Elementor\Plugin::instance()->widgets_manager->register( new Elementor\PieCharts() );
        \Elementor\Plugin::instance()->widgets_manager->register( new Elementor\JWS_Timeline() );
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Account());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Nav_Menu());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Video_popup());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Info_Box());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Testimonial_Slider());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Blog());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Team());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Breadcrumbs());

        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_tab());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Price_Table());


        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_cf7());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\GoogleMap());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Search());


        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Dropdown_Text());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Offcanvas());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Login_form());
       
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Banner());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Iframe());


        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Logo());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Gradient_Button());

        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Gallery());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Menu_list());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Demo());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Tooltip());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Instagram());
        
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Slider());
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Countdown_Elementor_Widget());
        
  
        
        
     

        
        if (class_exists( 'YITH_WCWL' ) ) {
            \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Wishlist());
        }
        
    }
    public function register_categoris() {
        \Elementor\Plugin::$instance->elements_manager->add_category('jws-elements', ['title' => esc_html__('JWS Themes Widget', 'ochahouse'), 'icon' => 'fa fa-plug', ], 1);

    }
    
    public function register_element() {
        include_once ('row-cutom.php');
		\Elementor\Plugin::$instance->elements_manager->unregister_element_type( 'section' );
		\Elementor\Plugin::$instance->elements_manager->register_element_type( new Jws_Section() );

	}
    
    public function load_styles() {
        wp_enqueue_style('jws-admin-styles', JWS_URI_PATH.'/assets/css/admin.css');
	}
    
    
    public function register_document_controls( $document ) { 
        
        $document->start_controls_section(
			'jws_custom_css_settings',
			array(
				'label' => esc_html__( 'Jws Custom CSS', 'ochahouse' ),
				'tab'   => Elementor\Controls_Manager::TAB_ADVANCED,
			)
		);

		$document->add_control(
				'page_css',
				array(
					'type' => Elementor\Controls_Manager::TEXTAREA,
					'rows' => 40,
				)
		);

		$document->end_controls_section();
        
    }
    
    
    public function save_page_custom_css_js( $self, $data ) { 
        
        if ( empty( $data['settings'] ) || empty( $_REQUEST['editor_post_id'] ) ) {
			return;
		}
		$post_id = absint( $_REQUEST['editor_post_id'] );

		// save Riode elementor page CSS
		if ( ! empty( $data['settings']['page_css'] ) ) {
			update_post_meta( $post_id, 'page_css', wp_slash( $data['settings']['page_css'] ) );
		} else {
			delete_post_meta( $post_id, 'page_css' );
		}
        
    }
    
    public function save_elementor_page_css_js( $self, $data ) { 
       
       if ( current_user_can( 'unfiltered_html' ) || empty( $data['settings'] ) || empty( $_REQUEST['editor_post_id'] ) ) {
			return;
		}
		$post_id = absint( $_REQUEST['editor_post_id'] );
		if ( ! empty( $data['settings']['page_css'] ) ) {
			$elementor_settings = get_post_meta( $post_id, '_elementor_page_settings', true );
			if ( is_array( $elementor_settings ) ) {
				$elementor_settings['page_css'] =  get_post_meta( $post_id, 'page_css', true  );
				update_post_meta( $post_id, '_elementor_page_settings', $elementor_settings );
			}
		} 
        
    }
    
    
    public function jws_add_icon_library( $icons ) {
            WP_Filesystem();
            global $wp_filesystem;
            // Append new icons
            $upload_dir = wp_upload_dir(); 
            $file_dirname = $upload_dir['basedir'] . '/jws_icons.json';
            if(!file_exists($file_dirname)) wp_mkdir_p($file_dirname);

            $string =  $wp_filesystem->get_contents(JWS_URI_PATH. '/assets/font/jws_icon/config.json');
            $json_a = json_decode($string,true);
            $icon_aray = array();
            foreach ($json_a['glyphs'] as $key => $value){
                $icon_aray[] = $value['css'];
            } 
            
            $icon_arays['icons'] = $icon_aray;
            
            $icon_end = json_encode($icon_arays);
 
            $file = JWS_ABS_PATH. '/assets/font/jws_icon/icon.json';

            $wp_filesystem->put_contents($file, $icon_end);

			$icons['jws-icons'] = array(
				'name'          => 'jws',
				'label'         => esc_html__( 'Jws Icons', 'ochahouse' ),
				'prefix'        => 'jws-icon-',
				'displayPrefix' => ' ',
				'labelIcon'     => 'jws-icon',
			    'url'           => JWS_URI_PATH . '/assets/font/jws_icon/jwsicon.css',
				'native'        => false,
               'fetchJson'     =>  JWS_URI_PATH. '/assets/font/jws_icon/icon.json',
		        'ver'           => '1.0.0',
			);
	
		return $icons;
	}
    
    
    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct() {
        include_once ('shade_animation.php');
        include_once ('row-sticky.php');
        include_once ('font-custom.php');
        include_once ('tabs-name-custom.php');
        
        add_action('init', array($this, 'register_categoris'));
        // Register widgets
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        // Register controls
        add_action('elementor/controls/controls_registered', [$this, 'register_controls']);
        // Editor Scripts
        add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_editor_scripts']);
        // Frontend Scripts
        add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'enqueue_frontend_scripts' ]);
        
        add_action( 'elementor/elements/elements_registered', array( $this, 'register_element' ) );
        
        add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'load_styles' ) );
        
        add_action( 'elementor/documents/register_controls', array( $this, 'register_document_controls' ) );
        
        if ( wp_doing_ajax() ) {
			add_action( 'elementor/document/before_save', array( $this, 'save_page_custom_css_js' ), 10, 2 );
			add_action( 'elementor/document/after_save', array( $this, 'save_elementor_page_css_js' ), 10, 2 );
		}
        
        add_action(
			'elementor/editor/after_enqueue_scripts',
			function() {
                wp_enqueue_script( 'jws-elementor-admin-js', JWS_URI_PATH. '/assets/js/widget-js/elementor-admin.js', array( 'elementor-editor' ) , '', true );
			}
		);
        
        if(is_admin()) {
          add_filter( 'elementor/icons_manager/additional_tabs', array( $this, 'jws_add_icon_library' ) );  
        }  
    }
}
// Instantiate Plugin Class
Plugin::instance();

/**
* Custom Widget Default
*/

//Gallery

add_action( 'elementor/element/image-gallery/section_gallery_images/before_section_end', function( $element, $args ) {
    $element->add_control(
		'align_gallery',
				[
					'label' 		=> esc_html__( 'Align Item', 'ochahouse' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'options' 		=> [
						'top'    		=> [
							'title' 	=> esc_html__( 'Top', 'ochahouse' ),
							'icon' 		=> 'eicon-v-align-top',
						],
						'center' 		=> [
							'title' 	=> esc_html__( 'Middle', 'ochahouse' ),
							'icon' 		=> 'eicon-v-align-middle',
						],
						'bottom' 		=> [
							'title' 	=> esc_html__( 'Bottom', 'ochahouse' ),
							'icon' 		=> ' eicon-v-align-bottom',
						],
					],
                    'selectors' => [
							'{{WRAPPER}} .elementor-image-gallery .gallery' => 'align-items: {{VALUE}};',
					],
					'frontend_available' => true,
				]
   ); 
   
		$element->add_responsive_control(
			'galery_column_gap',
			[
				'label'       => esc_html__( 'Columns Gap', 'ochahouse' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [
					'px',
					'em',
					'%',
				],
				'selectors'   => [
					'{{WRAPPER}} .elementor-image-gallery .gallery  .gallery-item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
                    	'{{WRAPPER}} .elementor-image-gallery .gallery' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
			],
        ]
   );
 		$element->add_responsive_control(
			'galery_row_gap',
			[
				'label'       => esc_html__( ' Rows Gap', 'ochahouse' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [
					'px',
					'em',
					'%',
				],
				'selectors'   => [
					'{{WRAPPER}} .elementor-image-gallery .gallery  .gallery-item' => 'padding-bottom:{{SIZE}}{{UNIT}};',
                    	'{{WRAPPER}} .elementor-image-gallery .gallery' => 'margin-bottom:-{{SIZE}}{{UNIT}};',
			     ],
            ]
        );			
  
}, 10, 2 );

//Image Box
add_action( 'elementor/element/image-box/section_style_content/before_section_end', function( $element, $args ) {
    $element->add_control(
		'title_hover_color',
		[
			'label' =>  esc_html__( 'Title Hover Color', 'ochahouse' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-image-box-title:hover a' => 'color: {{VALUE}}',
			],
		]
   ); 

  
}, 10, 2 );
add_action( 'elementor/element/image-box/section_style_image/before_section_end', function( $element, $args ) {

       $element->add_responsive_control(
		'image_spacing_bottom',
		[
			'label' =>  esc_html__( 'Image Spacing Bottom', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
			'selectors' => [
				'{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-img' => 'margin-bottom: {{SIZE}}px',
			],
		]
   ); 
  
}, 10, 2 );
//Counter
add_action( 'elementor/element/counter/section_number/before_section_end', function( $element, $args ) {

          		$element->add_responsive_control(
			'suffix_typography',
			[
				'label' => esc_html__( 'Suffix size', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-counter .elementor-counter-number-suffix' => 'font-size: {{SIZE}}px',
			],
            ]
		);
          $element->add_control(
			'jws_suffix',
			[
				'label' =>  esc_html__( 'Suffix Color', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-counter .elementor-counter-number-suffix' => 'color: {{VALUE}}',
				],
			]
	   );
  
}, 10, 2 );

//Price List 
add_action( 'elementor/element/price-list/section_list_style/before_section_end', function( $element, $args ) {

        $element->add_responsive_control(
					'list_separator_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-price-list-separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

					
					]
		);
  
}, 10, 2 );
add_action( 'elementor/element/price-list/section_item_style/before_section_end', function( $element, $args ) {
		$element->add_responsive_control(
			'list_price_align',
			[
				'label'     => esc_html__( 'Vertical Alignment Content', 'ochahouse' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'middle',
				'options'   => [
					'start'    => [
						'title' => esc_html__( 'Top', 'ochahouse' ),
						'icon'  => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Middle', 'ochahouse' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'end' => [
						'title' => esc_html__( 'Bottom', 'ochahouse' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
                'selectors_dictionary' => [
					'start' => 'flex-start',
					'end' => 'flex-end',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-price-list .elementor-price-list-item .elementor-price-list-header' => 'align-items: {{VALUE}} !important;',
				],
			]
		);
        $element->add_responsive_control(
					'list_header_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-price-list .elementor-price-list-item .elementor-price-list-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
  
}, 10, 2 );
//Countdown
add_action( 'elementor/element/countdown/section_content_style/before_section_end', function( $element, $args ) {
    $element->add_responsive_control(
		'digits_size',
		[
			'label' =>  esc_html__( 'Width Digits', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 2,
					],
				],
			'selectors' => [
				'{{WRAPPER}} .elementor-countdown-digits' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height:{{SIZE}}{{UNIT}}',
			],
		]
   ); 
   $element->add_control(
		'digits_background',
		[
			'label' =>  esc_html__( 'Digits Background', 'ochahouse' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-countdown-digits' => 'background-color: {{VALUE}}',
			],
		]
   );
   $element->add_control(
		'digits_border_radius',
		[
			'label' =>  esc_html__( 'Border radius', 'ochahouse' ),
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-countdown-digits' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
   ); 
      $element->add_control(
		'digits_margin',
		[
			'label' =>  esc_html__( 'Margin', 'ochahouse' ),
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-countdown-digits' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
   );
  
}, 10, 2 );
//Form
add_action( 'elementor/element/form/section_field_style/before_section_end', function( $element, $args ) {
    $element->add_control(
		'field_padding',
		[
			'label' =>  esc_html__( 'Padding', 'ochahouse' ),
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .elementor-field-group:not(.elementor-field-type-upload) .elementor-field:not(.elementor-select-wrapper)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
   ); 
  
}, 10, 2 );
add_action( 'elementor/element/form/section_icon/before_section_end', function( $element, $args ) {

     $element->add_control(
			'hover_select',
			[
				'label' =>  esc_html__( 'Hover Change All Content', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' =>  esc_html__( 'none', 'ochahouse' ),
                    'all' =>  esc_html__( 'All Content', 'ochahouse' ),
				],
				'default' => 'none',
                'prefix_class' => 'elementor_icon_hover_',
			]
	);
    
    $element->add_control(
			'hover_all',
			[
				'label' =>  esc_html__( 'Color Hover', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor_icon_hover_all:hover  .elementor-icon-box-content .elementor-icon-box-description , {{WRAPPER}}.elementor_icon_hover_all:hover  .elementor-icon-box-content .elementor-icon-box-title , {{WRAPPER}}.elementor_icon_hover_all:hover .elementor-icon' => 'color: {{VALUE}}',
				],
                'condition' => [
						  'hover_select' => 'all',
				],
			]
	);
  
	
}, 10, 2 );

add_action( 'elementor/element/icon-box/section_style_icon/before_section_end', function( $element, $args ) {

        $element->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' =>  esc_html__( 'Box Shadow', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .elementor-icon',
			]
		);

  
	
}, 10, 2 ); 
add_action( 'elementor/element/icon-box/section_style_content/before_section_end', function( $element, $args ) {
    $element->add_control(
			'text_color_hover',
			[
				'label' =>  esc_html__( 'Color Hover', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .elementor-icon-box-title:hover' => 'color: {{VALUE}}',
				],
			]
	);
        	
}, 10, 2 ); 


add_action( 'elementor/element/accordion/section_title_style/before_section_end', function( $element, $args ) {

    $element->add_control(
			'spacing',
			[
				'label' =>  esc_html__( 'Spacing', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
	);
     $element->add_control(
			'radius',
			[
				'label' =>  esc_html__( 'Border Radius', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
    $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jws_ac_border',
				'label' =>  esc_html__( 'Border', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .elementor-accordion .elementor-accordion-item',
			]
		);

}, 10, 2 );
add_action( 'elementor/element/accordion/section_toggle_style_title/before_section_end', function( $element, $args ) {
        $element->add_responsive_control(
					'title_active_padding',
					[
						'label' 		=> esc_html__( 'Padding Active', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-tab-title.elementor-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);    
}, 10, 2 );
add_action( 'elementor/element/icon-box/section_style_icon/before_section_end', function( $element, $args ) {

        $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon-box-border',
				'label' =>  esc_html__( 'Border', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .elementor-icon',
			]
		);
  
	
}, 10, 2 );

add_action( 'elementor/element/accordion/section_toggle_style_icon/before_section_end', function( $element, $args ) {

        $element->add_control(
			'icon_size',
			[
				'label' =>  esc_html__( 'Icon Size', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
         $element->add_control(
			'icon_padding',
			[
				'label' =>  esc_html__( 'Padding', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
  
	
}, 10, 2 );

add_action( 'elementor/element/accordion/section_toggle_style_title/before_section_end', function( $element, $args ) {

         $element->add_control(
			'toggle_radius',
			[
				'label' =>  esc_html__( 'Boder Radius', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
        $element->add_control(
			'toggle_background_active',
			[
				'label' =>  esc_html__( 'Background Active', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}}',
				],
			]
	   );
       $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'toggle_border',
				'label' =>  esc_html__( 'Border', 'ochahouse' ),
				'selector' => 'body {{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-tab-title',
			]
		);

        
        $element->add_control(
			'toggle_border_active',
			[
				'label' =>  esc_html__( 'Border Color Active', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body {{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-tab-title.elementor-active' => 'border-color: {{VALUE}}',
				],
			]
	   );
        
        
        $element->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'toggle_box_shadow',
				'label' =>  esc_html__( 'Box Shadow Active', 'ochahouse' ),
				'selector' => 'body {{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-tab-title.elementor-active',
			]
		);
	
}, 10, 2 );

/* Count Down */

add_action( 'elementor/element/countdown/section_box_style/before_section_end', function( $element, $args ) {

    $element->add_responsive_control(
			'countdown_width',
			[
				'label' =>  esc_html__( 'Width', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .elementor-countdown-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
	);
    
    $element->add_responsive_control(
			'countdown_height',
			[
				'label' =>  esc_html__( 'Height', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .elementor-countdown-item' => 'height:{{SIZE}}{{UNIT}};line-height:{{SIZE}}{{UNIT}};',
				],
			]
	);

}, 10, 2 );

add_action( 'elementor/element/button/section_style/before_section_end', function( $element, $args ) {

        $element->add_control(
			'icon_size',
			[
				'label' =>  esc_html__( 'Icon Size', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
         $element->add_control(
			'icon_btn_margin',
			[
				'label' =>  esc_html__( 'Icon Margin', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-button-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
  
	
}, 10, 2 );

add_action( 'elementor/element/tabs/section_tabs_style/before_section_end', function( $element, $args ) {
        $element->add_responsive_control(
			'tabnav_padding',
			[
				'label' =>  esc_html__( 'Navigation Padding', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-tabs-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
	   );    
        $element->add_responsive_control(
			'tab_padding',
			[
				'label' =>  esc_html__( 'Title Padding', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  .elementor-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
	   );
         $element->add_responsive_control(
			'tab_margin',
			[
				'label' =>  esc_html__( 'Title Margin', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
	   );
  
	
}, 10, 2 );

add_action( 'elementor/element/icon-list/section_icon_style/before_section_end', function( $element, $args ) {
         $element->add_responsive_control(
			'list-icon_margin',
			[
				'label' =>  esc_html__( 'Margin', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
	   );
	
}, 10, 2 );
add_action( 'elementor/element/icon-list/section_text_style/before_section_end', function( $element, $args ) {
        $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list-icon_border',
				'label' =>  esc_html__( 'Border', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item .elementor-icon-list-text',
			]
		);
        $element->add_control(
			'list-icon_border_hover',
			[
				'label' =>  esc_html__( 'Border Hover Color', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-element .elementor-icon-list-items .elementor-icon-list-item:hover .elementor-icon-list-text' => 'border-color: {{VALUE}}',
				],
			]
	   );
	
}, 10, 2 );
add_action( 'elementor/element/progress/section_progress_style/before_section_end', function( $element, $args ) {
       $element->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'              => 'progress_bg',
				'types'             => [ 'classic', 'gradient' ],
				'selector'          => '{{WRAPPER}} .elementor-progress-wrapper .elementor-progress-bar',
			]
	   );
         $element->add_control(
			'progress_bg_radius_render',
			[
				'label' =>  esc_html__( 'Border Radius Inner', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-progress-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
}, 10, 2 );
add_action( 'elementor/element/tabs/section_tabs_style/before_section_end', function( $element, $args ) {
        $element->add_responsive_control(
			'icon_size',
			[
				'label' =>  esc_html__( 'Content Width', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-tabs.elementor-tabs-view-vertical .elementor-tabs-content-wrapper' => 'width: {{SIZE}}%;',
				],
			]
	);
}, 10, 2 );
add_action( 'elementor/element/animated-headline/section_style_text/before_section_end', function( $element, $args ) {

       $element->add_control(
			'animated-headline-after-color',
			[
				'label' =>  esc_html__( 'Animated Clip After Color', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-headline-animation-type-clip .elementor-headline-dynamic-wrapper:after' => 'background-color: {{VALUE}}',
				],
			]
	   );

  
	
}, 10, 2 );    
add_action( 'elementor/element/post-info/section_text_style/before_section_end', function( $element, $args ) {

       $element->add_control(
			'post-info-color-hover',
			[
				'label' =>  esc_html__( 'Color Hover', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item:hover .elementor-icon-list-text , {{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item a:hover' => 'color: {{VALUE}}',
				],
			]
	   );
        $element->add_control(
			'post-info-before-color',
			[
				'label' =>  esc_html__( 'Before Color', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item .elementor-icon-list-text .elementor-post-info__item-prefix' => 'color: {{VALUE}}',
				],
			]
	   );

  
	
}, 10, 2 );   


add_action( 'elementor/element/accordion/section_toggle_style_content/before_section_end', function( $element, $args ) {
      $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'label' =>  esc_html__( 'Border', 'ochahouse' ),
				'selector' => '{{WRAPPER}} .elementor-tab-content',
			]
		);  
      $element->add_control(
			'toggle_margin',
			[
				'label' =>  esc_html__( 'Margin', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );

  
	
}, 10, 2 ); 

add_action( 'elementor/element/heading/section_title_style/before_section_end', function( $element, $args ) {

        $element->add_control(
			'heading_hover',
			[
				'label' =>  esc_html__( 'Color Hover', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-heading .elementor-heading-title:hover' => 'color: {{VALUE}}',
				],
			]
	   );

  
	
}, 10, 2 ); 

