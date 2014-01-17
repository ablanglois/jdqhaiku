<!DOCTYPE html>
<meta charset="UTF-8">
<?php
mb_internal_encoding("UTF-8");

require_once('jideku.php');

$feeds = array(
  'http://www.journaldequebec.com/actualite/rss.xml',
  'http://www.journaldequebec.com/arts-et-spectacles/rss.xml',
  'http://www.journaldequebec.com/vie/rss.xml',
  'http://www.journaldequebec.com/weekend/rss.xml',
  'http://www.journaldequebec.com/opinion/rss.xml'
  );

$jideku = new Jideku();
$jideku->run($feeds);
?>