# news-site
各ページ内容（追加内容）：


TOPページ（front-page.php)：
  1. header.phpとfooter.phpの読み込み
  2. 新着記事を3記事表示
  3. ループ内での記事の投稿日時とタイトル取得
  4. 記事一覧ページへのリンク
     
記事一覧ページ（archive.php）：
  1. header.phpとfooter.phpの読み込み
  2. 新着記事をすべて表示
  3. ループ内での記事の投稿日時、タイトル、サムネイルが設定されていたらサムネイル、カテゴリー名、記事内容（110字まで）、記事へのリンク取得


記事詳細ページ（single.php）：
  1. header.phpとfooter.phpの読み込み
  2. 記事の投稿日時、タイトル、サムネイルが設定されていたらサムネイル、カテゴリー名、記事内容表示
  3. TOPページへのリンク

     
functions.php：
  1. css, jsファイルの読み込み
  2. サムネイル設定オン
  3. archive.phpのURLを/newsに
