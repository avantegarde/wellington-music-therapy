<?php
/******************************************************************************/
/* Enqueue Styles and Scripts */
/******************************************************************************/
function ferus_core_enqueue_custom_scripts() {
    $asset_lightbox = get_theme_mod( 'theme_asset_lightbox' );
    $asset_masonry = get_theme_mod( 'theme_asset_masonry' );
    /*===========*/
    /*--- CSS ---*/
    /*===========*/
    wp_enqueue_style('open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i');
    wp_enqueue_style('roboto-slab', 'https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700');
    //wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('fc-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('fc-slick', get_template_directory_uri() . '/css/slick.css');
    if ( $asset_lightbox == 1 ) {
        wp_enqueue_style('fc-lightbox', get_template_directory_uri() . '/css/featherlight.min.css');
    }
    wp_enqueue_style('fc-default-style', get_template_directory_uri() . '/css/ferus-core.css');
    wp_enqueue_style('fc-animate', get_template_directory_uri() . '/css/animate.min.css');
    /*==========*/
    /*--- JS ---*/
    /*==========*/
    wp_enqueue_script('cc-fontawesome', 'https://kit.fontawesome.com/400d5ec791.js', array(), 1.0, false);
    wp_enqueue_script('fc-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), 1.0, true);
    wp_enqueue_script('fc-slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), 1.0, true);
    if ( $asset_lightbox == 1 ) {
        wp_enqueue_script('fc-lightbox', get_template_directory_uri() . '/js/featherlight.min.js', array('jquery'), 1.0, true);
    }
    if ( $asset_masonry == 1 ) {
        wp_enqueue_script('fc-masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array('jquery'), 1.0, true);
    }
    wp_enqueue_script('fc-eqcss', get_template_directory_uri() . '/js/EQCSS.min.js', array(), 1.0, true);
    wp_enqueue_script('fc-default-script', get_template_directory_uri() . '/js/ferus-core.js', array('jquery'), 1.0, true);

    /*=============================*/
    /* START: Header Layout Styles */
    $header_layout = get_theme_mod( 'theme_header_layout' )?get_theme_mod( 'theme_header_layout' ):'default';
    if ( $header_layout == 'center' ) {
        wp_enqueue_style( 'header-center', get_template_directory_uri() . '/css/header-center.css' );
    } elseif ( $header_layout == 'bar' ) {
        wp_enqueue_style( 'header-bar', get_template_directory_uri() . '/css/header-left-bar.css' );
    } else {
        wp_enqueue_style( 'header-default', get_template_directory_uri() . '/css/header-default.css' );
    }
    /* END: Header Layout Styles */
    /*=============================*/
    
    /*====================*/
    /* WooCommerce Styles */
    if ( class_exists( 'woocommerce' ) ) {
        wp_enqueue_style('fc-wc-style', get_template_directory_uri() . '/css/wc-styles.css');
    }
    /*====================*/

    /*============*/
    /* Custom CSS */
    wp_enqueue_style('fc-custom-style', get_template_directory_uri() . '/css/custom.css');
    /*============*/

}

add_action('wp_enqueue_scripts', 'ferus_core_enqueue_custom_scripts');

/**
 * Woocommerce Gallery support
 */
function ferus_core_wc_setup() {
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
if ( class_exists( 'woocommerce' ) ) {
    add_action( 'after_setup_theme', 'ferus_core_wc_setup' );
}

/* Admin Styles and Scripts */
function ferus_core_enqueue_custom_admin_scripts() {
    wp_enqueue_style('ferus_core-custom-admin-style', get_template_directory_uri() . '/css/ferus-core-admin.css');
}

add_action('admin_enqueue_scripts', 'ferus_core_enqueue_custom_admin_scripts');

/**
 * Register Custom Image Sizes
 */
add_image_size('slider-thumb', 200, 100, array('center', 'center')); // Hard crop center

// Remove auto p from content (needed for proper html content in pages)
//remove_filter( 'the_content', 'wpautop' );
//remove_filter( 'the_excerpt', 'wpautop' );
function remove_wpautop_on_pages() {
    if ( is_page() ) {
        remove_filter( 'the_content', 'wpautop' );
        remove_filter( 'the_excerpt', 'wpautop' );
    }
}
add_action( 'wp_head', 'remove_wpautop_on_pages' );

/*
 * Register Menu Locations
 */
register_nav_menus( array(
    'menu-left' => 'Menu Left (center logo only)',
    'menu-right' => 'Menu Right (center logo only)',
    'mobile-menu' => 'Mobile Menu',
    'footer-menu' => 'Footer'
) );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ferus_core_sidebar_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar Left', 'ferus_core' ),
        'id'            => 'sidebar-2',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Toolbar', 'ferus_core' ),
        'id'            => 'toolbar',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Header Cart Dropdown', 'ferus_core' ),
        'id'            => 'header-cart-dropdown',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Page Header', 'ferus_core' ),
        'id'            => 'page-header',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Shop Archive Top', 'ferus_core' ),
        'id'            => 'shop-archive-top',
        'before_widget' => '<div id="%1$s" class="%2$s widget '. ferus_core_widget_count('shop-archive-top') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Page Top', 'ferus_core' ),
        'id'            => 'page-top',
        'before_widget' => '<div id="%1$s" class="%2$s '. ferus_core_widget_count('page-top') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Page Inner-Top', 'ferus_core' ),
        'id'            => 'inner-top',
        'before_widget' => '<div id="%1$s" class="%2$s '. ferus_core_widget_count('inner-top') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Page Inner-Bottom', 'ferus_core' ),
        'id'            => 'inner-bottom',
        'before_widget' => '<div id="%1$s" class="%2$s '. ferus_core_widget_count('inner-bottom') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Page Bottom', 'ferus_core' ),
        'id'            => 'page-bottom',
        'before_widget' => '<div id="%1$s" class="%2$s '. ferus_core_widget_count('page-bottom') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Banner Bottom', 'ferus_core' ),
        'id'            => 'banner-bottom',
        'before_widget' => '<div id="%1$s" class="%2$s '. ferus_core_widget_count('banner-bottom') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer', 'ferus_core' ),
        'id'            => 'footer',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( '404 Content', 'ferus_core' ),
        'id'            => 'four-oh-four',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
}

add_action('widgets_init', 'ferus_core_sidebar_init');

/**
 * Remove wpautop from widgets
 */
add_filter( 'widget_display_callback', 'widget_wpautop_widget_display_callback', 10, 3 );
function widget_wpautop_widget_display_callback( $instance, $widget, $args ) {
    $instance['filter'] = false;
    return $instance;
}

/**
 * Remove “Category:”, “Tag:”, “Author:”, “Archives:” and “Other taxonomy name:” in the archive title
 */
function my_theme_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }

    return $title;
}

add_filter( 'get_the_archive_title', 'my_theme_archive_title' );

/**
 * Add Custom Query Variabls
 * @param $vars
 * @return array
 */
function add_query_vars_filter( $vars ){
    $vars[] = "filter_brand";
    $vars[] .= "min_price";
    $vars[] .= "max_price";
    return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

/**
 * Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
 */
function ferus_core_widget_count( $sidebar_id ) {
    // If loading from front page, consult $_wp_sidebars_widgets rather than options
    // to see if wp_convert_widget_settings() has made manipulations in memory.
    global $_wp_sidebars_widgets;
    if ( empty( $_wp_sidebars_widgets ) ) :
        $_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
    endif;

    $sidebars_widgets_count = $_wp_sidebars_widgets;

    if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
        $widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
        $widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );
        if ( $widget_count % 4 == 0 || $widget_count > 6 ) :
            // Four widgets per row if there are exactly four or more than six
            $widget_classes .= ' widget-col-4';
        elseif ( $widget_count >= 3 ) :
            // Three widgets per row if there's three or more widgets
            $widget_classes .= ' widget-col-3';
        elseif ( 2 == $widget_count ) :
            // Otherwise show two widgets per row
            $widget_classes .= ' widget-col-2';
        endif;

        return $widget_classes;
    endif;
}

/**
 * Enable Shortcodes in Widgets
 */
add_filter('widget_text', 'do_shortcode');

/**
 * Return the widget title only if the first character is not "!"
 */
add_filter('widget_title', 'remove_widget_title');
function remove_widget_title($widget_title) {
    if (substr($widget_title, 0, 1) == '!')
        return;
    else
        return ($widget_title);
}

/**
 * Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php).
 * Used in conjunction with https://gist.github.com/DanielSantoro/1d0dc206e242239624eb71b2636ab148
 * Compatible with 3.0.1+, for lower versions, remove "woocommerce_" from the first mention on Line 4
 */
if ( class_exists( 'woocommerce' ) ) {
    add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
}
function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;

    ob_start();

    ?>
    <a class="cart-customlocation" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo $woocommerce->cart->get_cart_total(); ?> - <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></a>
    <?php

    $fragments['a.cart-customlocation'] = ob_get_clean();

    return $fragments;

}

/**
 * Woocommerce remove breadcrumbs
 */
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

/**
 * Declare WC support
 */
function ferus_core_wc_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'ferus_core_wc_support' );


/**
 * Truncate Titles
 */
function FeaturedTitle($text) {
    $chars_limit = 100;
    $chars_text = strlen($text);
    $text = $text . " ";
    $text = substr($text, 0, $chars_limit);
    $text = substr($text, 0, strrpos($text, ' '));

    if ($chars_text > $chars_limit) {
        $text = $text . "...";
    }
    return $text;
}

/**
 * Truncates text.
 *
 * Cuts a string to the length of $length and replaces the last characters
 * with the ending if the text is longer than length.
 *
 * @param string  $text String to truncate.
 * @param integer $length Length of returned string, including ellipsis.
 * @param string  $ending Ending to be appended to the trimmed string.
 * @param boolean $exact If false, $text will not be cut mid-word
 * @param boolean $considerHtml If true, HTML tags would be handled correctly
 * @return string Trimmed string.
 *
 * Usage:
 * $excerpt_length = 250;
 * $content = apply_filters('the_content', get_the_content());
 * $excerpt = truncate( $content, $excerpt_length, '', false, true );
 *
 */
function truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = false) {
    if ($considerHtml) {
        // if the plain text is shorter than the maximum length, return the whole text
        if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
            return $text;
        }

        // splits all html-tags to scanable lines
        preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);

        $total_length = strlen($ending);
        $open_tags = array();
        $truncate = '';

        foreach ($lines as $line_matchings) {
            // if there is any html-tag in this line, handle it and add it (uncounted) to the output
            if (!empty($line_matchings[1])) {
                // if it's an "empty element" with or without xhtml-conform closing slash (f.e. <br/>)
                if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                    // do nothing
                    // if tag is a closing tag (f.e. </b>)
                } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                    // delete tag from $open_tags list
                    $pos = array_search($tag_matchings[1], $open_tags);
                    if ($pos !== false) {
                        unset($open_tags[$pos]);
                    }
                    // if tag is an opening tag (f.e. <b>)
                } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                    // add tag to the beginning of $open_tags list
                    array_unshift($open_tags, strtolower($tag_matchings[1]));
                }
                // add html-tag to $truncate'd text
                $truncate .= $line_matchings[1];
            }

            // calculate the length of the plain text part of the line; handle entities as one character
            $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
            if ($total_length+$content_length> $length) {
                // the number of characters which are left
                $left = $length - $total_length;
                $entities_length = 0;
                // search for html entities
                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                    // calculate the real length of all entities in the legal range
                    foreach ($entities[0] as $entity) {
                        if ($entity[1]+1-$entities_length <= $left) {
                            $left--;
                            $entities_length += strlen($entity[0]);
                        } else {
                            // no more characters left
                            break;
                        }
                    }
                }
                $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
                // maximum lenght is reached, so get off the loop
                break;
            } else {
                $truncate .= $line_matchings[2];
                $total_length += $content_length;
            }

            // if the maximum length is reached, get off the loop
            if($total_length>= $length) {
                break;
            }
        }
    } else {
        if (strlen($text) <= $length) {
            return $text;
        } else {
            $truncate = substr($text, 0, $length - strlen($ending));
        }
    }

    // if the words shouldn't be cut in the middle...
    if (!$exact) {
        // ...search the last occurance of a space...
        $spacepos = strrpos($truncate, ' ');
        if (isset($spacepos)) {
            // ...and cut the text in this position
            $truncate = substr($truncate, 0, $spacepos);
        }
    }

    // add the defined ending to the text
    $truncate .= $ending;

    if($considerHtml) {
        // close all unclosed html-tags
        foreach ($open_tags as $tag) {
            $truncate .= '</' . $tag . '>';
        }
    }

    return $truncate;

}

/**
 * Search Filter - remove specific pages from search
 */
/*function page_search_filter( $query ) {
  if ( $query->is_search && $query->is_main_query() ) {
    $query->set( 'post__not_in', array( 63,65,88,90 ) );
  }
}
add_action( 'pre_get_posts', 'page_search_filter' );*/

/**
 * Featured Image in admin post list
 */
add_filter('manage_posts_columns', 'add_thumbnail_column', 5);

function add_thumbnail_column($columns) {
    $columns['new_post_thumb'] = __('Featured Image');
    return $columns;
}

add_action('manage_posts_custom_column', 'display_thumbnail_column', 5, 2);

function display_thumbnail_column($column_name, $post_id) {
    switch ($column_name) {
        case 'new_post_thumb':
            $post_thumbnail_id = get_post_thumbnail_id($post_id);
            if ($post_thumbnail_id) {
                $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
                echo '<img width="100" src="' . $post_thumbnail_img[0] . '" />';
            }
            break;
    }
}
/******************************************************************************
 * Featured Image Header Height Meta Box
 * Display/Hide the Page Title
 ******************************************************************************/
function header_height_get_meta( $value ) {
    global $post;

    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
    } else {
        return false;
    }
}

function header_height_add_meta_box() {
    add_meta_box(
        'header_height-header-height',
        __( 'Header Height', 'header_height' ),
        'header_height_html',
        'page',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'header_height_add_meta_box' );

function header_height_html( $post) {
    wp_nonce_field( '_header_height_nonce', 'header_height_nonce' ); ?>

    <p>Change the height of the header image.</p>

    <p>
    <label for="header_height_size"><?php _e( 'Size', 'header_height' ); ?></label><br>
    <select name="header_height_size" id="header_height_size">
        <option <?php echo (header_height_get_meta( 'header_height_size' ) === 'Normal' ) ? 'selected' : '' ?>>Normal</option>
        <option <?php echo (header_height_get_meta( 'header_height_size' ) === 'Narrow' ) ? 'selected' : '' ?>>Narrow</option>
        <option <?php echo (header_height_get_meta( 'header_height_size' ) === 'Tall' ) ? 'selected' : '' ?>>Tall</option>
        <option <?php echo (header_height_get_meta( 'header_height_size' ) === 'None' ) ? 'selected' : '' ?>>None</option>
    </select>
    </p><?php
}

function header_height_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['header_height_nonce'] ) || ! wp_verify_nonce( $_POST['header_height_nonce'], '_header_height_nonce' ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;


    if ( isset( $_POST['header_height_size'] ) )
        update_post_meta( $post_id, 'header_height_size', esc_attr( $_POST['header_height_size'] ) );
    else
        update_post_meta( $post_id, 'header_height_size', null );
}
add_action( 'save_post', 'header_height_save' );

/*
  Usage: header_height_get_meta( 'header_height_size' )
*/

/******************************************************************************
 * Custom Header Content Meta Box
 ******************************************************************************/
function custom_header_content_get_meta( $value ) {
    global $post;

    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
    } else {
        return false;
    }
}

function ferus_create_custom_header_content( $post ) {

    do_meta_boxes( null, 'custom-header-content', $post );
}
add_action( 'edit_form_after_title', 'ferus_create_custom_header_content' );

function ferus_add_custom_header_content_box() {
    add_meta_box(
        'custom_header_content',
        __( 'Custom Header Content', 'custom_header_content' ),
        'ferus_render_header_metabox',
        'page',
        'custom-header-content'
    );
}
add_action( 'add_meta_boxes', 'ferus_add_custom_header_content_box' );

function ferus_render_header_metabox( $post ) {
    wp_nonce_field( '_custom_header_content_nonce', 'custom_header_content_nonce' ); ?>
    <div class="ferus-admin-group">
        <label for="custom_header_content_title"><?php _e( 'Title', 'custom_header_content' ); ?></label>
        <input type="text" name="custom_header_content_title" id="custom_header_content_title" value="<?php echo custom_header_content_get_meta( 'custom_header_content_title' ); ?>">
    </div>
    <div class="ferus-admin-group">
        <label for="custom_header_content_content"><?php _e( 'Content', 'custom_header_content' ); ?></label>
        <textarea name="custom_header_content_content" id="custom_header_content_content" rows="5"><?php echo custom_header_content_get_meta( 'custom_header_content_content' ); ?></textarea>
    </div>
    <div class="ferus-admin-group">
        <label>Content Location</label>
        <ul class="custom-content-location">
            <li>
                <input type="radio" name="custom_header_content_location" id="custom_content_location_0" value="content-center" checked>
                <label for="custom_content_location_0">Center</label>
            </li>
            <li>
                <input type="radio" name="custom_header_content_location" id="custom_content_location_1" value="content-left" <?php echo ( custom_header_content_get_meta( 'custom_header_content_location' ) === 'content-left' ) ? 'checked' : ''; ?>>
                <label for="custom_content_location_1">Left</label>
            </li>
            <li>
                <input type="radio" name="custom_header_content_location" id="custom_content_location_2" value="content-right" <?php echo ( custom_header_content_get_meta( 'custom_header_content_location' ) === 'content-right' ) ? 'checked' : ''; ?>>
                <label for="custom_content_location_2">Right</label>
            </li>
        </ul>
    </div>
    <?php
}

function custom_header_content_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['custom_header_content_nonce'] ) || ! wp_verify_nonce( $_POST['custom_header_content_nonce'], '_custom_header_content_nonce' ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['custom_header_content_title'] ) )
        update_post_meta( $post_id, 'custom_header_content_title', esc_attr( $_POST['custom_header_content_title'] ) );
    if ( isset( $_POST['custom_header_content_content'] ) )
        update_post_meta( $post_id, 'custom_header_content_content', esc_attr( $_POST['custom_header_content_content'] ) );
    if ( isset( $_POST['custom_header_content_location'] ) )
        update_post_meta( $post_id, 'custom_header_content_location', esc_attr( $_POST['custom_header_content_location'] ) );
}
add_action( 'save_post', 'custom_header_content_save' );

/*
	Usage: custom_header_content_get_meta( 'custom_header_content_title' )
	Usage: custom_header_content_get_meta( 'custom_header_content_content' )
    Usage: custom_header_content_get_meta( 'custom_header_content_location' )
*/
/******************************************************************************
 * Must Reads Shortcode
 ******************************************************************************/
function must_reads_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '4',
                'category' => '',
            ), $atts)
    );

    // Code
    $recent_args = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => $posts,
        'order' => 'DESC'
    );
    $recent_query = new WP_Query($recent_args);
    if ($recent_query->have_posts()) : ?>
        <?php
        $postCount = $recent_args['posts_per_page'];
        $columnWidth = 'col-sm-6 col-md-3';
        if ($postCount === '1') {
            $columnWidth = 'col-md-12';
        } else if ($postCount === '2') {
            $columnWidth = 'col-sm-12 col-md-6';
        } else if ($postCount === '3' || $postCount === '6') {
            $columnWidth = 'col-sm-12 col-md-4';
        }
        ?>
        <div class="must-reads-wrap container">
            <div class="row">
                <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
                    <?php
                    // Get Image
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'post-med');
                    if ($image) {
                        $image = $image[0];
                    } else {
                        $image = '/wp-content/themes/creative-core/inc/images/hero.jpg';
                    }
                    // Get Post Format
                    $format = get_post_format() ?: 'standard';
                    ?>
                    <div class="post-item <?php echo $columnWidth; ?> <?php echo $format; ?>" data-col="post-item">
                        <article id="post-<?php echo $post->ID; ?>" class="post-<?php echo $post->ID; ?> post-inner">

                            <div class="category">
                                <?php the_category(' | ', '', $post->ID); ?>
                            </div>

                            <a class="post-thumb" href="<?php echo get_permalink($post->ID); ?>" style="background-image: url(<?php echo $image; ?>);">
                                <!-- <div class="post-format">
                            <?php if ($format === 'case-study' || $format === 'quote'): ?>
                                <i class="fas fa-chart-pie"></i> <span>Case Study</span>
                            <?php elseif ($format === 'infographic' || $format === 'image'): ?>
                                <i class="far fa-chart-bar"></i> <span>Infographic</span>
                            <?php elseif ($format === 'video'): ?>
                                <i class="far fa-play-circle"></i> <span>Video</span>
                            <?php else: ?>
                            <?php endif; ?>
                        </div> -->
                            </a><!-- .post-thumb -->

                            <div class="post-content">
                                <p class="author-date"><?php the_author(); ?> | <?php the_time('F d, Y'); ?></p>
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <p class="content-blurb">
                                    <?php echo wp_trim_words(get_the_content(), 13, '...'); ?>
                                </p>
                                <!-- <a href="<?php // the_permalink(); ?>" data-button="arrow">Read More</a> -->
                                <hr>
                            </div>

                        </article>
                    </div><!-- .post-item -->
                <?php endwhile; ?>
            </div><!-- .row -->
        </div><!-- .container -->
    <?php else : ?>
        <p>Sorry! No posts found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('must-reads', 'must_reads_shortcode');
/******************************************************************************
 * Content Slider Shortcode
 ******************************************************************************/
function content_slider_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '4',
                'category' => '',
            ), $atts)
    );

    // Code
    $recent_args = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => $posts,
        'order' => 'DESC'
    );
    $recent_query = new WP_Query($recent_args);
    if ($recent_query->have_posts()) : ?>
        <div class="content_slider content-slider">
            <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
                <?php
                $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
                ?>
                <div>
                    <div class="col-md-7 content-img" data-col="content-slide">
                        <div class="img-wrap" style="background-image:url(<?php echo $image; ?>);"></div>
                        <!-- <img src="<?php //echo get_template_directory_uri(); ?>/inc/images/home-slide-01.jpg"> -->
                    </div>
                    <div class="col-md-5 slide-content" data-col="content-slide">
                        <p class="category"><?php the_category(' | ', '', $post->ID); ?></p>
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                        <!-- <p class="entry-excerpt"><?php // echo wp_trim_words(get_the_excerpt(), 18, '...'); ?></p> -->
                        <p class="entry-excerpt"><?php echo get_the_excerpt(); ?></p>
                        <p class="read-more"><a href="<?php the_permalink(); ?>" data-button>Learn More</a></p>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <!-- <p class="see-all-posts"><a href="<?php // echo site_url(); ?>">See All Posts</a></p> -->
        </div><!-- .recent-posts -->
    <?php else : ?>
        <p>Sorry! No posts found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('content-slider', 'content_slider_shortcode');
/******************************************************************************
 * Portfolio Shortcode
 ******************************************************************************/
function portfolio_slider_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '4',
                'category' => '',
                'content' => '',
            ), $atts)
    );

    $content_pos = $content?$content:'right';
    $pos_class = 'content-pos-' . $content_pos;

    // Code
    $recent_args = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => $posts,
        'order' => 'DESC'
    );
    $recent_query = new WP_Query($recent_args);
    if ($recent_query->have_posts()) : ?>
        <div class="content_slider content-slider <?php echo $pos_class; ?>">
            <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
                <?php
                $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
                $company_url = get_post_meta( get_the_ID(), 'portfolio_url', true );
                $excerpt_length = 250;
                $content = apply_filters('the_content', get_the_content());
                $excerpt = truncate( $content, $excerpt_length, '...', false, true );
                ?>
                <div>
                <?php if($content_pos === 'left') : ?>
                    <div class="col-md-5 slide-content" data-col="content-slide">
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                        <?php //if($company_url) : ?>
                            <!-- <a class="link" href="<?php //echo 'http://' . $company_url; ?>"><?php //echo $company_url; ?></a></a> -->
                        <?php //endif; ?>
                        <div class="entry-excerpt"><?php echo $excerpt; ?></div>
                        <p class="read-more"><a href="<?php the_permalink(); ?>" data-button>Learn More</a></p>
                    </div>
                    <div class="col-md-7 content-img" data-col="content-slide">
                        <div class="img-wrap" style="background-image:url(<?php echo $image; ?>);"></div>
                    </div>
                <?php else : ?>
                    <div class="col-md-7 content-img" data-col="content-slide">
                        <div class="img-wrap" style="background-image:url(<?php echo $image; ?>);"></div>
                    </div>
                    <div class="col-md-5 slide-content" data-col="content-slide">
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                        <a class="link" href="<?php the_permalink(); ?>">www.website.com</a></a>
                        <div class="entry-excerpt"><?php echo $excerpt; ?></div>
                        <p class="read-more"><a href="<?php the_permalink(); ?>" data-button>Learn More</a></p>
                    </div>
                <?php endif; ?>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <!-- <p class="see-all-posts"><a href="<?php // echo site_url(); ?>">See All Posts</a></p> -->
        </div><!-- .recent-posts -->
    <?php else : ?>
        <p>Sorry! No posts found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('portfolio-slider', 'portfolio_slider_shortcode');
/******************************************************************************
 * Slideset Products Shortcode
 ******************************************************************************/
function slideset_products_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '5',
                'category' => '',
                'order' => 'rand',
                'best_selling' => 'false',
            ), $atts)
    );

    // Code
    $product_args = array(
        'post_type' => 'product',
        'product_cat' => $category,
        'posts_per_page' => $posts,
        'order' => $order
    );
    if ($best_selling === 'true') {
        $product_args = array(
            'post_type' => 'product',
            'product_cat' => $category,
            'posts_per_page' => $posts,
            'meta_key' => 'total_sales',
            'orderby' => 'meta_value_num',
            'order' => $order
        );
    }
    $products_query = new WP_Query($product_args);
    if ($products_query->have_posts()) : ?>
        <?php
        $group_id = rand();
        $postCount = $product_args['posts_per_page'];
        $columnWidth = 'col-sm-6 col-md-3';
        if ($postCount === '1') {
            $columnWidth = 'col-md-12';
        } else if ($postCount === '2') {
            $columnWidth = 'col-sm-12 col-md-6';
        } else if ($postCount === '3' || $postCount === '6') {
            $columnWidth = 'col-sm-12 col-md-4';
        }
        ?>
        <div class="slideset-products">
            <?php while ( $products_query->have_posts() ) : $products_query->the_post(); ?>
                <?php
                // Get Image
                $product_id = get_the_ID();
                $_product = wc_get_product($product_id);
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'post-med');
                $fullImage = $image ? $image[0] : '/wp-content/themes/creative-core/inc/images/hero.jpg';
                $currency = get_woocommerce_currency_symbol();
                $price = get_post_meta( $product_id, '_regular_price', true);
                $sale = get_post_meta( $product_id, '_sale_price', true);
                ?>
                <div class="product-item">
                    <article id="product-<?php echo $product_id; ?>" class="product-<?php echo $product_id; ?> post-inner" data-col="slideset-item-<?php echo $group_id; ?>">

                        <a class="product-thumb" href="<?php echo get_permalink($product_id); ?>" style="background-image: url(<?php echo $fullImage; ?>);">
                            <?php if ( $price_html = $_product->get_price_html() ) : ?>
                                <span class="price"><?php echo $price_html; ?></span>
                            <?php endif; ?>
                            <div class="product-content">
                                <h2 class="product-title"><?php the_title(); ?></h2>
                            </div>
                        </a><!-- .post-thumb -->

                    </article>
                </div><!-- .post-item -->
            <?php endwhile; ?>
        </div><!-- .slideset-products -->
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p>Sorry! No products found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}
if ( class_exists( 'woocommerce' ) ) {
    add_shortcode('slideset-products', 'slideset_products_shortcode');
}

/******************************************************************************
 * Featured Products Slider Shortcode
 ******************************************************************************/
function featured_products_slider_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '5',
                'category' => '',
                'order' => 'rand',
            ), $atts)
    );

    // Code
    $product_args = array(
        'post_type' => 'product',
        'product_cat' => $category,
        'posts_per_page' => $posts,
        'product_tag' => 'featured',
        'order' => $order,
    );
    $products_query = new WP_Query($product_args);
    if ($products_query->have_posts()) : ?>
        <div class="home_slider featured-products-slider">
            <?php while ( $products_query->have_posts() ) : $products_query->the_post(); ?>
                <?php
                // Get Image
                $product_id = get_the_ID();
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'post-med');
                $fullImage = $image ? $image[0] : '/wp-content/themes/creative-core/inc/images/hero.jpg';
                $currency = get_woocommerce_currency_symbol();
                $price = get_post_meta( $product_id, '_regular_price', true);
                $sale = get_post_meta( $product_id, '_sale_price', true);
                ?>
                <div class="featured-slide" style="background-image:url('/wp-content/themes/creative-core/inc/images/hero.jpg');">
                    <div class="slide-caption center">
                        <h3 class="section-title"><?php the_title(); ?></h3>
                        <?php the_excerpt(); ?>
                        <a href="<?php echo get_permalink($product_id); ?>" data-button="arrow">Select Options</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div><!-- .home_slider -->
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p>Sorry! No products found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}
if ( class_exists( 'woocommerce' ) ) {
    add_shortcode('featured-products-slider', 'featured_products_slider_shortcode');
}

/******************************************************************************
 * Featured Product For Archive Banner Shortcode
 ******************************************************************************/
function featured_product_banner_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '1',
                'category' => '',
                'order' => 'rand',
            ), $atts)
    );

    // Code
    $product_args = array(
        'post_type' => 'product',
        'product_cat' => $category,
        'posts_per_page' => $posts,
        'product_tag' => 'featured',
        'order' => $order,
    );
    $products_query = new WP_Query($product_args);
    if ($products_query->have_posts()) : ?>
        <div class="featured-product">
            <?php while ( $products_query->have_posts() ) : $products_query->the_post(); ?>
                <?php
                // Get Image
                $product_id = get_the_ID();
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'post-med');
                $fullImage = $image ? $image[0] : '/wp-content/themes/creative-core/inc/images/hero.jpg';
                $currency = get_woocommerce_currency_symbol();
                $price = get_post_meta( $product_id, '_regular_price', true);
                $sale = get_post_meta( $product_id, '_sale_price', true);
                ?>

                <div class="slide-caption">
                    <h3 class="section-title"><?php the_title(); ?></h3>
                    <?php the_excerpt(); ?>
                    <a href="<?php echo get_permalink($product_id); ?>" data-button="arrow">Select Options</a>
                </div>

            <?php endwhile; ?>
        </div><!-- .home_slider -->
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p>Sorry! No featured product found.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}
if ( class_exists( 'woocommerce' ) ) {
    add_shortcode('featured-product', 'featured_product_banner_shortcode');
}

/******************************************************************************
 * Product Categories Grid
 ******************************************************************************/
function product_categories_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'include' => '',
                'exclude' => '',
                'hide_empty' => 0,
                'parent' => '',
                'orderby' => 'slug',
                'order' => 'ASC',
                'col' => '',
                'view_all' => '',
            ), $atts)
    );

    $wcatTerms = get_terms('product_cat', array(
        'include' => $include,
        'exclude' => $exclude,
        'hide_empty' => $hide_empty,
        'parent' => $parent,
        'orderby' => $orderby,
        'order' => $order,
    ));

    $colClass = 'col-sm-6 col-md-4';
    if($col === '5') {
        $colClass = 'col-5';
    }

    if($wcatTerms):
        foreach($wcatTerms as $term) :

            $term_url = get_term_link( $term->slug, $term->taxonomy );
            $cat_thumb_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
            $shop_catalog_img = wp_get_attachment_image_src( $cat_thumb_id, 'full' );
            if ($shop_catalog_img) {
                $category_image = $shop_catalog_img[0];
            } else {
                $category_image = '/wp-content/themes/creative-core/inc/images/hero.jpg';
            }
            ?>
            <div class="<?php echo $colClass; ?>">
                <a class="shop-cat" href="<?php echo $term_url; ?>" style="background-image:url(<?php echo $category_image; ?>);">
                    <!-- <img src="<?php echo $category_image; ?>" alt="<?php echo $term->name; ?>"> -->
                    <h3 class="title"><?php echo $term->name; ?></h3>
                </a>
            </div>
        <?php endforeach; ?>

        <?php if($view_all != 'false') : ?>
            <?php $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>
            <div class="col-sm-6 col-md-4">
                <a class="shop-cat" href="<?php echo $shop_page_url; ?>" style="background-image:url('/wp-content/themes/creative-core/inc/images/hero.jpg');">
                    <h3 class="title">View All Products</h3>
                </a>
            </div>
        <?php endif; ?>

    <?php else :?>
        <p>Sorry! No product categories found.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}
if ( class_exists( 'woocommerce' ) ) {
    add_shortcode('product-cats', 'product_categories_shortcode');
}
/******************************************************************************
 * Ferus Core Custom Gallery Shortcode
 ******************************************************************************/
add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );
function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'div',
        'icontag'    => 'div',
        'captiontag' => 'div',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => '',
        'slideset'   => '',
        'masonry'   => '',
        'lightbox'   => '',
        'theme'      => 'light'
    ), $attr));

    $defaultClass = 'gallery-default';
    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    $slidesetClass = '';
    if ( $slideset == 'true') {
        $defaultClass = '';
        $slidesetClass = 'gallery-slideset';
    }

    $masonryClass = '';
    $masonrySizer = '';
    if ( $masonry == 'true') {
        $defaultClass = '';
        $slidesetClass = '';
        $masonryClass = 'masonry-gallery';
        $masonrySizer = '<div class="gallery-grid-sizer"></div>';
    }

    $lightboxClass = '';
    if ( $lightbox == 'true')
        $lightboxClass = 'lb-gallery';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $output = apply_filters('gallery_style', "<div id='$selector' class='gallery galleryid-{$id} {$defaultClass}{$slidesetClass}{$masonryClass} col{$columns} theme-{$theme}'>{$masonrySizer}");

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $img = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image($id, $size, false, false) : wp_get_attachment_image($id, $size, true, false);
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_url($id) : wp_get_attachment_url($id);
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $caption = wptexturize($attachment->post_excerpt);
        }

        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "<a class='gallery-icon {$lightboxClass}' href='". $link ."' data-lightbox='". $selector ."' data-title='" . $caption . "'>" . $img . "</a>";
        $output .= "</{$itemtag}>";
        if ( $columns > 0 && ++$i % $columns == 0 )
            $output .= '';
    }

    $output .= "</div>\n";

    return $output;
}
/******************************************************************************
 * Infinite Scroll Blogroll
 ******************************************************************************/
function wp_infinitepaginate(){
    $loopFile        = $_POST['loop_file'];
    $paged           = $_POST['page_no'];
    $posts_per_page  = get_option('posts_per_page');
    $searchText  = $_POST['s'];
    $category  = $_POST['cat'];
    $tag  = $_POST['tag'];
    $order = 'DESC';
    $post_type = 'post';
    $post_status = 'publish';

    # Load the posts
    query_posts(array('post_type' => $post_type, 'post_status' => $post_status, 'paged' => $paged, 's' => $searchText, 'cat' => $category, 'tag' => $tag, 'order' => $order ));
    get_template_part( $loopFile );

    exit;
}
add_action('wp_ajax_infinite_scroll', 'wp_infinitepaginate');
add_action('wp_ajax_nopriv_infinite_scroll', 'wp_infinitepaginate');

/**
 * Pre-populate Single Product Form
 */
if ( class_exists( 'woocommerce' ) ) {
    add_filter( 'gform_field_value_form_product_name', 'populate_single_product_name' );
}
function populate_single_product_name( $value ) {
    $product_name = get_the_title();
    return $product_name;
}
/*--- WooCommerce Products Per Page ---*/
if ( class_exists( 'woocommerce' ) ) {
    add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
}
function new_loop_shop_per_page( $cols ) {
    $cols = 9;
    return $cols;
}