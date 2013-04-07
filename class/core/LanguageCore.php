<?php
	abstract class LanguageCore{
		protected	$allowedLangs	= array();
		protected 	$defaultLang	= '';
		private 	$lang	 		= '';
		
		public function __construct(){
			$this->lang = (isSet($_SESSION['lang'])) ? $_SESSION['lang'] : $this->defaultLang;
		}	
		
		//sets language to given language
		public function setLanguage($newLang){
			if(in_array($newLang, $allowedLangs)){
				$lang = $newLang;
				$_SESSION['lang'] = $lang;
			}
		}
		
		//returns set language
		public function language(){
			return $lang;
		}
		
		//returns a language selection
		public function languageSelection(){
			$str 		= '<div id="languageSelection">';
			$currentUrl = $this->currentUrl();
			foreach ($this->allowedLangs as $lang) {
				$str .= "<a href=\"{$currentUrl}&lang={$lang}\"><img src=\"images/lang/{$lang}.png\" /></a>";
			}
			$str .= '</div>';
			return $str;
		}
		
		private function currentUrl() {
			return ((empty($_SERVER['HTTPS'])) ? 'http' : 'https') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		}
	}
?>
