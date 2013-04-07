<?php
abstract class TranslatorCore {
    protected $dictionary   = array(array('en', 'de', 'es'));
    
    //translates given word to given language (if in dictionary)
    public function translate($word, $from, $to){
        $word 	= strtolower($word);
        $from 	= strtolower($from);
        $to 	= strtolower($to);
        
        //determine languages
        $langs 		= $dictionary[0];
        $fromPos 	= array_search($from, $langs);
        $toPos		= array_search($to, $langs);
        
        //find words
        foreach ($dictionary as $wordlist) {
        	if($wordlist[$fromPos] == $word) return $wordlist[$toPos];
        }     
    }
}
?>
