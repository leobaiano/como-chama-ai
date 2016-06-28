<?php 

/* ---------------------------------------------------------------------- */
/*  BUTTONS SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode('button', 'luxe_button');

function luxe_button( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'url' => '#',
    'size' => 'medium',
    'color' => 'custom',
    'text_color' => '',
    'background_color' => '',
    'target' => '_self',
    'align' => '',
    'icon' => '',
    'slide' => '',
    'style' => ''
    ), $atts)); 

  $slide_class = ($slide ? 'scroll-link' : '');
  $button = '';
  $button .= '<a class="button '.$size.' '. $align.' '.$color.' '.$slide_class.' '.$style.'" target="'.$target.'" href="'.$url.'" data-slide="'.$slide.'" style="background-color:'.$background_color.'">';
  $button .= '<span class="button-text" style="color:'.$text_color.'">';
  $button .= ($icon ? '<i class="button-icon '.$icon.'" style="color:'.$text_color.'"></i>' : '');
  $button .= do_shortcode($content).'</span>';
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

$content['Elements']['elements']['button'] =     array(
        'title'   => 'Button',
        'code'    => '[button][/button]',
        'attributes' => array(
          array(
            'name'  => 'content_button',
            'type'  => 'textbox',
            'label' => __('Button Text', 'luxe_framework'),
          ),
          array(
            'name'  => 'style',
            'type'  => 'select',
            'label' => __('Style', 'luxe_framework'),
            'items' => array(
              array(
                'value' => 'custom',
                'label' => 'Default - Theme Options Defined'
              ),
              array(
                'value' => 'alt',
                'label' => 'Alternate - Theme Options Defined'
              )
            ),
            'default' => array('{{first}}')
          ),
          array(
            'name'  => 'text_color',
            'type'  => 'color',
            'label' => __('Text Color', 'luxe_framework'),
          ),
          array(
            'name'  => 'background_color',
            'type'  => 'color',
            'label' => __('Background Color', 'luxe_framework'),
          ),
          array(
            'name'  => 'url',
            'type'  => 'textbox',
            'label' => __('Button URL', 'luxe_framework'),
          ),
          array(
            'name'  => 'slide',
            'type'  => 'select',
            'label' => __('Slide (slides to this page if on the one-page template)', 'luxe_framework'),
            'items' => $page_names,
            'default' => ''
          ),
          /*array(
            'name'  => 'icon',
            'type'  => 'fontawesome',
            'label' => __('Icon', 'luxe_framework'),
          )*/
        )
      );

?>