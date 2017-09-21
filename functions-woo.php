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
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

add_action('after_setup_theme', 'woocommerce_support');
add_action('woocommerce_before_main_content', 'wood_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'wood_wrapper_end', 10);
add_action('init', 'bottle_thumbnail');
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_single_excerpt', 10);
add_action('woocommerce_product_options_general_product_data', 'wood_custom_fields');
add_action('woocommerce_process_product_meta', 'wood_custom_fields_save');
add_action('woocommerce_check_cart_items', 'woo_set_min_total');
add_action('woocommerce_before_cart_table', 'woo_add_continue_shopping_button_to_cart');

add_filter('woocommerce_related_products_args', 'wc_remove_related_products', 10);
add_filter('woocommerce_product_tabs', 'woo_remove_reviews_tab', 98);
add_filter('woocommerce_product_tabs', 'woo_rename_tabs', 98);
add_filter('woocommerce_product_description_heading', 'wc_change_product_description_tab_heading', 10, 1);
add_filter('woocommerce_product_tabs', 'woo_awards_product_tab');
add_filter('woocommerce_short_description', 'woo_short_description', 10, 1);

function wood_wrapper_start()
{
    echo '<main id="main" class="main" role="main">';
    echo '<div id="content" class="content"><div class="container"><div class="row">';
    echo '<nav class="shop-nav"><div class="col-md-12">';
    wp_nav_menu(array('menu' => 'shop', 'items_wrap' => '<ul class="nav navbar-nav navbar-right" role="menu">%3$s</ul>', 'container' => false));
    echo '</div></nav>';
    echo '<div class="col-md-12">';
}

function wood_wrapper_end()
{
    echo '</div></div></div></div></main>';
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

function wc_change_product_description_tab_heading($title)
{
    return __('Tasting notes');
}

function woo_awards_product_tab($tabs)
{
    global $post;
    if (get_post_meta($post->ID, 'wood_awards', true)) {
        $tabs['awards_tab'] = array(
            'title' => __('Awards and accolades', 'woocommerce'),
            'priority' => 50,
            'callback' => 'woo_awards_product_tab_content'
        );
    }

    return $tabs;
}

function woo_awards_product_tab_content()
{
    global $post;

    echo '<h2>Awards and accolades</h2>';
    echo get_post_meta($post->ID, 'wood_awards', true);

}

// http://www.remicorson.com/mastering-woocommerce-products-custom-fields/
function wood_custom_fields()
{

    global $woocommerce, $post;

    echo '<div class="options_group">';

    // Awards
    woocommerce_wp_textarea_input(
        array(
            'id' => 'wood_awards',
            'label' => __('Awards and accolades', 'woocommerce'),
            'placeholder' => '',
            'description' => __('', 'woocommerce')
        )
    );

    echo '</div>';

}

function wood_custom_fields_save($post_id)
{
    // Awards
    $woocommerce_textarea = $_POST['wood_awards'];
    if (!empty($woocommerce_textarea))
        update_post_meta($post_id, 'wood_awards', $woocommerce_textarea);

}

// Set minimum quantity per product before checking out
function woo_set_min_total()
{
    $total_quantity = 0;
    // Only run in the Cart or Checkout pages
    if (is_cart() || is_checkout()) {

        global $woocommerce, $product;
        $i = 0;
        foreach ($woocommerce->cart->cart_contents as $product) :
            if (has_term('bundle', 'product_cat', $product['product_id'])) :
                return;
            endif;
        endforeach;
        //$prod_id_array = array();
        //loop through all cart products
        foreach ($woocommerce->cart->cart_contents as $product) :

            // Set minimum product cart total
            $minimum_cart_product_total = 6;

            // See if any product is from the bagel category or not
            if (has_term('wine', 'product_cat', $product['product_id'])) :

                $total_quantity += $product['quantity'];
                //array_push($prod_id_array, $product['product_id']);
            endif;

        endforeach;

        foreach ($woocommerce->cart->cart_contents as $product) :
            if (has_term('wine', 'product_cat', $product['product_id'])) :
                if ($total_quantity < $minimum_cart_product_total && $i == 0) {
                    // Display our error message
                    wc_add_notice(sprintf('<strong>A Minimum of %s bottles are required before checking out.</strong>'
                        . '<br />Current number of bottles in the cart: %s.',
                        $minimum_cart_product_total,
                        $total_quantity),
                        'error');
                }
                $i++;
            endif;
        endforeach;
    }

}

function woo_add_continue_shopping_button_to_cart()
{
    $shop_page_url = get_permalink(woocommerce_get_page_id('shop'));

    echo '<div class="woocommerce-message">';
    echo ' <a href="' . $shop_page_url . '" class="button">Continue Shopping →</a>';
    echo '</div>';
}

function woo_short_description($description)
{
    if (is_shop()) {
        if (strlen($description) > 78) {
            return '<p>'.trim(substr(wp_strip_all_tags($description), 0 , 78)).'... read&nbsp;more&nbsp;&#187;</p>';
        } else {
            return '<p>'.wp_strip_all_tags($description).' read&nbsp;more&nbsp;&#187;</p>';
        }
    }
}