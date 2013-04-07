<?php
require_once('../core/LangCore.php'));

public class Language extends LangCore{
	protected $defaultLang	= 'de';
	protected $allowedLangs = array(
								'de'
								);
}

?>