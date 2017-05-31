<?php 

/*-------- Slider Post Type --------*/
add_action( 'init', 'create_post_type' );
function create_post_type(){
	 register_post_type('Slider',
	  array(
	   'labels'       => array(
		'name'               => __('Slider'),
		'singular_name'      => __('Slider'),
		'add_new'            => __('Add Slider'),
		'all_items'          => __('All Slider'),
		'add_new_item'       => __('Add New Slider'),
		'edit_item'          => __('Edit Slider'),
		'new_item'           => __('New Slider'),
		'view_item'          => __('View Slider'),
		'search_items'       => __('Search Slider'),
		'not_found'          => __('No Slider found'),
		'not_found_in_trash' => __('No Slider found in Trash')
	   ),
	   'public'       => true,
	   'menu_icon'    => 'dashicons-format-image',
	   'has_archive'  => true,
	   'menu_position'=> 5,
	   'rewrite'      => array('slug'=>'slider'),
	   'supports'     => array( 'title','thumbnail','editor')
	  )
	 );
	 
	  /*-------- Class Post Type --------*/
	  register_post_type('My Class',
	  array(
	   'labels'       => array(
		'name'               => __('Registered Class'),
		'singular_name'      => __('Sudents'),
		'add_new'            => __('Add Student'),
		'all_items'          => __('All Students'),
		'add_new_item'       => __('Add New Student'),
		'edit_item'          => __('Edit Student'),
		'new_item'           => __('New Student'),
		'view_item'          => __('View Students'),
		'search_items'       => __('Search Students'),
		'not_found'          => __('No Student found'),
		'not_found_in_trash' => __('No Student found in Trash')
	   ),
	   'public'       => true,
	   'menu_icon'    => 'dashicons-welcome-learn-more',
	   'has_archive'  => true,
	   'menu_position'=> 5,
	   'rewrite'      => array('slug'=>'myclass'),
	   'supports'     => array( 'title','thumbnail','author')
	  )
	 );
	 
	  /*-------- Testomonial Post Type --------*/
	  register_post_type('Testimonial',
	  array(
	   'labels'       => array(
		'name'               => __('Testimonial'),
		'singular_name'      => __('Testimonial'),
		'add_new'            => __('Add Testimonial'),
		'all_items'          => __('All Testimonials'),
		'add_new_item'       => __('Add New Testimonial'),
		'edit_item'          => __('Edit Testimonial'),
		'new_item'           => __('New Testimonial'),
		'view_item'          => __('View Testimonial'),
		'search_items'       => __('Search Testimonial'),
		'not_found'          => __('No Testimonial found'),
		'not_found_in_trash' => __('No Testimonial found in Trash')
	   ),
	   'public'       => true,
	   'menu_icon'    => 'dashicons-editor-paste-text',
	   'has_archive'  => true,
	   'menu_position'=> 5,
	   'rewrite'      => array('slug'=>'Testimonial'),
	   'supports'     => array( 'title','thumbnail','author','editor')
	  )
	 );
	 
	  /*-------- Hotels Post Type --------*/
	  register_post_type('Hotels',
	  array(
	   'labels'       => array(
		'name'               => __('Hotels'),
		'singular_name'      => __('Hotel'),
		'add_new'            => __('Add Hotel'),
		'all_items'          => __('All Hotels'),
		'add_new_item'       => __('Add New Hotel'),
		'edit_item'          => __('Edit Hotel'),
		'new_item'           => __('New Hotel'),
		'view_item'          => __('View Hotel'),
		'search_items'       => __('Search Hotels'),
		'not_found'          => __('No Hotel found'),
		'not_found_in_trash' => __('No Hotel found in Trash')
	   ),
	   'public'       => true,
	   'menu_icon'    => 'dashicons-location-alt',
	   'has_archive'  => true,
	   'menu_position'=> 5,
	   'rewrite'      => array('slug'=>'hotel'),
	   'supports'     => array( 'title','thumbnail','author','editor')
	  )
	 );
}	

add_action( 'restrict_manage_posts', 'my_restrict_manage_posts' );

function my_restrict_manage_posts() {
    global $typenow, $post, $post_id;

    if( $typenow == "myclass" ){
        //get post type
        $post_type=get_query_var('post_type'); 

        //get taxonomy associated with current post type
        $taxonomies = get_object_taxonomies($post_type);

        //in next loop add filter for tax
        if ($taxonomies) {
            foreach ($taxonomies as $tax_slug) {
                $tax_obj = get_taxonomy($tax_slug);
                $tax_name = $tax_obj->labels->name;
                $terms = get_terms($tax_slug);
                echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
                echo "<option value=''>Show All $tax_name</option>";
					foreach ($terms as $term) { 
						$label = (isset($_GET[$tax_slug])) ? $_GET[$tax_slug] : ''; // Fix
						echo '<option value='. $term->slug, $label == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
					}
                echo "</select>";
            }
        }
    }
}

/*=============================
	Register Texonomies
===============================*/
function myclass_texanomies() {
    $labels = array(
        'name'              => _x( 'Class Category', 'Class Name' ),
        'singular_name'     => _x( 'Class Category', 'Class Name' ),
        'search_items'      => __( 'Search Class' ),
        'all_items'         => __( 'All Class' ),
        'parent_item'       => __( 'Parent Class' ),
        'parent_item_colon' => __( 'Parent Class:' ),
        'edit_item'         => __( 'Edit Class' ),
        'update_item'       => __( 'Update Class' ),
        'add_new_item'      => __( 'Add Class' ),
        'new_item_name'     => __( 'New Class Name' ),
        'menu_name'         => __( 'Class Category' ),
    );

    $args = array(
        'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => true,
    );

    register_taxonomy( 'myclass_categories', array( 'myclass' ), $args );
}
add_action( 'init', 'myclass_texanomies', 0 );




/*==============================
	Add Columns To MyClass
===============================*/

function add_myclass_columns($columns) {
  
	return array_merge($columns, 
	array('payment_status' => __('Payment Status')));
	
}
add_filter('manage_myclass_posts_columns' , 'add_myclass_columns');

add_action('manage_posts_custom_column', 'show_column_for_listing_list',10,2);

function show_column_for_listing_list( $columns,$post_id ) {
    global $typenow;
    if ($typenow=='myclass') {
        $taxonomy = 'myclass_categories';
	  
        switch ($columns) 
	  {
        	case 'payment_status':
            	
			$payment_status = get_post_meta($post_id, 'payment_status', true);
			echo $payment_status;
            break;
        }
    }
}
function my_manage_columns( $columns ) {
  unset($columns['author']);
  return $columns;
}

function my_column_init() {
  add_filter( 'manage_posts_columns' , 'my_manage_columns' );
}
add_action( 'admin_init' , 'my_column_init' );




?>