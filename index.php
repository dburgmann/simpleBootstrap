<?php
	session_start();
    require_once('class/application/Bootstrap.php');
    require_once('class/application/Contactform.php');
    
    $bootstrap 	= new Bootstrap();
    $cf 		= new Contactform();
    $cf->process(); 
    $bootstrap->execute();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/contactform.css" />
        <title></title>
    </head>
    <body>
    	<div id="root">
    		<div id="navigation">
    			<?=$bootstrap->navigation()?>
    		</div>
			<div id="content">
				<?=$cf->form()?>
	    		<? include($bootstrap->content()) ?>
		    </div>
		    <?=$bootstrap->languageSelection()?>
    	</div>
   </body>
</html>
