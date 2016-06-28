<?php
$args = array(
    'sort_order' => 'ASC',
    'sort_column' => 'menu_order', 
    'hierarchical' => 1,
    'exclude' => '',
    'child_of' => get_the_ID(),
    'exclude_tree' => '',
    'number' => '',
    'offset' => 0,
    'post_type' => 'page',
    'post_status' => 'publish'
);
$pages = get_pages( $args );

// Loop through child pages
foreach ( $pages as $page ):
    $title = $page->post_title;
    $slug = $page->post_name;
    $page_id = $page->ID;
    $content = apply_filters( 'the_content', $page->post_content );
?>

    <div id="container-<?php echo $page_id; ?>" class="container" data-name="<?php echo $slug; ?>">

        <?php luxe_title($page_id); ?>

        <div class="wrap clearfix inner-content">

            <div class="twelvecol first clearfix main" role="main">

                <div id="post-<?php echo $page_id ?>" <?php post_class( 'clearfix' ); ?> role="article">

                    <div class="entry-content clearfix">
                        <?php echo $content; ?>
                    </div> <!-- end entry-content section -->

                </div> <!-- end post -->

            </div> <!-- end #main -->

        </div> <!-- end #inner-content -->

        <div id="container-<?php echo $page_id; ?>-background" class="container-background"></div>

    </div> <!-- end #container -->


<?php endforeach; ?>

<a href="#" id="scroll-top"></a>