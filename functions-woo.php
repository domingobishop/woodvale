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
add_filter('woocommerce_product_tabs', 'woo_awards_product_tab');

function wood_wrapper_start()
{
    echo '<main id="main" class="main" role="main">
        <div id="content" class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">';
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

function woo_awards_product_tab($tabs)
{

    $tabs['test_tab'] = array(
        'title' => __('Awards', 'woocommerce'),
        'priority' => 50,
        'callback' => 'woo_awards_product_tab_content'
    );

    return $tabs;

}

function woo_awards_product_tab_content()
{

    echo '<h2>Awards</h2>';
    echo '<p>Here\'s your new product tab.</p>';

}

function bottle_thumbnail()
{
    add_filter('woocommerce_placeholder_img_src', 'bottle_placeholder_img_src');

    function bottle_placeholder_img_src($src)
    {
        $dir = get_template_directory_uri();
        $src = $dir . '/img/bottle-thumb.gif';

        return $src;
    }
}