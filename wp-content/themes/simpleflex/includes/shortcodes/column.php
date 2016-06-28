<?php

/* ---------------------------------------------------------------------- */
/*  COLUMNS SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'one_third', 'column_one_third' );
add_shortcode( 'one_third_last', 'column_one_third_last' );
add_shortcode( 'two_third', 'column_two_third' );
add_shortcode( 'two_third_last', 'column_two_third_last' );
add_shortcode( 'one_half', 'column_one_half' );
add_shortcode( 'one_half_last', 'column_one_half_last' );
add_shortcode( 'one_fourth', 'column_one_fourth' );
add_shortcode( 'one_fourth_last', 'column_one_fourth_last' );
add_shortcode( 'three_fourth', 'column_three_fourth' );
add_shortcode( 'three_fourth_last', 'column_three_fourth_last' );
add_shortcode( 'one_fifth', 'column_one_fifth' );
add_shortcode( 'one_fifth_last', 'column_one_fifth_last' );
add_shortcode( 'two_fifth', 'column_two_fifth' );
add_shortcode( 'two_fifth_last', 'column_two_fifth_last' );
add_shortcode( 'three_fifth', 'column_three_fifth' );
add_shortcode( 'three_fifth_last', 'column_three_fifth_last' );
add_shortcode( 'four_fifth', 'column_four_fifth' );
add_shortcode( 'four_fifth_last', 'column_four_fifth_last' );
add_shortcode( 'one_sixth', 'column_one_sixth' );
add_shortcode( 'one_sixth_last', 'column_one_sixth_last' );
add_shortcode( 'five_sixth', 'column_five_sixth' );
add_shortcode( 'five_sixth_last', 'column_five_sixth_last' );


function column_one_third( $atts, $content = null ) {
  extract( shortcode_atts( array(
        'float' => '',
      ), $atts ) );
  $first = (isset($atts[0]) && trim($atts[0]) == 'first') ? $first = 'first' : '';
  return '<div class="fourcol '.$first.'" style="float:'.$float.';">' . do_shortcode( $content ) . '</div>';
}

function column_two_third( $atts, $content = null ) {
  extract( shortcode_atts( array(
        'float' => ''
      ), $atts ) );
  $first = (isset($atts[0]) && trim($atts[0]) == 'first') ? $first = 'first' : '';
  return '<div class="eightcol '.$first.'" style="float:'.$float.';">' . do_shortcode( $content ) . '</div>';
}

function column_one_half( $atts, $content = null ) {
  extract( shortcode_atts( array(
        'float' => ''
      ), $atts ) );
  $first = (isset($atts[0]) && trim($atts[0]) == 'first') ? $first = 'first' : '';
  return '<div class="sixcol '.$first.'" style="float:'.$float.';">' . do_shortcode( $content ) . '</div>';
}

function column_one_fourth( $atts, $content = null ) {
  extract( shortcode_atts( array(
        'float' => ''
      ), $atts ) );
  $first = (isset($atts[0]) && trim($atts[0]) == 'first') ? $first = 'first' : '';
  return '<div class="threecol '.$first.'" style="float:'.$float.';">' . do_shortcode( $content ) . '</div>';
}

function column_three_fourth( $atts, $content = null ) {
  extract( shortcode_atts( array(
        'float' => ''
      ), $atts ) );
  $first = (isset($atts[0]) && trim($atts[0]) == 'first') ? $first = 'first' : '';
  return '<div class="ninecol '.$first.'" style="float:'.$float.';">' . do_shortcode( $content ) . '</div>';
}

function column_one_fifth( $atts, $content = null ) {
  extract( shortcode_atts( array(
        'float' => ''
      ), $atts ) );
  $first = (isset($atts[0]) && trim($atts[0]) == 'first') ? $first = 'first' : '';
  return '<div class="one_fifth '.$first.'" style="float:'.$float.';">' . do_shortcode( $content ) . '</div>';
}

function column_two_fifth( $atts, $content = null ) {
  extract( shortcode_atts( array(
        'float' => ''
      ), $atts ) );
  $first = (isset($atts[0]) && trim($atts[0]) == 'first') ? $first = 'first' : '';
  return '<div class="two_fifth '.$first.'" style="float:'.$float.';">' . do_shortcode( $content ) . '</div>';
}

function column_three_fifth( $atts, $content = null ) {
  extract( shortcode_atts( array(
        'float' => ''
      ), $atts ) );
  $first = (isset($atts[0]) && trim($atts[0]) == 'first') ? $first = 'first' : '';
  return '<div class="three_fifth '.$first.'" style="float:'.$float.';">' . do_shortcode( $content ) . '</div>';
}

function column_four_fifth( $atts, $content = null ) {
  extract( shortcode_atts( array(
        'float' => ''
      ), $atts ) );
  $first = (isset($atts[0]) && trim($atts[0]) == 'first') ? $first = 'first' : '';
  return '<div class="four_fifth '.$first.'" style="float:'.$float.';">' . do_shortcode( $content ) . '</div>';
}

function column_one_sixth( $atts, $content = null ) {
  extract( shortcode_atts( array(
        'float' => ''
      ), $atts ) );
  $first = (isset($atts[0]) && trim($atts[0]) == 'first') ? $first = 'first' : '';
  return '<div class="twocol '.$first.'" style="float:'.$float.';">' . do_shortcode( $content ) . '</div>';
}


function column_five_sixth( $atts, $content = null ) {
  extract( shortcode_atts( array(
        'float' => ''
      ), $atts ) );
  $first = (isset($atts[0]) && trim($atts[0]) == 'first') ? $first = 'first' : '';
  return '<div class="tencol '.$first.'" style="float:'.$float.';">' . do_shortcode( $content ) . '</div>';
}


/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$layout['Layout']['elements']['one_fifth'] =     array(
        'title'   => __('One Fifth', 'qualia_td'),
        'code'    => '[one_fifth][/one_fifth]',
        'attributes' => array(
          array(
            'name'                       => 'content_onefifth',
            'type'                       => 'wpeditor',
            'label'                      => __('', 'luxe_framework'),
            'use_external_plugins'       => 1,
            'disabled_externals_plugins' => 'vp_sc_button',
            'disabled_internals_plugins' => '',
          ),
        )
);
$layout['Layout']['elements']['one_fourth'] =     array(
        'title'   => __('One Fourth', 'qualia_td'),
        'code'    => '[one_fourth][/one_fourth]',
        'attributes' => array(
          array(
            'name'                       => 'content_onefourth',
            'type'                       => 'wpeditor',
            'label'                      => __('', 'luxe_framework'),
            'use_external_plugins'       => 1,
            'disabled_externals_plugins' => 'vp_sc_button',
            'disabled_internals_plugins' => '',
          )
        )
);
$layout['Layout']['elements']['one_third'] =     array(
        'title'   => __('One Third', 'qualia_td'),
        'code'    => '[one_third][/one_third]',
        'attributes' => array(
          array(
            'name'                       => 'content_onethird',
            'type'                       => 'wpeditor',
            'label'                      => __('', 'luxe_framework'),
            'use_external_plugins'       => 1,
            'disabled_externals_plugins' => 'vp_sc_button',
            'disabled_internals_plugins' => '',
          )
        )
);
$layout['Layout']['elements']['two_fifth'] =     array(
        'title'   => __('Two Fifth', 'qualia_td'),
        'code'    => '[two_fifth][/two_fifth]',
        'attributes' => array(
          array(
            'name'                       => 'content_twofifth',
            'type'                       => 'wpeditor',
            'label'                      => __('', 'luxe_framework'),
            'use_external_plugins'       => 1,
            'disabled_externals_plugins' => 'vp_sc_button',
            'disabled_internals_plugins' => '',
          )
        )
);
$layout['Layout']['elements']['one_half'] =     array(
        'title'   => __('One Half', 'qualia_td'),
        'code'    => '[one_half][/one_half]',
        'attributes' => array(
          array(
            'name'                       => 'content_onehalf',
            'type'                       => 'wpeditor',
            'label'                      => __('', 'luxe_framework'),
            'use_external_plugins'       => 1,
            'disabled_externals_plugins' => 'vp_sc_button',
            'disabled_internals_plugins' => '',
          )
        )
);
$layout['Layout']['elements']['three_fifth'] =     array(
        'title'   => __('Three Fifth', 'qualia_td'),
        'code'    => '[three_fifth][/three_fifth]',
        'attributes' => array(
          array(
            'name'                       => 'content_threefifth',
            'type'                       => 'wpeditor',
            'label'                      => __('', 'luxe_framework'),
            'use_external_plugins'       => 1,
            'disabled_externals_plugins' => 'vp_sc_button',
            'disabled_internals_plugins' => '',
          )
        )
);
$layout['Layout']['elements']['two_third'] =     array(
        'title'   => __('Two Third', 'qualia_td'),
        'code'    => '[two_third][/two_third]',
        'attributes' => array(
          array(
            'name'                       => 'content_twothird',
            'type'                       => 'wpeditor',
            'label'                      => __('', 'luxe_framework'),
            'use_external_plugins'       => 1,
            'disabled_externals_plugins' => 'vp_sc_button',
            'disabled_internals_plugins' => '',
          )
        )
);
$layout['Layout']['elements']['three_fourth'] =     array(
        'title'   => __('Three Fourth', 'qualia_td'),
        'code'    => '[three_fourth][/three_fourth]',
        'attributes' => array(
          array(
            'name'                       => 'content_threefourth',
            'type'                       => 'wpeditor',
            'label'                      => __('', 'luxe_framework'),
            'use_external_plugins'       => 1,
            'disabled_externals_plugins' => 'vp_sc_button',
            'disabled_internals_plugins' => '',
          )
        )
);
$layout['Layout']['elements']['four_fifth'] =     array(
        'title'   => __('Four Fifth', 'qualia_td'),
        'code'    => '[four_fifth][/four_fifth]',
        'attributes' => array(
          array(
            'name'                       => 'content_fourfifth',
            'type'                       => 'wpeditor',
            'label'                      => __('', 'luxe_framework'),
            'use_external_plugins'       => 1,
            'disabled_externals_plugins' => 'vp_sc_button',
            'disabled_internals_plugins' => '',
          )
        )
);
?>
