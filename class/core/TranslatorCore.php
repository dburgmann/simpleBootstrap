<?php
abstract class TranslatorCore {
    protected $dictionary  	= array(array('en', 'de', 'es'));
    protected $messages		= array(array('key', 'en', 'de', 'es'));
    
    //translates given word to given language (if in dictionary)
    public function translate($phrase, $from, $to, $usedDict=null){
    	$usedDict = ($usedDict == null)? $this->dictionary : $usedDict;
    
        $phrase = strtolower($phrase);
        $from 	= strtolower($from);
        $to 	= strtolower($to);
        
        //determine languages
        $langs 		= $this->dictionary[0];
        $fromPos 	= array_search($from, $langs);
        $toPos		= array_search($to, $langs);
        
        //find words
        foreach ($usedDict as $phraseList) {
        	if($phraseList[$fromPos] == $phrase) return $phraseList[$toPos];
        }
        return "false";     
    }
    
    public function message($key, $lang){
    	return $this->translate($key, 'key', $lang, $this->messages);
    }
}
?>
