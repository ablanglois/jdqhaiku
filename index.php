<?php
setlocale(LC_ALL, 'fr_CA');

$pageNum = isset($_GET['page']) ? $_GET['page']-1 : 0;
$pageSize = 50;

$data = new SQLiteDatabase('data/data.sqlite');
$page = $data->query('SELECT * FROM haikus ORDER BY date DESC LIMIT '.$pageSize.' OFFSET '.$pageNum*$pageSize)->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">

  <title>JI|DE|KU</title>
  <link rel="stylesheet" href="public/styles.css">
</head>
<body>
  <header>
    <h1><a href="index.php">
      JI•••<br>
      DE•••••<br>
      KU•••
    </a></h1>
    <nav>
      <a href="quoi.html">De kessé?</a>
      <a class="icon" href="https://twitter.com/jdqhaiku" title='Suivez JI|DE|KU sur Twitter'></a>
      <a class="icon" href="feed.php" title='Abonnez-vous au fil de nouvelles'></a>
    </nav>
  </header>
<?php foreach ($page as $haiku) : ?>
  <article>
    <blockquote><p><?= $haiku['text'] ?></p></blockquote>
    <h1>— Tiré de <a href="<?= $haiku['uri'] ?>"><?= $haiku['title'] ?></a></h1>
  </article>
<?php endforeach; ?>

  <footer>
    <p><small>
      Extraits des textes © <a href="http://www.journaldequebec.com/">Le Journal de Québec</a> et leurs auteurs respectifs.<br>
      JI|DE|KU n’est d’aucune manière affilié au Journal de Québec, à Québécor Média ou à toute autre de ses propriétés intellectuelles.</small></p>
  </footer>
</body>
</html>