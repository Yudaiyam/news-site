<?php get_header(); ?>
<div class="info">
    <div class="info__inner">
        <!-- カテゴリーのタブ切替ここから -->
        <div class="tab__container">
            <a href="<?php echo esc_url(home_url('/news')); ?>" class="tab selected">全て</a>
            <?php
            $cats = get_categories();
            foreach ($cats as $cat) {
                $category_link = esc_url(get_category_link($cat->term_id)); // URLをエスケープ
                $category_name = esc_html($cat->name); // カテゴリー名をエスケープ
                echo '<a href="' . $category_link . '" class="tab">' . $category_name . '</a>';
            }
            ?>
        </div>
        <!-- カテゴリーのタブ切替ここまで -->
        <?php
        // get_query_var('paged')と参考演算子*
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'paged' => $paged,
            'posts_per_page' => 2,
            'post_type' => 'post',
        );
        $query = new WP_Query($args);
        if($query->have_posts()){
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="test__wrapper">
                <h2 class="test__title"><?php echo cfs()->get('title'); ?></h2>
                <div class="test__container">
                    <?php
                    $img_main = cfs()->get('img_main');
                    if ($img_main) {
                        echo '<div class="test__image"><img src="' . $img_main . '" alt="' . cfs()->get('title') . '"/></div>';
                    } else {
                        $img_sample = get_template_directory_uri() . "/img/sample.jpg";
                        echo '<div class="test__image"><img src="' . $img_sample . '" alt="' . cfs()->get('title') . '" /></div>';
                    }
                    ?>
                    <div class="test__block">
                        <div class="test__list">
                            <?php
                            $cats = get_the_category();
                            foreach ($cats as $cat) {
                                echo '<p class="list__title">' . $cat->name . '</p>';
                            }
                            ?>
                            <p class="list__date">
                                <?php echo get_the_date(); ?>
                            </p>
                        </div>
                        <div class="test__text">
                            <?php
                            $text_main = cfs()->get('text_main');
                            if (!empty($text_main)) {
                                $trimmed = wp_trim_words($text_main, 110);
                                echo '<p>' . $trimmed . '</p>';
                            }
                            ?>
                        </div>
                        <a href="<?php esc_url(the_permalink()); ?>" class="test__button">続きを読む</a>
                    </div>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
    }
        // ページネーションここから
        echo '<div class="pagination">';
        // max_num_pages = （サイト内の投稿数）/ (posts_per_pageで設定した数)
        $total_pages = $query->max_num_pages;
        if ($total_pages > 1) {
            // ページネーション作成関数
            echo paginate_links(array(
                'total' => $total_pages,
                'current' => $paged,
                'mid_size' => 2,
                'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
                'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
            ));
        }
        ?>
        </div>
        <!-- ページネーションここまで -->
    </div>
</div>
<?php get_footer(); ?>

<!-- ※ -->
<!-- get_query_var('paged')は、現在のページ番号を取得するWordPressの関数です。WordPressではページネーションのためにpagedというクエリパラメータが使用されます。この関数は、URLなどからpagedパラメータの値を取得し、その値を返します。 -->
<!-- 次に、三項演算子が使われています。
これは条件式が真であれば最初の値を、偽であれば二番目の値を返します。具体的には、get_query_var('paged')が存在すればその値を、存在しなければ1を返します。
つまり、現在のページ番号を取得し、もし存在しなければ1をデフォルトとして使います。 -->
<!-- したがって、$paged変数には現在のページ番号が代入されます。これを使って、ページネーションを表示するために必要なページ番号を指定することができます。 -->