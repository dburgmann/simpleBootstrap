<?php
require_once('class/application/Language.php');
require_once('class/application/Translator.php');

abstract class BootstrapCore {
	protected $lang		= null;
	protected $translator = null;

    protected $pages    = array();
    protected $path     = '';

    protected $request  = array();
    protected $content 	= '';
    
    public function __construct(){
    	$this->lang = Language::instance();
    	$this->translator = new Translator();
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
        $language	= $this->lang->language();
        $page  		= (isset($this->request['page'])) ? $this->request['page'] : $this->pages[0];
        if(!in_array($this->page, $this->pages) OR !file_exists("{$this->path}/{$language}/{$page}.php")){
        	$this->page = $this->pages[0];
        }
        //TODO: 404 wenn auch std page nicht da
        
        //load page
        $this->content = "{$this->path}/{$language}/{$page}.php";
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
			$pageName = $this->translator->translate($page, 'en', $this->lang->language());
			$str .= "<a href=\"?page={$page}\"><span class=\"naviElement\">{$pageName}</span></a>";
		}
		$str .= '</div>';
		return $str;
    }    
}
?>
