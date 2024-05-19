<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	if(!isset($client)) exit;

	if(is_null($page2))
	{
		require(Page.'panel/clientes/home.php');
	}
	else
	{
		if(file_exists(Page.'panel/clientes/'.$page2.'.php'))
		{
			require(Page.'panel/clientes/'.$page2.'.php');
		}
		else
		{
			echo "<script>pagemenu('404');</script>";
		}
	}
?>