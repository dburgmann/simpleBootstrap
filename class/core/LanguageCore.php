<?php
	abstract class LanguageCore{
		protected static $instance	= null;
	
		protected	$allowedLangs	= array();
		protected 	$defaultLang	= '';
		private 	$lang	 		= '';
		
		//singleton constructor - requires php 5.3 for late static binding
		public static function instance(){
			if(static::$instance == null){
				static::$instance = new static();
			}
			return static::$instance;
		}
		
		//private constructor (singleton)
		private function __construct(){
			$this->lang = (isSet($_SESSION['lang']) && in_array($_SESSION['lang'], $this->allowedLangs)) ? $_SESSION['lang'] : $this->defaultLang;
		}	
		
		//sets language to given language
		public function setLanguage($newLang){
			if(in_array($newLang, $this->allowedLangs)){
				$this->lang = $newLang;
				$_SESSION['lang'] = $this->lang;
			}
		}
		
		//returns set language
		public function language(){
			return $this->lang;
		}
		
		//returns a language selection
		public function languageSelection(){
			$str 		= '<div id="languageSelection">';
			foreach ($this->allowedLangs as $langOption) {
				$url  = $this->langChangeUrl($langOption);
				$str .= "<a href=\"{$url}\"><img src=\"images/lang/{$langOption}.png\" /></a>";
			}
			$str .= '</div>';
			return $str;
		}
		
		private function currentUrl() {
			return ((empty($_SERVER['HTTPS'])) ? 'http://' : 'https://'). $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		}
		
		private function langChangeUrl($langOption){
			$url = $this->currentUrl();
			if(empty($_GET)){
				return $url."?lang={$langOption}";
			}else{
				if(isSet($_GET["lang"])){
					return substr($url, 0, -2).$langOption;
				}
				else{
					return $url."&lang={$langOption}";
				}
			}
		}
	}
?>
