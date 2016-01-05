<?php

/**
 * @file This file defines the class that calculates the list of words that are exceptions to
 * the vowel test for 'an' or 'a' prefix. i.e. if the first letter of a word is a vowel we
 * assume 'an' comes before it, otherwise 'a'. Any word that doesn't follow this rule will be
 * output by this class.
 * @date 05-Jan-2016
 * @author Mike Youell
 * @license GNU GENERAL PUBLIC LICENSE - Version 3, 29 June 2007
 */


include_once 'class.IndefiniteArticle.php';

/**
 * A class to work out the list of exception words for the 'words starts with a vowel test',
 * i.e. calculate words that fail like 'An honest' or 'An heir' or 'A unique'.
 */
 class CCalculateExceptionCases extends CIndefiniteArticle
 {
   /**
    * The simple (but incomplete) rule for 'a' or 'an' is to check whether the first letter of a word
    * is a vowel or a consonant. If it's a vowel then we assume 'an', otherwise 'a'. However this
    * won't work with cases like 'honest' or 'unique' which both break this simplistic rule.
    * This function finds all the words which fail this simplistic method. This means that if the
    * main algorithm comes across a word in the exception list then it knows to do the opposite
    * of the simple method. i.e. 'honest' and 'unique' would be listed in the exceptions list,
    * meaning that although 'unique' begins with a vowel we will treat assume the opposite,
    * i.e. 'a unique' and not 'an unique'. Same for 'honest', although it starts with a consonant
    * we want 'an honest' rather than 'a honest'.
    */
   public function calculate_exception_cases()
   {
      // Original file from http://svn.code.sf.net/p/cmusphinx/code/trunk/cmudict/sphinxdict/cmudict.0.7a_SPHINX_40
      $DictionarySoundsFile = strtolower( file_get_contents( 'cmudict.0.7a_SPHINX_40.txt' ) );

      // Remove bracketed terms, e.g. 'Herb (2)' wil be ignored. This is because the first
      // dictionary definition (and not (2), (3) etc) is the more common version.
      $DictionarySoundsFile = preg_replace( "#^.*\([^)]*\).*$#m", '', $DictionarySoundsFile );

      // Extract the words and the sounds from the file.
      preg_match_all( "#^([^[:space:]]+)[[:space:]]+(.+)$#m", $DictionarySoundsFile, $Matches );
      $Words  = $Matches[ 1 ];
      $Sounds = $Matches[ 2 ];

      // Create an array where the words are the keys, and the sounds are the values.
      $WordSounds = array_combine( $Words, $Sounds );

      echo "\n\nThe exceptions are:\n\n";

      foreach ( $WordSounds as $Word => $Sound )
      {
         $IsWordStartsWithVowel   = $this->is_starts_with_vowel( $Word );
         $IsSoundsStartsWithVowel = $this->is_starts_with_vowel( $Sound );

         // If this word breaks the following rule:
         // (
         //    (if a word begins with a vowel then 'an' otherwise 'a') ELSE
         //    (if a word begins with a consonsant then 'a' otherwise 'an')
         // )
         if
         (
            (
               $IsWordStartsWithVowel && ! $IsSoundsStartsWithVowel
            ) ||
            (
               ! $IsWordStartsWithVowel && $IsSoundsStartsWithVowel
            )
         )
         {
            // Then this word is an exception word.
            //
            // Output the exception words in a way that's easy to past into a PHP array declaration.
            // Note that strings enclosed by '' parse quicker than words enclosed "", so if the word
            // contains no apostrophe we enclose it in '', otherwise "". i.e. "eugenia's" rather than
            // 'eugenia's' which won't parse correctly.
            if ( ! strpos( $Word, "'" ) !== FALSE )
            {
               echo "      '$Word',\n";
            }
            else
            {
               echo "      \"$Word\",\n";
            }
         }
      }
   }
}

?>