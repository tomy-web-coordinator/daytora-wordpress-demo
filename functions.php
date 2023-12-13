<?php
function my_setup()
{
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'));
}
add_action("after_setup_theme", "my_setup");

function my_script_init()
{
    wp_enqueue_style("font-awesome", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css", array(), "5.8.2", "all");
    wp_enqueue_style("my", get_template_directory_uri() . "/css/style.css", array(), filemtime(get_theme_file_path('css/style.css')), "all");
    wp_enqueue_script("my", get_template_directory_uri() . "/js/script.js", array("jquery"), filemtime(get_theme_file_path('js/script.js')), true);

    if (is_single()) {
        wp_enqueue_script("sns", get_template_directory_uri() . "/js/sns.js", array("jquery"), filemtime(get_theme_file_path('js/sns.js')), true);
    }
}
add_action("wp_enqueue_scripts", "my_script_init");

function my_menu_init()
{
    register_nav_menus(
        array(
            'global' => 'ヘッダーメニュー',
            'drawer' => 'ドロワーメニュー',
            'footer' => 'フッターメニュー'
        )
    );
}
add_action('init', 'my_menu_init');

function my_widget_init()
{
    register_sidebar(
        array(
            'name' => 'サイドバー',
            'id' => 'sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>'
        )
    );
}
add_action('widgets_init', 'my_widget_init');

/**
 * アーカイブタイトル書き換え
 */
function my_archive_title($title)
{

    if (is_category()) { // カテゴリーアーカイブの場合
        $title = single_cat_title('', false);
    } elseif (is_tag()) { // タグアーカイブの場合
        $title = single_tag_title('', false);
    } elseif (is_post_type_archive()) { // 投稿タイプのアーカイブの場合
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) { // タームアーカイブの場合
        $title = single_term_title('', false);
    } elseif (is_author()) { // 作者アーカイブの場合
        $title = get_the_author();
    } elseif (is_date()) { // 日付アーカイブの場合
        $title = '';
        if (get_query_var('year')) {
            $title .= get_query_var('year') . '年';
        }
        if (get_query_var('monthnum')) {
            $title .= get_query_var('monthnum') . '月';
        }
        if (get_query_var('day')) {
            $title .= get_query_var('day') . '日';
        }
    }
    return $title;
};
add_filter('get_the_archive_title', 'my_archive_title');

function my_the_post_category($anchor = true)
{
    $category = get_the_category();
    if ($category[0]) {
        if ($anchor) {
            echo '<a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->cat_name . '</a>';
        } else {
            echo $category[0]->cat_name;
        }
    }
}
/**
 * タグ取得
 */
function my_get_post_tags($id = 0)
{
    global $post;

    //引数が渡されなければ投稿IDを見るように設定
    if (0 === $id) {
        $id = $post->ID;
    }

    //タグ一覧を取得
    $tags = get_the_tags($id);

    if ($tags) {
        foreach ($tags as $tag) {
            echo '<div class="entry-tag-item"><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></div><!-- /entry-tag-item -->';
        }
    }
}

// // 検索結果から固定ページを除外する
function my_posts_search($search, $wp_query)
{
    if ($wp_query->is_search() && $wp_query->is_main_query() && !is_admin()) {
        $search .= "AND post_type = 'post'";
        return $search;
    }
    return $search;
}
add_filter('posts_search', 'my_posts_search', 10, 2);


// ショートコードということを認識させるための記述
function my_shortcode($attrs, $content = '')
{
    return '<div class="entry-btn"><a class="btn" href=" ' . $attrs['link'] . '">' . $content . '</a></div>';
}
add_shortcode('btn', 'my_shortcode');


// ショートコードでsidebarの検索部分を表示する
function my_searchform_shortcode($attrs, $content = '')
{
    return get_search_form(false);
}
add_shortcode('search-form', 'my_searchform_shortcode');

// 演習コンテンツの最下部に問い合わせボタンを追加する
function my_contact_btn_shortcode($attrs, $content = '')
{
    return '<div class="entry-btn"><a class="btn" href=" ' . $attrs['link'] . '">' . $content . '</a></div>';
}
add_shortcode('contact-btn', 'my_contact_btn_shortcode');
