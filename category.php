<?php get_header();?>
<div class="info">
      <div class="info__inner">
        <div class="info__title">新着情報</div>
        <div class="tab__container">
            <a href="<?php echo home_url('/news'); ?>" class="tab">全て</a>
            <?php
            $cats = get_categories();
            foreach ($cats as $cat){
                $current_cat_class = '';
                if(is_category($cat->term_id)){
                    $current_cat_class = ' selected';
                }
                echo '<a href="' . get_category_link($cat->term_id) . '" class="tab' . $current_cat_class . '">' . $cat->name . '</a>';
            }
            ?>
        </div>
            <?php 
                if(have_posts()){
                    while(have_posts()){
                        the_post(); ?>
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
                                    <?php
                                        $cats = get_the_category();
                                        foreach ($cats as $cat){
                                            echo '<p class="list__title">'. $cat->name . '</p>';
                                        }
                                    ?>
                                    <p class="list__date">
                                        <?php echo get_the_date(); ?>
                                    </p>
                                </div>
                                <div class="test__text">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="test__button">続きを読む</a>
                                </div>
                            </div>
                            </div>
                    <?php
                    }
                }
                ?>
      </div>
    </div>
<?php get_footer();?>