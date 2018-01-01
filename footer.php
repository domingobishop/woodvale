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
                <div class="sign-up">
                    <!-- Begin MailChimp Signup Form -->
                    <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
                    <style type="text/css">
                        #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
                        /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                           We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                    </style>
                    <div id="mc_embed_signup">
                        <form action="//woodvalevintners.us16.list-manage.com/subscribe/post?u=29c452629841b192bda9cc76f&amp;id=ce1261d2e1" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                            <div id="mc_embed_signup_scroll">
                                <h2>Subscribe to our mailing list</h2>
                                <div class="mc-field-group">
                                    <label for="mce-EMAIL">Email Address </label>
                                    <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                                </div>
                                <div id="mce-responses" class="clear">
                                    <div class="response" id="mce-error-response" style="display:none"></div>
                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_29c452629841b192bda9cc76f_ce1261d2e1" tabindex="-1" value=""></div>
                                <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                            </div>
                        </form>
                    </div>
                    <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                    <!--End mc_embed_signup-->
                </div>
                <div class="branding">
                    <div class="logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/cvlogo.png"
                             alt="Regional Development Australia Clare and Mid North" class="img-responsive">
                    </div>
                </div>
                <p>
                    Copyright © <?php echo date("Y"); ?> Woodvale Vintners<br>
                    <?php $terms = get_option('wood_terms');
                    if ($terms) {
                        echo '<a href="'.$terms.'">';
                        echo 'Terms and conditions';
                        echo '</a><br>';
                    } ?>
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