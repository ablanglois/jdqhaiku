<?php
class TextProcessor {
  private $regexWord;
  private $regexSentence;
  private $regexSyllable;
  private $noLineBreak;

  public function __construct($lang) {
    $params = include(__DIR__.'/languages/'.$lang.'.php');
    $this->regexWord = $params['word'];
    $this->regexSentence = $params['sentence'];
    $this->regexSyllable = $params['syllable'];
    $this->noLineEnd = $params['noLineEnd'];
  }

  public function tokenize($string, $regex) {
    preg_match_all($regex, $string, $tokens);
    return $tokens[0];
  }

  public function words($string) {
    return $this->tokenize($string, $this->regexWord);
  }
  public function wordCount($string) {
    return count($this->words($string));
  }

  public function sentences($string) {
    return $this->tokenize($string, $this->regexSentence);
  }
  public function sentenceCount($string) {
    return count($this->sentences($string));
  }

  public function syllables($string) {
    return $this->tokenize($string, $this->regexSyllable);
  }
  public function syllableCount($string) {
    return count($this->syllables($string));
  }

  public function noLineEnd() {
    return $this->noLineEnd;
  }
}
?>