<?php

/* ---------------------------------------------------------------------- */
/*	PROGRESS SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'progress', 'luxe_progress' );

function luxe_progress( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'color' => '',
    'percent' => '100'
    ), $atts ) ); 

$output = '';
/*$output .= '<div class="chart" data-percent="'.$percent.'" data-track-color="#343434" data-bar-color="'.$color.'">'
          .'<span class="chart-percent"></span>'
          .'</div>';        */
$output .= '<div class="progress">
	          <span class="sr-only">'.do_shortcode($content).'</span>
	          <div class="progress-bar" style="background-color:'.$color.'; width: '.$percent.'%;" role="progressbar" aria-valuenow="'.$percent.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percent.'%">
	          </div>
	        </div>';
return $output;
}

/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$content['Elements']['elements']['progress'] =     array(
	'title'   => 'Progress Bar',
	'code'    => '[progress][/progress]',
	'attributes' => array(
		array(
			'name'  => 'content_progress',
			'type'  => 'textbox',
			'label' => __('Progress Bar Text', 'luxe_framework'),
		),
		array(
			'name'  => 'color',
			'type'  => 'color',
			'label' => __( 'Bar Color', 'luxe_framework' ),
		),
		array(
			'name'  => 'percent',
			'type'  => 'slider',
			'label' => __( 'Percentage', 'luxe_framework' ),
			'default' => '90',
			'min' => 0,
			'max' => 100,
		),
	)
);

?>
