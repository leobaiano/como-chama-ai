<?php
/*

Base functions for all themes

Author: ThemeLuxe
Author URI: http://themeluxe.com

*/

/* ---------------------------------------------------------------------- */
/*	CLEANUP
/* ---------------------------------------------------------------------- */

if ( ! isset( $content_width ) ) $content_width = 960;

add_action( 'after_setup_theme', 'luxe_setup', 15 );
function luxe_setup() {

	// clean up gallery output in wp
	add_filter( 'gallery_style', 'luxe_gallery_style' );
	// enqueue base scripts and styles
	add_action( 'wp_enqueue_scripts', 'luxe_scripts_and_styles', 999 );
	// ie conditional wrapper
	add_filter( 'style_loader_tag', 'luxe_ie_conditional', 10, 2 );
	// enqueue demo styles
	add_action( 'wp_head', 'luxe_demo_css' );
	// adding sidebars to Wordpress (these are created in functions.php)
	add_action( 'widgets_init', 'luxe_register_sidebars' );
	// adding the search form (created in functions.php)
	add_filter( 'get_search_form', 'luxe_wpsearch' );
	// cleaning up excerpt
	add_filter( 'excerpt_more', 'luxe_excerpt_more' );

} /* end setup */



// remove injected CSS from gallery
function luxe_gallery_style( $css ) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}

// This removes the annoying [â€¦] to a Read More link
function luxe_excerpt_more( $more ) {
	global $post;
	// edit here if you like
	return '...  <a href="'. get_permalink( $post->ID ) . '" title="Read '.get_the_title( $post->ID ).'">Read more &raquo;</a>';
}



/* ---------------------------------------------------------------------- */
/*	Theme Support
/* ---------------------------------------------------------------------- */

// Adding WP 3+ Functions & Theme Support


// wp thumbnails (sizes handled in functions.php)
add_theme_support( 'post-thumbnails' );

// default thumb size
set_post_thumbnail_size( 125, 125, true );

// wp custom background (thx to @bransonwerner for update)
add_theme_support( 'custom-background',
	array(
		'default-image' => '',  // background image default
		'default-color' => '', // background color default (dont add the #)
		'wp-head-callback' => '_custom_background_cb',
		'admin-head-callback' => '',
		'admin-preview-callback' => ''
	)
);

// rss thingy
add_theme_support( 'automatic-feed-links' );

// wp menus
add_theme_support( 'menus' );

// registering wp3+ menus
register_nav_menus(
	array(
		'main-nav' => __( 'The Main Menu', 'luxe_framework' )   // main nav in header
	)
);
/* end theme support */


/* ---------------------------------------------------------------------- */
/*	MENUS / NAVIGATION
/* ---------------------------------------------------------------------- */

// the main menu
function luxe_main_nav() {
	// display the wp3 menu if available
	wp_nav_menu( array(
			'container' => false,                           // remove nav container
			'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
			'menu' => 'The Main Menu',                      // nav name
			'menu_class' => 'nav main-nav clearfix',         // adding custom nav class
			'theme_location' => 'main-nav',                 // where it's located in the theme
			'before' => '',                                 // before the menu
			'after' => '',                                  // after the menu
			'link_before' => '',                            // before each link
			'link_after' => '',                             // after each link
			'depth' => 0,                                   // limit the depth of the nav
			'fallback_cb' => 'luxe_main_nav_fallback',      // fallback function
			'walker' => new luxe_walker,
			'menu_id' => 'main-nav'
		) );
} /* end main nav */

// the footer menu (should you choose to use one)
function luxe_footer_links() {
	// display the wp3 menu if available
	wp_nav_menu( array(
			'container' => '',                              // remove nav container
			'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
			'menu' => 'Footer Links',                       // nav name
			'menu_class' => 'nav footer-nav clearfix',      // adding custom nav class
			'theme_location' => 'footer-links',             // where it's located in the theme
			'before' => '',                                 // before the menu
			'after' => '',                                  // after the menu
			'link_before' => '',                            // before each link
			'link_after' => '',                             // after each link
			'depth' => 0,                                   // limit the depth of the nav
			'fallback_cb' => 'luxe_footer_links_fallback'  // fallback function
		) );
} /* end footer link */

// this is the fallback for header menu
function luxe_main_nav_fallback() {
	wp_page_menu( array(
			'show_home' => true
		) );
}

// Add classes to fallback menu
function luxe_add_menuclass( $ulclass ) {
	return preg_replace( '/<ul>/', '<ul id="main-nav" class="nav top-nav clearfix">', $ulclass, 1 );

}
add_filter( 'wp_page_menu', 'luxe_add_menuclass' );

// this is the fallback for footer menu
function luxe_footer_links_fallback() {
	/* you can put a default here if you like */
}


/* ---------------------------------------------------------------------- */
/*	MENU / NAVIGATION WALKER
/* ---------------------------------------------------------------------- */

function luxe_get_top_parent_page_id( $child_ID ) {


	$ancestors = get_post_ancestors( $child_ID );
	if ( $ancestors ) {
		$root = count( $ancestors )-1;
		$parent = $ancestors[$root];

		//  Grab the ID of top-level page from the tree
		return $parent;

	} else {

		// Page is the top level, so use  it's own id
		return $child_ID;

	}

}

// Add data-slide for Scrollto and support for sub-menus
class luxe_walker extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "", $depth );
		$output .= "<ul class=\"children\">";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$pageid = get_post_meta( $item->ID, '_menu_item_object_id', true );
		$page = get_post( $pageid );
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$scroll = ( get_post_meta( luxe_get_top_parent_page_id( $item->ID ), '_wp_page_template', true ) == 'page-onepage.php' ) ? ' scroll-link ' : ' ';
		$class_names = join( $scroll , apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		if ( $page ) {
			$attributes .= ' data-slide="'.$page->post_name.'"';
			$attributes .= ' data-parent="'.get_permalink( $page->post_parent ).'"';
		}
		$attributes .= $class_names;
		$attributes .= ! empty( $item->target )        ? ' target="'   . esc_attr( $item->target        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
		if ( $depth != 0 ) {
			$description = $append = $prepend = "";
		}
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= ( in_array( 'hide-text', $classes ) ? '' : $args->link_before .apply_filters( 'the_title', $item->title, $item->ID ) );
		$item_output .= $description.$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	// Add parent to menu with sub-menu
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if ( !$element )
			return;

		$id_field = $this->db_fields['id'];

		//display this element
		if ( is_array( $args[0] ) )
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );

		//Adds the 'parent' class to the current item if it has children
		if ( ! empty( $children_elements[$element->$id_field] ) )
			array_push( $element->classes, 'parent' );

		$cb_args = array_merge( array( &$output, $element, $depth ), $args );

		call_user_func_array( array( &$this, 'start_el' ), $cb_args );

		$id = $element->$id_field;

		// descend only when the depth is right and there are childrens for this element
		if ( ( $max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id] ) ) {

			foreach ( $children_elements[ $id ] as $child ) {

				if ( !isset( $newlevel ) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array( &$output, $depth ), $args );
					call_user_func_array( array( &$this, 'start_lvl' ), $cb_args );
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}

		if ( isset( $newlevel ) && $newlevel ) {
			//end the child delimiter
			$cb_args = array_merge( array( &$output, $depth ), $args );
			call_user_func_array( array( &$this, 'end_lvl' ), $cb_args );
		}

		//end this element
		$cb_args = array_merge( array( &$output, $element, $depth ), $args );
		call_user_func_array( array( &$this, 'end_el' ), $cb_args );
	}
}


/* ---------------------------------------------------------------------- */
/*	PAGE NAVIGATION
/* ---------------------------------------------------------------------- */

// Numeric Page Navi (built into the theme by default)
function luxe_page_navi( $before = '', $after = '' ) {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval( get_query_var( 'posts_per_page' ) );
	$paged = intval( get_query_var( 'paged' ) );
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if ( empty( $paged ) || $paged == 0 ) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor( $pages_to_show_minus_1/2 );
	$half_page_end = ceil( $pages_to_show_minus_1/2 );
	$start_page = $paged - $half_page_start;
	if ( $start_page <= 0 ) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if ( ( $end_page - $start_page ) != $pages_to_show_minus_1 ) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if ( $end_page > $max_page ) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if ( $start_page <= 0 ) {
		$start_page = 1;
	}
	echo $before.'<nav class="page-navigation"><ol class="luxe-page-navigation clearfix">'."";
	if ( $start_page >= 2 && $pages_to_show < $max_page ) {
		$first_page_text = "First";
		echo '<li class="luxe-first-page-link"><a href="'.get_pagenum_link().'" title="'.$first_page_text.'">'.$first_page_text.'</a></li>';
	}
	echo '<li class="luxe-prev-link">';
	previous_posts_link( '' );
	echo '</li>';
	for ( $i = $start_page; $i  <= $end_page; $i++ ) {
		if ( $i == $paged ) {
			echo '<li class="luxe-current"><span>'.$i.'</span></li>';
		} else {
			echo '<li><a href="'.get_pagenum_link( $i ).'">'.$i.'</a></li>';
		}
	}
	echo '<li class="luxe-next-link">';
	next_posts_link( '' );
	echo '</li>';
	if ( $end_page < $max_page ) {
		$last_page_text = "Last";
		echo '<li class="luxe-last-page-link"><a href="'.get_pagenum_link( $max_page ).'" title="'.$last_page_text.'">'.$last_page_text.'</a></li>';
	}
	echo '</ol></nav>'.$after."";
} /* end page navi */


/* ---------------------------------------------------------------------- */
/*	DYNAMIC FOOTER WIDGETS
/* ---------------------------------------------------------------------- */

// get total footer widgets from theme options
global $luxe_options;
$footer_columns = (isset($luxe_options['footer-widgets']) ? $luxe_options['footer-widgets'] : 4);

for ($i = 1; $i <= $footer_columns; $i++)
{
    register_sidebar(array(
    	'id' => 'footer'.$i,
    	'name' => 'Footer - '.$i,
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
}

/* ---------------------------------------------------------------------- */
/*	GET META BOX
/* ---------------------------------------------------------------------- */

if ( !function_exists( 'luxe_get_meta' ) ) {

	function luxe_get_meta( $key, $default = null, $post_id = null ) {

		return vp_metabox($key, $default, $post_id);

	}

}

/* ---------------------------------------------------------------------- */
/*  GET AUTHOR POSTS LINK
/* ---------------------------------------------------------------------- */

function luxe_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s', 'luxe_framework' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}

/* ---------------------------------------------------------------------- */
/*  LIMIT WORDS
/* ---------------------------------------------------------------------- */

function luxe_limit_words($string, $word_limit) {
	// creates an array of words from $string (excerpt)
	$words = explode(' ', $string);
	// this next bit chops the $words array and sticks it back together
	return implode(' ', array_slice($words, 0, $word_limit));
}

/* ---------------------------------------------------------------------- */
/*  CUSTOM LOGIN PAGE
/* ---------------------------------------------------------------------- */

function luxe_login_css() {
	wp_enqueue_style( 'luxe_login_css', get_template_directory_uri() . '/library/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function luxe_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function luxe_login_title() { return get_option( 'blogname' ); }

// calling it only on the login page
//add_action( 'login_enqueue_scripts', 'luxe_login_css', 10 );
add_filter( 'login_headerurl', 'luxe_login_url' );
add_filter( 'login_headertitle', 'luxe_login_title' );

/* ---------------------------------------------------------------------- */
/*	SEARCH FORM TEMPLATE
/* ---------------------------------------------------------------------- */

function luxe_search_form() {
  // look for local searchform template
  $search_form_template = locate_template( 'searchform.php' );
  if ( '' !== $search_form_template ) {
    // searchform.php exists, remove all filters
    remove_all_filters('get_search_form');
  }
}
add_action('pre_get_search_form', 'luxe_search_form');