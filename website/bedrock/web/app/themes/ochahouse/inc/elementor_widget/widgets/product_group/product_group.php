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
class Jws_Product_Group extends Widget_Base {

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
		return 'jws_product_group';
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
		return esc_html__( 'Jws Product Group', 'ochahouse' );
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
		return 'eicon-gallery-grid';
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
 
    public function get_tabs_list() { 
        
        global $jws_option;
        
        
        if(isset($jws_option['gallery_category']) && !empty($jws_option['gallery_category'])) {
          
    
      
            $tabsok = array();
            foreach (  $jws_option['gallery_category'] as $index => $item_tabs ) { 
              $tabsok[ preg_replace('/[^a-zA-Z]+/', '', $item_tabs) ] = $item_tabs;     
           
            };  
            return $tabsok;
        }
        
    
    }
    /**
     * Load style
     */
    public function get_style_depends()
    {
        return [''];
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
        return [''];
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
				'group_title',
				[
					'label'     => esc_html__( 'Title', 'ochahouse' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => 'Latest colllections',
				]
		);
        
        $this->add_control(
				'group_button',
				[
					'label'     => esc_html__( 'Button Text', 'ochahouse' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => 'Create your Jewelry',
				]
		);
        
         
        $this->add_control(
			'button_url',
			[
				'label' => esc_html__( 'Button Url', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'ochahouse' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
				],
			]
		);
        
        $this->add_control(
				'image_size',
				[
					'label'     => esc_html__( 'Image Size', 'ochahouse' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => 'full',
				]
		);
        $this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image Maps', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
 
        $this->end_controls_section(); 
   

	    $this->start_controls_section(
			'setting_section_list',
			[
				'label' => esc_html__( 'Product List', 'ochahouse' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);   
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'product_title',
			[
				'label' => esc_html__( 'Title', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Text for map', 'ochahouse' ),
			]
		);
        
        $repeater->add_control('inc_product_ids', [
                'label' => esc_html__('Choose product', 'ochahouse'),
                'description' => esc_html__('', 'ochahouse'),
                'type' => Controls_Manager::SELECT,
                'multiple' => true,
                'options' => $this->get_list_posts('product'),
        ]);
        
        $repeater->add_responsive_control(
			'item-position-left',
			[
				'label' => esc_html__( 'Left', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws_product_maps_inner {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $repeater->add_responsive_control(
			'item-position-top',
			[
				'label' => esc_html__( 'Top', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws_product_maps_inner {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'Menu List', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
        $this->end_controls_section();

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
        
         ?>
         <div class="jws_product_group_element">
            <div class="jws_product_group row row-eq-height">
                <div class="jws_product_slider col-xl-3 col-lg-6 col-12">
                   
                     <?php  foreach (  $settings['list'] as $index => $item ) {
                        if($item['inc_product_ids']) {
                            
                            $attach_id = get_post_thumbnail_id($item['inc_product_ids']);
                            $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => '500x590' , 'class' => 'product_group_slider'));  
                            
                            
                            $_product = wc_get_product($item['inc_product_ids']); // Get the product 
                            $size = 'shop_catalog';                          
                            $image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
                            $html = '<div class="product-item-inner slick-slide">';
                            if($attach_id) {
                                $html .= '<div class="product-image"><a href="' . esc_url( get_permalink( $item['inc_product_ids'] ) ) . '">'.$img['thumbnail'].'</a></div>';   
                            }
                            $html .= '<div class="woocommerce-loop-product__title"><a href="' . esc_url( get_permalink( $item['inc_product_ids'] ) ) . '">' . get_the_title( $item['inc_product_ids'] ) . '</a></div>';
                            $html .= '<span class="price">' . $_product->get_price_html() . '</span>';
                            $html .= '</div>';
                            echo ''.$html;
                        }   
                     } ?>
                </div>
                <div class="jws_product_maps col-xl-6 col-lg-6 col-12 hidden_tablet hidden_mobile">
                    <div class="jws_product_maps_inner">
                        <?php 
                             $attach_id = $settings['image']['id'];
                             $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $settings['image_size'], 'class' => 'product_maps'));   
                             if($attach_id) {
                                echo ''.$img['thumbnail'];
                             }

                             $i = 1; foreach (  $settings['list'] as $index => $item ) { if($i == 1) $active = ' active'; ?>
                                <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']);?><?php if($i == 1) echo ' active'; ?>" data-index="<?php echo esc_attr($i - 1); ?>"><span><?php echo esc_html($i); ?></span></div>   
                             <?php $i++; }
                        ?>
                    </div>
                </div>
                <div class="jws_tabs col-xl-3 col-lg-6 col-12">
                  <?php 
                    if($settings['group_title']) {
                        echo '<h2>'.$settings['group_title'].'</h2>';
                    }
                   ?>  
                  <div class="jws_tab">
                      <?php $i = 1; foreach (  $settings['list'] as $index => $item ) { ?>
                        <a href="#" class="jws_tab_item<?php if($i == 1) echo ' active'; ?>"  data-index="<?php echo esc_attr($i - 1); ?>"><?php echo esc_html($item['product_title']); ?></a>  
                      <?php $i++; } ?>
                  </div>
                  
                  
                  <?php 
                       if($settings['button_url']['is_external']) $this->add_render_attribute( 'group_button', 'rel',  'nofollow' );
                       if($settings['button_url']['nofollow']) $this->add_render_attribute( 'group_button', 'target',  '_blank' );  
                       $this->add_render_attribute( 'group_button', 'href',  $settings['button_url']['url'] ); 
                       if($settings['group_button']) {
                        echo '<a class="buton-to-all" '.$this->get_render_attribute_string('group_button').'>'.$settings['group_button'].'<i class="jws-icon-arrow-right-thin"></i></a>';
                       }
                       
                  ?>
                      
                </div>  
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