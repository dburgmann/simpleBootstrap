<?php
require_once('class/core/TranslatorCore.php');

class Translator extends TranslatorCore{
    protected $dictionary   = array(
    							array('en', 	'de'),
    							array('home', 	'Startseite'),
    							array('page2',	'Seite2')
    							);
    							
    protected $messages		= array(
    							array('key', 'en', 'de'),
    							array('mandatoryNotice',
    							'Fields marked with <span class="cf_mandatory">*</span> are mandatory.',
    							'Mit <span class="cf_mandatory">*</span> gekennzeichnete Felder müssen ausgefüllt werden'),
    							array('success', 
    							'Your message was sent successfully!', 
    							'Ihre Nachricht wurde erfolgreich versendet'),
    							array('tech', 
    							'We are currently expierencing technical problems, please try again later.', 
    							'Wir haben momentan technische Probleme, bitte probieren Sie es später noch einmal.'),
    							array('required', 
    							'Please fill in all mandatory fields!', 
    							'Bitte füllen Sie alle Pflichtfelder aus!'),
    							array('email', 
    							'Please enter a valid email address!',
    							'Bitte geben sie eine gültige E-Mail Adresse an!'),
    							array('text', 
    							'The %s field must contain only letters, numbers and the following special characters (. : , - _ ; ! ?).',
    							'Das %s Feld darf nur Buchstaben Zahlen und die Sonderzeichen . : , - _ ; ! ? enthalten.'),
    							array('numeric',
    							'The %s field must contain only numbers.',
    							'Das %s Feld darf nur Zahlen enthalten!')
    							);
}
?>
