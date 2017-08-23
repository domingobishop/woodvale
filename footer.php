<footer id="footer" class="ooter">
    <div class="container">
        <div class="row">
            <div class="col-md-8 site-info">
                <div class="branding">
                    <div class="logo">
                        <a href="<?php bloginfo('siteurl'); ?>/"
                           title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png"
                                 alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" class="img-responsive">
                        </a>
                    </div>
                </div>
                <p>
                    <?php echo esc_attr(get_option('wood_address_1')); ?><br>
                    <?php echo esc_attr(get_option('wood_address_2')); ?><br>
                    <a href="tel:<?php echo esc_attr(get_option('wood_tel')); ?>"><?php echo esc_attr(get_option('wood_tel')); ?></a><br>
                    <a href="mailto:<?php echo esc_attr(get_option('wood_email')); ?>"><?php echo esc_attr(get_option('wood_email')); ?></a>
                </p>
                <p>
                    Copyright © <?php echo date("Y"); ?> Woodvale Vintners<br>
                    <small>Website by <a href="http://creatistic.com.au/" target="_blank">Creatistic</a></small>
                </p>
            </div>
                <?php $facebook_html = get_option('facebook_widget');
                if ($facebook_html) {
                    echo '<div class="col-md-4"><div class="facebook-wdiget clearfix">';
                    echo $facebook_html;
                    echo '</div></div>';
                } ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>