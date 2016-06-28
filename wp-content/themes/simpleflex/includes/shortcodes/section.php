<?php

/* ---------------------------------------------------------------------- */
/*	SECTIONS SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'section', 'luxe_section' );

function luxe_section($atts, $content) {
	extract(shortcode_atts(array(
      "background_color" => '',
      "border_color" => '',
      "background_image" => '',
      "background_repeat" => 'cover',
      "background_attachment" => 'scroll',
      "wrap" => 'true',
      "padding" => '0',
      "position" => 'default'
   ), $atts));
	
        if($border_color) { $border = '1px solid' .$border_color; } else { $border = ''; }
        
        $class = 'full ' .$position;
        
        if($background_repeat == 'cover'):
          $background_repeat = "-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;";
        else:
          $background_repeat = "background-repeat: {$background_repeat};";
        endif;
        
        $output  = '</div></div></div></div><div class="'.$class.'" style="display:block !important;background-color:'.$background_color.'; background-image:url('.$background_image.'); '.$background_repeat.'; background-attachment: '.$background_attachment.'; border-top:'.$border.'; border-bottom:'.$border.'; padding:'.$padding.'px 0px;">';
        if ($wrap == 'true') { $output .= '<div class="wrap clearfix">'; }
        $output .= $content;
        if ($wrap == 'true') { $output .= '</div>'; }
        $output .= '</div><div><div class="wrap clearfix"><div role="article"><div class="entry-content clearfix">';

        
        return do_shortcode($output);
}


/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$layout['Layout']['elements']['section'] =     array(
        'title'   => __('Section', 'qualia_td'),
        'code'    => '[section][/section]',
        'attributes' => array(
          array(
            'name'  => 'wrap',
            'type'  => 'radiobutton',
            'label' => __('Content Width', 'luxe_framework'),
            'items' => array(
              array(
                'value' => 'false',
                'label' => 'Full Width'
              ),
              array(
                'value' => 'true',
                'label' => 'Wrapped'
              ),
            ),
          ),
          array(
            'name'  => 'position',
            'type'  => 'select',
            'label' => __('Placement of Section', 'luxe_framework'),
            'items' => array(
              array(
                'value' => 'default',
                'label' => 'Default'
              ),
              array(
                'value' => 'behind',
                'label' => 'Behind'
              ),
            ),
          ),
          array(
            'name'  => 'background_color',
            'type'  => 'color',
            'label' => __('Background Color', 'luxe_framework'),
            'default' => '',
          ),
          array(
            'name'  => 'border_color',
            'type'  => 'color',
            'label' => __('Border Color', 'luxe_framework'),
            'default' => '',
          ),
          array(
            'name'  => 'padding',
            'type'  => 'slider',
            'label' => __('Spacing above and below section', 'luxe_framework'),
            'default' => '40',
            'min' => 0,
            'max' => 200,
          ),
          array(
            'name'  => 'background_image',
            'type'  => 'upload',
            'label' => __('Background Image', 'luxe_framework'),
          ),
          array(
            'name'  => 'background_repeat',
            'type'  => 'select',
            'label' => __('Placement of Section', 'luxe_framework'),
            'items' => array(
              array(
                'value' => 'cover',
                'label' => __('Stretch to Fit', 'luxe_framework'),
              ),
              array(
                'value' => 'repeat-x',
                'label' => __('Repeat Horizontally', 'luxe_framework'),
              ),
              array(
                'value' => 'repeat-y',
                'label' => __('Repeat Vertically', 'luxe_framework'),
              ),
              array(
                'value' => 'repeat',
                'label' => __('Repeat Both', 'luxe_framework'),
              ),
              array(
                'value' => 'no-repeat',
                'label' => __('No Repeat', 'luxe_framework'),
              ),
            ),
            'default'     => array(
              'cover',
            ),
          ),
          array(
            'name'  => 'background_attachment',
            'type'  => 'select',
            'label' => __('Placement of Section', 'luxe_framework'),
            'items' => array(
              array(
                'value' => 'scroll',
                'label' => __('Scroll (traditional background)', 'luxe_framework'),
              ),
              array(
                'value' => 'fixed',
                'label' => __('Fixed (parallax effect)', 'luxe_framework'),
              ),
            ),
          ),
          array(
            'name'                       => 'content_section',
            'type'                       => 'wpeditor',
            'label'                      => __('', 'luxe_framework'),
            'use_external_plugins'       => 1,
            'disabled_externals_plugins' => 'vp_sc_button',
            'disabled_internals_plugins' => '',
          ),
        )
);


?>