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
        update_post_meta( $post_id, 'wood_awards', $woocommerce_textarea );

}

add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);

function custom_variation_price( $price, $product ) {

    $price = '';
    $price .= woocommerce_price($product->get_price());

    return $price;
}

/*function remove_loop_button(){
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}
add_action('init','remove_loop_button');

add_action('woocommerce_after_shop_loop_item','replace_add_to_cart');
function replace_add_to_cart() {
    global $product;
    $link = $product->get_permalink();
    echo do_shortcode('<a rel="nofollow" href="' . esc_attr($link) . '" class="button">Read more</a>');
}*/

/*
 * // https://www.thathandsomebeardedguy.com/allow-customers-to-select-variations-on-the-shop-page/
 * add_action( 'woocommerce_before_shop_loop', 'handsome_bearded_guy_select_variations' );

function handsome_bearded_guy_select_variations() {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_add_to_cart', 30 );
}*/

// Display variations dropdowns on shop page for variable products
add_filter( 'woocommerce_loop_add_to_cart_link', 'woo_display_variation_dropdown_on_shop_page' );

function woo_display_variation_dropdown_on_shop_page() {

    global $product;
    if( $product->is_type( 'variable' )) {

        $attribute_keys = array_keys( $product->get_variation_attributes() );
        ?>

        <form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $product->get_available_variations() ) ) ?>">
            <?php do_action( 'woocommerce_before_variations_form' ); ?>

            <?php if ( empty( $product->get_available_variations() ) && false !== $product->get_available_variations() ) : ?>
                <p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
            <?php else : ?>
                <table class="variations" cellspacing="0">
                    <tbody>
                    <?php foreach (  $product->get_variation_attributes() as $attribute_name => $options ) : ?>
                        <tr>
                            <td class="value">
                                <label class="sr-only" for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label>
                                <?php
                                $selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name );
                                wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
                                echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations sr-only" href="#">' . __( 'Clear', 'woocommerce' ) . '</a>' ) : '';
                                ?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>

                <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

                <div class="single_variation_wrap">
                    <?php
                    /**
                     * woocommerce_before_single_variation Hook.
                     */
                    do_action( 'woocommerce_before_single_variation' );

                    /**
                     * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
                     * @since 2.4.0
                     * @hooked woocommerce_single_variation - 10 Empty div for variation data.
                     * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
                     */
                    do_action( 'woocommerce_single_variation' );

                    /**
                     * woocommerce_after_single_variation Hook.
                     */
                    do_action( 'woocommerce_after_single_variation' );
                    ?>
                </div>

                <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
            <?php endif; ?>

            <?php do_action( 'woocommerce_after_variations_form' ); ?>
        </form>

    <?php } else {

        echo sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $quantity ) ? $quantity : 1 ),
            esc_attr( $product->id ),
            esc_attr( $product->get_sku() ),
            esc_attr( isset( $class ) ? $class : 'button' ),
            esc_html( $product->add_to_cart_text() )
        );

    }

}