<?php
require_once('../core/ContactformCore.php');

class Contactform extends ContactformCore{
	protected $isSmtp        	= false;
	protected $smtpServer     	= "your smtp server adress";
	protected $smtpPort       	= "25";
	protected $smtpUser       	= "your username";
	protected $smtpPass       	= "your password";
	protected $method			= "get";

	protected $owner           	= "max mustermann";
	protected $domain         	= "www.dburgmann.de";
	protected $processingPage 	= "http://www.dburgmann.de/showroom/cf";
	protected $sendingEmail   	= "kontakt@dburgmann.de";
	protected $receivingEmail 	= "abzhibilt@gmail.com";
	
	protected $prefix			= "cf_";
	protected $fields	   		= Array("name" => "input", "email" => "input", "message" => "textarea");
	protected $mandatory		= Array("name", "email", "message");
	protected $validation		= Array("name" 		=> array("required", "text"), 
										"email" 	=> array("required", "email"),
										"message" 	=> array("required", "text"));
}
?>