<?php
setlocale(LC_ALL, 'fr_CA');

$pageNum = isset($_GET['page']) ? $_GET['page']-1 : 0;
$pageSize = 50;

$data = new SQLiteDatabase('data/data.sqlite');
$page = $data->query('SELECT * FROM haikus ORDER BY date DESC LIMIT '.$pageSize.' OFFSET '.$pageNum*$pageSize)->fetchAll();
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
<head>
  <meta charset="UTF-8">

  <title>Jidéku.</title>
  <link rel="stylesheet" href="public/styles.css">
</head>
<body>
<?php foreach ($page as $haiku) : ?>
  <article>
    <blockquote><?= $haiku['text'] ?></blockquote>
    <p>// dans <a href="<?= $haiku['uri'] ?>"><?= $haiku['title'] ?></a></p>
  </article>
<?php endforeach; ?>

  <footer>
    <p><a href="https://twitter.com/jdqhaiku">Twitter</a></p>
    <p><small>Extraits des textes © <a href="http://www.journaldequebec.com/">Le Journal de Québec</a> et leurs auteurs respectifs.</small></p>
  </footer>
</body>
</html>