<?php
/* =============================================================================
   TEMPLATE: Frontpage
   ========================================================================== */

global $body_attributes;
$body_attributes = 'data-spy="scroll" data-target=".navbar-main" data-offset="200"';

get_header();

the_post();
$post_id = get_the_id();

$teasers = get_posts(array(
    'posts_per_page'   => -1,
    'offset'           => 0,
    'orderby'          => 'menu_order',
    'order'            => 'ASC',
    'post_type'        => 'teaser',
    'post_status'      => 'publish',
    'suppress_filters' => true
));

if( $teasers && count($teasers)>0 ) {
    $indicators = array();
    $contents = array();
    foreach( $teasers as $i => $post ) {
        $parallax_img = get_mpt_src('parallax','fullscreen',$post);
        array_push($indicators, '<li data-target="#aktuelles" data-slide-to="'.$i.'"'.($i==0?' class="active"':'').'></li>');
        array_push($contents, '<div class="item'.($i==0?' active':'').'"><div class="item-inner">'.
            '<div class="carousel-background parallax" style="background-image:url(\''.$parallax_img[0].'\')"></div>'.
            '<div class="carousel-caption">'.apply_filters('the_content', $post->post_content).'</div>'.
            '</div></div>');
    }
    ?>
    <div data-ops="<?php echo esc_attr(get_permalink($post_id)); ?>" id="aktuelles" class="carousel slide" data-pause="false" data-ride="carousel">
        <?php if(count($teasers)>1) { ?>
            <ol class="carousel-indicators"><?php echo implode('',$indicators); ?></ol>
        <? } ?>
        <div class="carousel-inner"><?php echo implode('',$contents); ?></div>
        <?php if(count($teasers)>1) { ?>
            <a class="left carousel-control" href="#aktuelles" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="#aktuelles" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        <? } ?>
    </div>
    <?php
}

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
