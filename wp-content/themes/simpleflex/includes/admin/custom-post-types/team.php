<?php 

/* ---------------------------------------------------------------------- */
/*	Team Members
/* ---------------------------------------------------------------------- */

// Add team post type
function luxe_register_post_type_team() {

	$labels = array(
		'name'               => __( 'Team', 'themeluxe' ),
		'singular_name'      => __( 'Member', 'themeluxe' ),
		'add_new'            => __( 'Add New', 'themeluxe' ),
		'add_new_item'       => __( 'Add New Member', 'themeluxe' ),
		'edit_item'          => __( 'Edit Member', 'themeluxe' ),
		'new_item'           => __( 'New Member', 'themeluxe' ),
		'view_item'          => __( 'View Member', 'themeluxe' ),
		'search_items'       => __( 'Search Members', 'themeluxe' ),
		'not_found'          => __( 'No members found', 'themeluxe' ),
		'not_found_in_trash' => __( 'No members found in Trash', 'themeluxe' ),
		'parent_item_colon'  => __( 'Parent Member:', 'themeluxe' ),
		'menu_name'          => __( 'Team', 'themeluxe' ),
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
		'rewrite'             => array( 'slug' => 'team' ),
		'capability_type'     => 'post',
		'menu_position'       => null
	);

	register_post_type( 'team', apply_filters( 'luxe_register_post_type_team', $args ) );

} 


// Custom colums for 'Team'
function luxe_edit_team_columns() {

	$columns = array(
		'cb'          => '<input type="checkbox" />',
		'title'       => __( 'Name', 'themeluxe' ),
		'thumbnail'   => __( 'Photo', 'themeluxe' ),
		'job_title'   => __( 'Job Title', 'themeluxe' ),
                'shortcode'   => __( 'Shortcode', 'themeluxe' ),
		'menu_order'  => __( 'Order', 'themeluxe')
	);

	return $columns;

}


// Custom colums content for 'Team'
function luxe_manage_team_columns( $column, $post_id ) {

	global $post;

	switch ( $column ) {

		case 'thumbnail':

			echo '<a href="' . get_edit_post_link( $post_id ) . '">' . get_the_post_thumbnail( $post_id, array(50, 50), array( 'title' => get_the_title( $post_id ) ) ) . '</a>';

			break;

		case 'job_title':
			
			echo luxe_get_meta( 'luxe_job_title', $post_id );

			break;
		
		case 'menu_order':
		
                        $order = $post->menu_order;
                        echo $order;
			
			break;
                    
		case 'shortcode':
			
			echo '<span class="shortcode-field">[team_member id="'. $post->post_name . '"]</span>';

			break;	
                    
		default:
			break;
	}

}


// Sortable custom columns for 'Team'
function luxe_sortable_team_columns( $columns ) {

	$columns['job_title'] = 'job_title';
	$columns['menu_order'] = 'menu_order';

	return $columns;

}

add_action('init', 'luxe_register_post_type_team');
add_action('manage_edit-team_columns', 'luxe_edit_team_columns');
add_action('manage_team_posts_custom_column', 'luxe_manage_team_columns', 10, 2);
add_action('manage_edit-team_sortable_columns', 'luxe_sortable_team_columns');

?>