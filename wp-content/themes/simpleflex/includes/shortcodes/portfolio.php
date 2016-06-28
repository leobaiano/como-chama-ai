<?php

/* ---------------------------------------------------------------------- */
/*  PORTFOLIO SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'portfolio', 'luxe_portfolio' );

function luxe_portfolio( $atts, $content = null ) {

    extract( shortcode_atts( array(
                'columns' => '3',
                'filter' => '',
                'style' => '',
                'limit' => '-1',
                'title_color' => '',
                'images' => ''
            ), $atts ) );

    global $post;

    $output = '<div class="portfolio-loader"></div>';
    $output .= '<ul id="portfolio-filter" class="portfolio-filter clearfix '.$filter.'" data-option-key="filter">
                    <li class="active"><a href="#" class="all h6" data-filter="*" >'.( $filter == "icons" ? '<icon class="icon-cancel"></i>' : 'All' ).'</a></li>';

    // Get the taxonomy
    $terms = get_terms( 'filter' );
    $count = count( $terms );
    $i = 0;

    // test if the count has any categories
    if ( $count > 0 ) {
        // break each of the categories into individual elements
        $term_list = '';
        foreach ( $terms as $term ) {
            $i++;
            $term_name = ( $filter == 'icons' ? $term->description : $term->name );
            $term_list .= '<li><a href="javascript:void(0)" class="h6" data-filter=".' . $term->slug . '">' . $term_name . '</a></li>';
        }
        $output .= $term_list;
    }

    $output .= '</ul>';

    // Set the page to be pagination
    //$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

    $args = array(
        'post_type' => 'portfolio',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'posts_per_page' => $limit,
    );


    $portfolio = get_posts( $args );

    $output .= '<div id="portfolio-container" class="portfolio'.$columns.'c portfolio-container '.$style.'">';

    foreach ( $portfolio as $project ) : setup_postdata( $project );

    // Get The Taxonomy 'Filter' Categories
    $terms = get_the_terms( $project->ID, 'filter' );
    $term_list = '';
    if ( $terms ) foreach ( $terms as $term ) {
            $term_list .= $term->slug . ' ';
    }   

    $output .= '<div data-id="id- '.$count.'" class="isotope '.$term_list.'">';

    // Get the portfolio and lightbox image
    $lightbox_image = wp_get_attachment_image_src( get_post_thumbnail_id( $project->ID ), 'full' );
    $lightbox_image = $lightbox_image[0];

    $portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id( $project->ID ), 'portfolio'.$columns.'c' );
    $portfolio_image = $portfolio_image[0];



    // Output the overlay of each portfolio item
    $output.= '<div class="portfolio-overlay-container">';
    $output.= '<img src="'.$portfolio_image.'" class="portfolio-image '.$images.'" alt="'.$project->post_title.'" />';
    $output.= '<div class="portfolio-overlay">';
    $output.= '<div class="portfolio-links">';
    $output.= '<a class="prettyphoto portfolio-zoom" rel="prettyPhoto[active]" href="'.$lightbox_image.'"></a>';
    $output.= '<a class="portfolio-like luxe-post-like" data-post_id="'.$project->ID.'" >'.getPostLikes($project->ID).'</a>';
    $output.= '<a class="portfolio-link" href="'.get_permalink( $project->ID ).'"></a>';
    $output.= '</div>';
    $output.= '</div>';
    $output.= '</div>';

    $output.= '<h5 class="portfolio-title"><a class="portfolio-link" href="'.get_permalink( $project->ID ).'" style="color:'.$title_color.'">'.$project->post_title.'</a></h5>';

    $output .= '</div>'; //end isotope item and overlay container

    $count++; 
    endforeach;
    wp_reset_postdata();

    $output .= '</div>'; // end portfolio container

    return do_shortcode( $output );

}

/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$content['Elements']['elements']['portfolio'] = array(
        'title'   => 'Portfolio',
        'code'    => '[portfolio]',
        'attributes' => array(
          array(
            'name'  => 'style',
            'type'  => 'select',
            'label' => __('Style', 'luxe_framework'),
            'items' => array(
              array(
                'value' => 'no-margin',
                'label' => 'No Margin'
              ),
              array(
                'value' => 'margin',
                'label' => 'Margin'
              ),
            ),
            'default' => 'no-margin'
          ),
          array(
            'name'  => 'columns',
            'type'  => 'select',
            'label' => __('Columns', 'luxe_framework'),
            'items' => array(
              array(
                'value' => '2',
                'label' => '2 Columns'
              ),
              array(
                'value' => '3',
                'label' => '3 Columns'
              ),
              array(
                'value' => '4',
                'label' => '4 Columns'
              ),
              array(
                'value' => '5',
                'label' => '5 Columns'
              ),
            ),
            'default' => '3'
          ),
          array(
            'name'  => 'limit',
            'type'  => 'textbox',
            'label' => __('Maximum Items', 'luxe_framework'),
          ),
        )
      );

?>
