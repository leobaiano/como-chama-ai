<?php

/* ---------------------------------------------------------------------- */
/*	FONT SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'font', 'luxe_font' );

function luxe_font( $atts, $content = null ) {
	extract(shortcode_atts(array(), $atts));	

                $output = '<span class="extra-font">'.$content.'</span>';	

	return $output;
}

/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$content['Elements']['elements']['font'] =     array(
        'title'   => 'Extra Font',
        'code'    => '[font]Your extra font (selected in theme options) will display here[/font]',
        );


?>