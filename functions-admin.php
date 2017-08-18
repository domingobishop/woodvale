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
    register_setting('home_settings_group', 'home_facebook');
    register_setting('home_settings_group', 'home_instagram');
    register_setting('home_settings_group', 'footer_address_1');
    register_setting('home_settings_group', 'footer_address_2');
    register_setting('home_settings_group', 'footer_contact');
    register_setting('home_settings_group', 'footer_email');

    register_setting('home_settings_group', 'facebook_widget');

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
    <div class="wrap">
        <h2>Woodvale theme settings</h2>

        <form method="post" action="options.php" novalidate="novalidate">
            <?php settings_fields( 'home_settings_group' ); ?>
            <?php do_settings_sections( 'home_settings_group' ); ?>
            <table class="form-table">
                <h3>Page header</h3>
                <tr valign="top">
                    <th scope="row"><label for="home_facebook">Facebook</label></th>
                    <td><input type="text" name="home_facebook" value="<?php echo esc_attr( get_option('home_facebook') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="home_instagram">Instagram</label></th>
                    <td><input type="text" name="home_instagram" value="<?php echo esc_attr( get_option('home_instagram') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="home_contact">Contact number</label></th>
                    <td><input type="text" name="home_contact" value="<?php echo esc_attr( get_option('home_contact') ); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
            <table class="form-table">
                <h3>Promotional area</h3>
                <?php for ( $i=1 ; $i<=3 ; $i++ ) { ?>
                <tr valign="top">
                    <th scope="row">Section <?php echo $i; ?></th>
                    <td></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="promo_img_<?php echo $i; ?>">Image</label></th>
                    <td><input type="text" name="promo_img_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('promo_img_'.$i) ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="promo_txt_<?php echo $i; ?>">Text</label></th>
                    <td><input type="text" name="promo_txt_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('promo_txt_'.$i) ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="promo_url_<?php echo $i; ?>">Link</label></th>
                    <td><input type="text" name="promo_url_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('promo_url_'.$i) ); ?>" /></td>
                </tr>
                <?php } ?>
            </table>
            <?php submit_button(); ?>
            <table class="form-table">
                <h3>Page footer</h3>
                <tr valign="top">
                    <th scope="row"><label for="footer_address_1">Address line 1</label></th>
                    <td><input type="text" name="footer_address_1" value="<?php echo esc_attr( get_option('footer_address_1') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="footer_address_2">Address line 2</label></th>
                    <td><input type="text" name="footer_address_2" value="<?php echo esc_attr( get_option('footer_address_2') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="footer_contact">Contact number</label></th>
                    <td><input type="text" name="footer_contact" value="<?php echo esc_attr( get_option('footer_contact') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="footer_email">Contact number</label></th>
                    <td><input type="text" name="footer_email" value="<?php echo esc_attr( get_option('footer_email') ); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
            <table class="form-table">
                <h3>Facebook widget</h3>
                <tr valign="top">
                    <th scope="row"><label for="facebook_widget">Widget code</label></th>
                    <td><textarea name="facebook_widget"><?php echo esc_attr( get_option('facebook_widget') ); ?></textarea></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>

    </div>
    <?php
}