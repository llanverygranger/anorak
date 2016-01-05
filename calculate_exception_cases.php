<?php

/**
 * @file This file calculates the list of words that are exceptions to the vowel test for
 * 'an' or 'a' prefix. i.e. if the first letter of a word is a vowel we assume 'an' comes
 * before it, otherwise 'a'. Any word that doesn't follow this rule will be output by this
 * function.
 * @date 05-Jan-2016
 * @author Mike Youell
 * @license GNU GENERAL PUBLIC LICENSE - Version 3, 29 June 2007
 */

include_once 'class.CalculateExceptionCases.php';


$CalculateExceptionCases = new CCalculateExceptionCases();

$CalculateExceptionCases->calculate_exception_cases();

?>