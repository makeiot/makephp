<?php
	require_once(dirname(__FILE__).'./MPException.php');
	echo '<h1>MakePHP Error:'.MPException::getErrorMsg().'</h1>'
	exit(0);
?>