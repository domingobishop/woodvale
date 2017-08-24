<?php
/**
 * Template Name: Home page
 *
 */
get_header(); ?>

    <div id="wood_carousel" class="banner carousel slide" data-ride="carousel" role="banner">
        <ol class="carousel-indicators">
            <li data-target="#wood_carousel" data-slide-to="0" class="active"></li>
            <li data-target="#wood_carousel" data-slide-to="1"></li>
            <li data-target="#wood_carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="item active" style="background-image: url(<?php echo esc_attr(get_option('slider_img_1')); ?>);"></div>
            <div class="item" style="background-image: url(<?php echo esc_attr(get_option('slider_img_2')); ?>);"></div>
            <div class="item" style="background-image: url(<?php echo esc_attr(get_option('slider_img_3')); ?>);"></div>
        </div>
    </div>
    <?php while (have_posts()) : the_post(); ?>
    <main id="main" class="main" role="main">
        <div id="content" class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="entry-header sr-only">
                                    <h1>
                                        <?php the_title(); ?>
                                    </h1>
                                </div>
                                <div class="entry-content">
                                    <?php the_content(); ?>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                </div>
                <div class="row promo-area">
                    <?php for ( $i=1 ; $i<=3 ; $i++ ) { ?>
                    <div class="col-md-4">
                        <a href="<?php echo esc_attr(get_option('promo_url_'.$i)); ?>">
                            <div class="promo-img">
                                <img src="<?php echo esc_attr(get_option('promo_img_'.$i)); ?>" class="img-responsive">
                            </div>
                            <div class="promo-text text-center">
                                <h3><?php echo esc_attr(get_option('promo_txt_'.$i)); ?></h3>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
    <div class="home-footer-banner" role="banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </div>


<?php get_footer(); ?>