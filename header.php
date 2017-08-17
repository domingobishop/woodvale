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
    <header id="head" class="head">

        <div class="branding">
            <div class="container">
                <div class="col-md-8 logo">
                    <a href="<?php bloginfo('siteurl'); ?>/"
                       title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" class="img-responsive">
                    </a>
                </div>
                <div class="col-md-4 text-right contact">
                    <p>
                        <a href="<?php echo get_option('home_facebook'); ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/facebook.png"></a>
                        <a href="<?php echo get_option('home_instagram'); ?> target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/instagram.png"></a>
                    </p>
                    <p>
                        <?php echo get_option('home_contact'); ?>
                    </p>
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
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <?php wp_nav_menu(array('menu' => 'primary', 'items_wrap' => '<ul class="nav navbar-nav navbar-right" role="menu">%3$s</ul>', 'container' => false)); ?>
                </div>
            </div>
        </nav>

    </header>
    <!-- #head -->
