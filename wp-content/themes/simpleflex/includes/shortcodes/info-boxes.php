<?php

/* ---------------------------------------------------------------------- */
/*	INFO BOXES SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode('info', 'info_boxes');

function info_boxes( $atts, $content = null ) {
	extract(shortcode_atts(array(
  	'type' => 'type'
  	), $atts));
	if ($atts['type']) {
   		return '<div class="alert-'.$type.'">' . do_shortcode($content) . '</div>';
	}
	else {
		return '<div class="alert">' . do_shortcode($content) . '</div>';
	}
}

/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$content['Elements']['elements']['info'] =     array(
        'title'   => 'Info Box',
        'code'    => '[info][/info]',
        'attributes' => array(
          array(
            'name'  => 'type',
            'type'  => 'select',
            'label' => __('Info Box Type', 'luxe_framework'),
            'items' => array(
              array(
                'value' => 'success',
                'label' => 'Success'
              ),
              array(
                'value' => 'error',
                'label' => 'Error'
              ),
              array(
                'value' => 'warning',
                'label' => 'Warning'
              ),
              array(
                'value' => 'info',
                'label' => 'Information'
              )
            ),
            'default' => array('{{first}}')
          ),
          array(
            'name'                       => 'content_info',
            'type'                       => 'wpeditor',
            'label'                      => __('', 'luxe_framework'),
            'use_external_plugins'       => 1,
            'disabled_externals_plugins' => 'vp_sc_button',
            'disabled_internals_plugins' => '',
          )
        )
      );

?>