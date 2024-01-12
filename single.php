<?php get_header(); ?>
<?php
    if(have_posts()){
        while(have_posts()){
            the_post(); ?>
            <div class="test01">
                <div class="test01__inner">
                    <div class="test01__title">新着情報</div>
                        <div class="test01__wrapper">
                            <h2 class="test01__main"><?php the_title();?></h2>
                            <div class="test01__container">
                            <?php 
if (has_post_thumbnail()) {
    echo '<div class="test01__img">' . get_the_post_thumbnail() . '</div>';
} 
?>
                            
                                <div class="test01__block">
                                    <div class="test01__list">
                                            <?php
                                            $cats = get_the_category();
                                            foreach ($cats as $cat){
                                                echo '<p class="list01__title">' . $cat->name .'</p>';
                                            } ?>
                                        <p class="list01__date"><?php echo get_the_date();?></p>
                                    </div>
                                    <div class="test01__text">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo home_url('/');?>" class="test01__button">TOPに戻る</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        wp_reset_postdata();
    }
?>
<?php get_footer(); ?>