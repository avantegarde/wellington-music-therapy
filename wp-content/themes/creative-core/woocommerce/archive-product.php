<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<?php
global $wp;
global $wp_query;
$current_url = home_url(add_query_arg(array(),$wp->request));
$cat = $wp_query->get_queried_object();
$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
$feat_image = wp_get_attachment_url( $thumbnail_id );
$image = $feat_image ? $feat_image : get_template_directory_uri() . '/inc/images/hero.jpg';
//$archive_term = get_queried_object();
?>

<!-- <div id="page-header" class="container featured-product-header">
    <div class="header-img parallax v-align" data-plx-img="<?php echo $image; ?>">
        <div class="header-content v-inner">
            <?php // echo do_shortcode('[featured-product category="'. $cat->slug .'"]'); ?>
        </div>
    </div>
</div> -->

<section id="shop-categories" class="shop-cat-grid cat-archive-grid">
    <div class="container">
        <div class="shop-cat-row">
            <div class="col-5 other-cats">
                <div class="shop-cat">
                    <h3 class="title">Other Categories</h3>
                </div>
            </div>
            <?php
            $product_cats = array(20,18,17,19,21);
            $cat_pos = array_search($cat->term_id, $product_cats);
            unset($product_cats[$cat_pos]);
            $prod_cat_string = implode(',',$product_cats);
            echo do_shortcode('[product-cats include="' . $prod_cat_string . '" col="5" view_all="false"]');
            ?>
        </div>
    </div>
</section>

<?php
/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
?>


<!-- <section id="best-selling-products" class="">
        <h3 class="section-title block-title center">Best Selling <?php echo $cat->name; ?></h3>
        <div class="">
            <?php // echo do_shortcode('[slideset-products posts="5" category="'. $cat->slug .'" order="rand" best_selling="true"]'); ?>
        </div>
</section> -->

<?php if ( is_active_sidebar( 'shop-archive-top' ) ) : ?>
    <!-- Shop Archive Top -->
    <section class="shop-archive-top">
        <div class="container">
            <?php dynamic_sidebar( 'shop-archive-top' ); ?>
        </div>
    </section>
<?php endif; ?>


<div class="row">
        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
        <div class="col-md-12">
            <h1 class="section-title block-title center">All <?php woocommerce_page_title(); ?></h1>
        </div>
        <?php endif; ?>
    <div class="col-md-12">

    <header class="woocommerce-products-header">

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>

    </header>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked wc_print_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/**
						 * woocommerce_shop_loop hook.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );
					?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php
				/**
				 * woocommerce_no_products_found hook.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			?>

		<?php endif; ?>
    </div>

    <?php
        /**
         * woocommerce_sidebar hook.
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        //do_action( 'woocommerce_sidebar' );
    ?>
</div><!-- .row -->

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

    <!-- Page Bottom Widgets -->
    <?php if ( is_active_sidebar( 'page-bottom' ) ) : ?>
        <section id="page-bottom" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'page-bottom' ); ?>
        </section>
    <?php endif; ?>

<?php get_footer( 'shop' ); ?>
