<?php

/* ---------------------------------------------------------------------- */
/*  BLOG POSTS SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'blog', 'luxe_blog' );

function luxe_blog( $atts, $content = null ) {
    extract( shortcode_atts( array(
                "offset" => '',
                "limit" => '',
                "thumbnail" => 'true',
                "excerpt" => 'true',
                "length" => 8,
                "morelink" => '',
                "type" => 'post',
                "parent" => '',
                "category" => '',
                "orderby" => 'date',
                "order" => 'DESC',
                "paged" => '1',
                "size" => '',
                "date" => 'true',
                "columns" => '2',
                "style" => 'style1',
                "pagination" => 'true',
                "image_size" => '',
                'special' => ''
            ), $atts ) );
    global $post;

    // set max posts
    $posts_per_page = $limit ? $limit : get_option( 'posts_per_page' );
    // get page number if paginated
    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
    // prevent duplication
    $do_not_duplicate[] = $post->ID;

    if($special == 'related') {
        $tags = wp_get_post_tags($post->ID);
        if($tags) {
            $first_tag = $tags[0]->term_id;

            $args=array(
                'tag__in' => array($first_tag),
                'post__not_in' => array($post->ID),
                'posts_per_page'=>3,
                'ignore_sticky_posts'=>1,
                'posts_per_page' => $posts_per_page,
                'orderby' => $orderby,
                'offset' => $offset,
                'order' => $order,
                'paged' => $paged,
            );      
        } 
        else {
            return;
        }
    }
    else {
        $args = array(
            'post__not_in' => $do_not_duplicate,
            'cat' => $category,
            'post_type' => $type,
            'post_parent' => $parent,
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'offset' => $offset,
            'order' => $order,
            'paged' => $paged,
        );
    }


    // query
    $luxe_posts = new WP_Query( $args );
    $numposts = $luxe_posts->found_posts;
    $max_num_pages = $luxe_posts->max_num_pages;

    $item_class = 'luxe-post '.$type.'-post '.$style. ' ';

    switch ( $columns ) {
    case '1':
        $item_class .= 'twelvecol';
        break;
    case '2':
        $item_class .= 'sixcol';
        break;
    case '3':
        $item_class .= 'fourcol';
        break;
    case '4':
        $item_class .= 'threecol';
        break;
    }

    $output = '';


    $output .= '<div class="luxe-posts">';

    $count = 1;

    while ( $luxe_posts->have_posts() ) : $luxe_posts->the_post();
    // add post class
    $post_class = get_post_class();
    if($post_class) {
        foreach ($post_class as $class) {
            $item_class .= ' '.$class;
        }
    }
    // add first class if first column
    $first = ( $count % $columns  == 1 ) ? ' first' : '';
    // start item
    $output.='<div class="'.$item_class.' '.$first.'" style="border-color:'.luxe_get_meta( 'post.border-color', '', get_the_ID() ).';">';

    // featured content
    $output .= '<div class="luxe-post-featured">';

    // image size
    global $luxe_image_size;
    $luxe_image_size = $image_size;

    // thumbnail
    ob_start();
    get_template_part( 'includes/content', get_post_format() );
    $output .= ob_get_contents();
    ob_end_clean();
    
    $output .= '</div>';

    $output.='<div class="luxe-post-details">';
    // title
    $output.='<h5 class="luxe-post-title"><a href="'.get_permalink().'">'.the_title( "", "", false ).'</a></h5>';
    // date
    $output.='<h6 class="luxe-post-date">'.get_the_date( 'M j, Y' ).'</h6>';
    // excerpt
    if ( $excerpt == 'true' ) {
        // allowed tags in excerpts
        $allowed_tags = '<a>,<i>,<em>,<b>,<strong>,<ul>,<ol>,<li>,<blockquote>,<img>,<span>,<p>';
        // filter the content
        $text = preg_replace( '/\[.*\]/', '', strip_tags( get_the_excerpt(), $allowed_tags ) );
        // remove the more-link
        $pattern = '/(<a.*?class="more-link"[^>]*>)(.*?)(<\/a>)/';
        // display the new excerpt
        $content = preg_replace( $pattern, "", $text );
        $output.= '<div class="luxe-post-excerpt">'.luxe_limit_words( $content, $length ).'</div>';
    }
    $output.= luxe_post_share(get_the_ID());
    $output.='</div>';

    // item close
    $output.='</div>';

    if ( ( $count % $columns ) == 0 ) {
        $output .= '<div class="clearfix"></div>';
    }

    $count++;
    endwhile;
    wp_reset_postdata();

    if ( $pagination == 'true' ):
        ob_start();
            luxe_page_navi( '<div class="pagination">', '</div>', $numposts, $posts_per_page, $max_num_pages );
        $output .= ob_get_clean();
    endif;

    // end luxe posts container
    $output .= '</div>';

    return do_shortcode( $output );

}


/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

/*// Get post types list
$luxe_post_types = get_post_types( array(
    '_builtin' => false
), 'objects');
$luxe_post_types_names = array();
foreach ($luxe_post_types as $luxe_post_type)
{
    $luxe_post_types_names[] = array('value' => $luxe_post_type->name, 'label' => $luxe_post_type->name);
}*/

// Get categories
$categories = vp_get_categories();

$content['Elements']['elements']['blog'] =     array(
    'title'   => 'Blog',
    'code'    => '[blog]',
    'attributes' => array(
          array(
            'name'  => 'style',
            'type'  => 'select',
            'label' => __('Post Style', 'luxe_framework'),
            'items' => array(
              array(
                'value' => 'style1',
                'label' => 'Style 1 (Feature Image Top)'
              ),
              array(
                'value' => 'style2',
                'label' => 'Style 2 (Feature Image Left)'
              ),
            ),
            'default' => array('{{first}}')
          ),
          array(
            'name'  => 'image_size',
            'type'  => 'select',
            'label' => __('Image Size', 'luxe_framework'),
            'items' => array(
              array(
                'value' => 'blog',  
                'label' => '1170 x 580'
              ),
              array(
                'value' => 'portfolio2c',
                'label' => '950 x 500'
              ),
              array(
                'value' => 'portfolio3c',  
                'label' => '640 x 450'
              ),
              array(
                'value' => 'portfolio4c',
                'label' => '480 x 360'
              ),
              array(
                'value' => 'portfolio5c',  
                'label' => '380 x 280'
              ),
              array(
                'value' => 'post-thumbnail',
                'label' => '270 x 250'
              ),
            ),
            'default' => array('{{first}}')
          ),
        array(
            'type' => 'toggle',
            'name' => 'thumbnail',
            'label' => __('Show Thumbnail', 'luxe_framework'),
            'description' => __('Shows the featured image, slider or video of a post', 'luxe_framework'),
            'default' => '1',
        ),
        array(
            'type' => 'toggle',
            'name' => 'excerpt',
            'label' => __('Show Excerpt', 'luxe_framework'),
            'description' => __('Shows the beginning text of the post', 'luxe_framework'),
            'default' => '1',
        ),
        array(
            'type' => 'toggle',
            'name' => 'pagination',
            'label' => __('Show Pagination', 'luxe_framework'),
            'description' => __('Shows the pagination links', 'luxe_framework'),
            'default' => '0',
        ),
        array(
            'type' => 'multiselect',
            'name' => 'category',
            'label' => __('Category', 'luxe_framework'),
            'description' => __('', 'luxe_framework'),
            'items' => $categories,
        ),
        /*array(
            'type' => 'select',
            'name' => 'type',
            'label' => __('Post Type', 'luxe_framework'),
            'description' => __('', 'luxe_framework'),
            'items' => $luxe_post_types_names,
        ),*/
          array(
            'name'  => 'orderby',
            'type'  => 'select',
            'label' => __('Order Posts By', 'luxe_framework'),
            'items' => array(
              array(
                'value' => 'date',
                'label' => 'Date'
              ),
              array(
                'value' => 'title',
                'label' => 'Title'
              ),
              array(
                'value' => 'modified',
                'label' => 'Last Modified'
              ),
              array(
                'value' => 'rand',
                'label' => 'Random'
              ),
              array(
                'value' => 'menu_order',
                'label' => 'Menu Order'
              ),
            ),
            'default' => array('{{first}}')
          ),
          array(
            'name'  => 'order',
            'type'  => 'select',
            'label' => __('Order', 'luxe_framework'),
            'items' => array(
              array(
                'value' => 'ASC',
                'label' => 'Ascending'
              ),
              array(
                'value' => 'DESC',
                'label' => 'Descending'
              ),
            ),
            'default' => array('{{first}}')
          ),
          array(
            'name'  => 'limit',
            'type'  => 'textbox',
            'label' => __('Maximum Posts to Show', 'luxe_framework'),
          ),
          array(
            'name'  => 'offset',
            'type'  => 'textbox',
            'label' => __('Offset from Newest Post', 'luxe_framework'),
          ),
    )
);

            /*    "offset" => '',
                "limit" => '',
                "thumbnail" => 'true',
                "excerpt" => 'true',
                "length" => 8,
                "morelink" => '',
                "type" => 'post',
                "parent" => '',
                "category" => '',
                "orderby" => 'date',
                "order" => 'ASC',
                "paged" => '1',
                "size" => '',
                "date" => 'true',
                "columns" => '2',
                "style" => 'style1',
                "pagination" => 'true'*/

?>
