<?php
get_header();
?>
<div class="info">
    <div class="info__inner">
        <div class="tab__container">
            <a href="<?php echo home_url('/news'); ?>" class="tab">全て</a>
            <?php
            $cats = get_categories();
            foreach ($cats as $cat) {
                $current_cat_class = '';
                if (is_category($cat->term_id)) {
                    $current_cat_class = ' selected';
                }
                echo '<a href="' . get_category_link($cat->term_id) . '" class="tab' . $current_cat_class . '">' . $cat->name . '</a>';
            }
            ?>
        </div>
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'posts_per_page' => 2,
            'post_type' => 'post',
            'paged' => $paged,
            'cat' => get_query_var('cat'),
        );
        $posts_category = new WP_Query($args);

        if ($posts_category->have_posts()) {
            while ($posts_category->have_posts()) {
                $posts_category->the_post();
                ?>
                <div class="test__wrapper">
                    <h2 class="test__title"><?php echo SCF::get('title'); ?></h2>
                    <div class="test__container">
                        <?php
                        $img_main = SCF::get('main_img');
                        if ($img_main) {
                            echo '<div class="test__image">' . wp_get_attachment_image($img_main, 'large') . '</div>';
                        } else {
                            $img_src = get_template_directory_uri() . "/img/sample.jpg";
                            echo '<div class="test__image"><img src="' . $img_src . '" /></div>';
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
                                $paragraph = SCF::get('content-paragraph');
                                if (!empty($paragraph)) {
                                    $trimmed = wp_trim_words($paragraph, 110);
                                    echo '<p>' . $trimmed . '</p>';
                                }
                                ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="test__button">続きを読む</a>
                        </div>
                    </div>
                </div>
                <?php
            }

            // ページネーションの表示
            echo '<div class="pagination">';
            $total_pages = $posts_category->max_num_pages;
            if ($total_pages > 1) {
                echo paginate_links(array(
                    'total' => $total_pages,
                    'current' => $paged,
                    'mid_size' => 2,
                    'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
                    'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
                ));
            }
            echo '</div>';

            wp_reset_postdata();
        } else {
            echo '<p>まだ投稿がありません。</p>';
        }
        ?>
    </div>
</div>
<?php get_footer(); ?>
