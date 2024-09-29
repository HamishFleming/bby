<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Instagram extends Widget_Base {

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
		return 'jws_instagram';
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
		return esc_html__( 'Jws Instagram', 'ochahouse' );
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
		return 'eicon-video-camera';
	}
    
    public function get_script_depends() {
        return [
            'instafeed',
        ];
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
			'section_instagram_setting',
			[
				'label' => esc_html__( 'Setting', 'ochahouse' ),
			]
		);
        $this->add_control(
				'layouts',
				[
					'label'     => esc_html__( 'Layout', 'ochahouse' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'grid',
					'options'   => [
                        'slider'   => esc_html__( 'Slider', 'ochahouse' ),
						'grid'   => esc_html__( 'Grid', 'ochahouse' ),
                     
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
							'{{WRAPPER}} .jws_instagram' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
		$this->add_responsive_control(
			'columns',
			[
				'label'          => esc_html__( 'Columns', 'ochahouse' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '3',
				'options'        => [
					'12' => '1',
					'6' => '2',
					'4' => '3',
					'3' => '4',
					'20' => '5',
					'2' => '6',
				],
			]
		);
		
		$this->end_controls_section();
          $this->start_controls_section(
			'section_instagram_list',
			[
				'label' => esc_html__( 'Instagram List', 'ochahouse' ),
			]
		);
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        
        $repeater->add_control(
			'link_url',
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
        
        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'Gallery List', 'ochahouse' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
        
        
        $this->end_controls_section();
        
        
                	$this->start_controls_section(
			'section_slider_options',
			[
				'label'     => esc_html__( 'Slider Options', 'ochahouse' ),
				'type'      => Controls_Manager::SECTION,
                'condition'=>['layouts'=>'slider'],
			]
		);


		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'          => esc_html__( 'posts to Show', 'ochahouse' ),
				'type'           => Controls_Manager::NUMBER,
				'default'        => 1,
				'tablet_default' => 1,
				'mobile_default' => 1,
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
			'transition_speed',
			[
				'label'     => esc_html__( 'Transition Speed (ms)', 'ochahouse' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 500,
			]
		);
		$this->end_controls_section();
                $this->start_controls_section(
			'slider_style',
			[
				'label' => esc_html__( 'Slider', 'ochahouse' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .jws-instagram .instagram-wap .jws-instagram-item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .jws-instagram .instagram-wap' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
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
					'{{WRAPPER}} .jws-instagram .instagram-wap .jws-instagram-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
        $id       = $this->get_id();
        if($settings['layouts']=='slider'){      
        $autoplay = ($settings['autoplay'] == 'yes') ? 'true' : 'false';
        $pause_on_hover = ($settings['pause_on_hover'] == 'yes') ? 'true' : 'false';
        $infinite = ($settings['infinite'] == 'yes') ? 'true' : 'false';
        $center = ($settings['center'] == 'yes') ? 'true' : 'false';
        
        $settings['slides_to_show_tablet'] = isset($settings['slides_to_show_tablet']) ? $settings['slides_to_show_tablet'] : $settings['slides_to_show'];
        $settings['slides_to_show_mobile'] = isset($settings['slides_to_show_mobile']) ? $settings['slides_to_show_mobile'] : $settings['slides_to_show'];
        
        $settings['slides_to_scroll_tablet'] = isset($settings['slides_to_scroll_tablet']) ? $settings['slides_to_scroll_tablet'] : $settings['slides_to_scroll'];
        $settings['slides_to_scroll_mobile'] = isset($settings['slides_to_scroll_mobile']) ? $settings['slides_to_scroll_mobile'] : $settings['slides_to_scroll']; 
        
        
        $autoplay_speed = ($settings['autoplay_speed']) ? $settings['autoplay_speed'] : '0';
        $data_slick = 'data-slick=\'{"slidesToShow":'.$settings['slides_to_show'].' ,"slidesToScroll": '.$settings['slides_to_scroll'].', "autoplay": '.$autoplay.', "autoplaySpeed": '.$autoplay_speed.',"pauseOnHover":'.$pause_on_hover.',"centerMode":'.$center.', "infinite":'.$infinite.',
        "speed": '.$settings['transition_speed'].', "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": '.$settings['slides_to_show_tablet'].',"slidesToScroll": '.$settings['slides_to_scroll_tablet'].'}},
        {"breakpoint": 768,"settings":{"slidesToShow": '.$settings['slides_to_show_mobile'].',"slidesToScroll": '.$settings['slides_to_scroll_mobile'].'}}]}\''; 
          
        }else{
              $class_column .= 'col-xl-'.$settings['columns'].'';
                $class_column .= (!empty($settings['columns_tablet'])) ? ' col-lg-'.$settings['columns_tablet'].'' : ' col-lg-'.$settings['columns'].'' ;
                $class_column .= (!empty($settings['columns_mobile'])) ? ' col-'.$settings['columns_mobile'].'' :  ' col-'.$settings['columns'].'';
                $loading_icon = '';
                $data_slick=' ';
        }
        ?>
            <div class="jws-instagram"  >
                <div class="row instagram-wap <?php if($settings['layouts']=='slider'){echo 'instagram_image_slider';} ?>"  <?php echo ''.$data_slick; ?>>
                   <?php foreach (  $settings['list'] as $key => $item ) {
                   $link_key = 'link' . $key;  
                   if($item['link_url']['nofollow']) $this->add_render_attribute( $link_key, 'rel',  'nofollow' );
                   if($item['link_url']['is_external']) $this->add_render_attribute( $link_key, 'target',  '_blank' );  
                   $this->add_render_attribute( $link_key, 'href',  $item['link_url']['url'] ); 
                    $this->add_render_attribute( $link_key, 'class', 'overlay' );  
                    $attach_id = $item['image']['id'];
                  $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => '385x385', 'class' => 'instagram-images'));

                    ?>
                    
                    
                    <div class="jws-instagram-item <?php if($settings['layouts']=='grid'){echo esc_attr($class_column);} ?>" >
                        <div class="jws-instagram-inner">
                            <a <?php echo ''.$this->get_render_attribute_string($link_key); ?>>
                            
                                <i aria-hidden="true" class="fab fa-instagram"></i>
                                <p class="follow_text"><?php echo esc_html__('Follow Us','ochahouse');?></p>
                            </a>
                            <?php echo ''.$img['thumbnail']; ?>
                        </div>
                    </div>
     
                <?php
         }
        ?>
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