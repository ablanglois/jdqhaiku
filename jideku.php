<?php 
require_once('lib/simplepie/autoloader.php');
require_once('lib/serendipitous/Serendipitous.php');
require_once('lib/twitteroauth/twitteroauth.php');
require_once('lib/twitteroauth/config.php');

class Jideku {
  private $feedParser;
  private $haikuFinder;
  private $data;

  public function __construct() {
    $this->data = new SQLiteDatabase('data/data.sqlite');
    $this->feedParser = new SimplePie();
    $this->haikuFinder = new Serendipitous('fr');
  }

  public function setFeedURL($feedURL) {
    $this->feedParser->set_feed_url($feedURL);
    $this->feedParser->init();
  }

  public function run($feedURL) {
    $this->setFeedURL($feedURL);
    foreach ($this->feedParser->get_items() as $feed) :
      if ( $this->data->query('SELECT * FROM history WHERE uri="'.$feed->get_permalink().'"')->numRows() == 0 ) :
        $this->data->query('INSERT INTO history (uri) VALUES ("'.$feed->get_permalink().'")');
        $fullText = $this->getFullArticleContent($feed->get_permalink());
        if ( !preg_match('/x[0-9A-E]{2,4};/', $text) && $haiku = $this->haikuFinder->find($fullText) ):
          $this->data->query('INSERT INTO haikus (uri, title, text, date) VALUES ("'.$feed->get_permalink().'", "'.$feed->get_title().'", "'.$haiku.'", "'.date('c').'")');
          $this->tweet($haiku, $feed->get_permalink());
          echo "$haiku<hr>";
        endif;
      endif;
    endforeach;
    echo 'Mise à jour terminée!';
  }

  private function getFullArticleContent($url) {
    $content = @file_get_contents("http://www.instapaper.com/text?u=" . urlencode($url));

    $dom = new DOMDocument();
    @$dom->loadHTML($content);
    if (!$dom) : 
      return false;
    else :
      $xpath = new DOMXPath($dom);
      $elements = $xpath->query("//div[@id='story']");
      $content = $dom->saveXML($elements->item(0), LIBXML_NOEMPTYTAG);
      return strip_tags($content);
    endif;
  }

  private function tweet($haiku, $permalink) {
    $tweet = str_replace('<br>', "\n", $haiku)."\n\n#haiku $permalink";
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
    $connection->post( 'statuses/update', array('status'=>($tweet)) );
  }
}
?>