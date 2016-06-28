<?php

define('LUXE_SHORTCODES', LUXE_INC_DIR . '/shortcodes/');

// shortcode arrays for buttons
$layout     = array(); // seperated so element shortcodes can be inserted via modal content editor
$animation  = array();
$content    = array();

/* ---------------------------------------------------------------------- */
/*  SHORTCODE INCLUDES
/* ---------------------------------------------------------------------- */

require_once( LUXE_SHORTCODES . 'animate.php' );
require_once( LUXE_SHORTCODES . 'blog.php' );
require_once( LUXE_SHORTCODES . 'button.php' );
require_once( LUXE_SHORTCODES . 'chart.php' );
require_once( LUXE_SHORTCODES . 'clear.php' );
require_once( LUXE_SHORTCODES . 'clients.php' );
require_once( LUXE_SHORTCODES . 'column.php' );
require_once( LUXE_SHORTCODES . 'feature.php' );
require_once( LUXE_SHORTCODES . 'font.php' );
require_once( LUXE_SHORTCODES . 'icon.php' );
require_once( LUXE_SHORTCODES . 'info-boxes.php' );
require_once( LUXE_SHORTCODES . 'link.php' );
require_once( LUXE_SHORTCODES . 'map.php' );
require_once( LUXE_SHORTCODES . 'portfolio.php' );
require_once( LUXE_SHORTCODES . 'pricing.php' );
require_once( LUXE_SHORTCODES . 'progress.php' );
require_once( LUXE_SHORTCODES . 'section.php' );
require_once( LUXE_SHORTCODES . 'social.php' );
require_once( LUXE_SHORTCODES . 'tabs.php' );
require_once( LUXE_SHORTCODES . 'team.php' );
require_once( LUXE_SHORTCODES . 'testimonial.php' );
require_once( LUXE_SHORTCODES . 'toggles.php' );
require_once( LUXE_SHORTCODES . 'twitter.php' );


//require_once( LUXE_SHORTCODES . 'testimonial.php' );
//require_once( LUXE_SHORTCODES . 'pricing.php' );

/* ---------------------------------------------------------------------- */
/*  ADD SHORTCODES TO OTHER AREAS
/* ---------------------------------------------------------------------- */

add_filter( 'luxe_footer', 'do_shortcode', 7 );
add_filter( 'luxe_header', 'do_shortcode', 7 );
add_filter( 'widget_text', 'do_shortcode', 7 );
add_filter('metaslider_image_flex_slider_markup', 'do_shortcode', 7 ); //Uncomment this for shortcodes in metaslider

// ThemeForest approved thanks to @bitfade - http://pastie.org/pastes/7122892/text?key=eqptyqa4qdmempics74xsa
add_filter("the_content", "luxe_content_filter");

function luxe_content_filter($content) {
 $shortcodes = array(
  'animate',
  'button',
  'clear',
  'clients',
  'one_third',
  'two_third',
  'one_half',
  'one_fourth',
  'three_fourth',
  'one_fifth',
  'two_fifth',
  'three_fifth',
  'four_fifth',
  'one_sixth',
  'five_sixth',
  'dropcap',
  'feature',
  'font',
  'icon',
  'info',
  'link',
  'map',
  'portfolio',
  'pricing',
  'section',
  'social',
  'tab',
  'tabgroup',
  'team_member',
  'testimonial',
  'togglegroup',
  'toggle',
  'twitter_tweets');

  // array of custom shortcodes requiring the fix 
  $block = join("|",$shortcodes);
 
  // opening tag
  $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
    
  // closing tag
  $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
 
  return $rep;
 
}

/* ---------------------------------------------------------------------- */
/*  CREATE SHORTCODE GENERATOR BUTTONS
/* ---------------------------------------------------------------------- */

$layout   = array(
  'name'           => 'columns',                                        // unique name, required
  'template'       => $layout,                                     // template file or array, required
  'modal_title'    => __( 'Layout', 'luxe_framework'), // modal title, default to empty string
  'button_title'   => __( 'Layout', 'luxe_framework'),              // button title, default to empty string
  'types'          => array( 'post', 'page' ),                       // at what post types the generator should works, default to post and page
  'included_pages' => array( 'appearance_page_vpt_option' ),         // or to what other admin pages it should appears
  'main_image'     => get_template_directory_uri() . '/images/shortcodes_layout.png',
  'sprite_image'   => get_template_directory_uri() . '',
);
$animation         = array(
  'name'           => 'animation',                                        // unique name, required
  'template'       => $animation,                                     // template file or array, required
  'modal_title'    => __( 'Animation', 'luxe_framework'), // modal title, default to empty string
  'button_title'   => __( 'Animation', 'luxe_framework'),              // button title, default to empty string
  'types'          => array( 'post', 'page' ),                       // at what post types the generator should works, default to post and page
  'included_pages' => array( 'appearance_page_vpt_option' ),         // or to what other admin pages it should appears
  'main_image'     => get_template_directory_uri() . '/images/shortcodes_animation.png',
  'sprite_image'   => get_template_directory_uri() . '',
);
$content           = array(
  'name'           => 'elements',                                        // unique name, required
  'template'       => $content,                                     // template file or array, required
  'modal_title'    => __( 'Elements', 'luxe_framework'), // modal title, default to empty string
  'button_title'   => __( 'Content', 'luxe_framework'),              // button title, default to empty string
  'types'          => array( 'post', 'page' ),                       // at what post types the generator should works, default to post and page
  'included_pages' => array( 'appearance_page_vpt_option' ),         // or to what other admin pages it should appears
);

$layout     = new VP_ShortcodeGenerator($layout);
$animation  = new VP_ShortcodeGenerator($animation);
$content    = new VP_ShortcodeGenerator($content);




?>
