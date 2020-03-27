<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ferus_Core
 */

?>

</div><!-- #content -->

<!-- Banner Bottom Widgets -->
<?php if ( is_active_sidebar( 'banner-bottom' ) ) : ?>
    <?php dynamic_sidebar( 'banner-bottom' ); ?>
<?php endif; ?>

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container">
        <div class="row">
            <!-- Footer Widgets -->
            <?php if ( is_active_sidebar( 'footer' ) ) : ?>
                <?php dynamic_sidebar( 'footer' ); ?>
            <?php endif; ?>
            <div class="col-md-12">
                <p class="copyright"><span class="company"><?php echo '&copy; Copyright ' . get_bloginfo( 'name' ) . ' ' . date('Y'); ?> </span></p>
                <?php
                // Footer Menu
                $footerMenu = array(
                    'theme_location' => 'footer-menu',
                    'container' => false,
                    'menu_class' => 'footer-nav',
                    'menu_id' => 'footer-nav',
                    'depth' => 1,
                    'fallback_cb' => false,
                );
                wp_nav_menu($footerMenu);
                ?>
            </div>
        </div>
    </div><!-- .inner -->
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri() . '/js/EQCSS-polyfills.min.js'?>"></script><![endif]-->
</body>
</html>
