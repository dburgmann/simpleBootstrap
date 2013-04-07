<?php
require_once('MessagesCore.php');          
require_once('../util/Form.php'); 
require_once('../lib/phpmailer/class.phpmailer.php');
require_once('../lib/valid.php');

class ContactformCore {
    protected $messages	= null;
   
   	protected $prefix		= "";
    protected $fields     	= array();
    protected $values 		= array();
    protected $mandatory	= array();
    protected $validation	= array();

	protected $isSmtp          = "";
	protected $smtpServer      = "";
	protected $smtpPort        = "";
	protected $smtpUser        = "";
	protected $smtpPass        = "";
	protected $method		   = "";

    protected $owner           = "";
    protected $domain          = "";
    protected $processingPage  = "";
    protected $sendingEmail    = "";
    protected $receivingEmail  = "";



	/**
	*Constructor
	**/
    public function  __construct() {
    	$this->messages	= new Messages();
    }


    /**
    *Generates the contact form html
    **/
    public function form(){
        $form = '<form accept-charset="utf-8" action="'.$this->processingPage.'" method="'.$this->method.'" name="'.$this->prefix.'form" id="'.$this->prefix.'form">';
        $htmlFields = $this->fieldsToHtml($this->fields);
        foreach($htmlFields as $field => $html){
        	$form .= Form::label($field, $this->prefix, in_array($field, $this->mandatory));
        	$form .= $html;
        }
        $form .= '<input type="submit" name="'.$this->prefix.'submit" id="'.$this->prefix.'submit" value="Senden" />';
        $form .= '</form>';
        $return ='<div id="'.$this->prefix.'wrapper">'.$this->messages->toString($this->prefix).trim($form).'</div>';         
        return $return;
    }
	

    /**
    * Generates the html for the fields specified in config.ini
    **/
    protected function fieldsToHtml(){
        $html = array();

        foreach ($this->fields as $name => $type) {
        	$value = (isSet($this->values[$name]))? $this->values[$name] : '';
			if(is_array($type)){
				$html[$name] = Form::dropdown($name, $type, $value, $this->prefix);
			}
			elseif($type === 'input'){
				$html[$name] = Form::input($name, $value, $this->prefix);
			}
			elseif($type === 'textarea'){
				$html[$name] = Form::textarea($name, $value, $this->prefix);
			}
			else{
				$this->messages->add('tech');
				return false;
			}
        }
        return $html;
    }

		
	/**
	*Processes the submitted form
	*/
    public function process(){
    	if(!Valid::getValue($this->prefix.'submit', false)) return;
    	$this->formValues();
    	
    	if(!$this->validate()) return;
        
        if($this->sendMail()) $this->messages->add('success');
        else $this->messages->add('tech');
        $this->resetForm();
    }


    /**
    *Gets all Values from the form and sets the class attributes according to it
    **/
    protected function formValues(){
        foreach ($this->fields as $name => $type) {
        	$this->values[$name] = Valid::getFormValue($this->prefix.$name);
        }
		return true;
    }

    protected function resetForm(){
        foreach ($this->values as $name => $value) {
            $this->values[$name] ="";
        }
        return true;
    }


	/**
	*Validates submitted post data from the form
	**/
	protected function validate(){
		$validated = true;
		foreach ($this->validation as $name => $rules) {
			foreach ($rules as $rule) {
				$valid 		= true;
				$hasValue 	= (isSet($this->values[$name]) && !empty($this->values[$name]));
				switch($rule){
					case 'required':
						$valid = $hasValue;
						if(!$valid){ 
							$this->messages->add('required', $name);
							$validated = false;
						}
						break;
					case 'text':
						if($hasValue) $valid = Valid::isStandardText($this->values[$name]);
						if(!$valid){ 
							$this->messages->add('text', $name);
							$validated = false;
						}
						break;
					case 'email':
						if($hasValue) $valid = Valid::isEmail($this->values[$name]);
						if(!$valid){ 
							$this->messages->add('email', $name);
							$validated = false;
						}
						break;
					case 'numeric':
						if($hasValue) $valid = Valid::isNumber($this->values[$name]);
						if(!$valid){ 
							$this->messages->add('numeric', $name);
							$validated = false;
						}
						break;
				}
			}
		}
		return $validated;      
	}


    /**
    *Sends the mail
    **/
    protected function sendMail(){
        $mail = new PHPMailer(true); //false => No Exceptions are thrown, use true for debug only
        
        try {
            if($this->isSmtp){
                $mail->IsSMTP();
                $mail->Port       = 26;                     // set the SMTP port for the GMAIL server
                $mail->SMTPAuth   = true;                   // enable SMTP authentication
                $mail->Host       = $this->smtpServer;      // SMTP server
                $mail->Port       = $this->smtpPort;
                $mail->Username   = $this->smtpUser;        // SMTP account username
                $mail->Password   = $this->smtpPass;        // SMTP account password
            }
            $mail->SetFrom($this->sendingEmail, $this->domain);
            $mail->AddAddress($this->receivingEmail, $this->owner);

            $mail->Subject  = "Kontaktformular Nachricht von ".$this->domain;
            $mail->Body     = $this->emailBody();
            $mail->IsHtml(true);
            $mail->Send();
            return true;
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Errors from PHP-Mailer
        } catch (Exception $e) {
            echo $e->getMessage(); //General Errors        
        }
    }

    protected function emailBody(){
        return  '
                <html>
                    <body>
                        <table>
                            '.$this->emailContent().'
                        </table>
                    </body>
                </html>
                ';
    }

    protected function emailContent(){
        $html = "";
        foreach ($this->values as $name => $value) {
            $html .= "
                        <tr>
                            <td>{$name}:</td>
                            <td>{$value}</td>
                        </tr>
                     ";
        }
        return $html;
    }
}
?>
