<?php
require_once('../core/TranslatorCore.php'));

class Translator extends TranslatorCore{
    protected $dictionary   = array(
    							array('en', 		'de', 		'es'),
    							array('house', 	'haus', 	'casa')
    							);
    							
    protected $messages		= array(
    							array('key', 'en', 'de', 'es')
    							);
    	
    							/* Fehlermeldungen
    							$this->messages['success'] 	= "Ihre Nachricht wurde erfolgreich versendet";
    							$this->messages['tech']		= "Wir haben momentan technische Probleme, bitte probieren Sie es später noch einmal!";
    							$this->messages['required'] = "Bitte füllen Sie alle Pflichtfelder aus!";
    							$this->messages['email'] 	= "Das %s Feld muss eine gültige E-Mail Adresse enthalten!";
    							$this->messages['text'] 	= "Das %s Feld darf keine xyz enthalten!";
    							$this->messages['numeric'] 	= "Das %s Feld darf nur Zahlen enthalten!";*/
}
?>
