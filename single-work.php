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
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : ?>
                    <?php the_post(); ?>

                <?php endwhile; ?>
            <?php endif; ?>

            <!-- entry -->
            <article class="entry entry-work">

                <!-- entry-header -->
                <div class="entry-header">
                    <?php $genre_term =  get_the_terms(get_the_ID(), 'genre')[0]; ?>
                    <div class="entry-label"><a href="<?php echo get_term_link($genre_term, 'genre'); ?>"><?php echo $genre_term->name; ?></a></div>
                    <h1 class="entry-title"><?php the_title(); ?></h1>

                    <div class="entry-img">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail(); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/noimg.png" alt="">
                        <?php endif; ?>
                    </div>
                </div><!-- /entry-header -->

                <div class="entry-work-body">
                    <div class="entry-work-content">
                        <!-- advanced-custom-fieldのプラグインを使って表示させる -->
                        <?php the_field('overview'); ?>
                    </div>
                    <div class="entry-work-table">
                        <table>
                            <!-- <tr>の上下をifで囲んでいる理由としては、空白の場合は行ごと非表示にするという処理のため -->
                            <?php if (get_field('company')) : ?>
                                <tr>
                                    <th>会社名</th>
                                    <td><?php the_field('company'); ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <?php if (get_field('url')) : ?>
                                    <th>サイトURL</th>
                                    <td><?php the_field('url'); ?>
                                    </td>
                            </tr> <?php endif; ?>
                        <?php if (get_field('position')) : ?>
                            <tr>
                                <th>担当範囲</th>
                                <td><?php the_field('position'); ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </table>
                    </div><!-- /entry-work-table -->
                </div><!-- /entry-work-body" -->

                <div class="entry-work-btn">
                    <a class="btn" href="<?php echo get_post_type_archive_link('work'); ?>">一覧に戻る</a>
                </div><!-- /entry-work-btn -->

                <!-- 同じ制作ジャンルの中から現在の投稿を除いて、他の記事をランダムで3つ関連記事として表示させる処理 -->
                <?php
                $related_query = new WP_Query(
                    array(
                        'post_type' => 'work',
                        'posts_per_page' => 3,
                        'post__not_in' => array($post->ID),
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'genre',
                                'field' => 'id',
                                'terms' => wp_get_post_terms($post->ID, 'genre', array("fields" => "ids"))
                            )
                        ),
                        'orderby' => 'rand'
                    )
                );
                ?>
                <?php if ($related_query->have_posts()) : ?>
                    <div class="entry-work-related">
                        <div class="entry-work-related-head">関連記事</div><!-- /.entry-work-related-head -->
                        <div class="entries entries-work entry-work-related-entries">
                            <?php while ($related_query->have_posts()) : ?>
                                <?php $related_query->the_post(); ?>

                                <!-- entry-item -->
                                <a href="<?php the_permalink(); ?>" <?php post_class(array('entry-item', 'entry-item-horizontal')); ?>>

                                    <!-- entry-item-img -->
                                    <div class="entry-item-img">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            the_post_thumbnail('my_thumbnail');
                                        } else {
                                            echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/noimg.png" alt="">';
                                        }
                                        ?>
                                    </div><!-- /entry-item-img -->

                                    <!-- entry-item-body -->
                                    <div class="entry-item-body">
                                        <div class="entry-item-meta">
                                            <div class="entry-item-tag"><?php echo esc_html(get_the_terms(get_the_ID(), 'genre')[0]->name); ?></div><!-- /entry-item-tag -->
                                        </div><!-- /entry-item-meta -->
                                        <h2 class="entry-item-title"><?php the_title(); ?></h2><!-- /entry-item-title -->
                                    </div><!-- /entry-item-body -->

                                </a><!-- /entry-item -->

                            <?php endwhile; ?>
                        </div><!-- /.entry-work-related -->
                    </div><!-- /.entry-work-related-entries -->
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>

            </article><!-- /entry -->

        </main><!-- /primary -->

    </div><!-- /inner -->
</div><!-- /content -->

<?php get_footer(); ?>