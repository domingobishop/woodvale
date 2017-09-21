<?php
/**
 * Admin
 *
 */

add_action('admin_menu', 'home_settings');
add_action('admin_init', 'home_settings_data');

function home_settings() {
    add_menu_page('Woodvale theme settings', 'Woodvale', 'administrator', 'woodvale-homepage', 'home_settings_page', 'dashicons-admin-generic', 21);
}

function home_settings_data() {
    register_setting('home_settings_group', 'wood_facebook');
    register_setting('home_settings_group', 'wood_instagram');
    register_setting('home_settings_group', 'wood_address_1');
    register_setting('home_settings_group', 'wood_address_2');
    register_setting('home_settings_group', 'wood_tel');
    register_setting('home_settings_group', 'wood_email');
    register_setting('home_settings_group', 'wood_terms');

    register_setting('home_settings_group', 'slider_img_1');
    register_setting('home_settings_group', 'slider_img_2');
    register_setting('home_settings_group', 'slider_img_3');

    register_setting('home_settings_group', 'facebook_widget');
    register_setting('home_settings_group', 'facebook_js_widget');

    for ( $i=1 ; $i<=3 ; $i++ ) {
        register_setting('home_settings_group', 'promo_img_'.$i);
        register_setting('home_settings_group', 'promo_txt_'.$i);
        register_setting('home_settings_group', 'promo_url_'.$i);
    }
}

function home_settings_page()
{
    // admin
    ?>
    <style>
        .wood-admin input[type=text] {
            width: 100%;
            max-width: 320px;
        }
        .wood-admin textarea {
            width: 100%;
            max-width: 320px;
            height: 12em;
        }
    </style>
    <div class="wood-admin wrap">
        <h2>Woodvale theme settings</h2>

        <form method="post" action="options.php" novalidate="novalidate">
            <?php settings_fields( 'home_settings_group' ); ?>
            <?php do_settings_sections( 'home_settings_group' ); ?>
            <table class="form-table">
                <h3>Woodvale details</h3>
                <tr valign="top">
                    <th scope="row"><label for="wood_facebook">Facebook</label></th>
                    <td><input type="text" name="wood_facebook" value="<?php echo esc_attr( get_option('wood_facebook') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="wood_instagram">Instagram</label></th>
                    <td><input type="text" name="wood_instagram" value="<?php echo esc_attr( get_option('wood_instagram') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="wood_tel">Contact number</label></th>
                    <td><input type="text" name="wood_tel" value="<?php echo esc_attr( get_option('wood_tel') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="wood_address_1">Address line 1</label></th>
                    <td><input type="text" name="wood_address_1" value="<?php echo esc_attr( get_option('wood_address_1') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="wood_address_2">Address line 2</label></th>
                    <td><input type="text" name="wood_address_2" value="<?php echo esc_attr( get_option('wood_address_2') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="wood_email">Email</label></th>
                    <td><input type="text" name="wood_email" value="<?php echo esc_attr( get_option('wood_email') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="wood_terms">Terms & Conditions page</label></th>
                    <td><input type="text" name="wood_terms" value="<?php echo esc_attr( get_option('wood_terms') ); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
            <table class="form-table">
                <h3>Homapage image slider</h3>
                <p>Copy/paste the image URL from the Media Library. Please crop images with the focus is in the centre.</p>
                <tr valign="top">
                    <th scope="row"><label for="slider_img_1">Image 1</label></th>
                    <td><input type="text" name="slider_img_1" value="<?php echo esc_attr( get_option('slider_img_1') ); ?>" /></td>
                    <td>Image size 1600px x 750px</td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="slider_img_2">Image 2</label></th>
                    <td><input type="text" name="slider_img_2" value="<?php echo esc_attr( get_option('slider_img_2') ); ?>" /></td>
                    <td>Image size 1600px x 750px</td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="slider_img_3">Image 3</label></th>
                    <td><input type="text" name="slider_img_3" value="<?php echo esc_attr( get_option('slider_img_3') ); ?>" /></td>
                    <td>Image size 1600px x 750px</td>
                </tr>
            </table>
            <?php submit_button(); ?>
            <table class="form-table">
                <h3>Promotional area</h3>
                <p>Copy/paste the image URL from the Media Library.</p>
                <?php for ( $i=1 ; $i<=3 ; $i++ ) { ?>
                <tr valign="top">
                    <th scope="row">Section <?php echo $i; ?></th>
                    <td></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="promo_img_<?php echo $i; ?>">Image</label></th>
                    <td><input type="text" name="promo_img_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('promo_img_'.$i) ); ?>" /></td>
                    <td>Image size 480px x 480px</td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="promo_txt_<?php echo $i; ?>">Label</label></th>
                    <td><input type="text" name="promo_txt_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('promo_txt_'.$i) ); ?>" /></td>
                    <td></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="promo_url_<?php echo $i; ?>">Link</label></th>
                    <td><input type="text" name="promo_url_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('promo_url_'.$i) ); ?>" /></td>
                    <td></td>
                </tr>
                <?php } ?>
            </table>
            <?php submit_button(); ?>
            <table class="form-table">
                <h3>Facebook widget</h3>
                <tr valign="top">
                    <th scope="row"><label for="facebook_js_widget">Widget JS code</label></th>
                    <td><textarea name="facebook_js_widget"><?php echo esc_attr( get_option('facebook_js_widget') ); ?></textarea></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="facebook_widget">Widget HTML code</label></th>
                    <td><textarea name="facebook_widget"><?php echo esc_attr( get_option('facebook_widget') ); ?></textarea></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>

    </div>
    <?php
}