<?php
/*
Author: ThemeLuxe
URL: htp://themeluxe.com
*/

define( 'LUXE_BASE_DIR', get_template_directory() . '/' );
define( 'LUXE_FRAMEWORK_DIR', get_template_directory() . '/framework/' );
define( 'LUXE_BASE_URL', get_template_directory_uri() . '/' );
define( 'LUXE_INC_DIR', get_template_directory() . '/includes/' );

/* ---------------------------------------------------------------------- */
/*	THEMELUXE CORE
/* ---------------------------------------------------------------------- */

require_once('framework/luxe-framework.php');         

/* ---------------------------------------------------------------------- */
/*	CUSTOM POST TYPES
/* ---------------------------------------------------------------------- */

require_once(LUXE_INC_DIR . '/admin/custom-post-types/portfolio.php');
require_once(LUXE_INC_DIR . '/admin/custom-post-types/team.php');
require_once(LUXE_INC_DIR . '/admin/custom-post-types/clients.php');
require_once(LUXE_INC_DIR . '/admin/custom-post-types/testimonials.php');

/* ---------------------------------------------------------------------- */
/*	SHORTCODES
/* ---------------------------------------------------------------------- */

require_once( LUXE_INC_DIR . '/shortcodes/shortcodes.php');
	
/* ---------------------------------------------------------------------- */
/*	META BOXES
/* ---------------------------------------------------------------------- */

require_once( LUXE_INC_DIR . '/admin/luxe-metaboxes.php');

/* ---------------------------------------------------------------------- */
/*	PLUGIN ACTIVATION
/* ---------------------------------------------------------------------- */

require_once LUXE_INC_DIR . '/admin/luxe-plugins.php';


/* ---------------------------------------------------------------------- */
/*	BASE SCRIPTS AND STYLES
/* ---------------------------------------------------------------------- */

// loading modernizr and jquery, and reply script
function luxe_scripts_and_styles() {
	if ( !is_admin() ) {

		// register scripts and styles
		wp_register_style( 'stylesheet', LUXE_BASE_URL . 'css/style.css', array(), '', 'all' );
		wp_register_style( 'ie-only', LUXE_BASE_URL . 'css/ie.css', array(), '' );

		wp_register_script( 'modernizr', LUXE_BASE_URL . 'js/modernizr.custom.min.js', array(), '2.5.3', false );
		wp_register_script( 'isotope', LUXE_BASE_URL . 'js/jquery.isotope.min.js', array( 'jquery' ), '', true );
		wp_register_script( 'scrollto', LUXE_BASE_URL . 'js/jquery.scrollTo-1.4.3.1-min.js', array( 'jquery' ), '', true );
		wp_register_script( 'prettyphoto', LUXE_BASE_URL . 'js/jquery.prettyPhoto.js', array( 'jquery' ), '', true );
		wp_register_script( 'js', LUXE_BASE_URL . 'js/scripts.js', array( 'jquery' ), '', true );
		wp_register_script( 'retina', LUXE_BASE_URL . 'js/retina.js', array( 'jquery' ), '', true );
		wp_register_script( 'easypiechart', LUXE_BASE_URL . 'js/jquery.easypiechart.min.js', array( 'jquery' ), '', true );
		wp_register_script( 'owlcarousel', LUXE_BASE_URL . 'js/owl.carousel.min.js', array( 'jquery' ), '', true );
		wp_register_script( 'flexslider', LUXE_BASE_URL . 'js/jquery.flexslider-min.js', array( 'jquery' ), '', true );


		// enqueue styles and scripts
		wp_enqueue_style( 'stylesheet' );
		wp_enqueue_style( 'ie-only' );

		wp_enqueue_script( 'scrollto' );
		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_script( 'isotope' );
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_script( 'owlcarousel' );
		wp_enqueue_script( 'flexslider' );
		wp_enqueue_script( 'retina' );
		wp_enqueue_script( 'easypiechart' );
		wp_enqueue_script( 'js' );
		wp_localize_script('js', 'ajax_var', array(
		    'url' => admin_url('admin-ajax.php'),
		    'nonce' => wp_create_nonce('ajax-nonce')
		));
		if ( is_singular() and comments_open() and ( get_option( 'thread_comments' ) == 1 ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}
}

// add custom font icons for shortcode generator
add_action( 'admin_enqueue_scripts', 'luxe_admin_font_icons' );
function luxe_admin_font_icons() {
	wp_register_style( 'customicons', LUXE_BASE_URL . 'css/font-icons.css', array(), '', 'all' );
	wp_enqueue_style( 'customicons' );
}

// adding the conditional wrapper around ie stylesheet
function luxe_ie_conditional( $tag, $handle ) {
	if ( 'ie-only' == $handle )
		$tag = '<!--[if IE]>' . "\n" . $tag . '<![endif]-->' . "\n";
	return $tag;
}

// add demo css php file into head if it exists
function luxe_demo_css() {
	$demo_file = get_template_directory() . '/css/demo.css';
	if ( file_exists( $demo_file ) ):
		echo "<link rel='stylesheet' id='demo-css'  href='".LUXE_BASE_URL . "/css/demo.css' type='text/css' media='all' />";
	endif;
}

/* ---------------------------------------------------------------------- */
/*	THEME SUPPORT
/* ---------------------------------------------------------------------- */

function luxe_thumb_sizes() {
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 270, 250, true ); // default Post Thumbnail dimensions 
		add_image_size( 'blog-full', 1170, 580, true); 
		add_image_size( 'portfolio2c', 950, 500, true );  
		add_image_size( 'portfolio3c', 640, 450, true );  
		add_image_size( 'portfolio4c', 480, 360, true );  
		add_image_size( 'portfolio5c', 380, 280, true );  
	}
}
add_action('after_setup_theme', 'luxe_thumb_sizes');

add_theme_support( 'post-formats', array(
	'video', 'gallery',
) );

/* ---------------------------------------------------------------------- */
/*	SIDEBARS
/* ---------------------------------------------------------------------- */

function luxe_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Sidebar',
    	'description' => 'The first (primary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h5 class="widgettitle">',
    	'after_title' => '</h5>',
    ));
}

add_action( 'widgets_init', 'luxe_register_sidebars' );


/* ---------------------------------------------------------------------- */
/*	COMMENTS
/* ---------------------------------------------------------------------- */
		
// Comment Layout
function luxe_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
			    <!-- custom gravatar call -->
			    <?php
			    	// create variable
			    	$bgauthemail = get_comment_author_email();
			    ?>
			    <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=70" class="load-gravatar avatar avatar-48 photo" height="70" width="70" src="<?php echo get_template_directory_uri(); ?>/images/nothing.gif" />
			    <?php printf(__('<cite class="fn h5">%s</cite>'), get_comment_author_link()) ?>
			</header>
            <footer class="comment-meta">			
                <time datetime="<?php echo comment_time('Y-m-j'); ?>"><?php comment_time('j.n.Y G:i'); ?></time>
                <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </footer>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="alert info">
          			<p><?php _e('Your comment is awaiting moderation.', 'luxe_framework') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
                <?php comment_text() ?>
                <?php edit_comment_link(__('(Edit)', 'luxe_framework'), '  ', '') ?>
			</section>

		</article>
    <!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/* ---------------------------------------------------------------------- */
/*	PAGE TITLE
/* ---------------------------------------------------------------------- */

function luxe_title($page_id) { 

	if ( is_home() || is_singular('post') ) {
		$page_id = get_option('page_for_posts');
	}

	if(luxe_get_meta('page-layout.page-title', '', $page_id) != '0'):

		if ( is_home() || is_singular('post') ) {
			$page_title = get_the_title( get_option('page_for_posts'));
		}
		elseif ( is_archive() ) {

			if (is_category()) {
				$page_title =  __( 'Posts Categorized:', 'luxe_framework' ) . ' ' .single_cat_title( '', false); 
			} elseif (is_tag()) {
				$page_title =  __( 'Posts Tagged:', 'luxe_framework' ) . ' ' . single_tag_title( '' , false); 
			} elseif (is_author()) {
				global $post;
				$author_id = $post->post_author;
				$page_title =  __( 'Posts By:', 'luxe_framework' ) . ' ' . get_the_author_meta('display_name', $author_id);
			} elseif (is_day()) { 
				$page_title =  __( 'Daily Archives:', 'luxe_framework' ) . ' ' . get_the_time('l, F j, Y'); 
			} elseif (is_month()) { 
				$page_title =  __( 'Monthly Archives:', 'luxe_framework' ) . ' ' . get_the_time('F Y'); 
			} elseif (is_year()) { 
				$page_title =  __( 'Yearly Archives:', 'luxe_framework' ) . ' ' . get_the_time('Y'); 
			} 

		}
		elseif ( is_search() ) {
			$page_title = __( 'Search Results for:', 'luxe_framework' ) . ' ' . esc_attr(get_search_query());
		}
	    else {
	    	$page_title = get_the_title( $page_id );
	    }

	    	$page_subtitle = luxe_get_meta('page-layout.page-subtitle', '', $page_id);

		?>
	    <header class="article-header page-header twelvecol first clearfix">

	        <div class="wrap clearfix">
	    		
	            <h1 class="page-title h2"><?php echo $page_title; ?></h1>

	            <?php if($page_subtitle): ?>
	            <p class="page-subtitle"><?php echo $page_subtitle; ?></p>
	        	<?php endif; ?>

	        </div>

	    </header> <!-- end article header -->

	<?php 
	endif;
}

/* ---------------------------------------------------------------------- */
/*	IMAGE ID FROM LINK
/* ---------------------------------------------------------------------- */

function luxe_get_attachment_id_from_src ($src) {
    global $wpdb;

    $reg = "/-[0-9]+x[0-9]+?.(jpg|jpeg|png|gif)$/i";

    $src1 = preg_replace($reg,'',$src);

    if($src1 != $src){
        $ext = pathinfo($src, PATHINFO_EXTENSION);
        $src = $src1 . '.' .$ext;
    }

    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$src'";
    $id = $wpdb->get_var($query);

    return $id;
}

/* ---------------------------------------------------------------------- */
/*	SOCIAL "SHARE" BUTTONS
/* ---------------------------------------------------------------------- */

function luxe_share_this() {
	wp_register_script( 'sharethis', '//w.sharethis.com/button/buttons.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'sharethis' );
}
add_action( 'wp_enqueue_scripts', 'luxe_share_this', 999 );
function luxe_share_this_script() {
	return '<script type="text/javascript">stLight.options({publisher: "ur-6a7e320d-37d8-511-633d-4264e3ae8c", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>';
}
add_action( 'wp_footer', 'luxe_share_this_script', 1000);


/* ---------------------------------------------------------------------- */
/*	AUTHOR CONTACT OPTIONS
/* ---------------------------------------------------------------------- */

function luxe_user_contactmethod( $contactmethods ) {

  // Add Twitter
  if ( !isset( $contactmethods['twitter'] ) )
    $contactmethods['twitter'] = 'Twitter';

  // Add Facebook
  if ( !isset( $contactmethods['facebook'] ) )
    $contactmethods['facebook'] = 'Facebook';

  // Add LinkedIn
  if ( !isset( $contactmethods['linkedin'] ) )
    $contactmethods['linkedin'] = 'LinkedIn';

  return $contactmethods;
}
add_filter( 'user_contactmethods', 'luxe_user_contactmethod', 10, 1 );

?>