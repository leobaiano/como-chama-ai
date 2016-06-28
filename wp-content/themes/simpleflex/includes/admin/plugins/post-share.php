<?php
/*
Name:  WordPress Post Share System
Description:  Share links for posts
*/

/**
 *  Return links based on post ID
 */

function luxe_post_share($post_id) {

	$permalink = get_permalink($post_id);
	$title = get_the_title($post_id);

	ob_start();
	?>
		<ul class="luxe-post-share">
	        <a href="http://www.facebook.com/sharer.php?u=<?php echo $permalink; ?>&t=<?php echo $title; ?>" target="blank" title="Facebook" class="socialico-facebook"></a>
	        <a href="http://twitter.com/share?url=<?php echo $permalink; ?>&text=<?php echo $title; ?>" target="blank" title="Twitter" class="socialico-twitter"></a>
	        <a href="https://plus.google.com/share?url=<?php echo $permalink; ?>" target="blank" title="GooglePlus" class="socialico-google"></a>
	    </ul>
	<?php
	$output = ob_get_clean();
	
	return $output;
}
