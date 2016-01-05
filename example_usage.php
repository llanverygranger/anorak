<?php

/**
 * @file This file contains functionality to work out whether a word should have 'an' or 'a'
 * before it. For example 'An honest man' or 'A holistic idea', or even 'A unique idea'.
 * @date 05-Jan-2016
 * @note This code was put together after reading the forum posts here:
 * https://stackoverflow.com/questions/1288291/how-can-i-correctly-prefix-a-word-with-a-and-an
 * I took all good suggestions on board to implement my solution and also added some of my
 * own ideas. I would value feedback from people to improve this solutuion even more.
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
   echo ucwords( $IndefiniteArticle->a_or_an( $TestWord ) ) . " $TestWord\n";
}

?>