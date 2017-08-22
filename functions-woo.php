<?php
/**
 * Woocommerce
 *
 */

remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

add_action( 'after_setup_theme', 'woocommerce_support' );

function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'wood_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'wood_wrapper_end', 10);

function wood_wrapper_start() {
    echo '<main id="main" class="main" role="main">
        <div id="content" class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">';
}

function wood_wrapper_end() {
    echo '</div></div></div></div></main>';
}

function wc_remove_related_products( $args ) {
    return array();
}
add_filter('woocommerce_related_products_args','wc_remove_related_products', 10);

add_filter( 'woocommerce_product_tabs', 'woo_remove_reviews_tab', 98);
function woo_remove_reviews_tab($tabs) {
    unset($tabs['reviews']);
    unset( $tabs['additional_information'] );
    return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {
    $tabs['description']['title'] = __( 'Tasting notes' );
    return $tabs;
}