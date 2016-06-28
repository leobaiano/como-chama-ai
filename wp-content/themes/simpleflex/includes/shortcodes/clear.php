<?php

/* ---------------------------------------------------------------------- */
/*	LINE BREAK SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode('clear', 'luxe_break');

function luxe_break( $atts, $content = null ) {
	return '<div class="clearfix"></div>';
}

/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$layout['Layout']['elements']['clear'] =     array(
        'title'   => 'Clear (Line Break)',
        'code'    => '[clear]',
        );


?>