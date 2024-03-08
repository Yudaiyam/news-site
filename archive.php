<?php get_header();?>
<div class="info">
      <div class="info__inner">
        <div class="info__title">新着情報</div>
        <!-- サブループ -->
            <?php 
                $args = array(
                    'posts_per_page' => -1, //-1で全投稿表示
                    'post_type' => 'post',
                    'orderby' => 'date',
                    'order' => 'DESC',
                );
                $query = new WP_Query($args);
                if($query->have_posts()){
                    while($query->have_posts()){
                        $query->the_post(); ?>
                        <div class="test__wrapper">
                            <h2 class="test__title"><?php the_title();?></h2>
                            <div class="test__container">
                                <!-- サムネイル画像が設定されていたらサムネイル画像を、設定されてなければsample.jpgを -->
                                <?php
                                if(has_post_thumbnail()){
                                    echo '<div class="test__image">' . get_the_post_thumbnail() . '</div>';
                                }else{
                                    $img_src = get_template_directory_uri() . "/img/sample.jpg";
                                    echo '<div class="test__image"><img src="' . $img_src . '" /></div>';
                                }
                                ?>
                                <div class="test__block">
                                <div class="test__list">
                                    <!-- カテゴリー情報の取得ここから -->
                                    <?php
                                        $cats = get_the_category();
                                        foreach ($cats as $cat){
                                            echo '<p class="list__title">'. $cat->name . '</p>';
                                        }
                                    ?>
                                    <!-- カテゴリー情報の取得ここまで -->
                                    <p class="list__date">
                                        <?php echo get_the_date(); ?>
                                    </p>
                                </div>
                                <div class="test__text">
                                    <?php the_excerpt(); ?> <!-- 110字だけ投稿内容表示 -->
                                </div>
                                <a href="<?php the_permalink(); ?>" class="test__button">続きを読む</a>
                                </div>
                            </div>
                            </div>
                    <?php
                    }
                    wp_reset_postdata();
                }
                ?>
      </div>
    </div>
<?php get_footer();?>