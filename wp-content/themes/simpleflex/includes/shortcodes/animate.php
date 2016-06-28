<?php

/* ---------------------------------------------------------------------- */
/*	ANIMATE SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'animate', 'luxe_animate' );

function luxe_animate( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'style' => 'fadeIn',
    'delay' => '100',
    'duration' => '500'
    ), $atts ) ); 

                $delay = $delay * .001;
                $duration = $duration * .001;

                $delay_style = '-webkit-animation-delay:'.$delay.'s;
                                   -moz-animation-delay:'.$delay.'s;
                                    -ms-animation-delay:'.$delay.'s;
                                     -o-animation-delay:'.$delay.'s;
                                        animation-delay:'.$delay.'s;';
                $duration_style ='-webkit-animation-duration:'.$duration.'s;
                                     -moz-animation-duration:'.$duration.'s;
                                      -ms-animation-duration:'.$duration.'s;
                                       -o-animation-duration:'.$duration.'s;
                                          animation-duration:'.$duration.'s;';
                $output = '<div class="luxe-animate hidden" data-animation="'.$style.'" style="'.$delay_style.' '.$duration_style.'">'.do_shortcode($content).'</div>';  

  return $output;
}

/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$animation_array = array(
              array(
                'value' => 'bounce',
                'label' => 'Bounce'
              ),
              array(
                'value' => 'flash',
                'label' => 'Flash'
              ),
              array(
                'value' => 'pulse',
                'label' => 'Pulse'
              ),    
              array(
                'value' => 'shake',
                'label' => 'Shake'
              ),    
              array(
                'value' => 'swing',
                'label' => 'Swing'
              ),    
              array(
                'value' => 'tada',
                'label' => 'Tada'
              ),    
              array(
                'value' => 'wobble',
                'label' => 'Wobble'
              ),
              array(
                'value' => 'bounceIn',
                'label' => 'Bounce In'
              ),    
              array(
                'value' => 'bounceInDown',
                'label' => 'Bounce In Down'
              ),    
              array(
                'value' => 'bounceInLeft',
                'label' => 'Bounce In Left'
              ),    
              array(
                'value' => 'bounceInRight',
                'label' => 'Bounce In Right'
              ),    
              array(
                'value' => 'bounceInUp',
                'label' => 'Bounce In Up'
              ),
              array(
                'value' => 'bounceOut',
                'label' => 'Bounce In Out'
              ),    
              array(
                'value' => 'bounceOutDown',
                'label' => 'Bounce Out Down'
              ),    
              array(
                'value' => 'bounceOutLeft',
                'label' => 'Bounce Out Left'
              ),    
              array(
                'value' => 'bounceOutRight',
                'label' => 'Bounce Out Right'
              ),    
              array(
                'value' => 'bounceOutUp',
                'label' => 'Bounce Out Up'
              ),
              array(
                'value' => 'fadeIn',
                'label' => 'Fade In'
              ),    
              array(
                'value' => 'fadeInDown',
                'label' => 'Fade In Down'
              ),    
              array(
                'value' => 'fadeInDownBig',
                'label' => 'Fade In Down Big'
              ),    
              array(
                'value' => 'fadeInLeft',
                'label' => 'Fade In Left'
              ),    
              array(
                'value' => 'fadeInLeftBig',
                'label' => 'Fade In Left Big'
              ),
              array(
                'value' => 'fadeInRight',
                'label' => 'Fade In Right'
              ),    
              array(
                'value' => 'fadeInRightBig',
                'label' => 'Fade In Right Big'
              ),    
              array(
                'value' => 'fadeInUp',
                'label' => 'Fade In Up'
              ),    
              array(
                'value' => 'fadeInUpBig',
                'label' => 'Fade In Up Big'
              ),    
              array(
                'value' => 'flip',
                'label' => 'Flip'
              ),    
              array(
                'value' => 'tada',
                'label' => 'Tada'
              ),    
              array(
                'value' => 'flipInY',
                'label' => 'Flip In Y'
              ),
              array(
                'value' => 'flipOutX',
                'label' => 'Flip Out X'
              ),    
              array(
                'value' => 'flipOutY',
                'label' => 'Flip Out Y'
              ),    
              array(
                'value' => 'lightSpeedIn',
                'label' => 'Light Speed In'
              ),    
              array(
                'value' => 'lightSpeedOut',
                'label' => 'Light Speed Out'
              ),    
              array(
                'value' => 'rotateIn',
                'label' => 'Rotate In'
              ),
              array(
                'value' => 'rotateInDownLeft',
                'label' => 'Rotate In Down Left'
              ),    
              array(
                'value' => 'rotateInDownRight',
                'label' => 'Rotate In Down Right'
              ),    
              array(
                'value' => 'rotateInUpLeft',
                'label' => 'Rotate In Up Left'
              ),    
              array(
                'value' => 'rotateInUpRight',
                'label' => 'Rotate In Up Right'
              ),    
              array(
                'value' => 'rotateOut',
                'label' => 'Rotate Out'
              ),
              array(
                'value' => 'rotateOutDownLeft',
                'label' => 'Rotate Out Down Left'
              ),    
              array(
                'value' => 'rotateOutDownRight',
                'label' => 'Rotate Out Down Right'
              ),    
              array(
                'value' => 'rotateOutUpLeft',
                'label' => 'Rotate Out Up Left'
              ),    
              array(
                'value' => 'rotateOutUpRight',
                'label' => 'Rotate Out Up Right'
              ),    
              array(
                'value' => 'slideInDown',
                'label' => 'Slide In Down'
              ),
              array(
                'value' => 'slideInLeft',
                'label' => 'Slide In Left'
              ),    
              array(
                'value' => 'slideInRight',
                'label' => 'Slide In Right'
              ),    
              array(
                'value' => 'slideOutLeft',
                'label' => 'Slide Out Left'
              ),    
              array(
                'value' => 'slideOutRight',
                'label' => 'Slide Out Right'
              ),    
              array(
                'value' => 'slideOutUp',
                'label' => 'Slide Out Up'
              ),    
              array(
                'value' => 'hinge',
                'label' => 'Hinge'
              ),
              array(
                'value' => 'rollIn',
                'label' => 'Roll In'
              ),    
              array(
                'value' => 'rollOut',
                'label' => 'Roll Out'
              ), 
        );

$animation['Animations']['elements']['animate'] =     array(
        'title'   => __('Animate', 'qualia_td'),
        'code'    => '[animate][/animate]',
        'attributes' => array(
          array(
            'name'    => 'delay',
            'type'    => 'slider',
            'label'   => __('Delay (milliseconds)', 'qualia_td'),
            'min'     => 0,
            'max'     => 5000,
            'default' => 0,
          ),
          array(
            'name'    => 'duration',
            'type'    => 'slider',
            'label'   => __('Duration (milliseconds)', 'qualia_td'),
            'min'     => 0,
            'max'     => 5000,
            'default' => 1000,
          ),
          array(
            'name'  => 'animation',
            'type'  => 'select',
            'label' => __('Animation', 'luxe_framework'),
            'items' => $animation_array
          ),
          array(
            'name'                       => 'content_animate',
            'type'                       => 'wpeditor',
            'label'                      => __('', 'luxe_framework'),
            'use_external_plugins'       => 1,
            'disabled_externals_plugins' => 'vp_sc_button',
            'disabled_internals_plugins' => '',
            'default'                    => 'Animated content here',
          )
        )
);

?>