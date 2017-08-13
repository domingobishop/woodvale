<?php get_header(); ?>

    <?php while (have_posts()) : the_post(); ?>
    <?php if ( has_post_thumbnail() ) {
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
        <div class="bc-banner" role="banner" style="background-image: url(<?php echo $thumbnail_src[0]; ?>);">
    <?php } else { ?>
        <div class="bc-banner" role="banner">
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
                    <div class="col-lg-8 col-lg-offset-2">
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="entry-header">
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
            </div>
        </div>
    </main>


<?php get_footer(); ?>