<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="index.css">
  <title>php練習（エディタ機能搭載）schooの動画を参考にしています。</title>
</head>
<body>
  <header>
    <div class="container">
      <h1>練習用ページ</h1>
      <p>とある動画の講座を参考に、見よう見まねで組んでます。
      <br>ページURLの後に　?__edit=kakiikada で、編集用の部分が出てくるプログラム。</p>
    </div>
  </header>
  <div class = "container main">
    <div class="center">
      <?php
      $template = '<div class="box">
                  <img src="{{img_path}}" alt="">
                  <h2>{{title}}</h2>
                  <p>{{body}}</p>
                  </div>';

    require_once('edit.php');
    $cms = new MyCMS\CMS($template,4);
    $cms -> render();
    ?>
    </div>
</div>
<footer>
  <a href="#top">ページトップへ</a>
</footer>
</body>
</html>
