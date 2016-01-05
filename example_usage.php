<?php

/**
 * @file This file shows how to use the class CIndefiniteArticle in order to work out
 * whether a word should have 'an' or 'a' before it. For example 'An honest man' or
 * 'A holistic idea', or even 'A unique idea'.
 * @date 05-Jan-2016
 * @author Mike Youell
 * @license GNU GENERAL PUBLIC LICENSE - Version 3, 29 June 2007
 */

include_once 'is_unknown_acronym.php';

include_once 'class.IndefiniteArticle.php';

// Words to test.
$TestWords = array
(
   'NSA',
   'NASA',
   'BBC',
   'USA',
   'USB',
   'Ukrainian',
   'European',
   'honest',
   'air',
   'heir',
   'hair',
   'hospital',
   'honour',
   'apple',
   'unique',
   'x-ray'
);

$IndefiniteArticle = new CIndefiniteArticle();

// For each word to test, do...
foreach ( $TestWords as $TestWord )
{
   // Output the result, i.e. 'an honest' or 'A NASA' etc.
   echo ucwords( $IndefiniteArticle->an_or_a( $TestWord ) ) . " $TestWord\n";
}

?>