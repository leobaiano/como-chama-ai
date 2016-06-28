<?php 

/* ---------------------------------------------------------------------- */
/*	Testimonials 
/* ---------------------------------------------------------------------- */

// Add testimonials post type
function luxe_register_post_type_testimonials() {

	$labels = array(
		'name'               => __( 'Testimonials', 'themeluxe' ),
		'singular_name'      => __( 'Testimonial', 'themeluxe' ),
		'add_new'            => __( 'Add New', 'themeluxe' ),
		'add_new_item'       => __( 'Add New Testimonial', 'themeluxe' ),
		'edit_item'          => __( 'Edit Testimonial', 'themeluxe' ),
		'new_item'           => __( 'New Testimonial', 'themeluxe' ),
		'view_item'          => __( 'View Testimonial', 'themeluxe' ),
		'search_items'       => __( 'Search Testimonials', 'themeluxe' ),
		'not_found'          => __( 'No testimonials found', 'themeluxe' ),
		'not_found_in_trash' => __( 'No testimonials found in Trash', 'themeluxe' ),
		'parent_item_colon'  => __( 'Parent Testimonial:', 'themeluxe' ),
		'menu_name'          => __( 'Testimonials', 'themeluxe' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'taxonomies'          => array(''),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => array( 'slug' => 'testimonial' ),
		'capability_type'     => 'post',
		'menu_position'       => null,
		//'menu_icon'           => LUXE_BASE_URL . 'library/admin/images/testimonials.png'
	);

	register_post_type( 'testimonials', apply_filters( 'luxe_register_post_type_testimonials', $args ) );

} 


// Custom colums for 'Team'
function luxe_edit_testimonials_columns() {

	$columns = array(
		'cb'          => '<input type="checkbox" />',
		'title'       => __( 'Name', 'themeluxe' ),
		'thumbnail'   => __( 'Photo', 'themeluxe' ),
		'menu_order'  => __( 'Order', 'themeluxe')
	);

	return $columns;

}


// Custom colums content for 'Team'
function luxe_manage_testimonials_columns( $column, $post_id ) {

	global $post;

	switch ( $column ) {

		case 'thumbnail':

			echo '<a href="' . get_edit_post_link( $post_id ) . '">' . get_the_post_thumbnail( $post_id, array(50, 50), array( 'title' => get_the_title( $post_id ) ) ) . '</a>';

			break;
		
		case 'menu_order':
		
		    $order = $post->menu_order;
      		echo $order;
			
			break;
			
		default:
			break;
	}

}


// Sortable custom columns for 'Team'
function luxe_sortable_testimonials_columns( $columns ) {

	$columns['menu_order'] = 'menu_order';

	return $columns;

}

add_action('init', 'luxe_register_post_type_testimonials');
add_action('manage_edit-testimonials_columns', 'luxe_edit_testimonials_columns');
add_action('manage_testimonials_posts_custom_column', 'luxe_manage_testimonials_columns', 10, 2);
add_action('manage_edit-testimonials_sortable_columns', 'luxe_sortable_testimonials_columns');



?>