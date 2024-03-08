<?php 
    // cssファイルの読み込みここから
    add_action( 'wp_enqueue_scripts', function(){
        wp_register_style(
            'reset_style',
            get_template_directory_uri() . '/css/reset.css',
            array(),
            '1.0',
        );
        wp_enqueue_style(
            'main_style',
            get_template_directory_uri() . '/css/style.css',
            array('reset_style'),
            '1.0'
        );
    });
    // cssファイルの読み込みここまで

    // サムネイル画像の表示ここから
    function setup_theme() {
        add_theme_support('post-thumbnails');
    }
    add_action('after_setup_theme', 'setup_theme');
    // サムネイル画像の表示ここまで

    // 管理画面のカスタマイズここから
    // ・管理画面の「投稿」ラベルを「お知らせ」に変更
    // ・archive.phpのスラッグを"news"に
    function post_has_archive( $args, $post_type ) {
        if ( 'post' == $post_type ) {
        $args['rewrite'] = true;
        $args['label'] = 'お知らせ';
        $args['has_archive'] = 'news';
        }
        return $args;
        }
        add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );
    // 管理画面のカスタマイズここまで
?>