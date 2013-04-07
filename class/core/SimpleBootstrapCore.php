<?php
require_once(realpath(dirname(__FILE__).'/../application/Language.php'));
require_once(realpath(dirname(__FILE__).'/../application/Translator.php'));

abstract class SimpleBootstrapCore {
	protected $lang		= null;
	protected $translator = null;

    protected $pages    = array();
    protected $path     = '';

    protected $request  = array();
    protected $content 	= '';
    
    public function __construct(){
    	$lang = new Language();
    	$translator = new Translator();
    }
    
    //routes the current request
    public function execute(){
        $this->request  = $_GET;
        
        //check if language change requested and change language if needed
        $newLang = (isset($this->request['lang'])) ? $this->request['lang'] : null;
        if(isSet($newLang) AND !empty($newLang)){
        	$this->lang->setLanguage($newLang);
        }               
        
        //check if requested page does exist and if site file exists
        $page  	= (isset($this->request['page'])) ? $this->request['page'] : $this->pages[0];
        if(!in_array($this->page, $this->pages) OR !file_exists("{$this->path}/{$this->lang->language}/{$page}.php")){
        	$this->page = $this->pages[0];
        }
        //load page
        $this->content = file_get_contents("{$this->path}/{$this->lang->language}/{$page}.php");
    }
    
    //returns the content of current page
    public function content(){
    	return $this->content;
    }
    
    public function languageSelection(){
    	return $this->lang->languageSelection();
    }
    
    //returns the navigation
    public function navigation(){
		$str 		= '<div id="navigation">';
		foreach ($this->pages as $page) {
			$pageName = $this->translator->translate($page, 'en', $this->lang->language)
			$str .= "<span class=\"naviElement\">{$pageName}</span>";
		}
		$str .= '</div>';
		return $str;
    };    
}
?>
