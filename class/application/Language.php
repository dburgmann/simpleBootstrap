<?php
require_once(realpath(dirname(__FILE__).'/../core/LangCore.php'));

public class Language extends LangCore{
	protected $defaultLang	= 'de';
	protected $allowedLangs = array(
								'de'
								);
}

?>