<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content="initial-scale = 1.0" name="viewport">
    <title>
        <?php wp_title('|', true, 'right'); ?>
    </title>
    <?php wp_head(); ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body <?php body_class(); ?>>
<?php $facebook_js = get_option('facebook_js_widget');
if ($facebook_js) {
    echo '<!-- Facebook widget JS -->';
    echo $facebook_js;
} ?>
    <header id="head" class="head">

        <div class="branding">
            <div class="container">
                <div class="col-sm-6 logo">
                    <a href="<?php bloginfo('siteurl'); ?>/"
                       title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" class="img-responsive">
                    </a>
                </div>
                <div class="col-sm-6 text-right contact">
                    <p>
                        <?php $facebook = get_option('wood_facebook'); if ($facebook) { ?>
                        <a href="<?php echo esc_attr($facebook); ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/facebook.png"></a>
                        <?php } ?>
                        <?php $instagram = get_option('wood_instagram'); if ($instagram) { ?>
                        <a href="<?php echo esc_attr($instagram); ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/instagram.png"></a>
                        <?php } ?>
                    </p>
                    <?php $tel = get_option('wood_tel'); if ($tel) { ?>
                    <h3>
                        <a href="tel:<?php echo esc_attr($tel); ?>"><?php echo esc_attr($tel); ?></a>
                    </h3>
                    <?php } ?>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse-1"><span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php bloginfo('siteurl'); ?>/"
                       title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo-sm.png" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" class="img-responsive">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <?php wp_nav_menu(array('menu' => 'primary', 'items_wrap' => '<ul class="nav navbar-nav navbar-right" role="menu">%3$s</ul>', 'container' => false)); ?>
                </div>
            </div>
        </nav>

    </header>
    <!-- #head -->
