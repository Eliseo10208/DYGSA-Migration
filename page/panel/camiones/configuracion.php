<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

	if(!isset($page3))
	{
		require(Page.'/panel/camiones/configuracion/home.php');
	}
	else
	{
		if (file_exists(Page.'/panel/camiones/configuracion/'.$page3.'.php'))
		{
			require(Page.'/panel/camiones/configuracion/'.$page3.'.php');
		}
		else
		{
			require(Page.'/panel/404.php');
		}
	}
?>
