<?php

/* ---------------------------------------------------------------------- */
/*	SOCIAL SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'social', 'luxe_social' );

function luxe_social( $atts, $content = null ) {

	extract( shortcode_atts( array(
				'float' => '',
				'showall' => 'false',
				'background' => 'transparent',
				'social_background' => 'transparent',
				'icon_color' => '#ffffff',
				'border_color' => 'transparent',
				'circle_color' => 'transparent',
				'text_color' => ''
			), $atts ) );


    $social_array = array( 'soundcloud-rounded', 'pinterest-rounded', 'windows-rounded', 'addthis-rounded', 'sharethis-rounded', 'picasa-rounded', 'lastfm-rounded', 'technorati-rounded', 'mac-rounded', 'dribble-rounded', 'behance-rounded', 'facebook-rounded', 'google-rounded', 'skype-rounded', 'linkedin-rounded', 'deviantart-rounded', 'bing-rounded', 'twitter-rounded', 'myspace-rounded', 'flickr-rounded', 'tumblr-rounded', 'paypal-rounded', 'rss-rounded', 'stumbleupon-rounded', 'blogger-rounded', 'vimeo-rounded', 'wordpress-rounded', 'youtube-rounded', 'yahoo-rounded', 'aim-rounded', 'dribble', 'behance', 'facebook', 'google', 'skype', 'linkedin', 'deviantart', 'bing', 'twitter', 'myspace', 'flickr', 'tumblr', 'paypal', 'rss', 'stumbleupon', 'blogger', 'vimeo', 'wordpress', 'youtube', 'yahoo', 'aim' );


	$output = '<div class="social" style="float:'.$float.'; background:'.$background.';">';

	if ( $social_array ) {

		global $luxe_options;
		$output .= ( $content ? '<span class="social-text" style="color:'.$text_color.'">'.$content.'</span>' : '' );
		$output .= '<div class="socialbar" style="background-color:'.$social_background.'">';
		$classes = $circle_color != 'transparent' ? 'circle' : '';
		$output .= '<ul class="social-icons '.$classes.'">';

		foreach ( $social_array as $social_media ) {

			if ( $luxe_options[ $social_media ]  || $showall == 'true' ) {
				$output .= '<li style="border-color:'.$border_color.';"><a href="' . $luxe_options[ $social_media ] . '" class="socialico-' . $social_media . '" target="_blank" style="background-color:'.$circle_color.'"></a></li>';
			}

		}
		$output .= '</ul>';
		$output .= '</div>';
	}

	$output .= '</div>';

	return $output;

}


/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$content['Elements']['elements']['social'] =     array(
        'title'   => 'Social Media (configure in Theme Options)',
        'code'    => '[social]',
        'attributes' => array(
			/*array(
			    'type' => 'sorter',
			    'name' => 'so_1',
			    'label' => __('Sorter', 'luxe_framework'),
			    'description' => __('Select and sort your choices', 'luxe_framework'),
			    'items' => array(
			        'data' => array(
			            array(
			                'source' => 'function',
			                'value' => 'vp_get_social_medias',
			            ),
			        ),
			    ),
			),*/
          array(
            'name'  => 'icon_color',
            'type'  => 'color',
            'label' => __('Icon Color', 'luxe_framework'),
            'description' => 'testing',
          ),
          array(
            'name'  => 'background',
            'type'  => 'color',
            'label' => __('Background Color', 'luxe_framework'),
          ),
        )
      );


?>
