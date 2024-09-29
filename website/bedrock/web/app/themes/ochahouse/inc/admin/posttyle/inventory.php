<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    function jws_register_inventory() {
        global $jws_option;
		$labels = array(
			'name'                => _x( 'inventory', 'Post Type General Name', 'ochahouse' ),
			'singular_name'       => _x( 'inventory', 'Post Type Singular Name', 'ochahouse' ),
			'menu_name'           => esc_html__( 'Inventory', 'ochahouse' ),
			'parent_item_colon'   => esc_html__( 'Parent Item:', 'ochahouse' ),
			'all_items'           => esc_html__( 'All Items', 'ochahouse' ),
			'view_item'           => esc_html__( 'View Item', 'ochahouse' ),
			'add_new_item'        => esc_html__( 'Add New Item', 'ochahouse' ),
			'add_new'             => esc_html__( 'Add New', 'ochahouse' ),
			'edit_item'           => esc_html__( 'Edit Item', 'ochahouse' ),
			'update_item'         => esc_html__( 'Update Item', 'ochahouse' ),
			'search_items'        => esc_html__( 'Search Item', 'ochahouse' ),
			'not_found'           => esc_html__( 'Not found', 'ochahouse' ),
			'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'ochahouse' ),
		);

		$args = array(
			'label'               => esc_html__( 'Inventory', 'ochahouse' ),
		    'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt','page-attributes', 'post-formats','author' , 'custom-fields' , 'revisions' ),
            'taxonomies'          => array( 'cars_cat' ),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => ''.JWS_URI_PATH.'/assets/image/posttyle_icon/inventory_icon_type.png',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
         
		);


        if(function_exists('custom_reg_post_type')){
        	custom_reg_post_type( 'cars', $args );
        }

		/**
		 * Create a taxonomy category for inventory
		 *
		 * @uses  Inserts new taxonomy object into the list
		 * @uses  Adds query vars
		 *
		 * @param string  Name of taxonomy object
		 * @param array|string  Name of the object type for the taxonomy object.
		 * @param array|string  Taxonomy arguments
		 * @return null|WP_Error WP_Error if errors, otherwise null.
		 */
		
		$labels = array(
			'name'					=> _x( 'inventory Categories', 'Taxonomy plural name', 'ochahouse' ),
			'singular_name'			=> _x( 'inventoryCategory', 'Taxonomy singular name', 'ochahouse' ),
			'search_items'			=> esc_html__( 'Search Categories', 'ochahouse' ),
			'popular_items'			=> esc_html__( 'Popular inventory Categories', 'ochahouse' ),
			'all_items'				=> esc_html__( 'All inventory Categories', 'ochahouse' ),
			'parent_item'			=> esc_html__( 'Parent Category', 'ochahouse' ),
			'parent_item_colon'		=> esc_html__( 'Parent Category', 'ochahouse' ),
			'edit_item'				=> esc_html__( 'Edit Category', 'ochahouse' ),
			'update_item'			=> esc_html__( 'Update Category', 'ochahouse' ),
			'add_new_item'			=> esc_html__( 'Add New Category', 'ochahouse' ),
			'new_item_name'			=> esc_html__( 'New Category', 'ochahouse' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove Categories', 'ochahouse' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'ochahouse' ),
			'menu_name'				=> esc_html__( 'Category', 'ochahouse' ),
		);
	
		$args = array(
			'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'car_cat' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_cat', array( 'cars' ), $args  );
        }
        
        $labels = array(
            'name' => esc_html__( 'Tags', 'ochahouse' ),
            'singular_name' => esc_html__( 'Tag',  'ochahouse'  ),
            'search_items' =>  esc_html__( 'Search Tags' , 'ochahouse' ),
            'popular_items' => esc_html__( 'Popular Tags' , 'ochahouse' ),
            'all_items' => esc_html__( 'All Tags' , 'ochahouse' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => esc_html__( 'Edit Tag' , 'ochahouse' ), 
            'update_item' => esc_html__( 'Update Tag' , 'ochahouse' ),
            'add_new_item' => esc_html__( 'Add New Tag' , 'ochahouse' ),
            'new_item_name' => esc_html__( 'New Tag Name' , 'ochahouse' ),
            'separate_items_with_commas' => esc_html__( 'Separate tags with commas' , 'ochahouse' ),
            'add_or_remove_items' => esc_html__( 'Add or remove tags' , 'ochahouse' ),
            'choose_from_most_used' => esc_html__( 'Choose from the most used tags' , 'ochahouse' ),
            'menu_name' => esc_html__( 'Tags','ochahouse'),
        ); 
    
        $args = array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array( 'slug' => 'inventory_tag' ),
        );
        
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'inventory_tag', array( 'inventory' ), $args  );
        }

	};
add_action( 'init', 'jws_register_inventory', 1 );

function add_featured_image_column_inventory($defaults) {
    $defaults['price'] = esc_html__('Price','ochahouse');
    $defaults['featured_image'] = esc_html__('Features Image','ochahouse');
    
    $defaults['featured'] = esc_html__('Features','ochahouse');
    return $defaults;
}
add_filter('manage_cars_posts_columns', 'add_featured_image_column_inventory');
 
function show_featured_image_column_inventory($column_name, $post_id) {
    
    if ($column_name == 'featured') { 
      $featured =  get_post_meta( $post_id , 'car_asset_type',  true ); 

      ?> <a href="javascript:void(0)" data-id="<?php echo esc_attr($post_id); ?>" class="jws-make-features<?php echo (isset($featured) && $featured == 'featured') ? ' active' : ''; ?>"><i class="jws-icon-star-full"></i></a><?php
        
    }
    if ($column_name == 'featured_image') {
      $car_images =  get_post_meta( $post_id , 'car_images',  true );      
      if(!empty($car_images)) {
        $img_car = jws_getImageBySize(array('attach_id' => $car_images[0], 'thumb_size' => '508x360', 'class' => 'car-images-'.$car_images[0].''));
        if(!empty($img_car['thumbnail'])) echo ''.$img_car['thumbnail'];
        
      }
    }
    
     if ($column_name == 'price') {
      $price =  get_post_meta( $post_id , 'regular_price',  true );      
      if(!empty($price)) {
        jws_car_price_html($class = '', $id = null, $tax_label = false, $echo = true);
       jws_car_price_msrp_html();
        
      }
    }
}
add_action('manage_cars_posts_custom_column', 'show_featured_image_column_inventory', 10, 2); 

// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'Year', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Year', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Year', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Year', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Year', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Year', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Year', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Year', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Year Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate year with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Year', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Year', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No year found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Year', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'year' ),
		);


        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_year', array( 'cars' ), $args  );
        }

		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'Make', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Make', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Make', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Make', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Make', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Make', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Make', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Make', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Make Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate make with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Make', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Make', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No make found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Make', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'make' ),
		);

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_make', array( 'cars' ), $args  );
        }

		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'Model', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Model', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Model', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Model', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Model', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Model', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Model', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Model', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Model Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate model with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Model', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Model', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No model found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Model', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'model' ),
		);

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_model', array( 'cars' ), $args  );
        }
        
		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'Body Style', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Body Style', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Body Style', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Body Style', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Body Style', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Body Style', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Body Style', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Body Style', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Body Style Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate body style with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove body style', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used body style', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No body style found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Body Style', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'body-style' ),
		);
	
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_body_style', array( 'cars' ), $args  );
        }

		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'Mileage', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Mileage', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Mileage', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Mileage', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Mileage', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Mileage', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Mileage', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Mileage', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Mileage Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate mileage with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Mileage', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Mileage', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No mileage found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Mileage', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'mileage' ),
		);

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_mileage', array( 'cars' ), $args  );
        }

		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'Transmission', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Transmission', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Transmission', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Transmission', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Transmission', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Transmission', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Transmission', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Transmission', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Transmission Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate transmission with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Transmission', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Transmission', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No transmission found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Transmission', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'transmission' ),
		);
	
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_transmission', array( 'cars' ), $args  );
        }

		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'Condition', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Condition', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Condition', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Condition', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Condition', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Condition', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Condition', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Condition', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Condition Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate condition with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Condition', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Condition', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No condition found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Condition', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'condition' ),
		);
	
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_condition', array( 'cars' ), $args  );
        }

		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'Drivetrain', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Drivetrain', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Drivetrain', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Drivetrain', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Drivetrain', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Drivetrain', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Drivetrain', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Drivetrain', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Drivetrain Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate drivetrain with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Drivetrain', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Drivetrain', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No drivetrain found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Drivetrain', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'drivetrain' ),
		);
	
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_drivetrain', array( 'cars' ), $args  );
        }

		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'Engine', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Engine', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Engine', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Engine', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Engine', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Engine', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Engine', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Engine', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Engine Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate engine with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Engine', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Engine', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No engine found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Engine', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'engine' ),
		);

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_engine', array( 'cars' ), $args  );
        }

		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'Fuel Economy', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Fuel Economy', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Fuel Economy', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Fuel Economy', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Fuel Economy', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Fuel Economy', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Fuel Economy', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Fuel Economy', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Fuel Economy Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate fuel-economy with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Fuel Economy', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Fuel Economy', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No fuel-economy found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Fuel Economy', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'fuel-economy' ),
		);
	
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_fuel_economy', array( 'cars' ), $args  );
        }

		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'Exterior Color', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Exterior Color', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Exterior Color', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Exterior Color', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Exterior Color', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Exterior Color', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Exterior Color', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Exterior Color', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Exterior Color Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate exterior-color with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Exterior Color', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Exterior Color', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No exterior-color found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Exterior Color', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'exterior-color' ),
		);
	
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_exterior_color', array( 'cars' ), $args  );
        }

		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'Interior Color', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Interior Color', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Interior Color', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Interior Color', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Interior Color', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Interior Color', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Interior Color', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Interior Color', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Interior Color Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate interior-color with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Interior Color', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Interior Color', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No interior-color found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Interior Color', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'interior-color' ),
		);
		
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_interior_color', array( 'cars' ), $args  );
        }
        
        
        $labels = array(
			'name'                       => esc_html__( 'Drive Train', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Drive Train', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Drive Train', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Drive Train', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Drive Train', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Drive Train', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Drive Train', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Drive Train', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Drive Train Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate drive-train with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Drive Train', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Drive Train', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No drive-train found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Drive Train', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'drive-train' ),
		);
		
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_drive_train', array( 'cars' ), $args  );
        }
        
        $labels = array(
			'name'                       => esc_html__( 'Registered', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Registered', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Registered', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Registered', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Registered', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Registered', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Registered', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Registered', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Registered Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate registered with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Registered', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Registered', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No registered found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Registered', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'registered' ),
		);
	
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_registered', array( 'cars' ), $args  );
        }
        
        $labels = array(
			'name'                       => esc_html__( 'Door Number', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Door Number', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Door Number', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Door Number', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Door Number', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Door Number', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Door Number', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Door Number', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Door Number Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate Door Number with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Door Number', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Door Number', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No Door Number found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Door Number', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'Door Number' ),
		);
	
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_door_number', array( 'cars' ), $args  );
        }
        
        $labels = array(
			'name'                       => esc_html__( 'Seat Number', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Seat Number', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Seat Number', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Seat Number', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Seat Number', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Seat Number', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Seat Number', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Seat Number', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Seat Number Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate Seat Number with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Seat Number', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Seat Number', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No Seat Number found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Seat Number', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'Seat Number' ),
		);
	
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_seat_number', array( 'cars' ), $args  );
        }
        
		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'Stock Number', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Stock Number', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Stock Number', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Stock Number', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Stock Number', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Stock Number', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Stock Number', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Stock Number', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Stock Number Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate stock-number with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Stock Number', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Stock Number', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No stock-number found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Stock Number', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'stock-number' ),
		);
	
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_stock_number', array( 'cars' ), $args  );
        }

		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'VIN Number', 'ochahouse' ),
			'singular_name'              => esc_html__( 'VIN Number', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search VIN Number', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular VIN Number', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All VIN Number', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit VIN Number', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update VIN Number', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New VIN Number', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New VIN Number Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate vin-number with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove VIN Number', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used VIN Number', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No vin-number found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'VIN Number', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'vin-number' ),
		);
	
        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_vin_number', array( 'cars' ), $args  );
        }

		$labels = array(
			'name'                       => esc_html__( 'Fuel Type', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Fuel Type', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Fuel Type', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Fuel Type', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Fuel Type', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Fuel Type', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Fuel Type', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Fuel Type', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Fuel Type Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate fuel-type with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Fuel Type', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Fuel Type', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No fuel-type found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Fuel Type', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'fuel-type' ),
		);
	
         if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_fuel_type', array( 'cars' ), $args  );
        }

		$labels = array(
			'name'                       => esc_html__( 'Trim', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Trim', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Trim', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Trim', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Trim', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Trim', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Trim', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Trim', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Trim Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate trim-type with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Trim', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Trim', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No trim found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Trim', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'trim' ),
		);

         if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_trim', array( 'cars' ), $args  );
        }

		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'Features & Options', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Features & Options', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Features & Options', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Features & Options', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Features & Options', 'ochahouse' ),
			'parent_item'                => esc_html__( 'Parent Feature', 'ochahouse' ),
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Features & Options', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Features & Options', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Features & Options', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Features & Options Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate features-options with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Features & Options', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Features & Options', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No features-options found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Features & Options', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'features-options' ),
		);
	
         if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_features_options', array( 'cars' ), $args  );
        }

		// Add new taxonomy, NOT hierarchical (like tags).
		$labels = array(
			'name'                       => esc_html__( 'Vehicle Review Stamps', 'ochahouse' ),
			'singular_name'              => esc_html__( 'Vehicle Review Stamps', 'ochahouse' ),
			'search_items'               => esc_html__( 'Search Vehicle Review Stamps', 'ochahouse' ),
			'popular_items'              => esc_html__( 'Popular Vehicle Review Stamps', 'ochahouse' ),
			'all_items'                  => esc_html__( 'All Vehicle Review Stamps', 'ochahouse' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => esc_html__( 'Edit Vehicle Review Stamps', 'ochahouse' ),
			'update_item'                => esc_html__( 'Update Vehicle Review Stamps', 'ochahouse' ),
			'add_new_item'               => esc_html__( 'Add New Vehicle Review Stamps', 'ochahouse' ),
			'new_item_name'              => esc_html__( 'New Vehicle Review Stamps Name', 'ochahouse' ),
			'separate_items_with_commas' => esc_html__( 'Separate Vehicle Review Stamps with commas', 'ochahouse' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove Vehicle Review Stamps', 'ochahouse' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used Vehicle Review Stamps', 'ochahouse' ),
			'not_found'                  => esc_html__( 'No Vehicle Review Stamps found.', 'ochahouse' ),
			'menu_name'                  => esc_html__( 'Vehicle Review Stamps', 'ochahouse' ),
		);

		$args = array(
			'hierarchical'          => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => true,
		);
	
         if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'car_vehicle_review_stamps', array( 'cars' ), $args  );
        }
        
        add_action( 'admin_init', 'jws_remove_metabox' );
if ( ! function_exists( 'jws_remove_metabox' ) ) {
	/**
	 * Remove metabox.
	 */
	function jws_remove_metabox() {
		remove_meta_box( 'tagsdiv-car_year', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_make', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_model', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_body_style', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_condition', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_mileage', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_transmission', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_drivetrain', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_engine', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_fuel_economy', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_exterior_color', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_interior_color', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_stock_number', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_vin_number', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_fuel_type', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_trim', 'cars', 'side' );
		remove_meta_box( 'tagsdiv-car_features_options', 'cars', 'side' );
		remove_meta_box( 'car_features_optionsdiv', 'cars', 'side' );
		remove_meta_box( 'car_vehicle_review_stampsdiv', 'cars', 'side' );
	}
}


