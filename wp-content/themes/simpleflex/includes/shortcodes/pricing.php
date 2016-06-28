<?php
 
/* ---------------------------------------------------------------------- */
/*	PRICING SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'pricing', 'luxe_pricing' );

function luxe_pricing( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'title' => '',
		'icon' => '',
		'price' => '',
		'unit' => '',
		'features' => '',
		'link' => '',
		'link_text' => '',
		'subprice' =>'',
		'color' => ''
	), $atts ) );

	$features = explode('||',$features);
	$features_list = '';
	for ($x=0;$x<count($features);$x++) {
		$features_list .= '<li>' . $features[$x] . '</li>';
	}

	$output = '<div class="pricing-box" style="border-bottom-color:'.$color.';">';
	$output .='<div class="pricing-header" style="background-color:'.$color.';"><h5>' . $title. '</h5></div>';
	$output .='<div class="pricing-price"><span class="pricing-unit">' . $unit . '</span><span class="pricing-amount" style="color:'.$color.';">' . $price . '</span></div>';
	$output .='<span class="pricing-subprice h6">'.$subprice.'</span>';
	$output .='<ul>' . $features_list . '</ul>';
	$output .='<div class="pricing-button button"><a href="' . $link . '">' . $link_text . '</a></div></div>';

	return $output;

}

?>