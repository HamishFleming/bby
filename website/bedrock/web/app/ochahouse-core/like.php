<?php
class jws_theme_jwsLove {
	public $post_id;
	 function __construct($post_id = null)   {
		$this->ppost_id = $post_id;
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_jws-love', array($this, 'ajax'));
		add_action('wp_ajax_nopriv_jws-love', array($this, 'ajax'));
	}

	function enqueue_scripts() {
        wp_enqueue_script( 'post-favorite', plugin_dir_url( __FILE__ ) .  '/like.js', array(), '', true );
		global $post;
		wp_localize_script('post-favorite', 'jwsLove', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'postID' => $post ? $post->ID : 0,
			'rooturl' => home_url()
		));
	}

	function ajax($post_id) {
		//update
		if( isset($_POST['loves_id']) ) {
			$post_id = str_replace('jws-love-', '', $_POST['loves_id']);
			echo wp_kses_post($this->love_post($post_id, 'update'));
		}
		//get
		else {
			$post_id = str_replace('jws-love-', '', $_POST['loves_id']);
			echo wp_kses_post($this->love_post($post_id, 'get'));
		}
		exit;
	}

	function love_post($post_id, $action = 'get')
	{
		if(!is_numeric($post_id)) return;

		switch($action) {

			case 'get':
				$love_count = get_post_meta($post_id, '_jws_love', true);
				if( !$love_count ){
					$love_count = 0;
					add_post_meta($post_id, '_jws_love', $love_count, true);
				}

				return '<span class="jws-love-count">'. $love_count .'</span>';
				break;

			case 'update':
				$love_count = get_post_meta($post_id, '_jws_love', true);
				if( isset($_COOKIE['jws_love_'. $post_id]) ) return $love_count;

				$love_count++;
				update_post_meta($post_id, '_jws_love', $love_count);
				setcookie('jws_love_'. $post_id, $post_id, time()*20, '/');

				return '<span class="jws-love-count">'. $love_count .'</span>';
				break;

		}
	}

	function add_love($unit = '',$show_icon = true) {
		global $post;
        
		$output = $this->love_post($post->ID);
  		$class = 'jws-love';
  		$title = esc_html__('Love this', 'idealauto');
		if( isset($_COOKIE['jws_love_'. $post->ID]) ){
			$class = 'jws-love loved';
			$title = esc_html__('You already love this!', 'idealauto');
		}

		return '<a href="#" class="'. $class .'" id="jws-love-'. $post->ID .'" title="'. $title .'"><i class="far fa-heart"> </i> <span class="count">'. $output .'</span><span class="like_text">'.$unit.'</span></a>';
	}

}
global $post_favorite;
$post_favorite = new jws_theme_jwsLove();
?>
