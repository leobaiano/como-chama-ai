<?php

/* ---------------------------------------------------------------------- */
/*	ICONS SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'icon', 'luxe_icon' );

function luxe_icon( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'size' => '20px',
				'color' => ''
			), $atts ) );
	$icon = '';

	$icon = '<i class="luxe-icon '.$content.'" style="font-size:'.$size.'px; color:'.$color.';"></i>';

	return $icon;
}

/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$content['Elements']['elements']['icon'] =     array(
	'title'   => 'Icon',
	'code'    => '[icon][/icon]',
	'attributes' => array(
		array(
			'name'  => 'color',
			'type'  => 'color',
			'label' => __( 'Icon Color', 'luxe_framework' ),
		),
		array(
			'name'  => 'size',
			'type'  => 'slider',
			'label' => __( 'Icon Size', 'luxe_framework' ),
			'default' => '20',
			'min' => 5,
			'max' => 100,
		),
		array(
			'name'  => 'content_icon',
			'type'  => 'customicons',
			'label' => __( 'Icon', 'luxe_framework' ),
		)
	)
);

?>
