<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
	session_start();
    require_once(realpath(dirname(__FILE__).'/class/Bootstrap.php'));
    $bootstrap = new Bootstrap();
    $bootstrap->execute();
?>


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <title></title>
    </head>
    <body>
    	<div id="root">
    		<div id="navigation">
    			<?=$bootstrap->navigation()?>
    		</div>
			<div id="content">
	    		<?=$bootstrap->content()?>
		    </div>
    	</div>
   </body>
</html>
