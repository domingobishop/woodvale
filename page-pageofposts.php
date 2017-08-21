<?php
/**
 * Template Name: Page of posts
 *
 */
get_header(); ?>

    <div id="content" class="page-of-posts">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="entry-header">
                        <?php if (is_home() && get_option('page_for_posts')) { ?>
                            <h1><?php echo apply_filters('the_title', get_page(get_option('page_for_posts'))->post_title); ?></h1>
                        <?php } elseif (is_singular()) { ?>
                            <h1><?php the_title(); ?></h1>
                            <?php while (have_posts()) : the_post(); ?>
                            <?php endwhile; ?>
                        <?php } ?>
                    </div>

                    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
                        'posts_per_page' => get_option('posts_per_page'),
                        'paged' => $paged,
                        'category_name' => get_the_title(),
                        'post_status' => array('publish', 'future'),
                        'orderby' => 'publish_date',
                        'order' => 'DESC'
                    );
                    query_posts($args); ?>
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" class="row">
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <?php if (has_post_thumbnail() && !post_password_required() && !is_attachment()) : ?>
                                        <div class="entry-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('thumbnail', array('class' => 'img-responsive')); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-8 col-md-8 col-lg-8">
                                    <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark">
                                            <?php the_title(); ?>
                                        </a></h3>
                                    <small><?php the_date('F j, Y'); ?></small>
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
                            <li class="previous"><?php next_posts_link(__('&#8249; Older posts', 'blankcanvas')); ?></li>
                            <li class="next"><?php previous_posts_link(__('Newer posts &#8250;', 'blankcanvas')); ?></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>