<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
	
	if(isset($_SESSION['client']))
	{
		unset($_SESSION['client']);
	}

	echo '<script>page("home")</script>';
?>