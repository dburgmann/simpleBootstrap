<?php
require_once('class/core/LanguageCore.php');

class Language extends LanguageCore{
	protected $defaultLang	= 'de' ;
	protected $allowedLangs = array(
								'de',
								'en'
								);
}

?>