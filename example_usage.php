<?php

/**
 * @file This file shows how to use the class CIndefiniteArticle in order to work out
 * whether a word should have 'an' or 'a' before it. For example 'An honest man' or
 * 'A holistic idea', or even 'A unique idea'.
 * @date 05-Jan-2016
 * @author Mike Youell
 * @license GNU GENERAL PUBLIC LICENSE - Version 3, 29 June 2007
 */


include_once 'class.IndefiniteArticle.php';

// Words to test.
$TestWords = array
(
   'NSA engineer.',
   'NASA astronaut.',
   'BBC correspondent.',
   'USA Olympian.',
   'USB stick.',
   'Ukrainian diplomat.',
   'European country.',
   'honest person.',
   'air guitar.',
   'heir to the throne.',
   'hair on my head.',
   'hospital appointment.',
   'honour to help you.',
   'apple can be eaten.',
   'unique idea.',
   'x-ray showed no problems.'
);

$IndefiniteArticle = new CIndefiniteArticle();

// For each word to test, do...
foreach ( $TestWords as $TestWord )
{
   // Output the result, i.e. 'an honest' or 'A NASA' etc.
   echo ucwords( $IndefiniteArticle->an_or_a( $TestWord ) ) . " $TestWord\n";
}

?>