<?php 
return array( 
  'word' => '/(?:["“«(]\s?)?\b[\w\'’-]+\b(?:\s?[\.?!:;"”»)])?/xu',
  'sentence' => '/
                (?(DEFINE)(?\'maj\'[A-ZÀÂÆÇÉÈÊÏŒÜ]))
                (?(DEFINE)(?\'phrase\'(?&maj).+?(?:\.{1,3}|[…?!]) (?!\s?:) (?=(\W+(?:(?&maj))|\Z)) ))
                «\ ?(?&phrase)\ ?» |
                "\ ?(?&phrase)\ ?" |
                “\ ?(?&phrase)\ ?” |
                (?&phrase)
              /xu',
  'syllable' => '/
                (?<![ei])a | [àä] | æ |
                (?<!ll|[ié])e(?!\b) | (?<!i)[éèê] | (?<!u)ë | (?<=\b[a-df-hj-np-tv-xz])e | (?<=qu)e |
                (?<![aeoœy])i | ï |
                (?<!ti|o)o | ô | œ |
                (?<![aeioœgq])u | (?<=g)u(?=ë) | û |
                (?<![aiueéèo])y(?![aiueéèo])
              /ixu',
  'noLineEnd' => array(
    'a', 'ont',
    'ce', 'ces',
    'comme', 'tel', 'telle',
    'de', 'des',
    'en',
    'est', 's’est', 's\'est', 'm’est', 'm\'est', 'n’est', 'n\'est', 'sont',
    'je', 'tu', 'il', 'elle', 'on', 'nous', 'vous', 'ils',
    'la', 'le', 'les',
    'leur', 'leurs',
    'mais', 'ou', 'et', 'donc', 'car', 'ni', 'or',
    'mon', 'mes',
    'ne',
    'notre', 'nos',
    'par',
    'plus',
    'que',
    'se',
    'son', 'sa', 'ses',
    'sur',
    'un', 'd’un', 'd\'un', 'une', 'd’une', 'd\'une',
    'va'
    ),
  'noLineStart' => array(
    'pas'
    )
  );
?>