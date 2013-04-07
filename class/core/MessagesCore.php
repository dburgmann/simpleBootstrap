<?php
require_once('../application/Language.php'));
require_once('../application/Translator.php'));
class MessagesCore{
	private $added		= array();
	private $lang		= null;
	private	$translator	= null;	
	
	public function __construct(){
		$lang 		= Language::instance();
		$translator = new Translator();
	}
	
	public function add($key, $value = ''){
		if(isSet($this->messages[$key])) $this->added[$key] = $value;
	}
	
	public function toString($prefix = ""){
		if(empty($this->added)) return '';
		
		$html  = '<div id="'.$prefix.'messageBox">';
		foreach ($this->added as $key => $value) {
			$html .= '<p>'.sprintf($this->translator->message($key, $lang->language), ucfirst($value)).'</p>';
		}
		$html .= '</div>';
		
		return $html;
	}
}