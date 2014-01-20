<?php
setlocale(LC_ALL, 'fr_CA');

$data = new SQLiteDatabase('data/data.sqlite');
$entries = $data->query('SELECT * FROM haikus ORDER BY date DESC LIMIT 10')->fetchAll();

header('Content-type: application/atom+xml; charset=utf-8');
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title>JI|DE|KU</title>
  <link href="http://dev.ablanglois.com/haiku/"/>
  <link href="http://dev.ablanglois.com/haiku/feed.php" rel="self" type="application/rss+xml"/>
  <updated><?= date('c') ?></updated>
  <author>
    <name>JI|DE|KU</name>
  </author>
  <id>https://twitter.com/jdqhaiku</id>

<?php foreach ($entries as $haiku) : ?>
  <entry>
    <title type="html"><![CDATA[<?= $haiku['title'] ?>]]></title>
    <id><?= $haiku['uri'] ?></id>
    <updated><?= $haiku['date'] ?></updated>
    <content type="html"><![CDATA[
      <blockquote><?= $haiku['text'] ?></blockquote>
      <p>— Tiré de <a href="<?= $haiku['uri'] ?>"><?= $haiku['title'] ?></a></p>
    ]]></content>
  </entry>
<?php endforeach; ?>

</feed>