<?php
/**
 * Template Name: Home page
 *
 */
get_header(); ?>

    <?php while (have_posts()) : the_post(); ?>
    <?php if ( has_post_thumbnail() ) {
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
        <div class="banner" role="banner" style="background-image: url(<?php echo $thumbnail_src[0]; ?>);">
    <?php } else { ?>
        <div class="banner" role="banner">
    <?php } ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </div>
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
                                <img src="<?php echo esc_attr(get_option('promo_img_'.$i)); ?>" class="img-responsive img-circle">
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