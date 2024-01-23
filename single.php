<?php get_header(); ?>
<?php
    if(have_posts()){
        while(have_posts()){
            the_post(); ?>
            <div class="test01">
                <div class="test01__inner">
                    <div class="test01__title">新着情報</div>
                        <div class="test01__wrapper">
                            <h2 class="test01__main"><?php echo SCF::get('title'); ?></h2>
                            <!-- サムネイル画像が設定されていたらサムネイル画像を、設定されてなければsample.jpgを -->
                            <?php
                                $img_main = SCF::get('main_img');
                                if($img_main){
                                    echo '<div class="test01__img">' . wp_get_attachment_image($img_main, 'large') . '</div>';
                                }else{
                                    $img_src = get_template_directory_uri() . "/img/sample.jpg";
                                    echo '<div class="test01__img"><img src="' . $img_src . '" /></div>';
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
                                        <?php echo SCF::get('content-paragraph'); ?>
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