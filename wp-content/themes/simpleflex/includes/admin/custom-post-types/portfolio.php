<?php

/* ---------------------------------------------------------------------- */
/*	Portfolio
/* ---------------------------------------------------------------------- */

// Add portfolio post type
function post_type_portfolio()
{
	$labels = 
	array(
		'name' 			=> __( 'Portfolio', 'themeluxe'), 
		'singular_name' 	=> __('Portfolio', 'themeluxe'),
		'rewrite' 		=> array('slug' => __( 'portfolio', 'themeluxe' )),
		'add_new' 		=> __('Add Item', 'themeluxe'), 
		'edit_item' 		=> __('Edit Portfolio Item', 'themeluxe'),
		'new_item' 		=> __('New Portfolio Item', 'themeluxe'), 
		'view_item' 		=> __('View Portfolio', 'themeluxe'),
		'search_items'	 	=> __('Search Portfolio', 'themeluxe'), 
		'not_found'		=>  __('No Portfolio Items Found', 'themeluxe'),
		'not_found_in_trash'    => __('No Portfolio Items Found In Trash', 'themeluxe'),
		'parent_item_colon'     => '' 
	);
	
	$args = 
	array(
		'labels' 			=> $labels, 
		'public' 			=> true, 
		'publicly_queryable'=> true, 
		'show_ui' 			=> true, 
		'query_var' 		=> true, 
		'rewrite' 			=> true, 
		'capability_type' 	=> 'post', 
		'hierarchical'		=> false, 
		'menu_position' 	=> null, 
		'supports' 			=> array( 'title', 'editor', 'thumbnail', 'page-attributes') 
	);
	
	register_post_type(__( 'portfolio', 'themeluxe' ),$args);
	
}


// Add category filter for portfolio
function portfolio_filter()
{
	register_taxonomy(__( "filter", 'themeluxe' ), 

	array(__( "portfolio", 'themeluxe' )), 
	
	array(
		"hierarchical" => true, 
		"label" => __( "Filter", 'themeluxe' ), 
		"singular_label" => __( "Filter", 'themeluxe' ), 
		"rewrite" => array(
				'slug' => 'filter', 
				'hierarchical' => true
				)
		)
	); 
} 

// Custom colums for 'Team'
function luxe_edit_portfolio_columns() {

	$columns = array(
		'cb'          => '<input type="checkbox" />',
		'title'       => __( 'Name', 'themeluxe' ),
		'thumbnail'   => __( 'Photo', 'themeluxe' ),
		'menu_order'   => __( 'Order', 'themeluxe' ),
	);

	return $columns;

}


// Custom colums content for 'Team'
function luxe_manage_portfolio_columns( $column, $post_id ) {

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
function luxe_sortable_portfolio_columns( $columns ) {

	$columns['menu_order'] = 'menu_order';

	return $columns;

}



add_action('init', 'post_type_portfolio');
add_action('init', 'portfolio_filter', 0 );
add_action('manage_edit-portfolio_columns', 'luxe_edit_portfolio_columns');
add_action('manage_portfolio_posts_custom_column', 'luxe_manage_portfolio_columns', 10, 2);
add_action('manage_edit-portfolio_sortable_columns', 'luxe_sortable_portfolio_columns');

?>