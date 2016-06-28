<?php

/* ---------------------------------------------------------------------- */
/*	TABS SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'tabgroup', 'luxe_tabgroup' );
add_shortcode( 'tab', 'luxe_tab' );

function luxe_tabgroup( $atts, $content ) {

	extract( shortcode_atts( array(
				'type' => 'horizontal'
			), $atts ) );

	if ( !isset( $GLOBALS['luxe_tabs_groups'] ) )
		$GLOBALS['luxe_tabs_groups'] = 0;

	$GLOBALS['luxe_tabs_groups']++;

	$GLOBALS['luxe_tab_count'] = 0;

	$tabs_count = 1;

	do_shortcode( $content );

	if ( is_array( $GLOBALS['luxe_tabs'] ) ) {
		foreach ( $GLOBALS['luxe_tabs'] as $tab ) {
			$tabs[] = '<li><a href="#tab-' . $GLOBALS['luxe_tabs_groups'] . '-' . $tabs_count . '">'.$tab['icon'].$tab['title'].'</a></li>';
			$panes[] = '<div id="tab-' . $GLOBALS['luxe_tabs_groups'] . '-' . $tabs_count++ . '">'.$tab['content'].'</div>';
		}
		$return = "".'<div class="tabs '.$type.'"><ul class="clearfix">'.implode( "\n", $tabs ).'</ul>'.implode( "\n", $panes ).'</div>'."\n";
	}
	$GLOBALS['luxe_tabs'] = null;

	return $return;

}

function luxe_tab( $atts, $content ) {
	extract( shortcode_atts( array(
				'title' => '%d',
				'id' => '%d',
				'icon' => ''
			), $atts ) );

	$x = $GLOBALS['luxe_tab_count'];
	$GLOBALS['luxe_tabs'][$x] = array(
		'title' => sprintf( $title, $GLOBALS['luxe_tab_count'] ),
		'icon' => do_shortcode( '[icon size="60px"]'.$icon.'[/icon]' ),
		'content' =>  do_shortcode( $content ),
		'id' =>  $id );

	$GLOBALS['luxe_tab_count']++;
}


/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$content['Elements']['elements']['tab'] =     array(
	'title'   => __( 'Tab', 'qualia_td' ),
	'code'    => '[tabgroup][tab title="Title1 Goes Here"] Content for tab 1 goes here [/tab][tab title="Title2 Goes Here"] Content for tab 2 goes here [/tab][/tabgroup]',
);
