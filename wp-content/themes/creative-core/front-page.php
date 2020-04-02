<?php
/**
 * The Homepage of the site
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ferus_core
 */



get_header(); ?>

<div id="primary" class="content-area page-body">
    <main id="main" class="site-main" role="main">

        <section id="home-slider" class="blank">
            <div class="home_slider">
            <div class="" style="background-image:url('/wp-content/themes/creative-core/inc/images/home-slide-01.jpg');">
                    <div class="slide-caption right line-box">
                        <h3 class="section-title">Home Page Slide #1 Title<br>Goes Here.</h3>
                        <p class="subline">Nihil molestiae consequatur, vel illum qui dolorem eum. Qui officia deserunt mollit?</p>
                        <a href="#" data-button="arrow">Learn More</a>
                    </div>
                </div>
                <div class="" style="background-image:url('/wp-content/themes/creative-core/inc/images/home-slide-02.jpg');">
                    <div class="slide-caption line-box">
                        <h3 class="section-title">Home Page Slide #2 Title<br>Goes Here.</h3>
                        <p class="subline">Nihil molestiae consequatur, vel illum qui dolorem eum. Qui officia deserunt mollit?</p>
                        <a href="#" data-button="arrow">Learn More</a>
                    </div>
                </div>
                <div class="" style="background-image:url('/wp-content/themes/creative-core/inc/images/home-slide-03.jpg');">
                    <div class="slide-caption center line-box">
                        <h3 class="section-title">Home Page Slide #3 Title<br>Goes Here.</h3>
                        <p class="subline">Nihil molestiae consequatur, vel illum qui dolorem eum. Qui officia deserunt mollit?</p>
                        <a href="#" data-button="arrow">Learn More</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="home-services" class="green services">
            <div class="container">
                <h3 class="section-title block-title center" data-color="white">Our Services</h3>
                <div class="row services-flex">
                    <div class="col-sm-6 col-md-4">
                        <div class="panel center">
                            <span class="icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <h3 class="title">Individual Music Therapy</h3>
                            <p>Together we will set goals and objectives for our sessions. Music will be used as the catalyst to promote growth and reach these goals.</p>
                            <p class="bottom"><a href="/about/" data-button>Learn More</a></p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="panel center">
                            <span class="icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <h3 class="title">Adapted Music Lessons</h3>
                            <p>Modifications are made to music lessons to create a learning environment suitable to the student's needs and learning pace.</p>
                            <p class="bottom"><a href="/about/" data-button>Learn More</a></p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="panel center">
                            <span class="icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <h3 class="title">Sing it Girls</h3>
                            <p>We are the Guelph & Area providers of the unique and exciting Sing it girls Vocal program for girls aged 7-12.</p>
                            <p class="bottom"><a href="/about/" data-button>Learn More</a></p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="panel center">
                            <span class="icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <h3 class="title">Long Term Care & Retirement</h3>
                            <p>Participants can experience the benefits of social interaction and brain stimulation while in a group setting, listening to a variety of music.</p>
                            <p class="bottom"><a href="/about/" data-button>Learn More</a></p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="panel center">
                            <span class="icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <h3 class="title">TiTi Tots</h3>
                            <p>Music is proven to improve cognitive development and creativity. Jump start your tot's love of music with these fun, lively group sessions.</p>
                            <p class="bottom"><a href="/about/" data-button>Learn More</a></p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="panel center">
                            <span class="icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <h3 class="title">Community Music Programs</h3>
                            <p>Through group participation, we strive to create  musical collaboration that include singing, songwriting and performances.</p>
                            <p class="bottom"><a href="/about/" data-button>Learn More</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="home-services" class="blank">
            <div class="parallax auto-height" data-plx-img="/wp-content/themes/creative-core/inc/images/hero.jpg">
                <div class="container">
                    <div class="col-md-8 col-md-offset-2 line-box center" data-col="hp-bottom-cta">
                        <h2 class="section-title" data-color="white">Architecto beatae vitae dicta</h2>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Eaque ipsa quae ab illo inventore veritatis et quasi. Architecto beatae vitae dicta sunt explicabo. Cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia quia voluptas sit.</p>
                        <p><a href="/about/" data-button>Learn More</a></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- <section id="home-services" class="blank">
            <div class="parallax auto-height" data-plx-img="/wp-content/themes/creative-core/inc/images/hero.jpg">
                <div class="container">
                    <div class="col-md-7 line-box" data-col="hp-bottom-cta">
                        <h3 class="machine-title" data-color="white">Does your <span>machine</span> need <strong>servicing?</strong></h3>
                        <p>The investment that you make in a sewing machine is as important to you as it is us at Stitch by Stitch.</p>  
                        <p>We want you to always get the best performance you can from your machine.  To ensure that it continually works to your satisfaction, you will find that cleaning it on a regular basis will help to keep your machine running smoothly!</p>
                        <p class="txt-right"><a href="/services/" data-button>Let Us Help</a></p>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- <section id="home-services" class="blank">
            <div class="parallax auto-height" data-plx-img="/wp-content/themes/creative-core/inc/images/hero.jpg">
                <div class="container">
                    <div class="col-md-7 line-box float-right" data-col="hp-bottom-cta">

                        <h2 class="section-title" data-color="white">Wanting to learn?</h2>
                        <p>We are committed to helping our clients create beautiful pieces of work and this in turn helped us grow our store and reputation in Kingston. Our staff has experience in quilting, sewing and machine embroidery and a few of our staff members are class teachers.</p>
						<p>Our goal is to provide you with the inspiration, encouragement and assistance you may need to get your project started. If you are interested in a class we are happy to describe our courses and assist you in choosing a class that you would enjoy and meets your goals.
						</p>
                        <a href="/category/classes/" data-button>Get Started!</a>
                    </div>
                </div>
            </div>
        </section> -->

        <?php // while (have_posts()) : the_post(); ?>
            <?php // echo the_content(); ?>
        <?php // endwhile; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<!-- Start Modal -->
<div id="news-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h3 class="section-title">Join Our Mailing List</h3>
                <p>Sign up for our SPECIALS, PROMOTIONS and UPDATES.</p>
                <?php echo do_shortcode('[gravityform id="3" title="false" description="false" ajax="true" tabindex="9999"]'); ?>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>
<!-- END Modal -->

<?php get_footer(); ?>
