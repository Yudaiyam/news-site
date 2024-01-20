<?php get_header(); ?>
    <div class="container">
        <h2 class="title">新着情報</h2>
                <p class="subtitle">news</p>
        <?php 
        $args = array(
            'post_per_page' => '3',
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
                    <p class="news__title"><?php the_title();?></p>
                </a>
          <?  }
        } ?>
      <a href="<?php echo home_url('/news'); ?>" class="news__button">news一覧</a>
    </div>
<?php get_footer(); ?>