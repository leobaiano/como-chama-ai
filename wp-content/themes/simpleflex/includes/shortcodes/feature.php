<?php

/* ---------------------------------------------------------------------- */
/*	SERVICES SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'feature', 'luxe_features' );

function luxe_features( $atts, $content = null ) {

	extract( shortcode_atts( array(
				'id' => '',
				'title' => '',
        'title_color' => '',
				'icon' => '',
				'icon_size' => '',
				'icon_color' => '',
				'border_bottom_color' => '',
				'image' => '',
				'style' => '',
				'url' => ''
			), $atts ) );


	$output = '';
	$feature_image = '';
	if ( $icon ) {
		$feature_image = '<i class="feature-icon '.$icon.'" style="font-size:'.$icon_size.'px; color:'.$icon_color.';"></i>';
	}
	elseif($image) {
		$feature_image = '<img src="'.$image.'" class="feature-image" alt="'.$title.'" />';
	}

	$output =  '<article class="feature '.$style.'" style="border-bottom-color:'.$border_bottom_color.';border-right-color:'.$border_bottom_color.';">';
	$output .= '<div class="feature-heading clearfix">';
	$output .= $feature_image;
	$output .= $url ? '<a href="'.$url.'">' : '';
	$output .= '<h3 class="feature-title" style="color:'.$title_color.';">'.$title.'</h3>';
	$output .= $url ? '</a>' : '';
	$output .= '</div>';
	$output .= '<span class="feature-desc">'.$content.'</span>';
	$output .= '</article>';

	return do_shortcode( $output );
}

/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$content['Elements']['elements']['feature'] = array(
        'title'   => 'Feature Box',
        'code'    => '[feature][/feature]',
        'attributes' => array(
          array(
            'name'  => 'style',
            'type'  => 'select',
            'label' => __('Feature Type', 'luxe_framework'),
            'items' => array(
              array(
                'value' => 'style1',
                'label' => 'Style 1 (Rotate)'
              ),
              array(
                'value' => 'style2',
                'label' => 'Style 2 (Flip)'
              ),
              array(
                'value' => 'style3',
                'label' => 'Style 3 (Rotate - Side Icon)'
              ),
              array(
                'value' => 'style4',
                'label' => 'Style 4 (Static)'
              ),
            ),
            'default' => array('{{first}}')
          ),
          array(
            'name'  => 'title',
            'type'  => 'textbox',
            'label' => __('Title', 'luxe_framework'),
          ),
          array(
            'name'  => 'title_color',
            'type'  => 'color',
            'label' => __('Title Color', 'luxe_framework'),
          ),
          array(
            'name'  => 'icon',
            'type'  => 'customicons',
            'label' => __('Icon', 'luxe_framework'),
          ),
          array(
            'name'  => 'icon_color',
            'type'  => 'color',
            'label' => __('Icon Color', 'luxe_framework'),
          ),
      		array(
      			'name'  => 'icon_size',
      			'type'  => 'slider',
      			'label' => __( 'Icon Size', 'luxe_framework' ),
      			'default' => '20',
      			'min' => 5,
      			'max' => 100,
      		),
          array(
            'name'  => 'image',
            'type'  => 'upload',
            'label' => __('Feature Image (only used if no icon is selected)', 'luxe_framework'),
          ),
          array(
            'name'  => 'border_bottom_color',
            'type'  => 'color',
            'label' => __('Bottom Border Color', 'luxe_framework'),
          ),
          array(
            'name'  => 'url',
            'type'  => 'textbox',
            'label' => __('Title URL', 'luxe_framework'),
          ),
          array(
            'name'  => 'content_feature',
            'type'  => 'wpeditor',
            'label' => __('', 'luxe_framework'),
          ),
        )
      );


?>
