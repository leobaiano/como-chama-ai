<?php

/* ---------------------------------------------------------------------- */
/*  CLIENTS SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode('clients', 'luxe_clients');

function luxe_clients( $atts, $content = null ) {
  
  extract( shortcode_atts( array(
    'id' => '',
                'columns' => '5'
    ), $atts ) );

  global $post;

  $args = array(
                'post_type'      => 'clients',
                'order' => 'ASC',
                'orderby' => 'menu_order',
                'posts_per_page' => '100'
  );


  $clients = get_posts( $args );
        
        $item_class = 'clients clients_new ';
        switch($columns) {
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
                case '5':
                    $item_class .= 'one_fifth';
                    break;
                case '6':
                    $item_class .= 'one_fifth';
                    break;
        }
        
      
  $output =  '<div class="client-carousel owl-carousel">';  
        $count = 0;     
 
  foreach ($clients as $client) : setup_postdata($client); 
    
     /*// add last class for multiple columns
     $last = '';
     $count++;
     if(($count % $columns) == 1) {
          $first = 'first';
     } */      
     
    $src = wp_get_attachment_image_src(get_post_thumbnail_id($client->ID), 'full');
    if($src) $image = '<img src="'.$src[0].'" class="client-logo" alt="'.$client->post_title.'" />';
    else $image = '';    
    
    /*$output .= '<div class="client '.$item_class.' '.$first.'">';
    $output .= $image;
    //$output .= '<h3 class="client-title">'.$feature->post_title.'</h3>';
    $output .= '</div>';*/

    $output .= '<div>';
    $output .= $image;
    $output .= '</div>';
    

  endforeach;
  wp_reset_postdata();
        
  $output .= '</div>';

  return do_shortcode($output);

}

/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$content['Elements']['elements']['clients'] =     array(
        'title'   => __('Clients', 'qualia_td'),
        'code'    => '[clients]',
        'attributes' => array(
          array(
            'name'  => 'columns',
            'type'  => 'slider',
            'label' => __('Columns', 'luxe_framework'),
            'default' => '4',
            'min' => 1,
            'max' => 6,
          ),

        )
);

