<?php
/**
 * Template Name: Page of posts
 *
 */
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <main id="main" class="main page-of-posts" role="main">
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
                        </article>
                    <?php endwhile; ?>
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
                        'posts_per_page' => get_option('posts_per_page'),
                        'paged' => $paged,
                        'category_name' => get_the_title(),
                        'post_status' => array('publish', 'future'),
                        'orderby' => 'publish_date',
                        'order' => 'DESC'
                    );
                    query_posts($args);
                    ?>
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" class="clearfix">
                                <?php if (has_post_thumbnail() && !post_password_required() && !is_attachment()) { ?>
                                    <div class="entry-thumbnail">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <?php the_post_thumbnail('thumbnail', array('class' => 'img-responsive')); ?>
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <div class="entry-thumbnail">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/watermark.png" class="no-img img-responsive">
                                        </a>
                                    </div>
                                <?php } ?>
                                <div class="entry-content">
                                    <h3 class="entry-title">
                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <div class="entry-summary">
                                        <?php echo excerpt(21); ?>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <h2>No content</h2>
                    <?php endif; ?>
                        <nav class="pager">
                            <ul>
                                <li class="previous"><?php next_posts_link(__('&#8249; Older posts')); ?></li>
                                <li class="next"><?php previous_posts_link(__('Newer posts &#8250;')); ?></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php get_footer(); ?>