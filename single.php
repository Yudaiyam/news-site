<?php get_header(); ?>
<?php
    if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
    }
?>
<?php
    if(have_posts()){
        while(have_posts()){
            the_post(); ?>
            <div class="test01">
                <div class="test01__inner">
                    <div class="test01__wrapper">
                        <h2 class="test01__main"><?php echo cfs()->get('title'); ?></h2>
                        <!-- サムネイル画像が設定されていたらサムネイル画像を、設定されてなければsample.jpgを -->
                        <?php
                        $img_main = cfs()->get('img_main');
                        if ($img_main) {
                            echo '<div class="test__image"><img src="' . $img_main . '" alt="' . cfs()->get('title') . '"/></div>';
                        } else {
                            $img_sample = get_template_directory_uri() . "/img/sample.jpg";
                            echo '<div class="test__image"><img src="' . $img_sample . '" alt="' . cfs()->get('title') . '" /></div>';
                        }
                        ?>
                        <div class="test01__container">
                            <div class="test01__block">
                                <div class="test01__list">
                                        <!-- カテゴリー -->
                                        <?php
                                        $cats = get_the_category();
                                        foreach ($cats as $cat){
                                            echo '<p class="list01__title">' . $cat->name .'</p>';
                                        } ?>
                                    <p class="list01__date"><?php echo get_the_date();?></p>
                                </div>
                                <div class="test01__text">
                                    <?php 
                                    $text_main = cfs()->get('text_main');
                                    echo nl2br($text_main);
                                     ?>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo esc_url(home_url('/'));?>" class="test01__button">TOPに戻る</a>
                    </div>
                </div>
            </div>
        <?php
        }
        wp_reset_postdata();
    }
?>
<?php get_footer(); ?>