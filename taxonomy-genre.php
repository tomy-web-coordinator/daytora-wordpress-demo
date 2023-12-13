<?php get_header(); ?>
<!-- main-visual -->
<div class="mainvisual">
    <div class="inner">
        <div class="mainvisual-content">
            <div class="mainvisual-title">制作実績</div>
        </div>
    </div><!-- /inner -->
</div><!-- /main-visual -->

<div class="work-breadcrumb">
    <div class="inner">
        <!-- breadcrumb -->
        <?php if (function_exists('bcn_display')) : ?>
            <!-- breadcrumb -->
            <div class="breadcrumb">
                <?php bcn_display(); ?>
            </div><!-- /breadcrumb -->
        <?php endif; ?>
    </div><!-- /inner -->
</div><!-- /work-breadcrumb -->


<!-- content -->
<div id="content" class="content-work">
    <div class="inner">

        <!-- primary -->
        <main id="primary">

            <div class="genre-nav">
                <div class="genre-nav-link"><a href="<?php echo get_post_type_archive_link('work'); ?>">すべて</a></div>
                <?php
                $current_genre = get_queried_object();
                if (is_a($current_genre, 'WP_Term') && $current_genre->taxonomy === 'genre') {
                    $current_genre_name = $current_genre->name;
                } else {
                    $current_genre_name = '';
                }
                ?>
                <?php $genre_terms = get_terms('genre', array('hide_empty' => false)); ?>
                <?php foreach ($genre_terms as $genre_term) : ?>
                    <div class="genre-nav-link">
                        <a class="<?php if ($current_genre_name === esc_html($genre_term->name)) echo 'is-active'; ?>" href="<?php echo get_term_link($genre_term, 'genre'); ?>">
                            <?php echo $genre_term->name; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div><!-- /genre-nav -->


            <!-- entries -->
            <div class="entries entries-work">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="entry-item entry-item-horizontal">
                            <div class="entry-item-img">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail(); ?>
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/noimg.png" alt="">
                                <?php endif; ?>
                            </div>
                            <div class="entry-item-body">
                                <div class="entry-item-meta">
                                    <div class="entry-item-tag"><?php echo get_the_terms(get_the_ID(), 'genre')[0]->name; ?></div>
                                </div>
                                <div class="entry-item-title"><?php the_title(); ?></div>
                                <div class="entry-item-excerpt">
                                    <?php
                                    $overview = get_field('overview');
                                    if (mb_strlen($overview, 'UTF-8') > 40) {
                                        echo mb_substr($overview, 0, 40, 'UTF-8') . '...'; // 40文字で切り捨て、"..."を追加
                                    } else {
                                        echo $overview; // 40文字以下の場合はそのまま表示
                                    }
                                    ?>
                                </div>
                            </div><!-- /entry-item-body -->
                        </a><!-- /entry-item -->
                    <?php endwhile; ?>
                <?php endif; ?>
            </div><!-- /entries -->


            <?php get_template_part('template-parts/pagination'); ?>
        </main><!-- /primary -->

    </div><!-- /.inner -->
</div><!-- /.content -->

<?php get_footer(); ?>