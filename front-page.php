<?php
/* =============================================================================
   TEMPLATE: Frontpage
   ========================================================================== */

global $body_attributes;
$body_attributes = 'data-spy="scroll" data-target=".navbar-main" data-offset="200"';

get_header();

the_post();
$post_id = get_the_id();
$parallax_img = get_mpt_src('parallax');

?>
<div class="loading-wrapper">
    <div data-ops="<?php echo esc_attr(get_permalink()); ?>" class="bg-image parallax fullscreen" style="background-image:url('<?php echo $parallax_img[0]; ?>');">
        <div class="inner">
            <div class="container">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<?php

get_template_part( 'snippet', 'topbar' );

$childposts = new WP_Query(array(
    'post_type'      => 'page',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'post_parent'    => $post_id,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
));
if( $childposts->have_posts() ) {
    while( $childposts->have_posts() ) {
        $childposts->the_post();
        global $post;
        $parallax_img = get_mpt_src('parallax');

        if( $parallax_img ) {
            ?>
            <div class="bg-image parallax" style="background-image:url('<?php echo $parallax_img[0]; ?>');"></div>
            <?php
        }
        ?>
        <div class="container">
            <article data-ops="<?php echo esc_attr( $post->post_name=='blog' ? get_home_url(null,'/blog/') : ( $post->post_name=='spektrum' ? '/spektrum/' : get_permalink() ) ); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h2 class="entry-title">
                        <?php if($post->post_name=='blog') { ?>
                            <a href="/blog/"><span class="glyphicon glyphicon-chevron-right"></span><?php the_title(); ?></a>
                        <?php } else { ?>
                            <?php the_title(); ?>
                        <?php } ?>
                    </h2>
                </header>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        </div>
        <?php

    }
}
wp_reset_query();

get_template_part( 'snippet', 'footer' );

get_footer();

?>
