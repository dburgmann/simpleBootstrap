<?php
require_once(realpath(dirname(__FILE__).'/../core/TranslatorCore.php'));
class Translator extends TranslatorCore{
    protected $dictionary   = array(
    							array('en', 'de', 'es'),
    							array('house', 'haus', 'casa')
    							);
}
?>
