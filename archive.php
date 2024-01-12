<?php get_header();?>
<div class="info">
      <div class="info__inner">
        <div class="info__title">新着情報</div>
            <?php 
                $args = array(
                    'post_per_page' => '-1',
                    'post_type' => 'post',
                );
                $query = new WP_Query($args);
                if($query->have_posts()){
                    while($query->have_posts()){
                        $query->the_post(); ?>
                        <div class="test__wrapper">
                            <h2 class="test__title"><?php the_title();?></h2>
                            <div class="test__container">
                                <div class="test__image">
                                    <?php echo the_post_thumbnail();?>
                                </div>
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
                                    <?php the_content(); ?>
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