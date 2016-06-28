<?php

/* ---------------------------------------------------------------------- */
/*  TEAM MEMBER SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'team_member', 'luxe_team_member' );

function luxe_team_member( $atts, $content = null ) {

    extract( shortcode_atts( array(
                'id' => ''
            ), $atts ) );

    global $post;


    $args = array(
        'name'           => esc_attr( $id ),
        'post_type'      => 'team',
        'posts_per_page' => '1'
    );

    $members = get_posts( $args );

    foreach ( $members as $member ) : setup_postdata( $member );
    // Prepare social networks array
    $social_array = array( 'soundcloud-rounded', 'pinterest-rounded', 'windows-rounded', 'addthis-rounded', 'sharethis-rounded', 'picasa-rounded', 'lastfm-rounded', 'technorati-rounded', 'mac-rounded', 'dribble-rounded', 'behance-rounded', 'facebook-rounded', 'google-rounded', 'skype-rounded', 'linkedin-rounded', 'deviantart-rounded', 'bing-rounded', 'twitter-rounded', 'myspace-rounded', 'flickr-rounded', 'tumblr-rounded', 'paypal-rounded', 'rss-rounded', 'stumbleupon-rounded', 'blogger-rounded', 'vimeo-rounded', 'wordpress-rounded', 'youtube-rounded', 'yahoo-rounded', 'aim-rounded', 'dribble', 'behance', 'facebook', 'google', 'skype', 'linkedin', 'deviantart', 'bing', 'twitter', 'myspace', 'flickr', 'tumblr', 'paypal', 'rss', 'stumbleupon', 'blogger', 'vimeo', 'wordpress', 'youtube', 'yahoo', 'aim' );

    $output = '';

    $output .= '<div class="team-member">';

    $output .= '<div class="team-overlay-container">';
    $team_image = wp_get_attachment_image_src( get_post_thumbnail_id( $member->ID ), 'full' );
    if ( $team_image ):
        $output .= '<img src="'.$team_image[0].'" class="team-member-image" alt="<?php echo '.$member->post_title.'" />';
    endif;
    $output .= '<div class="team-overlay">';
    $output .= '<h5 class="team-member-name">'.$member->post_title.'</h5>';
    $output .= '<h6 class="team-member-title">'.luxe_get_meta('team-member.member-title', '', $member->ID).'</h6>';
    $output .= '<div class="team-member-desc">'.$member->post_content.'</div>';
    $output .= '</div>';
    $output .= '</div>'; //end overlay container


    $output .= '<div class="socialbar">';
    $output .= '<ul class="social-icons team-social">';

    foreach ( $social_array as $social_media ) {

        if ( luxe_get_meta( 'team-member.' . $social_media, '', $member->ID ) ) {
            $url = '';
            if ( $social_media == 'email' ) { $url .= 'mailto:'; }
            $url .= luxe_get_meta( 'team-member.' .$social_media, '', $member->ID );
            $output .= '<li class="' . $social_media . '"><a class="socialico-'.$social_media.'" href="'.$url.'" target="_blank"></a></li>';
        }

    }

    $output .= '</ul>';
    $output .= '</div>';


    $output .= '</div>';
    endforeach;
    wp_reset_postdata();

    return do_shortcode( $output );

}

/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

// get slugs and titles for slide variable
$args = array(
  'post_type' => 'team',
  'post_status' => 'publish'
);

$team = get_posts($args);
$team_members = array();

foreach($team as $member) {
  $team_members[] = array(
      'value' => $member->post_name,
      'label' => $member->post_title,
  );
}

$content['Elements']['elements']['team_member'] =     array(
        'title'   => 'Team Member',
        'code'    => '[team_member]',
        'attributes' => array(
          array(
            'name'  => 'id',
            'type'  => 'select',
            'label' => __('Team Member', 'luxe_framework'),
            'items' => $team_members,
            'default' => ''
          ),
        )
      );

?>
