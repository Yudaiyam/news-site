<?php 
    function enqueue_font_awesome() {
        wp_enqueue_style(
            'font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
            array(),
            '6.5.1',
            'all'
        );
    }
    add_action('wp_enqueue_scripts', 'enqueue_font_awesome');
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

    function setup_theme() {
        add_theme_support('post-thumbnails');
    }
    add_action('after_setup_theme', 'setup_theme');

    function post_has_archive( $args, $post_type ) {
        if ( 'post' == $post_type ) {
        $args['rewrite'] = true;
        $args['label'] = 'お知らせ';
        $args['has_archive'] = 'news';
        }
        return $args;
        }
        add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );

        // パンくずリストの「一覧ページ」カスタマイズここから
        function override_yoast_breadcrumb($links)
        {
          if (!is_page()) {
            $news_url = home_url('/news');
            $add_link[] = array('text' => 'お知らせ一覧', 'url' => $news_url);
            array_splice($links, 1, 0, $add_link);
          }
          return $links;
        }
        add_filter('wpseo_breadcrumb_links', 'override_yoast_breadcrumb');
        // パンくずリストの「一覧ページ」カスタマイズここまで