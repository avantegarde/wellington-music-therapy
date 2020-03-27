<?php
/**
 * Template Name: About
 *
 * The default full-width template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

get_header(); ?>

<?php
$iHeight = header_height_get_meta( 'header_height_size' );
if($iHeight) {
    $bannerHeight = $iHeight;
} else {
    $bannerHeight = '';
}
?>
<?php if($bannerHeight != 'None'): ?>
    <?php
    $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'original' );
    $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
    $contentLocation = custom_header_content_get_meta('custom_header_content_location') ? custom_header_content_get_meta('custom_header_content_location') : 'content-center';
    ?>
    <div id="page-header" class="<?php echo $contentLocation; ?> <?php echo strtolower($bannerHeight) ?>">
        <div class="header-img parallax v-align" data-plx-img="<?php echo $image; ?>">
            <div class="header-content v-inner">
                <?php
                $customTitle = html_entity_decode( custom_header_content_get_meta('custom_header_content_title') );
                $customHeaderCont = html_entity_decode( custom_header_content_get_meta('custom_header_content_content') );
                ?>
                <?php if( $customTitle && $customHeaderCont ): ?>
                    <h1 class="page-title"><?php echo $customTitle; ?></h1>
                    <div class="header-subline"><?php echo $customHeaderCont; ?></div>
                <?php elseif( $customTitle && !$customHeaderCont ): ?>
                    <h1 class="page-title"><?php echo $customTitle; ?></h1>
                <?php elseif( !$customTitle && $customHeaderCont ): ?>
                    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                    <div class="header-subline"><?php echo $customHeaderCont; ?></div>
                <?php else : ?>
                    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

    <!-- Page Top Widgets -->
<?php if ( is_active_sidebar( 'page-top' ) ) : ?>
    <section id="page-top" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'page-top' ); ?>
    </section>
<?php endif; ?>

    <!-- Inner Top Widgets -->
<?php if ( is_active_sidebar( 'inner-top' ) ) : ?>
    <section id="inner-top" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'inner-top' ); ?>
    </section>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <!-- BreadCrumbs -->
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div id="breadcrumbs" class="col-md-12">', '</div>');
            }
            ?>

            <?php //get_template_part('template-parts/content', 'page'); ?>


<section id="vision" class="">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-push-6" data-col="vision-statement">
                <img src="/wp-content/themes/creative-core/inc/images/placeholder.jpg" width="800" height="500">
            </div>
            <div class="col-sm-6  col-sm-pull-6 v-align" data-col="vision-statement">
                <div class="v-inner">
                    <h3 class="mini-title">Vision Statement</h3>
                    <h4 class="block-left-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce blandit nibus lorem, non rhoncus sem feugiat eu. Maecenas interdum imperdiet lacus non maximus.</h4>
                    <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat. Excepteur sint occaecat cupidatat non proident, sunt in culpa. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about-us" class="">
    <div class="container">
        <div class="row">
            <div class="col-sm-6" data-col="about-us">
                <img src="/wp-content/themes/creative-core/inc/images/placeholder.jpg" width="800" height="500">
            </div>
            <div class="col-sm-6 v-align" data-col="about-us">
                <div class="v-inner">
                    <h3 class="mini-title">More Info</h3>
                    <h4 class="block-left-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce blandit nibus lorem, non rhoncus sem feugiat eu. Maecenas interdum imperdiet lacus non maximus.</h4>
                    <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat. Excepteur sint occaecat cupidatat non proident, sunt in culpa. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="" class="">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-push-6" data-col="balancing">
                <img src="/wp-content/themes/creative-core/inc/images/placeholder.jpg" width="800" height="500">
            </div>
            <div class="col-sm-6  col-sm-pull-6 v-align" data-col="balancing">
                <div class="v-inner">
                    <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce blandit nibus lorem, non rhoncus sem feugiat eu. Maecenas interdum imperdiet lacus non maximus.</h3>
                    <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat. Excepteur sint occaecat cupidatat non proident, sunt in culpa. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="faq" class="">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="section-title center">Service Related FAQs</h3>

                <div class="accordion">
                    <h3 data-accordion="title">FAQ Related to Service #1</h3>
                    <div data-accordion="content">
                        <p>Fugiat quo voluptas nulla pariatur? Excepteur sint occaecat cupidatat non proident, sunt in culpa. Ut enim ad minim veniam, quis nostrud exercitation ullamco. Facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                        <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                        <p>Itaque earum rerum hic tenetur a sapiente delectus. Fugiat quo voluptas nulla pariatur? Accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo. Eaque ipsa quae ab illo inventore veritatis et quasi.</p>
                    </div>

                    <h3 data-accordion="title">FAQ Related to Service #2</h3>
                    <div data-accordion="content">
                        <p>Fugiat quo voluptas nulla pariatur? Excepteur sint occaecat cupidatat non proident, sunt in culpa. Ut enim ad minim veniam, quis nostrud exercitation ullamco. Facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                        <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                        <p>Itaque earum rerum hic tenetur a sapiente delectus. Fugiat quo voluptas nulla pariatur? Accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo. Eaque ipsa quae ab illo inventore veritatis et quasi.</p>
                    </div>

                    <h3 data-accordion="title">FAQ Related to Service #3</h3>
                    <div data-accordion="content">
                        <p>Fugiat quo voluptas nulla pariatur? Excepteur sint occaecat cupidatat non proident, sunt in culpa. Ut enim ad minim veniam, quis nostrud exercitation ullamco. Facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                        <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                        <p>Itaque earum rerum hic tenetur a sapiente delectus. Fugiat quo voluptas nulla pariatur? Accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo. Eaque ipsa quae ab illo inventore veritatis et quasi.</p>
                    </div>

                    <h3 data-accordion="title">FAQ Related to Service #4</h3>
                    <div data-accordion="content">
                        <p>Fugiat quo voluptas nulla pariatur? Excepteur sint occaecat cupidatat non proident, sunt in culpa. Ut enim ad minim veniam, quis nostrud exercitation ullamco. Facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                        <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                        <p>Itaque earum rerum hic tenetur a sapiente delectus. Fugiat quo voluptas nulla pariatur? Accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo. Eaque ipsa quae ab illo inventore veritatis et quasi.</p>
                    </div>

                    <h3 data-accordion="title">FAQ Related to Service #5</h3>
                    <div data-accordion="content">
                        <p>Fugiat quo voluptas nulla pariatur? Excepteur sint occaecat cupidatat non proident, sunt in culpa. Ut enim ad minim veniam, quis nostrud exercitation ullamco. Facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                        <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                        <p>Itaque earum rerum hic tenetur a sapiente delectus. Fugiat quo voluptas nulla pariatur? Accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo. Eaque ipsa quae ab illo inventore veritatis et quasi.</p>
                    </div>

                </div><!-- .accordion -->
            </div>
            <div class="col-sm-6">
                <div class="have-question panel line">
                    <h3 class="section-title center">Have A Question?</h3>
                    [gravityform id="3" title="false" description="false" ajax="true" tabindex="99"]
                </div>
            </div>
        </div>
    </div>
</section>



            <?php // If comments are open or we have at least one comment, load up the comment template.
            /*if (comments_open() || get_comments_number()) :
                comments_template();
            endif;*/ ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php endwhile; // End of the loop. ?>

    <!-- Inner Bottom Widgets -->
<?php if ( is_active_sidebar( 'inner-bottom' ) ) : ?>
    <section id="inner-bottom" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'inner-bottom' ); ?>
    </section>
<?php endif; ?>

    <!-- Page Bottom Widgets -->
<?php if ( is_active_sidebar( 'page-bottom' ) ) : ?>
    <section id="page-bottom" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'page-bottom' ); ?>
    </section>
<?php endif; ?>

<?php
get_footer();
