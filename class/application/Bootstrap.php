<?php
//Manual:
//1. adjust class attributes of classes in "application"-folder as needed
//2. call bootstrap->content() to insert content
//3. call bootstrap->navigation() to insert navigation
//4. call bootstrap->languageSelection() to insert language select box
//
//content files are stored in content folder in subfolders of languages

require_once('class/core/BootstrapCore.php');
class Bootstrap extends BootstrapCore {
    protected $path     = 'content';										//path to pages folder without "/" at end & beginning
    protected $pages    = array(											//pages of website, first page is default page
                            'home',
                            'page2'
                            );
}
?>
