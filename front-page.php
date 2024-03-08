<?php get_header(); ?>
    <div class="container">
        <h2 class="title">新着情報</h2>
                <p class="subtitle">news</p>
        <?php 
        $args = array(
            'posts_per_page' => 3,
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $query = new WP_Query($args);
        if($query->have_posts()){
            while($query->have_posts()){
                $query->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="news__block">
                    <p class="news__date"><?php echo get_the_date(); ?></p>
                    <!-- Custom Field Suiteの値の取得* -->
                    <p class="news__title"><?php echo cfs()->get('title'); ?></p>
                </a>
          <?  }
          wp_reset_postdata();
        } ?>
      <a href="<?php echo esc_url(home_url('/news')); ?>" class="news__button">news一覧</a>
    </div>
<?php get_footer(); ?>

<!-- ※ -->
<!-- 以前はSmart Custom Fieldというプラグインを使用していましたが、これにはループが作成できるメリットがある反面、開発がすでに終了しているというデメリットもありました。
そこで使用しているプラグインをSmart Custom FieldからCustom Field Suiteに変更しました。
このプラグインはループも作成でき、現在も開発が進められています。
この変更に伴い、管理画面 > 投稿ページのカスタムフィールドで設定した値を取得するための関数が"SCF"から"csf"に変更になります。 -->
<!-- Custom Field Suiteの詳しい使い方については以下のサイトを参照 -->
<!-- https://www.itti.jp/web-design/how-to-display-custom-field-suite/ -->