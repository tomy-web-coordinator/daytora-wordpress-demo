<!-- secondary -->
<aside id="secondary">

    <!-- widget -->
    <div class="widget widget_text widget_custom_html">
        <div class="widget-title">プロフィール今は直書きのサイドバーが表示されています</div>

        <div class="wprofile">
            <div class="wprofile-img"><img src="<?php echo get_template_directory_uri(); ?>/img/profile.png" alt=""></div>
            <div class="wprofile-content">
                <p>
                    テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
                </p>
            </div>
            <!-- /wprofile-content -->
            <nav class="wprofile-sns">
                <div class="wprofile-sns-item m_twitter"><a href="" rel="noopener noreferrer" target="_blank"><i class="fab fa-twitter"></i></a></div>
                <div class="wprofile-sns-item m_facebook"><a href="" rel="noopener noreferrer" target="_blank"><i class="fab fa-facebook-f"></i></a></div>
                <div class="wprofile-sns-item m_instagram"><a href="" rel="noopener noreferrer" target="_blank"><i class="fab fa-instagram"></i></a></div>
            </nav>
        </div><!-- /wprofile -->
    </div><!-- /widget -->


    <!-- widget -->
    <div class="widget widget_search">
        <div class="widget-title">検索</div>
        <?php get_search_form(); ?>
    </div><!-- /widget -->


    <!-- widget -->
    <div class="widget widget_popular">
        <div class="widget-title">人気記事</div>
        <?php
        if (function_exists('wpp_get_mostpopular')) {
            wpp_get_mostpopular(array(
                'limit' => 5,
                'range' => 'lsat24hours',
                'thumbnail_width' => 680,
                'thumbnail_height' => 400,
                'stats_views' => 0,
                'wpp_start' => '<div class="wpost-items m_ranking">',
                'wpp_end' => '</div>',
                'post_html' => '<div class="wpost-item">
                <div class="wpost-item-img">{thumb}</div>
                <div class="wpost-item-body"><div class="wpost-item-title">{title}</div></div>
                </div>'
            ));
        }
        ?>

        <!-- widget -->
        <div class="widget widget_recent">
            <div class="widget-title">新着記事</div>
            <?php echo do_shortcode('[rpwe thumb_height="680" thumb_width="400" date="false" styles_default="false"]'); ?>
        </div><!-- /widget -->

        <div class="widget widget_archive">
            <div class="widget-title">アーカイブ</div>
            <ul>
                <?php wp_get_archives(); ?>
            </ul>
        </div><!-- /widget -->

</aside><!-- secondary -->