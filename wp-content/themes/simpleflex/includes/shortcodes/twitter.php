<?php

/* ---------------------------------------------------------------------- */
/*	TWITTER TWEETS SHORTCODE
/* ---------------------------------------------------------------------- */

add_shortcode( 'twitter_tweets', 'luxe_twitter_tweets' );

function luxe_twitter_tweets($atts, $content = null) {

  //require_once( LUXE_INC_DIR . '/admin/plugins/twitteroauth/twitteroauth.php');
  
    extract(shortcode_atts(array(
    "access_token" => '',
    "access_token_secret" => '',
    "cons_key" => '',
    "cons_secret" => '',
    "twitter_username" => '',
    "color" => '',
    "limit" => '3',
    ), $atts));   


  $transName = 'list_tweets';
  $cacheTime = 10;
  if(false === ($twitterData = get_transient($transName) ) ){
       // require the twitter auth class
       require_once LUXE_INC_DIR . 'admin/plugins/twitteroauth/twitteroauth.php';

       $twitterConnection = new TwitterOAuth(
            $cons_key, // Consumer Key
            $cons_secret,     // Consumer secret
            $access_token,       // Access token
            $access_token_secret      // Access token secret
            );
       $twitterData = $twitterConnection->get(
              'statuses/user_timeline',
              array(
                'screen_name'     => $twitter_username,
                'count'           => $limit,
                'exclude_replies' => false
              )
            );
       if($twitterConnection->http_code != 200)
       {
            $twitterData = get_transient($transName);
       }
       // Save our new transient.
       set_transient($transName, $twitterData, 60 * $cacheTime);
  }
  $output = '<div class="twitter-carousel flexslider luxe-flexslider">';
  $output .= '<ul class="slides">';
  $x = 0;
  foreach( $twitterData as $item ):
    if($x < $limit):
      $output .= '<li>';
      $tweet_time = $item->created_at;
      $tweet_time = strtotime($tweet_time);
      $output .= '<img class="twitter-profile-image" src="'.$item->user->profile_image_url.'">';
      $output .= '<h4 class="luxe-tweet" style="color:'.$color.';">';
      $output .= '<span class="luxe-tweet-time"><a href="http://twitter.com/'.$item->user->screen_name.'/status/'.$item->id_str.'" target="_blank">' . human_time_diff( $tweet_time, current_time('timestamp')) . ' ' . __('ago', 'luxe_framework') .'</a></span>';
      $output .= $item->text;
      $output .= '</h4>';
      $output .= '</li>';
      $x++;
    endif;
  endforeach;
  $output .= '</ul>';
  $output .= '</div>';

  return $output;

}

/* ---------------------------------------------------------------------- */
/*  SHORTCODE GENERATOR ITEMS
/* ---------------------------------------------------------------------- */

$content['Elements']['elements']['tweets'] = array(
        'title'   => 'Tweets',
        'code'    => '[twitter_tweets]',
        'attributes' => array(
          array(
            'name'  => 'color',
            'type'  => 'color',
            'label' => __('Color', 'luxe_framework'),
          ),
          array(
            'name'  => 'twitter_username',
            'type'  => 'textbox',
            'label' => __('Twitter Username', 'luxe_framework'),
          ),
          array(
            'name'  => 'access_toekn',
            'type'  => 'textbox',
            'label' => __('Access Token', 'luxe_framework'),
          ),
          array(
            'name'  => 'access_token_secret',
            'type'  => 'textbox',
            'label' => __('Access Token Secret', 'luxe_framework'),
          ),
          array(
            'name'  => 'cons_key',
            'type'  => 'textbox',
            'label' => __('Consumer Key', 'luxe_framework'),
          ),
          array(
            'name'  => 'cons_secret',
            'type'  => 'textbox',
            'label' => __('Consumer Secret', 'luxe_framework'),
          ),
          array(
            'name'  => 'notes',
            'type'  => 'notebox',
            'label' => __('Setup', 'luxe_framework'),
            'description' => __('Visit <a href="https://dev.twitter.com/docs/auth/tokens-devtwittercom">https://dev.twitter.com/docs/auth/tokens-devtwittercom</a> to learn how to get your account keys.', 'luxe_framework'),
          ),
        )
      );


?>
