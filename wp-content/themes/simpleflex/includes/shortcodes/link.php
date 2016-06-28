<?php 

/* ---------------------------------------------------------------------- */
/*  LINKS SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode('link', 'luxe_link');

function luxe_link( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'url' => '#',
    'target' => '_self',
    'align' => '',
    'slide' => ''
    ), $atts)); 

  $slide_class .= ($slide ? 'scroll-link' : '');
  $button = '';
  $button .= '<a class="'. $align.' '.$slide_class.'" target="'.$target.'" href="'.$url.'" data-slide="'.$slide.'">';
  $button .= do_shortcode($content);
  $button .= '</a>';
  return $button;
}

/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

// get slugs and titles for slide variable
$args = array(
  'post_type' => 'page',
  'post_status' => 'publish'
);

$pages = get_pages($args);
$page_names = array();

foreach($pages as $page) {
  $page_names[] = array(
      'value' => $page->post_name,
      'label' => $page->post_title,
  );
}

$content['Elements']['elements']['link'] =     array(
        'title'   => 'Link',
        'code'    => '[link][/link]',
        'attributes' => array(
          array(
            'name'  => 'content_link',
            'type'  => 'textbox',
            'label' => __('Link Text', 'luxe_framework'),
          ),
          array(
            'name'  => 'url',
            'type'  => 'textbox',
            'label' => __('URL', 'luxe_framework'),
          ),
          array(
            'name'  => 'slide',
            'type'  => 'select',
            'label' => __('Slide (slides to this page if on the one-page template)', 'luxe_framework'),
            'items' => $page_names,
            'default' => ''
          ),
        )
      );

?>