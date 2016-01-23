<?php

$doc = new DOMDocument();
$doc->loadHTML("http://weargenius.blogspot.in/");

  $xpath = new DOMXpath($doc);
  $articles = $xpath->query("id('Stats1_totalCount')");
 print( $articles);
?>