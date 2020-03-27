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
        $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
        $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
        $contentLocation = custom_header_content_get_meta('custom_header_content_location') ? custom_header_content_get_meta('custom_header_content_location') : 'content-center';
        ?>
        <section id="page-header" class="<?php echo $contentLocation; ?> <?php echo strtolower($bannerHeight) ?>" style="background-image:url(<?php echo $image; ?>);">
            <div class="container header-content">
                <?php
                $customTitle = html_entity_decode( custom_header_content_get_meta('custom_header_content_title') );
                $customHeaderCont = html_entity_decode( custom_header_content_get_meta('custom_header_content_content') );
                ?>
                <?php if( $customTitle && $customHeaderCont ): ?>
                    <h1 class="page-title"><?php echo $customTitle; ?></h1>
                    <p class="header-subline"><?php echo $customHeaderCont; ?></p>
                <?php elseif( $customTitle && !$customHeaderCont ): ?>
                    <h1 class="page-title"><?php echo $customTitle; ?></h1>
                <?php elseif( !$customTitle && $customHeaderCont ): ?>
                    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                    <p class="header-subline"><?php echo $customHeaderCont; ?></p>
                <?php else : ?>
                    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                <?php endif; ?>
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
        <main id="main" class="site-main" role="main">

            <!-- BreadCrumbs -->
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div id="breadcrumbs" class="col-md-12">', '</div>');
            }
            ?>

            <?php // get_template_part('template-parts/content', 'page'); ?>

            <!--  Start Left/Right Sections -->
            <section id="mission-values" class="">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-8" data-col="about1">
                            <div class="parallax center v-align" data-plx-img="/wp-content/uploads/2017/07/dab-oil.jpg" data-plx-o="vert">
                                <div class="v-inner"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4" data-col="about1">
                            <h3 class="section-title">Mission/Values</h3>
                            <h4>Mission</h4>
                            <p>Our mission is simple: we want you to find relief. And with CBD, we think that relief is possible; it has the power to potentially change people’s lives for the better each and every single day.</p>
                            <h4>Values</h4>
                            <p><strong>Compassion:</strong> People seek out CBD for a multitude of reasons. Whatever your reason is, trust our team to be compassionate. We care about you and your health.</p>
                            <p><strong>Education:</strong> There’s a stigma attached to cannabis use, but we hope to dispel any myths. We’re here for you to shed a light on all that is possible with CBD, and want you to feel you can reach out to us with any questions you have.</p>
                            <p><strong>Consistency:</strong> Trust C-Relief to consistently deliver high-quality products that have the potential to improve your mind and body.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="who-we-are" class="">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-4" data-col="about2">
                            <div class="parallax center v-align" data-plx-img="/wp-content/uploads/2017/07/dab-oil.jpg" data-plx-o="vert">
                                <div class="v-inner"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-8" data-col="about2">
                            <h3 class="section-title">Who We Are</h3>
                            <p>Here at C-Relief, we believe in the innate power of cannabidiol; not only have we experienced its powers firsthand, we’ve also seen how it’s completely transformed the lives of countless people for the better.</p>
                            <p>After taking CBD, people report lower stress levels, better sleep, relief from chronic pain, and much, much more. For these reasons, we truly believe it’s one of Mother Nature’s greatest gifts.</p>
                            <p>It is our hope that one day soon, CBD will be accessible and available to absolutely everyone, and become a staple in the homes of countless Canadians just like you.</p>
                            <p><a href="/products" data-button="arrow">Buy Now</a></p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="testimonial" class="">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-4" data-col="about3">
                            <h3 class="section-title">CBD Oils and Tinctures</h3>
                            <p>Tinctures are one of the purest applications of CBD; all you have to do is place a few drops on or under your tongue, let it sit for 60 seconds or so, and then swallow. Many feel tinctures, which are most often taken with breakfast and again at bedtime, are one of the easiest and quickest ways to take CBD.</p>
                            <p>Oils are just as easy – you can place it under your tongue, as well. If you don’t like the flavour, you could also put it in food.</p>
                            <p><a href="/products" data-button="arrow">Buy Now</a></p>
                        </div>
                        <div class="col-sm-6 col-md-8" data-col="about3">
                            <div class="parallax center v-align" data-plx-img="/wp-content/uploads/2017/07/dab-oil.jpg" data-plx-o="vert">
                                <div class="v-inner"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="container">
                    <div class="row"><?php echo do_shortcode('[slideset-products]'); ?></div>
                </div>
            </section>

            <section id="our-products" class="">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-4" data-col="about4">
                            <div class="parallax center v-align" data-plx-img="/wp-content/uploads/2017/07/dab-oil.jpg" data-plx-o="vert">
                                <div class="v-inner"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-8" data-col="about4">
                            <h3 class="section-title">Everything We Offer</h3>
                            <ul>
                                <li>Oils</li>
                                <li>Tinctures</li>
                                <li>Capsules</li>
                                <li>Edibles</li>
                                <li>…and, of course, relief!</li>
                            </ul>
                            <p><a href="/products" data-button="arrow">Buy Now</a></p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="get-in-touch" class="">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-4" data-col="about5">
                            <h3 class="section-title">Ready for Relief?</h3>
                            <h4>Get in Touch with Us</h4>
                            <p><strong>Company Name</strong><br>
                                123 Address Rd.<br>
                                City, Prov, P0S-C0D</p>
                            <ul class="contact blank">
                                <li><a href="#"><strong>Customer Service:</strong> 1 (800) 123-4567</a></li>
                                <li><a href="#"><strong>Alternate Phone:</strong> 1 (800) 123-4567</a></li>
                                <li><a href="#"><strong>Email:</strong> info@email.com</a></li>
                            </ul>
                            <ul class="social">
                                <li><a href="http://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="/feed" target="_blank"><i class="fas fa-rss"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-8" data-col="about5">
                            <div id="googlemap" class="panel">
                                <iframe style="border:none;min-height:400px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5854079.308264487!2d-76.526646!3d44.239245!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc40d607974d977f5!2sFerusMedia!5e0!3m2!1sen!2sca!4v1481120813627" width="500" height="500" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END Left/Right Sections -->

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
