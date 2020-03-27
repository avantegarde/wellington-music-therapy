<?php
/**
 * Template Name: Contact
 *
 * The default page for contact page
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
        <section id="page-header" class="<?php echo strtolower($bannerHeight) ?>" style="background-image:url(<?php echo $image; ?>);">
            <div id="googlemap">
                <iframe style="border:none;min-height:400px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5854079.308264487!2d-76.526646!3d44.239245!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc40d607974d977f5!2sFerusMedia!5e0!3m2!1sen!2sca!4v1481120813627" width="500" height="500" frameborder="0" allowfullscreen></iframe>
            </div>
        </section>
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
        <main id="main" class="site-main container" role="main">

            <!-- BreadCrumbs -->
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div id="breadcrumbs" class="col-md-12">', '</div>');
            }
            ?>

            <!-- Contact Details -->
            <section id="contact-details">
                <div class="row">

                    <div class="col-md-8">
                        <h3 class="title-bar">Take the first step to improving your business. Contact us today.</h3>
                        <p>Anxious to know more about us? We hope so! (We think we’re pretty great…and we know you’ll feel the same way when you meet us.)</p>
                        <p>Give us a shout anytime by e-mail, phone, or with our handy online contact form. We’ll happily answer any questions you have within 24 hours or by our next available business day.</p>
                        <?php // echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true" tabindex="99"]'); ?>
                    </div>

                    <div class="col-md-4">
                        <div class="business-hours">
                            <h3>Monday - Friday 10am – 4pm</h3>
                            <ul>
                                <li><a href="tel:+18667679290"><i class="fas fa-phone-alt"></i> 1 (866) 767-9290</a></li>
                                <li><a href="mailto:info@ferusmedia.com"><i class="fas fa-envelope"></i> info@ferusmedia.com</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </section>

            <?php get_template_part('template-parts/content', 'page'); ?>

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
