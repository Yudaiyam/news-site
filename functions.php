<?php 
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
?>