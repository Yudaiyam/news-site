<?php get_header(); ?>
    <div class="container">
        <h2 class="title">新着情報</h2>
                <p class="subtitle">news</p>
                <!-- サブループ*1*2 -->
        <?php 
        $args = array(
            'posts_per_page' => 3, //投稿を3件表示
            'post_type' => 'post', //投稿タイプを設定
            'orderby' => 'date',  //順序の基準（投稿日時）
            'order' => 'DESC',  //降順か昇順か（DESCは降順、ASCが昇順）
        );
        $query = new WP_Query($args); //WP_Query関数で$argsのパラメータに基づいた投稿データ取得
        if($query->have_posts()){
            while($query->have_posts()){
                $query->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="news__block">
                    <p class="news__date"><?php echo get_the_date(); ?></p>
                    <p class="news__title"><?php the_title();?></p>
                </a>
          <?  }
          wp_reset_postdata();
        } ?>
        <!-- home_url関数を使ったページ遷移とエスケープ処理*3 -->
      <a href="<?php echo esc_url(home_url('/news')); ?>" class="news__button">news一覧</a>
    </div>
<?php get_footer(); ?>

<!-- ※1 メインループとサブループとは？ -->
<!-- メインループは、ウェブサイトのホームページやアーカイブページなど、基本的なページで表示されるコンテンツを決定します。WordPressでは、メインループは自動的に実行され、ページのコンテンツを表示するための投稿データを取得します。これにより、ウェブサイトのホームページに表示される最新の記事やページなどが表示されます。
サブループは、メインループの中で特定の場所や条件で追加のコンテンツを表示するために使用されます。WordPressでは、サブループは通常、特定の条件に基づいてカスタムクエリを使用して追加の投稿データを取得することによって作成されます。例えば、特定のカテゴリの記事を表示したり、特定のタグが付いている記事を表示したりする場合に使われます。 -->


<!-- ※2 サブループで取得した情報のリセット -->
<!-- WordPressのwp_reset_postdata()関数は、サブループ内で取得した投稿データを元の状態に戻すためのものです。これを理解するためには、WordPressでの投稿データの取得方法と、サブループの動作について知っておく必要があります。
WordPressでは、WP_Queryなどの関数を使って投稿データを取得することができます。しかし、サブループ内で新しいクエリを実行して投稿データを取得した場合、元のクエリで取得した投稿データが置き換わってしまいます。つまり、メインのページで取得した投稿データが、サブループ内での取得によって上書きされてしまう可能性があります。
wp_reset_postdata()関数は、こうした問題を解決するために使われます。具体的には、サブループで新しいクエリを使って取得した投稿データを使い終わった後に、元のクエリが参照する投稿データを再びメインの状態に戻します。つまり、サブループ内での投稿データの操作が終わった時点で、wp_reset_postdata()を呼び出すことで、元の投稿データに戻るように設定されます。 -->


<!-- ※3 エスケープ処理とは？ -->
<!-- esc_url() は URL のプロトコルのチェックや適切でない文字をエスケープ（または除去）して、URL を無害化します。URL を文字列で出力する場合や、URL を指定可能な属性（href や src）に値を出力する場合などで使用します。-->
<!-- 詳しくはこちらのサイトを参照 -->
<!-- https://www.webdesignleaves.com/pr/wp/wp_escape_functions.html -->