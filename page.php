<?php get_header(); ?>

<!-- content -->
<div id="content" class="m_one">
    <div class="inner">

        <!-- primary -->
        <main id="primary">

            <?php if (function_exists('bcn_display')) : ?>
                <!-- breadcrumb -->
                <div class="breadcrumb">
                    <?php bcn_display(); ?>
                </div><!-- /breadcrumb -->
            <?php endif; ?>


            <!-- entry -->
            <article class="entry m_page">

                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>
                        <!-- entry-header -->
                        <div class="entry-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1><!-- /entry-title -->
                            <div class="entry-img"><?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail(); ?>
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/noimg.png" alt="">
                                <?php endif; ?>
                            </div><!-- /entry-img -->
                        </div><!-- /entry-header -->

                        <!-- entry-body -->
                        <div class="entry-body">
                            <?php the_content(); ?>
                        </div><!-- /entry-body -->
                    <?php endwhile; ?>
                <?php endif; ?>

            </article><!-- /entry -->
        </main><!-- /primary -->

        <!-- secondary -->

        <?php get_sidebar(); ?>


    </div><!-- /inner -->
</div><!-- /content -->
<?php get_footer(); ?>