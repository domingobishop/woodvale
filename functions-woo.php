<?php
/**
 * Woocommerce
 *
 */

function woocommerce_support()
{
    add_theme_support('woocommerce');
}

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('after_setup_theme', 'woocommerce_support');
add_action('woocommerce_before_main_content', 'wood_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'wood_wrapper_end', 10);
add_action('init', 'bottle_thumbnail');

add_filter('woocommerce_related_products_args', 'wc_remove_related_products', 10);
add_filter('woocommerce_product_tabs', 'woo_remove_reviews_tab', 98);
add_filter('woocommerce_product_tabs', 'woo_rename_tabs', 98);
add_filter( 'woocommerce_product_description_heading', 'wc_change_product_description_tab_heading', 10, 1 );
add_filter('woocommerce_product_tabs', 'woo_awards_product_tab');

function wood_wrapper_start()
{
    echo '<main id="main" class="main" role="main">';
    echo '<div id="content" class="content"><div class="container"><div class="row">';
    echo '<nav class="shop-nav"><div class="col-md-10 col-md-offset-1">';
    wp_nav_menu(array('menu' => 'shop', 'items_wrap' => '<ul class="nav navbar-nav navbar-right" role="menu">%3$s</ul>', 'container' => false));
    echo '</div></nav>';
    echo '<div class="col-md-10 col-md-offset-1">';
}

function wood_wrapper_end()
{
    echo '</div></div></div></div></main>';
}

function wc_remove_related_products($args)
{
    return array();
}

function woo_remove_reviews_tab($tabs)
{
    unset($tabs['reviews']);
    unset($tabs['additional_information']);
    return $tabs;
}

function woo_rename_tabs($tabs)
{
    $tabs['description']['title'] = __('Tasting notes');
    return $tabs;
}

function wc_change_product_description_tab_heading( $title ) {

    return __('Tasting notes');
}

function woo_awards_product_tab($tabs)
{

    $tabs['awards_tab'] = array(
        'title' => __('Awards and accolades', 'woocommerce'),
        'priority' => 50,
        'callback' => 'woo_awards_product_tab_content'
    );

    return $tabs;

}

function woo_awards_product_tab_content()
{
    global $post;

    echo '<h2>Awards and accolades</h2>';
    echo get_post_meta( $post->ID, 'wood_awards', true );

}

function bottle_thumbnail()
{
    add_filter('woocommerce_placeholder_img_src', 'bottle_placeholder_img_src');

    function bottle_placeholder_img_src($src)
    {
        $dir = get_template_directory_uri();
        $src = $dir . '/img/bottle-thumb.png';

        return $src;
    }
}

add_action( 'woocommerce_product_options_general_product_data', 'wood_custom_fields' );
add_action( 'woocommerce_process_product_meta', 'wood_custom_fields_save' );

// http://www.remicorson.com/mastering-woocommerce-products-custom-fields/
function wood_custom_fields() {

    global $woocommerce, $post;

    echo '<div class="options_group">';

    // Awards
    woocommerce_wp_textarea_input(
        array(
            'id'          => 'wood_awards',
            'label'       => __( 'Awards and accolades', 'woocommerce' ),
            'placeholder' => '',
            'description' => __( '', 'woocommerce' )
        )
    );

    echo '</div>';

}

function wood_custom_fields_save( $post_id ){

    // Awards
    $woocommerce_textarea = $_POST['wood_awards'];
    if( !empty( $woocommerce_textarea ) )
        update_post_meta( $post_id, 'wood_awards', esc_html( $woocommerce_textarea ) );

}

add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);

function custom_variation_price( $price, $product ) {

    $price = '';
    $price .= woocommerce_price($product->get_price());

    return $price;
}

function remove_loop_button(){
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}
add_action('init','remove_loop_button');

/*add_action('woocommerce_after_shop_loop_item','replace_add_to_cart');
function replace_add_to_cart() {
    global $product;
    $link = $product->get_permalink();
    echo do_shortcode('<a rel="nofollow" href="' . esc_attr($link) . '" class="button">Read more</a>');
}*/

add_action( 'woocommerce_before_shop_loop', 'handsome_bearded_guy_select_variations' );

function handsome_bearded_guy_select_variations() {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_add_to_cart', 30 );
}