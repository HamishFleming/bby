<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Schemes;

/**
 * Elementor image widget.
 *
 * Elementor widget that displays an image into the page.
 *
 * @since 1.0.0
 */
class Jws_Logo extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve image widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'jws_logo';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve image widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Jws Logo', 'ochahouse' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve image widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-logo';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the image widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'jws-elements' ];
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
		return [ 'image', 'photo', 'visual' ];
	}

	/**
	 * Register image widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image', 'ochahouse' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'ochahouse' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
        $this->add_control(
			'image_sticky',
			[
				'label' => esc_html__( 'Choose Image Sticky', 'ochahouse' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
			]
		);
        $this->add_control(
			'logo_size',
			[
				'label' => esc_html__( 'Image Size', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'full', 'ochahouse' ),
				'placeholder' => esc_html__( 'Add size for image, example 300x300 or full,thumbnail', 'ochahouse' ),
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'ochahouse' ),
				'type' => Controls_Manager::CHOOSE,
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_to',
			[
				'label' => esc_html__( 'Link', 'ochahouse' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'ochahouse' ),
					'file' => esc_html__( 'Media File', 'ochahouse' ),
					'custom' => esc_html__( 'Custom URL', 'ochahouse' ),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'ochahouse' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'ochahouse' ),
				'condition' => [
					'link_to' => 'custom',
				],
				'show_label' => false,
			]
		);

	
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'ochahouse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->start_controls_tabs( 'image_size_c' );

		$this->start_controls_tab( 'size_normal',
			[
				'label' => esc_html__( 'Normal', 'ochahouse' ),
			]
		);
        
        $this->add_responsive_control(
					'image_marign',
					[
						'label' 		=> esc_html__( 'Margin', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-logo img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label' => esc_html__( 'Max Width', 'ochahouse' ) . ' (%)',
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_tab();
        $this->start_controls_tab( 'size_sticky',
			[
				'label' => esc_html__( 'Sticky', 'ochahouse' ),
			]
		);
        $this->add_control(
				'enable_sticky',
				[
					'label'        => esc_html__( 'Enable Sticky', 'ochahouse' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'ochahouse' ),
					'label_off'    => esc_html__( 'No', 'ochahouse' ),
					'return_value' => 'yes',
					'default'      => '',
					'description'  => esc_html__( 'Enable custom for sticky', 'ochahouse' ),
                    'prefix_class' => 'logo_sticky_',
				]
		);
        $this->add_responsive_control(
					'image_marign2',
					[
						'label' 		=> esc_html__( 'Margin', 'ochahouse' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'.is-sticky.active-sticky .elementor-logo.has_logo_sticky .logo-sticky' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
						],
                        'condition'    => [
						  'enable_sticky' => 'yes',
					    ],
					]
		);
		$this->add_responsive_control(
			'width2',
			[
				'label' => esc_html__( 'Width', 'ochahouse' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					' .logo_sticky_yes .elementor-logo .logo-sticky img' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
                'condition'    => [
						  'enable_sticky' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'space2',
			[
				'label' => esc_html__( 'Max Width', 'ochahouse' ) . ' (%)',
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					' .logo_sticky_yes .elementor-logo .logo-sticky img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
				],
                'condition'    => [
						  'enable_sticky' => 'yes',
				],	    
			]
		);
        
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
	}



	/**
	 * Render image widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();


 global $jws_option;
	

		$this->add_render_attribute( 'wrapper', 'class', 'elementor-logo' );
        if(!empty($settings['image_sticky']['url'])) $this->add_render_attribute( 'wrapper', 'class', 'has_logo_sticky' );

		$link = $this->get_link_url( $settings );

		if ( $link ) {

			$this->add_link_attributes( 'link', $link );

		} 
          $src = $jws_option['logo']['url'];
        
        ?>
      
		<div <?php echo ''.$this->get_render_attribute_string( 'wrapper' ); ?>>

			<?php if ( $link ) : ?>
					<a <?php echo ''.$this->get_render_attribute_string( 'link' ); ?>>
			<?php endif; ?>
            
            <span class="logo-inner">
                <?php 
                     
        if (isset($settings['image']['url']) && $settings['image']['url'] != "") {
             if (function_exists('jws_getImageBySize')) {
                         $attach_id = $settings['image']['id'];
                         $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $settings['logo_size'], 'class' => 'logo-image'));
                         echo ''.$img['thumbnail'];
                     }
        }else if (!empty($jws_option['logo']['url'])) { 
          
            if (function_exists('jws_getImageBySize')) {
                         $attach_id = $jws_option['logo']['id'];
                         $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $settings['logo_size'], 'class' => 'logo-image'));
                         echo ''.$img['thumbnail'];
                     }
          ?>  
        <?php }
                    
                ?>
            </span>
          
            
            <?php if(!empty($settings['image_sticky'])) : ?>
            <span class="logo-sticky">
                 <?php 
                     if (function_exists('jws_getImageBySize')) {
                         $attach_id = $settings['image_sticky']['id'];
                         $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $settings['logo_size'], 'class' => 'logo-image'));
                         echo !empty($img['thumbnail']) ? $img['thumbnail'] : '';
                     }
                ?>
            </span>
            <?php endif; ?>
			<?php if ( $link ) : ?>
					</a>
			<?php endif; ?>

		</div>
		<?php
	}


	protected function content_template() {}

	/**
	 * Retrieve image widget link URL.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param array $settings
	 *
	 * @return array|string|false An array/string containing the link URL, or false if no link.
	 */
	private function get_link_url( $settings ) {
		if ( 'none' === $settings['link_to'] ) {
			return false;
		}

		if ( 'custom' === $settings['link_to'] ) {
			if ( empty( $settings['link']['url'] ) ) {
				return false;
			}

			return $settings['link'];
		}

		return [
			'url' => $settings['image']['url'],
		];
	}
}
