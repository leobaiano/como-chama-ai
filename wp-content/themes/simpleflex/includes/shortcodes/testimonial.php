<?php

/* ---------------------------------------------------------------------- */
/*  TESTIMONIALS SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'testimonial', 'luxe_testimonial' );

function luxe_testimonial( $atts, $content = null ) {
  extract( shortcode_atts( array(
        "offset" => '',
        "num" => '-1',
        "thumbs" => 'true',
        "parent" => '',
        "orderby" => 'date',
        "order" => 'ASC',
        "color" => '#ffffff'
      ), $atts ) );
  global $post;

  $args = array(
    //    'cat' => $category,
    'post_type' => 'testimonials',
    'showposts' => $num,
    'posts_per_page' => $num,
    'orderby' => $orderby,
    'offset' => $offset,
    'order' => $order
  );
  // query
  $myposts = new WP_Query( $args );

  $output = '<div class="testimonial-carousel flexslider luxe-flexslider">';
  $count = 0;
  $output .= '<ul class="slides">';
  while ( $myposts->have_posts() ) : $myposts->the_post();
    $output .= '<li>';


    $output .= '<div class="testimonial-content" style="color:'.$color.';">' . get_the_content() . '</div>';
    $output .= '<div class="testimonial-user" style="color:'.$color.';">' . get_the_title() .'</div>';

    $count++;
    $output .= '</li>';
  endwhile;
  wp_reset_postdata();

  $output .= '</ul>';
  $output .= '</div>';

  return $output;
}

/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$content['Elements']['elements']['testimonial'] =     array(
    'title'   => 'Testimonials',
    'code'    => '[testimonial]',
    'attributes' => array(
          array(
            'name'  => 'color',
            'type'  => 'color',
            'label' => __('Color', 'luxe_framework'),
          ),
          array(
            'name'  => 'orderby',
            'type'  => 'select',
            'label' => __('Order Testimonials By', 'luxe_framework'),
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
            'label' => __('Maximum Testimonials to Show', 'luxe_framework'),
          ),
    )
);