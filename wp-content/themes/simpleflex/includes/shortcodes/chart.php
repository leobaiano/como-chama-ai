<?php

/* ---------------------------------------------------------------------- */
/*	CHART SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'chart', 'luxe_charts' );

function luxe_charts( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'color' => '',
    'percent' => '100'
    ), $atts ) ); 

$output = '';
$output .= '<div class="chart" data-percent="'.$percent.'" data-track-color="#343434" data-bar-color="'.$color.'">'
          .'<span class="chart-percent"></span>'
          .'</div>';        

return $output;
}

/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$content['Elements']['elements']['chart'] =     array(
	'title'   => 'Chart',
	'code'    => '[chart]',
	'attributes' => array(
		array(
			'name'  => 'color',
			'type'  => 'color',
			'label' => __( 'Chart Color', 'luxe_framework' ),
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
