<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ferus_Core
 */
$header_layout = get_theme_mod( 'theme_header_layout' )?get_theme_mod( 'theme_header_layout' ):'default';
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <!-- <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico"/> -->

    <?php wp_head(); ?>

    <?php if ( has_nav_menu('mobile-menu') ) : ?>
        <!-- Mobile Menu Styles -->
        <?php if ($header_layout == 'center') : ?>
            <style>
                header nav.navbar-default #mobile-menu {
                    display: none !important;
                }
                header .header-inner #mobile-logo {
                    display: none !important;
                }
                @media screen and (max-width:991px) {
                    header .header-inner #mobile-logo {
                        display: block !important;
                    }
                    header .header-inner #logo {
                        display: none !important;
                    }
                    header nav.navbar-default #mobile-menu {
                        display: block !important;
                    }
                    header nav.navbar-default #primary-left,
                    header nav.navbar-default #primary-right {
                        display: none !important;
                    }
                }
            </style>
        <?php else : ?>
            <style>
                header nav.navbar-default #mobile-menu {
                    display: none !important;
                }
                @media screen and (max-width:767px) {
                    header nav.navbar-default #mobile-menu {
                        display: block !important;
                    }

                    header nav.navbar-default #primary {
                        display: none !important;
                    }
                }
            </style>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Google Analytics -->
    <!-- <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','__gaTracker');

        __gaTracker('create', 'UA-xxxxxxxx-x', 'auto');
        __gaTracker('send', 'pageview');
    </script> -->
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'ferus_core'); ?></a>

<?php // START: Header Layout - Logo Center
if ($header_layout == 'center') : ?>

    <header id="masthead" class="site-header" role="banner">

        <aside id="toolbar" class="widget-area" role="complementary">
            <div class="container-fluid">
                <?php if ( is_active_sidebar( 'toolbar' ) ) : ?>
                    <?php dynamic_sidebar( 'toolbar' ); ?>
                <?php endif; ?>
                <?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
                    <div class="header-cart-wrap">
                        <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
                            <?php echo WC()->cart->get_cart_total(); ?> - <?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
                        </a>
                        <div class="cart-dropdown">
                            <?php if ( is_active_sidebar( 'header-cart-dropdown' ) ) : ?>
                                <?php dynamic_sidebar( 'header-cart-dropdown' ); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </aside>

        <div class="header-inner">
            <div id="mobile-logo" class="container">
                <h1 class="mobile-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <img src="<?php echo get_template_directory_uri() . '/inc/images/logo.png'; ?>" width="200"><span><?php bloginfo('name'); ?></span>
                    </a>
                </h1>
            </div>
            <div class="menu-wrap">
                <div class="container-fluid">
                    <div class="main-navigation">
                        <nav class="navbar navbar-default">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <div class="collapse navbar-collapse" id="navbar-main">
                                <?php
                                // Main Menu LEFT
                                $defaults_left = array(
                                    'theme_location' => 'menu-left',
                                    'container' => false,
                                    'menu_class' => 'primary nav navbar-nav nav-left',
                                    'menu_id' => 'primary-left'
                                );
                                wp_nav_menu($defaults_left); ?>

                                <h1 id="logo">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <img src="<?php echo get_template_directory_uri() . '/inc/images/logo.png'; ?>" width="200"><span><?php bloginfo('name'); ?></span>
                                    </a>
                                </h1>

                                <?php
                                // Main Menu RIGHT
                                $defaults_right = array(
                                    'theme_location' => 'menu-right',
                                    'container' => false,
                                    'menu_class' => 'primary nav navbar-nav nav-right',
                                    'menu_id' => 'primary-right'
                                );
                                wp_nav_menu($defaults_right);
                                // Mobile Menu
                                $mobileArgs = array(
                                    'theme_location' => 'mobile-menu',
                                    'container' => false,
                                    'menu_class' => 'primary nav navbar-nav',
                                    'menu_id' => 'mobile-menu',
                                    'fallback_cb' => false
                                );
                                wp_nav_menu($mobileArgs);
                                ?>

                            </div>
                        </nav>
                    </div><!-- .main-navigation -->
                </div><!-- .container -->
            </div><!-- .menu-wrap -->
            <!-- <div class="header-search">
                <form role="search" method="get" class="search" action="<?php echo esc_url(home_url('/')); ?>">
                    <label for="search_text"><i class="fas fa-search"></i></label>
                    <input type="text" class="search-text" id="search_text" placeholder="Site Search" value="" name="s" title="Search...">
                </form>
            </div> -->

        </div><!-- .header-inner -->
    </header><!-- #masthead -->

<?php // START: Header Layout - Menu Bar
elseif ($header_layout == 'bar') : ?>

    <header id="masthead" class="site-header" role="banner">
        <div class="container">
            <div class="header-inner">
                <h1 id="logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <img src="<?php echo get_template_directory_uri() . '/inc/images/logo.png'; ?>" width="250"><span><?php bloginfo('name'); ?></span>
                    </a>
                </h1>
                <!-- Toolbar -->
                <aside id="toolbar" class="widget-area" role="complementary">
                    <?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
                        <div class="toolbar-menu-wrap">
                            <div class="header-cart-wrap">
                                <i class="fas fa-shopping-cart header-cart-icon" aria-hidden="true"></i>
                                <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
                                    <?php echo WC()->cart->get_cart_total(); ?> - <?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
                                </a>
                                <div class="cart-dropdown">
                                    <?php if ( is_active_sidebar( 'header-cart-dropdown' ) ) : ?>
                                        <?php dynamic_sidebar( 'header-cart-dropdown' ); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="alt-items">
                                <span class="header-menu-divider">|</span>
                                <a href="/my-account/" class="my-account-button">My Account</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ( is_active_sidebar( 'toolbar' ) ) : ?>
                        <?php dynamic_sidebar( 'toolbar' ); ?>
                    <?php endif; ?>
                </aside>
            </div>
        </div>
        <div class="menu-wrap">
            <div class="container">
                <div class="main-navigation">
                    <nav class="navbar navbar-default">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="navbar-main">
                            <?php
                            // Main Menu
                            $defaults = array(
                                'theme_location' => 'menu-1',
                                'container' => false,
                                'menu_class' => 'primary nav navbar-nav',
                                'menu_id' => 'primary'
                            );
                            wp_nav_menu($defaults);
                            // Mobile Menu
                            $mobileArgs = array(
                                'theme_location' => 'mobile-menu',
                                'container' => false,
                                'menu_class' => 'primary nav navbar-nav',
                                'menu_id' => 'mobile-menu',
                                'fallback_cb' => false
                            );
                            wp_nav_menu($mobileArgs);
                            ?>

                        </div>
                    </nav>
                </div><!-- .main-navigation -->
                <div class="header-search">
                    <form role="search" method="get" class="search" action="<?php echo esc_url(home_url('/')); ?>">
                        <label for="search_text"><i class="fas fa-search"></i></label>
                        <input type="text" class="search-text" id="search_text" placeholder="Site Search" value="" name="s" title="Search...">
                    </form>
                </div><!-- .header-search -->
            </div>
        </div><!-- .menu-wrap -->
    </header><!-- #masthead -->

<?php // START: Header Layout - Default (Logo Left)
else : ?>

    <header id="masthead" class="site-header" role="banner">
        <div class="header-inner">
            <div class="container">
                <h1 id="logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <img src="<?php echo get_template_directory_uri() . '/inc/images/logo.png'; ?>" width="200"><span><?php bloginfo('name'); ?></span>
                    </a>
                </h1>
                <!-- Toolbar -->
                <aside id="toolbar" class="widget-area" role="complementary">
                    <?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
                        <div class="toolbar-menu-wrap">
                            <div class="header-cart-wrap">
                                <i class="fas fa-shopping-cart header-cart-icon" aria-hidden="true"></i>
                                <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
                                    <?php echo WC()->cart->get_cart_total(); ?> - <?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
                                </a>
                                <div class="cart-dropdown">
                                    <?php if ( is_active_sidebar( 'header-cart-dropdown' ) ) : ?>
                                        <?php dynamic_sidebar( 'header-cart-dropdown' ); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="alt-items">
                                <a href="/my-account/" class="my-account-button">My Account</a>
                                <span class="header-menu-divider">|</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ( is_active_sidebar( 'toolbar' ) ) : ?>
                        <?php dynamic_sidebar( 'toolbar' ); ?>
                    <?php endif; ?>
                </aside>
                <div class="menu-wrap">
                    <div class="main-navigation">
                        <nav class="navbar navbar-default">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="navbar-main">
                                <?php
                                // Main Menu
                                $defaults = array(
                                    'theme_location' => 'menu-1',
                                    'container' => false,
                                    'menu_class' => 'primary nav navbar-nav',
                                    'menu_id' => 'primary'
                                );
                                wp_nav_menu($defaults);
                                // Mobile Menu
                                $mobileArgs = array(
                                    'theme_location' => 'mobile-menu',
                                    'container' => false,
                                    'menu_class' => 'primary nav navbar-nav',
                                    'menu_id' => 'mobile-menu',
                                    'fallback_cb' => false
                                );
                                wp_nav_menu($mobileArgs);
                                ?>

                            </div>
                        </nav>
                    </div><!-- .main-navigation -->
                </div><!-- .menu-wrap -->
                <!-- <div class="header-search">
                    <form role="search" method="get" class="search" action="<?php // echo esc_url(home_url('/')); ?>">
                        <label for="search_text"><i class="fas fa-search"></i></label>
                        <input type="text" class="search-text" id="search_text" placeholder="Site Search" value="" name="s" title="Search...">
                    </form>
                </div> -->
            </div><!-- .container -->
        </div><!-- .header-inner -->
    </header><!-- #masthead -->

<?php endif; // END: Header Layout ?>

    <div id="content" class="site-content">
