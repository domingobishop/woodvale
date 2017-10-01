<?php get_header(); ?>

    <?php while (have_posts()) : the_post(); ?>
    <main id="main" class="main" role="main">
        <div id="content" class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-header">
                                <h1>
                                    <?php the_title(); ?>
                                </h1>
                            </div>
                            <div class="entry-content row">
                                <div class="col-md-8">
                                    <?php the_content(); ?>
                                </div>
                                <div class="col-md-4">
                                    <?php
                                    if (has_post_thumbnail() && !post_password_required() && !is_attachment()) {
                                        the_post_thumbnail('medium', array('class' => 'img-responsive'));
                                    }
                                    ?>
                                </div>
                            </div>
                        </article>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>


<?php get_footer(); ?>