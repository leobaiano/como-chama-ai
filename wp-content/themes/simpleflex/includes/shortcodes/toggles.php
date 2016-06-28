<?php

/* ---------------------------------------------------------------------- */
/*	TOGGLES SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'togglegroup', 'luxe_togglegroup' );
add_shortcode( 'toggle', 'luxe_toggle' );

function luxe_togglegroup( $atts, $content ) {

	$output = '<div class="toggles-container">'.do_shortcode( $content ).'</div>';

	return $output;

}

function luxe_toggle( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'title' => '',
				'style' => 'list'
			), $atts ) );
	$output = '';
	$output .= '<div class="'.$style.'"><p class="trigger"><a href="#">' .$title. '</a></p>';
	$output .= '<div class="toggle_container"><div class="block">';
	$output .= do_shortcode( $content );
	$output .= '</div></div></div>';

	return $output;
}

/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$content['Elements']['elements']['toggle'] =     array(
	'title'   => __( 'Toggle', 'qualia_td' ),
	'code'    => '[togglegroup][toggle title="Title1 Goes Here"] Content for toggle 1 goes here [/toggle][toggle title="Title2 Goes Here"] Content for toggle 2 goes here [/toggle][/togglegroup]',
);


?>
